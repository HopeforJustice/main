<?php

/**
 * draggable-cards
 *
 * Parent block. Holds a horizontally draggable row of "acf/draggable-card"
 * blocks, admins add/remove/reorder cards as normal blocks in the editor.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$class_name = "";
if (!empty($block["className"])) {
	$class_name .= " " . $block["className"];
}
?>

<!-- draggable cards -->
<div class="draggable-cards-block <?php echo $class_name; ?>">
    <div class="draggable-cards-block__nav">
        <button type="button" class="draggable-cards-block__arrow draggable-cards-block__arrow--prev" aria-label="<?php esc_attr_e(
        	"Previous card",
        	"hope-for-justice"
        ); ?>">
            <svg viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <button type="button" class="draggable-cards-block__arrow draggable-cards-block__arrow--next" aria-label="<?php esc_attr_e(
        	"Next card",
        	"hope-for-justice"
        ); ?>">
            <svg viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>

    <!-- track becomes the InnerBlocks wrapper so cards are direct children -->
    <div class="draggable-cards-block__track">
        <?php
        $template = [
        	["acf/draggable-card"],
        	["acf/draggable-card"],
        	["acf/draggable-card"],
        	["acf/draggable-card"],
        ];
        $allowed_blocks = ["acf/draggable-card"];
        echo '<InnerBlocks useInnerBlocksProps template="' .
        	esc_attr(wp_json_encode($template)) .
        	'" allowedBlocks="' .
        	esc_attr(wp_json_encode($allowed_blocks)) .
        	'" orientation="horizontal" />';
        ?>
    </div>
</div>
