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

defined('BOOTSTRAP') or die('Access denied');

use Tygh\Languages\Languages;
use Tygh\Registry;
use Tygh\Template\Document\Variables\PickpupPointVariable;
use Tygh\Themes\Themes;
use Tygh\Tools\SecurityHelper;
use Illuminate\Support\Collection;

function fn_store_locator_install()
{
    $service = array(
        'status'      => 'A',
        'module'      => 'store_locator',
        'code'        => 'pickup',
        'sp_file'     => '',
        'description' => 'Pickup',
    );

    $service['service_id'] = db_get_field('SELECT service_id FROM ?:shipping_services WHERE module = ?s AND code = ?s', $service['module'], $service['code']);

    if (empty($service['service_id'])) {
        $service['service_id'] = db_query('INSERT INTO ?:shipping_services ?e', $service);
    }

    $languages = Languages::getAll();
    foreach ($languages as $lang_code => $lang_data) {

        if ($lang_code == 'ru') {
            $service['description'] = "Самовывоз";
        } else {
            $service['description'] = "Pickup";
        }

        $service['lang_code'] = $lang_code;

        db_query('INSERT INTO ?:shipping_service_descriptions ?e', $service);
    }
}

function fn_store_locator_uninstall()
{
    $service_ids = db_get_fields('SELECT service_id FROM ?:shipping_services WHERE module = ?s', 'store_locator');
    if (!empty($service_ids)) {
        db_query('DELETE FROM ?:shipping_services WHERE service_id IN (?a)', $service_ids);
        db_query('DELETE FROM ?:shipping_service_descriptions WHERE service_id IN (?a)', $service_ids);
    }
}

function fn_store_locator_update_cart_by_data_post(&$cart, $new_cart_data, $auth)
{
    if (!empty($new_cart_data['select_store'])) {
        $cart['select_store'] = $new_cart_data['select_store'];
    }
}

function fn_store_locator_calculate_cart_taxes_pre(&$cart, $cart_products, &$product_groups)
{
    if (!empty($cart['shippings_extra']['data'])) {

        if (!empty($cart['select_store'])) {
            $select_store = $cart['select_store'];
        } elseif (!empty($_REQUEST['select_store'])) {
            $select_store = $cart['select_store'] = $_REQUEST['select_store'];
        }

        if (!empty($select_store)) {

            $tmp_surcharge_array = array();
            foreach ($select_store as $g_key => $g) {
                foreach ($g as $s_id => $s) {
                    if (isset($cart['shippings_extra']['data'][$g_key][$s_id]['stores'][$s]['pickup_surcharge'])) {
                        $tmp_surcharge = isset($cart['shippings_extra']['data'][$g_key][$s_id]['stores'][$s]['pickup_surcharge'])
                            ? $cart['shippings_extra']['data'][$g_key][$s_id]['stores'][$s]['pickup_surcharge']
                            : 0;

                        if (isset($product_groups[$g_key]['shippings'][$s_id]['rate'])) {
                            $tmp_rate = $product_groups[$g_key]['shippings'][$s_id]['rate'];
                            $tmp_surcharge_array[$g_key][$s_id] = $tmp_rate - $tmp_surcharge;
                        }
                    }
                }
            }

            foreach ($product_groups as $group_key => $group) {
                if (!empty($group['chosen_shippings'])) {
                    foreach ($group['chosen_shippings'] as $shipping_key => $shipping) {
                        if ($shipping['module'] != 'store_locator') {
                            continue;
                        }

                        $shipping_id = $shipping['shipping_id'];

                        if (!empty($cart['shippings_extra']['data'][$group_key][$shipping_id])) {
                            $shippings_extra = $cart['shippings_extra']['data'][$group_key][$shipping_id];
                            $product_groups[$group_key]['chosen_shippings'][$shipping_key]['data'] = $shippings_extra;

                            if (!empty($select_store[$group_key][$shipping_id])) {
                                $store_id = $select_store[$group_key][$shipping_id];
                                $product_groups[$group_key]['chosen_shippings'][$shipping_key]['store_location_id'] = $store_id;
                                if (!empty($shippings_extra['stores'][$store_id])) {
                                    $store_data = $shippings_extra['stores'][$store_id];
                                    $product_groups[$group_key]['chosen_shippings'][$shipping_key]['store_data'] = $store_data;
                                }
                            }
                        }
                    }
                }
            }
        }

        foreach ($cart['shippings_extra']['data'] as $group_key => $shippings) {
            foreach ($shippings as $shipping_id => $shippings_extra) {
                if (!empty($product_groups[$group_key]['shippings'][$shipping_id]['module'])) {
                    $module = $product_groups[$group_key]['shippings'][$shipping_id]['module'];

                    if ($module == 'store_locator' && !empty($shippings_extra)) {
                        $product_groups[$group_key]['shippings'][$shipping_id]['data'] = $shippings_extra;
                    }
                }
            }
        }

        foreach ($product_groups as $group_key => $group) {
            if (!empty($group['chosen_shippings'])) {
                foreach ($group['chosen_shippings'] as $shipping_key => $shipping) {
                    $shipping_id = $shipping['shipping_id'];
                    $module = $shipping['module'];

                    if ($module == 'store_locator' && !empty($cart['shippings_extra']['data'][$group_key][$shipping_id])) {
                        $shippings_extra = $cart['shippings_extra']['data'][$group_key][$shipping_id];
                        $product_groups[$group_key]['chosen_shippings'][$shipping_key]['data'] = $shippings_extra;
                    }
                }
            }
        }
    }
}

/**
 * Gets list of store locations
 *
 * @param array  $params         Request parameters
 * @param int    $items_per_page Amount of items per page
 * @param string $lang_code      Two-letter language code
 *
 * @return array List of store locations
 */
function fn_get_store_locations($params, $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
    $params = array_merge([
        'page'           => 1,
        'q'              => '',
        'match'          => 'any',
        'items_per_page' => $items_per_page,
    ], $params);

    $fields = [
        'locations'                   => '?:store_locations.*',
        'store_location_descriptions' => '?:store_location_descriptions.*',
        'country_descriptions'        => '?:country_descriptions.country as country_title',
    ];

    $joins['country_descriptions'] = db_quote(
        'LEFT JOIN ?:country_descriptions ON ?:store_locations.country = ?:country_descriptions.code AND ?:country_descriptions.lang_code = ?s',
        $lang_code
    );
    $joins['store_location_descriptions'] = db_quote(
        'LEFT JOIN ?:store_location_descriptions'
        . ' ON ?:store_locations.store_location_id = ?:store_location_descriptions.store_location_id AND ?:store_location_descriptions.lang_code = ?s', $lang_code
    );

    $conditions = ['1=1'];
    if (AREA == 'C') {
        $conditions['store_status'] = defined('CART_LOCALIZATION')
            ? db_quote('status = ?s ?p', 'A', fn_get_localizations_condition('?:store_locations.localization'))
            : db_quote('status = ?s', 'A');
    }

    // Search string condition for SQL query
    if (!empty($params['q'])) {
        $search_words = [$params['q']];
        $search_type = '';

        if ($params['match'] === 'any' || $params['match'] === 'all') {
            $search_words = explode(' ', $params['q']);
            $search_type = $params['match'] === 'any' ? ' OR ' : ' AND ';
        }

        $search_condition = [];
        foreach ($search_words as $word) {
            $word_conditions = [
                'name'        => db_quote('?:store_location_descriptions.name LIKE ?l', "%{$word}%"),
                'city'        => db_quote('?:store_location_descriptions.city LIKE ?l', "%{$word}%"),
                'country'     => db_quote('?:country_descriptions.country LIKE ?l', "%{$word}%"),
                'description' => db_quote('?:store_location_descriptions.description LIKE ?l', "%{$word}%"),
            ];
            $search_condition[] = db_quote('(?p)', implode(' OR ', $word_conditions));
        }

        if (!empty($search_condition)) {
            $conditions['search'] = db_quote('(?p)', implode($search_type, $search_condition));
        }
        unset($word, $word_conditions, $search_condition);
    }

    if (!empty($params['city'])) {
        $conditions['city'] = db_quote('?:store_location_descriptions.city = ?s', $params['city']);
    }

    if (!empty($params['pickup_only'])) {
        $conditions['pickup_only'] = db_quote('main_destination_id IS NOT NULL');
    }

    if (!empty($params['company_id'])) {
        $conditions['company_id'] = db_quote('company_id = ?i', $params['company_id']);
    }

    /**
     * Change SQL parameters for store locations selection
     *
     * @param array  $params
     * @param array  $fields     List of fields for retrieving
     * @param string $joins      String with the complete JOIN information (JOIN type, tables and fields) for an SQL-query
     * @param string $conditions String containing SQL-query condition possibly prepended with a logical operator (AND or OR)
     */
    fn_set_hook('get_store_locations_before_select', $params, $fields, $joins, $conditions);

    $join = implode(' ', $joins);
    $condition = implode(' AND ', $conditions);
    $limit = '';
    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field('SELECT COUNT(?:store_locations.store_location_id) FROM ?:store_locations ?p WHERE 1=1 AND ?p', $join, $condition);
        $limit = db_paginate($params['page'], $params['items_per_page'], $params['total_items']);
    }

    $sorting = '?:store_locations.position, ?:store_location_descriptions.name';
    $data = db_get_hash_array('SELECT ?p FROM ?:store_locations ?p WHERE 1=1 AND ?p GROUP BY ?:store_locations.store_location_id ORDER BY ?p ?p',
        'store_location_id',
        implode(', ', $fields),
        $join,
        $condition,
        $sorting,
        $limit
    );

    return [$data, $params];
}

/**
 * Fetches list of cities that have stores
 *
 * @param array $params Search parameters
 *
 * @return array
 */
function fn_get_store_location_cities(array $params = [])
{
    $join = [];
    $condition = [
        'lang_code' => db_quote('descriptions.lang_code = ?s', isset($params['lang_code']) ? $params['lang_code'] : CART_LANGUAGE),
    ];

    if (!empty($params['pickup_only']) || !empty($params['status']) || !empty($params['company_id'])) {
        $join['store_locations'] = db_quote('LEFT JOIN ?:store_locations AS store_locations ON store_locations.store_location_id = descriptions.store_location_id');
        if (!empty($params['pickup_only'])) {
            $condition['pickup_avail'] = db_quote('store_locations.main_destination_id IS NOT NULL');
        }
        if (!empty($params['status'])) {
            $condition['status'] = db_quote('store_locations.status = ?s', $params['status']);
        }
        if (!empty($params['company_id'])) {
            $condition['company_id'] = db_quote('store_locations.company_id = ?i', $params['company_id']);
        }
    }

    $cities = db_get_fields(
        'SELECT DISTINCT(descriptions.city) FROM ?:store_location_descriptions AS descriptions ?p WHERE ?p',
        implode(' ', $join),
        implode(' AND ', $condition)
    );

    return $cities;
}

function fn_get_store_location($store_location_id, $lang_code = CART_LANGUAGE)
{
    $fields = array(
        '?:store_locations.*',
        '?:store_location_descriptions.*',
        '?:country_descriptions.country as country_title',
    );

    $join = db_quote(" LEFT JOIN ?:store_location_descriptions ON ?:store_locations.store_location_id = ?:store_location_descriptions.store_location_id AND ?:store_location_descriptions.lang_code = ?s", $lang_code);
    $join .= db_quote(" LEFT JOIN ?:country_descriptions ON ?:store_locations.country = ?:country_descriptions.code AND ?:country_descriptions.lang_code = ?s", $lang_code);

    $condition = db_quote(" ?:store_locations.store_location_id = ?i ", $store_location_id);
    $condition .= (AREA == 'C' && defined('CART_LOCALIZATION')) ? fn_get_localizations_condition('?:store_locations.localization') : '';

    $store_location = db_get_row('SELECT ?p FROM ?:store_locations ?p WHERE ?p', implode(', ', $fields), $join, $condition);

    if (!empty($store_location['pickup_destinations_ids'])) {
        $store_location['pickup_destinations_ids'] = explode(',', $store_location['pickup_destinations_ids']);
    }

    return $store_location;
}

function fn_get_store_location_name($store_location_id, $lang_code = CART_LANGUAGE)
{
    if (!empty($store_location_id)) {
        return db_get_field('SELECT name FROM ?:store_location_descriptions WHERE store_location_id = ?i AND lang_code = ?s', $store_location_id, $lang_code);
    }

    return false;
}

function fn_update_store_location($store_location_data, $store_location_id, $lang_code = DESCR_SL)
{
    SecurityHelper::sanitizeObjectData('store_location', $store_location_data);

    $store_location_data['localization'] = !empty($store_location_data['localization']) ? fn_implode_localizations($store_location_data['localization']) : '';
    $store_location_data['main_destination_id'] = !empty($store_location_data['main_destination_id']) && is_numeric($store_location_data['main_destination_id'])
        ? $store_location_data['main_destination_id']
        : null;

    if (!empty($store_location_data['pickup_destinations_ids'])) {
        if ($store_location_data['main_destination_id']
            && !in_array($store_location_data['main_destination_id'], $store_location_data['pickup_destinations_ids'])
        ) {
            $store_location_data['pickup_destinations_ids'][] = $store_location_data['main_destination_id'];
        }

        $store_location_data['pickup_destinations_ids'] = implode(',', $store_location_data['pickup_destinations_ids']);
    } else {
        $store_location_data['pickup_destinations_ids'] = $store_location_data['main_destination_id'] ?: '0';
    }

    if (empty($store_location_id)) {
        if (empty($store_location_data['position'])) {
            $store_location_data['position'] = db_get_field('SELECT MAX(position) FROM ?:store_locations');
            $store_location_data['position'] += 10;
        }

        $store_location_id = db_query('INSERT INTO ?:store_locations ?e', $store_location_data);

        $store_location_data['store_location_id'] = $store_location_id;

        foreach (Languages::getAll() as $store_location_data['lang_code'] => $v) {
            db_query("INSERT INTO ?:store_location_descriptions ?e", $store_location_data);
        }
    } else {
        db_query('UPDATE ?:store_locations SET ?u WHERE store_location_id = ?i', $store_location_data, $store_location_id);
        db_query('UPDATE ?:store_location_descriptions SET ?u WHERE store_location_id = ?i AND lang_code = ?s', $store_location_data, $store_location_id, $lang_code);
    }

    return $store_location_id;
}

function fn_delete_store_location($store_location_id)
{
    $deleted = true;

    $affected_rows = db_query('DELETE FROM ?:store_locations WHERE store_location_id = ?i', $store_location_id);
    db_query('DELETE FROM ?:store_location_descriptions WHERE store_location_id = ?i', $store_location_id);

    if (empty($affected_rows)) {
        $deleted = false;
    }

    return $deleted;
}

function fn_store_locator_google_langs($lang_code)
{
    $supported_langs = array('en', 'eu', 'ca', 'da', 'nl', 'fi', 'fr', 'gl', 'de', 'el', 'it', 'ja', 'no', 'nn', 'ru', 'es', 'sv', 'th');

    if (in_array($lang_code, $supported_langs)) {
        return $lang_code;
    }

    return '';
}

function fn_store_locator_yandex_langs($lang_code)
{
    $supported_langs = array('en' => 'en-US', 'tr' => 'tr-TR', 'ru' => 'ru-RU');
    $default_lang_code = 'en';

    if (isset($supported_langs[$lang_code])) {
        return $supported_langs[$lang_code];
    }

    return $supported_langs[$default_lang_code];
}

function fn_store_locator_get_info()
{
    $text = '<a href="http://code.google.com/apis/maps/signup.html">' . __('singup_google_url') . '</a>';

    return $text;
}

function fn_get_store_locator_settings()
{
    static $settings;

    if (empty($settings)) {
        $settings = Registry::get('addons.store_locator');
        unset($settings['status'], $settings['priority'], $settings['unmanaged']);
    }

    return $settings;
}

function fn_get_store_locator_map_templates($area)
{
    $templates = array();

    if (empty($area) || !in_array($area, array('A', 'C'))) {
        return $templates;
    }

    $theme = Themes::areaFactory($area);
    $search_path = 'addons/store_locator/views/store_locator/components/maps/';

    $_templates = $theme->getDirContents(array(
        'dir'       => 'templates/' . $search_path,
        'get_dirs'  => false,
        'get_files' => true,
        'extension' => array('.tpl'),
    ), Themes::STR_MERGE, Themes::PATH_ABSOLUTE, Themes::USE_BASE);

    if (!empty($_templates)) {
        foreach ($_templates as $template => $file_info) {
            $template_provider = str_replace('.tpl', '', strtolower($template)); // Get provider name
            $templates[$template_provider] = $search_path . $template;
        }
    }

    return $templates;
}

if (fn_allowed_for('ULTIMATE')) {
    function fn_store_locator_ult_check_store_permission($params, &$object_type, &$object_name, &$table, &$key, &$key_id)
    {
        if (Registry::get('runtime.controller') == 'store_locator' && !empty($params['store_location_id'])) {
            $key = 'store_location_id';
            $key_id = $params[$key];
            $table = 'store_locations';
            $object_name = fn_get_store_location_name($key_id, DESCR_SL);
            $object_type = __('store_locator');
        }
    }
}

/**
 * Fetches locations list based on stores data
 *
 * @param string $lang_code Two-letters language code
 *
 * @return array
 */
function fn_store_locator_get_stores_locations_list($lang_code = CART_LANGUAGE)
{
    $fields = ['loc.country', 'country.country AS country_name', 'loc.state', 'state_descr.state AS state_name', 'loc_descr.city'];

    $joins['states'] = db_quote('LEFT JOIN ?:states AS states ON states.country_code = loc.country AND states.code = loc.state');
    $joins['country_descriptions'] = db_quote(
        'LEFT JOIN ?:country_descriptions AS country ON country.code = loc.country AND country.lang_code = ?s',
        $lang_code
    );
    $joins['state_descriptions'] = db_quote(
        'LEFT JOIN ?:state_descriptions AS state_descr ON state_descr.state_id = states.state_id AND state_descr.lang_code = ?s',
        $lang_code
    );
    $joins['store_location_descriptions'] = db_quote(
        'LEFT JOIN ?:store_location_descriptions AS loc_descr ON loc_descr.store_location_id = loc.store_location_id AND loc_descr.lang_code = ?s',
        $lang_code
    );

    $condition = db_quote(
        'WHERE country.country <> ?s AND state_descr.state <> ?s AND loc_descr.city <> ?s AND loc.status = ?s',
        '', '', '', 'A'
    );

    $locations = db_get_array(
        'SELECT ?p FROM ?:store_locations AS loc ?p ?p',
        implode(', ', $fields),
        implode(' ', $joins),
        $condition
    );

    $grouped_locations = (new Collection($locations))
        ->groupBy('country')
        ->map(function ($country_group) {
            $prepared_group = $country_group
                ->groupBy('state')
                ->map(function ($state_group) {
                    $state_name = $state_group->first()['state_name'];
                    $cities = array_unique(array_column($state_group->toArray(), 'city'));

                    return ['title' => $state_name, 'cities' => $cities];
                });

            $country_name = $country_group->first()['country_name'];
            return [
                'title'  => $country_name,
                'states' => $prepared_group->toArray(),
            ];
        })
        ->toArray();

    return $grouped_locations;
}

/**
 * Hook handler: sets pickup point data.
 */
function fn_store_locator_pickup_point_variable_init(
    PickpupPointVariable $instance,
    $order,
    $lang_code,
    &$is_selected,
    &$name,
    &$phone,
    &$full_address,
    &$open_hours_raw,
    &$open_hours,
    &$description_raw,
    &$description
) {
    if (!empty($order['shipping'])) {
        if (is_array($order['shipping'])) {
            $shipping = reset($order['shipping']);
        } else {
            $shipping = $order['shipping'];
        }

        if (!isset($shipping['module']) || $shipping['module'] !== 'store_locator') {
            return;
        }

        if (isset($shipping['store_data'])) {
            $pickup_data = $shipping['store_data'];

            $is_selected = true;
            $name = $pickup_data['name'];
            $phone = $pickup_data['pickup_phone'];
            $full_address = fn_store_locator_format_pickup_point_address($pickup_data);
            $open_hours = $pickup_data['pickup_time'];
            $open_hours_raw = [$pickup_data['pickup_time']];
            $description_raw = $pickup_data['description'];
            $description = strip_tags($description_raw);
        }
    }

    return;
}

/**
 * Formats store location address.
 *
 * @param array $pickup_data Store location
 *
 * @return string Address
 */
function fn_store_locator_format_pickup_point_address($pickup_data)
{
    $address_parts = array_filter([
        $pickup_data['city'],
        $pickup_data['pickup_address'],
    ], 'fn_string_not_empty');

    $address = implode(', ', $address_parts);

    return $address;
}

/**
 * Hook handler: after fetching shipping data
 */
function fn_store_locator_get_shipping_info_after_select($shipping_id, $lang_code, &$shipping)
{
    if (empty($shipping['service_id'])) {
        return;
    }

    $service = fn_get_shipping_service_data($shipping['service_id']);
    if ($service['code'] === 'pickup' && $service['module'] === 'store_locator') {
        $shipping['allow_multiple_locations'] = true;
    }
}

/**
 * Hook handler: adds minimal price to shipping method
 */
function fn_store_locator_calculate_cart_post($cart, $auth, $calculate_shipping, $calculate_taxes, $options_style, $apply_cart_promotions, $cart_products, &$product_groups)
{
    foreach ($product_groups as $group_key => $group) {
        $selected_shipping = isset($group['chosen_shippings']) ? reset($group['chosen_shippings']) : 0;
        $selected_shipping_id = isset($selected_shipping['shipping_id']) ? $selected_shipping['shipping_id'] : 0;

        foreach ($group['shippings'] as $shipping_id => $shipping) {
            $is_selected_shipping = $selected_shipping_id == $shipping_id;
            $is_store_selected = !empty($cart['select_store'][$group_key][$shipping_id]);

            if (($is_selected_shipping && $is_store_selected)
                || empty($shipping['data']['stores'])
            ) {
                continue;
            }

            if (!empty(array_column($shipping['data']['stores'], 'pickup_rate'))) {
                $min_rate = min(array_column($shipping['data']['stores'], 'pickup_rate'));
                $product_groups[$group_key]['shippings'][$shipping_id]['pickup_rate_from'] = $min_rate;
            }
        }
    }
}

/**
 * The "calculate_cart_content_before_shipping_calculation" hook handler.
 *
 * Actions performed:
 *  - Adds stores and pickup points table into caching condition
 *
 * @see \fn_calculate_cart_content()
 */
function fn_store_locator_calculate_cart_content_before_shipping_calculation($cart, $auth, $calculate_shipping, $calculate_taxes, $options_style, $apply_cart_promotions, &$shipping_cache_tables)
{
    $shipping_cache_tables[] = 'store_locations';
    $shipping_cache_tables[] = 'store_location_descriptions';
}
