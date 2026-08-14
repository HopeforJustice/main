<?php

/**
 * full-header
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = "full-header-" . $block["id"];
if (!empty($block["anchor"])) {
	$id = $block["anchor"];
}

$class_name = "";
if (!empty($block["className"])) {
	$class_name .= " " . $block["className"];
}

$hasGradient = get_field("has_gradient");
$hasGradientBottom = get_field("has_gradient_bottom");
$gradientColor = get_field("gradient_color");
$gradientColorB = get_field("gradient_color_b");
$dont_split_content = get_field("dont_split_content");
$align_content = get_field("align_content");
$max_width = get_field("content_max_width");

$image = get_field("image");
if ($image) {
	$top = $image["top"];
	$left = $image["left"];
	$id = $image["id"];
} else {
	$top = 0;
	$left = 0;
	$id = "309";
}
$image_src = wp_get_attachment_image_src($id, "full");

$wrapper_class = "full-header";
if ($dont_split_content) {
	$wrapper_class .= " full-header--dont-split";
}
$wrapper_class .= " " . $class_name . " hfj-block";
$image_background_position = $left . "% " . $top . "%";
$image_style =
	"background-image: url('" .
	esc_url($image_src[0]) .
	"'); background-position: " .
	esc_attr($image_background_position) .
	";";

$gradient_style =
	"--gradient-a:" .
	esc_attr($gradientColor) .
	"; --gradient-b: " .
	esc_attr($gradientColorB) .
	";";

$content_class = "full-header__content";
if ($align_content === "center") {
	$content_class .= " full-header__content--no-padding";
}
$content_style =
	"--align-content: " .
	esc_attr($align_content) .
	"; --max-width: " .
	esc_attr($max_width) .
	"px;";
?>


<!-- wrapper -->
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($wrapper_class); ?>">
    <!-- grid -->
    <div class="better-grid">
        <!-- image -->
        <div style="<?php echo $image_style; ?>" class="full-header__image">
        </div>

        <?php if ($hasGradient) { ?>
            <div class="full-header__gradient full-header__gradient--left" style="<?php echo $gradient_style; ?>">
            </div>
        <?php } ?>

        <?php if ($hasGradientBottom) { ?>
            <div class="full-header__gradient full-header__gradient--bottom" style="<?php echo $gradient_style; ?>">
            </div>
        <?php } ?>

        <div class="<?php echo esc_attr($content_class); ?>" style="<?php echo $content_style; ?>">
            <InnerBlocks />
        </div>

    </div>
</div>