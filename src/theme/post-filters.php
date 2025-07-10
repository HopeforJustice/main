<?php

add_action("wp_ajax_filter_resources", "filter_resources_ajax");
add_action("wp_ajax_nopriv_filter_resources", "filter_resources_ajax");

function filter_resources_ajax()
{
	$tax_query = [];

	if (!empty($_GET["lang"]) && $_GET["lang"] !== "all") {
		$tax_query[] = [
			"taxonomy" => "languages",
			"field" => "slug",
			"terms" => sanitize_text_field($_GET["lang"]),
		];
	}

	if (!empty($_GET["topic"]) && $_GET["topic"] !== "all") {
		$tax_query[] = [
			"taxonomy" => "topics",
			"field" => "slug",
			"terms" => sanitize_text_field($_GET["topic"]),
		];
	}

	// Only add 'relation' => 'AND' if more than one taxonomy filter is applied
	if (count($tax_query) > 1) {
		$tax_query = array_merge(["relation" => "AND"], $tax_query);
	}

	$args = [
		"post_type" => "resources_template",
		"posts_per_page" => -1,
	];

	if (!empty($tax_query)) {
		$args["tax_query"] = $tax_query;
	}
	$query = new WP_Query($args);

	ob_start();

	if ($query->have_posts()) {
		while ($query->have_posts()) {

			$query->the_post();

			$image_src = get_the_post_thumbnail_url(get_the_ID());
			$title = get_the_title();

			if (get_field("choose_between") == "pdf") {
				$link = get_field("upload_pdf");
			} elseif (get_field("choose_between") == "link") {
				$link = get_field("link");
			}
			?>
            <div class="resources-block__resource post-block__post">
                <a href="<?php echo esc_url(
                	$link
                ); ?>" class="resources-block__link post-block__link" download></a>
                <div class="resources-block__img post-block__image" style="background-image: url('<?php echo esc_url(
                	$image_src
                ); ?>'); background-size:cover; background-position:center;">
                    <img class="resources__download resources-block__download" src="<?php echo get_template_directory_uri(); ?>/assets/img/download.svg" alt="">
                </div>
                <div class="resources-block__content post-block__content">
                    <div class="resources-block__title">
                        <b><?php echo esc_html(get_the_excerpt()); ?>
                        <span style="white-space: pre;">&nbsp;<img alt="arrow" src="<?php echo get_template_directory_uri(); ?>/assets/img/link-arrow.svg"></span>
                        </b>
                    </div>
                </div>
            </div>
            <?php
		}
	} else {
		echo "<p>No resources found.</p>";
	}

	wp_reset_postdata();
	echo ob_get_clean();
	wp_die();
}
