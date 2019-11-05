<?php
/***************************************************************************
 *                                                                          *
 *   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
 *                                                                          *
 * This  is  commercial  software,  only  users  who have purchased a valid *
 * license  and  accept  to the terms of the  License Agreement can install *
 * and use this program.                                                    *
 *                                                                          *
 ****************************************************************************
 * PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
 * "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
 ****************************************************************************/

use Tygh\Enum\OutOfStockActions;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

/**
 * Fetches detected geolocation data
 *
 * @return array
 */
function fn_geo_maps_get_customer_stored_geolocation()
{
    /** @var \Tygh\Location\Manager $manager */
    $manager = Tygh::$app['location'];
    $geolocation_data = $manager->getLocation()->toArray();

    /**
     * Called after fetching geolocation data from storage.
     *
     * @param array $geolocation_data Customer geolocation data.
     */
    fn_set_hook('get_geolocation_data_post', $geolocation_data);

    return $geolocation_data;
}

/**
 * Check if customer geolocation is detected
 *
 * @return bool
 */
function fn_geo_maps_is_customer_location_detected()
{
    /** @var \Tygh\Location\Manager $manager */
    $manager = Tygh::$app['location'];

    return $manager->getIsDetected();
}

/**
 * Fetches ISO state code from database
 *
 * @param array $location Location data
 *
 * @return string
 */
function fn_geo_maps_get_state_code_by_location($location)
{
    if ($location['state_code'] && fn_geo_maps_check_if_state_code_exists($location['state_code'], $location['country_code'])) {
        $state_code = $location['state_code'];
    } else {
        if (CART_LANGUAGE == DEFAULT_LANGUAGE) {
            $order_by = db_quote('ORDER BY CASE'
                . ' WHEN descriptions.lang_code = ?s THEN 1'
                . ' ELSE 2 END',
                CART_LANGUAGE
            );
        } else {
            $order_by = db_quote('ORDER BY CASE'
                . ' WHEN descriptions.lang_code = ?s THEN 1'
                . ' WHEN descriptions.lang_code = ?s THEN 2'
                . ' ELSE 3 END',
                CART_LANGUAGE, DEFAULT_LANGUAGE
            );
        }

        $states = db_get_array(
            'SELECT descriptions.state, states.code, descriptions.lang_code FROM ?:state_descriptions AS descriptions'
            . ' LEFT JOIN ?:states AS states ON states.state_id = descriptions.state_id'
            . ' WHERE states.country_code = ?s ?p',
            $location['country_code'],
            $order_by
        );

        $state_code = fn_geo_maps_get_state_code_by_state_text($location['state_name'], $states);
    }

    return $state_code;
}

/**
 * Checks if state code exists in the database
 *
 * @param string $state_code   ISO state code
 * @param string $country_code ISO country code
 *
 * @return bool
 */
function fn_geo_maps_check_if_state_code_exists($state_code, $country_code)
{
    return (bool) db_get_field('SELECT code FROM ?:states WHERE code = ?s AND country_code = ?s', $state_code, $country_code);
}

/**
 * Tries to find state ISO code by provided state name
 *
 * @param string $state_name           Location data
 * @param array  $states               States data
 * @param int    $similarity_threshold The minimum similarity percent to be considered as match
 *
 * @return string
 */
function fn_geo_maps_get_state_code_by_state_text($state_name, $states, $similarity_threshold = 55)
{
    $similarity_percent = $highest_percent = 0;
    foreach ($states as $state) {
        similar_text($state['state'], $state_name, $similarity_percent);
        if ($similarity_percent < $highest_percent) {
            continue;
        }

        $similarity_sufficient = $similarity_percent >= $similarity_threshold;
        if ($similarity_sufficient) {
            $highest_percent = $similarity_percent;
            $state_code = $state['code'];
        }
    }

    return isset($state_code) ? $state_code : '';
}

/**
 * Sets current user location
 *
 * @param array $location
 */
function fn_geo_maps_set_location(array $location)
{
    if (empty($location['state_code']) && !empty($location['state_text'])) {
        $location_data = [
            'state_code'   => $location['state'],
            'state_name'   => $location['state_text'],
            'country_code' => $location['country'],
        ];
        $location['state_code'] = fn_geo_maps_get_state_code_by_location($location_data);
    }

    /**
     * Executes before the location of the user is set; allows modifying the location.
     *
     * @param array $location  Customer location data
     */
    fn_set_hook('geo_maps_set_customer_location_pre', $location);

    if (empty($location['state_code'])) {
        return false;
    }

    fn_set_session_data('geo_maps_customer_location', $location);

    /** @var \Tygh\Location\Manager $manager */
    $manager = Tygh::$app['location'];

    $customer_location = [
        'country'      => isset($location['country']) ? $location['country'] : '',
        'state'        => isset($location['state_code']) ? $location['state_code'] : '',
        'city'         => isset($location['locality_text']) ? $location['locality_text'] : '',
        'zipcode'      => isset($location['postal_code']) ? $location['postal_code'] : '',
        'is_detected'  => true,
    ];

    $manager
        ->setLocationFromArray($customer_location)
        ->storeLocation();

    return true;
}

/**
 * Hook handler: sets out of stock action to backorder, for hiding error notification
 */
function fn_geo_maps_check_amount_in_stock_before_check($product_id, $amount, $product_options, $cart_id, $is_edp, $original_amount, $cart, $update_id, &$product, $current_amount)
{
    if (!empty($cart['geo_maps_shipping_estimation'])) {
        $product['out_of_stock_actions'] = OutOfStockActions::BUY_IN_ADVANCE;
    }
}
