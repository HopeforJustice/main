<?php

/**
 * draggable-card
 *
 * Child block. One card inside the "acf/draggable-cards" block. Only valid
 * as a direct child of that block.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Load values and assign defaults.
$image = get_field("image");
$top_gradient = get_field("top_gradient");
$bottom_gradient = get_field("bottom_gradient");
if (is_null($bottom_gradient)) {
	// Default to on, so a fresh card is still readable over an image.
	$bottom_gradient = true;
}
$full_colour = get_field("full_colour");
$content_align = get_field("content_align") ?: "bottom";
$additional_content_header = get_field("additional_content_header");
$additional_content_body = get_field("additional_content_body");
$has_additional_content = $additional_content_header || $additional_content_body;
$modal_id = "draggable-card-modal-" . uniqid();

$class_name = "";
if (!empty($block["className"])) {
	$class_name .= " " . $block["className"];
}
?>

<!-- draggable card -->
<div class="draggable-card <?php echo $class_name; ?>" <?php if (
	$full_colour
) { ?>style="background-color: <?php echo esc_attr($full_colour); ?>;"<?php } ?>>
    <?php if ($image) {
    	echo wp_get_attachment_image($image, "large", false, [
    		"class" => "draggable-card__image",
    		"alt" => "",
    	]);
    } ?>

    <?php if ($top_gradient) { ?>
        <div class="draggable-card__gradient draggable-card__gradient--top"></div>
    <?php } ?>

    <?php if ($bottom_gradient) { ?>
        <div class="draggable-card__gradient draggable-card__gradient--bottom"></div>
    <?php } ?>

    <div class="draggable-card__content draggable-card__content--align-<?php echo esc_attr(
    	$content_align
    ); ?>">
        <?php
        $template = [
        	["core/heading", ["content" => "Card title", "level" => 3]],
        	["core/paragraph", ["content" => "Add some text about this card."]],
        ];
        echo '<InnerBlocks template="' . esc_attr(wp_json_encode($template)) . '" />';
        ?>
    </div>

    <?php if ($has_additional_content) { ?>
        <button type="button" class="draggable-card__more" data-modal-target="<?php echo esc_attr(
        	$modal_id
        ); ?>" aria-haspopup="dialog" aria-label="<?php esc_attr_e(
	"More about this card",
	"hope-for-justice"
); ?>">
            <svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 1V13M1 7H13" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
        </button>

        <!-- extra context for this card, shown in a popup. Nested inside
        the card (rather than a sibling of it) so it isn't an extra item in
        the track's card row - position: fixed below takes it out of that
        flow entirely regardless, but this keeps it out of the row's DOM
        even while hidden. -->
        <div class="draggable-card__modal draggable-card__modal--closed" id="<?php echo esc_attr(
        	$modal_id
        ); ?>" role="dialog" aria-modal="true" aria-hidden="true">
            <div class="draggable-card__modal-backdrop" data-modal-close></div>
            <div class="draggable-card__modal-dialog">
                <div class="draggable-card__modal-content">
                    <button type="button" class="draggable-card__modal-close" data-modal-close aria-label="<?php esc_attr_e(
                    	"Close",
                    	"hope-for-justice"
                    ); ?>">&times;</button>
                    <?php if ($additional_content_header) { ?>
                        <h3 class="draggable-card__modal-header is-style-apercu has-extra-large-font-size"><strong><?php echo esc_html(
                        	$additional_content_header
                        ); ?></strong></h3>
                    <?php } ?>
                    <?php echo $additional_content_body; ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
