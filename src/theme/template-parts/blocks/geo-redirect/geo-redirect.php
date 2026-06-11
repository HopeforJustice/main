<?php

/**
 * geo-redirect
 * Server-side redirect handled via template_redirect hook in functions.php.
 * This template only renders in the block editor to show the configured URLs.
 */

if (!is_admin()) {
    return;
}

$rows = [
    "UK"           => ["label" => "UK",              "field" => "redirect_url_uk"],
    "USA"          => ["label" => "USA",             "field" => "redirect_url_usa"],
    "NOK"          => ["label" => "Norway",          "field" => "redirect_url_nok"],
    "AUS"          => ["label" => "Australia / NZ",  "field" => "redirect_url_aus"],
    "EUR"          => ["label" => "Eurozone",        "field" => "redirect_url_eur"],
    "Default/Other"=> ["label" => "Default / Other", "field" => "redirect_url_default"],
];

?>
<div class="geo-redirect geo-redirect--admin" style="padding:12px;background:#f6f7f7;border-left:4px solid #d6001c;font-family:monospace;font-size:13px;">
    <p style="margin:0 0 8px;font-weight:bold;">Geo Redirect</p>
    <?php foreach ($rows as $row):
        $url = get_field($row["field"]) ?: "—";
    ?>
    <div style="margin:2px 0;">
        <?php echo esc_html($row["label"]); ?>: <?php echo esc_html($url); ?>
    </div>
    <?php endforeach; ?>
</div>
