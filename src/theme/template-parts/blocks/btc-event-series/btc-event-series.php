<?php

/**
 * btc event series
 *
 */

// Load values and assign defaults.
$margin_bottom_mobile = get_field('margin_bottom_mobile') ?: '40px';
$margin_bottom_desktop = get_field('margin_bottom_desktop') ?: '80px';
$event_category = get_field('event_category');
$big_card_image = get_field('big_card_image') ?: '309';
$big_card_text = get_field('big_card_text') ?: 'Add some text...';
$learn_more_link = get_field('learn_more_link');
$featured_posts = get_field('featured_posts');
$today = date('Ymd');
$expiry = get_field('expiry');
?>

<?php if ($today <= $expiry) : ?>
    <?php if ($event_category) : ?>

        <div class="better-grid hfj-block event-series event-series--btc" style="--margin-bottom-mobile:<?php echo $margin_bottom_mobile ?>; --margin-bottom-desktop: <?php echo $margin_bottom_desktop ?>;">

            <div class="event-series__big-card">
                <div class="event-series__big-card-image"><?php echo wp_get_attachment_image($big_card_image, 'full') ?></div>
                <div class="event-series__big-card-content">
                    <svg id="Group_7763" data-name="Group 7763" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 473.461 87.264">
                        <defs>
                            <clipPath id="clip-path">
                                <rect id="Rectangle_3224" data-name="Rectangle 3224" width="473.461" height="87.264" fill="#fff" />
                            </clipPath>
                        </defs>
                        <g id="Group_7472" data-name="Group 7472" transform="translate(0 0)" clip-path="url(#clip-path)">
                            <path id="Path_17473" data-name="Path 17473" d="M9.6,63.05a4.967,4.967,0,1,0,4.946,5,4.938,4.938,0,0,0-4.946-5M9.565,38.83a4.977,4.977,0,1,0,4.978,4.979A4.986,4.986,0,0,0,9.565,38.83m9.612,5.426a9.162,9.162,0,0,1-2.045,5.808c-.074.095-.138.2-.213.292-2.044,2.577-2.179,5.492-1.407,8.516a10.576,10.576,0,0,0,1.08,2.34c.373.686.841,1.319,1.254,1.986a9.555,9.555,0,1,1-16.872.553c.393-.812.871-1.583,1.329-2.361a10.352,10.352,0,0,0,1.431-3.426,12.423,12.423,0,0,0-.088-4.907A7.57,7.57,0,0,0,2.536,50.6c-.363-.555-.751-1.093-1.094-1.66a9.582,9.582,0,1,1,17.611-6.362c.071.555.085,1.12.124,1.68" transform="translate(0 -9.05)" fill="#fff" />
                            <path id="Path_17474" data-name="Path 17474" d="M30.413,88.812a11.839,11.839,0,0,0-9.3,9.223l-5.477-5.467a11.817,11.817,0,0,0,9.206-9.251,70.273,70.273,0,0,1,5.574,5.495" transform="translate(-4.132 -22.021)" fill="#fff" />
                            <path id="Path_17475" data-name="Path 17475" d="M15.833,29.411l5.492-5.493a11.817,11.817,0,0,0,9.234,9.226.338.338,0,0,1,.037.077.081.081,0,0,1-.011.058c-.1.121-.2.247-.316.358q-2.517,2.511-5.04,5.015c-.021.021-.074.014-.157.026a11.838,11.838,0,0,0-9.24-9.268" transform="translate(-4.185 -6.322)" fill="#fff" />
                            <path id="Path_17476" data-name="Path 17476" d="M12.052,48.934a2.637,2.637,0,1,1,2.676-2.594,2.635,2.635,0,0,1-2.676,2.594" transform="translate(-2.493 -11.54)" fill="#fff" />
                            <path id="Path_17477" data-name="Path 17477" d="M9.432,79.169a2.649,2.649,0,0,1,5.3.027,2.649,2.649,0,1,1-5.3-.027" transform="translate(-2.493 -20.234)" fill="#fff" />
                            <path id="Path_17478" data-name="Path 17478" d="M94.762,63.049a4.967,4.967,0,1,0,4.961,5,4.949,4.949,0,0,0-4.961-5m0-24.218a4.976,4.976,0,1,0,4.97,5.007,4.965,4.965,0,0,0-4.97-5.007M85.141,67.6c.089-.767.134-1.389.236-2a7.68,7.68,0,0,1,1.218-2.993,12.313,12.313,0,0,1,.835-1.18c2.5-2.945,2.138-7.988.533-10.455-.438-.672-.864-1.354-1.294-2.033a8.8,8.8,0,0,1-1.321-3.147,9.587,9.587,0,1,1,18.868-3.373,9.891,9.891,0,0,1-1.1,6.124c-.4.764-.85,1.5-1.3,2.238a10.6,10.6,0,0,0-1.151,7.909,7.1,7.1,0,0,0,1.118,2.519c.374.57.769,1.13,1.127,1.71a9.634,9.634,0,0,1-.9,11.291,9.572,9.572,0,0,1-16.694-4.6,16,16,0,0,1-.177-2.014" transform="translate(-22.503 -9.05)" fill="#fff" />
                            <path id="Path_17479" data-name="Path 17479" d="M64.9,102.124a5,5,0,0,0-5.054-4.964,4.983,4.983,0,0,0,.095,9.966,4.988,4.988,0,0,0,4.959-5m-34.144,0a4.967,4.967,0,1,0,4.979-4.96,4.95,4.95,0,0,0-4.979,4.96m5.569-9.617a9.589,9.589,0,0,1,5.738,2.135,8.012,8.012,0,0,0,3.11,1.666A10.066,10.066,0,0,0,52.9,95.272c.736-.451,1.449-.939,2.186-1.389a9.564,9.564,0,1,1,6.285,17.71,9.757,9.757,0,0,1-6.235-1.109c-.8-.421-1.566-.9-2.343-1.363a10.566,10.566,0,0,0-8.041-.987,6.987,6.987,0,0,0-2.23,1.034c-.505.33-1,.678-1.507,1a9.618,9.618,0,0,1-14.7-6.272,9.49,9.49,0,0,1,7.5-11.111c.822-.157,1.67-.189,2.505-.278" transform="translate(-6.909 -24.45)" fill="#fff" />
                            <path id="Path_17480" data-name="Path 17480" d="M117.384,16.225a3.079,3.079,0,1,0,3.085,3.1,3.046,3.046,0,0,0-3.085-3.1m-7.1,19.57A11.91,11.91,0,0,0,101,26.433c-.04-.238.169-.335.3-.465.849-.858,1.7-1.708,2.556-2.559q4.327-4.327,8.652-8.657a6.716,6.716,0,0,1,3.642-1.989,6.663,6.663,0,0,1,5.942,11.252c-.25.262-.511.514-.766.769q-5.241,5.248-10.481,10.494c-.165.164-.341.318-.558.518" transform="translate(-26.694 -3.344)" fill="#fff" />
                            <path id="Path_17481" data-name="Path 17481" d="M75.31,88.943c1.858-1.847,3.676-3.652,5.524-5.489a11.812,11.812,0,0,0,9.2,9.231q-2.728,2.728-5.469,5.468a11.816,11.816,0,0,0-9.257-9.21" transform="translate(-19.905 -22.057)" fill="#fff" />
                            <path id="Path_17482" data-name="Path 17482" d="M97.2,48.936a2.636,2.636,0,1,1,2.666-2.6,2.641,2.641,0,0,1-2.666,2.6" transform="translate(-24.996 -11.54)" fill="#fff" />
                            <path id="Path_17483" data-name="Path 17483" d="M99.868,79.218a2.649,2.649,0,1,1-2.612-2.662,2.661,2.661,0,0,1,2.612,2.662" transform="translate(-24.995 -20.234)" fill="#fff" />
                            <path id="Path_17484" data-name="Path 17484" d="M38.126,107.271a2.643,2.643,0,1,1,2.715-2.612,2.651,2.651,0,0,1-2.715,2.612" transform="translate(-9.393 -26.956)" fill="#fff" />
                            <path id="Path_17485" data-name="Path 17485" d="M71.119,107.271a2.643,2.643,0,1,1,0-5.286,2.643,2.643,0,1,1,0,5.286" transform="translate(-18.092 -26.955)" fill="#fff" />
                            <path id="Path_17486" data-name="Path 17486" d="M35.258,10.581a4.966,4.966,0,1,0-.007,9.933,4.966,4.966,0,0,0,.007-9.933m28.4-.983a4.969,4.969,0,1,0-5,4.943,4.957,4.957,0,0,0,5-4.943m4.651-.045a9.647,9.647,0,0,1-7.726,9.382c-.511.1-1.026.185-1.539.263a7.656,7.656,0,0,1-3.726-.458c-.662-.232-1.31-.509-1.969-.75a7.381,7.381,0,0,0-3.732-.361A10.071,10.071,0,0,0,43.132,21.1c-.358.432-.757.834-1.153,1.232a9.061,9.061,0,0,1-8.151,2.642,9.1,9.1,0,0,1-7.536-6.081,9.523,9.523,0,0,1,7.6-12.81,11.466,11.466,0,0,1,4.932.45c1.056.308,2.131.564,3.205.8a6.36,6.36,0,0,0,2.632-.068c.727-.143,1.444-.34,2.155-.554a7.623,7.623,0,0,0,3.468-2.2c.528-.578,1.037-1.176,1.593-1.726A9.651,9.651,0,0,1,57.769.054,9.539,9.539,0,0,1,68.076,7.706c.118.608.16,1.231.236,1.848" transform="translate(-6.782 0)" fill="#fff" />
                            <path id="Path_17487" data-name="Path 17487" d="M35.116,20.191a2.611,2.611,0,0,1,2.6-2.66,2.651,2.651,0,1,1,.012,5.3,2.593,2.593,0,0,1-2.617-2.641" transform="translate(-9.28 -4.633)" fill="#fff" />
                            <path id="Path_17488" data-name="Path 17488" d="M154.8,90.139a.9.9,0,0,0,1.025,1.021H158.6a2.282,2.282,0,0,0,1.863-.989,3.535,3.535,0,0,0,.77-2.228V75.957a3.5,3.5,0,0,0-.77-2.264,2.32,2.32,0,0,0-1.863-.952h-2.776a.907.907,0,0,0-1.025,1.025Zm0-24.922a.9.9,0,0,0,1.025,1.02H158.6a2.283,2.283,0,0,0,1.863-.988,3.537,3.537,0,0,0,.77-2.228V55.857a3.509,3.509,0,0,0-.77-2.265,2.316,2.316,0,0,0-1.863-.948h-2.776a.9.9,0,0,0-1.025,1.021ZM148.444,96.5V47.381a.905.905,0,0,1,1.021-1.025h11.26a6.452,6.452,0,0,1,4.821,2.156,7.421,7.421,0,0,1,2.047,5.3v9.282q0,4.169-3.217,5.847,3.215,1.683,3.217,5.924v15.2a7.522,7.522,0,0,1-2.083,5.118,6.266,6.266,0,0,1-4.785,2.338h-11.26a.9.9,0,0,1-1.021-1.021" transform="translate(-39.235 -12.252)" fill="#fff" />
                            <path id="Path_17489" data-name="Path 17489" d="M204.151,62.7V55.831a3.259,3.259,0,0,0-.879-2.228,2.664,2.664,0,0,0-2.046-.985h-2.775c-.539,0-.806.243-.806.73v11.62c0,.441.267.66.806.66h2.775a2.774,2.774,0,0,0,2.083-.879,2.864,2.864,0,0,0,.842-2.046m2.776,9.209,5.044,24.776c.1.535-.17.8-.806.8h-4.822c-.393,0-.685-.268-.879-.8L200.569,72.5a.682.682,0,0,0-.733-.511h-1.386c-.539,0-.806.244-.806.729V96.688q0,.8-.73.8h-4.752a.709.709,0,0,1-.8-.8V47.063a.712.712,0,0,1,.8-.806h11.183a6.78,6.78,0,0,1,5.044,2.2,7.213,7.213,0,0,1,2.119,5.186V64.822a6.771,6.771,0,0,1-3.289,5.919.99.99,0,0,0-.291,1.171" transform="translate(-50.578 -12.226)" fill="#fff" />
                            <path id="Path_17490" data-name="Path 17490" d="M242.947,90.211c0,.685.365,1.025,1.1,1.025h10.741a.842.842,0,0,1,.953.948v4.238c0,.733-.345,1.1-1.026,1.1H237.684c-.681,0-1.021-.364-1.021-1.1V47.38a.9.9,0,0,1,1.021-1.021h17.1a.9.9,0,0,1,1.021,1.021V51.7a.9.9,0,0,1-1.021,1.02H243.972a.905.905,0,0,0-1.025,1.026v13.3a.9.9,0,0,0,1.025,1.021h8.622a.908.908,0,0,1,1.025,1.025v4.238a.908.908,0,0,1-1.025,1.025h-8.622a.9.9,0,0,0-1.025,1.021Z" transform="translate(-62.552 -12.253)" fill="#fff" />
                            <path id="Path_17491" data-name="Path 17491" d="M282.221,84.312a.516.516,0,0,0,.584.583h4.46c.438,0,.608-.195.511-.583L285,53.32ZM274.11,96.662l6.5-49.7c.194-.535.461-.806.806-.806h7.236c.388,0,.631.271.73.806q.437,1.393,6.5,49.7.073.8-.731.8h-4.825q-.584,0-.729-.8-.291-1.757-.806-5.482c-.1-.341-.293-.511-.58-.511h-6.434c-.248,0-.414.17-.516.511l-.8,5.482c-.1.535-.365.8-.807.8h-4.748q-.875,0-.8-.8" transform="translate(-72.447 -12.2)" fill="#fff" />
                            <path id="Path_17492" data-name="Path 17492" d="M329.378,69.82l9.428,26.531c.244.782,0,1.17-.733,1.17h-4.384a1.289,1.289,0,0,1-1.24-1.025l-8.334-23.459V96.569c0,.636-.341.952-1.021.952h-3.873c-.733,0-1.1-.316-1.1-.952V47.455a1.121,1.121,0,0,1,1.1-1.094h3.873q1.021,0,1.021,1.094V67.92q1.392-3.726,4.238-11.656t3.217-8.808q.438-1.095,1.021-1.094h4.826a.991.991,0,0,1,.219.036.683.683,0,0,1,.328.292.783.783,0,0,1-.037.766Z" transform="translate(-84.082 -12.254)" fill="#fff" />
                            <path id="Path_17493" data-name="Path 17493" d="M382,65a.33.33,0,0,1,.373.377v2.217a.327.327,0,0,1-.373.372h-2.933a.333.333,0,0,0-.377.377V88.531c0,.247-.114.373-.341.373h-2.217a.332.332,0,0,1-.377-.373V68.338a.333.333,0,0,0-.377-.377h-2.9a.331.331,0,0,1-.377-.372V65.372a.335.335,0,0,1,.377-.377Z" transform="translate(-98.35 -17.179)" fill="#fff" />
                            <path id="Path_17494" data-name="Path 17494" d="M393.019,88.406V65.518a.42.42,0,0,1,.478-.474h1.977a.42.42,0,0,1,.478.474v7.37a.423.423,0,0,0,.478.478h2.456a.423.423,0,0,0,.478-.478v-7.37a.419.419,0,0,1,.475-.474h1.981a.42.42,0,0,1,.478.474V88.406c0,.341-.158.511-.478.511h-1.981a.526.526,0,0,1-.511-.511l.036-11.628a.424.424,0,0,0-.478-.482H396.43a.424.424,0,0,0-.478.482l.032,11.628a.518.518,0,0,1-.511.511H393.5c-.32,0-.478-.17-.478-.511" transform="translate(-103.877 -17.192)" fill="#fff" />
                            <path id="Path_17495" data-name="Path 17495" d="M416.907,85.507c0,.32.17.478.511.478h5.016a.389.389,0,0,1,.441.441V88.4c0,.344-.158.514-.478.514h-7.945c-.321,0-.478-.17-.478-.514V65.519a.423.423,0,0,1,.478-.477h7.982a.422.422,0,0,1,.474.477v2.014a.419.419,0,0,1-.474.474h-5.048a.423.423,0,0,0-.478.478v6.207a.422.422,0,0,0,.478.478h4.024a.423.423,0,0,1,.477.478V77.63a.42.42,0,0,1-.477.474h-4.024a.423.423,0,0,0-.478.478Z" transform="translate(-109.416 -17.191)" fill="#fff" />
                            <path id="Path_17496" data-name="Path 17496" d="M468.73,58.551a.563.563,0,0,1-.583-.182.92.92,0,0,1-.219-.619v-2.12q0-3.367-3.294-3.363-3.215,0-3.213,3.363V88.59q0,3.434,3.213,3.436,3.294,0,3.294-3.436V86.471a.71.71,0,0,1,.8-.806l4.457.3a.778.778,0,0,1,.734.8v3.582a6.994,6.994,0,0,1-2.817,6.1,10.837,10.837,0,0,1-6.47,2.009,10,10,0,0,1-6.722-2.3q-2.7-2.3-2.7-7.345v-33.4q0-4.965,2.7-7.269a10.01,10.01,0,0,1,6.722-2.3,11.809,11.809,0,0,1,6.47,1.791,6.086,6.086,0,0,1,2.817,5.518v4.092c0,.441-.247.685-.734.733Z" transform="translate(-120.315 -12.114)" fill="#fff" />
                            <path id="Path_17497" data-name="Path 17497" d="M500.724,84.613l-7.674-36.98c-.1-.539.17-.806.8-.806h4.242a1.154,1.154,0,0,1,1.24,1.17l4.534,26.385L508.253,48q.218-1.172,1.167-1.17h4.388q1.021,0,.729,1.17l-7.6,36.615V96.967a.9.9,0,0,1-1.021,1.021h-4.165a.9.9,0,0,1-1.025-1.021Z" transform="translate(-130.311 -12.377)" fill="#fff" />
                            <path id="Path_17498" data-name="Path 17498" d="M549.693,58.551a.576.576,0,0,1-.588-.182.941.941,0,0,1-.215-.619v-2.12q0-3.367-3.294-3.363-3.215,0-3.213,3.363V88.59q0,3.434,3.213,3.436,3.294,0,3.294-3.436V86.471a.711.711,0,0,1,.8-.806l4.457.3a.778.778,0,0,1,.734.8v3.582a6.994,6.994,0,0,1-2.816,6.1,10.838,10.838,0,0,1-6.47,2.009,10.006,10.006,0,0,1-6.722-2.3q-2.7-2.3-2.7-7.345v-33.4q0-4.965,2.7-7.269a10.012,10.012,0,0,1,6.722-2.3,11.811,11.811,0,0,1,6.47,1.791,6.086,6.086,0,0,1,2.816,5.518v4.092c0,.441-.247.685-.734.733Z" transform="translate(-141.714 -12.114)" fill="#fff" />
                            <path id="Path_17499" data-name="Path 17499" d="M584.453,91.63H595.2a.9.9,0,0,1,1.021,1.021v4.242q0,1.094-1.021,1.094H578.1a1.119,1.119,0,0,1-.734-.328,1,1,0,0,1-.365-.766v-49.7c0-.045.061-.121.187-.219a.717.717,0,0,1,.47-.146h5.19a.613.613,0,0,1,.441.146.418.418,0,0,1,.142.3v43.34a.9.9,0,0,0,1.025,1.021" transform="translate(-152.504 -12.376)" fill="#fff" />
                            <path id="Path_17500" data-name="Path 17500" d="M623.819,90.681q0,1.021,1.1,1.021h10.741a.844.844,0,0,1,.953.952v4.238c0,.733-.345,1.1-1.026,1.1H618.556c-.681,0-1.021-.364-1.021-1.1V47.85a.9.9,0,0,1,1.021-1.021h17.1a.9.9,0,0,1,1.021,1.021v4.316a.9.9,0,0,1-1.021,1.02H624.844a.905.905,0,0,0-1.025,1.026v13.3a.9.9,0,0,0,1.025,1.021h8.623a.908.908,0,0,1,1.024,1.025V73.8a.908.908,0,0,1-1.024,1.025h-8.623a.9.9,0,0,0-1.025,1.021Z" transform="translate(-163.218 -12.377)" fill="#fff" />
                            <rect id="Rectangle_3222" data-name="Rectangle 3222" width="39.812" height="2.435" transform="translate(273.621 34.458)" fill="#fff" />
                            <rect id="Rectangle_3223" data-name="Rectangle 3223" width="39.812" height="2.435" transform="translate(273.621 82.495)" fill="#fff" />
                        </g>
                    </svg>

                    <p class="block-text event-series__big-card-text"><?php echo $big_card_text ?></p>
                    <div class="event-series__big-card-links">
                        <a style="color:white; text-decoration:underline;" href="<?php echo $learn_more_link ?>">Learn more</a>
                        <div><a href="<?php echo get_term_link($event_category) ?>" class="button button--tighter button--white">See all events</a></div>
                    </div>
                </div>
            </div>
            <?php

            if ($featured_posts) : ?>
                <?php foreach ($featured_posts as $featured_post) : ?>
                    <?php
                    $event_date_start = get_field('event_date_start', $featured_post->ID);
                    $event_location = get_field('event_location', $featured_post->ID);
                    $event_date_end = get_field('event_date_end', $featured_post->ID);
                    $link = get_field('link', $featured_post->ID) ?: get_permalink($featured_post->ID);
                    $title = get_the_title($featured_post->ID);
                    //modify date formats
                    $start_date_mod = date("M j", strtotime($event_date_start));
                    $end_date_mod = date("M j", strtotime($event_date_end));
                    $event_type = get_field('event_type', $featured_post->ID);

                    ?>

                    <a <?php if (!is_admin()) echo 'href="' . $link . '"' ?> class="event-series__event">

                        <div class="event-series__event-content">

                            <div class="event-series__time-location">
                                <div class="event-series__event-time">
                                    <svg id="Group_7762" data-name="Group 7762" xmlns="http://www.w3.org/2000/svg" width="11.819" height="11.82" viewBox="0 0 11.819 11.82">
                                        <path id="Path_17202" data-name="Path 17202" d="M5.91,11.819a5.91,5.91,0,1,1,5.91-5.91,5.916,5.916,0,0,1-5.91,5.91M5.91.985A4.925,4.925,0,1,0,10.834,5.91,4.93,4.93,0,0,0,5.91.985" transform="translate(0 0)" fill="#212322" />
                                        <path id="Path_17203" data-name="Path 17203" d="M7.04,7.109H6.969a.4.4,0,0,1-.4-.4V3.567a.4.4,0,0,1,.4-.4H7.04a.4.4,0,0,1,.4.4V6.711a.4.4,0,0,1-.4.4" transform="translate(-1.095 -0.528)" fill="#212322" />
                                        <path id="Path_17204" data-name="Path 17204" d="M6.569,7.237l.089-.1a.367.367,0,0,1,.519-.021L8.949,8.754a.367.367,0,0,1,.021.518l-.091.1a.365.365,0,0,1-.517.021L6.589,7.755a.366.366,0,0,1-.02-.518" transform="translate(-1.078 -1.17)" fill="#212322" />
                                    </svg>
                                    <p><?php if ($event_date_start) echo $start_date_mod . ' - ' ?><?php echo $end_date_mod ?></p>
                                </div>
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
                            <p class="event-series__event-title">
                                <b><?php echo $title ?><span class="event-series__event-arrow">&nbsp;<img src="<?php echo get_template_directory_uri() . '/assets/img/link-arrow.svg'; ?>"></span>
                                </b>
                            </p>
                        </div>
                    </a>
                <?php endforeach; ?>

        </div>


    <?php endif; ?>

    <?php
        // Reset the global post object so that the rest of the page works correctly.
        wp_reset_postdata(); ?>

<?php else : ?>
    <?php if (is_admin()) echo "<p>Setup this block with featured posts and an event category to get started</p>" ?>
<?php endif; ?>
<?php else : ?>
    <?php if (is_admin()) echo "This content has expired. You can edit the settings or delete it.</p>" ?>
<?php endif; ?>