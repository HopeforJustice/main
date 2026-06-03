<?php

/**
 * geo-target-2
 * Supports multiple country selection, including "All other countries"
 */

$selected_countries = get_field('countries') ?: [];

if ($GLOBALS["userInfo"] && in_array($GLOBALS["userInfo"], $GLOBALS["usa"])) {
    $country = 'USA';
} elseif ($GLOBALS["userInfo"] && in_array($GLOBALS["userInfo"], $GLOBALS["norway"])) {
    $country = 'NOK';
} elseif ($GLOBALS["userInfo"] && in_array($GLOBALS["userInfo"], $GLOBALS["au"])) {
    $country = 'AUS';
} elseif ($GLOBALS["userInfo"] && in_array($GLOBALS["userInfo"], $GLOBALS["uk"])) {
    $country = 'UK';
} else {
    $country = 'OTHER';
}

$show_for_user = in_array($country, $selected_countries) ||
                 (in_array('ALL_OTHER', $selected_countries) && $country === 'OTHER');

if ($show_for_user || is_admin()):
    $labels = array_map(function ($c) {
        return $c === 'ALL_OTHER' ? 'All other countries' : $c;
    }, $selected_countries);
    $admin_label = !empty($labels) ? implode(', ', $labels) : 'No countries selected';
?>

    <div class="geo-target-2">
        <?php if (is_admin()) echo '<p class="geo-target-2__admin-text">Geo target: ' . esc_html($admin_label) . '</p>'; ?>
        <InnerBlocks />
    </div>

<?php endif; ?>
