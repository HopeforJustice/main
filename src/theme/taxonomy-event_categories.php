<?php get_header(); ?>


<main class="better-grid hfj-block events events__archive">
    <?php the_archive_title('<h2 class="events__archive-title font-fk">', ' Events</h2>'); ?>

    <ul class="breadcrumbs">
        <li class="breadcrumbs__crumb">
            <a class="breadcrumbs__link" href="/upcoming-events">
                Upcoming Events
            </a>
        </li>
        <li class="breadcrumbs__seperator"><img src="<?php echo get_template_directory_uri() . '/assets/img/link-arrow.svg'; ?>"></li>
        <li class="breadcrumbs__crumb">
            <p class="breadcrumbs__link">
                <?php the_archive_title(); ?>
            </p>
        </li>
    </ul>

    <?php if (have_posts()) : while (have_posts()) :
            the_post(); ?>
            <?php
            $image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
            $event_date_start = get_field('event_date_start', get_the_ID());
            $event_location = get_field('event_location', get_the_ID());
            $event_date_end = get_field('event_date_end', get_the_ID());
            $link = get_field('link', get_the_ID()) ?: get_permalink(get_the_ID());
            $title = get_the_title(get_the_ID());
            $event_type = get_field('event_type', get_the_ID());
            //modify date formats
            $start_date_mod = date("M j", strtotime($event_date_start));
            $end_date_mod = date("M j", strtotime($event_date_end));

            ?>

            <a <?php if (!is_admin()) echo 'href="' . $link . '"' ?> class="event-series__event">

                <div class="event-series__event-img" <?php if ($image) { ?> style="background-image: url('<?php echo $image ?>');">
                <?php } else { ?>
                    style="background-color: var(--black);">
                    <img class="event-series__event-img-placeholder" alt="event image placeholder" src="<?php echo get_template_directory_uri() . '/assets/img/hfj-vertical-logo.svg'; ?>" alt="">
                <?php } ?>
                </div>

                <div class="event-series__event-content">
                    <div style="display: inline-block;">
                        <div class="event-series__event-time">
                            <svg id="Group_7762" data-name="Group 7762" xmlns="http://www.w3.org/2000/svg" width="11.819" height="11.82" viewBox="0 0 11.819 11.82">
                                <path id="Path_17202" data-name="Path 17202" d="M5.91,11.819a5.91,5.91,0,1,1,5.91-5.91,5.916,5.916,0,0,1-5.91,5.91M5.91.985A4.925,4.925,0,1,0,10.834,5.91,4.93,4.93,0,0,0,5.91.985" transform="translate(0 0)" fill="#212322" />
                                <path id="Path_17203" data-name="Path 17203" d="M7.04,7.109H6.969a.4.4,0,0,1-.4-.4V3.567a.4.4,0,0,1,.4-.4H7.04a.4.4,0,0,1,.4.4V6.711a.4.4,0,0,1-.4.4" transform="translate(-1.095 -0.528)" fill="#212322" />
                                <path id="Path_17204" data-name="Path 17204" d="M6.569,7.237l.089-.1a.367.367,0,0,1,.519-.021L8.949,8.754a.367.367,0,0,1,.021.518l-.091.1a.365.365,0,0,1-.517.021L6.589,7.755a.366.366,0,0,1-.02-.518" transform="translate(-1.078 -1.17)" fill="#212322" />
                            </svg>
                            <p><?php if ($event_start_end) echo $start_date_mod . ' - ' ?><?php echo $end_date_mod ?></p>
                        </div>
                    </div>
                    <p class="event-series__event-title">
                        <b><?php echo $title ?><span class="event-series__event-arrow">&nbsp;<img src="<?php echo get_template_directory_uri() . '/assets/img/link-arrow.svg'; ?>"></span>
                        </b>
                    </p>
                    <div class="event-series__event-location">
                        <?php if ($event_type == 'online') { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 15 15">
                                <g id="Group_7450" data-name="Group 7450" transform="translate(0 0)">
                                    <g id="Group_7440" data-name="Group 7440" transform="translate(0 0)" clip-path="url(#clip-path)">
                                        <path id="Path_17205" data-name="Path 17205" d="M7.5.937A6.562,6.562,0,1,1,.937,7.5,6.571,6.571,0,0,1,7.5.937M7.5,0A7.5,7.5,0,1,0,15,7.5,7.5,7.5,0,0,0,7.5,0" transform="translate(0 0)" fill="#d6001c" />
                                        <path id="Path_17206" data-name="Path 17206" d="M7.293,1.058c1.078,0,2.644,2.51,2.644,6.442s-1.566,6.442-2.644,6.442S4.649,11.432,4.649,7.5,6.215,1.058,7.293,1.058M7.293,0c-2.044,0-3.7,3.358-3.7,7.5S5.248,15,7.293,15s3.7-3.358,3.7-7.5S9.337,0,7.293,0" transform="translate(0.207 0)" fill="#d6001c" />
                                        <rect id="Rectangle_3150" data-name="Rectangle 3150" width="14.047" height="0.938" transform="translate(0.514 7.031)" fill="#d6001c" />
                                        <rect id="Rectangle_3151" data-name="Rectangle 3151" width="0.938" height="13.903" transform="translate(7.03 0.574)" fill="#d6001c" />
                                        <path id="Path_17207" data-name="Path 17207" d="M12.38,2.753a12.635,12.635,0,0,1-4.965.892,12.287,12.287,0,0,1-5.156-.979l-.785.8A12.927,12.927,0,0,0,7.415,4.7a13.034,13.034,0,0,0,5.88-1.208Z" transform="translate(0.085 0.154)" fill="#d6001c" />
                                        <path id="Path_17208" data-name="Path 17208" d="M2.573,11.474A12.941,12.941,0,0,1,7.4,10.649a11.953,11.953,0,0,1,5.379,1.082l.546-.907A12.951,12.951,0,0,0,7.4,9.591a13.571,13.571,0,0,0-5.577,1.057Z" transform="translate(0.105 0.554)" fill="#d6001c" />
                                    </g>
                                </g>
                            </svg>

                        <?php } else { ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="9.145" height="13" viewBox="0 0 9.145 13">
                                <path id="Path_17616" data-name="Path 17616" d="M4.573,0A4.573,4.573,0,0,1,9.145,4.573C9.145,7.1,4.573,13,4.573,13S0,7.1,0,4.573A4.573,4.573,0,0,1,4.573,0Z" fill="#d6001c" />
                            </svg>
                        <?php } ?>
                        <p><?php echo $event_location ?></p>
                    </div>
                </div>
            </a>
    <?php endwhile;
    endif;

    /* Restore original Post Data
* NB: Because we are using new WP_Query we aren't stomping on the
* original $wp_query and it does not need to be reset.
*/
    wp_reset_postdata(); ?>
</main>

<?php get_footer(); ?>