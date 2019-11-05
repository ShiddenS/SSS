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

use Tygh\Bootstrap;
use Tygh\Languages\Languages;
use Tygh\Registry;

if ( !defined('AREA') ) { die('Access denied'); }

function fn_rus_cities_install()
{
    $path = Registry::get('config.dir.root') . '/app/addons/rus_cities/database/cities.csv';
    fn_rus_cities_read_cities_by_chunk($path, RUS_CITIES_FILE_READ_CHUNK_SIZE, 'fn_rus_cities_add_cities_in_table');
}

/**
 * Gets the list cities on parameters.
 *
 * @param array  $params         The parameters for search of cities.
 * @param int    $items_per_page Items per page.
 * @param string $lang_code      The language code (e.g. 'en', 'ru', etc.).
 *
 * @return array The cities list and the search params.
 */
function fn_get_cities($params = array(), $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
    $condition = '';
    $limit = '';

    // Set default values to input params
    $default_params = array (
        'page' => 1,
        'items_per_page' => $items_per_page
    );

    $params = array_merge($default_params, $params);

    $fields = array(
        '?:rus_cities.city_id',
        '?:rus_cities.country_code',
        '?:rus_cities.state_code',
        '?:rus_cities.status',
        '?:rus_city_descriptions.city',
    );

    $join = db_quote(
        ' LEFT JOIN ?:rus_city_descriptions'
        . ' ON ?:rus_city_descriptions.city_id = ?:rus_cities.city_id'
    );

    /**
     * Prepares params for SQL query before getting list cities.
     *
     * @param array  $params         The parameters for seorch of cities.
     * @param int    $items_per_page Items per page.
     * @param string $lang_code      The language code (e.g. 'en', 'ru', etc.).
     * @param string  $fields    Array of fields to be selected.
     * @param string  $condition Array of complete condition expressions to be applied to the end of an SQL-query.
     * @param string  $join      List of strings with the complete JOIN information (JOIN type, tables and fields) for an SQL-query.
     */
    fn_set_hook('get_cities_pre', $params, $items_per_page, $lang_code, $fields, $condition, $join);

    if (!empty($params['country_code'])) {
        $condition .= db_quote(' AND ?:rus_cities.country_code = ?s', $params['country_code']);
    }

    if (!empty($params['state_code'])) {
        $condition .= db_quote(' AND ?:rus_cities.state_code = ?s', $params['state_code']);
    }

    if (!empty($params['q'])) {
        $condition .= db_quote(' AND ?:rus_city_descriptions.city LIKE ?l', '%' . $params['q'] . '%');
    }

    if (!empty($params['status'])) {
        $condition .= db_quote(' AND ?:rus_cities.status = ?s', $params['status']);
    }

    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field('SELECT COUNT(*) FROM ?:rus_cities ?p WHERE ?:rus_city_descriptions.lang_code = ?s ?p', $join, $lang_code, $condition);
        $limit = db_paginate($params['page'], $params['items_per_page']);
    }

    $cities = db_get_array(
        'SELECT ?p FROM ?:rus_cities ?p WHERE ?:rus_city_descriptions.lang_code = ?s ?p ORDER BY ?:rus_city_descriptions.city ?p',
        implode(', ', $fields),
        $join,
        $lang_code,
        $condition,
        $limit
    );

    /**
     * Changes data on the list cities.
     *
     * @param string  $cities    The array with the city data.
     */
    fn_set_hook('get_cities_post', $params, $items_per_page, $lang_code, $cities);

    return array($cities, $params);
}

/**
 * Updates the city data for the `rus_cities`, `rus_city_descriptions` tables.
 *
 * @param array   $city_data The array with the city data.
 * @param int     $city_id   The identifiers of city.
 * @param string  $lang_code Language code.
 *
 * @return int The identifiers of city.
 */
function fn_update_city($city_data, $city_id = 0, $lang_code = DESCR_SL)
{
    $city = $city_descriptions = array();

    if (!empty($city_data['country_code'])) {
        $city['country_code'] = $city_data['country_code'];
    }

    if (!empty($city_data['state_code'])) {
        $city['state_code'] = $city_data['state_code'];
    }

    if (!empty($city_data['city'])) {
        $city_descriptions['city'] = $city_data['city'];
    }

    if (!empty($city_id)) {
        if (!empty($city)) {
            db_query('UPDATE ?:rus_cities SET ?u WHERE city_id = ?i', $city, $city_id);
        }

        if (!empty($city_descriptions)) {
            db_query('UPDATE ?:rus_city_descriptions SET ?u WHERE city_id = ?i AND lang_code = ?s', $city_descriptions, $city_id, $lang_code);
        }

    } else {
        $languages = Languages::getAll();

        if (!empty($city)) {
            $city_id = db_replace_into('rus_cities', $city);

            $city_descriptions['city_id'] = $city_id;

            foreach ($languages as $city_descriptions['lang_code'] => $language) {
                db_replace_into('rus_city_descriptions', $city_descriptions);
            }
        }
    }

    /**
     * Updates the city data.
     *
     * @param array   $city_data The array with the city data.
     * @param int     $city_id   The identifiers of city.
     * @param string  $lang_code Language code.
     */
    fn_set_hook('update_city_post', $city_data, $city_id, $lang_code);

    return $city_id;
}

/**
 * Finds cities.
 *
 * @param array  $params         City search parameters
 * @param string $lang_code      Two-letter language code
 * @param int    $items_per_page Amount of cities to fetch
 *
 * @return array Cities list
 */
function fn_rus_cities_find_cities($params, $lang_code = CART_LANGUAGE, $items_per_page = 10)
{
    $condition = array();
    $prefix = explode(',', __('addons.rus_cities.city_prefix'));

    if (empty($params['q'])) {
        return array();
    }

    $params['q'] = str_replace($prefix, '', $params['q']);
    $search = trim($params['q']) . '%';

    if (!empty($params['check_country'])) {
        $condition['country_code'] = db_quote('AND c.code = ?s', $params['check_country']);
    }

    if (!empty($params['check_state'])) {
        $condition['states_code'] = db_quote('AND s.code = ?s', $params['check_state']);
    }

    $fields = array(
        db_quote('DISTINCT cd.country'),
        db_quote('c.code AS country_code'),
        db_quote('sd.state'),
        db_quote('s.code AS state_code'),
        db_quote('rcd.city'),
        db_quote('rc.city_id'),
        db_quote('rc.zipcode'),
    );

    $join = array(
        db_quote('LEFT JOIN ?:rus_cities           AS rc ON rc.city_id = rcd.city_id'),
        db_quote('LEFT JOIN ?:countries            AS c  ON rc.country_code = c.code'),
        db_quote('LEFT JOIN ?:country_descriptions AS cd ON c.code = cd.code AND cd.lang_code = ?s', $lang_code),
        db_quote('LEFT JOIN ?:states               AS s  ON rc.state_code = s.code AND c.code = s.country_code'),
        db_quote('LEFT JOIN ?:state_descriptions   AS sd ON s.state_id = sd.state_id AND sd.lang_code = ?s', $lang_code),
    );

    $condition['countries_status'] = db_quote('AND c.status = ?s', 'A');
    $condition['states_status'] = db_quote('AND s.status = ?s', 'A');
    $condition['cities_status'] = db_quote('AND rc.status = ?s', 'A');
    $condition['search'] = db_quote('AND (rcd.city LIKE ?l OR sd.state LIKE ?l)', $search, $search);
    $condition['city_lang'] = db_quote('AND rcd.lang_code = ?s', $lang_code);

    /**
     * Executes before fetching cities from the database,
     * allow to modify SQL query.
     *
     * @param array    $params         City search parameters
     * @param string   $lang_code      Two-letter language code
     * @param int      $items_per_page Amount of cities to fetch
     * @param string   $search         City search criterion
     * @param string[] $fields         Fields to fetch from the database
     * @param string[] $join           JOIN part of SQL query
     * @param string[] $condition      Filter conditions
     */
    fn_set_hook('rus_cities_find_cities', $params, $lang_code, $items_per_page, $search, $fields, $join, $condition);

    $fields = implode(',', $fields);
    $join = implode(' ', $join);
    $condition = implode(' ', $condition);

    $cities = db_get_array(
        'SELECT ?p'
        . ' FROM ?:rus_city_descriptions AS rcd'
        . ' ?p'
        . ' WHERE 1=1'
        . ' ?p'
        . ' ORDER BY rcd.city LIKE ?l DESC, sd.state LIKE ?l DESC, rcd.city ASC, sd.state ASC'
        . ' LIMIT ?i',
        $fields,
        $join,
        $condition,
        $search,
        $search,
        $items_per_page
    );

    return $cities;
}

/**
 * Gets the list cities in the correct formats.
 *
 * @param array $cities The array the list cities.
 *
 * @return array The array cities.
 */
function fn_rus_cities_format_to_autocomplete($cities)
{
    $list_cities = array();

    if (!empty($cities)) {
        foreach ($cities as $city) {
            $zipcode_list = fn_explode(',', $city['zipcode']);

            $list_cities[] = array(
                'code' => $city['city_id'],
                'value' => $city['city'],
                'label' => $city['city'] . ', ' . $city['state'],
                'country' => $city['country'],
                'country_code' => $city['country_code'],
                'state' => $city['state'],
                'state_code' => $city['state_code'],
                'zipcode' => reset($zipcode_list)
            );
        }
    }

    return $list_cities;
}

/**
 * Gets the cities identificators by city name.
 *
 * @param array  $params     The array with the parameters for find the cities identificators.
 * @param string $lang_code  Language code.
 *
 * @return array The array the cities identificators.
 */
function fn_rus_cities_get_city_ids($city, $state, $country, $lang_code = CART_LANGUAGE)
{
    $condition = '';

    if (!empty($state)) {
        $condition .= db_quote(' AND ?:rus_cities.state_code = ?s', $state);
    }
    if (!empty($country)) {
        $condition .= db_quote(' AND ?:rus_cities.country_code = ?s', $country);
    }

    $cities = db_get_fields(
        'SELECT ?:rus_cities.city_id'
        . ' FROM ?:rus_city_descriptions'
        . ' LEFT JOIN ?:rus_cities'
            . ' ON ?:rus_city_descriptions.city_id = ?:rus_cities.city_id'
        . ' WHERE ?:rus_city_descriptions.city = ?s AND ?:rus_cities.status = ?s AND lang_code = ?s ?p',
        $city,
        'A',
        $lang_code,
        $condition
    );

    return $cities;
}

/**
 * Reads the csv of file for upload the cities data.
 *
 * @param string $path               The name file.
 * @param int    $size               The maximum number the rows upload.
 * @param string $function_callback  The name of function.
 *
 * @return void.
 */
function fn_rus_cities_read_cities_by_chunk($path, $size, $function_callback)
{
    $rows = array();
    $max_line_size = 165536;
    $delimiter = ',';

    if (!file_exists($path)) {
        return false;
    }

    $cities_file = fopen($path, 'rb');
    if (!$cities_file) {
        return false;
    }

    $import_schema = fgetcsv($cities_file, $max_line_size, $delimiter);
    $schema_size = sizeof($import_schema);
    $skipped_lines = array();
    $line_it = 1;

    while (($data = fn_fgetcsv($cities_file, $max_line_size, $delimiter)) !== false) {
        $line_it++;

        if (fn_is_empty($data)) {
            continue;
        }

        if (sizeof($data) != $schema_size) {
            $skipped_lines[] = $line_it;
            continue;
        }

        $data = str_replace(array('\r', '\n', '\t', '"'), '', $data);
        $row = array_combine($import_schema, Bootstrap::stripSlashes($data));

        $row['City'] = (string) trim($row['City']);

        $rows[] = $row;

        if (count($rows) == $size) {
            call_user_func($function_callback, $rows);

            $rows = array();
        }
    }

    if (!empty($rows)) {
        call_user_func($function_callback, $rows);
    }
}

/**
 * Adds the cities data in the table.
 *
 * @param string $path The path to the file.
 *
 * @return array The array with the cities.
 */
function fn_rus_cities_add_cities_in_table($rows)
{
    static $languages;

    if (is_null($languages)) {
        $languages = Languages::getAll();
    }

    foreach ($rows as $city_data) {
        $city_data['City'] = (string) trim($city_data['City']);

        $zipcode = $city_data['PostCodeList'];
        if (!empty($city_data['PostCodeList']) && fn_strlen($city_data['PostCodeList']) <= 1) {
            $zipcode = str_pad($city_data['PostCodeList'], 6, '0', STR_PAD_LEFT);
        }

        $city = array(
            'country_code' => $city_data['Country'],
            'state_code' => $city_data['OblName'],
            'status' => 'A',
            'zipcode' => $zipcode
        );

        $city_id = db_replace_into('rus_cities', $city);

        $city_description = array(
            'city' => $city_data['City'],
            'city_id' => $city_id
        );

        foreach ($languages as $city_description['lang_code'] => $lang_data) {
            db_replace_into('rus_city_descriptions', $city_description);
        }
    }
}

/**
 * Gets the full of list cities.
 *
 * @param array $rows The array with cities data.
 *
 * @return array The array with cities.
 */
function fn_rus_cities_get_all_cities($rows)
{
    $cities_data = array();
    $countries = $states = $cities = array();

    foreach ($rows as $row) {
        $countries[] = $row['Country'];
        $states[] = $row['OblName'];
        $cities[] = $row['City'];
    }

    $countries = array_unique($countries);
    $states = array_unique($states);
    $cities = array_unique($cities);

    $cities_list = db_get_array(
        'SELECT a.city_id, country_code, state_code, city, zipcode'
        . ' FROM ?:rus_cities as a LEFT JOIN ?:rus_city_descriptions as b ON a.city_id = b.city_id'
        . ' WHERE country_code IN (?a) AND state_code IN (?a) AND city IN (?a)',
        $countries, $states, $cities
    );

    foreach ($cities_list as $city_list) {
        $city = fn_strtolower($city_list['city']);
        $cities_data[$city_list['country_code']][$city_list['state_code']][$city] = $city_list['city_id'];
    }

    return $cities_data;
}

/**
 * Deletes the city by city identifier.
 *
 * @param int $city_id The city identifier.
 *
 * @return void
 */
function fn_rus_cities_delete_city($city_id)
{
    db_query('DELETE FROM ?:rus_cities WHERE city_id = ?i', $city_id);
    db_query('DELETE FROM ?:rus_city_descriptions WHERE city_id = ?i', $city_id);

    /**
     * Deletes the city data.
     *
     * @param int $city_id The city identifier.
     */
    fn_set_hook('delete_city_post', $city_id);
}

/**
 * Returns stored customer location from the shipping estimation request or the one stored in the cart user data.
 *
 * @param bool $stored_location Whether to search location in `stored_location`.
 *                              Is used when estimation shipping cost
 * @param bool $customer_loc    Whether to search location in `customer_loc`.
 *                              Is used after the shipping method is changed
 * @param bool $user_data       Whether to search location in `cart.user_data`.
 *                              Used on checkout
 *
 * @return array Customer location
 */
function fn_rus_cities_get_location_from_session($stored_location = false, $customer_loc = true, $user_data = true)
{
    $location = array();
    if ($stored_location && Tygh::$app['session']['stored_location']) {
        $location = Tygh::$app['session']['stored_location'];
    } elseif ($customer_loc && Tygh::$app['session']['customer_loc']) {
        $location = Tygh::$app['session']['customer_loc'];
    } elseif ($user_data && Tygh::$app['session']['cart']['user_data']) {
        $location = Tygh::$app['session']['cart']['user_data'];
    }

    if (!isset($location['s_country']) && isset($location['country'])) {
        $location['s_country'] = $location['country'];
    }
    if (!isset($location['s_state']) && isset($location['state'])) {
        $location['s_state'] = $location['state'];
    }
    if (!isset($location['s_city']) && isset($location['city'])) {
        $location['s_city'] = $location['city'];
    }

    return $location;
}

/**
 * Gets the city data by ids.
 *
 * @param int[] $city_ids The cities identificator.
 *
 * @return array The array cities data.
 */
function fn_rus_city_get_city_data($city_ids)
{
    $cities_data = db_get_array(
        'SELECT * FROM ?:rus_cities WHERE city_id IN (?a)',
        $city_ids
    );

    return $cities_data;
}

/**
 * Hook handler: tries to fetch postal code if it is not already set in provided data
 */
function fn_rus_cities_geo_maps_set_customer_location_pre(&$location)
{
    if ((!empty($location['postal_code']) && !empty($location['state_code']))
        || empty($location['country'])
        || empty($location['locality'])
    ) {
        return;
    }

    if (empty($location['state_code'])) {
        $params = [
            'q'            => $location['locality'],
            'country_code' => $location['country']
        ];
        list($cities) = fn_get_cities($params);
        if (empty($cities)) {
            return;
        }
    } else {
        $city_ids = fn_rus_cities_get_city_ids($location['locality'], $location['state_code'], $location['country']);
        if (!$city_ids) {
            return;
        }

        $cities = fn_rus_city_get_city_data($city_ids);

    }
    if (!empty($cities)) {
        $city = reset($cities);
        if (empty($location['state_code'])) {
            $location['state_code'] = !empty($city['state_code']) ? $city['state_code'] : '';
        }
        if (empty($location['postal_code'])) {
            list($location['postal_code']) = explode(',', $city['zipcode'], 2);
        }
    }

    /**
     * Executes after the location of the user is set; allows modifying the location.
     *
     * @param array $location  Customer location data
     * @param array $cities    List of available cities and their data
     */
    fn_set_hook('rus_cities_geo_maps_set_customer_location_pre_post', $location, $cities);
}

/**
 * Hook handler: automatically detects zipcode when saving a location.
 */
function fn_rus_cities_location_manager_detect_zipcode_post($country_code, $state_code, $city, &$zipcode)
{
    if ($zipcode !== null) {
        return;
    }

    $city_ids = fn_rus_cities_get_city_ids($city, $state_code, $country_code);
    if (!$city_ids) {
        return;
    }

    $city = fn_rus_city_get_city_data($city_ids);
    if ($city) {
        $city = reset($city);
        list($zipcode) = explode(',', $city['zipcode'], 2);
    }

    /**
     * Executes when automatically detecting a customer's zipcode after the zipcode is detected,
     * allows you to modify the detected zipcode.
     *
     * @param string $country_code ISO 3166-1 country code
     * @param string $state_code   ISO 3166-2 state code
     * @param string $city         City name
     * @param string $zipcode      Detected zipcode
     */
    fn_set_hook('rus_cities_location_manager_detect_zipcode_post_post', $country_code, $state_code, $city, $zipcode);
}
