<?php

/**
 * Generic headless serializer for Gutenberg/ACF block content, exposed to
 * Next.js over REST as a `blocks` field on pages and posts.
 *
 * Gutenberg blocks are parsed in JS inside wp-admin, so there's no REST
 * endpoint that returns structured block data for free - this walks
 * parse_blocks() (what the block editor itself produces) and resolves each
 * block the same way WordPress does when it actually renders one, rather
 * than re-deriving ACF's storage format by hand:
 *
 * - core/block (a reusable block / pattern) has no content of its own - it
 *   just points at a wp_block post via its "ref" attribute, so its
 *   referenced content is parsed and inlined recursively.
 * - acf/* blocks store their field data flattened and keyed by ACF field
 *   key (e.g. "cards_0_title" + "_cards_0_title": "field_xxx") directly in
 *   the block's attributes - this is the same format
 *   acf_register_block_type()'s own render path resolves via
 *   acf_setup_meta($block['data'], $block['id'], true) followed by
 *   get_fields() (confirmed against the installed ACF PRO 6.8.6 source,
 *   pro/blocks.php) before tearing the scope down with acf_reset_meta() -
 *   reusing that instead of hand-rolling repeater/flexible-content
 *   reconstruction gets every field type (images, links, repeaters,
 *   flexible content) resolved exactly like get_field() normally would.
 * - everything else (core/heading, core/paragraph, core/spacer, etc.) is
 *   passed through as blockName + attrs; Next.js maps these to its own
 *   components rather than consuming raw block HTML.
 *
 * This is deliberately generic rather than one endpoint per block type -
 * the theme registers ~45 distinct ACF block types (see acf-blocks.php),
 * so a single serializer that works for any of them is what scales.
 *
 * Blocks that encode a content decision made at render time rather than
 * authoring time (e.g. acf/geo-target, which wraps country-specific
 * variants) are deliberately NOT resolved to a single branch here - that
 * would bake a request-time IP guess into cached JSON. The full set of
 * branches is exposed as-is; picking the right one per locale route is a
 * decision for the Next.js side to make explicitly, not this endpoint.
 */

function hfj_resolve_blocks(array $parsed_blocks, int $post_id): array
{
	$resolved = [];

	foreach ($parsed_blocks as $block) {
		$block_name = $block["blockName"];

		if ($block_name === null) {
			// Freeform HTML between blocks - usually just whitespace from
			// the editor; parse_blocks() still emits a null-named "block"
			// for the gap between two real ones.
			$html = trim($block["innerHTML"] ?? "");
			if ($html === "") {
				continue;
			}
			$resolved[] = ["blockName" => null, "html" => $html];
			continue;
		}

		if ($block_name === "core/block") {
			$ref_id = $block["attrs"]["ref"] ?? null;
			$ref_post = $ref_id ? get_post($ref_id) : null;
			if ($ref_post) {
				$resolved = array_merge(
					$resolved,
					hfj_resolve_blocks(parse_blocks($ref_post->post_content), $post_id)
				);
			}
			continue;
		}

		$node = [
			"blockName" => $block_name,
			"attrs" => $block["attrs"] ?? [],
		];

		$is_acf_block = str_starts_with($block_name, "acf/");
		$has_raw_data = !empty($block["attrs"]["data"]);

		if ($is_acf_block && $has_raw_data && function_exists("acf_setup_meta")) {
			$block_id = $block["attrs"]["id"] ?? "block_" . md5(wp_json_encode($block["attrs"]["data"]));
			acf_setup_meta($block["attrs"]["data"], $block_id, true);
			$node["fields"] = get_fields($block_id) ?: [];
			acf_reset_meta($block_id);
			unset($node["attrs"]["data"]); // superseded by the resolved "fields"
		}

		$inner_blocks = array_values(array_filter($block["innerBlocks"] ?? []));
		if (!empty($inner_blocks)) {
			$node["innerBlocks"] = hfj_resolve_blocks($inner_blocks, $post_id);
		}

		// A leaf, non-ACF block (core/heading, core/paragraph, core/spacer,
		// etc.) has no "fields" to resolve and no children to recurse into -
		// its actual content (e.g. a heading's text) lives in its saved
		// innerHTML, not its attrs, so without this it would come through
		// with attrs only and no text at all. render_block() (not a raw
		// innerHTML grab) so it goes through WordPress's normal block
		// rendering/filters exactly as the_content() would.
		if (!$is_acf_block && empty($inner_blocks)) {
			$node["html"] = render_block($block);
		}

		$resolved[] = $node;
	}

	return $resolved;
}

function hfj_get_post_blocks(int $post_id): array
{
	$post = get_post($post_id);
	if (!$post) {
		return [];
	}

	return hfj_resolve_blocks(parse_blocks($post->post_content), $post_id);
}

// Expose the resolved block tree as a `blocks` field on the standard REST
// post/page responses, alongside the existing content.rendered.
//
// This deliberately does NOT follow the usual REST field convention of
// computing by default and only excluding on request - resolving a page's
// full block tree (parse_blocks() plus one acf_setup_meta()/get_fields()
// cycle per ACF block) isn't free, and register_rest_field()'s callback
// runs for ANY REST request to a page/post that doesn't explicitly
// restrict its fields, not just ones that actually want "blocks". Without
// this guard, some other integration listing pages/posts with no _fields
// filter would pay this cost on every request without ever using the
// result. Opting in via _fields keeps it to callers (Next.js, an editor
// explicitly asking for it) that actually want it.
add_action("rest_api_init", function () {
	foreach (["page", "post"] as $post_type) {
		register_rest_field($post_type, "blocks", [
			"get_callback" => function ($post, $field_name, $request) {
				$requested_fields = $request->get_param("_fields");
				if (empty($requested_fields)) {
					return null;
				}
				if (!is_array($requested_fields)) {
					$requested_fields = preg_split('/[\s,]+/', $requested_fields);
				}
				if (!rest_is_field_included($field_name, $requested_fields)) {
					return null;
				}
				return hfj_get_post_blocks($post["id"]);
			},
		]);
	}
});
