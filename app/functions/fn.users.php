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

use Illuminate\Support\Collection;
use Tygh\Enum\ProfileDataTypes;
use Tygh\Enum\ProfileFieldSections;
use Tygh\Enum\ProfileFieldTypes;
use Tygh\Enum\ProfileTypes;
use Tygh\Enum\UsergroupTypes;
use Tygh\Http;
use Tygh\Languages\Languages;
use Tygh\Location\Manager;
use Tygh\Navigation\LastView;
use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

/**
 * Gets user info
 *
 * @param string $user_id User identifier
 * @param int $get_profile Gets profile with user or not
 * @param int $profile_id Prodile identifier to get
 * @return array User data
 */
function fn_get_user_info($user_id, $get_profile = true, &$profile_id = NULL)
{
    /**
     * Actions before getting user data
     *
     * @param string $user_id     User identifier
     * @param int    $get_profile Gets profile with user or not
     * @param int    $profile_id  Prodile identifier to get
     */
    fn_set_hook('get_user_info_pre', $user_id, $get_profile, $profile_id);

    $user_fields = array (
        '?:users.*',
    );

    $condition = '';
    if ($user_id != Tygh::$app['session']['auth']['user_id']
        && (!fn_allowed_for('ULTIMATE')
            || Registry::ifGet('settings.Stores.share_users', 'N') === 'N'
        )
    ) {
        $condition = fn_get_company_condition('?:users.company_id');
    }
    $join = '';

    /**
     * Prepare params for getting user info query
     *
     * @param string $condition   Query condition; it is treated as a WHERE clause
     * @param int    $user_id     User identifier
     * @param array  $user_fields Array of table column names to be returned
     */
    fn_set_hook('get_user_info_before', $condition, $user_id, $user_fields, $join);

    $user_fields = implode(',', $user_fields);
    $user_data = db_get_row("SELECT $user_fields FROM ?:users $join WHERE user_id = ?i $condition", $user_id);

    if (empty($user_data)) {
        return array();
    }

    $user_data['usergroups'] = fn_get_user_usergroups($user_id);

    if ($get_profile == true) {
        if (!empty($profile_id)) {
            $profile_data = db_get_row("SELECT * FROM ?:user_profiles WHERE user_id = ?i AND profile_id = ?i", $user_data['user_id'], $profile_id);
        }

        if (empty($profile_data)) {
            $profile_data = db_get_row("SELECT * FROM ?:user_profiles WHERE user_id = ?i AND profile_type = 'P'", $user_data['user_id']);
            $profile_id = $profile_data['profile_id'];
        }

        $user_data = fn_array_merge($user_data, $profile_data);
    }

    // Get additional fields
    $prof_cond = ($get_profile && !empty($profile_data['profile_id'])) ? db_quote("OR (object_id = ?i AND object_type = 'P')", $profile_data['profile_id']) : '';
    $additional_fields = db_get_hash_single_array("SELECT field_id, value FROM ?:profile_fields_data WHERE (object_id = ?i AND object_type = 'U') $prof_cond", array('field_id', 'value'), $user_id);

    $user_data['fields'] = $additional_fields;

    fn_add_user_data_descriptions($user_data);

    /**
     * Actions after getting user data
     *
     * @param string $user_id     User identifier
     * @param int    $get_profile Gets profile with user or not
     * @param int    $profile_id  Profile identifier to get
     * @param array  $user_data   User data
     */
    fn_set_hook('get_user_info', $user_id, $get_profile, $profile_id, $user_data);

    return $user_data;
}

/**
 * Get user short info
 *
 * @param int $user_id User identifier
 *
 * @return array (user_id, user_login, company_id, firstname, lastname, email, user_type)
 */
function fn_get_user_short_info($user_id)
{
    $condition = db_quote(' user_id = ?i AND status = ?s', $user_id, 'A');
    $join = '';
    $group_by = '';
    $fields = array('user_id', 'user_login', 'company_id', 'firstname', 'lastname', 'email', 'user_type');

    /**
     * Actions before getting short user data
     *
     * @param int    $user_id   User identifier
     * @param array  $fields    Fields to be retrieved
     * @param string $condition Conditions
     * @param string $join      Joins
     * @param string $group_by  Group by condition
     */
    fn_set_hook('get_user_short_info_pre', $user_id, $fields, $condition, $join, $group_by);

    $fields = implode(', ', $fields);

    return db_get_row('SELECT ?p FROM ?:users ?p WHERE ?p ?p', $fields, $join, $condition, $group_by);
}

//
// Get user name
//
function fn_get_user_name($user_id)
{
    if (!empty($user_id)) {
        $user_data = db_get_row("SELECT firstname, lastname FROM ?:users WHERE user_id = ?i", $user_id);
        if (!empty($user_data)) {
            return $user_data['firstname'] . ' ' . $user_data['lastname'];
        }
    }

    return false;
}

/**
 * Get user data for API
 *
 * @param string $email   User email
 * @param string $api_key User raw API key
 * @param string $token   Token
 *
 * @return array
 */
function fn_get_api_user($email, $api_key, $token = '')
{
    list($email, $api_key, $token) = array_map('trim', [$email, $api_key, $token]);
    $user_data = [];

    if ($token) {
        $join = 'LEFT JOIN ?:ekeys AS ekeys ON users.user_id = ekeys.object_id';
        $condition = db_quote('ekeys.ekey = ?s AND ekeys.object_type = ?s', $token, 'U');
        $user_data = db_get_row('SELECT users.* FROM ?:users AS users ?p WHERE ?p', $join, $condition);
    } elseif ($api_key && $email) {
        $condition = db_quote('email = ?s AND api_key <> ?s', $email, '');
        $user_data = db_get_row('SELECT * FROM ?:users WHERE ?p', $condition);
        $user_data = isset($user_data['api_key']) && fn_verify_api_key($api_key, $user_data['api_key'])
            ? $user_data
            : [];
    }

    return $user_data;
}

/**
 * Generates user API key hash
 *
 * @param string $api_key User API key
 *
 * @return bool|string
 */
function fn_generate_api_key_hash($api_key)
{
    return password_hash($api_key, PASSWORD_DEFAULT);
}

/**
 * Check if provided key is valid
 *
 * @param string $api_key       Raw API key
 * @param string $encrypted_key Encrypted API key
 *
 * @return bool
 */
function fn_verify_api_key($api_key, $encrypted_key)
{
    return password_verify($api_key, $encrypted_key);
}

/**
 * Fetches user profiles data
 *
 * @param int   $user_id User identifier
 * @param array $params  Additional parameters
 *
 * @return array
 */
function fn_get_user_profiles($user_id, array $params = [])
{
    $params = array_merge([
        'fetch_fields_values' => false,
        'fetch_descriptions'  => false,
    ], $params);

    $profiles = [];
    if (!empty($user_id)) {
        $fields = ['profile_id', 'profile_type', 'profile_name'];
        if ($params['fetch_fields_values']) {
            $fields = ['*'];
        }

        $profiles = db_get_hash_array('SELECT ?p FROM ?:user_profiles WHERE user_id = ?i ORDER BY profile_id', 'profile_id', implode(', ', $fields), $user_id);

        if ($params['fetch_descriptions']) {
            foreach ($profiles as &$profile) {
                fn_add_user_data_descriptions($profile);
            }
            unset($profile);
        }
    }

    return $profiles;
}

/**
 * Checks if shipping and billing addresses are different
 *
 * @param array $profile_fields profile fields
 * @return bool true if different, false - otherwise
 */
function fn_check_shipping_billing($user_data, $profile_fields)
{
    if (empty($user_data)) {
        return false;
    }

    if (Registry::get('settings.Checkout.address_position') == 'billing_first') {
        $first = 'B';
        $second = 'S';
    } else {
        $first = 'S';
        $second = 'B';
    }

    if (!empty($profile_fields[$second])) {
        foreach ($profile_fields[$second] as $v) {
            // Workaround for email field
            if ($v['field_name'] == 'email') {
                continue;
            }

            $id = !empty($v['field_name']) ? $v['field_name'] : $v['field_id'];
            $matching_id = !empty($profile_fields[$first][$v['matching_id']]) ? (!empty($v['field_name']) ? ($profile_fields[$first][$v['matching_id']]['field_name']) : $v['matching_id']) : 0;
            $udata = !empty($v['field_name']) ? $user_data : (!empty($user_data['fields']) ? $user_data['fields'] : array());

            // If field is set in shipping section and disabled in billing, so - different
            if ((!empty($udata[$id]) || (empty($udata[$id]) && !empty($v['required']) && $v['required'] == 'Y')) && empty($matching_id)) {
                return true;
            }

            // If field set in both sections and fields are different, so -
            if (isset($udata[$id]) && isset($udata[$matching_id]) && $udata[$id] != $udata[$matching_id]) {
                return true;
            }
        }
    }

    return false;
}

/**
 * Compare fields in shipping and billing sections
 *
 * @param array $profile_fields profile fields
 * @return bool true if billing section contains all fields from shipping section, false - otherwise
 */
function fn_compare_shipping_billing($profile_fields)
{

    if (Registry::get('settings.Checkout.address_position') == 'billing_first') {
        $from_section = 'B';
        $to_section = 'S';
    } else {
        $from_section = 'S';
        $to_section = 'B';
    }

    if (empty($profile_fields[$from_section]) || empty($profile_fields[$to_section])) {
        return false;
    }

    foreach ($profile_fields[$to_section] as $v) {
        // If field is set in shipping section and disabled in billing, so - different
        if (empty($profile_fields[$from_section][$v['matching_id']]) && $v['required'] == 'Y') {
            return false;

        } elseif (!empty($profile_fields[$from_section][$v['matching_id']]) && $v['required'] == 'Y' && $profile_fields[$from_section][$v['matching_id']]['required'] != 'Y') {
            return false;
        }
    }

    return true;
}

/**
 * Get all usergroups list
 *
 * @param array  $params    Query criteria params, for example: array('status'=>'A', 'type'=>'C')
 * @param string $lang_code Two-letter language code
 *
 * @return array Usergroups list
 */
function fn_get_usergroups($params = array(), $lang_code = CART_LANGUAGE)
{
    $usergroups = array();

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        /**
         * Executes at the beginning of the function, allowing you to modify the arguments passed to the usergrousps-fetching function
         *
         * @param array  $params      Query criteria params, for example: array('status'=>'A', 'type'=>'C')
         * @param string $lang_code   Two-letter language code
         */
        fn_set_hook('get_usergroups_pre', $params, $lang_code);

        $field_list = "a.usergroup_id, a.status, a.type, b.usergroup";
        $join = $condition = $group_by = $limit = '';
        $order_by = 'ORDER BY usergroup';

        if (!empty($params['usergroup_id'])) {
            $condition .= is_array($params['usergroup_id'])
                ? db_quote(' AND a.usergroup_id IN (?n)', $params['usergroup_id'])
                : db_quote(' AND a.usergroup_id = ?i', $params['usergroup_id']);
        }
        if (!empty($params['status'])) {
            $condition .= is_array($params['status'])
                ? db_quote(' AND a.status IN (?a)', $params['status'])
                : db_quote(' AND a.status = ?s', $params['status']);
        }
        if (!empty($params['exclude_types'])) {
            $condition .= is_array($params['exclude_types'])
                ? db_quote(' AND a.type NOT IN (?a)', $params['exclude_types'])
                : db_quote(' AND a.type != ?s', $params['exclude_types']);
        }
        if (!empty($params['type'])) {
            $condition .= db_quote(' AND a.type IN (?a)', (array) $params['type']);
        }

        $condition .= db_quote(' AND a.type IN (?a)', UsergroupTypes::getAll());

        /**
         * Executes right before performing usergroup-fetching query, allowing you to modify the SQL-query
         *
         * @param array  $params      Query criteria params, for example: array('status'=>'A', 'type'=>'C')
         * @param string $lang_code   Two-letter language code
         * @param string $field_list  String of comma-separated SQL fields to be selected in an SQL-query
         * @param string $join        String with the complete JOIN information (JOIN type, tables and fields) for an SQL-query
         * @param string $condition   String containing SQL-query condition possibly prepended with a logical operator (AND or OR)
         * @param string $group_by    String containing the SQL-query GROUP BY field
         * @param string $order_by    String containing the SQL-query ORDER BY field
         * @param string $limit       String containing the SQL-query LIMIT field
         */
        fn_set_hook('get_usergroups', $params, $lang_code, $field_list, $join, $condition, $group_by, $order_by, $limit);

        $usergroups += db_get_hash_array(
            "SELECT ?p"
            . " FROM ?:usergroups as a"
            . " LEFT JOIN ?:usergroup_descriptions as b"
                . " ON b.usergroup_id = a.usergroup_id"
                . " AND b.lang_code = ?s"
            . " ?p"
            . " WHERE 1 ?p"
            . " ?p ?p ?p",
            'usergroup_id',
            $field_list,
            $lang_code,
            $join,
            $condition,
            $group_by,
            $order_by,
            $limit
        );

        if (!empty($params['with_privileges']) && !empty($usergroups)) {
            $privileges = db_get_hash_multi_array(
                'SELECT usergroup_id, privilege FROM ?:usergroup_privileges WHERE usergroup_id IN (?n)',
                array('usergroup_id','privilege','privilege'),
                array_keys($usergroups)
            );

            foreach ($usergroups as $usergroup_id => $usergroup) {
                if ($usergroup['type'] == 'A') {
                    $usergroups[$usergroup_id]['privileges'] = isset($privileges[$usergroup_id])
                        ? array_values($privileges[$usergroup_id])
                        : array();
                }
            }
        }

        if (!empty($params['include_default'])
            && (empty($params['type']) || $params['type'] == 'C')      // All default usergroups have type = C
            && (empty($params['status']) || in_array('A', (array) $params['status']))  // and status = A
        ) {
            foreach (fn_get_default_usergroups($lang_code) as $group) {
                if (empty($params['usergroup_id']) || in_array($group['usergroup_id'], (array) $params['usergroup_id'])) {
                    $usergroups[$group['usergroup_id']] = $group;
                }
            }
        }

        /**
         * Executes after all usergroups were fetched from DB and all data post-processing was done.
         *
         * @param array  $usergroups  Usergroups list
         * @param array  $params      Query criteria params, for example: array('status'=>'A', 'type'=>'C')
         * @param string $lang_code   Two-letter language code
         */
        fn_set_hook('get_usergroups_post', $usergroups, $params, $lang_code);
    }

    return $usergroups;
}

function fn_get_default_usergroups($lang_code = CART_LANGUAGE)
{
    $default_usergroups = array(
        array(
            'usergroup_id' => USERGROUP_ALL,
            'status' => 'A',
            'type' => 'C',
            'usergroup' => __('all', '', $lang_code)
        ),
        array(
            'usergroup_id' => USERGROUP_GUEST,
            'status' => 'A',
            'type' => 'C',
            'usergroup' => __('guest', '', $lang_code)
        ),
        array(
            'usergroup_id' => USERGROUP_REGISTERED,
            'status' => 'A',
            'type' => 'C',
            'usergroup' => __('usergroup_registered', '', $lang_code)
        )
    );

    fn_set_hook('get_default_usergroups', $default_usergroups, $lang_code);

    return $default_usergroups;
}

/**
 * Get simple list of usergroups
 *
 * @param string $type        Type of usergroups (C - customers, A - administrators)
 * @param bool   $get_default If set, default usergroups will be returned too (all, guest, registred)
 * @param string $lang_code   2-letters language code
 *
 * @return array like usergroup_id => usergroup_name
 */
function fn_get_simple_usergroups($type, $get_default = false, $lang_code = CART_LANGUAGE)
{
    $usergroups = array();

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        if ($get_default) {
            $default_usergroups = fn_get_default_usergroups($lang_code);
            foreach ($default_usergroups as $usergroup) {
                if ($usergroup['usergroup_id'] == USERGROUP_ALL) {
                    continue;
                }
                $usergroups[$usergroup['usergroup_id']] = $usergroup['usergroup'];
            }
        }

        $where = (AREA == 'C') ? " a.status = 'A'" : " a.status IN ('A', 'H')";

        if ($type == 'C' || AREA == 'C') {
            $where .= " AND a.type = 'C'";
        } elseif ($type == 'A') {
            $where .= " AND a.type = 'A'";
        }
        $_usergroups = db_get_hash_single_array(
            'SELECT a.usergroup_id, b.usergroup'
                . ' FROM ?:usergroups as a'
                . ' LEFT JOIN ?:usergroup_descriptions as b'
                . ' ON b.usergroup_id = a.usergroup_id AND b.lang_code = ?s'
                . ' WHERE ?p ORDER BY usergroup',
            array('usergroup_id', 'usergroup'),
            $lang_code,
            $where
        );
        $usergroups = $usergroups + $_usergroups;
    }

    return $usergroups;
}

//
// Get usergroup description
//
function fn_get_usergroup_name($id, $lang_code = CART_LANGUAGE)
{
    if (!empty($id)) {
        return db_get_field("SELECT usergroup FROM ?:usergroup_descriptions WHERE usergroup_id = ?i AND lang_code = ?s", $id, $lang_code);
    }

    return false;
}

/**
 * Fills descriptions of the user data fields (country, state).
 *
 * @param array     $user_data  User data.
 * @param string    $lang_code  Two-letter language code.
 */
function fn_add_user_data_descriptions(&$user_data, $lang_code = CART_LANGUAGE)
{
    fn_fill_user_fields($user_data);

    // Replace country and state values with their descriptions
    if (!empty($user_data['b_country'])) {
        $user_data['b_country_descr'] = fn_get_country_name($user_data['b_country'], $lang_code);
    }
    if (!empty($user_data['s_country'])) {
        $user_data['s_country_descr'] = fn_get_country_name($user_data['s_country'], $lang_code);
    }
    if (!empty($user_data['b_state'])) {
        $user_data['b_state_descr'] = fn_get_state_name($user_data['b_state'], $user_data['b_country'], $lang_code);
        if (empty($user_data['b_state_descr'])) {
            $user_data['b_state_descr'] = $user_data['b_state'];
        }
    }
    if (!empty($user_data['s_state'])) {
        $user_data['s_state_descr'] = fn_get_state_name($user_data['s_state'], $user_data['s_country'], $lang_code);
        if (empty($user_data['s_state_descr'])) {
            $user_data['s_state_descr'] = $user_data['s_state'];
        }
    }
}

function fn_fill_address(&$user_data, &$profile_fields, $use_default = false)
{
    if (Registry::get('settings.Checkout.address_position') == 'billing_first' || $use_default) {
        $from = ProfileFieldSections::BILLING_ADDRESS;
        $to = ProfileFieldSections::SHIPPING_ADDRESS;
    } else {
        $from = ProfileFieldSections::SHIPPING_ADDRESS;
        $to = ProfileFieldSections::BILLING_ADDRESS;
    }

    if (!empty($profile_fields[$to])) {
        // Clean shipping/billing data
        foreach ($profile_fields[$to] as $field_id => $v) {

            if (!empty($v['matching_id']) && isset($profile_fields[$from][$v['matching_id']]['field_name'])) {
                if ($profile_fields[$from][$v['matching_id']]['field_name'] == $v['field_name']) {
                    continue;
                }
            }

            if (!empty($v['field_name'])) {
                if (empty($v['matching_id']) || (!empty($v['matching_id']) && isset($profile_fields[$from][$v['matching_id']]))) {
                    $user_data[$v['field_name']] = '';
                }
            } else {
                if (empty($v['matching_id']) || (!empty($v['matching_id']) && isset($profile_fields[$from][$v['matching_id']]))) {
                    $user_data['fields'][$v['field_id']] = '';
                }
            }
        }

        // Fill shipping/billing data with billing/shipping
        foreach ($profile_fields[$to] as $v) {
            if (isset($profile_fields[$from][$v['matching_id']])) {
                if (!empty($v['field_name']) && !empty($user_data[$profile_fields[$from][$v['matching_id']]['field_name']])) {
                    $user_data[$v['field_name']] = $user_data[$profile_fields[$from][$v['matching_id']]['field_name']];

                } elseif (!empty($user_data['fields'][$profile_fields[$from][$v['matching_id']]['field_id']])) {
                    $user_data['fields'][$v['field_id']] = $user_data['fields'][$profile_fields[$from][$v['matching_id']]['field_id']];
                }
            }
        }
    }
}

/**
 * Converts the values of all profile fields with the "Date" type in a user's profile to timestamps.
 *
 * @param  array   $user_data       The array with all data of a user.
 * @param  array   $profile_fields  The array with all the profile fields and their types that exist in the store.
 *
 * @return void
 */
function fn_convert_profile_dates_to_timestamps(&$user_data, $profile_fields)
{
    $profile_fields_sections_to_convert = [
        ProfileFieldSections::CONTACT_INFORMATION,
        ProfileFieldSections::BILLING_ADDRESS,
        ProfileFieldSections::SHIPPING_ADDRESS,
    ];
    foreach ($profile_fields_sections_to_convert as $section) {
        if (empty($profile_fields[$section])) {
            continue;
        }

        foreach ($profile_fields[$section] as $v) {
            if (!empty($v['field_name']) && !empty($user_data[$v['field_name']])) {

                if ($v['field_type'] == ProfileFieldTypes::DATE) {
                    $user_data[$v['field_name']] = fn_parse_date($user_data[$v['field_name']]);
                }

            } elseif (!empty($user_data['fields'][$v['field_id']])) {

                if ($v['field_type'] == ProfileFieldTypes::DATE) {
                    $user_data['fields'][$v['field_id']] = fn_parse_date($user_data['fields'][$v['field_id']]);
                }
            }
        }
    }
}

/**
 * Initializes user data fields.
 * If some of the base fields were not defined they will be added as empty.
 *
 * @param array $user_data  User data.
 *
 * @return bool
 */
function fn_fill_user_fields(&$user_data)
{
    $exclude = [
        'user_login', 'password', 'user_type', 'status', 'cart_content', 'timestamp', 'referer', 'last_login',
        'lang_code', 'user_id', 'profile_id', 'profile_type', 'profile_name', 'tax_exempt', 'salt', 'company_id',
    ];

    /**
     * Allows to initialize user data fields.
     *
     * @param array $exclude    List of excluded fields.
     * @param array $user_data  User data.
     */
    fn_set_hook('fill_user_fields', $exclude, $user_data);

    $profile_fields = fn_get_table_fields('user_profiles', $exclude);
    $fields = fn_array_merge($profile_fields, fn_get_table_fields('users', $exclude), false);

    $fill = [
        'b_firstname' => ['firstname', 's_firstname'],
        'b_lastname'  => ['lastname', 's_lastname'],
        's_firstname' => ['b_firstname', 'firstname'],
        's_lastname'  => ['b_lastname', 'lastname'],
        'firstname'   => ['b_firstname', 's_firstname'],
        'lastname'    => ['b_lastname', 's_lastname'],
    ];

    foreach ($fill as $field_to_fill => list($first, $second)) {
        if (isset($user_data[$field_to_fill])) {
            continue;
        }

        $value = '';
        if (!empty($user_data[$first])) {
            $value = $user_data[$first];
        } elseif (!empty($user_data[$second])) {
            $value = $user_data[$second];
        }

        $user_data[$field_to_fill] = $value;
    }

    // Fill empty fields to avoid php notices
    foreach ($fields as $field) {
        if (empty($user_data[$field])) {
            $user_data[$field] = '';
        }
    }

    // Fill address with default data
    if (!fn_is_empty($user_data)) {
        $default = array(
            's_country' => 'default_country',
            'b_country' => 'default_country',
        );

        foreach ($default as $field_to_fill => $fill_from) {
            if (empty($user_data[$field_to_fill])) {
                $user_data[$field_to_fill] = Registry::get('settings.General.' . $fill_from);
            }
        }
    }

    return true;
}

function fn_get_profile_fields($location = 'C', $_auth = array(), $lang_code = CART_LANGUAGE, $params = array())
{
    $auth = & Tygh::$app['session']['auth'];
    $select = '';

    $default_params = array(
        'profile_type' => ProfileTypes::CODE_USER,
    );

    $params = array_merge($default_params, $params);

    if (empty($_auth)) {
        $_auth = $auth;
    }

    if (!empty($params['get_custom'])) {
        $condition = "WHERE ?:profile_fields.is_default = 'N' ";
    } else {
        $condition = 'WHERE 1=1 ';
    }

    if (!empty($params['get_profile_required'])) {
        $condition .= "AND ?:profile_fields.profile_required = 'Y' ";
    }
    if (!empty($params['get_checkout_required'])) {
        $condition .= "AND ?:profile_fields.checkout_required = 'Y' ";
    }
    if (!empty($params['profile_type']) && empty($params['field_id'])) {
        $condition .= db_quote('AND ?:profile_fields.profile_type = ?s ', $params['profile_type']);
    }
    if (!empty($params['section'])) {
        $condition .= db_quote('AND ?:profile_fields.section = ?s ', $params['section']);
    }
    if (!empty($params['include_ids'])) {
        $condition .= db_quote('AND ?:profile_fields.field_id IN (?a) ', $params['include_ids']);
    }
    if (!empty($params['exclude_names'])) {
        $condition .= db_quote('AND ?:profile_fields.field_name NOT IN (?a) ', $params['exclude_names']);
    }
    if (!empty($params['include_names'])) {
        $condition .= db_quote('AND ?:profile_fields.field_name IN (?a) ', $params['include_names']);
    }

    fn_set_hook('change_location', $location, $select, $condition, $params);

    if ($location == 'A' || $location == 'V' || $location == 'C') {
        $select .= ", ?:profile_fields.profile_required as required";
        $condition .= " AND ?:profile_fields.profile_show = 'Y'";
    } elseif ($location == 'O' || $location == 'I') {
        $select .= ", ?:profile_fields.checkout_required as required";
        $condition .= " AND ?:profile_fields.checkout_show = 'Y'";
    }

    if (!empty($params['field_id'])) {
        $condition .= db_quote(' AND ?:profile_fields.field_id = ?i', $params['field_id']);
    }

    fn_set_hook('get_profile_fields', $location, $select, $condition);

    // Determine whether to retrieve or not email field
    $skip_email_field = isset($params['skip_email_field']) ? $params['skip_email_field'] : null;

    if ($location != 'I' && $skip_email_field === null) {
        if ($location == 'O' && Registry::get('settings.Checkout.disable_anonymous_checkout') == 'Y' && empty($_auth['user_id'])) {
            $skip_email_field = true;
        } elseif (strpos('APVC', $location) !== false) {
            $skip_email_field = true;
        }
    }

    if ($skip_email_field) {
        $condition .= " AND ?:profile_fields.field_type != 'E'";
    }
    $profile_fields = db_get_hash_multi_array("SELECT ?:profile_fields.*, ?:profile_field_descriptions.description $select FROM ?:profile_fields LEFT JOIN ?:profile_field_descriptions ON ?:profile_field_descriptions.object_id = ?:profile_fields.field_id AND ?:profile_field_descriptions.object_type = 'F' AND lang_code = ?s $condition ORDER BY ?:profile_fields.position", array('section', 'field_id'), $lang_code);
    $matches = array();

    // Collect matching IDs
    if (!empty($profile_fields[ProfileFieldSections::SHIPPING_ADDRESS])) {
        foreach ($profile_fields[ProfileFieldSections::SHIPPING_ADDRESS] as $v) {
            $matches[$v['matching_id']] = $v['field_id'];
        }
    }

    $profile_fields[ProfileFieldSections::ESSENTIALS][] = [
        'section'     => ProfileFieldSections::ESSENTIALS,
        'field_type'  => ProfileFieldTypes::INPUT,
        'field_name'  => 'email',
        'description' => __('email'),
        'is_default'  => 'Y',
        'required'    => 'Y',
    ];

    foreach ($profile_fields as $section => $fields) {
        foreach ($fields as $k => $v) {
            if ($v['field_type'] === ProfileFieldTypes::SELECT_BOX || $v['field_type'] === ProfileFieldTypes::RADIO) {
                $_id = $v['field_id'];
                if ($section === ProfileFieldSections::BILLING_ADDRESS && $v['is_default'] === 'N') {
                    // If this field is enabled in billing section
                    if (!empty($matches[$v['field_id']])) {
                        $_id = $matches[$v['field_id']];
                    // Otherwise, get it from database
                    } else {
                        $_id = db_get_field("SELECT field_id FROM ?:profile_fields WHERE matching_id = ?i", $v['field_id']);
                    }
                }
                $profile_fields[$section][$k]['values'] = db_get_hash_single_array("SELECT ?:profile_field_values.value_id, ?:profile_field_descriptions.description FROM ?:profile_field_values LEFT JOIN ?:profile_field_descriptions ON ?:profile_field_descriptions.object_id = ?:profile_field_values.value_id AND ?:profile_field_descriptions.object_type = 'V' AND ?:profile_field_descriptions.lang_code = ?s WHERE ?:profile_field_values.field_id = ?i ORDER BY ?:profile_field_values.position", array('value_id', 'description'), $lang_code, $_id);
            }
        }
    }

    if (!empty($params['field_id'])) {
        $result = reset($profile_fields);
        if (!empty($result[$params['field_id']])) {
            return $result[$params['field_id']];
        } else {
            return array();
        }
    }

    $sections = [
        ProfileFieldSections::CONTACT_INFORMATION => true,
        ProfileFieldSections::BILLING_ADDRESS     => true,
        ProfileFieldSections::SHIPPING_ADDRESS    => true,
        ProfileFieldSections::ESSENTIALS          => true,
    ];

    $sections = array_intersect_key($sections, $profile_fields);
    $profile_fields = array_merge($sections, $profile_fields);

    /**
     * Actions after fetching profile fields list
     *
     * @param string $location       Location
     * @param array  $_auth          User authorization data
     * @param string $lang_code      Two-letters language code
     * @param array  $params         Additional parameters
     * @param array  $profile_fields Fetched profile fields list
     * @param array  $sections       Available sections
     */
    fn_set_hook('get_profile_fields_post', $location, $_auth, $lang_code, $params, $profile_fields, $sections);

    reset($profile_fields);

    return $profile_fields;
}

/**
 * Fetches profile field data
 *
 * @param integer $field_id  Field identifier
 * @param string  $lang_code Two-letters language code
 *
 * @return array
 */
function fn_get_profile_field($field_id, $lang_code = DESCR_SL)
{
    $profile_field = db_get_row(
        'SELECT * FROM ?:profile_fields AS pf'
        . ' LEFT JOIN ?:profile_field_descriptions AS pfd ON pf.field_id = pfd.object_id'
        . ' WHERE pf.field_id = ?i AND pfd.lang_code = ?s AND pfd.object_type = ?s',
        $field_id,
        $lang_code,
        'F'
    );

    return $profile_field;
}

/**
 * Fetches profile field sections
 *
 * @return array
 */
function fn_get_profile_fields_sections()
{
    $sections = db_get_hash_array('SELECT * FROM ?:profile_field_sections', 'code');
    $section_names = ProfileFieldSections::getAll();
    $sections = array_map(function ($section) use ($section_names) {
        $section['section_name'] = $section_names[$section['code']];
        return $section;
    }, $sections);

    return $sections;
}

/**
 * Updates profile fields sections data
 *
 * @param array $sections Profile field sections
 *
 * @return bool
 */
function fn_update_profile_field_sections($sections)
{
    foreach ($sections as $section_id => $section) {
        db_query('UPDATE ?:profile_field_sections SET ?u WHERE section_id = ?i', $section, $section_id);
    }

    return true;
}

/**
 * Sorts profile field groups by sections positions
 *
 * @param array $profile_fields Profile fields
 * @param array $sections       Profile fields sections
 *
 * @return array
 */
function fn_sort_profile_fields_by_section_position($profile_fields, $sections)
{
    uksort($profile_fields, function ($a, $b) use ($sections) {
        if (!isset($sections[$a]['position']) || !isset($sections[$b]['position'])) {
            return 0;
        }

        return $sections[$a]['position'] - $sections[$b]['position'];
    });

    return $profile_fields;
}

function fn_store_profile_fields($profile_data, $object_id, $object_type)
{
    if (!empty($profile_data['fields'])) {
        // Delete existing fields
        if ($object_type == ProfileDataTypes::USER_PROFILE) {
            $user_condition = db_quote('object_id = ?i AND object_type = ?s', $object_id[ProfileDataTypes::USER], ProfileDataTypes::USER);
            $profile_condition = db_quote('object_id = ?i AND object_type = ?s', $object_id[ProfileDataTypes::PROFILE], ProfileDataTypes::PROFILE);
            db_query('DELETE FROM ?:profile_fields_data WHERE (?p) OR (?p)', $user_condition, $profile_condition);
        } else {
            db_query('DELETE FROM ?:profile_fields_data WHERE object_id = ?i AND object_type = ?s', $object_id, $object_type);
        }

        $fields_info = db_get_hash_array('SELECT field_id, field_type, section FROM ?:profile_fields WHERE field_id IN (?n)', 'field_id', array_keys($profile_data['fields']));

        foreach ($profile_data['fields'] as $field_id => $value) {
            $_data = array();
            if ($object_type == ProfileDataTypes::USER_PROFILE) {
                $_data['object_type'] = ($fields_info[$field_id]['section'] == 'C') ? ProfileDataTypes::USER : ProfileDataTypes::PROFILE;
                $_data['object_id'] = ($fields_info[$field_id]['section'] == 'C') ? $object_id[ProfileDataTypes::USER] : $object_id[ProfileDataTypes::PROFILE];
            } else {
                $_data['object_type'] = $object_type;
                $_data['object_id'] = $object_id;
            }
            $_data['field_id'] = $field_id;
            $_data['value'] = ($fields_info[$field_id]['field_type'] == 'D')
                ? (empty($value) ? '' : fn_parse_date($value))
                : $value;

            db_query('REPLACE INTO ?:profile_fields_data ?e', $_data);
        }
    }

    return true;
}

/**
 * Fill the authentication parameters
 *
 * @param array   $user_data     User data are filled into auth
 * @param array   $original_auth Session user data
 * @param boolean $act_as_user   If set to true, other admin user logged in as current user
 * @param string  $area          One-letter site area identifier
 *
 * @return array  Authentication data
 */
function fn_fill_auth($user_data = [], $original_auth = [], $act_as_user = false, $area = AREA)
{
    $active_usergroups = fn_define_usergroups($user_data, $area);
    $ip = fn_get_ip();

    $auth = [
        'area' => !fn_check_user_type_admin_area($user_data) ? 'C' : 'A',
        'user_id' => empty($user_data['user_id']) ? 0 : $user_data['user_id'],
        'user_type' => !empty($user_data['user_type']) ? $user_data['user_type'] : 'C',
        'tax_exempt' => empty($user_data['tax_exempt']) ? 'N' : $user_data['tax_exempt'],
        'last_login' => empty($user_data['last_login']) ? 0 : $user_data['last_login'],
        'order_ids' => !empty($original_auth['order_ids']) ? $original_auth['order_ids'] : array(),
        'password_change_timestamp' => empty($user_data['password_change_timestamp']) ? 0 : $user_data['password_change_timestamp'],
        'company_id' => empty($user_data['company_id']) ? 0 : $user_data['company_id'],
        'is_root' => empty($user_data['is_root']) ? 'N' : $user_data['is_root'],
        'usergroup_ids' => $active_usergroups,
        'act_as_user' => $act_as_user,
        'this_login' => !empty($original_auth['this_login']) ? $original_auth['this_login'] : TIME,
        'referer' => !empty($original_auth['referer']) ? $original_auth['referer'] : (!empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''),
        'ip' => $ip['host']
    ];

    if (Registry::get('runtime.simple_ultimate')) {
        unset($auth['company_id']);
    }

    /**
     * Executes after auth data are filled,
     * allows to modify the function return result.
     *
     * @param array   $auth          Authentication data
     * @param boolean $user_data     User data are filled into auth
     * @param string  $area          One-letter site area identifier
     * @param array   $original_auth Session user data
     */
    fn_set_hook('fill_auth', $auth, $user_data, $area, $original_auth);

    return $auth;
}

/**
 * Determines usergroups the user belongs to.
 *
 * @param array  $user_data Logged in user data
 * @param string $area      One-letter site area identifier
 *
 * @return array Active usergroups IDs.
 */
function fn_define_usergroups($user_data = array(), $area = AREA)
{
    /**
     * Executes when determining usergroups the user belongs in the very beginning of the function,
     * allows to modify function parameters.
     *
     * @deprecated since 4.9.2, use define_usergroups_pre instead
     *
     * @param array  $user_data Logged in user data
     * @param string $area      One-letter site area identifier
     */
    fn_set_hook('pre_define_usergroups', $user_data, $area);

    /**
     * Executes when determining usergroups the user belongs in the very beginning of the function,
     * allows to modify function parameters.
     *
     * @param array  $user_data Logged in user data
     * @param string $area      One-letter site area identifier
     */
    fn_set_hook('define_usergroups_pre', $user_data, $area);

    if (fn_allowed_for('ULTIMATE:FREE')) {
        $active_usergroups = ($area == 'A')
            ? []
            : [USERGROUP_ALL, empty($user_data['user_id']) ? USERGROUP_GUEST : USERGROUP_REGISTERED];
    } else {
        // Get usergroup info
        if (empty($user_data['usergroups']) && !empty($user_data['user_id'])) {
            if ($area === 'C') {
                $usergroup_types = [UsergroupTypes::TYPE_CUSTOMER];
            } else {
                $usergroup_types = [UsergroupTypes::getUsergroupType($user_data['user_type'])];
            }

            /**
             * Executes when determining usergroup that user belongs to before fetching usergroups from the database,
             * allows to modify SQL query parts.
             *
             * @param array    $user_data       Logged in user data
             * @param string   $area            One-letter site area identifier
             * @param string[] $usergroup_types Usergroup types identifiers that should be fetched
             */
            fn_set_hook('define_usergroups', $user_data, $area, $usergroup_types);

            $_active_usergroups = db_get_fields(
                'SELECT lnk.usergroup_id FROM ?:usergroup_links as lnk'
                . ' INNER JOIN ?:usergroups ON ?:usergroups.usergroup_id = lnk.usergroup_id'
                    . ' AND ?:usergroups.status != ?s AND ?:usergroups.type IN (?a)'
                . ' WHERE lnk.user_id = ?i AND lnk.status = ?s',
                 'D', $usergroup_types, $user_data['user_id'], 'A'
             );
        }

        $active_usergroups = ($area === 'A')
            ? []
            : [USERGROUP_ALL, empty($user_data['user_id']) ? USERGROUP_GUEST : USERGROUP_REGISTERED];

        if ($area == 'C' && !empty($user_data['user_id']) && $user_data['user_id'] == 1) {
            $active_usergroups[] = USERGROUP_GUEST;
        }

        if (!empty($user_data['usergroups'])) {
            foreach ($user_data['usergroups'] as $ug_data) {
                if ($ug_data['status'] == 'A' && $ug_data['type'] == $area) {
                    $active_usergroups[] = $ug_data['usergroup_id'];
                }
            }
        }
        if (!empty($_active_usergroups)) {
            $active_usergroups = array_merge($active_usergroups, $_active_usergroups);
            $active_usergroups = array_unique($active_usergroups);
        }
    }

    /**
     * Executes after usergroups the user belongs to are determined,
     * allows to modify the function return result.
     *
     * @deprecated since 4.9.2, use define_usergroups_post instead
     *
     * @param int[]  $active_usergroups Usergroup IDs
     * @param array  $user_data         Logged in user data
     * @param string $area              One-letter site area identifier
     */
    fn_set_hook('post_define_usergroups', $active_usergroups, $user_data, $area);

    /**
     * Executes after usergroups the user belongs to are determined,
     * allows to modify the function return result.
     *
     * @param array  $user_data         Logged in user data
     * @param string $area              One-letter site area identifier
     * @param int[]  $active_usergroups Usergroup IDs
     */
    fn_set_hook('define_usergroups_post', $user_data, $area, $active_usergroups);

    return $active_usergroups;
}

//
// The function saves information into user_data table.
//
function fn_save_user_additional_data($type, $data, $user_id = 0)
{
    $auth = & Tygh::$app['session']['auth'];

    if (empty($user_id) && !empty($auth['user_id'])) {
        $user_id = $auth['user_id'];
    }

    if (empty($user_id)) {
        return false;
    }

    return db_query('REPLACE INTO ?:user_data ?e', array('user_id' => $user_id, 'type' => $type, 'data' => serialize($data)));
}

//
// The function returns information from user_data table.
//
function fn_get_user_additional_data($type, $user_id = 0)
{
    $auth = & Tygh::$app['session']['auth'];

    if (empty($user_id) && !empty($auth['user_id'])) {
        $user_id = $auth['user_id'];
    }

    if (empty($user_id)) {
        return false;
    }

    $data = db_get_field("SELECT data FROM ?:user_data WHERE user_id = ?i AND type = ?s", $user_id, $type);
    if (!empty($data)) {
        $data = unserialize($data);
    }

    return $data;
}

//
// The function returns description of user type.
//
function fn_get_user_type_description($type, $plural = false, $lang_code = CART_LANGUAGE)
{
    $type_descr = array(
        'S' => array(
            'C' => 'customer',
            'A' => 'administrator',
        ),
        'P' => array(
            'C' => 'customers',
            'A' => 'administrators',
        ),
    );

    fn_set_hook('get_user_type_description', $type_descr);

    $s = ($plural == true) ? 'P' : 'S';

    return empty($type_descr[$s][$type]) ? '' : __($type_descr[$s][$type], '', $lang_code);
}

/**
 * Getting users list
 *
 * @param  array  $params         Params list
 * @param  array  $auth           Auth
 * @param  int    $items_per_page Items per page
 * @param  string $custom_view    Custom view
 *
 * @return array
 */
function fn_get_users($params, &$auth, $items_per_page = 0, $custom_view = '')
{
    /**
     * Actions before getting users list
     *
     * @param array  $params         Params list
     * @param array  $auth           Auth data
     * @param int    $items_per_page Items per page
     * @param string $custom_view    Custom view
     */
    fn_set_hook('get_users_pre', $params, $auth, $items_per_page, $custom_view);

    // Init filter
    $_view = !empty($custom_view) ? $custom_view : 'users';
    $params = LastView::instance()->update($_view, $params);

    // Set default values to input params
    $default_params = array (
        'page' => 1,
        'items_per_page' => $items_per_page,
        'extended_search' => true,
    );

    $params = array_merge($default_params, $params);

    // Define fields that should be retrieved
    $fields = array(
        'user_id' => '?:users.user_id',
        'user_login' => '?:users.user_login',
        'is_root' => '?:users.is_root',
        'timestamp' => '?:users.timestamp',
        'user_type' => '?:users.user_type',
        'status' => '?:users.status',
        'firstname' => '?:users.firstname',
        'lastname' => '?:users.lastname',
        'email' => '?:users.email',
        'company' => '?:users.company',
        'company_id' => '?:users.company_id',
        'phone' => '?:users.phone',
    );

    // Define sort fields
    $sortings = array(
        'id' => '?:users.user_id',
        'username' => '?:users.user_login',
        'email' => '?:users.email',
        'name' => array('?:users.firstname', '?:users.lastname'),
        'date' => '?:users.timestamp',
        'type' => '?:users.user_type',
        'status' => '?:users.status',
        'phone' => '?:users.phone',
    );

    if ($params['extended_search']) {
        $fields['company_name'] = '?:companies.company as company_name';
        $sortings['company'] = 'company_name';
    }

    if (isset($params['compact']) && $params['compact'] == 'Y') {
        $union_condition = ' OR ';
    } else {
        $union_condition = ' AND ';
    }

    $condition = $compact_fields = array();
    $join = $group = '';

    $group .= " GROUP BY ?:users.user_id";

    if (isset($params['company']) && fn_string_not_empty($params['company'])) {
        $condition['company'] = db_quote(" AND ?:users.company LIKE ?l", "%".trim($params['company'])."%");
    }

    if (!$params['extended_search'] && isset($params['search_query'])) {
        $is_customer_list_search = true;
        $params['name'] = $params['search_query'];
    }

    if (isset($params['name']) && fn_string_not_empty($params['name'])) {
        $arr = fn_explode(' ', $params['name']);

        foreach ($arr as $k => $v) {
            if (!fn_string_not_empty($v)) {
                unset($arr[$k]);
            }
        }

        $like_expression = ' AND (';

        $search_string = '%' . trim($params['name']) . '%';

        if (sizeof($arr) == 2) {
            $like_expression .= db_quote('?:users.firstname LIKE ?l', '%' . array_shift($arr) . '%');
            $like_expression .= db_quote(' OR ?:users.lastname LIKE ?l', '%' . array_shift($arr) . '%');
        } else {
            $like_expression .= db_quote('?:users.firstname LIKE ?l', $search_string);
            $like_expression .= db_quote(' OR ?:users.lastname LIKE ?l', $search_string);
        }

        if (!empty($is_customer_list_search)) {
            $like_expression .= db_quote(' OR ?:users.email LIKE ?l', $search_string);
            $like_expression .= db_quote(' OR ?:users.phone LIKE ?l', $search_string);
            $like_expression .= db_quote(' OR ?:user_profiles.b_phone LIKE ?l', $search_string);
            $like_expression .= db_quote(' OR ?:user_profiles.s_phone LIKE ?l', $search_string);
        }

        $like_expression .= ')';
        $condition['name'] = $like_expression;

        $compact_fields[] = 'name';
    }

    if (isset($params['user_login']) && fn_string_not_empty($params['user_login'])) {
        $condition['user_login'] = db_quote(" $union_condition ?:users.user_login LIKE ?l", "%".trim($params['user_login'])."%");
        $compact_fields[] = 'user_login';
    }

    if (!empty($params['tax_exempt'])) {
        $condition['tax_exempt'] = db_quote(" AND ?:users.tax_exempt = ?s", $params['tax_exempt']);
    }

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        if (isset($params['usergroup_id']) && $params['usergroup_id'] != ALL_USERGROUPS) {
            if (!empty($params['usergroup_id'])) {
                $join .= db_quote(" LEFT JOIN ?:usergroup_links ON ?:usergroup_links.user_id = ?:users.user_id AND ?:usergroup_links.usergroup_id = ?i", $params['usergroup_id']);
                $condition['usergroup_links'] = " AND ?:usergroup_links.status = 'A'";
            } else {
                $join .= " LEFT JOIN ?:usergroup_links ON ?:usergroup_links.user_id = ?:users.user_id AND ?:usergroup_links.status = 'A'";
                $condition['usergroup_links'] = " AND ?:usergroup_links.user_id IS NULL";
            }
        }
    }

    if (!empty($params['status'])) {
        $condition['status'] = db_quote(" AND ?:users.status = ?s", $params['status']);
    }

    if (isset($params['email']) && fn_string_not_empty($params['email'])) {
        $condition['email'] = db_quote(" $union_condition ?:users.email LIKE ?l", "%".trim($params['email'])."%");
        $compact_fields[] = 'email';
    }

    if (isset($params['address']) && fn_string_not_empty($params['address'])) {
        $condition['address'] = db_quote(" AND (?:user_profiles.b_address LIKE ?l OR ?:user_profiles.s_address LIKE ?l)", "%".trim($params['address'])."%", "%".trim($params['address'])."%");
    }

    if (isset($params['zipcode']) && fn_string_not_empty($params['zipcode'])) {
        $condition['zipcode'] = db_quote(" AND (?:user_profiles.b_zipcode LIKE ?l OR ?:user_profiles.s_zipcode LIKE ?l)", "%".trim($params['zipcode'])."%", "%".trim($params['zipcode'])."%");
    }

    if (!empty($params['country'])) {
        $condition['country'] = db_quote(" AND (?:user_profiles.b_country LIKE ?l OR ?:user_profiles.s_country LIKE ?l)", "%$params[country]%", "%$params[country]%");
    }

    if (isset($params['state']) && fn_string_not_empty($params['state'])) {
        $condition['state'] = db_quote(" AND (?:user_profiles.b_state LIKE ?l OR ?:user_profiles.s_state LIKE ?l)", "%".trim($params['state'])."%", "%".trim($params['state'])."%");
    }

    if (isset($params['city']) && fn_string_not_empty($params['city'])) {
        $condition['city'] = db_quote(" AND (?:user_profiles.b_city LIKE ?l OR ?:user_profiles.s_city LIKE ?l)", "%".trim($params['city'])."%", "%".trim($params['city'])."%");
    }

    if (!empty($params['user_id'])) {
        $condition['user_id'] = db_quote(' AND ?:users.user_id IN (?n)', $params['user_id']);
    }

    if (isset($params['phone']) && fn_string_not_empty($params['phone'])) {
        $phone = '%' . trim($params['phone']) . '%';
        $condition['phone'] = db_quote(
            " AND (?:users.phone LIKE ?l OR ?:user_profiles.b_phone LIKE ?l OR ?:user_profiles.s_phone LIKE ?l)",
            $phone, $phone, $phone
        );
    }

    if (!empty($params['p_ids']) || !empty($params['product_view_id'])) {
        $arr = (strpos($params['p_ids'], ',') !== false || !is_array($params['p_ids'])) ? explode(',', $params['p_ids']) : $params['p_ids'];
        if (empty($params['product_view_id'])) {
            $condition['order_product_id'] = db_quote(" AND ?:order_details.product_id IN (?n)", $arr);
        } else {
            $condition['order_product_id'] = db_quote(" AND ?:order_details.product_id IN (?n)", db_get_fields(fn_get_products(array('view_id' => $params['product_view_id'], 'get_query' => true))));
        }

        $join .= db_quote(" LEFT JOIN ?:orders ON ?:orders.user_id = ?:users.user_id AND ?:orders.is_parent_order != 'Y' LEFT JOIN ?:order_details ON ?:order_details.order_id = ?:orders.order_id");
    }

    if (defined('RESTRICTED_ADMIN')) { // FIXME: NOT GOOD
        $condition['restricted_admin'] = db_quote(" AND ((?:users.user_type != 'A' AND ?:users.user_type != 'V') OR (?:users.user_type = 'A' AND ?:users.user_id = ?i))", $auth['user_id']);
    }

    // sometimes other vendor's admins could buy products from other vendors.
    if (!empty($params['user_type']) && (!($params['user_type'] == 'C' && Registry::get('runtime.company_id')) || fn_allowed_for('ULTIMATE'))) {
        $condition['user_type'] = db_quote(' AND ?:users.user_type = ?s', $params['user_type']);
    } else {

        // Get active user types
        $user_types = array_keys(fn_get_user_types());

        // Select only necessary groups frm all available
        if (!empty($params['user_types'])) {
            $user_types = array_intersect($user_types, $params['user_types']);
        }

        if (!empty($params['exclude_user_types'])) {
            $user_types = array_diff($user_types, $params['exclude_user_types']);
        }

        $condition['user_type'] = db_quote(" AND ?:users.user_type IN(?a)", $user_types);
    }

    $join .= db_quote(" LEFT JOIN ?:user_profiles ON ?:user_profiles.user_id = ?:users.user_id");

    if ($params['extended_search']) {
        $join .= db_quote(" LEFT JOIN ?:companies ON ?:companies.company_id = ?:users.company_id");
    }

    /**
     * Prepare params for getting users query
     *
     * @param array  $params    Params list
     * @param array  $fields    Fields list
     * @param array  $sortings  Sorting variants
     * @param array  $condition Conditions set
     * @param string $join      Joins list
     * @param array  $auth      Auth data
     */
    fn_set_hook('get_users', $params, $fields, $sortings, $condition, $join, $auth);

    if (!empty($params['compact']) && $params['compact'] == 'Y') {
        $compact_conditions = array();
        foreach ($compact_fields as $compact_field) {
            $compact_conditions[$compact_field] = $condition[$compact_field];
            unset($condition[$compact_field]);
        }
        $compact_sign = isset($compact_conditions['name']) ? '1' : '0';
        $condition['compact'] = ' AND (' . $compact_sign . ' ' . implode('', $compact_conditions) . ')';
    }

    $sorting = db_sort($params, $sortings, 'name', 'asc');

    // Used for Extended search
    if (!empty($params['get_conditions'])) {
        return array($fields, $join, $condition);
    }

    // Paginate search results
    $limit = '';
    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field("SELECT COUNT(DISTINCT(?:users.user_id)) FROM ?:users $join WHERE 1 ". implode(' ', $condition));
        $limit = db_paginate($params['page'], $params['items_per_page'], $params['total_items']);
    }

    $users = db_get_array("SELECT " . implode(', ', $fields) . " FROM ?:users $join WHERE 1" . implode('', $condition) . " $group $sorting $limit");

    LastView::instance()->processResults('users', $users, $params);

    /**
     * Actions after getting users list
     *
     * @param array $users  Users list
     * @param array $params Params list
     * @param array $auth   Auth data
     */
    fn_set_hook('get_users_post', $users, $params, $auth);

    return array($users, $params);
}

function fn_get_user_types()
{
    $types = array (
        'C' => 'add_customer',
        'A' => 'add_administrator',
    );

    fn_set_hook('get_user_types', $types);

    return $types;
}

/**
 * Gets the list of downloadable products available for the user
 *
 * @param array  $params         Params list
 * @param int    $items_per_page Items per page
 * @return array $products       The products that the customer can download
 */
function fn_get_user_edp($params, $items_per_page = 0)
{
    /**
     * Actions before getting the list of downloadable products available for the user
     *
     * @param array $params         Params list
     * @param int   $items_per_page Items per page
     */
    fn_set_hook('get_user_edp_pre', $params, $items_per_page);

    $default_params = array (
        'page' => 1,
        'items_per_page' => $items_per_page
    );

    $params = array_merge($default_params, $params);

    $fields = array (
        '?:order_details.product_id',
        '?:order_details.order_id',
        '?:order_details.extra',
        '?:orders.status',
        '?:products.unlimited_download',
        '?:product_descriptions.product'
    );

    $where = db_quote(' AND ?:orders.status != ?s', STATUS_INCOMPLETED_ORDER);
    $orders_company_condition = '';
    $limit = '';

    if (fn_allowed_for('ULTIMATE')) {
        $orders_company_condition = fn_get_company_condition('?:orders.company_id');
    }

    if (!empty($params['order_ids'])) {
        if (!is_array($params['order_ids'])) {
            $params['order_ids'] = array($params['order_ids']);
        }

        $where = db_quote(" AND ?:orders.order_id IN (?n)", $params['order_ids']);
    } elseif (!empty($params['items_per_page'])) {
        $params['total_items'] = count(db_get_fields(
            "SELECT COUNT(*)"
            . " FROM ?:order_details"
            . " INNER JOIN ?:orders ON ?:orders.order_id = ?:order_details.order_id AND ?:orders.is_parent_order != 'Y' $orders_company_condition"
            . " INNER JOIN ?:product_file_ekeys ON ?:product_file_ekeys.product_id = ?:order_details.product_id AND ?:product_file_ekeys.order_id = ?:order_details.order_id"
            . " INNER JOIN ?:product_files ON ?:product_files.product_id = ?:order_details.product_id"
            . " WHERE ?:orders.user_id = ?i AND ?:product_files.status = 'A'" . $where
            . " GROUP BY ?:order_details.product_id, ?:order_details.order_id",
            $params['user_id']
        ));
        $limit = db_paginate($params['page'], $params['items_per_page'], $params['total_items']);
    }

    /**
     * Modify the parameters passed to the query that gets the list of downloadable products available for the user
     *
     * @param array  $params    Params list
     * @param array  $fields    Fields list
     * @param string $where     String containing condition
     * @param string $limit     String containing the SQL-query LIMIT field
     */
    fn_set_hook('get_user_edp', $params, $fields, $where, $limit);

    $products = db_get_array(
        "SELECT " . implode(', ', $fields)
        . " FROM ?:order_details"
        . " INNER JOIN ?:product_files ON ?:product_files.product_id = ?:order_details.product_id"
        . " INNER JOIN ?:orders ON ?:orders.order_id = ?:order_details.order_id AND ?:orders.is_parent_order != 'Y' $orders_company_condition"
        . " INNER JOIN ?:product_file_ekeys ON ?:product_file_ekeys.product_id = ?:order_details.product_id AND ?:product_file_ekeys.order_id = ?:order_details.order_id"
        . " LEFT JOIN ?:products ON ?:products.product_id = ?:order_details.product_id"
        . " LEFT JOIN ?:product_descriptions ON ?:product_descriptions.product_id = ?:order_details.product_id AND ?:product_descriptions.lang_code = ?s"
        . " LEFT JOIN ?:product_file_folders ON ?:product_file_folders.product_id = ?:order_details.product_id"
        . " WHERE ?:orders.user_id = ?i AND ?:orders.is_parent_order != 'Y' AND ?:product_files.status = 'A' AND (?:product_file_folders.status = 'A' OR ?:product_files.folder_id IS NULL)" . $where
        . " GROUP BY ?:order_details.order_id, ?:order_details.product_id"
        . " ORDER BY ?:orders.order_id DESC $limit",
        CART_LANGUAGE, $params['user_id']
    );

    if (!empty($products)) {
        foreach ($products as $k => $v) {
            $_params = array (
                'product_id' => $v['product_id'],
                'order_id' => $v['order_id']
            );
            list($product_file_folders) = fn_get_product_file_folders($_params);
            list($product_files) = fn_get_product_files($_params);
            $products[$k]['files_tree'] = fn_build_files_tree($product_file_folders, $product_files);
        }
    }

    /**
     * Actions after getting the list of downloadable products available for the user
     *
     * @param array $params         Params list
     * @param int   $items_per_page Items per page
     * @param array $products       The products that the customer can download
     */
    fn_set_hook('get_user_edp_post', $params, $items_per_page, $products);

    return array($products, $params);
}

function fn_is_restricted_admin($params)
{
    if (!defined('RESTRICTED_ADMIN')) {
        return false;
    }

    $auth = & Tygh::$app['session']['auth'];

    $not_own_profile = false;
    $is_restricted = false;

    fn_set_hook('is_restricted_admin', $params, $is_restricted);

    if ($is_restricted) {
        return true;
    }

    if (!empty($params['user_id']) && $params['user_id'] != $auth['user_id']) {
        $requested_utype = db_get_field("SELECT user_type FROM ?:users WHERE user_id = ?i", $params['user_id']);
        if (in_array($requested_utype, array('A', 'V'))) {
            return true;
        }
        $not_own_profile = true;
    } elseif (empty($params['user_id'])) {
        $not_own_profile = true;
    }

    $user_type = isset($params['user_data']['user_type']) ? $params['user_data']['user_type'] : (isset($params['user_type']) ? $params['user_type'] : '');
    if ($not_own_profile && fn_check_user_type_admin_area($user_type)) {
        return true;
    }

    return false;
}

/**
 * This function initializes the session data of a selected user (cart, wishlist etc...)
 *
 * @param array $sess_data
 * @param int $user_id
 * @return true
 */

function fn_init_user_session_data(&$sess_data, $user_id, $skip_cart_saving = false)
{
    // Restore cart content
    $sess_data['cart'] = empty($sess_data['cart']) ? array() : $sess_data['cart'];

    // Cleanup cached shipping rates
    unset($sess_data['shipping_rates'], $sess_data['cart']['chosen_shipping']);

    fn_extract_cart_content($sess_data['cart'], $user_id, 'C');
    $profile_id = fn_get_session_data('last_order_profile_id');
    $sess_data['cart']['user_data'] = fn_get_user_info($user_id, true, $profile_id);

    $sess_data['product_notifications'] = array (
        'email' => !empty($sess_data['cart']['user_data']['email']) ? $sess_data['cart']['user_data']['email'] : '',
        'product_ids' => db_get_fields("SELECT product_id FROM ?:product_subscriptions WHERE user_id = ?i", $user_id)
    );

    if (!$skip_cart_saving) {
        fn_save_cart_content($sess_data['cart'], $user_id);
    }

    /** @var \Tygh\Location\Manager $manager */
    $manager = Tygh::$app['location'];
    $manager->setIsDetected(true);
    list($sess_data['cart']['user_data'],) = $manager->setLocationFromUserData($sess_data['cart']['user_data']);

    fn_set_hook('init_user_session_data', $sess_data, $user_id);

    return true;
}

/**
 * Generate a random user password
 *
 * @param int $length - supposed lenght of the password
 * @return string - the password generated
 */
function fn_generate_password($length = USER_PASSWORD_LENGTH)
{
    $chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $nums = '1234567890';
    $i = 0;
    $password = '';
    while ($i < $length) {
        if ($i%2) {
            $password .= $chars {
                mt_rand(0, strlen($chars) - 1)
            };
        } else {
            $password .= $nums {
                mt_rand(0, strlen($nums) - 1)
            };
        }
        $i++;
    }

    return $password;
}

/**
 * Restores password, password1 and password2 with clear POST data.
 * Example: password1 = "Some<secret>password"
 *     Processed before $_REQUEST['user_data']['password1'] = 'Somepassword'
 *     Returned value $_REQUEST['user_data']['password1'] = 'Some<secret>password'
 *
 * @param array &$destination $_REQUEST
 * @param array &$source $_POST
 */
function fn_restore_processed_user_password(&$destination, &$source)
{
    $fields = array(
        'password', 'password1', 'password2'
    );

    foreach ($fields as $field) {
        if (isset($source[$field])) {
            $destination[$field] = $source[$field];
        }
    }
}

/**
 * Add/update user
 *
 * @param int   $user_id         User ID to update (empty for new user)
 * @param array $user_data       User data
 * @param array $auth            Authentication information
 * @param bool  $ship_to_another Flag indicates that shipping and billing fields are different
 * @param bool  $notify_user     Flag indicates that user should be notified
 *
 * @return array with user ID and profile ID if success, false otherwise
 */
function fn_update_user($user_id, $user_data, &$auth, $ship_to_another, $notify_user)
{
    /**
     * Actions before updating user
     *
     * @param int   $user_id         User ID to update (empty for new user)
     * @param array $user_data       User data
     * @param array $auth            Authentication information
     * @param bool  $ship_to_another Flag indicates that shipping and billing fields are different
     * @param bool  $notify_user     Flag indicates that user should be notified
     */
    fn_set_hook('update_user_pre', $user_id, $user_data, $auth, $ship_to_another, $notify_user);

    array_walk($user_data, 'fn_trim_helper');
    $register_at_checkout = isset($user_data['register_at_checkout']) && $user_data['register_at_checkout'] == 'Y' ? true : false;

    if (fn_allowed_for('ULTIMATE')) {
        if (AREA == 'A' && !empty($user_data['user_type']) && $user_data['user_type'] == 'C' && (empty($user_data['company_id']) || (Registry::get('runtime.company_id') &&  $user_data['company_id'] != Registry::get('runtime.company_id')))) {
            fn_set_notification('W', __('warning'), __('access_denied'));

            return false;
        }
    }

    $api_status_old = false;

    if (!empty($user_id)) {
        $current_user_data = db_get_row(
            "SELECT user_id, company_id, is_root, status, user_type, email, user_login, lang_code, password, salt, last_passwords"
            . " FROM ?:users WHERE user_id = ?i",
            $user_id
        );

        if (empty($current_user_data)) {
            fn_set_notification('E', __('error'), __('object_not_found', array('[object]' => __('user'))),'','404');

            return false;
        }

        if (!fn_check_editable_permissions($auth, $current_user_data)) {
            fn_set_notification('E', __('error'), __('access_denied'));

            return false;
        }

        if (!empty($user_data['profile_id']) && AREA != 'A') {
            $profile_ids = db_get_fields("SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i", $user_id);
            if (!in_array($user_data['profile_id'], $profile_ids)) {
                fn_set_notification('W', __('warning'), __('access_denied'));

                return false;
            }
        }

        if ($current_user_data['user_type'] == 'A' && AREA != 'A') {
            if (
                isset($user_data['email']) && $user_data['email'] != $current_user_data['email'] // Change email
                || !empty($user_data['password1']) || !empty($user_data['password2']) // Change password
            ) {
                fn_set_notification('E', __('error'), __('error_change_admin_data_in_frontend'));

                return false;
            }
        }

        if (fn_allowed_for('ULTIMATE')) {
            if (AREA != 'A' || empty($user_data['company_id'])) {
                //we should set company_id for the frontdend, in the backend company_id received from form
                if ($current_user_data['user_type'] == 'A') {
                    if (!isset($user_data['company_id']) || AREA != 'A' || Registry::get('runtime.company_id')) {
                        // reset administrator's company if it was not set to root
                        $user_data['company_id'] = $current_user_data['company_id'];
                    }
                } elseif (Registry::get('settings.Stores.share_users') == 'Y') {
                    $user_data['company_id'] = $current_user_data['company_id'];
                } else {
                    $user_data['company_id'] = Registry::ifGet('runtime.company_id', 1);
                }
            }
        }

        if (fn_allowed_for('MULTIVENDOR')) {
            if (AREA != 'A') {
                //we should set company_id for the frontend
                $user_data['company_id'] = $current_user_data['company_id'];
            }
        }

        $api_status_old = (bool) db_get_field("SELECT api_key FROM ?:users WHERE user_id = ?i", $user_id);

        $action = 'update';
    } else {
        $current_user_data = array(
            'status' => (AREA != 'A' && Registry::get('settings.General.approve_user_profiles') == 'Y') ? 'D' : (!empty($user_data['status']) ? $user_data['status'] : 'A'),
            'user_type' => 'C', // FIXME?
        );

        if (fn_allowed_for('ULTIMATE')) {
            if (!empty($user_data['company_id']) || Registry::get('runtime.company_id') || AREA == 'A') {
                //company_id can be received when we create user account from the backend
                $company_id = !empty($user_data['company_id']) ? $user_data['company_id'] : Registry::get('runtime.company_id');
                if (empty($company_id)) {
                    $company_id = fn_check_user_type_admin_area($user_data['user_type']) ? $user_data['company_id'] : fn_get_default_company_id();
                }
                $user_data['company_id'] = $current_user_data['company_id'] = $company_id;
            } else {
                fn_set_notification('W', __('warning'), __('access_denied'));

                return false;
            }
        }

        $action = 'add';

        $user_data['lang_code'] = !empty($user_data['lang_code']) ? $user_data['lang_code'] : CART_LANGUAGE;
        $user_data['timestamp'] = isset($user_data['timestamp']) ? fn_parse_date($user_data['timestamp']) : TIME;
    }

    $original_password = '';
    $current_user_data['password'] = !empty($current_user_data['password']) ? $current_user_data['password'] : '';
    $current_user_data['salt'] = !empty($current_user_data['salt']) ? $current_user_data['salt'] : '';

    // Set the user type
    $user_data['user_type'] = fn_check_user_type($user_data, $current_user_data);

    if (
        Registry::get('runtime.company_id')
        && !fn_allowed_for('ULTIMATE')
        && (
            !fn_check_user_type_admin_area($user_data['user_type'])
            || (
                isset($current_user_data['company_id'])
                && $current_user_data['company_id'] != Registry::get('runtime.company_id')
            )
        )
    ) {
        fn_set_notification('W', __('warning'), __('access_denied'));

        return false;
    }

    // Check if this user needs login/password
    if (fn_user_need_login($user_data['user_type'])) {
        // Check if user_login already exists
        // FIXME
        if (!isset($user_data['email'])) {
            $user_data['email'] = db_get_field("SELECT email FROM ?:users WHERE user_id = ?i", $user_id);
        }

        $is_exist = fn_is_user_exists($user_id, $user_data);

        if ($is_exist) {
            fn_set_notification('E', __('error'), __('error_user_exists'), '', 'user_exist');

            return false;
        }

        // Check the passwords
        if (!empty($user_data['password1']) || !empty($user_data['password2'])) {
            $user_data['password1'] = !empty($user_data['password1']) ? trim($user_data['password1']) : '';
            $original_password = $user_data['password1'];
            $user_data['password2'] = !empty($user_data['password2']) ? trim($user_data['password2']) : '';

        }

        // if the passwords are not set and this is not a forced password check
        // we will not update password, otherwise let's check password
        if (!empty(Tygh::$app['session']['auth']['forced_password_change']) || !empty($user_data['password1']) || !empty($user_data['password2'])) {

            $valid_passwords = true;

            if ($user_data['password1'] != $user_data['password2']) {
                $valid_passwords = false;
                fn_set_notification('E', __('error'), __('error_passwords_dont_match'));
            }

            // PCI DSS Compliance
            if (fn_check_user_type_admin_area($user_data['user_type'])) {

                $msg = array();
                // Check password length
                $min_length = Registry::get('settings.Security.min_admin_password_length');
                if (fn_strlen($user_data['password1']) < $min_length || fn_strlen($user_data['password2']) < $min_length) {
                    $valid_passwords = false;
                    $msg[] = str_replace("[number]", $min_length, __('error_password_min_symbols'));
                }

                // Check password content
                if (Registry::get('settings.Security.admin_passwords_must_contain_mix') == 'Y') {
                    $tmp_result = preg_match('/\d+/', $user_data['password1']) && preg_match('/\D+/', $user_data['password1']) && preg_match('/\d+/', $user_data['password2']) && preg_match('/\D+/', $user_data['password2']);
                    if (!$tmp_result) {
                        $valid_passwords = false;
                        $msg[] = __('error_password_content');
                    }
                }

                if ($msg) {
                    fn_set_notification('E', __('error'), implode('<br />', $msg));
                }

                // Check last 4 passwords
                if (!empty($user_id)) {
                    $prev_passwords = !empty($current_user_data['last_passwords']) ? explode(',', $current_user_data['last_passwords']) : array();

                    if (!empty(Tygh::$app['session']['auth']['forced_password_change'])) {
                        // if forced password change - new password can't be equal to current password.
                        $prev_passwords[] = $current_user_data['password'];
                    }

                    if (in_array(fn_generate_salted_password($user_data['password1'], $current_user_data['salt']), $prev_passwords)) {
                        $valid_passwords = false;
                        fn_set_notification('E', __('error'), __('error_password_was_used'));
                    } else {
                        if (count($prev_passwords) >= 5) {
                            array_shift($prev_passwords);
                        }
                        $user_data['last_passwords'] = implode(',', $prev_passwords);
                    }
                }
            } // PCI DSS Compliance

            if (!$valid_passwords) {
                return false;
            }

            $user_data['salt'] = fn_generate_salt();
            $user_data['password'] = fn_generate_salted_password($user_data['password1'], $user_data['salt']);
            if ($user_data['password'] != $current_user_data['password'] && !empty($user_id)) {
                // if user set current password - there is no necessity to update password_change_timestamp
                $user_data['password_change_timestamp'] = Tygh::$app['session']['auth']['password_change_timestamp'] = TIME;
            }
            unset(Tygh::$app['session']['auth']['forced_password_change']);
            fn_delete_notification('password_expire');

        }
    }

    $user_data['status'] = (AREA != 'A' || empty($user_data['status'])) ? $current_user_data['status'] : $user_data['status']; // only administrator can change user status

    // Fill the firstname, lastname and phone from the billing address if the profile was created or updated through the admin area.
    if (AREA == 'A' || Registry::get('settings.Checkout.address_position') == 'billing_first') {
        $main_address_zone = BILLING_ADDRESS_PREFIX;
        $alt_address_zone = SHIPPING_ADDRESS_PREFIX;
    } else {
        $main_address_zone = SHIPPING_ADDRESS_PREFIX;
        $alt_address_zone = BILLING_ADDRESS_PREFIX;
    }

    $user_data = fn_fill_contact_info_from_address($user_data, $main_address_zone, $alt_address_zone);

    if (!fn_allowed_for('ULTIMATE')) {
        //for ult company_id was set before
        fn_set_company_id($user_data);
    }

    if (!empty($current_user_data['is_root']) && $current_user_data['is_root'] == 'Y') {
        $user_data['is_root'] = 'Y';
    } else {
        $user_data['is_root'] = 'N';
    }

    // check if it is a root admin
    $is_root_admin_exists = db_get_field(
        "SELECT user_id FROM ?:users WHERE company_id = ?i AND is_root = 'Y' AND user_id != ?i",
        $user_data['company_id'], !empty($user_id) ? $user_id : 0
    );
    $user_data['is_root'] = empty($is_root_admin_exists) && $user_data['user_type'] !== 'C' ? 'Y' : 'N';

    unset($user_data['user_id']);

    if (!empty($user_data['raw_api_key'])) {
        $user_data['api_key'] = fn_generate_api_key_hash(trim($user_data['raw_api_key']));
    }

    if (!empty($user_id)) {
        db_query("UPDATE ?:users SET ?u WHERE user_id = ?i", $user_data, $user_id);

        fn_clean_usergroup_links($user_id, $current_user_data['user_type'], $user_data['user_type']);

        fn_log_event('users', 'update', array(
            'user_id' => $user_id,
        ));
    } else {
        if (!isset($user_data['password_change_timestamp'])) {
            $user_data['password_change_timestamp'] = 1;
        }

        $user_id = db_query("INSERT INTO ?:users ?e" , $user_data);

        fn_log_event('users', 'create', array(
            'user_id' => $user_id,
        ));
    }
    $user_data['user_id'] = $user_id;

    // Set/delete insecure password notification
    if (AREA == 'A' && Registry::get('config.demo_mode') != true && !empty($user_data['password1'])) {
        if (!fn_compare_login_password($user_data, $user_data['password1'])) {
            fn_delete_notification('insecure_password');
        } else {
            $lang_var = 'warning_insecure_password_email';

            fn_set_notification('E', __('warning'), __($lang_var, array(
                '[link]' => fn_url("profiles.update?user_id=" . $user_id)
            )), 'K', 'insecure_password');
        }
    }

    if (empty($user_data['user_login'])) { // if we're using email as login or user type does not require login, fill login field
        db_query("UPDATE ?:users SET user_login = 'user_?i' WHERE user_id = ?i AND user_login = ''", $user_id, $user_id);
    }

    // Fill shipping info with billing if needed
    if (empty($ship_to_another)) {
        $profile_fields = fn_get_profile_fields($user_data['user_type']);
        $use_default = (AREA == 'A') ? true : false;
        fn_fill_address($user_data, $profile_fields, $use_default);
    }

    $user_data['profile_id'] = fn_update_user_profile($user_id, $user_data, $action);

    $updated_user_info = fn_get_user_info($user_id, true, $user_data['profile_id']);
    $user_data = array_merge($user_data, $updated_user_info);

    if ($register_at_checkout) {
        $user_data['register_at_checkout'] = 'Y';
    }
    $lang_code = (AREA == 'A' && !empty($user_data['lang_code'])) ? $user_data['lang_code'] : CART_LANGUAGE;

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        $user_data['usergroups'] = db_get_hash_array(
            "SELECT lnk.link_id, lnk.usergroup_id, lnk.status, a.type, b.usergroup"
            . " FROM ?:usergroup_links as lnk"
            . " INNER JOIN ?:usergroups as a ON a.usergroup_id = lnk.usergroup_id AND a.status != 'D'"
            . " LEFT JOIN ?:usergroup_descriptions as b ON b.usergroup_id = a.usergroup_id AND b.lang_code = ?s"
            . " WHERE a.status = 'A' AND lnk.user_id = ?i AND lnk.status != 'D' AND lnk.status != 'F'"
            , 'usergroup_id', $lang_code, $user_id
        );
    }

    // Send notifications to customer
    if (!empty($notify_user)) {
        /** @var \Tygh\Mailer\Mailer $mailer */
        $mailer = Tygh::$app['mailer'];

        $from = 'company_users_department';

        if (fn_allowed_for('MULTIVENDOR')) {
            // Vendor administrator's notification
            // is sent from root users department
            if ($user_data['user_type'] == 'V') {
                $from = 'default_company_users_department';
            }
        }

        // Notify customer about profile activation (when update profile only)
        if ($action == 'update' && $current_user_data['status'] === 'D' && $user_data['status'] === 'A') {
            $mailer->send(array(
                'to' => $user_data['email'],
                'from' => $from,
                'data' => array(
                    'user_data' => $user_data
                ),
                'template_code' => 'profile_activated',
                'tpl' => 'profiles/profile_activated.tpl', // this parameter is obsolete and is used for back compatibility
                'company_id' => $user_data['company_id']
            ), fn_check_user_type_admin_area($user_data['user_type']) ? 'A' : 'C', $lang_code);

        } elseif ($action == 'update' && $current_user_data['status'] === 'A' && $user_data['status'] === 'D') {
            $mailer->send(array(
                'to' => $user_data['email'],
                'from' => $from,
                'data' => array(
                    'user_data' => $user_data
                ),
                'template_code' => 'profile_deactivated',
                'tpl' => 'profiles/profile_deactivated.tpl', // this parameter is obsolete and is used for back compatibility
                'company_id' => $user_data['user_type'] === 'C' ? $user_data['company_id'] : 0,
            ), fn_check_user_type_admin_area($user_data['user_type']) ? 'A' : 'C', $lang_code);
        }

        // Notify customer about profile add/update
        $prefix = ($action == 'add') ? 'create' : 'update';

        $url_suffix = '';
        if ($user_data['user_type'] == 'C' && !empty($user_data['company_id'])) {
            $url_suffix = '?company_id=' . $user_data['company_id'];
        }

        // Send password to user only if it was created by admin or vendor
        if ($action == 'add' && AREA != 'C' && $auth['user_id'] != $user_id) {
            $password = $original_password;
        } else {
            $password = null;
        }

        $api_status_new = !empty($user_data['api_key']);
        if ($api_status_new && !$api_status_old) {
            $api_access_status = 'enabled';
        } elseif ($api_status_old && !$api_status_new) {
            $api_access_status = 'disabled';
        } else {
            $api_access_status = 'unchanged';
        }

        $mailer->send(array(
            'to' => $user_data['email'],
            'from' => $from,
            'data' => array(
                'password' => $password,
                'user_data' => $user_data,
                'login_url' => fn_url('' . $url_suffix, $user_data['user_type']),
                'forgot_pass_url' => fn_url('auth.recover_password' . $url_suffix, $user_data['user_type']),
                'api_access_status' => $api_access_status,
            ),
            'template_code' => $prefix . '_profile',
            'tpl' => 'profiles/' . $prefix .'_profile.tpl', // this parameter is obsolete and is used for back compatibility
            'company_id' => $user_data['user_type'] === 'C' ? $user_data['company_id'] : 0,
        ), fn_check_user_type_admin_area($user_data['user_type']) ? 'A' : 'C', $lang_code);
    }

    if ($action == 'add') {
        if (AREA != 'A') {
            if (Registry::get('settings.General.approve_user_profiles') == 'Y') {
                /** @var \Tygh\Mailer\Mailer $mailer */
                $mailer = Tygh::$app['mailer'];

                fn_set_notification('W', __('important'), __('text_profile_should_be_approved'));

                // Notify administrator about new profile
                $mailer->send(array(
                    'to' => 'company_users_department',
                    'from' => 'company_users_department',
                    'reply_to' => $user_data['email'],
                    'data' => array(
                        'user_data' => $user_data,
                        'url' => fn_url('profiles.update?user_id=' . $user_data['user_id'], 'A')
                    ),
                    'template_code' => 'activate_profile',
                    'tpl' => 'profiles/activate_profile.tpl', // this parameter is obsolete and is used for back compatibility
                    'company_id' => $user_data['company_id']
                ), 'A', Registry::get('settings.Appearance.backend_default_language'));

            } else {
                fn_set_notification('N', __('information'), __('text_profile_is_created'));
            }
        }

        if (!is_null($auth)) {
            if (!empty($auth['order_ids'])) {
                db_query("UPDATE ?:orders SET user_id = ?i WHERE order_id IN (?n)", $user_id, $auth['order_ids']);
            }
        }
    } else {
        if (AREA == 'C') {
            fn_set_notification('N', __('information'), __('text_profile_is_updated'), '', 'profile_updated');
        }
    }

    fn_set_hook('update_profile', $action, $user_data, $current_user_data);

    return array($user_id, !empty($user_data['profile_id']) ? $user_data['profile_id'] : false);
}

/**
 * Cleans usergroup links if usertype was changed
 *
 * @param int $user_id User identifier
 * @param string $current_user_type Current user type
 * @param string $new_user_type New user type
 * @return bool True on success, false otherwise
 */
function fn_clean_usergroup_links($user_id, $current_user_type, $new_user_type)
{
    if ($current_user_type != $new_user_type) {
        $usergroup_links = db_get_fields(
            "SELECT ?:usergroup_links.link_id "
                . "FROM ?:usergroups JOIN ?:usergroup_links ON ?:usergroups.usergroup_id = ?:usergroup_links.usergroup_id "
            ."WHERE ?:usergroup_links.user_id = ?i AND ?:usergroup_links.status = 'A' AND ?:usergroups.type = ?s",
            $user_id, in_array($new_user_type, array('A', 'V')) ? 'C' : 'A'
        );

        if (!empty($usergroup_links)) {
            db_query("DELETE FROM ?:usergroup_links WHERE link_id IN (?n)", $usergroup_links);

            return true;
        }
    }

    return false;
}

/**
 * Updates profile data of registered user
 *
 * @param int    $user_id   User identifier
 * @param array  $user_data Profile information
 * @param string $action    Current action (Example: 'add')
 *
 * @return int profile ID
 */
function fn_update_user_profile($user_id, $user_data, $action = '')
{
    /**
     * Modify profile data of registered user
     *
     * @param int    $user_id   User identifier
     * @param array  $user_data Profile information
     * @param string $action    Current action (Example: 'add')
     */
    fn_set_hook('update_user_profile_pre', $user_id, $user_data, $action);

    $user_data['profile_update_timestamp'] = TIME;

    // Add new profile or update existing
    if ((isset($user_data['profile_id']) && empty($user_data['profile_id'])) || $action == 'add') {
        if ($action == 'add') {
            unset($user_data['profile_id']);

            $user_data['profile_type'] = 'P';
            $user_data['profile_name'] = empty($user_data['profile_name']) ? __('main') : $user_data['profile_name'];
        } else {
            $user_data['profile_type'] = 'S';
        }

        $user_data['user_id'] = $user_id;
        $user_data['profile_id'] = db_query('INSERT INTO ?:user_profiles ?e', $user_data);
    } else {
        if (empty($user_data['profile_id'])) {
            $user_data['profile_id'] = db_get_field("SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i AND profile_type = 'P'", $user_id);
        }
        $is_exists = db_get_field('SELECT COUNT(*) FROM ?:user_profiles WHERE user_id = ?i AND profile_id = ?i', $user_id, $user_data['profile_id']);

        if ($is_exists) {
            db_query("UPDATE ?:user_profiles SET ?u WHERE profile_id = ?i", $user_data, $user_data['profile_id']);
        } else {
            return false;
        }
    }

    // Add/Update additional fields
    fn_store_profile_fields($user_data, array('U' => $user_id, 'P' => $user_data['profile_id']), 'UP');

    /**
     * Perform actions after user profile update
     *
     * @param int    $user_id   User identifier
     * @param array  $user_data Profile information
     * @param string $action    Current action (Example: 'add')
     */
    fn_set_hook('update_user_profile_post', $user_id, $user_data, $action);

    return $user_data['profile_id'];
}

/**
 * Deletes user profile
 *
 * @param int $user_id User identifier
 * @param int $profile_id User profile identifier
 * @param bool $allow_delete_main Denie/Allow to delete main profile
 * @return bool True on success, false otherwise
 */
function fn_delete_user_profile($user_id, $profile_id, $allow_delete_main = false)
{
    // Allows to delete only secondary profiles
    $profile_condition = $allow_delete_main ? '' : db_quote(' AND profile_type = ?s', 'S');

    $can_delete = db_get_field(
        'SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i AND profile_id = ?i ?p',
        $user_id, $profile_id, $profile_condition
    );

    if (!empty($can_delete)) {
        db_query('DELETE FROM ?:user_profiles WHERE profile_id = ?i', $profile_id);
        db_query('DELETE FROM ?:profile_fields_data WHERE object_id = ?i AND object_type = ?s', $profile_id, 'P');
    }

    return !empty($can_delete);
}

/**
 * Check if user email equal to customer password
 *
 * @param array $user_data user data
 * @param string $password user password
 * @return boolean
 */
function fn_compare_login_password($user_data, $password)
{
    /**
     * Change user data
     *
     * @param array  $user_data user data
     * @param string $password  user password
     */
    fn_set_hook('compare_login_password_pre', $user_data, $password);

    $account = !empty($user_data['email']) ? $user_data['email'] : '';

    $result = $password == $account;

    /**
     * Change user data and checking result
     *
     * @param array   $user_data user data
     * @param string  $password  user password
     * @param string  $account   Contains customer email
     * @param boolean $result    checking result
     */
    fn_set_hook('compare_login_password_post', $user_data, $password, $account, $result);

    return $result;
}

/**
 * Check if specified account needs login
 *
 * @param string $user_type - user account type
 * @return bool true if needs login, false otherwise
 */
function fn_user_need_login($user_type)
{
    $types = array(
        'A',
        'C'
    );

    fn_set_hook('user_need_login', $types);

    return in_array($user_type, $types);
}

/**
 * Check compatible user types
 *
 * @param array $user_data - new user data
 * @param array $current_user_data - current user data
 * @return string user type
 */
function fn_check_user_type($user_data, $current_user_data)
{
    $compatible_types = array();

    $current_u_type = $current_user_data['user_type'];
    $u_type = !empty($user_data['user_type']) ? $user_data['user_type'] : $current_user_data['user_type'];

    $auth_user_type = isset(Tygh::$app['session']['auth']['user_type']) ? Tygh::$app['session']['auth']['user_type'] : null;

    if ($u_type == 'A' && $auth_user_type != 'A') {
        return $current_u_type;
    }

    if (AREA == 'A' || $u_type == $current_u_type) {
        return $u_type;
    }

    fn_set_hook('check_user_type', $compatible_types);

    return !empty($compatible_types[$current_u_type]) && in_array($u_type, $compatible_types[$current_u_type]) ? $u_type : $current_u_type;
}

function fn_check_user_type_admin_area($user_type = '')
{
    if (is_array($user_type)) {
        $user_type = !empty($user_type['user_type']) ? $user_type['user_type'] : '';
    }

    return ($user_type == 'A' || $user_type == 'V') ? true : false;
}

/**
 * Filter hidden fields, which were hidden to checkout
 *
 * @param array $user_data - user data
 * @param string $location - flag for including data
 * @return array filtered fields
 */
function fn_filter_hidden_profile_fields(&$user_data, $location)
{
    static $filtered = array();

    $condition = 'WHERE 1';

    if ($location == 'O') {
        $condition .= db_quote(' AND ?:profile_fields.checkout_show = ?s', 'N');
        $condition .= db_quote(' AND ?:profile_fields.profile_type = ?s', 'U');
    }

    if (!isset($filtered[$location])) {
        $filtered[$location] = db_get_array(
            'SELECT ?:profile_fields.field_name, ?:profile_fields.is_default'
            . ' FROM ?:profile_fields'
            . ' ?p',
            $condition
        );
    }

    foreach ($filtered[$location] as $field) {
        if (!empty($field['field_name']) && $field['is_default'] == 'Y') {
            /* Workaround for 'email' field */
            if ($field['field_name'] == 'email') {
                continue;
            }

            unset($user_data[$field['field_name']]);
        }
    }

    return $filtered[$location];
}

function fn_check_profile_fields_population($user_data, $section, $profile_fields)
{
    // If this section does not have fields, assume it's filled
    // or if we're checking shipping/billing section and shipping/billing address does not differ from billing/shipping, assume that fields filled correctly
    if ($section == 'B') {
        $check_section = 'S';
    } else {
        $check_section = 'B';
    }

    if (empty($profile_fields[$section]) || ($section == $check_section && fn_check_shipping_billing($user_data, $profile_fields) == false)) {
        return true;
    }

    foreach ($profile_fields[$section] as $field) {
        if ($field['required'] == 'Y'
            && (
                ($field['is_default'] == 'Y' && empty($user_data[$field['field_name']]))
                || ($field['is_default'] == 'N' && empty($user_data['fields'][$field['field_id']]))
            )
        ) {
            return false;
        }
    }

    return true;
}

/**
 * Check if specified user has access to the specified permission
 *
 * @param int $user_id - user id
 * @param string $permission - the permission, should be checked
 * @return boolean true if the user has access, false otherwise
 */
function fn_check_user_access($user_id, $permission)
{
    static $user_access = array();
    $user_id = (int) $user_id;

    if ($user_id <= 0) {
        return false;
    }

    if (fn_allowed_for('ULTIMATE:FREE')) {
        return true;
    }

    if (!isset($user_access[$user_id])) {
        $sql = <<<SQL
SELECT ?:usergroup_privileges.privilege
 FROM ?:usergroup_links
 LEFT JOIN ?:usergroup_privileges ON (?:usergroup_privileges.usergroup_id = ?:usergroup_links.usergroup_id)
 WHERE ?:usergroup_links.user_id = ?i AND ?:usergroup_links.status = ?s
SQL;
        $user_access[$user_id] = db_get_fields($sql, $user_id, 'A');
    }

    if (empty($user_access[$user_id]) || in_array($permission, $user_access[$user_id])) {
        return true;
    }

    return false;
}

/**
 * Check current user has access to the specified permission
 * @param string $permission
 * @return bool
 */
function fn_check_current_user_access($permission)
{
    $user_id = !empty(Tygh::$app['session']['auth']['user_id']) ? Tygh::$app['session']['auth']['user_id'] : 0;

    return $user_id && fn_check_user_access($user_id, $permission);
}

/**
 * Get available usergroups for user
 *
 * @TODO rename to fn_get_user_available_usergroups
 * @param int $user_id User ID
 * @return array with available usergroups
 */
function fn_get_user_usergroups($user_id)
{
    $usergroups = array();

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        $usergroups = db_get_hash_array("SELECT lnk.link_id, lnk.usergroup_id, lnk.status, ?:usergroups.type FROM ?:usergroup_links as lnk INNER JOIN ?:usergroups ON ?:usergroups.usergroup_id = lnk.usergroup_id AND ?:usergroups.status != 'D' WHERE lnk.user_id = ?i", 'usergroup_id', $user_id);
    }

    return $usergroups;
}

/**
 * Get all usergroups that have link with user
 *
 * @param int $user_id
 * @param array $criteria
 *
 * @return array
 */
function fn_get_user_usergroup_links($user_id, $criteria = array())
{
    $usergroups = array();

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        $where = '';

        if (!empty($criteria['status'])) {
            $where .= db_quote(' AND lnk.status IN (?a)', (array) $criteria['status']);
        } elseif (empty($criteria['all'])) {
            $where .= db_quote(' AND lnk.status != ?s', 'F');
        }

        $usergroups = db_get_hash_array(
            "SELECT lnk.link_id, lnk.usergroup_id, lnk.status"
            . " FROM ?:usergroup_links as lnk"
            . " INNER JOIN ?:usergroups"
            . " ON ?:usergroups.usergroup_id = lnk.usergroup_id"
            . " AND ?:usergroups.status != 'D'"
            . " WHERE lnk.user_id = ?i $where",
            'usergroup_id',
            $user_id
        );
    }

    return $usergroups;
}

function fn_update_usergroup($usergroup_data, $usergroup_id = 0, $lang_code = DESCR_SL)
{
    if (defined('RESTRICTED_ADMIN')) {
        $user_privileges = db_get_hash_single_array("SELECT privilege FROM ?:usergroup_privileges WHERE usergroup_id IN (?n)", array('privilege', 'privilege'), Tygh::$app['session']['auth']['usergroup_ids']);

        if ($usergroup_data['type'] == 'A' || !in_array('manage_usergroups', $user_privileges)) {
            fn_set_notification('E', __('error'), __('access_denied'));

            return false;
        }
    }

    if (empty($usergroup_id)) {
        $create = true;
        $usergroup_id = db_query("INSERT INTO ?:usergroups ?e", $usergroup_data);

        if ($usergroup_id < ALLOW_USERGROUP_ID_FROM) {
            db_query("UPDATE ?:usergroups SET usergroup_id = ?i WHERE usergroup_id = ?i", ALLOW_USERGROUP_ID_FROM, $usergroup_id);
            $usergroup_id = ALLOW_USERGROUP_ID_FROM;
        }

        $usergroup_data['usergroup_id'] = $usergroup_id;

        foreach (Tygh\Languages\Languages::getAll() as $usergroup_data['lang_code'] => $_v) {
            db_query("INSERT INTO ?:usergroup_descriptions ?e", $usergroup_data);
        }
    } else {
        $create = false;
        db_query("UPDATE ?:usergroups SET ?u WHERE usergroup_id = ?i", $usergroup_data, $usergroup_id);
        db_query("UPDATE ?:usergroup_descriptions SET ?u WHERE usergroup_id = ?i AND lang_code = ?s", $usergroup_data, $usergroup_id, $lang_code);
    }

    if (isset($usergroup_data['privileges']) && fn_check_can_usergroup_have_privileges($usergroup_data)) {
        db_query("DELETE FROM ?:usergroup_privileges WHERE usergroup_id = ?i", $usergroup_id);

        if (is_array($usergroup_data['privileges'])) {
            $data = array(
                'usergroup_id' => $usergroup_id
            );
            foreach ($usergroup_data['privileges'] as $data['privilege'] => $v) {
                db_query("INSERT INTO ?:usergroup_privileges ?e", $data);
            }
        }
    }

    /**
     * Update user group data
     *
     * @param array   $usergroup_data User group data
     * @param int     $usergroup_id   User group integer identifier
     * @param boolean $create         Flag determines if user group was created (true) or just updated (false).
     */
    fn_set_hook('update_usergroup', $usergroup_data, $usergroup_id, $create);

    return $usergroup_id;
}

/**
 * Changes status of user group for specific user
 *
 * @param string $status             User group one-letter status
 * @param int    $user_id            User identifier
 * @param int    $usergroup_id       User group identifier
 * @param array  $force_notification Notifications data
 *
 * @return mixed
 */
function fn_change_usergroup_status($status, $user_id, $usergroup_id, $force_notification = array())
{
    $is_available_status = $status === 'F';
    if (!$is_available_status && !fn_check_usergroup_available_for_user($user_id, $usergroup_id)) {
        return false;
    }

    $data = array(
        'user_id'      => $user_id,
        'usergroup_id' => $usergroup_id,
        'status'       => $status,
    );
    $result = db_query('REPLACE INTO ?:usergroup_links SET ?u', $data);

    if (!empty($force_notification['C'])) {
        fn_send_usergroup_status_notification($user_id, (array) $usergroup_id, $status);
    }

    return $result;
}

/**
 * Checks if user group is available for user
 *
 * @param int $user_id      User identifier
 * @param int $usergroup_id User group identifier
 *
 * @return bool
 */
function fn_check_usergroup_available_for_user($user_id, $usergroup_id)
{
    $conditions = [];

    foreach (UsergroupTypes::getMapUserType() as $user_type => $usergroup_type) {
        $conditions[] = db_quote('(users.user_type = ?s AND usergroups.type = ?s)', $user_type, $usergroup_type);
    }

    $is_allowed_usergroup = db_get_field(
        'SELECT usergroups.usergroup_id FROM ?:users AS users'
        . ' LEFT JOIN ?:usergroups AS usergroups ON usergroups.usergroup_id = ?i'
        . ' WHERE users.user_id = ?i AND (?p)',
        $usergroup_id, $user_id, implode(' OR ', $conditions)
    );

    $result = !empty($is_allowed_usergroup);

    /**
     * Actions after checking if user has the right type for user group provided
     *
     * @param int  $user_id       User identifiers
     * @param int  $usergroup_id  User group identifier
     * @param bool $result        Check result
     */
    fn_set_hook('check_usergroup_available_for_user_post', $user_id, $usergroup_id, $result);

    return $result;
}

function fn_send_usergroup_status_notification($user_id, $usergroup_ids, $status)
{
    $user_data = fn_get_user_info($user_id);
    $prefix = ($status == 'A') ? 'activation' : 'disactivation';

    $usergroups = fn_get_usergroups(array('status' => array('A', 'H')), $user_data['lang_code']);
    $usergroup_list = array();
    foreach ($usergroup_ids as $usergroup_id) {
        $usergroup_list[] = $usergroups[$usergroup_id]['usergroup'];
    }

    /** @var \Tygh\Mailer\Mailer $mailer */
    $mailer = Tygh::$app['mailer'];

    $mailer->send(array(
        'to' => $user_data['email'],
        'from' => 'company_users_department',
        'data' => array(
            'user_data' => $user_data,
            'usergroups' => implode(', ', $usergroup_list)
        ),
        'template_code' => ($status == 'A') ? 'usergroup_activation' : 'usergroup_disactivation',
        'tpl' => 'profiles/' . ($status == 'A' ? 'usergroup_activation.tpl' : 'usergroup_disactivation.tpl'), // this parameter is obsolete and is used for back compatibility
        'company_id' => $user_data['company_id'],
    ), fn_check_user_type_admin_area($user_data['user_type']) ? 'A' : 'C', $user_data['lang_code']);
}

function fn_is_usergroup_exists($usergroup_id)
{
    return db_get_field('SELECT COUNT(usergroup_id) FROM ?:usergroups WHERE usergroup_id = ?i', $usergroup_id) > 0;
}

function fn_delete_usergroups($usergroup_ids)
{
    db_query("DELETE FROM ?:usergroups WHERE usergroup_id IN (?n)", $usergroup_ids);
    db_query("DELETE FROM ?:usergroup_descriptions WHERE usergroup_id IN (?n)", $usergroup_ids);
    db_query("DELETE FROM ?:usergroup_privileges WHERE usergroup_id IN (?n)", $usergroup_ids);
    db_query("DELETE FROM ?:usergroup_links WHERE usergroup_id IN (?n)", $usergroup_ids);
    db_query("DELETE FROM ?:product_prices WHERE usergroup_id IN (?n)", $usergroup_ids);

    /**
     * Process user groups delete
     *
     * @param int $usergroup_ids User group identifiers
     */
    fn_set_hook('delete_usergroups', $usergroup_ids);
}

/**
 * Checks is it possible or not to delete user
 *
 * @param array $user_data Array with user data (should contain at least user_id, is_root and company_id fields)
 * @param array $auth Array with authorization data
 * @return bool True if user can be deleted, false otherwise.
 */
function fn_check_rights_delete_user($user_data, $auth)
{
    $result = true;

    if (
        ($user_data['is_root'] == 'Y' && !$user_data['company_id']) // root admin
        || fn_is_restricted_admin($user_data) // have no rights to delete user
        || (!empty($auth['user_id']) && $auth['user_id'] == $user_data['user_id']) // trying to delete himself
        || (Registry::get('runtime.company_id') && $user_data['is_root'] == 'Y') // vendor root admin
        || (Registry::get('runtime.company_id') && fn_allowed_for('ULTIMATE') && $user_data['company_id'] != Registry::get('runtime.company_id')) // user from other store
    ) {
        $result = false;
    }

    /**
    * Hook for changing the result of check
    *
    * @param array $user_data Array with user data
    * @param bool $result Result of check
    */
    fn_set_hook('check_rights_delete_user', $user_data, $auth, $result);

    return $result;
}

/**
 * Deletes user and all related data
 *
 * @param int $user_id User identificator
 * @return boolean False, if user can not be deleted, true if user was successfully deleted
 */
function fn_delete_user($user_id)
{
    fn_set_hook('pre_delete_user', $user_id);

    $condition = fn_get_company_condition('?:users.company_id');
    $user_data = db_get_row("SELECT user_id, is_root, company_id FROM ?:users WHERE user_id = ?i $condition", $user_id);

    if (empty($user_data)) {
        return false;
    }

    $auth = Tygh::$app['session']['auth'];

    if (!fn_check_rights_delete_user($user_data, $auth)) {
        fn_set_notification('W', __('warning'), __('user_cannot_be_deleted', array(
            '[user_id]' => $user_id
        )), '', 'user_delete_no_permissions');

        return false;
    }

    // Log user deletion
    fn_log_event('users', 'delete', array (
        'user_id' => $user_id,
    ));

    fn_set_hook('delete_user', $user_id, $user_data);

    $result = db_query("DELETE FROM ?:users WHERE user_id = ?i", $user_id);
    db_query('DELETE FROM ?:profile_fields_data WHERE object_id = ?i AND object_type = ?s', $user_id, 'U');
    db_query('DELETE FROM ?:user_session_products WHERE user_id = ?i', $user_id);
    db_query('DELETE FROM ?:user_data WHERE user_id = ?i', $user_id);
    db_query('UPDATE ?:orders SET user_id = 0 WHERE user_id = ?i', $user_id);

    $profile_ids = db_get_fields('SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i', $user_id);
    foreach ($profile_ids as $profile_id) {
        fn_delete_user_profile($user_id, $profile_id, true);
    }

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        db_query('DELETE FROM ?:usergroup_links WHERE user_id = ?i', $user_id);
    }

    /**
     * Hook for deleting related user data in addons
     *
     * @param int   $user_id   User identificator
     * @param array $user_data Array with user data (contains user_id, is_root and company_id fields)
     * @param int count of affected rows
     */
    fn_set_hook('post_delete_user', $user_id, $user_data, $result);

    return $result;
}

/**
 * Log in user using only user id
 *
 * @param int $user_id User identifier
 * @param bool $regenerate_session_id Need regenerate session id. Default false.
 * @return string
 *  return 0 - we can't find user with provided user_id
 *  return 1 - user was successfully logged
 *  return 2 - user disabled
 */
function fn_login_user($user_id = 0, $regenerate_session_id = false)
{
    $udata = array();
    $auth = & Tygh::$app['session']['auth'];
    $condition = '';
    $result = LOGIN_STATUS_USER_NOT_FOUND;

    /**
     * Change parameter for login user
     *
     * @param int $user_id User identifier
     * @param array $udata User data
     * @param array $auth Authentication data
     * @param array $condition String containing SQL-query condition possibly prepended with a logical operator (AND or OR)
     */
    fn_set_hook('login_user_pre', $user_id, $udata, $auth, $condition);

    if (!empty($user_id)) {
        if ($regenerate_session_id) {
            Tygh::$app['session']->regenerateID();
            $auth = & Tygh::$app['session']['auth'];
        }

        if (fn_allowed_for('ULTIMATE')) {
            if (Registry::get('settings.Stores.share_users') == 'N' && AREA != 'A') {
                $condition .= fn_get_company_condition('?:users.company_id');
            }
        }

        $udata = db_get_row("SELECT * FROM ?:users WHERE user_id = ?i AND status = 'A'" . $condition, $user_id);
        if (empty($udata)) {
            $udata = db_get_row("SELECT * FROM ?:users WHERE user_id = ?i AND user_type IN ('A', 'V', 'P')", $user_id);
        }

        unset(Tygh::$app['session']['status']);

        $auth = fn_fill_auth($udata, $auth);
        if (!empty($udata)) {
            fn_set_hook('sucess_user_login', $udata, $auth);
            if (AREA == 'C') {
                if ($cu_id = fn_get_session_data('cu_id')) {
                    fn_clear_cart($cart);
                    fn_save_cart_content($cart, $cu_id, 'C', 'U');
                    fn_delete_session_data('cu_id');
                }
                fn_init_user_session_data(Tygh::$app['session'], $udata['user_id']);
            }

            // Set last login time
            db_query("UPDATE ?:users SET ?u WHERE user_id = ?i", array('last_login' => TIME), $user_id);

            // Log user successful login
            fn_log_event('users', 'session', array(
                'user_id' => $user_id,
            ));

            $result = LOGIN_STATUS_OK;
        } else {
            $result = LOGIN_STATUS_USER_DISABLED;
        }
    } else {
        $auth = fn_fill_auth($udata, $auth);

        $result = LOGIN_STATUS_USER_NOT_FOUND;
    }

    fn_init_user();

    /**
     * Modifies the result after login user
     *
     * @param int $user_id User identifier
     * @param int $cu_id Cart user identifier
     * @param array $udata User data
     * @param array $auth Authentication data
     * @param array $condition String containing SQL-query condition possibly prepended with a logical operator (AND or OR)
     * @param string $result Result user login
     */
    fn_set_hook('login_user_post', $user_id, $cu_id, $udata, $auth, $condition, $result);

    return $result;
}

function fn_check_permission_act_as_user()
{
    $auth = Tygh::$app['session']['auth'] ?: array();

    $act_as_self = !empty($auth['user_id'])
        && !empty($_REQUEST['user_id'])
        && $auth['user_id'] == $_REQUEST['user_id'];

    $mve_admin_act = fn_allowed_for('MULTIVENDOR')
        && $auth['user_type'] == 'A'
        && $auth['is_root'] == 'Y';

    return $act_as_self || $mve_admin_act;
}

/**
 * Checks if administrator can mange profiles
 *
 * @param string $user_type Type of profiles
 *
 * @return boolean Flag: indicates if administrator has the permission to manage profiles
 */
function fn_check_permission_manage_profiles($user_type)
{
    $result = true;

    /**
     * Changes the result of administrator access to profile management check
     *
     * @param boolean $result    Result of check: true if administrator has access, false otherwise
     * @param string  $user_type Types of profiles
     */
    fn_set_hook('check_permission_manage_profiles', $result, $user_type);

    return $result;
}

/**
 * Generate random salt
 *
 * @param int $length - salt length
 * @return string salt
 */
function fn_generate_salt($length = 10)
{
    $length = $length > 10 ? 10 : $length;

    $salt = '';

    for ($i = 0; $i < $length; $i++) {
        $salt .= chr(rand(33, 126));
    }

    return $salt;
}

/**
 * Generate password with salt
 *
 * @param string $password - simple text password
 * @param string $salt - password salt
 * @return string generated password
 */
function fn_generate_salted_password($password, $salt)
{
    $_pass = '';

    if (empty($salt)) {
        $_pass = md5($password);
    } else {
        $_pass = md5(md5($password) . md5($salt));
    }

    return $_pass;
}

function fn_get_my_account_title_class()
{
    return !empty(Tygh::$app['session']['auth']['user_id']) ? 'logged' : 'unlogged';
}

/**
 * Check if user already registered in store
 *
 * @param int   $user_id   User identifier
 * @param array $user_data User data
 *
 * @return bool true if user already exists in the DB, false otherwise
 */
function fn_is_user_exists($user_id, $user_data)
{
    /**
     * Change parameter for user checking
     *
     * @param int   $user_id   User identifier
     * @param array $user_data User data
     */
    fn_set_hook('is_user_exists_pre', $user_id, $user_data);

    $condition = db_quote(" (?p ?p) ", (!empty($user_data['email']) ? db_quote('email = ?s', $user_data['email']) : '0'), (empty($user_data['user_login']) ? '' : db_quote(" OR user_login = ?s", $user_data['user_login'])));
    $condition .= db_quote(" AND user_id != ?i", $user_id);

    fn_set_hook('user_exist', $user_id, $user_data, $condition);

    $is_exist = db_get_field("SELECT user_id FROM ?:users WHERE $condition");

    /**
     * Change parameter for user checking
     *
     * @param int   $user_id   User identifier
     * @param array $user_data User data
     * @param bool  $is_exist  Result of checking
     */
    fn_set_hook('is_user_exists_post', $user_id, $user_data, $is_exist);

    return $is_exist;
}

/**
 * Get profile field value for printing
 *
 * @param array $profile Profile data
 * @param array $field Field data
 * @return string Field value
 */
function fn_get_profile_field_value($profile, $field)
{
    $value = '';

    if (!empty($field['field_name']) && $field['is_default'] == 'Y') {
        $data_id = $field['field_name'];
        $value = !empty($profile[$data_id]) ? $profile[$data_id] : '';
    } else {
        $data_id = $field['field_id'];
        $value =!empty($profile['fields'][$data_id]) ? $profile['fields'][$data_id] : '';
    }

    if (!empty($value)) {
        if (strpos("AO", $field['field_type']) !== false) {
            // States/Countries
            $title = $data_id . '_descr';
            $value = !empty($profile[$title]) ? $profile[$title] : '-';
        } elseif ($field['field_type'] == "C") {
            // Checkbox
            $value = ($value == "Y") ? __('yes') : __('no');
        } elseif ($field['field_type'] == "D") {
            // Date
            $value = fn_date_format($value, Registry::get('settings.Appearance.date_format'));
        } elseif (strpos("RS", $field['field_type']) !== false) {
            // Selectbox/Radio
            $value = $field['values'][$value];
        }
    }

    return $value;
}

/**
 * Gets user type from request parameters
 *
 * @param array  $params Request parameters
 * @param string $area   Сurrent application area
 *
 * @return string User type
 */
function fn_get_request_user_type($params, $area = AREA)
{
    $user_type = '';

    if (!empty($params['user_type'])) {
        $user_type =  $params['user_type'];
    } elseif (!empty($params['user_id'])) {
        $user_type = db_get_field("SELECT user_type FROM ?:users WHERE user_id = ?i", $params['user_id']);
    }

    // Use customer user type by default
    $user_type = !empty($user_type) ? $user_type : 'C';

    /**
     * Changes defined user type
     *
     * @param string $user_type User type
     * @param array  $params    Request parameters
     * @param string $area      current application area
     */
    fn_set_hook('get_request_user_type', $user_type, $params, $area);

    return $user_type;
}

/**
 * Checks if user has active user groups
 *
 * @param array $user_data Array of user data @see fn_get_user_info
 * @return bool True on success, false otherwise
 */
function fn_user_has_active_usergroups($user_data)
{
    $has = false;

    if (!empty($user_data['usergroups'])) {
        foreach ($user_data['usergroups'] as $_user_group) {
            if ($_user_group['status'] == 'A') {
                $has = true;
                break;
            }
        }
    }

    return $has;
}

/**
 * Performs authentication of user
 *
 * @param array $request Query parameters
 * @param array $auth Authentication data
 * @return array Authentication status, user data, login, password and salt
 */
function fn_auth_routines($request, $auth)
{
    $status = true;

    $user_login = (!empty($request['user_login'])) ? trim($request['user_login']) : '';
    $password = (!empty($request['password'])) ? $request['password']: '';
    $field = 'email';

    $condition = '';

    if (fn_allowed_for('ULTIMATE')) {
        if (Registry::get('settings.Stores.share_users') == 'N' && AREA != 'A') {
            $condition = fn_get_company_condition('?:users.company_id');
        }
    }

    /**
     * Selects user data
     *
     * @param array $request Query parameters
     * @param array $auth Authentication data
     * @param string $field SQL field to select user by
     * @param string $condition String containing SQL-query condition possibly prepended with a logical operator (AND or OR)
     * @param string $user_login Value to select user by
     */
    fn_set_hook('auth_routines', $request, $auth, $field, $condition, $user_login);

    $user_data = db_get_row("SELECT * FROM ?:users WHERE $field = ?s" . $condition, $user_login);

    if (empty($user_data)) {
        $user_data = db_get_row("SELECT * FROM ?:users WHERE $field = ?s AND user_type IN ('A', 'V', 'P')", $user_login);
    }

    if (!empty($user_data)) {
        $user_data['usergroups'] = fn_get_user_usergroups($user_data['user_id']);
    }

    if (
        !empty($user_data)
        && (!fn_check_user_type_admin_area($user_data) && AREA == 'A' || !fn_check_user_type_access_rules($user_data))
    ) {
        fn_set_notification('E', __('error'), __('error_area_access_denied'));
        $status = false;
    }

    if (!empty($user_data['status']) && $user_data['status'] == 'D') {
        fn_set_notification('E', __('error'), __('error_account_disabled'));
        $status = false;
    }

    $salt = isset($user_data['salt']) ? $user_data['salt'] : '';

    return array($status, $user_data, $user_login, $password, $salt);
}

/**
 * Fills empty contact information fields from billing/shipping addresses.
 * Useful when some profile fields were disabled.
 *
 * @param array       $data                 User data to be modified
 * @param string|null $main_address_zone    Address zone which will be used as data source
 * @param string|null $alt_address_zone     Address zone which will be used as secondary data
 *                                          source (when main zone doesn't contain required data)
 *
 * @return array User data with filled contact information fields
 */
function fn_fill_contact_info_from_address($data, $main_address_zone = null, $alt_address_zone = null)
{
    if ($main_address_zone === null && $alt_address_zone === null) {
        $main_address_zone = SHIPPING_ADDRESS_PREFIX;
        $alt_address_zone = BILLING_ADDRESS_PREFIX;
        $profile_fields = fn_get_profile_fields('O');

        if (Registry::get('settings.Checkout.address_position') == 'billing_first' && !empty($profile_fields['B'])) {
            $main_address_zone = BILLING_ADDRESS_PREFIX;
            $alt_address_zone = SHIPPING_ADDRESS_PREFIX;
        }
    }

    if (!isset($data['firstname'])) {
        if (!empty($data[$main_address_zone . '_firstname'])) {
            $data['firstname'] = $data[$main_address_zone . '_firstname'];
        } elseif (!empty($data[$alt_address_zone . '_firstname'])) {
            $data['firstname'] = $data[$alt_address_zone . '_firstname'];
        }
    }
    if (!isset($data['lastname'])) {
        if (!empty($data[$main_address_zone . '_lastname'])) {
            $data['lastname'] = $data[$main_address_zone . '_lastname'];
        } elseif (!empty($data[$alt_address_zone . '_lastname'])) {
            $data['lastname'] = $data[$alt_address_zone . '_lastname'];
        }
    }
    if (!isset($data['phone'])) {
        if (!empty($data[$main_address_zone . '_phone'])) {
            $data['phone'] = $data[$main_address_zone . '_phone'];
        } elseif (!empty($data[$alt_address_zone . '_phone'])) {
            $data['phone'] = $data[$alt_address_zone . '_phone'];
        }
    }

    return $data;
}

/**
 * Checks if user data are complete
 *
 * @param array $user_data Array of user data @see fn_get_user_info
 * @param string $location Location identifier
 * @param array $auth - authentication information
 * @return bool True on success, false otherwise
 */
function fn_check_profile_fields($user_data, $location = 'C', $auth = array())
{
    $result = true;
    $profile_fields = fn_get_profile_fields($location, $auth);
    if ($location == 'O') {
        unset($profile_fields['E']);
    }

    foreach ($profile_fields as $section => $fields) {
        if (!fn_check_profile_fields_population($user_data, $section, $profile_fields)) {
            $result = false;
            break;
        }
    }

    return $result;
}

/**
 * Update or create profile field. Also can create fields matching.
 *
 * @param array     $field_data Array of profile field data
 * @param int       $field_id   Profile field id to be updated. If empty - new field will be created
 * @param string    $lang_code  2-letters language code
 *
 * @return int $field_id New or updated field id
 */
function fn_update_profile_field($field_data, $field_id, $lang_code = DESCR_SL)
{
    if (empty($field_id)) {
        $current_field_name = '';
        $add_match = false;

        $field_name = $field_data['field_name'];
        if ($field_data['section'] == ProfileFieldSections::BILLING_AND_SHIPPING_ADDRESS) {
            $field_data['section'] = ProfileFieldSections::BILLING_ADDRESS;
            $field_data['field_name'] = !empty($field_name) ? "b_{$field_name}" : '';
            $add_match = true;
        }
    } else {
        $current_field_name = db_get_field('SELECT field_name FROM ?:profile_fields WHERE field_id = ?i', $field_id);
    }

    if (!empty($field_data['field_name']) && $current_field_name != $field_data['field_name']) {
        if (preg_match('/[^_a-z0-9]/i', $field_data['field_name'])) {
            fn_set_notification('E', __('error'), __('error_validator_message', array('[field]' => __('profile_field_name'))));
            return false;
        }

        $conditions = array(
            'field_name' => db_quote('field_name = ?s', $field_data['field_name']),
            'exclude_id' => db_quote('field_id <> ?s', $field_id),
        );

        if (!empty($field_data['profile_type'])) {
            $conditions['field_type'] = db_quote('profile_type = ?s', $field_data['profile_type']);
        }

        $exists = db_get_field('SELECT field_id FROM ?:profile_fields WHERE ?p', implode(' AND ', $conditions));

        if ($exists) {
            fn_set_notification('E', __('error'), __('error_profile_field_name_exists'));
            return false;
        }
    }

    if (empty($field_id)) {
        // Insert main data
        $field_id = db_query("INSERT INTO ?:profile_fields ?e", $field_data);

        // Insert descriptions
        $_data = array (
            'object_id' => $field_id,
            'object_type' => 'F',
            'description' => $field_data['description'],
        );

        foreach (Languages::getAll() as $_data['lang_code'] => $_v) {
            db_query("INSERT INTO ?:profile_field_descriptions ?e", $_data);
        }

        if (substr_count('SR', $field_data['field_type']) && is_array($field_data['add_values']) && $add_match == false) {
            fn_add_field_values($field_data['add_values'], $field_id);
        }

        if ($add_match == true) {
            $field_data['section'] = 'S';
            $field_data['field_name'] = !empty($field_name) ? ('s_' . $field_name) : '';
            $field_data['matching_id'] = $field_id;

            // Update match for the billing field
            $s_field_id = fn_update_profile_field($field_data, 0, $lang_code);
            if (!empty($s_field_id)) {
                db_query('UPDATE ?:profile_fields SET matching_id = ?i WHERE field_id = ?i', $s_field_id, $field_id);
            }
        }

    } else {
        db_query("UPDATE ?:profile_fields SET ?u WHERE field_id = ?i", $field_data, $field_id);

        if (!empty($field_data['matching_id']) && $field_data['section'] == 'S') {
            db_query('UPDATE ?:profile_fields SET field_type = ?s WHERE field_id = ?i', $field_data['field_type'], $field_data['matching_id']);
        }

        db_query("UPDATE ?:profile_field_descriptions SET ?u WHERE object_id = ?i AND object_type = 'F' AND lang_code = ?s", $field_data, $field_id, $lang_code);

        if (!empty($field_data['field_type'])) {
            if (strpos('SR', $field_data['field_type']) !== false) {
                if (!empty($field_data['values'])) {
                    foreach ($field_data['values'] as $value_id => $vdata) {
                        db_query("UPDATE ?:profile_field_values SET ?u WHERE value_id = ?i", $vdata, $value_id);
                        db_query("UPDATE ?:profile_field_descriptions SET ?u WHERE object_id = ?i AND object_type = 'V' AND lang_code = ?s", $vdata, $value_id, $lang_code);
                    }

                    // Completely delete removed values
                    $existing_ids = db_get_fields("SELECT value_id FROM ?:profile_field_values WHERE field_id = ?i", $field_id);
                    $val_ids = array_diff($existing_ids, array_keys($field_data['values']));

                    if (!empty($val_ids)) {
                        fn_delete_field_values($field_id, $val_ids);
                    }
                } else {
                   if (isset($field_data['add_values'])) {
                        fn_delete_field_values($field_id);
                    }
                }

                if (!empty($field_data['add_values']) && is_array($field_data['add_values'])) {
                    fn_add_field_values($field_data['add_values'], $field_id);
                }
            } else {
                fn_delete_field_values($field_id);
            }
        }
    }

    return $field_id;
}

/**
 * Authorize user by ekey
 * and delete expired ekeys.
 *
 * @param string $ekey
 * @param bool   $get_user_data  True if needs to get additional user data, otherwise false
 * @return bool|string|array	Array or string with user data or false on error
 */
function fn_recover_password_login($ekey = null, $get_user_data = false)
{
    if ($ekey) {
        $u_id = fn_get_object_by_ekey($ekey, 'U');

        if ($u_id) {
            $user_status = fn_login_user($u_id, true);

            if ($user_status == LOGIN_STATUS_OK) {
                fn_set_notification('N', __('notice'), __('text_change_password'), 'I', 'notice_text_change_password');

                if (!$get_user_data) {
                    return $u_id;
                }
            } else {
                fn_set_notification('E', __('error'), __('error_login_not_exists'));

                if (!$get_user_data) {
                    return $user_status;
                }
            }
            if ($get_user_data) {
                return array($u_id, $user_status);
            }
        } else {
            fn_set_notification('E', __('error'), __('text_ekey_not_valid'));

            return false;
        }
    }

    return null;
}

/**
 * Generates password reset key.
 *
 * @param string     $user_email User to generate password reset key for
 * @param bool       $notify     Whether to notify user about password reset
 * @param int|string $company_id Company ID of the user
 * @param string     $area       Site area to perform checks for
 *
 * @return array|bool Array with user data and ekey or false on error
 */
function fn_recover_password_generate_key($user_email, $notify = true, $company_id = '', $area = AREA)
{
    $result = true;

    if ($user_email) {
        $condition = '';

        if (fn_allowed_for('ULTIMATE')) {
            if ($company_id !== '') {
                $condition = db_quote(' AND ?:users.company_id = ?i', $company_id);
            } elseif (Registry::get('settings.Stores.share_users') == 'N' && $area != 'A') {
                $condition = fn_get_company_condition('?:users.company_id', true, $company_id);
            }
        }

        /** @var int $uid */
        $uid = db_get_field('SELECT user_id FROM ?:users WHERE email = ?s ?p', $user_email, $condition);

        $u_data = fn_get_user_info($uid, false);
        if (isset($u_data['status']) && $u_data['status'] == 'D') {
            fn_set_notification('E', __('error'), __('error_account_disabled'));

            return false;
        }
        if (!empty($u_data['email'])) {

            $ekey = fn_generate_ekey($u_data['user_id'], 'U', SECONDS_IN_DAY);

            if ($notify) {
                /** @var \Tygh\Mailer\Mailer $mailer */
                $mailer = Tygh::$app['mailer'];

                $mailer->send(array(
                    'to' => $u_data['email'],
                    'from' => 'default_company_users_department',
                    'data' => array(
                        'ekey' => $ekey,
                        'url' => fn_url('auth.recover_password?ekey=' . $ekey, $u_data['user_type'])
                    ),
                    'template_code' => 'recover_password',
                    'tpl' => 'profiles/recover_password.tpl', // this parameter is obsolete and is used for back compatibility
                ), fn_check_user_type_admin_area($u_data['user_type']) ? 'A' : 'C', $u_data['lang_code']);

                fn_set_notification('N', __('information'), __('text_password_recovery_instructions_sent'));
            } else {
                $result = array('company_id' => $u_data['company_id'], 'key' => $ekey, 'user_type' => $u_data['user_type']);
            }

        } else {
            fn_set_notification('E', __('error'), __('error_login_not_exists'));
            $result = false;
        }
    } else {
        fn_set_notification('E', __('error'), __('error_login_not_exists'));
        $result = false;
    }

    return $result;
}

/**
 * @param array $auth
 */
function fn_user_logout($auth)
{
    $save_cart = $clear_cart = true;

    /**
     * Executes when logging a user out, allows to specify whether the cart content should be saved.
     *
     * @param array $auth       Authentication data
     * @param bool  $save_cart  Whether to save cart before logging user out
     */
    fn_set_hook('user_logout_before_save_cart', $auth, $save_cart);

    if ($save_cart) {
        fn_save_cart_content(Tygh::$app['session']['cart'], $auth['user_id']);
    }

    // Regenerate session_id for security reasons
    Tygh::$app['session']->regenerateID();
    fn_init_user();
    $auth = Tygh::$app['session']['auth'];

    if (!empty($auth['user_id'])) {
        fn_log_user_logout($auth);
    }

    unset(Tygh::$app['session']['auth']);

    /**
     * Executes when logging a user out, allows to specify whether the cart content should be cleared.
     *
     * @param array $auth       Authentication data
     * @param bool  $clear_cart Whether to clear cart when logging user out
     */
    fn_set_hook('user_logout_before_clear_cart', $auth, $clear_cart);

    if ($clear_cart) {
        fn_clear_cart(Tygh::$app['session']['cart'], false, true);
    }

    fn_delete_session_data(AREA . '_user_id', AREA . '_password', Manager::SESSION_STORAGE_KEY);

    unset(Tygh::$app['session']['product_notifications']);

    fn_login_user(); // need to fill Tygh::$app['session']['auth'] array for anonymous user

    /**
     * Allows to perform any actions after user logout.
     *
     * @param array $auth Auth data from session
     */
    fn_set_hook('user_logout_after', $auth);
}

/**
 * Checks if current user can edit specified profile
 *
 * @param array $auth authentication information
 * @param array $user_data Edited profile
 * @return bool true if authenticated user can edit specified profile, false otherwise
 */
function fn_check_editable_permissions($auth, $user_data)
{
    $has_permissions = true;

    if ($auth['is_root'] == 'Y' && $auth['user_type'] == 'A') {
        $has_permissions = true;

    } elseif (isset($user_data['is_root'])) {
        if ($user_data['is_root'] == 'Y' && $auth['is_root'] != 'Y' && $user_data['user_type'] == 'A') {
            $has_permissions = false;

        } elseif ($auth['user_type'] == 'V' && $user_data['is_root'] == 'Y') {
            if ($auth['user_id'] != $user_data['user_id']) {
                $has_permissions = false;
            }
        }
    }

    /**
     * Modifies the result of permission checking to modify profile
     *
     * @param array $auth            authentication information
     * @param array $user_data       Edited profile
     * @param bool  $has_permissions checking result
     */
    fn_set_hook('check_editable_permissions_post', $auth, $user_data, $has_permissions);

    return $has_permissions;
}

/**
 * Adds email to global news
 *
 * @param string $email User email
 * @param int $mail_list Global mail list ID
 */
function fn_subscribe_admin($email = '', $mail_list = MAILING_LIST_ID)
{
    if (empty($email)) {
        $email = db_get_field('SELECT email FROM ?:users WHERE is_root = ?s ORDER BY user_id ASC', 'Y');
    }

    Http::post(Registry::get('config.resources.product_url') . '/index.php', array(
        'mailing_lists[' . $mail_list . ']' => true,
        'subscribe_email' => $email,
        'console' => true,
        'dispatch' => 'newsletters.add_subscriber',
    ));
}

/**
 * Add a record to the log if the user session is expired
 *
 * @param array $auth - user auth data
 * @param integer $expiry - expiration time
 * @return bool Always true
 */
function fn_log_user_logout($auth, $expiry = TIME)
{
    if (!empty($auth) && $auth['user_id']) {
        $this_login = empty($auth['this_login']) ? 0 : $auth['this_login'];

        // Log user logout
        fn_log_event('users', 'session', array (
            'user_id' => $auth['user_id'],
            'ip' => empty($auth['ip']) ? '' : $auth['ip'],
            'time' => ($expiry - $this_login),
            'timeout' => true,
            'expiry' => $expiry,
        ));
    }

    return true;
}

/**
 * Gets user auth token.
 *
 * @param int $user_id  User identifier
 * @param int $ttl      Token expiry time in seconds, default is 604800 - 7 days
 *
 * @return array array(token, expiry_time)
 */
function fn_get_user_auth_token($user_id, $ttl = 604800)
{
    $ekeys = fn_get_ekeys(array(
        'object_id' => $user_id,
        'object_type' => 'U',
        'ttl' => TIME
    ));

    if ($ekeys) {
        $ekey = reset($ekeys);
        $token = $ekey['ekey'];
        $expiry_time = $ekey['ttl'];
    } else {
        $token = fn_generate_ekey($user_id, 'U', $ttl);
        $expiry_time = time() + $ttl;
    }

    return array($token, $expiry_time);
}

function fn_add_field_values($values = array(), $field_id = 0)
{
    if (empty($values) || empty($field_id)) {
        return false;
    }

    foreach ($values as $_v) {

        if (empty($_v['description'])) {
            continue;
        }
        // Insert main data
        $_v['field_id'] = $field_id;
        $value_id = db_query("INSERT INTO ?:profile_field_values ?e", $_v);

        // Insert descriptions
        $_data = array (
            'object_id' => $value_id,
            'object_type' => 'V',
            'description' => $_v['description'],
        );

        foreach (Languages::getAll() as $_data['lang_code'] => $_v) {
            db_query("INSERT INTO ?:profile_field_descriptions ?e", $_data);
        }
    }

    return true;
}

function fn_delete_field_values($field_id, $value_ids = array())
{
    if (empty($value_ids)) {
        $value_ids = db_get_fields("SELECT value_id FROM ?:profile_field_values WHERE field_id = ?i", $field_id);
    }

    if (!empty($value_ids)) {
        db_query("DELETE FROM ?:profile_field_descriptions WHERE object_id IN (?n) AND object_type = 'V'", $value_ids);
        db_query("DELETE FROM ?:profile_field_values WHERE value_id IN (?n)", $value_ids);
    }
}

function fn_delete_profile_field($field_id, $no_match = false)
{
    $matching_id = db_get_field("SELECT matching_id FROM ?:profile_fields WHERE field_id = ?i", $field_id);
    if (!$no_match && !empty($matching_id)) {
        fn_delete_profile_field($matching_id, true);
    }

    fn_delete_field_values($field_id);
    db_query("DELETE FROM ?:profile_fields WHERE field_id = ?i", $field_id);
    db_query("DELETE FROM ?:profile_fields_data WHERE field_id = ?i", $field_id);
    db_query("DELETE FROM ?:profile_field_descriptions WHERE object_id = ?i AND object_type = 'F'", $field_id);
}

function fn_profile_fields_areas()
{
    $areas = array ();
    $profiles_schema = fn_get_schema('profiles', 'profile_types');

    foreach ($profiles_schema as $profile_type => $data) {

        if (!isset($data['allowed_areas'])) {
            continue;
        }

        foreach ((array) $data['allowed_areas'] as $area) {
            $areas[$area] = $area;
        }
    }

    /**
     * Deprecated: This hook will be removed in version 5.x.x.. Use profiles/profile_types schema instead.
     */
    fn_set_hook('profile_fields_areas', $areas);

    return $areas;
}

/**
 * Gets matching_id for a profile field
 *
 * @param int $field_id The profile field ID
 *
 * @return int
 */
function fn_get_matching_profile_field_id($field_id)
{
    $result = 0;
    if (empty($field_id)) {
        return $result;
    }

    $result = (int) db_get_field('SELECT matching_id FROM ?:profile_fields WHERE field_id = ?i', $field_id);

    return $result;
}

/**
 * Fetches all user group privileges
 *
 * @param array $usergroup User group data
 *
 * @return array
 */
function fn_get_usergroup_privileges(array $usergroup)
{
    $privileges = db_get_array('SELECT * FROM ?:privileges ORDER BY section_id');

    /**
     * Actions after getting usergroups
     *
     * @param array $usergroup  User group data
     * @param array $privileges User group privileges list
     */
    fn_set_hook('get_privileges_post', $usergroup, $privileges);

    return $privileges;
}

/**
 * Groups privileges by section_is and group_id (inside section_id) groups
 *
 * @param array $privileges Privileges list
 *
 * @return array
 */
function fn_group_usergroup_privileges(array $privileges)
{
    $coll = new Collection($privileges);
    $preload_list = $coll
        ->reduce(function ($preload_list, $privilege) {
            return array_merge($preload_list, [
                "privileges.{$privilege['privilege']}",
                "privilege_sections.{$privilege['section_id']}",
                "privilege_groups.{$privilege['group_id']}",
            ]);
        }, []);
    fn_preload_lang_vars(array_unique($preload_list));

    $fetch_privilege_additional_data = function ($privilege) {
        $privilege['description'] = __("privileges.{$privilege['privilege']}");
        $privilege['action_type'] = $privilege['is_view'] === 'Y' ? 'action_view' : 'action_manage';
        return $privilege;
    };

    $sort_by_group_id_empty_string_last = function ($a, $b) {
        $g1 = $a['group_id'];
        $g2 = $b['group_id'];
        if ($g1 === '' || $g2 === '') {
            return $g1 === '' ? 1 : -1;
        } elseif ($g1 > $g2) {
            return 1;
        } elseif ($g1 < $g2) {
            return -1;
        }

        return 0;
    };

    $group_section_by_groups = function ($section) use ($sort_by_group_id_empty_string_last) {
        return $section
            ->sort($sort_by_group_id_empty_string_last)
            ->groupBy('group_id')
            ->map(function ($group) {
                return $group->reverse()->groupBy('action_type');
            });
    };

    $grouped_privileges = $coll
        ->map($fetch_privilege_additional_data)
        ->groupBy('section_id')
        ->map($group_section_by_groups)
        ->toArray();

    return $grouped_privileges;
}

/**
 * Gets all available user groups by user type
 *
 * @param string $user_type User type
 *
 * @return array
 */
function fn_get_available_usergroups($user_type)
{
    $usergroup_type = UsergroupTypes::getUsergroupType($user_type);

    if (!$usergroup_type) {
        return [];
    }

    return fn_get_usergroups([
        'type'   => $usergroup_type,
        'status' => ['A', 'H'],
    ]);
}

/**
 * Checks if provided user group can have privileges
 *
 * @param array $usergroup User group data
 *
 * @return bool
 */
function fn_check_can_usergroup_have_privileges(array $usergroup)
{
    $result = in_array($usergroup['type'], array(UsergroupTypes::TYPE_ADMIN));

    /**
     * Actions after checking if user group can have privileges
     *
     * @param array $usergroup Usergroup data
     * @param bool  $reslut    Check result
     */
    fn_set_hook('check_can_usergroup_have_privileges_post', $usergroup, $result);

    return $result;
}

/**
 * Fetches users requests for user group assignment
 *
 * @param array  $params
 * @param int    $items_per_page
 * @param string $status
 * @param string $lang_code
 *
 * @return array
 */
function fn_get_usergroup_requests($params, $items_per_page = 0, $status = 'P', $lang_code = CART_LANGUAGE)
{
    // Set default values to input params
    $default_params = array(
        'page' => 1,
        'items_per_page' => $items_per_page
    );

    $params = array_merge($default_params, $params);

    $fields = array(
        '?:usergroup_links.user_id',
        '?:usergroup_links.link_id',
        '?:usergroup_links.usergroup_id',
        '?:usergroup_links.status',
        '?:users.firstname',
        '?:users.lastname',
        '?:usergroup_descriptions.usergroup'
    );

    $sortings = array(
        'customer' => array('?:users.lastname', '?:users.firstname'),
        'usergroup' => '?:usergroup_descriptions.usergroup',
        'status' => '?:usergroup_links.status'
    );

    $sorting = db_sort($params, $sortings, 'customer', 'desc');
    $condition = '';

    if (!empty($params['cname'])) {
        $arr = explode(' ', $params['cname']);
        if (sizeof($arr) == 2) {
            $condition .= db_quote(' AND ?:users.firstname LIKE ?l AND ?:users.lastname LIKE ?l', '%$arr[0]%', '%$arr[1]%');
        } else {
            $condition .= db_quote(' AND (?:users.firstname LIKE ?l OR ?:users.lastname LIKE ?l)', '%$params[cname]%', '%$params[cname]%');
        }
    }

    if (!empty($params['ugname'])) {
        $condition .= db_quote(' AND ?:usergroup_descriptions.usergroup LIKE ?l', '%$params[ugname]%');
    }

    $join = db_quote('LEFT JOIN ?:users ON ?:usergroup_links.user_id = ?:users.user_id LEFT JOIN ?:usergroup_descriptions ON ?:usergroup_links.usergroup_id = ?:usergroup_descriptions.usergroup_id AND ?:usergroup_descriptions.lang_code = ?s', $lang_code);

    $limit = '';
    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field('SELECT COUNT(?:usergroup_links.link_id) FROM ?:usergroup_links ?p WHERE ?:usergroup_links.status = ?s ?p', $join, $status, $condition);
        $limit = db_paginate($params['page'], $params['items_per_page'], $params['total_items']);
    }

    $requests = db_get_array('SELECT ' . implode(', ', $fields) . ' FROM ?:usergroup_links ?p WHERE ?:usergroup_links.status = ?s ?p ?p ?p', $join, $status, $condition, $sorting, $limit);

    return array($requests, $params);
}

/**
 * Gets usergroups that are displayed on the payments management page.
 *
 * @param array  $params    Usegroup fetching params
 * @param string $lang_code Two-letter language code
 *
 * @return array
 * @throws \Tygh\Exceptions\DeveloperException
 */
function fn_get_payment_usergroups($params = [], $lang_code = DESCR_SL)
{
    $params = array_merge([
        'type'   => ['C'],
        'status' => ['A', 'H'],
    ], $params);

    /**
     * Executes when geting the list of usergoups that are displayed on the payments management page before fetching
     * usergroups, allows to modify parameters passed to the fn_get_usergroups function.
     *
     * @param array  $params    Usegroup fetching params
     * @param string $lang_code Two-letter language code
     */
    fn_set_hook('get_payment_usergroups', $params, $lang_code);

    return fn_get_usergroups($params, $lang_code);
}
