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
use Tygh\Enum\ProductTracking;
use Tygh\Registry;
use Tygh\Tools\SecurityHelper;
use Tygh\Languages\Languages;
use Tygh\Addons\ProductVariations\ServiceProvider as ProductVariationsServiceProvider;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

/**
 * Update product chain
 *
 * @param int $item_id Product chain identifier
 * @param int $product_id Product identifier
 * @param array $item_data Product chain data
 * @param array $auth Array of user authentication data
 * @param string $lang_code 2-letter language code (e.g. 'en', 'ru', etc.)
 *
 * @return bool|int False if chain update failed, chain identifier otherwise
 */
function fn_buy_together_update_chain($item_id, $product_id, $item_data, $auth, $lang_code = CART_LANGUAGE)
{
    /**
     * Modify product chain update parameters
     *
     * @param int $item_id Product chain identifier
     * @param int $product_id Product identifier
     * @param array $item_data Product chain data
     * @param array $auth Array of user authentication data
     * @param string $lang_code 2-letter language code (e.g. 'en', 'ru', etc.)
     */
    fn_set_hook('buy_together_update_chain_pre', $item_id, $product_id, $item_data, $auth, $lang_code);

    if (empty($product_id) || $product_id == 0) {
        return false;
    }

    SecurityHelper::sanitizeObjectData('buy_together_chain', $item_data);

    $show_notice = true;
    $item_data['product_id'] = $product_id;

    if (!empty($item_data['products'])) {
        foreach ($item_data['products'] as $key => $product) {
            // Delete products with empty amount
            if (empty($product['amount']) || intval($product['amount']) == 0) {
                unset($item_data['products'][$key]);
                continue;
            }

            $item_data['products'][$key]['modifier'] = floatval($item_data['products'][$key]['modifier']);

            $is_restricted = false;

            fn_set_hook('buy_together_restricted_product', $product['product_id'], $auth, $is_restricted, $show_notice);

            if ($is_restricted) {
                unset($item_data['products'][$key]);
            }
        }

        $item_data['products'] = serialize($item_data['products']);

    } else {
        $item_data['products'] = array();
    }

    $date_from = !empty($item_data['date_from']) ? fn_parse_date($item_data['date_from']) : 0;
    $date_to = !empty($item_data['date_to']) ? fn_parse_date($item_data['date_to']) : 0;

    if ($date_to && $date_to < $date_from) { // Protection from incorrect date range.
        $temp_value = $date_from;
        $date_from = $date_to;
        $date_to = $temp_value;
    }

    $item_data['date_from'] = $date_from;
    $item_data['date_to'] = $date_to;

    if (empty($item_id) || $item_id == 0) {
        //Create a new chain
        $item_id = db_query("INSERT INTO ?:buy_together ?e", $item_data);

        if (empty($item_id)) {
            return false;
        }

        $_data = array();
        $_data['chain_id'] = $item_id;
        $_data['name'] = !empty($item_data['name']) ? $item_data['name'] : '';
        $_data['description'] = !empty($item_data['description']) ? $item_data['description'] : '';

        foreach (Languages::getAll() as $_data['lang_code'] => $v) {
            db_query("INSERT INTO ?:buy_together_descriptions ?e", $_data);
        }

        $create = true;
    } else {
        //Update already existing chain
        $_data = array();
        $_data['chain_id'] = $item_id;
        $_data['name'] = !empty($item_data['name']) ? $item_data['name'] : '';
        $_data['description'] = !empty($item_data['description']) ? $item_data['description'] : '';

        db_query("UPDATE ?:buy_together SET ?u WHERE chain_id = ?i", $item_data, $item_id);
        db_query("UPDATE ?:buy_together_descriptions SET ?u WHERE chain_id = ?i AND lang_code = ?s", $_data, $item_id, $lang_code);

        $create = false;
    }

    /**
     * Modify product chain update results
     *
     * @param int $item_id Product chain identifier
     * @param int $product_id Product identifier
     * @param array $item_data Product chain data
     * @param array $auth Array of user authentication data
     * @param string $lang_code 2-letter language code (e.g. 'en', 'ru', etc.)
     */
    fn_set_hook('buy_together_update_chain_post', $item_id, $product_id, $item_data, $auth, $lang_code, $create);

    return $item_id;
}

/**
 * Get products chains
 *
 * @param array $params Parameters for the function
 * @param array $auth Array of user authentication data
 * @param string $lang_code 2-letter language code (e.g. 'en', 'ru', etc.)
 *
 * @return array Chains of products
 */
function fn_buy_together_get_chains($params = array(), $auth = array(), $lang_code = CART_LANGUAGE)
{
    /**
     * Modify product chains get parameters
     *
     * @param array $params Parameters for the function
     * @param array $auth Array of user authentication data
     * @param string $lang_code 2-letter language code (e.g. 'en', 'ru', etc.)
     */
    fn_set_hook('buy_together_get_chains_pre', $params, $auth, $lang_code);

    $fields = array(
        'items.chain_id',
        'items.product_id',
        'items.products',
        'items.modifier',
        'items.modifier_type',
        'items.date_from',
        'items.date_to',
        'items.display_in_promotions',
        'items.status',
        'descr.name',
        'descr.description',
    );

    if (fn_allowed_for('ULTIMATE')) {
        $fields[] = 'p.company_id';
    }

    $conditions = array();

    $joins = array();

    $joins[] = db_quote("LEFT JOIN ?:products AS p ON p.product_id = items.product_id");
    $joins[] = db_quote("LEFT JOIN ?:buy_together_descriptions AS descr ON items.chain_id = descr.chain_id AND descr.lang_code = ?s", $lang_code);



    if (!empty($params['product_id'])) {
        $conditions['product_id'] = db_quote('items.product_id = ?i', $params['product_id']);
    }

    if (!empty($params['chain_id'])) {
        $conditions['chain_id'] = db_quote('items.chain_id = ?i', $params['chain_id']);
    }

    if (!empty($params['status'])) {
        $conditions['status'] = db_quote('items.status = ?s', $params['status']);
    }

    if (!empty($params['date']) && $params['date']) {
        $date = mktime(0, 0, 0);
        $date_periods_arr = array(
            db_quote('(items.date_from <= ?i AND items.date_to >= ?i)', $date, $date),
            db_quote('(items.date_from = ?i AND items.date_to >= ?i)', 0, $date),
            db_quote('(items.date_from <= ?i AND items.date_to = ?i)', $date, 0),
            db_quote('(items.date_from = ?i AND items.date_to = ?i)', 0, 0)
        );
        $conditions['date'] = '(' . implode(' OR ', $date_periods_arr) . ')';
    }

    if (!empty($params['promotions']) && $params['promotions']) {
        $conditions['promotions'] = db_quote('items.display_in_promotions = ?s', 'Y');
    }

    /**
     * Change select condition (fields, conditions, joins) before selecting payment method data
     *
     * @param array $params Parameters for the function
     * @param array $auth Array of user authentication data
     * @param string $lang_code 2-letter language code (e.g. 'en', 'ru', etc.)
     * @param array $fields Array of fields to be selected
     * @param array $conditions Array of complete condition expressions to be applied to the end of an SQL-query
     * @param array $joins List of strings with the complete JOIN information (JOIN type, tables and fields) for an SQL-query
     *
     */
    fn_set_hook('buy_together_get_chains', $params, $auth, $lang_code, $fields, $conditions, $joins);

    if (!empty($conditions)) {
        $condition = 'WHERE ' . implode(' AND ', $conditions);
    } else {
        $condition = '';
    }

    $fields = implode(', ', $fields);
    $joins = implode(' ', $joins);

    $chains = db_get_array("SELECT {$fields} FROM ?:buy_together AS items {$joins} {$condition}");

    if (!empty($chains)) {
        $selected_options = isset($params['selected_options']) ? $params['selected_options'] : array();
        $product_ids = array();
        $products = array();

        if (!empty($params['full_info'])) {
            foreach ($chains as $chain) {
                $product_ids[$chain['product_id']] = $chain['product_id'];
                $chain_products = unserialize($chain['products']);

                foreach ($chain_products as $product) {
                    $product_ids[$product['product_id']] = $product['product_id'];
                }
            }

            list($products) = fn_get_products(array(
                'pid' => $product_ids
            ));
        }

        foreach ($chains as $key => &$chain) {
            $chain['products'] = unserialize($chain['products']);

            if (!empty($params['full_info'])) {
                $is_valid = true;

                if (isset($auth['area']) && $auth['area'] == 'C' && empty($chain['products'])) {
                    unset($chains[$key]);
                    continue;
                }

                if (!isset($products[$chain['product_id']])) {
                    unset($chains[$key]);
                    continue;
                }

                $chain['products_info'] = $chain['products'];
                $main_product = $products[$chain['product_id']];
                $option_key = $main_product['product_id'] . '_' . $chain['chain_id'];

                $main_product['selected_options'] = isset($selected_options[$option_key]['selected_options'])
                    ? $selected_options[$option_key]['selected_options']
                    : '';

                $main_product['changed_option'] = isset($selected_options[$option_key]['changed_option'])
                    ? $params['selected_options'][$option_key]['changed_option']
                    : '';

                fn_gather_additional_products_data($main_product, array(
                    'get_icon' => true,
                    'get_detailed' => true,
                    'get_additional' => false,
                    'get_options' => true,
                    'get_discounts' => true
                ));

                $chain['product_name'] = $main_product['product'];
                $chain['chain_amount'] = ($main_product['min_qty'] > 0) ? $main_product['min_qty'] : 1;
                $chain['min_qty'] = $main_product['min_qty'] = 1;
                $chain['price'] = $main_product['price'];
                $chain['list_price'] = $main_product['list_price'];
                $chain['default_options'] = fn_get_default_product_options($main_product['product_id']);
                $chain['product_options'] = $main_product['product_options'];
                $chain['options_type'] = $main_product['options_type'];
                $chain['exceptions_type'] = $main_product['exceptions_type'];
                $chain['options_update'] = isset($main_product['options_update']) ? $main_product['options_update'] : false;
                list($chain['discount'], $chain['discounted_price']) = fn_buy_together_calculate_discount($main_product['price'], $chain['modifier'], $chain['modifier_type']);

                if (isset($main_product['main_pair'])) {
                    $chain['main_pair'] = $main_product['main_pair'];
                }

                $total_price = $main_product['price'];
                $chain_price = $chain['discounted_price'];

                $chain['product_data'] = $main_product;

                foreach ($chain['products'] as $hash => &$chain_product) {
                    if (empty($product['product_id'])) {
                        unset($chains[$key]['products'][$hash]);
                        unset($chains[$key]['products_info'][$hash]);
                        continue;
                    }

                    if (!isset($products[$chain_product['product_id']])) {
                        if (isset($auth['area']) && $auth['area'] == 'C') {
                            $is_valid = false;
                            break;
                        }

                        unset($chains[$key]['products'][$hash]);
                        unset($chains[$key]['products_info'][$hash]);
                        continue;
                    }

                    $product = $products[$chain_product['product_id']];

                    if (!empty($chain_product['product_options'])) {
                        $product['selected_options'] = $chain_product['product_options'];
                    } else {
                        $product['selected_options'] = isset($selected_options[$product['product_id']]['selected_options'])
                            ? $selected_options[$product['product_id']]['selected_options']
                            : '';

                        $product['changed_option'] = isset($selected_options[$product['product_id']]['changed_option'])
                            ? $selected_options[$product['product_id']]['changed_option']
                            : '';
                    }

                    fn_gather_additional_products_data($product, array(
                        'get_icon' => true,
                        'get_detailed' => true,
                        'get_additional' => false,
                        'get_options' => true,
                        'get_discounts' => true
                    ));

                    if (!empty($chain_product['product_options'])) {
                        $product['amount'] = isset($product['inventory_amount']) ? $product['inventory_amount'] : $product['amount'];
                    } else {
                        $product['amount'] = fn_get_product_amount($chain_product['product_id']);
                    }

                    if (AREA == 'C'
                        && ($product['status'] == 'H'
                            || (
                                isset($product['tracking'])
                                && $product['tracking'] != ProductTracking::DO_NOT_TRACK
                                && Registry::get('settings.General.show_out_of_stock_products') == 'N'
                                && empty($product['amount'])
                            )
                        )
                    ) {
                        $is_valid = false;
                        break;
                    }

                    $product['min_qty'] = ($product['min_qty'] > 0) ? $product['min_qty'] : 1;

                    $chain_product['product_name'] = $product['product'];
                    $chain_product['min_qty'] = $product['min_qty'];
                    $chain_product['price'] = empty($chain_product['price']) ? $product['price'] : $chain_product['price'];
                    $chain_product['list_price'] = $product['list_price'];

                    if (isset($product['main_pair'])) {
                        $chain_product['main_pair'] = $product['main_pair'];
                    }

                    list($chain_product['discount'], $chain_product['discounted_price']) = fn_buy_together_calculate_discount(
                        $product['price'],
                        empty($chain_product['modifier']) ? 0 : $chain_product['modifier'],
                        empty($chain_product['modifier_type']) ? 'to_fixed' : $chain_product['modifier_type']
                    );

                    $chain_product['options_type'] = $product['options_type'];
                    $chain_product['exceptions_type'] = $product['exceptions_type'];
                    $chain_product['options_update'] = isset($product['options_update']) ? $product['options_update'] : false;

                    $total_price += $product['price'] * $chain_product['amount'];
                    $chain_price += $chain_product['discounted_price'] * $chain_product['amount'];

                    if (!empty($chain_product['product_options'])) {
                        $chain_product['product_options_short'] = $chain_product['product_options'];

                        $options = fn_get_selected_product_options_info($chain_product['product_options'], DESCR_SL);
                        $chain_product['product_options'] = $options;
                    } elseif (!empty($product['product_options'])) {
                        $chain_product['aoc'] = true; // Allow any option combinations
                        $chain_product['options'] = $product['product_options'];
                    }

                    $chain_product['product_data'] = $product;

                    $chains[$key]['products_info'][$hash]['price'] = $chain_product['price'];
                    $chains[$key]['products_info'][$hash]['discount'] = $chain_product['discount'];
                    $chains[$key]['products_info'][$hash]['discounted_price'] = $chain_product['discounted_price'];
                }

                if (!$is_valid) {
                    unset($chains[$key]);
                    continue;
                }

                $chain['total_price'] = $total_price;
                $chain['chain_price'] = $chain_price;

                unset($chain_product);
            }

            if (!empty($params['simple'])) {
                $simple_chain = $chain;
                break;
            }
        }

        unset($chain);
    }

    if (isset($simple_chain)){
        $chains = $simple_chain;
    }

    /**
     * Gets function result along with parameters and query information.
     *
     * @param array $params Parameters for the function
     * @param array $auth Array of user authentication data
     * @param string $lang_code 2-letter language code (e.g. 'en', 'ru', etc.)
     * @param mixed $chains One chain or array of chains, depending on 'simple' parameter.
     * @param array $fields Array of fields to be selected
     * @param array $conditions Array of complete condition expressions to be applied to the end of an SQL-query
     * @param array $joins List of strings with the complete JOIN information (JOIN type, tables and fields) for an SQL-query
     */
    fn_set_hook('buy_together_get_chains_post', $params, $auth, $lang_code, $chains, $fields, $conditions, $joins);

    return $chains;
}

function fn_buy_together_delete_chain($chain_id)
{
    $product_id = db_get_field("SELECT product_id FROM ?:buy_together WHERE chain_id = ?i", $chain_id);

    db_query('DELETE FROM ?:buy_together WHERE chain_id = ?i', $chain_id);
    db_query('DELETE FROM ?:buy_together_descriptions WHERE chain_id = ?i', $chain_id);

    fn_set_hook('buy_together_delete_chain_post', $chain_id, $product_id);

    return $product_id;
}

function fn_buy_together_delete_product_pre(&$product_id, &$status)
{
    $chains = db_get_array('SELECT chain_id, product_id, products FROM ?:buy_together WHERE product_id = ?i OR products LIKE ?l', $product_id, '%"' . $product_id . '"%');

    if (!empty($chains)) {
        foreach ($chains as $chain) {
            $delete = false;

            if ($chain['product_id'] == $product_id) {
                    $delete = true;
            }

            if (!$delete) {
                $products = unserialize($chain['products']);
                foreach ($products as $id => $product) {
                    if ($product['product_id'] == $product_id) {
                        $delete = true;

                        break;
                    }
                }
            }

            if ($delete) {
                fn_buy_together_delete_chain($chain['chain_id']);
            }
        }
    }
}

function fn_buy_together_pre_add_to_cart(&$product_data, &$cart, &$auth, &$update)
{
    if ($update == true) {
        foreach ($product_data as $key => $value) {
            if (!empty($cart['products'][$key]['extra']['buy_together'])) {
                $product_data[$key]['extra']['buy_together'] = $cart['products'][$key]['extra']['buy_together'];
                $product_data[$key]['extra']['buy_id'] = $cart['products'][$key]['extra']['buy_id'];
                $product_data[$key]['extra']['chain'] = $cart['products'][$key]['extra']['chain'];
                $product_data[$key]['extra']['min_qty'] = $cart['products'][$key]['extra']['min_qty'];
                $product_data[$key]['extra']['chain_amount'] = $cart['products'][$key]['extra']['chain_amount'];
                $product_data[$key]['original_amount'] = isset($cart['products'][$key]['original_amount']) ? $cart['products'][$key]['original_amount'] : 0;

                if ($value['amount'] < $cart['products'][$key]['extra']['chain_amount']) {
                    $product_data[$key]['amount'] = $cart['products'][$key]['extra']['chain_amount'];
                }

                if (!empty($value['product_options'])) {
                    $product_data[$key]['extra']['product_options'] = $value['product_options'];
                }

                $cart_id = fn_generate_cart_id($value['product_id'], $product_data[$key]['extra'], false);

                foreach ($cart['products'] as $k => $v) {
                    if (isset($v['extra']['parent']['buy_together']) && $v['extra']['parent']['buy_together'] == $key) {
                        if (isset($v['extra']['min_qty'])) {
                            $min_qty = $v['extra']['min_qty'];
                            $product_data[$k]['extra']['min_qty'] = $min_qty;
                        } else {
                            $min_qty = 1;
                        }

                        if (!empty($v['product_options'])) {
                            $product_data[$k]['product_options'] = $v['product_options'];
                        }

                        $product_data[$k]['product_id'] = $v['product_id'];
                        $product_data[$k]['amount'] = $value['amount'] * $min_qty;
                        $product_data[$k]['extra']['parent']['buy_together'] = $cart_id;
                        $product_data[$key]['buy_together'][$k] = $product_data[$k]['amount'];
                        $product_data[$k]['extra']['chain'] = $cart['products'][$k]['extra']['chain'];
                    }
                }
            }
        }

    } else {
        foreach ($product_data as $key => $value) {
            if (!empty($value['chain'])) {
                // Add a new product chain
                $params['status'] = 'A';
                $params['chain_id'] = $value['chain'];
                $params['simple'] = true;
                $params['full_info'] = true;

                $chain = fn_buy_together_get_chains($params, $auth);

                if (!empty($chain)) {
                    $product_data[$key] = array(
                        'product_id' => $chain['product_id'],
                        'product_options' => empty($value['product_options']) ? $chain['default_options'] : $value['product_options'],
                        'amount' => $chain['chain_amount'],
                        'original_amount' => $chain['chain_amount'],
                        'buy_together' => array(),
                        'chain_id' => intval($chain['chain_id']),
                    );

                    $buy_together = array();

                    foreach ($chain['products'] as $hash => $product) {
                        $product_options = '';

                        if (!empty($product['product_options_short'])) {
                            $product_options = $product['product_options_short'];
                        } elseif (isset($product_data[$product['product_id']]['product_options'])) {
                            $product_options = $product_data[$product['product_id']]['product_options'];
                        }

                        $product_id = $product['product_id'];
                        $product['product_id'] = uniqid();

                        $product_data[$chain['product_id'] . '_' . $chain['chain_id']]['buy_together'][$product['product_id']] = $product_options;

                        $product_data[$product['product_id']] = array(
                            'product_id' => $product_id,
                            'product_options' => $product_options,
                            'amount' => $product['amount'] * $product_data[$key]['amount'],
                            'original_amount' => $product['amount'] * $product_data[$key]['amount'],
                        );

                        $product_data[$product['product_id']]['extra'] = empty($product_data[$product_id]['extra']) ? array() : $product_data[$product_id]['extra'];
                        $product_data[$product['product_id']]['extra']['chain']['hash'] = $hash;
                        $product_data[$product['product_id']]['extra']['chain']['chain_id'] = $value['chain'];

                        if (!empty($product['options'])) {
                            foreach ($product['options'] as $option_id => $option) {
                                if ($option['option_type'] == 'F') {
                                    $product_data[$product['product_id']]['product_options'][$option_id] = $option_id;
                                }
                            }
                        }

                        unset($product_data[$product_id]);

                        $buy_together[$product['product_id']] = $product['amount'];
                    }

                    if (!empty($product_data[$key]['buy_together'])) {
                        $product_data[$key]['extra']['buy_together'] = $product_data[$key]['buy_together'];
                        $product_data[$key]['extra']['chain']['chain_id'] = $value['chain'];
                        $product_data[$key]['extra']['min_qty'] = $chain['min_qty'];
                        $product_data[$key]['extra']['chain_amount'] = $chain['chain_amount'];

                        if (!empty($product_data[$key]['product_options'])) {
                            $product_data[$key]['extra']['product_options'] = $product_data[$key]['product_options'];
                        }

                        $cart_id = fn_generate_cart_id($key, $product_data[$key]['extra'], false);

                        foreach ($product_data[$key]['buy_together'] as $_product_id => $_options) {
                            $product_data[$_product_id]['extra']['parent']['buy_together'] = $cart_id;
                            $product_data[$_product_id]['extra']['min_qty'] = $buy_together[$_product_id];
                        }
                    }

                    $product_data[$key]['buy_together'] = $buy_together;
                }

                unset($product_data[$key]['chain'], $product_data[$key]['chain_data']);
            }
        }

        fn_set_hook('buy_together_pre_add_to_cart', $product_data, $cart, $auth, $update);

        // Regenerate cart_id if needed
        foreach ($product_data as $key => $value) {
            if (!empty($value['buy_together'])) {
                $cart_id = fn_generate_cart_id($key, $value['extra'], false);

                foreach ($value['buy_together'] as $_product_id => $_options) {
                    $product_data[$_product_id]['extra']['parent']['buy_together'] = $cart_id;
                }

                $product_data[$key]['extra']['buy_id'] = $cart_id;
            }
        }
    }

    if (AREA != 'A') {
        $product_data = fn_buy_together_check_products_amount($product_data, $cart);
    }
}

function fn_buy_together_add_to_cart(&$cart, $product_id, $cart_id)
{
    if (defined('ORDER_MANAGEMENT')) {
        return;
    }

    $buy_together_cart_id = !empty($cart['products'][$cart_id]['extra']['parent']['buy_together']) ?
        $cart['products'][$cart_id]['extra']['parent']['buy_together']
        : null;
    $already_in_cart = isset($cart['products'][$buy_together_cart_id]);

    if (!$buy_together_cart_id || $already_in_cart) {
        return;
    }

    foreach ($cart['products'] as $_id => $_product) {
        $product_found = !empty($_product['extra']['buy_id'])
            && $buy_together_cart_id == $_product['extra']['buy_id'];

        if ($product_found) {
            return;
        }
    }

    unset($cart['products'][$cart_id]);
    if (!empty($cart['product_groups'])) {
        foreach ($cart['product_groups'] as $key_group => $group) {
            if (isset($group['products'][$cart_id])) {
                unset($cart['product_groups'][$key_group]['products'][$cart_id]);
            }
        }
    }

    fn_set_notification('E', __('error'), __('buy_together_combination_cannot_be_added'));
    $cart['skip_notification'] = true;
}

function fn_buy_together_generate_cart_id(&$_cid, &$extra, &$only_selectable)
{
    // Buy together product
    if (!empty($extra['chain'])) {
        $_cid[] = 'chain_' . $extra['chain']['chain_id'];

    }
    if (!empty($extra['buy_together']) && is_array($extra['buy_together'])) {
        foreach ($extra['buy_together'] as $k => $v) {
            $_cid[] = serialize($v);
        }
    }

    // Product in buy_together
    if (!empty($extra['parent']['buy_together'])) {
        $_cid[] = $extra['parent']['buy_together'];
    }
}

function fn_buy_together_calculate($items, $auth = array())
{
    $total_price = 0;

    $product = fn_get_product_data($items['product_id'], $auth, CART_LANGUAGE, '', true, true, true, true);
    fn_gather_additional_product_data($product, true, true);

    $total_price += $product['price'] * $product['min_qty'];

    foreach ($items['item_data']['products'] as $hash => $product) {
        if (!is_integer($hash)) {
            continue;
        }

        $_product = fn_get_product_data($product['product_id'], $auth, CART_LANGUAGE, '', true, true, true, true);
        fn_gather_additional_product_data($_product, true, true);

        $price = $_product['price'] * $product['amount'];

        if (!empty($product['product_options'])) {
            $options = fn_get_selected_product_options_info($product['product_options'], DESCR_SL);

            if (!empty($options)) {
                foreach ($options as $option) {
                    if ($option['modifier_type'] == 'A') {
                        $price += $option['modifier'] * $product['amount'];
                    } else {
                        $price += ($_product['price'] + $_product['price'] * $option['modifier'] / 100) * $product['amount'];
                    }
                }
            }
        }

        $total_price += $price;
    }

    $discounted_price = $total_price;

    switch ($items['discount_type']) {
        case 'to_fixed':
            $discounted_price = $items['discount_value'];
            $discount = $total_price - $items['discount_value'];
            break;

        case 'by_fixed':
            $discounted_price -= $items['discount_value'];
            $discount = $items['discount_value'];
            break;

        case 'to_percentage':
            $discounted_price = ($discounted_price / 100) * $items['discount_value'];
            $discount = $total_price - ($total_price / 100) * $items['discount_value'];
            break;

        case 'by_percentage':
            $discounted_price = $discounted_price - (($discounted_price / 100) * $items['discount_value']);
            $discount = ($total_price / 100) * $items['discount_value'];
            break;
    }

    if ($discounted_price < 0) {
        $discounted_price = 0;
    }

    if ($discount < 0 || $discount > $total_price) {
        $discount = $total_price;
    }

    return array(fn_format_price($total_price), fn_format_price($discount), fn_format_price($discounted_price));
}

function fn_buy_together_calculate_discount($price, $modifier = 0, $modifier_type = 'to_fixed')
{
    $discount = 0;

    switch ($modifier_type) {
        case 'to_fixed':
            $discount = $price - $modifier;
            break;

        case 'by_fixed':
            $discount = $modifier;
            break;

        case 'to_percentage':
            $discount = $price - ($price / 100) * $modifier;
            break;

        case 'by_percentage':
            $discount = ($price / 100) * $modifier;
            break;
    }

    if ($discount > $price) {
        $discount = $price;
    }

    $discount = fn_format_price($discount);
    $discounted_price = $price - $discount;

    return array($discount, $discounted_price);
}

function fn_buy_together_calculate_cart(&$cart, &$cart_products)
{
    if (isset($cart['products']) && is_array($cart['products'])) {
        foreach ($cart['products'] as $key => $value) {
            if (!empty($value['extra']['buy_together'])) {
                foreach ($cart_products as $k => $v) {
                    if (!empty($cart['products'][$k]['extra']['parent']['buy_together']) && $cart['products'][$k]['extra']['parent']['buy_together'] == $key) {
                        $cart_products[$key]['subtotal'] += $cart_products[$k]['subtotal'];
                        $cart_products[$key]['display_subtotal'] += $cart_products[$k]['display_subtotal'];
                        $cart_products[$key]['original_price'] += $cart_products[$k]['original_price'] * $v['amount'];
                        $cart_products[$key]['price'] += $cart_products[$k]['price'] * $cart['products'][$k]['extra']['min_qty'];
                        $cart_products[$key]['display_price'] += $cart_products[$k]['display_price'] * $cart['products'][$k]['extra']['min_qty'];

                        if (!empty($cart_products[$k]['tax_summary'])) {
                            if (isset($cart_products[$key]['tax_summary'])) {
                                $cart_products[$key]['tax_summary']['included'] += $cart_products[$k]['tax_summary']['included'];
                                $cart_products[$key]['tax_summary']['added'] += $cart_products[$k]['tax_summary']['added'];
                                $cart_products[$key]['tax_summary']['total'] += $cart_products[$k]['tax_summary']['total'];
                            } else {
                                $cart_products[$key]['tax_summary']['included'] = $cart_products[$k]['tax_summary']['included'];
                                $cart_products[$key]['tax_summary']['added'] = $cart_products[$k]['tax_summary']['added'];
                                $cart_products[$key]['tax_summary']['total'] = $cart_products[$k]['tax_summary']['total'];
                            }
                        }

                        if (!empty($cart_products[$k]['discount'])) {
                            $cart_products[$key]['discount'] = (!empty($cart_products[$key]['discount']) ? $cart_products[$key]['discount'] : 0) + $cart_products[$k]['discount'];
                        }

                        if (!empty($cart_products[$k]['tax_value'])) {
                            $cart_products[$key]['tax_value'] = (!empty($cart_products[$key]['tax_value']) ? $cart_products[$key]['tax_value'] : 0) + $cart_products[$k]['tax_value'] * $cart['products'][$k]['extra']['min_qty'];
                        }
                    }
                }
                $cart['products'][$key]['display_price'] = $cart_products[$key]['display_price'];
            }
        }
    }

    /**
     * Additional actions after 'Buy together' combinations' products changes
     *
     * @param array $cart          Array of cart content and user information necessary for purchase
     * @param array $cart_products Array of new data for products information update
     */
    fn_set_hook('buy_together_calculate_cart_post', $cart, $cart_products);
}

function fn_buy_together_delete_cart_product(&$cart, &$cart_id, &$full_erase)
{

    if ($full_erase == false) {
        return false;
    }

    if (!empty($cart['products'][$cart_id]['extra']['buy_together'])) {
        foreach ($cart['products'] as $key => $item) {
            if (!empty($item['extra']['parent']['buy_together']) && $item['extra']['parent']['buy_together'] == $cart_id) {
                unset($cart['products'][$key]);
                foreach ($cart['product_groups'] as $key_group => $group) {
                    if (in_array($key, array_keys($group['products']))) {
                        unset($cart['product_groups'][$key_group]['products'][$key]);
                    }
                }
            }
        }
    }

    return true;
}

function fn_buy_together_check_products_amount(&$product_data, &$cart)
{
    if (!isset($cart['products'])) {
        $cart['products'] = array();
    }

    if (!empty($product_data)) {
        foreach ($product_data as $key => $product) {
            if (!empty($product['buy_together'])) {
                $amount = fn_check_amount_in_stock($product['product_id'], $product['amount'], @$product['product_options'], $key, $is_edp = 'N', $original_amount = 0, $cart);

                if ($amount < $product['amount']) {
                    $extra_amount = intval($amount / $product['extra']['min_qty']);
                    $product_data[$key]['amount'] = $extra_amount * $product['extra']['min_qty'];
                    if (isset($cart['products'][$key])) {
                        $cart['products'][$key]['amount'] = $product_data[$key]['amount'];
                    }

                    foreach ($product['buy_together'] as $hash => $amount) {
                        if (isset($product_data[$hash])) {
                            $product_data[$hash]['amount'] = $extra_amount * $product_data[$hash]['extra']['min_qty'];
                            $product_data[$key]['buy_together'][$hash] = $product_data[$hash]['amount'];

                            if (isset($cart['products'][$hash])) {
                                $cart['products'][$hash]['amount'] = $product_data[$hash]['amount'];
                            }
                        }
                    }
                }

                foreach ($product['buy_together'] as $hash => $amount) {
                    if ($product_data[$hash]['amount'] > 0) {
                        $allowed_amount = fn_check_amount_in_stock($product_data[$hash]['product_id'], $product_data[$hash]['amount'], empty($product_data[$hash]['product_options']) ? array() : $product_data[$hash]['product_options'], $hash, $is_edp = 'N', $original_amount = 0, $cart);

                        if ($allowed_amount < $product_data[$hash]['amount']) {
                            $extra_amount = intval($allowed_amount / $product_data[$hash]['extra']['min_qty']);
                            $product_data[$hash]['amount'] = $extra_amount * $product_data[$hash]['extra']['min_qty'];
                            $product_data[$key]['buy_together'][$hash] = $product_data[$hash]['amount'];
                            $product_data[$key]['amount'] = $extra_amount * $product['extra']['min_qty'];

                            if (isset($cart['products'][$hash])) {
                                $cart['products'][$hash]['amount'] = $product_data[$hash]['amount'];
                            }
                            if (isset($cart['products'][$key])) {
                                $cart['products'][$key]['amount'] = $product_data[$key]['amount'];
                            }

                            foreach ($product['buy_together'] as $_id => $_amount) {
                                if ($_id == $hash) {
                                    continue;
                                }

                                $product_data[$_id]['amount'] = $extra_amount * $product_data[$_id]['extra']['min_qty'];
                                if (isset($cart['products'][$_id])) {
                                    $cart['products'][$_id]['amount'] = $product_data[$_id]['amount'];
                                }
                            }
                        }
                    }
                }

                if ($product_data[$key]['amount'] <= 0) {
                    foreach ($product['buy_together'] as $hash => $amount) {
                        unset($product_data[$hash]);
                    }
                    unset($product_data[$key]);
                    fn_set_notification('E', __('error'), __('buy_together_combination_cannot_be_added'));
                }
            }
        }
    }

    return $product_data;
}

function fn_buy_together_reorder(&$order_info, &$cart)
{
    foreach ($order_info['products'] as $key => $product) {
        if (isset($product['extra']['chain']['chain_id'])) {
            $params = array(
                'chain_id' => $product['extra']['chain']['chain_id'],
                'simple' => true,
            );

            $chain = fn_buy_together_get_chains($params, Tygh::$app['session']['auth']);

            if ($chain['date_to'] < time()) {
                unset($order_info['products'][$key]['extra']['buy_together'], $order_info['products'][$key]['extra']['buy_id'], $order_info['products'][$key]['extra']['chain'], $order_info['products'][$key]['extra']['parent']);
            }
        }
    }
}

/**
 * Checks cart products buy together combination validity
 *
 * @param array $cart Array of the cart contents and user information necessary for purchase
 * @param array $cart_products Array of products in cart
 * @param array $auth Array of user authentication data (e.g. uid, usergroup_ids, etc.)
 * @return bool Cart products buy together combination validity
 */
function fn_buy_together_calculate_cart_items(&$cart, &$cart_products, &$auth)
{
    if (empty($cart['products'])) {
        return true;
    }

    $is_valid = true;
    $check_amount = (Registry::get('settings.General.inventory_tracking') == 'Y' && Registry::get('settings.General.allow_negative_amount') != 'Y') ? true : false;

    foreach ($cart['products'] as $key => $product) {
        if (!empty($product['extra']['buy_together'])) {
            $allowed = true;
            $_products = array();
            $cart['products'][$key]['original_amount'] = $product['amount'];

            // Validate the combination
            $params['chain_id'] = $product['extra']['chain']['chain_id'];
            $params['status'] = 'A';
            $params['full_info'] = true;
            $params['date'] = true;
            $params['simple'] = true;

            $chain = fn_buy_together_get_chains($params, $auth);

            if (empty($chain)) {
                $allowed = false;
            }

            $_product = fn_get_product_data($product['product_id'], $auth, CART_LANGUAGE, '', false, false, false, false);

            if (empty($_product) || ($check_amount && $product['amount'] > $_product['amount'] && $_product['tracking'] != ProductTracking::DO_NOT_TRACK && $_product['out_of_stock_actions'] != OutOfStockActions::BUY_IN_ADVANCE)) {
                $allowed = false;
            }

            foreach ($cart['products'] as $k => $v) {
                if (!empty($v['extra']['parent']['buy_together']) && ($v['extra']['parent']['buy_together'] == $key || (isset($product['extra']['buy_id']) && $product['extra']['buy_id'] == $v['extra']['parent']['buy_together']))) {
                    $_products[] = $k;
                    $cart['products'][$k]['original_amount'] = $v['amount'];

                    if (isset($product['extra']['buy_id']) && $product['extra']['buy_id'] == $v['extra']['parent']['buy_together']) {
                        $v['extra']['parent']['buy_together'] = $cart_products[$k]['extra']['parent']['buy_together'] = $cart['products'][$k]['extra']['parent']['buy_together'] = $key;
                    }

                    if ($allowed) {
                        $_product = fn_get_product_data($v['product_id'], $auth, CART_LANGUAGE, '', false, false, false, false);

                        if (empty($_product) || ($check_amount && $v['amount'] > $_product['amount']) && !defined('ORDER_MANAGEMENT') && $_product['tracking'] != ProductTracking::DO_NOT_TRACK && $_product['out_of_stock_actions'] != OutOfStockActions::BUY_IN_ADVANCE) {
                            fn_set_notification('E', __('notice'), __('buy_together_product_was_removed', array(
                                '[product]' => $_product['product'],
                                '[amount]' => $v['amount']
                            )));

                            $allowed = false;
                        }

                        if (AREA != 'A' && !defined('ORDER_MANAGEMENT')) {
                            if (isset($chain['products'][$v['extra']['chain']['hash']]['discounted_price'])) {
                                $discounted_price = $cart_products[$k]['price'] - $chain['products'][$v['extra']['chain']['hash']]['discount'];
                                $discounted_price = $discounted_price < 0 ? 0 : $discounted_price;

                                $cart_products[$k]['price'] = $cart_products[$k]['base_price'] = $discounted_price;
                                $cart['subtotal'] -= $chain['products'][$v['extra']['chain']['hash']]['discount'] * $cart_products[$k]['amount'];
                            }
                            $cart_products[$k]['price'] = ($cart_products[$k]['price'] < 0) ? 0 : $cart_products[$k]['price'];
                            $cart_products[$k]['base_price'] = ($cart_products[$k]['base_price'] < 0) ? 0 : $cart_products[$k]['base_price'];
                            $cart_products[$k]['original_price'] = $cart_products[$k]['price'];
                            $cart_products[$k]['subtotal'] = $cart_products[$k]['price'] * $cart_products[$k]['amount'];

                            if (Registry::get('runtime.mode') == 'place_order') {
                                $cart_products[$k]['discount'] = 0;
                                $cart_products[$k]['base_price'] = $cart_products[$k]['price'] - $cart_products[$k]['modifiers_price'];
                            }
                        }

                    }
                }

                if (AREA != 'A' && Registry::get('runtime.mode') == 'place_order') {
                    $cart_products[$key]['base_price'] = $cart_products[$key]['price'] - $cart_products[$key]['modifiers_price'];
                }

            }

            if (AREA != 'A' && !defined('ORDER_MANAGEMENT')) {

                if (!$allowed || (count($_products) != count($product['extra']['buy_together']))) {
                    $_products[] = $key;
                    $cart['amount'] -= $product['amount'];

                    foreach ($_products as $c_key) {
                        unset($cart['products'][$c_key]);
                        unset($cart_products[$c_key]);
                    }

                    $is_valid = false;
                } else {
                    $cart_products[$key]['price'] -= empty($chain['discount']) ? 0 : $chain['discount'];

                    if ($cart_products[$key]['price'] < 0) {
                        $cart_products[$key]['price'] = 0;
                    }

                    $cart_products[$key]['base_price'] -= $chain['discount'];
                    $cart_products[$key]['base_price'] = ($cart_products[$key]['base_price'] < 0) ? 0 : $cart_products[$key]['base_price'];

                    $cart_products[$key]['original_price'] = $cart_products[$key]['price'];
                    $cart_products[$key]['subtotal'] = $cart_products[$key]['price'] * $cart_products[$key]['amount'];
                    $cart['subtotal'] -= $chain['discount'] * $cart_products[$key]['amount'];

                    if (Registry::get('runtime.mode') == 'place_order') {
                        $cart_products[$key]['discount'] = 0;
                    }
                }

            }
        }
    }

    if (!$is_valid) {
        fn_set_notification('E', __('error'), __('buy_together_combination_cannot_be_added'));
        $cart['skip_notification'] = true;
    }

    return $is_valid;
}

/**
 * Add buy together connections to products
 *
 * @param array $cart Array of cart content and user information necessary for purchase
 * @param array $product_data Array of new products data
 * @param array $auth Array of user authentication data (e.g. uid, usergroup_ids, etc.)
 * @return boolean Always true
 */
function fn_buy_together_update_cart_products_pre(&$cart, &$product_data, &$auth)
{
    if (!empty($cart['products'])) {
        foreach ($cart['products'] as $id => $product) {
            if (!empty($product['extra']['buy_together'])) {
                $is_valid = true;
                $_ids = array();

                if (isset($product_data[$id])) {
                    $allowed_amount = fn_check_amount_in_stock($product['product_id'], $product_data[$id]['amount'], empty($product_data[$id]['product_options']) ? array() : $product_data[$id]['product_options'], $id, $is_edp = 'N', $product['amount'], $cart);

                    if ($allowed_amount != $product_data[$id]['amount']) {
                        $is_valid = false;
                    }

                    $_ids[] = $id;
                }

                foreach ($cart['products'] as $aux_id => $aux_product) {
                    if (isset($product_data[$aux_id]) && isset($aux_product['extra']['parent']['buy_together']) && $aux_product['extra']['parent']['buy_together'] == $id) {
                        if ($is_valid) {
                            $amount = $aux_product['extra']['min_qty'] * $product_data[$id]['amount'];
                            $allowed_amount = fn_check_amount_in_stock($aux_product['product_id'], $amount, empty($product_data[$aux_id]['product_options']) ? array() : $product_data[$aux_id]['product_options'], $aux_id, $is_edp = 'N', $aux_product['amount'], $cart);

                            if ($allowed_amount != $amount) {
                                $is_valid = false;
                            } else {
                                $product_data[$aux_id]['amount'] = $amount;
                            }
                        }

                        $_ids[] = $id;
                    }
                }

                if (!$is_valid) {
                    foreach ($_ids as $id) {
                        unset($product_data[$id]);
                    }
                }
            }
        }
    }

    return true;
}

/**
 * Update buy together products
 *
 * @param array $cart Array of cart content and user information necessary for purchase
 * @param array $product_data Array of new products data
 * @param array $auth Array of user authentication data (e.g. uid, usergroup_ids, etc.)
 * @return boolean Always true
 */
function fn_buy_together_update_cart_products_post(&$cart, &$product_data, &$auth)
{
    if (!empty($cart['products'])) {
        foreach ($cart['products'] as $_id => $product) {
            if (!empty($product['extra']['buy_together']) && !empty($product['prev_cart_id']) && $product['prev_cart_id'] != $_id) {
                foreach ($cart['products'] as $aux_id => $aux_product) {
                    if (!empty($aux_product['extra']['parent']['buy_together']) && $aux_product['extra']['parent']['buy_together'] == $product['prev_cart_id']) {
                        $cart['products'][$aux_id]['extra']['parent']['buy_together'] = $_id;
                        $cart['products'][$aux_id]['update_c_id'] = true;
                    }
                }
            }
        }

        foreach ($cart['products'] as $upd_id => $upd_product) {
            if (!empty($upd_product['update_c_id']) && $upd_product['update_c_id'] == true) {
                $new_id = fn_generate_cart_id($upd_product['product_id'], $upd_product['extra'], false);

                if (!isset($cart['products'][$new_id])) {
                    unset($upd_product['update_c_id']);
                    $cart['products'][$new_id] = $upd_product;
                    unset($cart['products'][$upd_id]);
                    foreach ($cart['product_groups'] as $key_group => $group) {
                        if (in_array($upd_id, array_keys($group['products']))) {
                            unset($cart['product_groups'][$key_group]['products'][$upd_id]);
                            $cart['product_groups'][$key_group]['products'][$new_id] = $upd_product;
                        }
                    }

                    // update taxes
                    fn_update_stored_cart_taxes($cart, $upd_id, $new_id, false);
                }
            }
        }
    }

    return true;
}

/**
 * Hook handler after initializing product tabs
 * Sets product chains data to render in a tab
 */
function fn_buy_together_init_product_tabs_post($product, $tabs)
{
    if (!empty($product['product_id'])) {
        $is_restricted = false;
        $show_notices = false;
        $auth = Tygh::$app['session']['auth'];

        fn_set_hook('buy_together_restricted_product', $product['product_id'], $auth, $is_restricted, $show_notices);

        if (!$is_restricted) {
            $params['product_id'] = $product['product_id'];
            $params['status'] = 'A';
            $params['full_info'] = true;
            $params['date'] = true;

            $chains = fn_buy_together_get_chains($params, $auth);

            Tygh::$app['view']->assign('chains', $chains);
        }
    }
}

function fn_product_variations_buy_together_update_chain_post($item_id, $product_id, $item_data, $auth, $lang_code, $create)
{
    $sync_service = ProductVariationsServiceProvider::getSyncService();

    $sync_service->onTableChanged('buy_together', $product_id, ['chain_id' => $item_id]);

    if ($create) {
        $sync_service->onTableChanged('buy_together_descriptions', $product_id, ['chain_id' => $item_id, 'lang_code' => array_keys(Languages::getAll())]);
    } else {
        $sync_service->onTableChanged('buy_together_descriptions', $product_id, ['chain_id' => $item_id, 'lang_code' => $lang_code]);
    }
}

function fn_product_variations_buy_together_delete_chain_post($item_id, $product_id)
{
    $sync_service = ProductVariationsServiceProvider::getSyncService();

    $sync_service->onTableChanged('buy_together', $product_id, ['chain_id' => $item_id]);
    $sync_service->onTableChanged('buy_together_descriptions', $product_id, ['chain_id' => $item_id, 'lang_code' => array_keys(Languages::getAll())]);
}