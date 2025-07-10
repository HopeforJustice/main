<?php

/**
 * Resources block
 *
 */

// Load values and assign defaults.
$resources = get_field("resources");
$topic = get_field("topic", $block["id"]);
$show_languages = get_field("show_language_selection") ?? false;
?>
<div class="resources-block">
    <?php if ($show_languages): ?>
        <div class="better-grid">
            <div class="resources-block__languages">
                <div class="resources-block__language-title"><strong>Filter by language:</strong></div>
                <div class="resources-block__language-list">
                    <select id="language-select"  name="" id="">
                    <option value="all" class="resources-block__language-item" selected>
                        All
                    </option>
                    <?php
                    $languages = get_terms([
                    	"taxonomy" => "languages",
                    	"hide_empty" => false,
                    ]);
                    foreach ($languages as $lang): ?>
                        <option value="<?php echo $lang->slug; ?>" class="resources-block__language-item">
                            <?php echo $lang->name; ?>
                        </option>
                    <?php endforeach;
                    ?>
                </select>
                </div>
            </div>
        </div>
    <?php endif; ?>
<div class="better-grid post-block">
    <?php if (!empty($topic)) {
    	$tax_query = [];
    	if (is_array($topic) && is_object($topic[0])) {
    		$topic_slugs = wp_list_pluck($topic, "slug");
    	} else {
    		$topic_slugs = (array) $topic;
    	}
    	$tax_query[] = [
    		"taxonomy" => "topics",
    		"field" => "slug",
    		"terms" => $topic_slugs,
    	];
    	$args = ["post_type" => "resources_template", "posts_per_page" => -1];
    	if (!empty($tax_query)) {
    		$args["tax_query"] = $tax_query;
    	}
    	$resources_query = new WP_Query($args);
    	$resources = $resources_query->posts;
    } ?>

    <?php if ($resources): ?>
        <?php foreach ($resources as $post): ?>
            <?php
            $image_src = get_the_post_thumbnail_url($post->ID);
            $title = get_the_title($post->ID);
            if (get_field("choose_between", $post->ID) == "pdf") {
            	$link = get_field("upload_pdf", $post->ID);
            } elseif (get_field("choose_between", $post->ID) == "link") {
            	$link = get_field("link", $post->ID);
            }
            ?>

            <div class="resources-block__resource post-block__post">

                <a <?php if (!is_admin()) {
                	echo 'href="' . $link . '"';
                } ?> class="resources-block__link post-block__link" download></a>
                <div class="resources-block__img post-block__image" style="background-size:cover; background-image: url('<?php echo $image_src; ?>'); background-position: center">
                    <?php if (!get_field("no_download", $rpost->ID)) { ?>
                        <img class="resources__download resources-block__download" src="<?php echo get_template_directory_uri() .
                        	"/assets/img/download.svg"; ?>" alt="">
                    <?php } ?>
                </div>

                <div class="resources-block__content post-block__content">


                    <div class="resources-block__title">
                        <b><?php echo get_the_excerpt(
                        	$post->ID
                        ); ?><span style="white-space: pre;">&nbsp;<img alt="arrow" src="<?php echo get_template_directory_uri() .
	"/assets/img/link-arrow.svg"; ?>"></span>
                        </b>
                    </div>
                </div>

            </div>

        <?php endforeach; ?>



    <?php else:echo "add posts";endif; ?>

</div>
</div>

<?php wp_reset_postdata(); ?>
