<?php

$hideJobs = get_field("hide_cezanne") ?: false;

$occupop_request = wp_remote_get("https://api.occupop.com/rest/jobs", [
	"headers" => [
		"Accept" => "application/json",
		"Authorization" => "Bearer " . OCCUPOP_API_TOKEN,
	],
]);

$jobs = [];
if (!is_wp_error($occupop_request)) {
	$occupop_response = json_decode(wp_remote_retrieve_body($occupop_request));
	$jobs = $occupop_response->data ?? [];
}
$emptyJobs = empty($jobs);
?>

<div class="better-grid careers-block">
    <?php if (!$hideJobs) { ?>
        <?php foreach ($jobs as $job) {
        	// SFA roles are tagged via their id_ref (e.g. "SFA-123") rather than a dedicated field.
        	$isSfaJob = isset($job->id_ref) && strpos($job->id_ref, "SFA") !== false;
        	if ($isSfaJob) {
        		continue;
        	}

        	$locationPart1 = $job->location->city ?? $job->location->state ?? null;
        	$locationPart2 = $job->location->country ?? null;

        	$jobMeta = array_filter([
        		"Contract" => $job->contract ?? null,
        		"Period" => $job->period ?? null,
        		"Workplace" => isset($job->workplace)
        			? match ($job->workplace) {
        				"hybrid" => "Hybrid",
        				"remote" => "Remote",
        				"onSite" => "On site",
        				default => $job->workplace,
        			}
        			: null,
        	]);
        	?>

            <div class="careers-block__card">
                <a class="careers-block__inner" href="<?php echo esc_url($job->apply_url); ?>">
                    <!-- Card title -->
                    <h3 class="careers-block__title">
                        <?php echo esc_html($job->title); ?>
                    </h3>
                    <ul class="careers-block__meta">
                        <?php foreach ($jobMeta as $label => $value): ?>
                            <li>
                                <span class="careers-block__meta-label"><?php echo esc_html($label); ?>:</span>
                                <?php echo esc_html($value); ?>
                            </li>
                        <?php endforeach; ?>
                        <?php if ($locationPart1 || $locationPart2): ?>
                            <li>
                                <span class="careers-block__meta-label">Location:</span>
                                <?php echo esc_html(implode(", ", array_filter([$locationPart1, $locationPart2]))); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </a>
            </div>
        <?php
        } ?>
    <?php } ?>
    <?php if (have_rows("non_cezanne")):
    	while (have_rows("non_cezanne")):
    		the_row(); ?>

            <div class="careers-block__card">
                <a class="careers-block__inner" href="<?php echo get_sub_field("link"); ?>">
                    <!-- Card title -->
                    <h3 class="careers-block__title">
                        <?php echo get_sub_field("title"); ?>
                    </h3>
                    <?php if (get_sub_field("description")) { ?>
                        <div class="careers-block__description">
                            <p><?php echo get_sub_field("description"); ?></p>
                        </div>
                    <?php } ?>

                    <!-- location -->
                    <div class="careers-block__location">
                        <img src="<?php echo get_template_directory_uri() .
                        	"/assets/img/balloon.svg"; ?>" />
                        <p>
                            <?php echo get_sub_field("location"); ?>
                        </p>
                    </div>
                </a>
            </div>

        <?php
    	endwhile;
    else:
    	$emptyNonCezanne = true;

    	if ($emptyNonCezanne == true && $emptyJobs == true): ?>
            <h2 style="text-align: center; grid-column: col2 / col12; opacity:0.5;" class="font-canela">No Vacancies</h2>

    <?php endif;
    endif; ?>


</div><!-- /careers-block -->