<?php

//Get Currency=value from the url
$currency = $_GET["Currency"];
$use_donation_app = get_field("use_donation_app") ?: false;
$frequency = get_field("frequency_settings");
$frequency_start = get_field("frequency_start");
$image = get_field("image");
$image_uk = get_field("image_uk") ?: false;
$image_us = get_field("image_us") ?: false;
$image_au = get_field("image_au") ?: false;
$image_nok = get_field("image_nok") ?: false;
$image_eur = get_field("image_eur") ?: false;
$margin_bottom_mobile = get_field("margin_bottom_mobile");
$margin_bottom_desktop = get_field("margin_bottom_desktop");
$extra_graphic = get_field("extra_graphic");
$thank_you = urlencode(get_field("custom_thankyou"));
$tracked = get_field("tracked") ?: "false";
//used for the donation app to track the campaign
//if the campaign is set in the url, use that instead of whats in the donate block ACF
$url_campaign = $_GET["campaign"] ?: null;

$campaign = get_field("campaign") ?: null;
if ($url_campaign) {
	$campaign = $url_campaign;
}

$extra_text = get_field("extra_text") ?: false;
$background_color = get_field("background_color") ?: "#ffffff";
$overlay_color = get_field("overlay_color");

$title_img = get_field("title_img");
$form_image = get_field("form_img");

if (
	//if they are in the USA array or they want to give in $
	($GLOBALS["userInfo"] &&
		in_array($GLOBALS["userInfo"], $GLOBALS["usa_currency"]) &&
		$currency != "NOK" &&
		$currency != "GBP" &&
		$currency != "AUD" &&
		$currency != "EUR") ||
	$currency == "USD"
) {
	$currency = "USD";
	$settings = "usa_donate";
	$symbol = '$';
	$image = $image_us ?: $image;
} elseif (
	// if they are in Norway or want to give in Kr
	($GLOBALS["userInfo"] &&
		in_array($GLOBALS["userInfo"], $GLOBALS["norway_currency"]) &&
		$currency != "USD" &&
		$currency != "GBP" &&
		$currency != "AUD" &&
		$currency != "EUR") ||
	$currency == "NOK"
) {
	$currency = "NOK";
	$settings = "no_donate";
	$symbol = "&nbsp;kr";
	$image = $image_nok ?: $image;
} elseif (
	// if they are in AU or want to give in AUD
	($GLOBALS["userInfo"] &&
		in_array($GLOBALS["userInfo"], $GLOBALS["au_currency"]) &&
		$currency != "USD" &&
		$currency != "GBP" &&
		$currency != "NOK" &&
		$currency != "EUR") ||
	$currency == "AUD"
) {
	$currency = "AUD";
	$settings = "au_donate";
	$symbol = '$';
	$image = $image_au ?: $image;
} elseif (
	// if they are in Eurozone countries or want to give in EUR
	($GLOBALS["userInfo"] &&
		in_array($GLOBALS["userInfo"], $GLOBALS["eur_currency"]) &&
		$currency != "USD" &&
		$currency != "GBP" &&
		$currency != "NOK" &&
		$currency != "AUD") ||
	$currency == "EUR"
) {
	$currency = "EUR";
	$settings = "eur_donate";
	$symbol = "€";
	$image = $image_eur ?: $image;
} else {
	// fallback to UK
	$currency = "GBP";
	$settings = "uk_donate";
	$symbol = "£";
	$image = $image_uk ?: $image;
}
?>

<?php // preview countries in admin

if (is_admin()) {
	$preview = get_field("preview") ?: "uk_donate";
	$settings = $preview;
	if ($settings == "uk_donate") {
		$currency = "GBP";
		$symbol = "£";
	} elseif ($settings == "no_donate") {
		$currency = "NOK";
		$symbol = "Kr";
	} elseif ($settings == "au_donate") {
		$currency = "AUD";
		$symbol = '$';
	} elseif ($settings == "eur_donate") {
		$currency = "EUR";
		$symbol = "€";
	} else {
		$currency = "USD";
		$symbol = '$';
	}
} ?>

<?php $min_custom_amount = $currency == "NOK" ? 20 : 2; ?>


<!-- render the block -->
<?php
$set = get_field($settings);
//subfields
$once_title = $set["once_title"];
$monthly_title = $set["monthly_title"];
$once_text = $set["once_text"];
$monthly_text = $set["monthly_text"];
$widget_id_once = $set["widget_id_once"];
$widget_id_monthly = $set["widget_id_monthly"];
$email_event_once = $set["email_event_once"];
$email_event_monthly = $set["email_event_monthly"];
$target = $set["target"];
$offline_amount = $set["offline_amount"] ?: 0;
//option a
$amount_once_a = $set["amount_once_a"];
$amount_monthly_a = $set["amount_monthly_a"];
$reason_once_a = $set["reason_once_a"];
$reason_monthly_a = $set["reason_monthly_a"];
//option b
$amount_once_b = $set["amount_once_b"];
$amount_monthly_b = $set["amount_monthly_b"];
$reason_once_b = $set["reason_once_b"];
$reason_monthly_b = $set["reason_monthly_b"];
//option c
$amount_once_c = $set["amount_once_c"];
$amount_monthly_c = $set["amount_monthly_c"];
$reason_once_c = $set["reason_once_c"];
$reason_monthly_c = $set["reason_monthly_c"];
//option d
$amount_once_d = $set["amount_once_d"];
$amount_monthly_d = $set["amount_monthly_d"];
$reason_once_d = $set["reason_once_d"];
$reason_monthly_d = $set["reason_monthly_d"];
//option e
$amount_once_e = $set["amount_once_e"];
$amount_monthly_e = $set["amount_monthly_e"];
$reason_once_e = $set["reason_once_e"];
$reason_monthly_e = $set["reason_monthly_e"];
//option f
$reason_once_f = $set["reason_once_f"];
$reason_monthly_f = $set["reason_monthly_f"];
//norway link
//$link = $set['norway_link'];
//default level
$default_level = $set["default_level"] ?: "c";
//default level
$other_ways_link = $set["other_ways"];

//parses a giving-level url value - a plain number ("20"), or a base amount plus/minus
//a modifier ("20+10"), optionally "pc" suffixed to treat the modifier as a percentage
//of the base ("20+10pc" = 20 + 10% of 20 = 22), rounded to the nearest whole number
if (!function_exists("parse_giving_level_amount")) {
	function parse_giving_level_amount($value)
	{
		$value = trim($value);

		if (is_numeric($value)) {
			return floatval($value);
		}

		//a literal "+" in a url query string is decoded as a space unless it was
		//percent-encoded as %2B, so treat a plain space between the numbers the same as "+"
		$value = preg_replace('/^(\d+(?:\.\d+)?)\s+(\d+(?:\.\d+)?)(pc)?$/i', '$1+$2$3', $value);

		if (preg_match('/^(\d+(?:\.\d+)?)([+-])(\d+(?:\.\d+)?)(pc)?$/i', $value, $matches)) {
			$base = floatval($matches[1]);
			$operator = $matches[2];
			$modifier = floatval($matches[3]);
			$is_percentage = !empty($matches[4]);

			if ($is_percentage) {
				$change = $base * ($modifier / 100);
				$result = $operator === "+" ? $base + $change : $base - $change;
				return round($result);
			}

			return $operator === "+" ? $base + $modifier : $base - $modifier;
		}

		return null;
	}
}

//giving level overrides from the url
//once amounts: gl-a, gl-b, gl-c, gl-d, gl-e
//monthly amounts: glm-a, glm-b, glm-c, glm-d, glm-e
//passing 0 or false for either hides that giving level entirely for that frequency
$hidden_once = [];
$hidden_monthly = [];
$has_custom_giving_levels = false;

foreach (["a", "b", "c", "d", "e"] as $letter) {
	$gl_value = isset($_GET["gl-$letter"]) ? $_GET["gl-$letter"] : null;
	if ($gl_value !== null) {
		$has_custom_giving_levels = true;
		if (in_array(strtolower(trim($gl_value)), ["0", "false"], true)) {
			$hidden_once[$letter] = true;
		} else {
			$parsed_amount = parse_giving_level_amount($gl_value);
			if ($parsed_amount !== null) {
				${"amount_once_$letter"} = $parsed_amount;
			}
		}
	}

	$glm_value = isset($_GET["glm-$letter"]) ? $_GET["glm-$letter"] : null;
	if ($glm_value !== null) {
		$has_custom_giving_levels = true;
		if (in_array(strtolower(trim($glm_value)), ["0", "false"], true)) {
			$hidden_monthly[$letter] = true;
		} else {
			$parsed_amount = parse_giving_level_amount($glm_value);
			if ($parsed_amount !== null) {
				${"amount_monthly_$letter"} = $parsed_amount;
			}
		}
	}
}

//the frequency tab active on first render, used to decide which giving levels start hidden
$initial_freq = $frequency == "once" || $frequency_start == "once" ? "once" : "monthly";

//url overrides for which button is highlighted by default - "suggested" for the once view, "suggested-m" for the monthly view
$default_level_once = $default_level;
$default_level_monthly = $default_level;

$url_suggested = $_GET["suggested"] ?: null;
if ($url_suggested && in_array(strtolower($url_suggested), ["a", "b", "c", "d", "e"])) {
	$default_level_once = strtolower($url_suggested);
}

$url_suggested_monthly = $_GET["suggested-m"] ?: null;
if (
	$url_suggested_monthly &&
	in_array(strtolower($url_suggested_monthly), ["a", "b", "c", "d", "e"])
) {
	$default_level_monthly = strtolower($url_suggested_monthly);
}

//the default level for whichever frequency is shown first
$default_level = $initial_freq == "once" ? $default_level_once : $default_level_monthly;

//url override for showing the impact/reason text - defaults to false if a custom giving level was passed in the url
$url_impact = $_GET["impact"] ?: null;
if ($url_impact !== null) {
	$show_impact = strtolower($url_impact) === "true";
} else {
	$show_impact = !$has_custom_giving_levels;
}
?>

<?php //get tracked campaign amount from wp database

if ($tracked && $target) {
	global $wpdb;
	$table = $wpdb->prefix . $tracked;

	if (!function_exists("get_amount")) {
		function get_amount($wpdb, $table, $currency)
		{
			$donations = $wpdb->get_results("SELECT * FROM $table");
			$amount = 0.0;
			// if (!empty($donations)) {
			// 	foreach ($donations as $donation) {
			// 		if ($currency == "USD") {
			// 			$amount += $donation->amount_usd;
			// 		} else {
			// 			$amount += $donation->amount_gbp;
			// 		}
			// 	}
			// }
			foreach ($donations as $donation) {
				$amount += $donation->amount;
			}
			return $amount;
		}
	}

	$amount = get_amount($wpdb, $table, $currency);

	$grand_total = $amount + $offline_amount;
	$amount_left = $target - $grand_total; // possibly need to parse a float here
	//$doubled = $amount * 2;
	$percentage = ($grand_total / $target) * 100;

	//$matchfunded = true;

	// if ($amount >= 10000) {
	//     $matchfunded = false;
	// }
} ?>

<!-- <div style="margin: 40px 0;">
    Tracking code: <?php echo $tracked; ?>
    <br>
    User Currency: <?php echo $currency; ?>
    <br>
    Online total: <?php echo $amount; ?>
    <br>
    Offline Amount: <?php echo $offline_amount; ?>
    <br>
    Grand Total: <?php echo $grand_total; ?>
    <br>
    Target: <?php echo $target; ?>
    <br>
    Percentage to total: <?php echo $percentage; ?>
</div> -->

<div class="donate-block__container donate-block__container--<?php echo $currency; ?>" data-image="<?php if (
	$form_image
) {
	echo $image;
} ?>" style="--margin-bottom-mobile:<?php echo $margin_bottom_mobile; ?>; --margin-bottom-desktop: <?php echo $margin_bottom_desktop; ?>; --overlay-color: <?php echo $overlay_color; ?>; --background-color: <?php echo $background_color; ?>;">

    <div class="donate-block__img <?php if ($extra_text) {
    	echo "donate-block__img--bottom";
    } ?>" style="background-image: url('<?php echo $image; ?>');">

    </div>

    <!-- <div class="donate-block__video">
        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/892188383?badge=0&amp;autopause=0&amp;quality_selector=1&amp;player_id=0&amp;app_id=58479&amp;autoplay=1&amp;loop=1&amp;muted=1&amp;background=1" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Megan's Story Loop"></iframe></div>
        <script src="https://player.vimeo.com/api/player.js"></script>
    </div> -->

    <?php if ($extra_graphic) { ?>
        <div class="donate-block__extra-graphic">
            <?php echo wp_get_attachment_image($extra_graphic, "full"); ?>
        </div>
    <?php } ?>

    <div class="better-grid donate-block__grid">
        <!-- text area -->
        <?php if ($extra_text) { ?>

            <div class="donate-block__extra-text">
                <InnerBlocks />
            </div>
        <?php } ?>

        <!-- donate widget -->
        <div data-tracked="<?php echo $tracked; ?>" data-thankyou="<?php echo $thank_you; ?>" data-emaileventonce="<?php echo $email_event_once; ?>" data-emaileventmonthly="<?php echo $email_event_monthly; ?>" data-campaign="<?php echo $campaign; ?>" data-currency="<?php echo $currency; ?>"
        data-minamount="<?php echo $min_custom_amount; ?>"
        data-usedonationapp="<?php echo $use_donation_app; ?>" class="donate-block <?php if (
	!$show_impact
) {
	echo "donate-block--hide-impact";
} ?>" <?php if (
	$widget_id_once
) { ?> data-widgetidonce="<?php echo $widget_id_once; ?>" <?php } ?> <?php if (
 	$widget_id_monthly
 ) { ?> data-widgetidmonthly="<?php echo $widget_id_monthly; ?>" <?php } ?>>


            <div style="<?php if ($frequency == "once") {
            	echo "display:none;";
            } ?>" class="donate-block__freq">
                <div class="donate-block__freq-option <?php if (
                	$frequency == "once" ||
                	$frequency_start == "once"
                ) {
                	echo "donate-block__freq-option--active";
                } ?>" data-freq="once">
                    <?php if ($currency == "NOK") { ?>
                        Gi en enkeltgave
                    <?php } else { ?>
                        &nbsp;Once
                    <?php } ?>
                </div>
                <div class="donate-block__freq-option <?php if (
                	$frequency != "once" &&
                	$frequency_start == "monthly"
                ) {
                	echo "donate-block__freq-option--active";
                } ?>" data-freq="monthly">
                    <?php if ($currency == "NOK") { ?>
                        Gi månedlig
                    <?php } else { ?>
                        &nbsp;Monthly
                    <?php } ?>
                </div>
            </div>



            <?php if ($title_img) { ?>
                <div class="donate-block__title-img">
                    <?php echo wp_get_attachment_image($title_img, "full"); ?>
                </div>
            <?php } else { ?>
                <h2 class="font-fk donate-block__title">
                    <?php echo $monthly_title; ?>
                </h2>

                <h2 class="font-fk donate-block__title donate-block__title--once">
                    <?php echo $once_title; ?>
                </h2>
            <?php } ?>
            <p class="donate-block__text donate-block__top-text">
                <?php echo $monthly_text; ?>
            </p>

            <p class="donate-block__text donate-block__top-text--once">
                <?php echo $once_text; ?>
            </p>

            <?php if ($tracked !== "false" && ($currency == "USD" || $currency == "GBP")) { ?>

                <div class="donate-block__tracker">
                    <div class="donate-block__tracker-bar">
                        <div class="donate-block__tracker-bar-inner" style="--total-percentage: <?php echo $percentage; ?>%">
                        </div>
                    </div>
                    <div class="donate-block__tracker-bar-info">
                        <div class="donate-block__tracker-bar-info-total">
                            <span style="color: var(--red)"><?php echo $symbol; ?><span class="donate-block__tracker-bar-info-total-amount"><?php echo number_format(
	$grand_total,
	2
); ?></span></span>
                            Raised so far
                        </div>
                        <div class="donate-block__tracker-bar-info-target">
                            Target: <?php echo $symbol; ?><span class="donate-block__tracker-bar-info-target-amount"><?php echo number_format(
	$target,
	0
); ?></span>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <div class="donate-block__options">
                <div class="donate-block__options-option <?php if ($default_level == "a") {
                	echo "donate-block__options-option--active";
                } ?>" style="<?php if (
	$initial_freq == "once"
		? !empty($hidden_once["a"])
		: !empty($hidden_monthly["a"])
) {
	echo "display:none;";
} ?>" data-amount="<?php echo $amount_once_a; ?>" data-amountmonthly="<?php echo $amount_monthly_a; ?>" data-hideonce="<?php echo !empty(
	$hidden_once["a"]
)
	? "true"
	: "false"; ?>" data-hidemonthly="<?php echo !empty($hidden_monthly["a"]) ? "true" : "false"; ?>" data-defaultonce="<?php echo $default_level_once ==
"a"
	? "true"
	: "false"; ?>" data-defaultmonthly="<?php echo $default_level_monthly ==
"a"
	? "true"
	: "false"; ?>" data-reason="<?php echo htmlspecialchars(
	$reason_once_a
); ?>" data-monthly="<?php echo htmlspecialchars($reason_monthly_a); ?>">
                    <span class="currency"><?php echo $symbol; ?></span>
                    <span class="donate-block__options-amount">
                        <?php echo $amount_monthly_a; ?>
                    </span>
                </div>

                <div class="donate-block__options-option <?php if ($default_level == "b") {
                	echo "donate-block__options-option--active";
                } ?>" style="<?php if (
	$initial_freq == "once"
		? !empty($hidden_once["b"])
		: !empty($hidden_monthly["b"])
) {
	echo "display:none;";
} ?>" data-amount="<?php echo $amount_once_b; ?>" data-amountmonthly="<?php echo $amount_monthly_b; ?>" data-hideonce="<?php echo !empty(
	$hidden_once["b"]
)
	? "true"
	: "false"; ?>" data-hidemonthly="<?php echo !empty($hidden_monthly["b"]) ? "true" : "false"; ?>" data-defaultonce="<?php echo $default_level_once ==
"b"
	? "true"
	: "false"; ?>" data-defaultmonthly="<?php echo $default_level_monthly ==
"b"
	? "true"
	: "false"; ?>" data-reason="<?php echo htmlspecialchars(
	$reason_once_b
); ?>" data-monthly="<?php echo htmlspecialchars($reason_monthly_b); ?>">
                    <span class="currency"><?php echo $symbol; ?></span>
                    <span class="donate-block__options-amount">
                        <?php echo $amount_monthly_b; ?>
                    </span>
                </div>

                <div class="donate-block__options-option <?php if ($default_level == "c") {
                	echo "donate-block__options-option--active";
                } ?>" style="<?php if (
	$initial_freq == "once"
		? !empty($hidden_once["c"])
		: !empty($hidden_monthly["c"])
) {
	echo "display:none;";
} ?>" data-amount="<?php echo $amount_once_c; ?>" data-amountmonthly="<?php echo $amount_monthly_c; ?>" data-hideonce="<?php echo !empty(
	$hidden_once["c"]
)
	? "true"
	: "false"; ?>" data-hidemonthly="<?php echo !empty($hidden_monthly["c"]) ? "true" : "false"; ?>" data-defaultonce="<?php echo $default_level_once ==
"c"
	? "true"
	: "false"; ?>" data-defaultmonthly="<?php echo $default_level_monthly ==
"c"
	? "true"
	: "false"; ?>" data-reason="<?php echo htmlspecialchars(
	$reason_once_c
); ?>" data-monthly="<?php echo htmlspecialchars($reason_monthly_c); ?>">
                    <span class="currency"><?php echo $symbol; ?></span>
                    <span class="donate-block__options-amount">
                        <?php echo $amount_monthly_c; ?>
                    </span>
                </div>

                <div class="donate-block__options-option <?php if ($default_level == "d") {
                	echo "donate-block__options-option--active";
                } ?>" style="<?php if (
	$initial_freq == "once"
		? !empty($hidden_once["d"])
		: !empty($hidden_monthly["d"])
) {
	echo "display:none;";
} ?>" data-amount="<?php echo $amount_once_d; ?>" data-amountmonthly="<?php echo $amount_monthly_d; ?>" data-hideonce="<?php echo !empty(
	$hidden_once["d"]
)
	? "true"
	: "false"; ?>" data-hidemonthly="<?php echo !empty($hidden_monthly["d"]) ? "true" : "false"; ?>" data-defaultonce="<?php echo $default_level_once ==
"d"
	? "true"
	: "false"; ?>" data-defaultmonthly="<?php echo $default_level_monthly ==
"d"
	? "true"
	: "false"; ?>" data-reason="<?php echo htmlspecialchars(
	$reason_once_d
); ?>" data-monthly="<?php echo htmlspecialchars($reason_monthly_d); ?>">
                    <span class="currency"><?php echo $symbol; ?></span>
                    <span class="donate-block__options-amount">
                        <?php echo $amount_monthly_d; ?>
                    </span>
                </div>

                <div class="donate-block__options-option <?php if ($default_level == "e") {
                	echo "donate-block__options-option--active";
                } ?>" style="<?php if (
	$initial_freq == "once"
		? !empty($hidden_once["e"])
		: !empty($hidden_monthly["e"])
) {
	echo "display:none;";
} ?>" data-amount="<?php echo $amount_once_e; ?>" data-amountmonthly="<?php echo $amount_monthly_e; ?>" data-hideonce="<?php echo !empty(
	$hidden_once["e"]
)
	? "true"
	: "false"; ?>" data-hidemonthly="<?php echo !empty($hidden_monthly["e"]) ? "true" : "false"; ?>" data-defaultonce="<?php echo $default_level_once ==
"e"
	? "true"
	: "false"; ?>" data-defaultmonthly="<?php echo $default_level_monthly ==
"e"
	? "true"
	: "false"; ?>" data-reason="<?php echo htmlspecialchars(
	$reason_once_e
); ?>" data-monthly="<?php echo htmlspecialchars($reason_monthly_e); ?>">
                    <span class="currency"><?php echo $symbol; ?></span>
                    <span class="donate-block__options-amount">
                        <?php echo $amount_monthly_e; ?>
                    </span>
                </div>

                <div class="donate-block__options-option donate-block__options-option--custom" data-amount="custom" data-reason="<?php echo htmlspecialchars(
                	$reason_once_f
                ); ?>" data-monthly="<?php echo htmlspecialchars($reason_monthly_f); ?>">
                    <span class="text">
                        <?php if ($currency == "NOK") { ?>
                            Valgfritt<br />beløp
                        <?php } else { ?>
                            Custom<br />Amount
                        <?php } ?>
                    </span>
                    <span class="currency"><?php echo $symbol; ?></span>
                    <input id="customAmount" style="display: none" type="number" name="customAmount" min="<?php echo $min_custom_amount; ?>" />
                </div>
            </div>

            <p class="donate-block__text" id="impactText">
                <span class="color-red">
                    <b><span class="donate-block__text-currency"><?php
                    if ($currency !== "NOK") {
                    	echo $currency . " ";
                    }
                    echo $symbol;
                    ?></span><span class="donate-block__text-amount"></span></b>
                </span>
                <span class="donate-block__text-freq">
                    <?php if ($currency == "NOK") { ?>
                        månedlig
                    <?php } else { ?>
                        monthly
                    <?php } ?>
                </span>
                <span id="reason"></span>
            </p>

            <p class="donate-block__error" style="display: none; text-align:center; width:100%;">
                <?php if ($currency == "NOK") { ?>
                    Please enter a donation of <?php echo $min_custom_amount; ?> kr or higher
                <?php } else { ?>
                    Please enter a donation of <?php echo $symbol . $min_custom_amount; ?> or higher
                <?php } ?>
            </p>

            <div class="donate-block__button">
                <?php if ($currency == "NOK") { ?>
                    Gi
                <?php } else { ?>
                    Donate
                <?php } ?>
                <span class="donate-block__button-currency currency"><?php
                if ($currency !== "NOK") {
                	echo $currency . " ";
                }
                echo $symbol;
                ?></span><span class="donate-block__button-amount"></span>
                <span class="donate-block__button-freq"></span>
            </div>
                    <div class="donate-block__other-ways">
                    <a href="<?php echo $currency == "usd" || "gbp"
                    	? "#other-ways"
                    	: $other_ways_link; ?>">
                        <?php if ($currency == "NOK") { ?>
                            Andre måter å gi
                        <?php } else { ?>
                            Other ways to give
                        <?php } ?>
                    </a>
                    <div class="donate-block__other-ways-divider color-red">|</div>
                
                <a data-toggle="modal" data-target="#currencyModal" id="changeCurrency">
                    <?php if ($currency == "NOK") { ?>
                        Endre valuta
                    <?php } else { ?>
                        Change currency
                    <?php } ?>
                </a>
            </div>
            <?php if (($currency == "GBP" || $currency == "USD") && $use_donation_app) { ?>
            <div class="donate-block__payment-methods">
                <ul>

                    <li class="donate-block__payment-methods-applepay"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/applepay.svg" alt="Apple Pay" /></li>
                    <li class="donate-block__payment-methods-googlepay"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/googlepay.svg" alt="Google Pay" /></li>
                    <li class="donate-block__payment-methods-paypal"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/paypal.png" alt="PayPal" /></li>
                    <?php if ($currency == "GBP") { ?>
                    <li class="donate-block__payment-methods-banktransfer"><img  src="<?php echo get_template_directory_uri(); ?>/assets/img/banktransfer.svg" alt="Bank Transfer" /></li>
                    <?php } ?>
                    <li class="donate-block__payment-methods-visa"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/visa.svg" alt="Visa" /></li>
                    <li class="donate-block__payment-methods-mastercard"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mastercard.svg" alt="Master Card" /></li>
                    <?php if ($currency == "USD") { ?>
                    <li class="donate-block__payment-methods-amex"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/amex.svg" alt="Amex" /></li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </div>

    </div>
</div>
<?php  ?>


<!-- 
-- 
-- currency modal
-- 
-->
<?php if (!is_admin()) {
	get_template_part("partials/content", "modal", [
		"type" => "currency-select",
		"id" => "currencyModal",
	]);
}
?>
