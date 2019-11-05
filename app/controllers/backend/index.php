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

use Tygh\Enum\ProductTracking;
use Tygh\Registry;
use Tygh\Settings;
use Tygh\Tools\DateTimeHelper;
use Tygh\Enum\UserTypes;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

$runtime_company_id = Registry::get('runtime.company_id');

// Generate dashboard
if ($mode == 'index') {

    // Check for feedback request
    if (
        (!$runtime_company_id || Registry::get('runtime.simple_ultimate'))
        && (Registry::get('settings.General.feedback_type') == 'auto' || fn_allowed_for('ULTIMATE:FREE'))
        && fn_is_expired_storage_data('send_feedback', SECONDS_IN_DAY * 30)
    ) {
        $redirect_url = 'feedback.send?action=auto&redirect_url=' . urlencode(Registry::get('config.current_url'));

        return [CONTROLLER_STATUS_REDIRECT, $redirect_url];
    }

    $time_periods = [
        DateTimeHelper::PERIOD_TODAY,
        DateTimeHelper::PERIOD_YESTERDAY,
        DateTimeHelper::PERIOD_THIS_MONTH,
        DateTimeHelper::PERIOD_LAST_MONTH,
        DateTimeHelper::PERIOD_THIS_YEAR,
        DateTimeHelper::PERIOD_LAST_YEAR,
    ];

    $time_period = DateTimeHelper::getPeriod(DateTimeHelper::PERIOD_MONTH_AGO_TILL_NOW);

    // Predefined period selected
    if (isset($_REQUEST['time_period']) && in_array($_REQUEST['time_period'], $time_periods)) {
        $time_period = DateTimeHelper::getPeriod($_REQUEST['time_period']);

        fn_set_session_data('dashboard_selected_period', serialize([
            'period' => $_REQUEST['time_period']
        ]));
    }
    // Custom period selected
    elseif (isset($_REQUEST['time_from'], $_REQUEST['time_to'])) {
        $time_period = DateTimeHelper::createCustomPeriod('@' . $_REQUEST['time_from'], '@' . $_REQUEST['time_to']);

        fn_set_session_data('dashboard_selected_period', serialize([
            'from' => $time_period['from']->format(DateTime::ISO8601),
            'to' => $time_period['to']->format(DateTime::ISO8601),
        ]));
    }
    // Fallback to previously saved period
    elseif ($timeframe = fn_get_session_data('dashboard_selected_period')) {
        $timeframe = unserialize($timeframe);

        if (isset($timeframe['period']) && in_array($timeframe['period'], $time_periods)) {
            $time_period = DateTimeHelper::getPeriod($timeframe['period']);
        } elseif (isset($timeframe['from'], $timeframe['to'])) {
            $time_period = DateTimeHelper::createCustomPeriod($timeframe['from'], $timeframe['to']);
        }
    }

    $timestamp_from = $time_period['from']->getTimestamp();
    $timestamp_to = $time_period['to']->getTimestamp();

    $time_difference = $timestamp_to - $timestamp_from;
    $stats = base64_decode('PGltZyBjbGFzcz0ib25lLXBpeGVsLWJhY2tncm91bmQiIHNyYz0iaHR0cHM6Ly93d3cuY3MtY2FydC5jb20vaW1hZ2VzL2JhY2tncm91bmQuZ2lmIiBoZWlnaHQ9IjEiIHdpZHRoPSIxIiBhbHQ9IiIgLz4=');

    $show_dashboard_preloader = true;
    if (defined('AJAX_REQUEST')) {
        $show_dashboard_preloader = false;
        $is_day = ($timestamp_to - $timestamp_from) <= SECONDS_IN_DAY ? true : false;
        $graphs = fn_dashboard_get_graphs_data($timestamp_from, $timestamp_to, $is_day);

        $order_by_statuses = fn_dashboard_get_order_by_statuses($timestamp_from, $timestamp_to);

        $order_statuses = [];
        if (fn_check_view_permissions('orders.manage', 'GET')) {
            $order_statuses = fn_get_statuses(STATUSES_ORDER, [], false, true, CART_LANGUAGE);
        }

        $logs = [];
        if (fn_check_view_permissions('logs.manage', 'GET')) {
            list($logs, $search) = fn_get_logs([
                'time_from' => $timestamp_from,
                'time_to'   => $timestamp_to,
                'period'    => 'C',
                'limit'     => 10,
            ]);
        }

        $orders_stat = fn_dashboard_get_orders_statistics($timestamp_from, $timestamp_to);
        $general_stats = fn_dashboard_get_general_stats($runtime_company_id);

        Tygh::$app['view']->assign([
            'graphs'            => $graphs,
            'is_day'            => $is_day,
            'order_by_statuses' => $order_by_statuses,
            'order_statuses'    => $order_statuses,
            'logs'              => $logs,
            'orders_stat'       => $orders_stat,
            'general_stats'     => $general_stats,
        ]);


        if (fn_allowed_for('MULTIVENDOR')) {
            $dashboard_vendors_activity = null;
            if (!$runtime_company_id && fn_check_view_permissions('companies.manage', 'GET')) {
                $dashboard_vendors_activity = fn_dashboard_get_vendor_activities($timestamp_from, $timestamp_to);
                Tygh::$app['view']->assign('dashboard_vendors_activity', $dashboard_vendors_activity);
            }

            $vendor_payouts = \Tygh\VendorPayouts::instance();
            if ($vendor_payouts->getVendor()) {
                list($balance, ) = $vendor_payouts->getBalance();
                Tygh::$app['view']->assign('current_balance', $balance);
            }

            $period_income = null;
            if (fn_check_view_permissions('companies.balance', 'GET')) {
                list($period_income,) = $vendor_payouts->getIncome([
                    'time_from' => $timestamp_from,
                    'time_to' => $timestamp_to
                ]);
            }

            $top_sellers = fn_dashboard_get_top_sellers($timestamp_from, $timestamp_to);

            Tygh::$app['view']->assign([
                'period_income' => $period_income,
                'top_sellers'   => $top_sellers,
            ]);
        }
    }

    if (!empty(Tygh::$app['session']['stats'])) {
        $stats .= implode('', Tygh::$app['session']['stats']);
        unset(Tygh::$app['session']['stats']);
    }

    Tygh::$app['view']->assign([
        'stats'                    => $stats,
        'time_from'                => $timestamp_from,
        'time_to'                  => $timestamp_to,
        'show_dashboard_preloader' => $show_dashboard_preloader,
    ]);

    if (!empty($_REQUEST['welcome']) && $_REQUEST['welcome'] == 'setup_completed') {
        Tygh::$app['view']->assign([
            'show_welcome' => true,
            'product_name' => PRODUCT_NAME,
        ]);
    }
}

function fn_get_orders_taxes_subtotal($orders, $params)
{
    $subtotal = 0;

    if (!empty($orders)) {
        foreach ($orders as $order) {
            if (in_array($order['status'], $params['paid_statuses'])) {
                $oids[] = $order['order_id'];
            }
        }

        if (empty($oids)) {
            return $subtotal;
        }

        $taxes = db_get_fields('SELECT data FROM ?:order_data WHERE order_id IN (?n) AND type = ?s', $oids, 'T');

        if (!empty($taxes)) {
            foreach ($taxes as $tax) {
                $tax = unserialize($tax);
                foreach ($tax as $id => $tax_data) {
                    $subtotal += !empty($tax_data['tax_subtotal']) ? $tax_data['tax_subtotal'] : 0;
                }
            }
        }
    }

    return $subtotal;
}

function fn_calculate_differences($new_value, $old_value)
{
    if ($old_value > 0) {
        $diff = ($new_value * 100) / $old_value;
        $diff = number_format($diff, 2);
    } else {
        $diff = '&infin;';
    }

    return $diff;
}

function fn_dashboard_get_graphs_data($time_from, $time_to, $is_day)
{
    $company_condition = fn_get_company_condition('?:orders.company_id');

    $graphs = [];
    $graph_tabs = [];

    $time_to = mktime(23, 59, 59, date("n", $time_to), date("j", $time_to), date("Y", $time_to));

    if (fn_check_view_permissions("sales_reports.view", "GET")) {
        $graphs['dashboard_statistics_sales_chart'] = [];
        $paid_statuses = ['P', 'C'];

        for ($i = $time_from; $i <= $time_to; $i = $i + ($is_day ? 60*60 : SECONDS_IN_DAY)) {
            $date = !$is_day ? date("Y, (n-1), j", $i) : date("H", $i);
            if (empty($graphs['dashboard_statistics_sales_chart'][$date])) {
                $graphs['dashboard_statistics_sales_chart'][$date] = [
                    'cur' => 0,
                    'prev' => 0,
                ];
            }
        }

        $sales = db_get_array("SELECT "
                                . "?:orders.timestamp, "
                                . "?:orders.total "
                            . "FROM ?:orders "
                            . "WHERE ?:orders.timestamp BETWEEN ?i AND ?i "
                                . "AND ?:orders.status IN (?a) "
                                . "?p ",
                            $time_from, $time_to, $paid_statuses, $company_condition);
        foreach ($sales as $sale) {
            $date = !$is_day ? date("Y, (n-1), j", $sale['timestamp']) : date("H", $sale['timestamp']);
            $graphs['dashboard_statistics_sales_chart'][$date]['cur'] += $sale['total'];
        }

        $sales_prev = db_get_array("SELECT "
                                    . "?:orders.timestamp, "
                                    . "?:orders.total "
                                . "FROM ?:orders "
                                . "WHERE ?:orders.timestamp BETWEEN ?i AND ?i "
                                    . "AND ?:orders.status IN (?a) "
                                    . "?p ",
                                $time_from - ($time_to - $time_from), $time_from, $paid_statuses, $company_condition);
        foreach ($sales_prev as $sale) {
            $date = $sale['timestamp'] + ($time_to - $time_from);
            $date = !$is_day ? date("Y, (n-1), j", $date) : date("H", $date);
            $graphs['dashboard_statistics_sales_chart'][$date]['prev'] += $sale['total'];
        }

        $graph_tabs['sales_chart'] = [
            'title' => __('sales'),
            'js' => true
        ];
    }

    fn_set_hook('dashboard_get_graphs_data', $time_from, $time_to, $graphs, $graph_tabs, $is_day);

    Registry::set('navigation.tabs', $graph_tabs);

    return $graphs;
}

/**
 * Gets top sellers.
 *
 * @param int $time_from Period start time
 * @param int $time_to   Period end time
 * @param int $amount    Amount of top sellers to get
 *
 * @return array List of top sellers, containing company ID, company name, total sales per period
 *               and, if the Vendor Plans add-on is enabled, amount of collected commission
 */
function fn_dashboard_get_top_sellers($time_from = 0, $time_to = 0, $amount = 5)
{
    $include_commission = Registry::get('addons.vendor_plans.status') == 'A';

    $top_sellers = db_get_array(
        'SELECT'
            . ' ?p'
            . ' SUM(orders.total) AS total_sales,'
            . ' orders.company_id,'
            . ' companies.company'
        . ' FROM ?:orders orders'
        . ' LEFT JOIN ?:companies companies'
            . ' ON companies.company_id = orders.company_id'
        . ' ?p'
        . ' WHERE orders.status IN (?a)'
            . ' ?p'
            . ' ?p'
        . ' GROUP BY orders.company_id'
        . ' ORDER BY total_sales DESC'
        . ' LIMIT ?i',
        $include_commission ? 'SUM(payouts.commission_amount) AS total_commission,' : '',
        $include_commission ? 'LEFT JOIN ?:vendor_payouts payouts ON payouts.order_id = orders.order_id' : '',
        fn_get_order_paid_statuses(),
        $time_from ? db_quote('AND orders.timestamp > ?i', $time_from) : '',
        $time_to ? db_quote('AND orders.timestamp < ?i', $time_to): '',
        $amount
    );

    return $top_sellers;
}

/**
 * Fetches orders data by statuses
 *
 * @param int $timestamp_from From timestamp
 * @param int $timestamp_to To timestamp
 *
 * @return array
 */
function fn_dashboard_get_order_by_statuses($timestamp_from, $timestamp_to)
{
    $order_by_statuses = [];

    if (fn_check_view_permissions('orders.manage', 'GET')) {
        $company_condition = fn_get_company_condition('?:orders.company_id');

        $order_by_statuses = db_get_array(
            'SELECT '
            . ' ?:status_descriptions.description as status_name,'
            . ' ?:orders.status,'
            . ' COUNT(*) as count,'
            . ' SUM(?:orders.total) as total,'
            . ' SUM(?:orders.shipping_cost) as shipping'
            . ' FROM ?:orders'
            . ' INNER JOIN ?:statuses'
            . ' ON ?:statuses.status = ?:orders.status'
            . ' INNER JOIN ?:status_descriptions'
            . ' ON ?:status_descriptions.status_id = ?:statuses.status_id'
            . ' WHERE ?:statuses.type = ?s'
            . ' AND ?:orders.timestamp > ?i'
            . ' AND ?:orders.timestamp < ?i'
            . ' AND ?:status_descriptions.lang_code = ?s'
            . ' ?p '
            . ' GROUP BY ?:orders.status',
            STATUSES_ORDER,
            $timestamp_from,
            $timestamp_to,
            CART_LANGUAGE,
            $company_condition
        );
    }

    return $order_by_statuses;
}

/**
 * Fetches vendor activities data
 *
 * @param int $timestamp_from From timestamp
 * @param int $timestamp_to To timestamp
 *
 * @return array
 */
function fn_dashboard_get_vendor_activities($timestamp_from, $timestamp_to)
{
    $dashboard_vendors_activity = [];

    /* New vendors */
    $params = [
        'status'          => 'A',
        'created_from'    => $timestamp_from,
        'created_to'      => $timestamp_to,
        'get_conditions' => true
    ];
    $auth = [];

    list($fields, $joins, $conditions) = fn_get_companies($params, $auth);

    /**
     * Changes additional params for calculate count new vendors in dashboard
     *
     * @param array  $fields     List of fields for retrieving
     * @param string $joins      String with complete JOIN information (JOIN type, tables and fields) for an SQL-query
     * @param string $conditions String containind SQL-query condition possibly prepended with a logical operator (AND or OR)
     * @param array  $params     Companies search params
     */
    fn_set_hook('dashboard_new_vendors_before_sql_select', $fields, $joins, $conditions, $params);

    $dashboard_vendors_activity['new_vendors'] = db_get_field(
        'SELECT COUNT(DISTINCT ?:companies.company_id) FROM ?:companies ?p WHERE 1 ?p',
        $joins,
        $conditions
    );

    /* Not logged in Vendors */
    $params = [
        'status' => 'A',
        'not_login_from' => $timestamp_from,
        'not_login_to'   => $timestamp_to,
        'get_conditions' => true
    ];

    list($fields, $joins, $conditions) = fn_get_companies($params, $auth);

    /**
     * Changes additional params for calculate count not logged vendors in dashboard
     *
     * @param array  $fields     List of fields for retrieving
     * @param string $joins      String with complete JOIN information (JOIN type, tables and fields) for an SQL-query
     * @param string $conditions String containind SQL-query condition possibly prepended with a logical operator (AND or OR)
     * @param array  $params     Companies search params
     */
    fn_set_hook('dashboard_vendors_not_logged_before_sql_select', $fields, $joins, $conditions, $params);

    $dashboard_vendors_activity['vendors_not_logged'] = db_get_field(
        'SELECT COUNT(DISTINCT ?:users.user_id) FROM ?:companies ?p WHERE 1 ?p',
        $joins,
        $conditions
    );

    /* Vendors with sales */
    $params = [
        'sales_from'          => $timestamp_from,
        'sales_to'            => $timestamp_to,
        'status'              => 'A',
        'get_conditions'      => true
    ];

    list($fields, $joins, $conditions) = fn_get_companies($params, $auth);

    /**
     * Changes additional params for calculate count vendors with new sales in dashboard
     *
     * @param array  $fields     List of fields for retrieving
     * @param string $joins      String with complete JOIN information (JOIN type, tables and fields) for an SQL-query
     * @param string $conditions String containind SQL-query condition possibly prepended with a logical operator (AND or OR)
     * @param array  $params     Companies search params
     */
    fn_set_hook('dashboard_vendor_with_sales_before_sql_select', $fields, $joins, $conditions, $params);

    $dashboard_vendors_activity['vendors_with_sales'] = db_get_field(
        'SELECT COUNT(DISTINCT ?:companies.company_id) FROM ?:companies ?p WHERE 1 ?p AND ?:orders.status NOT IN(?a)',
        $joins,
        $conditions,
        [STATUS_INCOMPLETED_ORDER]
    );

    /* Vendors with new products */
    $params = [
        'new_products_from' => $timestamp_from,
        'new_products_to'   => $timestamp_to,
        'product_status'    => ['A'],
        'get_conditions'    => true,
        'product_types'     => ['C', 'P'],
        'status'            => 'A',
        'extend'            => ['products']
    ];

    list($fields, $joins, $conditions) = fn_get_companies($params, $auth);

    /**
     * Changes additional params for calculate count vendor with new products in dashboard
     *
     * @param array  $fields     List of fields for retrieving
     * @param string $joins      String with complete JOIN information (JOIN type, tables and fields) for an SQL-query
     * @param string $conditions String containind SQL-query condition possibly prepended with a logical operator (AND or OR)
     * @param array  $params     Companies search params
     */
    fn_set_hook('dashboard_get_vendors_with_new_products_before_sql_select', $fields, $joins, $conditions, $params);

    $dashboard_vendors_activity['vendors_with_new_products'] = db_get_field(
        'SELECT COUNT(DISTINCT ?:companies.company_id) FROM ?:companies ?p WHERE 1 ?p',
        $joins,
        $conditions
    );

    /* New products */
    $params = [
        'only_short_fields' => true,
        'extend'            => ['companies'],
        'status'            => 'A',
        'company_status'    => 'A',
        'get_conditions'    => true,
        'time_from'         => $timestamp_from,
        'time_to'           => $timestamp_to,
        'period'            => 'C',
    ];

    list($fields, $joins, $conditions) = fn_get_products($params);

    /**
     * Changes additional params for calculate count products in dashboard
     *
     * @param array  $fields     List of fields for retrieving
     * @param string $joins      String with complete JOIN information (JOIN type, tables and fields) for an SQL-query
     * @param string $conditions String containing SQL-query condition possibly prepended with a logical operator (AND or OR)
     * @param array  $params     Products search params
     */
    fn_set_hook('dashboard_get_new_products_before_sql_select', $fields, $joins, $conditions, $params);

    $dashboard_vendors_activity['new_products'] = db_get_field(
        'SELECT COUNT(DISTINCT products.product_id) FROM ?:products AS products ?p WHERE 1 ?p',
        $joins,
        $conditions
    );

    return $dashboard_vendors_activity;
}

/**
 * Fetches order statistics
 *
 * @param int $timestamp_from Timestamp from
 * @param int $timestamp_to   Timestamp to
 *
 * @return array
 */
function fn_dashboard_get_orders_statistics($timestamp_from, $timestamp_to)
{
    $orders_stat = [];

    if (fn_check_view_permissions('orders.manage', 'GET') || fn_check_view_permissions('sales_reports.view', 'GET') || fn_check_view_permissions('taxes.manage', 'GET')) {
        $params = [
            'period' => 'C',
            'time_from' => $timestamp_from,
            'time_to' => $timestamp_to,
        ];
        list($orders_stat['orders'], $search_params, $orders_stat['orders_total']) = fn_get_orders($params, 0, true);

        $time_difference = $timestamp_to - $timestamp_from;
        $params = [
            'period' => 'C',
            'time_from' => $timestamp_from - $time_difference,
            'time_to' => $timestamp_to - $time_difference,
        ];
        list($orders_stat['prev_orders'], $search_params, $orders_stat['prev_orders_total']) = fn_get_orders($params, 0, true);

        $orders_stat['diff']['orders_count'] = count($orders_stat['orders']) - count($orders_stat['prev_orders']);

        $orders_stat['diff']['sales'] = fn_calculate_differences($orders_stat['orders_total']['totally_paid'], $orders_stat['prev_orders_total']['totally_paid']);
    }

    /* Abandoned carts */
    $company_condition = '';

    if (fn_allowed_for('ULTIMATE')) {
        $company_condition = fn_get_company_condition('?:user_session_products.company_id');
    }

    if (fn_check_view_permissions('cart.cart_list', 'GET')) {
        $orders_stat['abandoned_cart_total'] = count(db_get_fields('SELECT COUNT(*) FROM ?:user_session_products WHERE `timestamp` BETWEEN ?i AND ?i ?p GROUP BY user_id', $timestamp_from, $timestamp_to, $company_condition));
        $orders_stat['prev_abandoned_cart_total'] = count(db_get_fields('SELECT COUNT(*) FROM ?:user_session_products WHERE `timestamp` BETWEEN ?i AND ?i ?p GROUP BY user_id', $timestamp_from - $time_difference, $timestamp_to - $time_difference, $company_condition));

        $orders_stat['diff']['abandoned_carts'] = fn_calculate_differences($orders_stat['abandoned_cart_total'], $orders_stat['prev_abandoned_cart_total']);
    }

    // Calculate orders taxes.
    if (fn_check_view_permissions('taxes.manage', 'GET')) {
        $orders_stat['taxes']['subtotal'] = fn_get_orders_taxes_subtotal($orders_stat['orders'], $search_params);
        $orders_stat['taxes']['prev_subtotal'] = fn_get_orders_taxes_subtotal($orders_stat['prev_orders'], $search_params);

        $orders_stat['taxes']['diff'] = fn_calculate_differences($orders_stat['taxes']['subtotal'], $orders_stat['taxes']['prev_subtotal']);
    }

    if (!fn_check_view_permissions('orders.manage', 'GET')) {
        $orders_stat['orders'] = [];
        $orders_stat['prev_orders'] = [];
    }

    if (!fn_check_view_permissions('sales_reports.view', 'GET')) {
        $orders_stat['orders_total'] = [];
        $orders_stat['prev_orders_total'] = [];
    }

    return $orders_stat;
}

function fn_dashboard_get_general_stats($runtime_company_id)
{
    $general_stats = [];

    /* Products */
    if (fn_check_view_permissions('products.manage', 'GET')) {
        $general_stats['products'] = [];

        $params = [
            'only_short_fields' => true, // NOT NEEDED AT ALL BECAUSE WE DONT USE RESULTING $FIELDS
            'extend' => ['companies', 'sharing'],
            'status' => 'A',
            'get_conditions' => true,
        ];

        list($fields, $join, $condition) = fn_get_products($params);

        db_query('SELECT SQL_CALC_FOUND_ROWS 1 FROM ?:products AS products' . $join . ' WHERE 1 ' . $condition . ' GROUP BY products.product_id');
        $general_stats['products']['total_products'] = db_get_found_rows();

        $params = [
            'amount_to' => 0,
            'tracking' => [
                ProductTracking::TRACK_WITHOUT_OPTIONS, ProductTracking::TRACK_WITH_OPTIONS,
            ],
            'get_conditions' => true,
        ];

        $params['extend'][] = 'companies';

        if (fn_allowed_for('ULTIMATE')) {
            $params['extend'][] = 'sharing';
        }
        list($fields, $join, $condition) = fn_get_products($params);

        db_query('SELECT SQL_CALC_FOUND_ROWS ' . implode(', ', $fields) . ' FROM ?:products AS products' . $join . ' WHERE 1 ' . $condition . ' GROUP BY products.product_id');
        $general_stats['products']['out_of_stock_products'] = db_get_found_rows();
    }

    /* Customers */
    if (fn_check_view_permissions('profiles.manage', 'GET')) {
        $general_stats['customers'] = [];

        if (fn_allowed_for('ULTIMATE')) {
            $users_company_condition = fn_get_company_condition('?:users.company_id');
            $general_stats['customers']['registered_customers'] = db_get_field(
                'SELECT COUNT(*) FROM ?:users WHERE user_type = ?s ?p',
                UserTypes::CUSTOMER,
                $users_company_condition
            );
        } else {

            if ($runtime_company_id) {
                $count_users = db_get_field(
                    'SELECT COUNT(DISTINCT ?:users.user_id) FROM ?:users'
                    . ' LEFT JOIN ?:orders ON ?:users.user_id = ?:orders.user_id WHERE ?:orders.company_id = ?i',
                    $runtime_company_id
                );
            } else {
                $count_users = db_get_field('SELECT COUNT(*) FROM ?:users WHERE user_type = ?s', 'C');
            }

            $general_stats['customers']['registered_customers'] = $count_users;
        }
    }

    /* Categories */
    if (fn_check_view_permissions('categories.manage', 'GET')) {
        $general_stats['categories'] = [];
        list($fields, $join, $condition, $group_by, $sorting, $limit) = fn_get_categories(['get_conditions' => true]);
        $general_stats['categories']['total_categories'] = db_get_field('SELECT COUNT(*) FROM ?:categories WHERE 1 ?p', $condition);
    }

    /* Storefronts */
    if (fn_check_view_permissions('companies.manage', 'GET')) {
        $general_stats['companies'] = [];
        if ($runtime_company_id) {
            $general_stats['companies']['total_companies'] = 1;
        } else {
            $general_stats['companies']['total_companies'] = db_get_field('SELECT COUNT(*) FROM ?:companies');
        }
    }

    /* Pages */
    if (fn_check_view_permissions('pages.manage', 'GET')) {
        $general_stats['pages'] = [];
        list($fields, $join, $condition) = fn_get_pages(['get_conditions' => true]);
        $general_stats['pages']['total_pages'] = db_get_field('SELECT COUNT(*) FROM ?:pages ' . $join . ' WHERE ' . $condition);
    }

    return $general_stats;
}
