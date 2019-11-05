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

use Tygh\Enum\ProductFeatures;
use Tygh\Languages\Languages;
use Tygh\Registry;
use Tygh\SeoCache;
use Tygh\Settings;
use Tygh\Tools\Url;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_get_seo_company_condition($field, $object_type = '', $company_id = null)
{
    $condition = '';

    if (fn_allowed_for('ULTIMATE')) {
        if ($company_id == null && Registry::get('runtime.company_id')) {
            $company_id = Registry::get('runtime.company_id');
        }

        // Disable companies in for shared objects
        if (!empty($object_type)) {
            if (fn_get_seo_vars($object_type, 'not_shared')) {
                $condition = fn_get_company_condition($field, true, $company_id, true);
            }
        } else {
            $condition = fn_get_company_condition($field, false, $company_id);
            $condition = !empty($condition) ? " AND ($condition OR $field = 0)" : '';
        }
    }

    return $condition;
}

function fn_get_seo_join_condition($object_type, $c_field = '', $lang_code = CART_LANGUAGE)
{
    $res = db_quote(" AND ?:seo_names.type = ?s ", $object_type);

    if ($object_type != 's') {
        $res .= " AND ?:seo_names.dispatch = ''";
    }

    if (!empty($lang_code)) {
        $res .= db_quote(" AND ?:seo_names.lang_code = ?s ", fn_get_corrected_seo_lang_code($lang_code));
    }

    if (fn_allowed_for('ULTIMATE')) {
        if (!empty($c_field) && fn_get_seo_vars($object_type, 'not_shared')) {
            $res .= " AND ?:seo_names.company_id = $c_field ";
        }
    }

    return $res;
}

/**
 * Function deletes SEO name for different objects.
 *
 * @param int $object_id object ID
 * @param string $object_type object type
 * @param string $dispatch dispatch param for static names
 * @param int $company_id company ID
 * @return bool
 */
function fn_delete_seo_name($object_id, $object_type, $dispatch = '', $company_id = null)
{
    /**
     * Deletes SEO name (running before fn_delete_seo_name() function)
     *
     * @param int    $object_id
     * @param string $object_type
     * @param string $dispatch
     * @param int    $company_id
     */
    fn_set_hook('delete_seo_name_pre', $object_id, $object_type, $dispatch, $company_id);

    $condition = '';
    if ($object_type == 's' || $company_id) {
        $condition = fn_get_seo_company_condition('?:seo_names.company_id', $object_type, $company_id);
    }

    $result = db_query('DELETE FROM ?:seo_names WHERE object_id = ?i AND type = ?s AND dispatch = ?s ?p', $object_id, $object_type, $dispatch, $condition);

    $seo_vars = fn_get_seo_vars($object_type);
    if (!empty($seo_vars['picker'])) {
        $company_condition = $company_id ? fn_get_seo_company_condition('?:seo_redirects.company_id', $object_type, $company_id) : '';
        db_query("DELETE FROM ?:seo_redirects WHERE object_id = ?i AND type = ?s ?p", $object_id, $object_type, $company_condition);
    }

    /**
     * Deletes SEO name (running after fn_delete_seo_name() function)
     *
     * @param int    $result
     * @param int    $object_id
     * @param string $object_type
     * @param string $dispatch
     * @param int    $company_id
     */
    fn_set_hook('delete_seo_name_post', $result, $object_id, $object_type, $dispatch, $company_id);

    return $result ? true : false;
}

/**
 * Deletes all SEO names that belong to company
 * @param int $company_id company ID
 */
function fn_delete_seo_names($company_id)
{
    db_query("DELETE FROM ?:seo_names WHERE company_id = ?i", $company_id);
    db_query("DELETE FROM ?:seo_redirects WHERE company_id = ?i", $company_id);
}

/**
 * Creates SEO name
 *
 * @param integer $object_id       object ID
 * @param string  $object_type     object type
 * @param string  $object_name     object name
 * @param integer $index           index
 * @param string  $dispatch        dispatch (for static object type)
 * @param integer $company_id      company ID
 * @param string  $lang_code       language code
 * @param boolean $create_redirect creates 301 redirect if set to true
 * @param string  $area            current working area
 * @param array   $params          Additional params
 *
 * @return string SEO name
 */
function fn_create_seo_name(
    $object_id,
    $object_type,
    $object_name,
    $index = 0,
    $dispatch = '',
    $company_id = '',
    $lang_code = CART_LANGUAGE,
    $create_redirect = false,
    $area = AREA,
    $params = array()
) {
    $cache_max_length = 200;
    static $names_cache = null;

    // Whether to cache fn_get_seo_parent_path() calls.
    $use_generated_paths_cache = isset($params['use_generated_paths_cache'])
        ? $params['use_generated_paths_cache']
        : true;

    /**
     * Create SEO name (running before fn_create_seo_name() function)
     *
     * @param int    $object_id
     * @param string $object_type
     * @param string $object_name
     * @param int    $index
     * @param string $dispatch
     * @param int    $company_id
     * @param string $lang_code Two-letter language code (e.g. 'en', 'ru', etc.)
     * @param array  $params    Additional params passed to fn_create_seo_name() function
     */
    fn_set_hook(
        'create_seo_name_pre',
        $object_id,
        $object_type,
        $object_name,
        $index,
        $dispatch,
        $company_id,
        $lang_code,
        $params
    );

    $seo_settings = fn_get_seo_settings($company_id);
    $non_latin_symbols = $seo_settings['non_latin_symbols'];

    $_object_name = preg_replace(
        '/(page)(-)([0-9]+|full_list)/',
        '$1$3',
        fn_generate_name($object_name, '', 0, ($non_latin_symbols == 'Y'))
    );

    $seo_var = fn_get_seo_vars($object_type);
    if (empty($_object_name)) {
        $_object_name = $seo_var['description'] . '-' . (empty($object_id) ? $dispatch : $object_id);
    }

    $condition = fn_get_seo_company_condition('?:seo_names.company_id', $object_type, $company_id);

    $path_condition = '';
    if (fn_check_seo_schema_option($seo_var, 'tree_options')) {
        $path_condition = db_quote(
            " AND path = ?s",
            fn_get_seo_parent_path($object_id, $object_type, $company_id, $use_generated_paths_cache)
        );
    }

    if (is_null($names_cache)) {
        $total = db_get_field("SELECT COUNT(*) FROM ?:seo_names WHERE 1 ?p", $condition);

        if ($total < $cache_max_length) {
            $names_cache = db_get_hash_single_array("SELECT name, 1 as val FROM ?:seo_names WHERE 1 ?p", array('name', 'val'), $condition);
        } else {
            $names_cache = array();
        }
    }

    $exist = false;
    if (empty($names_cache) || !empty($names_cache[$_object_name])) {
        $exist = db_get_field(
            "SELECT name FROM ?:seo_names WHERE name = ?s ?p AND (object_id != ?i OR type != ?s OR dispatch != ?s OR lang_code != ?s) ?p",
            $_object_name, $path_condition, $object_id, $object_type, $dispatch, $lang_code, $condition
        );
    }

    if (!$exist) {

        $_data = array(
            'name' => $_object_name,
            'type' => $object_type,
            'object_id' => $object_id,
            'dispatch' => $dispatch,
            'lang_code' => $lang_code,
            'path' => fn_get_seo_parent_path($object_id, $object_type, $company_id, $use_generated_paths_cache)
        );

        if (fn_allowed_for('ULTIMATE')) {
            if (fn_get_seo_vars($object_type, 'not_shared')) {
                if (!empty($company_id)) {
                    $_data['company_id'] = $company_id;
                } elseif (Registry::get('runtime.company_id')) {
                    $_data['company_id'] = Registry::get('runtime.company_id');
                }

                // Do not create SEO names for root
                if (empty($_data['company_id'])) {
                    return '';
                }
            }
        }

        if ($create_redirect) {
            $url = fn_generate_seo_url_from_schema(array(
                'type' => $object_type,
                'object_id' => $object_id,
                'lang_code' => $lang_code
            ), false, array(), $company_id);
        }

        $affected_rows = db_query("INSERT INTO ?:seo_names ?e ON DUPLICATE KEY UPDATE ?u", $_data, $_data);

        // cache object name only if the names cache is not empty already
        if (!empty($names_cache) && $affected_rows) {
            $names_cache[$_object_name] = 1;
        }

        if ($affected_rows && $create_redirect) {
            fn_seo_update_redirect(array(
                'src' => $url,
                'type' => $object_type,
                'object_id' => $object_id,
                'company_id' => $company_id,
                'lang_code' => $lang_code
            ), 0, false);
        }

    } else {
        $index++;

        if ($index == 1) {
            $object_name = $object_name . SEO_DELIMITER . $lang_code;
        } else {
            $object_name = preg_replace("/-\d+$/", "", $object_name) . SEO_DELIMITER . $index;
        }

        $_object_name = fn_create_seo_name($object_id, $object_type, $object_name, $index, $dispatch, $company_id, $lang_code, $create_redirect);
    }

    /**
     * Create SEO name (running after fn_create_seo_name() function)
     *
     * @param int    $_object_name
     * @param int    $object_id
     * @param string $object_type
     * @param string $object_name
     * @param int    $index
     * @param string $dispatch
     * @param int    $company_id
     * @param string $lang_code    Two-letter language code (e.g. 'en', 'ru', etc.)
     * @param array  $params    Additional params passed to fn_create_seo_name() function
     */
    fn_set_hook('create_seo_name_post', $_object_name, $object_id, $object_type, $object_name, $index, $dispatch, $company_id, $lang_code, $params);

    return $_object_name;
}

/**
 * Gets corrected language code
 *
 * @param string $lang_code    Language code
 * @param array  $seo_settings Storefront SEO settings
 *
 * @return string corrected language code
 */
function fn_get_corrected_seo_lang_code($lang_code, $seo_settings = array())
{
    if (!empty($seo_settings)) {
        $single_url = $seo_settings['single_url'];
        $default_lang_code = $seo_settings['frontend_default_language'];
    } else {
        $single_url = Registry::get('addons.seo.single_url');
        $default_lang_code = Registry::get('settings.Appearance.frontend_default_language');
    }

    return $single_url === 'Y' ? $default_lang_code : $lang_code;
}

/**
 * Gets objects definition from schema
 * @param string $type object type (if empty - returns full schema)
 * @param string $param object parameter (if empty - returns all object data)
 * @return mixed schema/object/parameter value
 */
function fn_get_seo_vars($type = '', $param = '')
{
    static $schema = array();

    if (empty($schema)) {
        $schema = fn_get_schema('seo', 'objects');
    }

    // Deprecated
    fn_set_hook('get_seo_vars', $schema);

    $res = (!empty($type)) ? $schema[$type] : $schema;

    if (!empty($param)) {
        $res = !empty($res[$param]) ? $res[$param] : false;
    }

    return $res;
}

/**
 * Gets rewrite rules
 * @return array list of rules
 */
function fn_get_rewrite_rules()
{
    $prefix = ((Registry::get('addons.seo.seo_language') == 'Y') ? '\/([a-z]+)' : '()');

    $rewrite_rules = array();

    $extension = str_replace('.', '', SEO_FILENAME_EXTENSION);

    fn_set_hook('get_rewrite_rules', $rewrite_rules, $prefix, $extension);

    $rewrite_rules['!^' . $prefix . '\/(.*\/)?([^\/]+)-page-([0-9]+|full_list)\.(' . $extension . ')$!'] = 'object_name=$matches[3]&page=$matches[4]&sl=$matches[1]&extension=$matches[5]';
    $rewrite_rules['!^' . $prefix . '\/(.*\/)?([^\/]+)\.(' . $extension . ')$!'] = 'object_name=$matches[3]&sl=$matches[1]&extension=$matches[4]';

    if (Registry::get('addons.seo.seo_language') == 'Y') {
        $rewrite_rules['!^' . $prefix . '\/?$!'] = '$customer_index?sl=$matches[1]';
    }
    $rewrite_rules['!^' . $prefix . '\/(.*\/)?([^\/]+)\/page-([0-9]+|full_list)(\/)?$!'] = 'object_name=$matches[3]&page=$matches[4]&sl=$matches[1]';

    $rewrite_rules['!^' . $prefix . '\/(.*\/)?([^\/?]+)\/?$!'] = 'object_name=$matches[3]&sl=$matches[1]';
    $rewrite_rules['!^' . $prefix . '/$!'] = '';

    return $rewrite_rules;
}

/**
 * "get_route" hook implemetation
 * @param array &$req input request
 * @param array &$result result of init function
 * @param string $area current working area
 * @param boolean $is_allowed_url Flag that determines if url is supported
 * @return bool true on success, false on failure
 */
function fn_seo_get_route(&$req, &$result, &$area, &$is_allowed_url)
{
    if (($area == 'C') && !$is_allowed_url) {

        $uri = fn_get_request_uri($_SERVER['REQUEST_URI']);

        if (!empty($uri)) {

            $rewrite_rules = fn_get_rewrite_rules();
            foreach ($rewrite_rules as $pattern => $query) {
                if (preg_match($pattern, $uri, $matches) || preg_match($pattern, urldecode($query), $matches)) {
                    $_query = preg_replace("!^.+\?!", '', $query);
                    parse_str($_query, $objects);
                    $result_values = 'matches';
                    $url_query = '';

                    foreach ($objects as $key => $value) {
                        preg_match('!^.+\[([0-9])+\]$!', $value, $_id);
                        $objects[$key] = (substr($value, 0, 1) == '$') ? ${$result_values}[$_id[1]] : $value;
                    }

                    // For the locations wich names stored in the table
                    if (!empty($objects) && !empty($objects['object_name'])) {
                        if (Registry::get('addons.seo.single_url') == 'Y') {
                            $objects['sl'] = (Registry::get('addons.seo.seo_language') == 'Y') ? $objects['sl'] : '';
                            $objects['sl'] = !empty($req['sl']) ? $req['sl'] : $objects['sl'];
                        }

                        $lang_cond = db_quote("AND lang_code = ?s", !empty($objects['sl']) ? $objects['sl'] : Registry::get('settings.Appearance.frontend_default_language'));

                        $object_type = db_get_field("SELECT type FROM ?:seo_names WHERE name = ?s ?p", $objects['object_name'], fn_get_seo_company_condition('?:seo_names.company_id'));

                        $_seo = db_get_array("SELECT * FROM ?:seo_names WHERE name = ?s ?p ?p", $objects['object_name'], fn_get_seo_company_condition('?:seo_names.company_id', $object_type), $lang_cond);

                        if (empty($_seo)) {
                            $_seo = db_get_array("SELECT * FROM ?:seo_names WHERE name = ?s ?p", $objects['object_name'], fn_get_seo_company_condition('?:seo_names.company_id'));
                        }

                        if (empty($_seo) && !empty($objects['extension'])) {
                            $_seo = db_get_array("SELECT * FROM ?:seo_names WHERE name = ?s ?p ?p", $objects['object_name'] . '.' . $objects['extension'], fn_get_seo_company_condition('?:seo_names.company_id'), $lang_cond);
                            if (empty($_seo)) {
                                $_seo = db_get_array("SELECT * FROM ?:seo_names WHERE name = ?s ?p", $objects['object_name'] . '.' . $objects['extension'], fn_get_seo_company_condition('?:seo_names.company_id', $object_type));
                            }
                        }

                        if (!empty($_seo)) {
                            $_seo_valid = false;

                            foreach ($_seo as $__seo) {
                                $_objects = $objects;
                                if (Registry::get('addons.seo.single_url') != 'Y' && empty($_objects['sl'])) {
                                    $_objects['sl'] = $__seo['lang_code'];
                                }

                                if (fn_seo_validate_object($__seo, $uri, $_objects) == true) {
                                    $_seo_valid = true;
                                    $_seo = $__seo;
                                    $objects = $_objects;

                                    break;
                                }
                            }

                            if ($_seo_valid == true) {
                                $req['sl'] = $objects['sl'];

                                $_seo_vars = fn_get_seo_vars($_seo['type']);
                                if ($_seo['type'] == 's') {
                                    $url_query = $_seo['dispatch'];
                                    $req['dispatch'] = $_seo['dispatch'];
                                } else {
                                    $page_suffix = (!empty($objects['page'])) ? ('&page=' . $objects['page']) : '';
                                    $url_query = $_seo_vars['dispatch'] . '?' . $_seo_vars['item'] . '=' . $_seo['object_id'] . $page_suffix;

                                    $req['dispatch'] = $_seo_vars['dispatch'];
                                }

                                if (!empty($_seo['object_id'])) {
                                    $req[$_seo_vars['item']] = $_seo['object_id'];
                                }

                                if (!empty($objects['page'])) {
                                    $req['page'] = $objects['page'];
                                }

                                $is_allowed_url = true;
                            }
                        }

                    // For the locations wich names are not in the table
                    } elseif (!empty($objects)) {
                        if (empty($objects['dispatch'])) {
                            if (!empty($req['dispatch'])) {
                                $req['dispatch'] = is_array($req['dispatch']) ? key($req['dispatch']) : $req['dispatch'];
                                $url_query = $req['dispatch'];
                            }
                        } else {
                            $url_query = $objects['dispatch'];
                            $req['dispatch'] = $objects['dispatch'];
                        }

                        $is_allowed_url = true;

                        if (!empty($objects['sl'])) {
                            $is_allowed_url = false;
                            $req['sl'] = $objects['sl'];
                            if (Registry::get('addons.seo.seo_language') == 'Y') {
                                $lang_statuses = !empty(Tygh::$app['session']['auth']['area']) && Tygh::$app['session']['auth']['area'] == 'A' ? array('A', 'H') : array('A');
                                $check_language = db_get_field("SELECT count(*) FROM ?:languages WHERE lang_code = ?s AND status IN (?a)", $req['sl'], $lang_statuses);
                                if (!empty($check_language)) {
                                    $is_allowed_url = true;
                                }
                            } else {
                                $is_allowed_url = true;
                            }
                        }
                        $req += $objects;

                        // Empty query
                    } else {
                        $url_query = '';
                    }

                    if ($is_allowed_url) {
                        $lang_code = empty($objects['sl']) ? Registry::get('settings.Appearance.frontend_default_language') : $objects['sl'];

                        if (empty($req['sl'])) {
                            unset($req['sl']);
                        }

                        $query_string = http_build_query($req);
                        $_SERVER['REQUEST_URI'] = fn_url($url_query . '?' . $query_string, 'C', 'rel', $lang_code);
                        $_SERVER['QUERY_STRING'] = $query_string;

                        $_SERVER['X-SEO-REWRITE'] = true;

                        break;
                    }
                }
            }
        }
    }

    // check redirects
    if (empty($is_allowed_url)) {

        $query_string = array();
        $uri = fn_get_request_uri($_SERVER['REQUEST_URI']);

        // Attach additinal params to URI if passed
        if (!empty($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $query_string);
        }

        // Remove pagination from URI
        if (preg_match('#(?P<pagination>-page-(?P<page>\d+))\\' . SEO_FILENAME_EXTENSION . '$#', $uri, $m)
            || preg_match('#(?P<pagination>/page-(?P<page>\d+)/?$)#', $uri, $m)
        ) {
            $query_string['page'] = $m['page'];
            $uri = str_replace($m['pagination'], '', $uri);
        }

        $condition = fn_get_seo_company_condition("?:seo_redirects.company_id");

        $redirect_data = db_get_row("SELECT type, object_id, dest, lang_code FROM ?:seo_redirects WHERE src = ?s ?p", $uri, $condition);

        if (!empty($redirect_data)) {
            $result = array(INIT_STATUS_REDIRECT, fn_generate_seo_url_from_schema($redirect_data, true, $query_string), false, true);
        } else {
            $req = array(
                'dispatch' => '_no_page'
            );
        }
    }
}

/**
 * Updates SEO name for object
 * @param array $object_data object data
 * @param array $object_id object ID
 * @param string $type object type
 * @param string $lang_code language code
 * @return mixed, updated SEO name on success, false on failure
 */
function fn_seo_update_object($object_data, $object_id, $type, $lang_code)
{
    fn_set_hook('seo_update_objects_pre', $object_data, $object_id, $type, $lang_code, $seo_objects);

    if (!empty($object_id) && isset($object_data['seo_name'])) {

        $_company_id = '';

        if (fn_allowed_for('ULTIMATE')) {
            if (!empty($seo_vars['not_shared']) && Registry::get('runtime.company_id')) {
                $_company_id = Registry::get('runtime.company_id');
            } elseif (!empty($object_data['company_id'])) {
                $_company_id = $object_data['company_id'];
            }
        }

        // Do nothing if SEO name was not changed
        $old_name = fn_seo_get_name($type, $object_id, '', $_company_id, $lang_code);
        if (!empty($old_name) && $object_data['seo_name'] == $old_name) {
            return true;
        }

        $_object_name = '';
        $seo_vars = fn_get_seo_vars($type);

        if (!empty($object_data['seo_name'])) {
            $_object_name = $object_data['seo_name'];
        } elseif (!empty($object_data[$seo_vars['description']])) {
            $_object_name = $object_data[$seo_vars['description']];
        }

        if (empty($_object_name)) {
            $_object_name = fn_seo_get_default_object_name($object_id, $type, $lang_code);
        }

        $lang_code = fn_get_corrected_seo_lang_code($lang_code);

        // always create redirect, execept it manually disabled
        $create_redirect = isset($object_data['seo_create_redirect']) ? !empty($object_data['seo_create_redirect']) : true;

        if (empty($old_name)) {
            $create_redirect = false;
        }

        $is_tree_object = fn_check_seo_schema_option($seo_vars, 'tree_options');

        // If this is tree object and we need to create redirect - create it for all children
        if ($create_redirect && $is_tree_object) {
            $children = fn_seo_get_object_children($type);
            if (!empty($children)) {
                $path = fn_get_seo_parent_path($object_id, $type);
                $path .= !empty($path) ? '/' . $object_id : $object_id;

                fn_iterate_through_seo_names(
                    function ($seo_name) use ($_company_id, $lang_code) {
                        $url = fn_generate_seo_url_from_schema(array(
                            'type' => $seo_name['type'],
                            'object_id' => $seo_name['object_id'],
                            'lang_code' => $lang_code
                        ), false);

                        fn_seo_update_redirect(array(
                            'src' => $url,
                            'type' => $seo_name['type'],
                            'object_id' => $seo_name['object_id'],
                            'company_id' => $_company_id,
                            'lang_code' => $lang_code
                        ), 0, false);
                    },
                    db_quote(
                        "path = ?s OR path LIKE ?l AND type IN (?a)",
                        $path, $path . '/%', $children
                    )
                );
            }
        }

        fn_create_seo_name($object_id, $type, $_object_name, 0, '', $_company_id, $lang_code, $create_redirect);

        return true;
    }

    return false;
}

/**
 * Validates if URL is valid
 * @param array $seo parsed data of target object
 * @param string $path URL path
 * @param array $objects list of objects in URL path
 * @return boolean true if object is valid, false - otherwise
 */
function fn_seo_validate_object($seo, $path, $objects)
{
    $result = true;
    if (Registry::get('addons.seo.single_url') == 'Y' && $seo['lang_code'] != Registry::get('settings.Appearance.frontend_default_language')) {
        return false;
    }

    if (!empty($objects['sl']) && $objects['sl'] != $seo['lang_code'] && Registry::get('addons.seo.single_url') != 'Y') {
        return false;
    }

    if (AREA == 'C') {
        $avail_langs = Languages::getSimpleLanguages(!empty(Tygh::$app['session']['auth']['area']) && Tygh::$app['session']['auth']['area'] == 'A');
        $obj_sl = !empty($objects['sl']) ? $objects['sl'] : $seo['lang_code'];
        if (!in_array($obj_sl, array_keys($avail_langs))) {
            return false;
        }
    }

    if (preg_match('/^(.*\/)?((' . $objects['object_name'] . ')(([\/\-]page[\-]?[\d]*)?(\/|(\\' . SEO_FILENAME_EXTENSION . '))?)?)$/', $path, $matches)) {
        // remove object from path
        $path = substr_replace($path, '', strrpos($path, $matches[2]));
    }

    if (Registry::get('addons.seo.seo_language') == 'Y') {
        $path = substr($path, 3); // remove language prefix
    }

    $path = rtrim($path, '/'); // remove trailing slash
    $vars = fn_get_seo_vars($seo['type']);

    // check parent objects
    $result = fn_seo_validate_parents($path, $seo['path'], !empty($vars['parent_type']) ? $vars['parent_type'] : $seo['type'], $vars, $seo['lang_code']);

    if ($result) {
        if (fn_check_seo_schema_option($vars, 'html_options')) {
            $result = !empty($objects['extension']);
        } else {
            $result = empty($objects['extension']);
        }
    }

    // Deprecated
    fn_set_hook('validate_sef_object', $path, $seo, $vars, $result, $objects);

    return $result;
}

/**
 * Validates object parents
 * @param string $path URL path
 * @param string $id_path URL path, represented by object IDs
 * @param string $parent_type type of parent object
 * @param array  $vars schema object
 * @param string $lang_code language code
 * @return boolean true if parents are valid, false - otherwise
 */
function fn_seo_validate_parents($path, $id_path, $parent_type, $vars, $lang_code = CART_LANGUAGE)
{
    $result = true;

    if (!empty($id_path) && fn_check_seo_schema_option($vars, 'tree_options')) {

        $parent_names = explode('/', trim($path, '/'));
        $parent_ids = is_array($id_path) ? $id_path : explode('/', $id_path);

        if (count($parent_ids) == count($parent_names)) {
            $parents = db_get_hash_single_array(
                "SELECT object_id, name FROM ?:seo_names WHERE name IN (?a) AND type = ?s AND lang_code = ?s ?p",
                array('object_id', 'name'), $parent_names, $parent_type, $lang_code, fn_get_seo_company_condition('?:seo_names.company_id')
            );

            foreach ($parent_ids as $k => $id) {
                if (empty($parents[$id]) || $parent_names[$k] != $parents[$id]) {
                    $result = false;
                    break;
                }
            }
        } else {
            $result = false;
        }
    } elseif (!empty($path)) { // if we have no parents, but some was passed via URL
        $result = false;
    }

    return $result;
}

/**
 * Get parent items path of names for seo object
 * @param array $seo_var schema object
 * @param string $object_type object type of seo object
 * @param string $object_id object id of seo object
 * @param int $company_id Company identifier
 * @param string $lang_code language code
 * @return array parent items path of names
 */
function fn_seo_get_parent_items_path($seo_var, $object_type, $object_id, $company_id = null, $lang_code = CART_LANGUAGE)
{
    $id_path = SeoCache::get('path', $object_type, $object_id, $company_id, $lang_code);

    if (is_null($id_path)) {

        $id_path = db_get_field("SELECT path FROM ?:seo_names WHERE object_id = ?i AND type = ?s ?p", $object_id, $object_type, fn_get_seo_company_condition("?:seo_names.company_id"));

        // deprecated
        fn_set_hook('seo_get_parent_items_path', $object_type, $object_id, $id_path);

        SeoCache::set($object_type, $object_id, array('seo_path' => $id_path), $company_id, $lang_code);
    }

    $parent_item_names = array();

    if (!empty($id_path)) {
        $path_ids = explode('/', $id_path);

        foreach ($path_ids as $v) {
            $object_type_for_name = !empty($seo_var['parent_type']) ? $seo_var['parent_type'] : $seo_var['type'];
            $parent_item_names[] = fn_seo_get_name($object_type_for_name, $v, '', $company_id, $lang_code);
        }

        return $parent_item_names;
    }

    return array();
}

/**
 * Define whether current page should be indexed
 *
 * $indexed_pages's element structure:
 * 'dipatch' => array( 'index' => array('param1','param2'),
 *                      'noindex' => array('param3'),
 *                  )
 * the page can be indexed only if the current dispatch is in keys of the $indexed_pages array.
 * If so, the page is indexed only if param1 and param2 are the keys of the $_REQUEST array and param3 is not.
 * @param array $request
 * @return bool $index_page  indicate whether indexed or not
 */
function fn_seo_is_indexed_page($request)
{
    if (defined('HTTPS') && fn_get_storefront_protocol() == 'http') {
        return false;
    }
    $controller_status = Tygh::$app['view']->getTemplateVars('exception_status');

    if (!empty($controller_status) && $controller_status != CONTROLLER_STATUS_OK) {
        return false;
    }

    $index_schema = fn_get_schema('seo', 'indexation');

    // backward compatibility, since 4.3.1
    $seo_vars = fn_get_seo_vars();
    foreach ($seo_vars as $seo_var) {
        if (!empty($seo_var['indexed_pages'])) {
            $index_schema = fn_array_merge($index_schema, $seo_var['indexed_pages']);
        }
    }

    // deprecated
    fn_set_hook('seo_is_indexed_page', $index_schema);

    $controller = Registry::get('runtime.controller');
    $mode = Registry::get('runtime.mode');

    if (isset($index_schema[$controller . '.' . $mode]) && is_array($index_schema[$controller . '.' . $mode])) {

        $dispatch_rules = $index_schema[$controller . '.' . $mode];

        if (empty($dispatch_rules['index']) && empty($dispatch_rules['noindex'])) {
            $index_page = true;
        } else {
            $index_cond = true;
            if (!empty($dispatch_rules['index']) && is_array($dispatch_rules['index'])) {
                $index_cond = false;
                if (sizeof(array_intersect($dispatch_rules['index'], array_keys($request))) == sizeof($dispatch_rules['index'])) {
                    $index_cond = true;
                }
            }

            $noindex_cond = true;
            if (isset($dispatch_rules['noindex'])) {
                if (is_bool($dispatch_rules['noindex'])) {
                    $noindex_cond = false;
                } elseif (is_array($dispatch_rules['noindex'])) {
                    $noindex_cond = false;
                    if (sizeof(array_intersect($dispatch_rules['noindex'], array_keys($request))) == 0) {
                        $noindex_cond = true;
                    }
                }
            }

            $index_page = $index_cond && $noindex_cond;
        }
    } else {
        // All pages that are not listed at schema should be indexed
        $index_page = true;
    }

    return $index_page;
}

/**
 * Get name for seo object
 *
 * @param string $object_type object type of seo object
 * @param int $object_id object id of seo object
 * @param string $dispatch  dispatch of seo object
 * @param int $company_id Company identifier
 * @param string $lang_code language code
 * @return string name for seo object
 */
function fn_seo_get_name($object_type, $object_id = 0, $dispatch = '', $company_id = null, $lang_code = CART_LANGUAGE)
{
    /**
     * Get name for seo object (running before fn_seo_get_name() function)
     *
     * @param string $object_type
     * @param int    $object_id
     * @param string $dispatch
     * @param int    $company_id
     * @param string $lang_code   Two-letter language code (e.g. 'en', 'ru', etc.)
     */
    fn_set_hook('seo_get_name_pre', $object_type, $object_id, $dispatch, $company_id, $lang_code);

    $company_id_condition = '';

    if (fn_allowed_for('ULTIMATE')) {
        if ($company_id !== null) {
            $company_id_condition = fn_get_seo_company_condition("?:seo_names.company_id", $object_type, $company_id);
        } else {
            $company_id_condition = fn_get_seo_company_condition('?:seo_names.company_id', $object_type);
            if (Registry::get('runtime.company_id')) {
                $company_id = Registry::get('runtime.company_id');
            }
        }
    }

    if ($company_id == null) {
        $company_id = '';
    }

    $seo_settings = fn_get_seo_settings($company_id);
    $lang_code = fn_get_corrected_seo_lang_code($lang_code, $seo_settings);

    $_object_id = !empty($object_id) ? $object_id : $dispatch;
    $name = SeoCache::get('name', $object_type, $_object_id, $company_id, $lang_code);

    if (is_null($name)) {

        $where_params = array(
            'object_id' => $object_id,
            'type' => $object_type,
            'dispatch' => $dispatch,
            'lang_code' => $lang_code,
        );

        $seo_data = db_get_row("SELECT name, path FROM ?:seo_names WHERE ?w ?p", $where_params, $company_id_condition);

        if (empty($seo_data)) {
            if ($object_type == 's') {
                $alt_name = db_get_field(
                    "SELECT name FROM ?:seo_names WHERE object_id = ?i AND type = ?s AND dispatch = ?s ?p",
                    $object_id, $object_type, $dispatch, $company_id_condition
                );
                if (!empty($alt_name)) {
                    $name = fn_create_seo_name($object_id, $object_type, str_replace('.', '-', $dispatch), 0, $dispatch, $company_id, $lang_code);
                }
            } else {
                $object_name = fn_seo_get_default_object_name($object_id, $object_type, $lang_code);
                if (!empty($object_name)) {
                    $name = fn_create_seo_name($object_id, $object_type, $object_name, 0, $dispatch, $company_id, $lang_code);
                }
            }
        } else {
            $name = $seo_data['name'];
        }

        $name = !empty($name) ? $name : '';

        if (!empty($seo_data)) {
            $cache_data = array(
                'seo_name' => $seo_data['name'],
                'seo_path' => $seo_data['path']
            );
        } else {
            $cache_data = array('seo_name' => $name);
        }

        SeoCache::set($object_type, $_object_id, $cache_data, $company_id, $lang_code);
    }

    /**
     * Get name for seo object (running after fn_seo_get_name() function)
     *
     * @param string $name
     * @param string $object_type
     * @param int    $object_id
     * @param string $dispatch
     * @param int    $company_id
     * @param string $lang_code   Two-letter language code (e.g. 'en', 'ru', etc.)
     */
    fn_set_hook('seo_get_name_post', $name, $object_type, $object_id, $dispatch, $company_id, $lang_code);

    return $name;
}

/**
 * Check if object has SEO link if redirects to it
 * @param array $req input request array
 * @param string $area current application area
 * @param string $lang_code language code
 * @return array init function status
 */
function fn_seo_check_dispatch(&$req, $area = AREA, $lang_code = CART_LANGUAGE)
{
    if (
        // Skip URL processing if it is API request
        defined('API')
        // Skip URL processing if init does not run via default customer entry point
        || basename($_SERVER['SCRIPT_FILENAME']) != Registry::get('config.customer_index')
    ) {
        return array(INIT_STATUS_OK);
    }

    if ($area == 'C') {
        // Redirects to / (/en if language code displayed in URL) if we call /index.php
        if ((empty($req) || $req['dispatch'] == 'index.index')) {
            $_req = $req;
            unset($_req['dispatch']);
            $url = fn_url('?' . http_build_query($_req), 'C', 'rel', $lang_code);
            $request_uri = new Url($_SERVER['REQUEST_URI']);

            if ($url != $request_uri->build(false, true)) {
                return array(INIT_STATUS_REDIRECT, $url, false, true);
            }
        }

        // Redirects to /seo-link if we call index.php?dispatch=controller.mode&object_id=id
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && empty($_SERVER['X-SEO-REWRITE']) && !empty($req['dispatch'])) {
            $_req = $req;
            $dispatch = $_req['dispatch'];
            $languages = Registry::get('languages');

            if (isset($_req['sl'], $languages[$_req['sl']])) {
                $request_lang_code = $_req['sl'];
            } else {
                $request_lang_code = $lang_code;
                unset($_req['sl']);
            }

            unset($_req['dispatch']);

            $seo_url = fn_url($dispatch . '?' . http_build_query($_req), 'C', 'rel', $request_lang_code);

            if (strpos($seo_url, 'dispatch=') === false) {
                return array(INIT_STATUS_REDIRECT, $seo_url, false, true);
            }
        }
    }

    return array(INIT_STATUS_OK);
}

/**
 * Get seo url
 * @param string $url url
 * @param string $area area for area
 * @param string $original_url original url from fn_url
 * @param string $prefix prefix
 * @param int $company_id_in_url Company identifier
 * @param string $lang_code language code
 * @return string seo url
 */
function fn_seo_url_post(&$url, &$area, &$original_url, &$prefix, &$company_id_in_url, &$lang_code)
{
    if ($area != 'C') {
        return $url;
    }

    $d = SEO_DELIMITER;
    $parsed_query = array();
    $parsed_url = parse_url($url);

    $index_script = Registry::get('config.customer_index');

    $settings_company_id = empty($company_id_in_url) ? 0 : $company_id_in_url;

    $http_path = Registry::get('config.http_path');
    $https_path = Registry::get('config.https_path');

    if (fn_allowed_for('ULTIMATE')) {
        $urls = fn_get_storefront_urls($settings_company_id);
        if (!empty($urls)) {
            $http_path = $urls['http_path'];
            $https_path = $urls['https_path'];
        }
    }

    $seo_settings = fn_get_seo_settings($settings_company_id);
    $current_path = '';

    if (empty($parsed_url['scheme'])) {
        $current_path = (defined('HTTPS')) ? $https_path . '/' : $http_path . '/';
    } else {
        // This is not http/https url like mailto:, ftp:
        if (!in_array($parsed_url['scheme'], array('http', 'https'))) {
            return $url;
        }

        if (!empty($parsed_url['host']) && !in_array($parsed_url['host'], array(Registry::get('config.http_host'),  Registry::get('config.https_host')))) {
            if (fn_allowed_for('ULTIMATE') && AREA == 'A') {
                $storefront_exist = db_get_row('SELECT company_id, storefront FROM ?:companies WHERE storefront = ?s OR secure_storefront = ?s', $parsed_url['host'], $parsed_url['host']);
                if (empty($storefront_exist)) {
                    return $url;  // This is external link
                }
            } else {
                return $url;  // This is external link
            }

        } elseif (!empty($parsed_url['path']) && (($parsed_url['scheme'] == 'http' && !empty($http_path) && stripos($parsed_url['path'], $http_path) === false) || ($parsed_url['scheme'] == 'https' && !empty($https_path) && stripos($parsed_url['path'], $https_path) === false))) {
            return $url;  // This is external link

        } else {
            if (rtrim($url, '/') == Registry::get('config.http_location') || rtrim($url, '/') == Registry::get('config.https_location')) {
                $url = rtrim($url, '/') . "/" . $index_script;
                $parsed_url['path'] = rtrim($parsed_url['path'], '/') . "/" . $index_script;
            }
        }
    }

    if (!empty($parsed_url['query'])) {
        parse_str($parsed_url['query'], $parsed_query);
    }

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        if (!empty($parsed_query['lc'])) {
            //if localization parameter is exist we will get language code for this localization.
            $loc_languages = db_get_hash_single_array("SELECT a.lang_code, a.name FROM ?:languages as a LEFT JOIN ?:localization_elements as b ON b.element_type = 'L' AND b.element = a.lang_code WHERE b.localization_id = ?i ORDER BY position", array('lang_code', 'name'), $parsed_query['lc']);
            $new_lang_code = (!empty($loc_languages)) ? key($loc_languages) : '';
            $lang_code = (!empty($new_lang_code)) ? $new_lang_code : $lang_code;
        }
    }

    if (!empty($parsed_url['path']) && empty($parsed_url['query']) && $parsed_url['path'] == $index_script) {
        $url = $current_path . (($seo_settings['seo_language'] == 'Y') ? $lang_code . '/' : '');

        return $url;
    }

    $path = str_replace($index_script, '', $parsed_url['path'], $count);

    if ($count == 0) {
        return $url; // This is currently seo link
    }

    $fragment = !empty($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';

    $link_parts = array(
        'scheme' => !empty($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '',
        'host' => !empty($parsed_url['host']) ? $parsed_url['host'] : '',
        'path' => $current_path . $path,
        'lang_code' => ($seo_settings['seo_language'] == 'Y') ? $lang_code . '/' : '',
        'parent_items_names' => '',
        'name' => '',
        'page' => '',
        'extension' => '',
    );

    if (!empty($parsed_query)) {
        if (!empty($parsed_query['sl'])) {
            $lang_code = $parsed_query['sl'];

            if ($seo_settings['single_url'] != 'Y') {
                $unset_lang_code = $parsed_query['sl'];
                unset($parsed_query['sl']);
            }

            if ($seo_settings['seo_language'] == 'Y') {
                $link_parts['lang_code'] = $lang_code . '/';
                $unset_lang_code = isset($parsed_query['sl']) ? $parsed_query['sl'] : $unset_lang_code;
                unset($parsed_query['sl']);
            }
        }

        $lang_code = fn_get_corrected_seo_lang_code($lang_code, $seo_settings);

        if (!empty($parsed_query['dispatch']) && is_string($parsed_query['dispatch'])) {

            if (!empty($original_url) && (stripos($parsed_query['dispatch'], '/') !== false || substr($parsed_query['dispatch'], -1 * strlen(SEO_FILENAME_EXTENSION)) == SEO_FILENAME_EXTENSION)) {
                $url = $original_url;

                return $url; // This is currently seo link
            }

            $seo_vars = fn_get_seo_vars();
            $rewritten = false;

            foreach ($seo_vars as $type => $seo_var) {
                if (empty($seo_var['dispatch']) || ($seo_var['dispatch'] == $parsed_query['dispatch'] && !empty($parsed_query[$seo_var['item']]))) {

                    if (!empty($seo_var['dispatch'])) {
                        $link_parts['name'] = fn_seo_get_name($type, $parsed_query[$seo_var['item']], '', $company_id_in_url, $lang_code);
                    } else {
                        $link_parts['name'] = fn_seo_get_name($type, 0, $parsed_query['dispatch'], $company_id_in_url, $lang_code);
                    }

                    if (empty($link_parts['name'])) {
                        continue;
                    }

                    if (fn_check_seo_schema_option($seo_var, 'tree_options', $seo_settings)) {
                        $parent_item_names = fn_seo_get_parent_items_path($seo_var, $type, $parsed_query[$seo_var['item']], $company_id_in_url, $lang_code);
                        $link_parts['parent_items_names'] = !empty($parent_item_names) ? join('/', $parent_item_names) . '/' : '';
                    }

                    if (fn_check_seo_schema_option($seo_var, 'html_options', $seo_settings)) {
                        $link_parts['extension'] = SEO_FILENAME_EXTENSION;
                    } else {
                        $link_parts['name'] .= '/';
                    }

                    if (!empty($seo_var['pager'])) {

                        $page = isset($parsed_query['page']) ? intval($parsed_query['page']) : 0;

                        if (!empty($page) && $page != 1) {
                            if (fn_check_seo_schema_option($seo_var, 'html_options', $seo_settings)) {
                                $link_parts['name'] .= $d . 'page' . $d . $page;
                            } else {
                                $link_parts['name'] .= 'page' . $d . $page . '/';
                            }
                        }
                        unset($parsed_query['page']);
                    }

                    fn_seo_parsed_query_unset($parsed_query, $seo_var['item']);

                    $rewritten = true;
                    break;
                }
            }

            if (!$rewritten) {
                // deprecated
                fn_set_hook('seo_url', $seo_settings, $url, $parsed_url, $link_parts, $parsed_query, $company_id_in_url, $lang_code);

                if (empty($link_parts['name'])) {
                    // for non-rewritten links
                    $link_parts['path'] .= $index_script;
                    $link_parts['lang_code'] = '';
                    if (!empty($unset_lang_code)) {
                        $parsed_query['sl'] = $unset_lang_code;
                    }
                }
            } else {
                unset($parsed_query['company_id']); // we do not need this parameter if url is rewritten
            }

        } elseif ($seo_settings['seo_language'] != 'Y' && !empty($unset_lang_code)) {
            $parsed_query['sl'] = $unset_lang_code;
        }
    }

    $url = join('', $link_parts);

    if (!empty($parsed_query)) {
        $url .= '?' . http_build_query($parsed_query) . $fragment;
    }

    return $url;
}

/**
 * Unset some keys in parsed_query array
 * @param array $parts_array link parts
 * @param mixed $keys keys for unseting
 * @return string name for seo object
 */
function fn_seo_parsed_query_unset(&$parts_array, $keys = array())
{
    $keys = is_array($keys) ? $keys : array($keys);
    $keys[] = 'dispatch';

    foreach ($keys as $v) {
        unset($parts_array[$v]);
    }

    return true;
}

/**
 * Compares if 2 urls are the same
 * @param string &$url1 URL to compare
 * @param string &$url2  URL to compare
 * @param boolean &$result true if URLs are the same
 */
function fn_seo_compare_dispatch(&$url1, &$url2, &$result)
{
    $url1 = fn_url($url1);
    $url2 = fn_url($url2);

    $pos1 = strpos($url1, '?');
    if ($pos1 !== false) {
        $url1 = substr($url1, 0, $pos1);
    }

    $pos2 = strpos($url2, '?');
    if ($pos2 !== false) {
        $url2 = substr($url2, 0, $pos2);
    }

    $result = ($url1 == $url2);
}

/**
 * Gets object name to generate SEO name
 * @param int $object_id object ID
 * @param string $object_type object type
 * @param string $lang_code language code
 * @return string object name
 */
function fn_seo_get_default_object_name($object_id, $object_type, $lang_code)
{
    $_seo = fn_get_seo_vars($object_type);

    $object_name = '';
    if (!empty($_seo['table']) && isset($_seo['condition'])) {
        $lang_condition = '';
        if (empty($_seo['skip_lang_condition'])) {
            $lang_condition = db_quote("AND lang_code = ?s", $lang_code);
        }
        $object_name = db_get_field(
            "SELECT $_seo[description] FROM $_seo[table] WHERE $_seo[item] = ?i ?p ?p",
            $object_id, $lang_condition, $_seo['condition']
        );
    }

    return $object_name;
}

/**
 * Processes SEO rules data
 *
 * @return boolean Always true
 */
function fn_seo_install()
{
    $default_lang = Registry::get('settings.Appearance.frontend_default_language');
    if (defined('INSTALLER_INITED') || empty($default_lang)) {
        $default_lang = CART_LANGUAGE;
    }

    $installed_lang = db_get_field("SELECT lang_code FROM ?:seo_names WHERE type = 's'");
    db_query("UPDATE ?:seo_names SET lang_code = ?s WHERE lang_code = ?s AND type = 's'", $default_lang, $installed_lang);

    // clone SEO names
    $seo_names = db_get_array("SELECT * FROM ?:seo_names WHERE type = 's' AND lang_code = ?s", $default_lang);

    $languages = Languages::getAll();
    unset($languages[$default_lang]);

    foreach ($languages as $lang_code => $lang_data) {
        foreach ($seo_names as $data) {
            $data['lang_code'] = $lang_code;
            $data['name'] = $data['name'] . '-' . $lang_code;
            db_query('REPLACE INTO ?:seo_names ?e', $data);
        }
    }

    return true;
}

/**
 * Gets SEO subtitle with page info
 *
 * @param $search Search parameteres
 * @return string Page info title
 */
function fn_get_seo_page_title($search)
{
    static $title;

    if (!isset($title)) {
        $title = '';
        if (!empty($search['page']) && $search['page'] > 1) {
            $title = ' - ' . __('seo_page_title', array($search['page']));
        }
    }

    return  $title;
}

/**
 * Gets path of parent objects for given object
 *
 * @param integer $object_id   Object ID
 * @param string  $object_type Object type
 * @param integer $company_id  Company ID
 * @param boolean $use_caching Whether to cache results of path_function calls
 *
 * @return string path
 */
function fn_get_seo_parent_path($object_id, $object_type, $company_id = 0, $use_caching = true)
{
    static $cache = array();

    $schema = fn_get_seo_vars();

    if (!empty($schema[$object_type])) {
        $object_schema = $schema[$object_type];

        if (!empty($object_schema['tree'])) {

            if ($use_caching && isset($cache[$company_id][$object_type][$object_id])) {
                return $cache[$company_id][$object_type][$object_id];
            } else {
                $parent_path = $object_schema['path_function']($object_id, $company_id);

                if ($use_caching) {
                    $cache[$company_id][$object_type][$object_id] = $parent_path;
                }

                return $parent_path;
            }

        }

    }

    return '';
}

/**
 * Iterates through all SEO-names and calls given function for every one.
 *
 * @param Callable    $iterator  Function that would be called for every SEO-name DB record
 * @param string|null $condition Optional additional condition for SQL-query that fetches records.
 */
function fn_iterate_through_seo_names($iterator, $condition = null)
{
    $lower_limit = 0;
    $items_per_pass = 100;

    if (!empty($condition)) {
        $condition = "WHERE {$condition}";
    }

    while ($seo_names = db_get_array("SELECT * FROM ?:seo_names ?p LIMIT ?i, ?i",
        $condition, $lower_limit, $items_per_pass
    )) {
        array_walk($seo_names, $iterator);
        $lower_limit += $items_per_pass;
    }
}

/**
 * Updates SEO names according to path when parent was changed for object.
 *
 * @param integer $object_id   object ID
 * @param string  $object_type object type
 * @param array   $params      params
 *
 * @return bool Whether SEO-names were regenerated successfully.
 */
function fn_seo_update_tree_object($object_id, $object_type, $params)
{
    if (isset($params['old_id_path']) && empty($params['old_id_path'])) {
        return false; // newly created object, skip
    }

    $regenerate_children = isset($params['regenerate_children']) ? $params['regenerate_children'] : true;
    $regenerate_grandchildren = isset($params['regenerate_grandchildren']) ? $params['regenerate_grandchildren'] : true;
    $frontend_default_language = Registry::get('settings.Appearance.frontend_default_language');

    // Update item itself if it wasn't deleted
    if (!isset($params['after_deletion']) || !$params['after_deletion']) {
        $lang_codes = array($frontend_default_language);
        $seo_settings = fn_get_seo_settings($params['company_id']);

        $generate_redirects_for_all_languages = $seo_settings['single_url'] != 'Y' || $seo_settings['seo_language'] == 'Y';
        if ($generate_redirects_for_all_languages) {
            $lang_codes = array_unique(array_merge($lang_codes, array_keys(Languages::getAll())));
        }

        foreach ($lang_codes as $lang_code) {
            $seo_name = fn_seo_get_name($object_type, $object_id, '', $params['company_id'], $lang_code);
            fn_create_seo_name($object_id, $object_type, $seo_name, 0, '', $params['company_id'], $lang_code, !empty($seo_name));
        }
    }

    if (empty($params['old_id_path'])) {
        return true;
    }

    $items_per_pass = 100;
    $condition = fn_get_seo_company_condition('?:seo_names.company_id', '', $params['company_id']);
    $process_conditions = array();

    // Regenerate children SEO-names
    if ($regenerate_children) {
        $process_conditions[] = db_quote("path = ?s AND type IN (?a) ?p", $params['old_id_path'], $params['object_types'], $condition);
    }

    // Regenerate grandchildren SEO-names
    if ($regenerate_grandchildren) {
        $process_conditions[] = db_quote("path LIKE ?l AND type IN (?a) ?p", $params['old_id_path'] . '/%', $params['object_types'], $condition);
    }

    foreach ($process_conditions as $condition) {
        $last_seo_name = null;

        while ($seo_names = db_get_array("SELECT * FROM ?:seo_names WHERE ?p LIMIT 0, ?i", $condition, $items_per_pass)) {
            foreach ($seo_names as $seo_name) {
                // Detecting loops to prevent possible malfunctions caused by hook handlers during SEO name generation.
                if (isset($last_seo_name)
                    && $last_seo_name['object_id'] === $seo_name['object_id']
                    && $last_seo_name['type'] === $seo_name['type']
                    && $last_seo_name['lang_code'] === $seo_name['lang_code']
                ) {
                    error_log(sprintf('Unable to continue updating SEO names for child objects: loop detected; condition: %s; file %s; line: %s',
                        $condition,
                        __FILE__,
                        __LINE__
                    ));
                    break 2;
                }

                fn_regenerate_seo_name($seo_name);
            }

            $last_seo_name = $seo_name;
        }
    }

    return true;
}

/**
 * Updates given SEO name according to its object actual state. If related object doesn't exist, SEO-name will be deleted.
 *
 * @param array $seo_name SEO-name data from DB.
 *
 * @return bool Whether SEO-name was regenerated (true) or deleted (false).
 */
function fn_regenerate_seo_name(array $seo_name)
{
    if (fn_check_seo_object_exists($seo_name['object_id'], $seo_name['type'], $seo_name['company_id']) !== false) {
        fn_create_seo_name($seo_name['object_id'], $seo_name['type'], $seo_name['name'], 0, '',
            $seo_name['company_id'], $seo_name['lang_code'], true, AREA, array('use_generated_paths_cache' => false));

        return true;
    } else {
        fn_delete_seo_name($seo_name['object_id'], $seo_name['type'], '', $seo_name['company_id']);

        return false;
    }
}

/**
 * Check schema values for option
 * @param array $seo_var schema object
 * @param string $option option name
 * @param array $seo_settings storefront SEO settings
 * @return boolean true if option value exists in schema
 */
function fn_check_seo_schema_option($seo_var, $option, $seo_settings = array())
{
    if (!empty($seo_settings)) {
        $option_value = $seo_settings[$seo_var['option']];
    } else {
        $option_value = Registry::get('addons.seo.' . $seo_var['option']);
    }

    if (!empty($seo_var[$option]) && in_array($option_value, $seo_var[$option])) {
        return true;
    }

    return false;
}

/**
 * Generates URL according to schema definition
 * @param array $redirect_data redirect data
 * @param boolean $full generated full URL if true and URI part if false
 * @param array $query_string additional params to attach to URL
 * @return string URL
 */
function fn_generate_seo_url_from_schema($redirect_data, $full = true, $query_string = array(), $company_id = null)
{
    $seo_vars = fn_get_seo_vars();

    if (fn_allowed_for('ULTIMATE')) {
        if ($company_id === null) {
            $company_id = Registry::get('runtime.company_id');
        }
    }

    if ($redirect_data['type'] == 's') {

        $http_path = Registry::get('config.http_path');

        if (fn_allowed_for('ULTIMATE')) {
            $urls = fn_get_storefront_urls($company_id);
            if (!empty($urls)) {
                $http_path = $urls['http_path'];
            }
        }

        $url = $http_path . $redirect_data['dest'];
    } else {
        $url = $seo_vars[$redirect_data['type']]['dispatch'] . '?' . $seo_vars[$redirect_data['type']]['item'] . '=' . $redirect_data['object_id'];
    }

    // do not add company_id to static routes
    if (fn_allowed_for('ULTIMATE') && $redirect_data['type'] != 's') {
        $url = fn_link_attach($url, 'company_id=' . $company_id);
    }

    if (!empty($query_string)) {
        $url = fn_link_attach($url, http_build_query($query_string));
    }

    $lang_code = !empty($redirect_data['lang_code']) ? $redirect_data['lang_code'] : Registry::get('settings.Appearance.frontend_default_language');

    if ($full) {
        $url = fn_url($url, 'C', 'current', $lang_code);
    } else {
        $url = fn_get_request_uri(fn_url($url, 'C', 'rel', $lang_code));
    }

    return $url;
}

/**
 * Creates/update 301 redirect
 * @param array $redirect_data redirect data
 * @param integer $redirect_id redirect ID
 * @param boolean $notify if set ti true notify if old url already exists
 * @return integer redirect ID
 */
function fn_seo_update_redirect($redirect_data, $redirect_id = 0, $notify = true)
{
    if (empty($redirect_data['company_id'])) {
        $redirect_data['company_id'] = 0;
    }
    if (fn_allowed_for('ULTIMATE')) {
        if (empty($redirect_data['company_id']) && Registry::get('runtime.company_id')) {
            $redirect_data['company_id'] = Registry::get('runtime.company_id');
        }
    }

    $continue = true;
    $redirect_data['src'] = fn_seo_check_redirect_url($redirect_data['src'], $redirect_data['company_id']);
    if ($redirect_data['src'] === false) {
        $continue = false;
    }

    if (!empty($redirect_data['dest'])) {
        $redirect_data['dest'] = fn_seo_check_redirect_url($redirect_data['dest'], $redirect_data['company_id']);
        if ($redirect_data['dest'] === false) {
            $continue = false;
        }
    }

    if ($continue) {
        if (empty($redirect_id)) {
            if (!empty($redirect_data['src'])) {

                $condition = fn_get_seo_company_condition('?:seo_redirects.company_id');

                $exists = db_get_field("SELECT redirect_id FROM ?:seo_redirects WHERE src = ?s ?p", $redirect_data['src'], $condition);
                if (empty($exists)) {
                    $redirect_id = db_query("INSERT INTO ?:seo_redirects ?e", $redirect_data);
                } elseif ($notify) {
                    fn_set_notification('E', __('error'), __('seo.error_old_url_exists'));
                }
            }
        } else {
            db_query("UPDATE ?:seo_redirects SET ?u WHERE redirect_id = ?i", $redirect_data, $redirect_id);
        }
    }

    return $redirect_id;
}

/**
 * Checks redirect URL and converts it to correct format
 * @param string $url URL
 * @param integer $company_id company ID
 * @return string corrected URL
 */
function fn_seo_check_redirect_url($url, $company_id = 0)
{
    if (strpos($url, '//') !== false) {
        $_url = '';
        if (fn_allowed_for('ULTIMATE')) {
            $_url = '?company_id=' . $company_id;
        }

        $storefront_url = fn_url($_url, 'C', 'http');
        $secure_storefront_url = fn_url($_url, 'C', 'https');

        if (strpos($url, $storefront_url) !== false) {
            $url = str_replace($storefront_url, '', $url);
        } elseif (strpos($url, $secure_storefront_url) !== false) {
            $url = str_replace($secure_storefront_url, '', $url);
        } else {
            fn_set_notification('E', __('error'), __('seo.error_incorrect_url', array(
                '[url]' => $url
            )));

            return false;
        }
    }

    if (!empty($url)) {
        $url = '/' . trim($url, '/');
    }

    return $url;
}

/**
 * Gets parent URI and suffix of SEO url
 * @param integert $object_id object ID
 * @param string $object_type object type
 * @return array prefix (uri) and suffix (extension)
 */
function fn_get_seo_parent_uri($object_id, $object_type, $lang_code = CART_LANGUAGE)
{
    $url = fn_generate_seo_url_from_schema(array(
        'object_id' => $object_id,
        'type' => $object_type,
        'lang_code' => $lang_code
    ), false);

    $aurl = explode('/', $url);
    array_pop($aurl);

    $seo_var = fn_get_seo_vars($object_type);

    return array(
        'prefix' => implode('/', $aurl) . '/',
        'suffix' => fn_check_seo_schema_option($seo_var, 'html_options') ? SEO_FILENAME_EXTENSION : ''
    );
}

/**
 * Gets child objects of current object
 * @param string $object_type object type
 * @return array children
 */
function fn_seo_get_object_children($object_type)
{
    $children = array();
    $schema = fn_get_seo_vars();
    foreach ($schema as $type => $params) {
        if (!empty($params['parent_type']) && $params['parent_type'] == $object_type) {
            $children[] = $type;
        }
    }

    return $children;
}

/**
 * Gets SEO settings
 *
 * @param int $company_id company ID
 *
 * @return array SEO settings
 */
function fn_get_seo_settings($company_id)
{
    static $cache = array();

    if (isset($cache[$company_id])) {
        $seo_settings = $cache[$company_id];
    } else {
        $seo_settings = Settings::instance()->getValues('seo', Settings::ADDON_SECTION, false, $company_id);
        $seo_settings['frontend_default_language'] = Settings::instance()->getValue('frontend_default_language', 'Appearance', $company_id);

        $cache[$company_id] = $seo_settings;
    }

    return $seo_settings;
}

/* Product hooks */
function fn_seo_get_product_data(&$product_id, &$field_list, &$join, &$auth, &$lang_code)
{
    $field_list .= ', ?:seo_names.name as seo_name, ?:seo_names.path as seo_path';

    if (fn_allowed_for('ULTIMATE')) {
        $company_join = !Registry::get('runtime.company_id') ? 'AND ?:seo_names.company_id = ?:products.company_id' : 'AND ?:seo_names.company_id = ' . Registry::get('runtime.company_id');
    } else {
        $company_join = '';
    }

    $join .= db_quote(
        " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?i AND ?:seo_names.type = 'p' "
        . "AND ?:seo_names.dispatch = '' AND ?:seo_names.lang_code = ?s $company_join",
        $product_id, fn_get_corrected_seo_lang_code($lang_code)
    );

    return true;
}

/**
 * Hook handler: for changing availability after inventory amount is fetched
 */
function fn_seo_gather_additional_product_data_post(&$product_data, $auth, $params)
{
    if (isset($product_data['seo_snippet'])) {

        if (isset($product_data['inventory_amount'])) {
            $product_data['seo_snippet']['availability'] = fn_seo_get_availability_for_snippet($product_data['inventory_amount']);
        }

        if (isset($product_data['price'])) {
            // Discount might be applied to the original price
            $price = fn_format_price((float) $product_data['price']);
            $product_data['seo_snippet']['price'] = $price;
        }

        if (isset($product_data['product_code'])) {
            $product_data['seo_snippet']['sku'] = $product_data['product_code'];
        }

        $image_links = [];
        if (!empty($product_data['main_pair']['detailed']['image_path'])) {
            $image_links[] = $product_data['main_pair']['detailed']['image_path'];
        }
        if (!empty($product_data['image_pairs'])) {
            foreach ($product_data['image_pairs'] as $image_pair) {
                if (!empty($image_pair['detailed']['image_path'])) {
                    $image_links[] = $image_pair['detailed']['image_path'];
                }
            }
        }
        if ($image_links) {
            $product_data['seo_snippet']['images'] = $image_links;
        }

        if (!isset($product_data['seo_snippet']['brand'])) {
            $header_features = fn_get_product_features_list($product_data, 'H');
            $product_brand = fn_seo_extract_feature_brand($header_features);
            if ($product_brand) {
                $product_data['seo_snippet']['brand'] = $product_brand;
            }
        }

    }
}

/**
 * Gets product availability based on it's amount or amount tracking setting *
 *
 * @param int $amount Product amount
 *
 * @return string
 */
function fn_seo_get_availability_for_snippet($amount)
{
    $availability = 'OutOfStock';

    if ($amount > 0 || Registry::get('settings.General.inventory_tracking') == 'N') {
        $availability = 'InStock';
    }

    return $availability;
}

function fn_seo_get_product_data_post(&$product_data, &$auth, &$preview, &$lang_code)
{
    if (fn_allowed_for('ULTIMATE')) {
        $sharing_company_id = Registry::get('runtime.company_id')
            ? Registry::get('runtime.company_id')
            : $product_data['company_id'];

        if (!in_array($sharing_company_id, $product_data['shared_between_companies'])) {
            return false;
        }
    }

    // Product SEO-name can be build only if product is shared to current company
    if (empty($product_data['seo_name']) && !empty($product_data['product_id'])) {
        $product_data['seo_name'] = fn_seo_get_name('p', $product_data['product_id'], '', null, $lang_code);
    }

    // Prepare data for schema.org product markup
    $amount = 0;
    if (isset($product_data['inventory_amount'])) {
        $amount = $product_data['inventory_amount'];
    } elseif (isset($product_data['amount'])) {
        $amount = $product_data['amount'];
    }
    if (!empty($product_data['min_qty']) && $amount < $product_data['min_qty']) {
        $amount = 0;
    }

    $availability = fn_seo_get_availability_for_snippet($amount);

    $description = '';
    if (!empty($product_data['full_description'])) {
        $description = $product_data['full_description'];
    } elseif (!empty($product_data['short_description'])) {
        $description = $product_data['short_description'];
    }

    $price = 0;
    if (!empty($product_data['price'])) {
        $price = fn_format_price((float)$product_data['price']);
    }

    if (!empty($product_data['product'])) {
        $product_data['seo_snippet'] = array(
            'sku' => empty($product_data['product_code']) ? '' : $product_data['product_code'],
            'name' => strip_tags($product_data['product']),
            'description' => strip_tags($description),
            'availability' => $availability,
            'price_currency' => CART_PRIMARY_CURRENCY,
            'price' => $price,
            'show_price' => !empty($auth['user_id'])
                || Registry::get('settings.Checkout.allow_anonymous_shopping') != 'hide_price_and_add_to_cart'
        );

        if (isset($product_data['header_features'])) {
            $product_brand = fn_seo_extract_feature_brand($product_data['header_features']);
            if ($product_brand) {
                $product_data['seo_snippet']['brand'] = $product_brand;
            }
        }
    }

    return true;
}

function fn_seo_get_products(&$params, &$fields, &$sortings, &$condition, &$join, &$sorting, &$group_by, &$lang_code)
{
    if (isset($params['compact']) && $params['compact'] == 'Y' && !empty($params['q']) && $params['area'] == 'A') {
        $condition .= db_quote(' OR (?:seo_names.name LIKE ?s ?p)', '%' . preg_replace('/-[a-zA-Z]{1,3}$/i', '', str_ireplace(SEO_FILENAME_EXTENSION, '', $params['q'])) . '%', fn_get_company_condition('products.company_id'));

        $lang_condition = db_quote(' AND ?:seo_names.lang_code = ?s', $lang_code);
        $fields[] = '?:seo_names.name as seo_name';
        $fields[] = '?:seo_names.path as seo_path';
        $join .= db_quote(
            " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = products.product_id AND ?:seo_names.type = 'p' AND ?:seo_names.dispatch = '' ?p",
            $lang_condition . fn_get_seo_company_condition('?:seo_names.company_id')
        );
    }
}

/**
 * Hook "load_products_extra_data" handler.
 * Performs deferred fetching SEO names and paths for loaded products.
 *
 * @param $extra_fields
 * @param $products
 * @param $product_ids
 * @param $params
 * @param $lang_code
 */
function fn_seo_load_products_extra_data(&$extra_fields, $products, $product_ids, $params, $lang_code)
{
    if (isset($params['compact']) && $params['compact'] == 'Y') {
        return;
    }

    $extra_fields['?:seo_names'] = array(
        'primary_key' => 'product_id',
        'fields'      => array(
            'product_id' => '?:seo_names.object_id',
            'seo_name'   => '?:seo_names.name',
            'seo_path'   => '?:seo_names.path',
        ),
        'condition' => db_quote(
            ' AND ?:seo_names.type = "p"' .
            ' AND ?:seo_names.dispatch = ""' .
            ' AND ?:seo_names.lang_code = ?s ?p',
            fn_get_corrected_seo_lang_code($lang_code),
            fn_get_seo_company_condition('?:seo_names.company_id')
        )
    );
}

/**
 * Hook "load_products_extra_data_post" handler.
 * Performs caching lazy-loaded SEO names.
 *
 * @param $products
 * @param $product_ids
 * @param $params
 * @param $lang_code
 */
function fn_seo_load_products_extra_data_post($products, $product_ids, $params, $lang_code)
{
    if (AREA == 'C') {
        foreach ($products as $k => $product) {
            SeoCache::set(
                'p',
                $product['product_id'],
                $product,
                isset($product['company_id']) ? $product['company_id'] : '',
                fn_get_corrected_seo_lang_code($lang_code)
            );
        }
    }
}

function fn_seo_update_product_post(&$product_data, &$product_id, &$lang_code)
{
    if ($company_id = Registry::get('runtime.company_id')) {
        $product_data['company_id'] = $company_id;
    }

    fn_seo_update_object($product_data, $product_id, 'p', $lang_code);
}

function fn_seo_delete_product_post(&$product_id)
{
    return fn_delete_seo_name($product_id, 'p');
}

function fn_seo_update_product_categories_post($product_id, $product_data, $existing_categories, $rebuild, $company_id)
{
    if ($rebuild == true) {
        if (fn_allowed_for('ULTIMATE')
            && $company_id != 0
            && $company_id != Registry::get('runtime.company_id')
            && (!Registry::get('runtime.simple_ultimate')
                || $product_data['company_id'] != $company_id
            )
        ) {
            return true;
        }

        $company_ids = array(!empty($product_data['company_id']) ? $product_data['company_id'] : 0);

        if (fn_allowed_for('ULTIMATE')) {
            if ($current_company_id = Registry::get('runtime.company_id')) {
                $company_ids = array($current_company_id);
            } else {
                $company_ids = fn_ult_get_shared_product_companies($product_id);
            }
        }

        foreach ($company_ids as $company_id) {
            fn_seo_update_tree_object($product_id, 'p', array(
                'company_id' => $company_id,
                'object_types' => array('p')
            ));
        }

        return true;
    }

    return false;
}

/* /Product hooks

/* Category hooks */
function fn_seo_get_category_data(&$category_id, &$field_list, &$join, &$lang_code)
{
    $field_list .= ', ?:seo_names.name as seo_name, ?:seo_names.path as seo_path';
    $join .= db_quote(
        " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?i ?p",
        $category_id, fn_get_seo_join_condition('c', '?:categories.company_id', $lang_code)
    );

    return true;
}

function fn_seo_get_category_data_post(&$category_id, &$field_list, &$get_main_pair, &$skip_company_condition, &$lang_code, &$category_data)
{
    if (AREA == 'C' && !empty($category_data)) {
        SeoCache::set('c', $category_data['category_id'], $category_data, null, $lang_code);
    }

    if (empty($category_data['seo_name']) && !empty($category_data['category_id'])) {
        $category_data['seo_name'] = fn_seo_get_name('c', $category_data['category_id'], '', isset($category_data['company_id']) ? $category_data['company_id'] : '', $lang_code);
    }

    return true;
}

function fn_seo_get_categories(&$params, &$join, &$condition, &$fields, &$group_by, &$sortings, &$lang_code)
{
    $fields[] = '?:seo_names.name as seo_name';
    $fields[] = '?:seo_names.path as seo_path';

    $join .= db_quote(
        " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:categories.category_id ?p",
        fn_get_seo_join_condition('c', '?:categories.company_id', fn_get_corrected_seo_lang_code($lang_code))
    );
}

function fn_seo_get_categories_post(&$categories, &$params, &$lang_code)
{
    if (AREA == 'C') {
        if (empty($params['plain'])) {
            $cats = fn_multi_level_to_plain($categories, 'subcategories');
        } else {
            $cats = $categories;
        }

        foreach ($cats as $k => $category) {
            SeoCache::set('c',
                $category['category_id'],
                $category,
                isset($category['company_id'])
                    ? $category['company_id']
                    : '',
                fn_get_corrected_seo_lang_code($lang_code)
            );
        }
    }

    return true;
}

function fn_seo_update_category_post(&$category_data, &$category_id, &$lang_code)
{
    if (fn_allowed_for('ULTIMATE')) {
        if (empty($category_data['company_id'])) {
            $category_data['company_id'] = db_get_field('SELECT company_id FROM ?:categories WHERE category_id = ?i', $category_id);
        }
    }

    fn_seo_update_object($category_data, $category_id, 'c', $lang_code);
}

function fn_seo_delete_category_before(&$category_id)
{
    $old_category_data = db_get_row(
        "SELECT company_id, id_path FROM ?:categories WHERE category_id = ?i",
        $category_id
    );
    // It's impossible to generate correct SEO-name for already deleted category, and
    // this call generates (if none) and caches SEO name of category that is being deleted BEFORE actual deletion.
    // Cached name will be used later when generating redirect for category and its non-deleted products.
    fn_seo_get_name('c', $category_id, '', $old_category_data['company_id']);

    Registry::set('runtime.seo._old_category_data', $old_category_data);
}

function fn_seo_delete_category_after(&$category_id)
{
    $old_category_data = Registry::get('runtime.seo._old_category_data');

    $condition = db_quote(
        "path = ?s AND type = ?s ?p",
        $old_category_data['id_path'],
        'p',
        fn_get_seo_company_condition('?:seo_names.company_id', '', $old_category_data['company_id'])
    );

    fn_iterate_through_seo_names('fn_regenerate_seo_name', $condition);
    fn_delete_seo_name($category_id, 'c');
}

function fn_seo_update_category_parent_pre($category_id, $new_parent_id)
{
    $category_data = db_get_row("SELECT company_id, id_path FROM ?:categories WHERE category_id = ?i", $category_id);

    Registry::set('runtime.seo._old_category_data', $category_data);
}

function fn_seo_update_category_parent_post($category_id, $new_parent_id)
{
    $old_category_data = Registry::get('runtime.seo._old_category_data');

    return fn_seo_update_tree_object($category_id, 'c', array(
        'company_id' => $old_category_data['company_id'],
        'old_id_path' => $old_category_data['id_path'],
        'object_types' => array('c', 'p')
    ));
}

/**
 * Hook handler
 *
 * @param array  $data
 * @param int    $company_id
 */
function fn_seo_exim_set_product_categories_post($data, $company_id)
{
    fn_seo_update_tree_object($data['product_id'], 'p', [
        'company_id' => $company_id,
        'object_types' => [
            'p'
        ]
    ]);
}

/* /Category hooks */

/* Page hooks */
function fn_seo_pre_get_page_data(&$field_list, &$join, &$condition, $lang_code)
{
    $field_list .= ', ?:seo_names.name as seo_name, ?:seo_names.path as seo_path';

    $join .= db_quote(
        " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:pages.page_id ?p",
        fn_get_seo_join_condition('a', '?:pages.company_id', $lang_code)
    );
}

function fn_seo_get_page_data(&$page_data, &$lang_code)
{
    if (!empty($page_data)) {
        SeoCache::set('a', $page_data['page_id'], $page_data, null, $lang_code);
    }

    if (empty($page_data['seo_name'])) {
        // generate SEO name
        $page_data['seo_name'] = fn_seo_get_name('a', $page_data['page_id'], '', null, $lang_code);
    }

    return true;
}

function fn_seo_get_pages(&$params, &$join, &$condition, &$fields, &$group_by, &$sortings, &$lang_code)
{
    if (isset($params['compact']) && $params['compact'] == 'Y') {
        $condition .= db_quote(' OR (?:seo_names.name LIKE ?s ?p)', '%' . preg_replace('/-[a-zA-Z]{1,3}$/i', '', str_ireplace(SEO_FILENAME_EXTENSION, '', $params['q'])) . '%', fn_get_company_condition('?:pages.company_id'));
    }

    $fields[] = '?:seo_names.name as seo_name';
    $fields[] = '?:seo_names.path as seo_path';

    $join .= db_quote(
        " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:pages.page_id ?p",
        fn_get_seo_join_condition('a', '?:pages.company_id', $lang_code)
    );
}

function fn_seo_post_get_pages(&$pages, $params, $lang_code)
{
    if (empty($params['get_tree']) && $params['get_tree'] == 'plain') {
        $_pages = $pages;
    } else {
        $_pages = fn_multi_level_to_plain($pages, 'subpages');
    }

    foreach ($_pages as $_page) {
        SeoCache::set('a', $_page['page_id'], $_page, isset($_page['company_id']) ? $_page['company_id'] : '', $lang_code);
    }
}

function fn_seo_update_page_post(&$page_data, &$page_id, &$lang_code)
{
    if (Registry::get('runtime.company_id')) {
        $page_data['company_id'] = Registry::get('runtime.company_id');
    }

    fn_seo_update_object($page_data, $page_id, 'a', $lang_code);
}

function fn_seo_delete_page(&$page_id)
{
    return fn_delete_seo_name($page_id, 'a');
}

function fn_seo_update_page_parent_pre($page_id, $new_parent_id)
{
    $page_data = db_get_row("SELECT company_id, id_path FROM ?:pages WHERE page_id = ?i", $page_id);

    Registry::set('runtime.seo._old_page_data', $page_data);
}

function fn_seo_update_page_parent_post($page_id, $new_parent_id)
{
    $old_page_data = Registry::get('runtime.seo._old_page_data');

    return fn_seo_update_tree_object($page_id, 'a', array(
        'company_id' => $old_page_data['company_id'],
        'old_id_path' => $old_page_data['id_path'],
        'object_types' => array('a')
    ));
}
/* /Page hooks */

/* Company hooks */
function fn_seo_get_company_data(&$company_id, &$lang_code, &$extra, &$fields, &$join, &$condition)
{
    $fields[] = '?:seo_names.name as seo_name';
    $fields[] = '?:seo_names.path as seo_path';

    $join .= db_quote(
        " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?i ?p",
        $company_id, fn_get_seo_join_condition('m', 'companies.company_id', $lang_code)
    );
}

function fn_seo_get_company_data_post(&$company_id, &$lang_code, &$extra, &$company_data)
{
    if (!empty($company_data) && empty($company_data['seo_name']) && !empty($company_id)) {
        $company_data['seo_name'] = fn_seo_get_name('m', $company_id, '', null, $lang_code);
    }

    return true;
}

function fn_seo_get_companies(&$params, &$fields, &$sortings, &$condition, &$join, &$auth, &$lang_code)
{
    $fields[] = '?:seo_names.name as seo_name';
    $fields[] = '?:seo_names.path as seo_path';

    $join .= db_quote(
        " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:companies.company_id ?p", fn_get_seo_join_condition('m', '?:companies.company_id', $lang_code)
    );
}

function fn_seo_update_company(&$company_data, &$company_id, &$lang_code)
{
    fn_seo_update_object($company_data, $company_id, 'm', $lang_code);
}

function fn_seo_delete_company(&$company_id)
{
    return fn_delete_seo_name($company_id, 'm');
}

function fn_seo_ult_delete_company(&$company_id)
{
    fn_delete_seo_names($company_id);
}

function fn_seo_check_and_update_product_sharing(&$product_id, &$shared, &$shared_categories_company_ids, &$new_categories_company_ids)
{
    $deleted_company_ids = array_diff($shared_categories_company_ids, $new_categories_company_ids);

    if (!empty($deleted_company_ids)) {
        foreach ($deleted_company_ids as $c_id) {
            fn_delete_seo_name($product_id, 'p', '', $c_id);
            db_query("DELETE FROM ?:seo_redirects WHERE object_id = ?i AND type = 'p' AND company_id = ?i", $product_id, $c_id);
        }
    }
}

/* /Company hooks */

/* Feature hooks */
function fn_seo_update_product_feature_post(&$feature_data, &$feature_id, &$deleted_variants, &$lang_code)
{
    if ($feature_data['feature_type'] == ProductFeatures::EXTENDED && !empty($feature_data['variants'])) {
        if (!empty($feature_data['variants'])) {
            foreach ($feature_data['variants'] as $v) {
                if (!empty($v['variant_id'])) {

                    if (!empty($feature_data['company_id'])) {
                        $v['company_id'] = $feature_data['company_id'];
                    }
                    fn_seo_update_object($v, $v['variant_id'], 'e', $lang_code);
                }
            }
        }

        if (!empty($deleted_variants)) {
            db_query(
                "DELETE FROM ?:seo_names WHERE object_id IN (?n) AND type = ?s AND dispatch = '' ?p",
                $deleted_variants, 'e', fn_get_seo_company_condition('?:seo_names.company_id')
            );
        }
    } elseif (!empty($feature_data['variants']) && is_array($feature_data['variants'])) {
        $object_ids = array();
        foreach ($feature_data['variants'] as $variant) {
            if (!empty($variant['variant_id'])) {
                $object_ids[] = $variant['variant_id'];
            }
        }

        db_query(
            "DELETE FROM ?:seo_names WHERE object_id IN (?n) AND type = ?s AND dispatch = '' ?p",
            $object_ids, 'e', fn_get_seo_company_condition('?:seo_names.company_id')
        );
    }
}

function fn_seo_get_product_feature_variants_post(&$vars, &$params, &$lang_code)
{
    if (!empty($vars)) {

        $feature_ids = is_array($params['feature_id']) ? $params['feature_id'] : array($params['feature_id']);
        $feature_ids = db_get_fields("SELECT feature_id FROM ?:product_features WHERE feature_id IN (?n) AND feature_type = ?s", $feature_ids, ProductFeatures::EXTENDED);

        if (!empty($feature_ids)) {
            foreach ($vars as $k => $variant) {
                if (!in_array($variant['feature_id'], $feature_ids)) {
                    continue;
                }

                if (empty($variant['seo_name']) && !empty($variant['variant_id'])) {
                    $vars[$k]['seo_name'] = fn_seo_get_name('e', $variant['variant_id'], '', null, $lang_code);
                }

                SeoCache::set('e', $variant['variant_id'], $vars[$k], null, $lang_code);
            }
        }
    }

    return true;
}

function fn_seo_get_product_feature_variants(&$fields, &$join, &$condition, &$group_by, &$sorting, &$lang_code)
{
    $fields[] = '?:seo_names.name as seo_name';
    $fields[] = '?:seo_names.path as seo_path';
    $join .= db_quote(
        " LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:product_feature_variants.variant_id "
        . "AND ?:seo_names.type = 'e' AND ?:seo_names.dispatch = '' AND ?:seo_names.lang_code = ?s ?p",
        fn_get_corrected_seo_lang_code($lang_code), fn_get_seo_company_condition('?:seo_names.company_id')
    );
}

function fn_seo_delete_product_feature_variants_post($feature_id, $variant_ids)
{
    db_query(
        "DELETE FROM ?:seo_names WHERE object_id IN (?n) AND type = ?s AND dispatch = '' ?p",
        $variant_ids, 'e', fn_get_seo_company_condition('?:seo_names.company_id')
    );
}
/* /Feature hooks */

/* Language hooks */
function fn_seo_delete_languages_post(&$lang_ids, &$lang_codes)
{
    $condition = fn_get_seo_company_condition('?:seo_names.company_id');

    db_query("DELETE FROM ?:seo_names WHERE lang_code IN (?a) ?p", $lang_codes, $condition);
}

function fn_seo_update_language_post(&$language_data, &$lang_id, &$action)
{
    if ($action == 'update') {
        return false;
    }

    $condition = fn_get_seo_company_condition('?:seo_names.company_id');

    if (!empty($language_data['lang_code'])) {
        $is_exists = db_get_field("SELECT COUNT(*) FROM ?:seo_names WHERE lang_code = ?s ?p", $language_data['lang_code'], $condition);
        if (empty($is_exists)) {
            $global_total = db_get_fields("SELECT dispatch FROM ?:seo_names WHERE object_id = '0' AND type = 's' ?p GROUP BY dispatch", $condition);
            foreach ($global_total as $disp) {
                fn_create_seo_name(0, 's', str_replace('.', '-', $disp), 0, $disp, '', $language_data['lang_code']);
            }
        }
    }
}
/* /Language hooks */


function fn_seo_link_test()
{
    $options = array(
        'seo_product_type' => array('product_file', 'product_file_nohtml', 'product_category', 'product_category_nohtml'),
        'seo_category_type' => array('file', 'category', 'root_category'),
        'seo_page_type' => array('file', 'page', 'root_page'),
        'seo_other_type' => array('file', 'directory')
    );

    $urls = array(
        'seo_product_type' => 'products.view?product_id=12',
        'seo_category_type' => 'categories.view?category_id=168&page=2',
        'seo_page_type' => 'pages.view?page_id=4&page=1',
        'seo_other_type' => 'profiles.update'
    );

    foreach ($options as $option_name => $option_values) {

        $url = $urls[$option_name];
        $result = array();
        foreach ($option_values as $value) {
            Registry::set('addons.seo.' . $option_name, $value);
            $result[$value] = fn_url($url);
        }

        fn_print_r($result);
    }
}

/**
 * Checks whether object related to SEO-name exists at database, using functions specified at SEO objects schema.
 *
 * @param int    $object_id   Object ID
 * @param string $object_type Object type (array key at SEO objects schema)
 *
 * @return bool|null Whether given object exists or null if no checking function is specified at schema.
 */
function fn_check_seo_object_exists($object_id, $object_type, $company_id)
{
    $schema = fn_get_seo_vars();

    if (!empty($schema[$object_type])) {

        if (isset($schema[$object_type]['exist_function'])) {
            return $schema[$object_type]['exist_function']($object_id, $company_id);
        }
    }

    return null;
}

/**
 * Adds pagination parameter to URL
 *
 * @param int $page Page number
 * @return string Paginated URL
 */
function fn_seo_canonical_url_page($page = 1)
{
    if ($page > 1) {
        return '&page=' . $page;
    }
    return '';
}

/**
 * Generates SEO Canonical, Prev, Next links
 *
 * @param string $base_url URL used a template
 * @param array $search Search parameters from [fn_get_]
 * @return array SEO links (
 *     'current' Canonical URL of the page
 *     'prev'    Link to previous page
 *     'next'    Link to next page
 * )
 */
function fn_seo_get_canonical_links($base_url, $search)
{
    $seo_canonical = array();

    if (is_array($search)) {
        $default_search = array(
            'total_items' => 0,
            'items_per_page' => 0,
            'page' => 1
        );
        $search = array_merge($default_search, $search);

        if ($search['total_items'] > $search['items_per_page']) {
            $pagination = fn_generate_pagination($search);

            if (!empty($pagination['prev_page'])) {
                $seo_canonical['prev'] = fn_url($base_url . fn_seo_canonical_url_page($pagination['prev_page']));
            }
            if (!empty($pagination['next_page'])) {
                $seo_canonical['next'] = fn_url($base_url . fn_seo_canonical_url_page($pagination['next_page']));
            }
        }

    }

    $current_page = isset($search['page']) ? fn_seo_canonical_url_page($search['page']) : '';
    Registry::set('runtime.seo.is_creating_canonical_url', true, true);
    $seo_canonical['current'] = fn_url($base_url . $current_page);
    Registry::del('runtime.seo.is_creating_canonical_url');

    return $seo_canonical;
}

/**
 * Removes query parameters from current URL
 *
 * @param string $param_1 Query parameter name to be removed
 * ...
 * @param string $param_n Query parameter name to be removed
 * @return string Current URL with specified parameters removed
 */
function fn_seo_filter_current_url()
{
    $arguments = array_merge(array(Registry::get('config.current_url')), func_get_args());
    return call_user_func_array('fn_query_remove', $arguments);
}

/**
 * Adds canonical url, prev and next meta-links and alternative hreflangs
 */
function fn_seo_dispatch_before_display()
{
    if (AREA != 'C') {
        return;
    }

    $seo_canonical = array();

    $schema = fn_get_schema('seo', 'canonical_urls');
    $runtime = Registry::get('runtime');
    $controller = $runtime['controller'];
    $mode = $runtime['mode'];
    $lang_parameter = 'sl';
    $default_language = Registry::get('settings.Appearance.frontend_default_language');

    if (isset($schema[$controller][$mode])) {
        $rule = $schema[$controller][$mode];
        $base_url = '';
        if (is_array($rule['base_url'])) {
            foreach ($rule['base_url'] as $func => $arg) {
                $base_url = call_user_func_array($func, $arg);
            }
        } else {
            $base_url = $rule['base_url'];
        }
        $is_valid = !empty($base_url);
        if (isset($rule['request_handlers'])) {
            foreach ($rule['request_handlers'] as $param => $handler) {
                if (isset($_REQUEST[$param])) {
                    if (is_array($handler)) {
                        foreach ($handler as $func => $args) {
                            $is_valid = call_user_func_array($func, $args);
                        }
                    } else {
                        $is_valid = $handler? !empty($_REQUEST[$param]): empty($_REQUEST[$param]);
                    }
                    $base_url = str_replace("[{$param}]", $_REQUEST[$param], $base_url);
                } else {
                    $is_valid = false;
                    break;
                }
            }
        }
        if ($is_valid) {
            if (isset($rule['search'])) {
                if (is_callable($rule['search'])) {
                    $search = call_user_func($rule['search']);
                } elseif (is_array($rule['search'])) {
                    $search = $rule['search'];
                } else {
                    $search = Tygh::$app['view']->getTemplateVars('search');
                }
            } else {
                $search = array();
            }

            if (!empty($_REQUEST[$lang_parameter]) && $_REQUEST[$lang_parameter] != $default_language) {
                $base_url = fn_link_attach($base_url, $lang_parameter . '=' . $_REQUEST[$lang_parameter]);
            }

            $seo_canonical = fn_seo_get_canonical_links($base_url, $search);
        }
    }

    $seo_alt_hreflangs_list = array();
    $languages = Registry::get('languages');

    if (count($languages) > 1) {
        /** @var \Tygh\Tools\Url $url */
        $url = new Url(Registry::get('config.current_url'));
        $query_params = $url->getQueryParams();

        foreach ($languages as $language) {
            $query_params[$lang_parameter] = $language['lang_code'];
            $href = $url->setQueryParams($query_params)->build();
            $href_lang = array(
                'name'      => $language['name'],
                'direction' => $language['direction'],
                'href'      => fn_url($href),
            );

            if ($language['lang_code'] == $default_language) {
                $href_lang['href'] = fn_query_remove($href_lang['href'], $lang_parameter);
                $seo_alt_hreflangs_list['x-default'] = $href_lang;
            }

            $seo_alt_hreflangs_list[$language['lang_code']] = $href_lang;
        }
    }

    Tygh::$app['view']->assign('seo_canonical', $seo_canonical);
    Tygh::$app['view']->assign('seo_alt_hreflangs_list', $seo_alt_hreflangs_list);
}

/** Full-page cache add-on hooks */

/**
 * Hook is used to replace non-cached dispatch rules with non-cached path rules.
 * Paths will be generated using corresponding SEO names.
 *
 * @param \Tygh\Addons\FullPageCache\Varnish\VclGenerator $vcl_generator VCL generator instance
 */
function fn_seo_varnish_generate_vcl_pre($vcl_generator)
{
    $dispatch_to_find_list = array();
    $controllers_to_find_condition = array('0');

    foreach ($vcl_generator->getNonCachedDispatches() as $dispatch) {
        if (strpos($dispatch, '.*') !== false) {
            list($controller, $asterisk) = explode('.', $dispatch);

            $controllers_to_find_condition[] = db_quote('OR `dispatch` LIKE ?l', $controller . '.%');
        } else {
            $dispatch_to_find_list[] = $dispatch;
        }
    }

    $seo_rules_paths = db_get_fields(
        "SELECT `name` FROM ?:seo_names"
        . " WHERE `type` = 's' AND (`dispatch` IN (?a) OR (?p)) ?p",
        empty($dispatch_to_find_list) ? array('') : $dispatch_to_find_list,
        implode(' ', $controllers_to_find_condition),
        fn_get_seo_company_condition('?:seo_names.company_id', 's', $vcl_generator->getStorefront()->id)
    );

    $seo_rules_paths = array_map(function ($path) {
        return trim($path, '\\/') . '/';
    }, $seo_rules_paths);


    // Add paths generated using SEO-names
    $vcl_generator->addNonCachedPaths($seo_rules_paths);
}

/**
 * Extracts brand feature from current product data
 *
 * @param  array $product_features Array with product features
 * @return string with product brand if success, false otherwise
 */
function fn_seo_extract_feature_brand($product_features)
{
    foreach ($product_features as $feature_id => $feature_data) {
        if ($feature_data['feature_type'] === ProductFeatures::EXTENDED) {
            return $feature_data['variant'];
        }
    }

    return false;
}

/** /Full-page cache add-on hooks */
