<?php
/**
 * accodion-header
 *
 */
?>

<div class="accordion-block__content">
    <?php
    $template = [
    	[
    		"core/paragraph",
    		[
    			"content" =>
    				"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
    		],
    	],
    ];
    echo '<InnerBlocks template="' . esc_attr(wp_json_encode($template)) . '" />';
    ?>
</div>