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

$class_name = "";
if (!empty($block["className"])) {
	$class_name .= " " . $block["className"];
}
?>

<!-- draggable card -->
<div class="draggable-card <?php echo $class_name; ?>" <?php if ($full_colour) { ?>style="background-color: <?php echo esc_attr(
	$full_colour
); ?>;"<?php } ?>>
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
</div>
