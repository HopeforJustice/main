<?php
function add_topic_filter_to_resources_admin($post_type)
{
	if ($post_type !== "resources_template") {
		return;
	}

	$taxonomy = "topics";
	$taxonomy_obj = get_taxonomy($taxonomy);
	if (!$taxonomy_obj) {
		return;
	}

	$terms = get_terms([
		"taxonomy" => $taxonomy,
		"hide_empty" => false,
	]);

	if (!empty($terms)) {
		$selected = $_GET[$taxonomy] ?? ""; ?>
        <select name="<?php echo esc_attr($taxonomy); ?>">
            <option value=""><?php echo esc_html(
            	$taxonomy_obj->labels->all_items
            ); ?></option>
            <?php foreach ($terms as $term): ?>
                <option value="<?php echo esc_attr(
                	$term->slug
                ); ?>" <?php selected($selected, $term->slug); ?>>
                    <?php echo esc_html($term->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php
	}
}
add_action("restrict_manage_posts", "add_topic_filter_to_resources_admin");
