<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:12:38
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\index\components\dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2662579265daf1c667314a8-53291587%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77ce7404eb9648687a5cab4d5d1ce05734417339' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\index\\components\\dashboard.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '2662579265daf1c667314a8-53291587',
  'function' => 
  array (
    'get_orders' => 
    array (
      'parameter' => 
      array (
        'limit' => 5,
      ),
      'compiled' => '',
    ),
    'show_log_row' => 
    array (
      'parameter' => 
      array (
        'item' => 
        array (
        ),
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'is_day' => 0,
    'runtime' => 0,
    'current_balance' => 0,
    'period_income' => 0,
    'orders_stat' => 0,
    'user_can_view_orders' => 0,
    'time_from' => 0,
    'time_to' => 0,
    'general_stats' => 0,
    'settings' => 0,
    'status' => 0,
    'params' => 0,
    'limit' => 0,
    'orders' => 0,
    'order' => 0,
    'order_statuses' => 0,
    'dashboard_vendors_activity' => 0,
    'url' => 0,
    'graphs' => 0,
    'chart' => 0,
    'graph' => 0,
    'date' => 0,
    'data' => 0,
    'order_by_statuses' => 0,
    'order_status' => 0,
    'logs' => 0,
    'item' => 0,
    '_type' => 0,
    '_action' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1c6702ba58_05331115',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1c6702ba58_05331115')) {function content_5daf1c6702ba58_05331115($_smarty_tpl) {?><?php if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_modifier_count')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.count.php';
if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.enum.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('previous_period','current_period','vendor_payouts.current_balance_text','vendor_payouts.income','orders','sales','taxes','users_carts','active_products','out_of_stock_products','registered_customers','categories','vendors','web_pages','order','by','no_data','vendors_activity','vendors_activity.vendors_with_sales','vendors_activity.new_vendors','vendors_activity.vendors_with_new_products','vendors_activity.not_logged_in_vendors','vendors_activity.new_products','statistics','recent_orders','all','order_by_status','status','qty','shipping','recent_activity','order'));
?>
<?php $_smarty_tpl->tpl_vars["show_latest_orders"] = new Smarty_variable(fn_check_permissions("orders",'manage','admin'), null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_orders"] = new Smarty_variable(fn_check_permissions("sales_reports",'reports','admin'), null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_inventory"] = new Smarty_variable(fn_check_permissions("products",'manage','admin'), null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_users"] = new Smarty_variable(fn_check_permissions("profiles",'manage','admin'), null, 0);?>

<?php $_smarty_tpl->tpl_vars["user_can_view_orders"] = new Smarty_variable(fn_check_view_permissions("orders.manage",'GET'), null, 0);?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
    (function(_, $) {

        _.drawChart = function(is_day) {
            if (typeof google == "undefined") {
                return false;
            }

            function get_data(div) {
                var id = $(div).attr('id');
                var dataTable = new google.visualization.DataTable();
                if (is_day) {
                    dataTable.addColumn('timeofday', 'Date');
                } else {
                    dataTable.addColumn('date', 'Date');
                }
                dataTable.addColumn('number', '<?php echo $_smarty_tpl->__("previous_period");?>
');
                dataTable.addColumn('number', '<?php echo $_smarty_tpl->__("current_period");?>
');
                dataTable.addRows(_.chart_data[id]);

                var dataView = new google.visualization.DataView(dataTable);
                dataView.setColumns([0, 1, 2]);

                return dataView;
            }

            var chartwidth = $('.dashboard-statistics-chart').width();

            var options = {
                chartArea: {
                    left: 7,
                    top: 10,
                    width: chartwidth,
                    height: 208
                },
                colors: ['#ff9494','#33c49b'],
                tooltip: {
                    showColorCode: true
                },
                lineWidth: 1,
                hAxis: {
                    baselineColor: '#eaeef0',
                    textStyle: {
                        color: '#a3b2bf',
                        fontSize: 11
                    },
                    gridlines: {
                        count: 6,
                        color: '#f0f5f7',
                    }
                },
                legend: {
                    position: 'none'
                },
                pointSize: 6,
                vAxis: {
                    minValue: 0,
                    baselineColor: '#eaeef0',
                    textPosition: 'in',
                    textStyle: {
                        color: '#a3b2bf',
                        fontSize: 11
                    },
                    gridlines: {
                        count: 10,
                        color: '#eaeef0',
                    }
                }
            };
            if (!is_day) {
                options.hAxis.format = 'MMM d';
            }

            $('.dashboard-statistics-chart:visible').each(function(i, div) {
                var dataView = get_data(div);
                var chart = new google.visualization.AreaChart(div);
                chart.draw(dataView, options);
            });

            $('#statistics_tabs .tabs li').on('click', function() {
                $('.dashboard-statistics-chart:visible').each(function(i, div) {
                    var dataView = get_data(div);
                    var chart = new google.visualization.AreaChart(div);
                    chart.draw(dataView, options);
                });
            });
        };

        $(document).ready(function() {
            $.getScript('//www.google.com/jsapi', function() {
                setTimeout(function() { // do not remove it - otherwise it will be slow in ff
                    google.load('visualization', '1.0', {
                        packages: ['corechart'],
                        callback: function() {
                            _.drawChart(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['is_day']->value, ENT_QUOTES, 'UTF-8');?>
);
                        }
                    });
                }, 0);
            });

        });

        $(window).resize(function() {
            if(this.resizeTO) clearTimeout(this.resizeTO);
            this.resizeTO = setTimeout(function() {
                $(this).trigger('resizeEnd');
            }, 1);
        });

        //redraw graph when window resize is completed
        $(window).on('resizeEnd', function() {
            chartwidth = $('.dashboard-statistics-chart').width();
            _.drawChart(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['is_day']->value, ENT_QUOTES, 'UTF-8');?>
);
        });
    }(Tygh, Tygh.$));
<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:index")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:index"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="dashboard row-fluid" id="dashboard">

        <div class="dashboard-cards span3">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:finance_statistic")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:finance_statistic"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if (fn_allowed_for("MULTIVENDOR")) {?>
                <?php if ($_smarty_tpl->tpl_vars['runtime']->value['company_id']) {?>
                    <div class="dashboard-card dashboard-card--balance">
                        <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("vendor_payouts.current_balance_text");?>
</div>
                        <div class="dashboard-card-content">
                            <h3>
                                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:finance_statistic_balance")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:finance_statistic_balance"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                    <a href="<?php echo htmlspecialchars(fn_url("companies.balance"), ENT_QUOTES, 'UTF-8');?>
"
                                    ><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['current_balance']->value), 0);?>
</a>
                                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:finance_statistic_balance"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            </h3>
                            &nbsp;
                        </div>
                    </div>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['period_income']->value)) {?>
                    <div class="dashboard-card">
                        <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("vendor_payouts.income");?>
</div>
                        <div class="dashboard-card-content">
                            <h3>
                                <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['period_income']->value), 0);?>

                            </h3>
                            &nbsp;
                        </div>
                    </div>
                <?php }?>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['orders_stat']->value['orders'])) {?>
                <div class="dashboard-card">
                    <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("orders");?>
</div>
                    <div class="dashboard-card-content">
                        <h3>
                            <?php if ($_smarty_tpl->tpl_vars['user_can_view_orders']->value) {?>
                                <a href="<?php echo htmlspecialchars(fn_url("orders.manage?is_search=Y&period=C&time_from=".((string)$_smarty_tpl->tpl_vars['time_from']->value)."&time_to=".((string)$_smarty_tpl->tpl_vars['time_to']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(smarty_modifier_count($_smarty_tpl->tpl_vars['orders_stat']->value['orders']), ENT_QUOTES, 'UTF-8');?>
</a>
                            <?php } else { ?>
                                <?php echo htmlspecialchars(smarty_modifier_count($_smarty_tpl->tpl_vars['orders_stat']->value['orders']), ENT_QUOTES, 'UTF-8');?>

                            <?php }?>
                        </h3>
                        <?php echo htmlspecialchars(smarty_modifier_count($_smarty_tpl->tpl_vars['orders_stat']->value['prev_orders']), ENT_QUOTES, 'UTF-8');?>
, <?php if ($_smarty_tpl->tpl_vars['orders_stat']->value['diff']['orders_count']>0) {?>+<?php }
echo htmlspecialchars($_smarty_tpl->tpl_vars['orders_stat']->value['diff']['orders_count'], ENT_QUOTES, 'UTF-8');?>

                    </div>
                </div>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['orders_stat']->value['orders_total'])) {?>
                <div class="dashboard-card">
                    <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("sales");?>
</div>
                    <div class="dashboard-card-content">
                        <h3><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['orders_stat']->value['orders_total']['totally_paid']), 0);?>
</h3><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['orders_stat']->value['prev_orders_total']['totally_paid']), 0);?>
, <?php if ($_smarty_tpl->tpl_vars['orders_stat']->value['orders_total']['totally_paid']>$_smarty_tpl->tpl_vars['orders_stat']->value['prev_orders_total']['totally_paid']) {?>+<?php }
echo $_smarty_tpl->tpl_vars['orders_stat']->value['diff']['sales'];?>
%
                    </div>
                </div>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['orders_stat']->value['taxes'])) {?>
                <div class="dashboard-card">
                    <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("taxes");?>
</div>
                    <div class="dashboard-card-content">
                        <h3><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['orders_stat']->value['taxes']['subtotal']), 0);?>
</h3><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['orders_stat']->value['taxes']['prev_subtotal']), 0);?>
, <?php if ($_smarty_tpl->tpl_vars['orders_stat']->value['taxes']['subtotal']>$_smarty_tpl->tpl_vars['orders_stat']->value['taxes']['prev_subtotal']) {?>+<?php }
echo $_smarty_tpl->tpl_vars['orders_stat']->value['taxes']['diff'];?>
%
                    </div>
                </div>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['orders_stat']->value['abandoned_cart_total'])) {?>
                <div class="dashboard-card">
                    <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("users_carts");?>
</div>
                    <div class="dashboard-card-content">
                        <h3><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['orders_stat']->value['abandoned_cart_total'])===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
</h3><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['orders_stat']->value['prev_abandoned_cart_total'])===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
, <?php if ($_smarty_tpl->tpl_vars['orders_stat']->value['abandoned_cart_total']>$_smarty_tpl->tpl_vars['orders_stat']->value['prev_abandoned_cart_total']) {?>+<?php }
echo $_smarty_tpl->tpl_vars['orders_stat']->value['diff']['abandoned_carts'];?>
%
                    </div>
                </div>
            <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:finance_statistic"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


            <?php if (!empty($_smarty_tpl->tpl_vars['general_stats']->value['products'])) {?>
                <div class="dashboard-card">
                    <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("active_products");?>
</div>
                    <div class="dashboard-card-content">
                        <h3><a href="<?php echo htmlspecialchars(fn_url("products.manage?status=A"), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(number_format($_smarty_tpl->tpl_vars['general_stats']->value['products']['total_products']), ENT_QUOTES, 'UTF-8');?>
</a></h3>
                    </div>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y") {?>
                    <div class="dashboard-card">
                        <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("out_of_stock_products");?>
</div>
                        <div class="dashboard-card-content">
                            <h3><a href="<?php ob_start();
echo htmlspecialchars(smarty_modifier_enum("ProductTracking::TRACK_WITHOUT_OPTIONS"), ENT_QUOTES, 'UTF-8');
$_tmp1=ob_get_clean();?><?php ob_start();
echo htmlspecialchars(smarty_modifier_enum("ProductTracking::TRACK_WITH_OPTIONS"), ENT_QUOTES, 'UTF-8');
$_tmp2=ob_get_clean();?><?php echo htmlspecialchars(fn_url("products.manage?amount_from=&amount_to=0&tracking[0]=".$_tmp1."&tracking[1]=".$_tmp2), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(number_format($_smarty_tpl->tpl_vars['general_stats']->value['products']['out_of_stock_products']), ENT_QUOTES, 'UTF-8');?>
</a></h3>
                        </div>
                    </div>
                <?php }?>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['general_stats']->value['customers'])) {?>
                <div class="dashboard-card">
                    <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("registered_customers");?>
</div>
                    <div class="dashboard-card-content">
                        <h3><a href="<?php echo htmlspecialchars(fn_url("profiles.manage?user_type=C"), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(number_format($_smarty_tpl->tpl_vars['general_stats']->value['customers']['registered_customers']), ENT_QUOTES, 'UTF-8');?>
</a></h3>
                    </div>
                </div>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['general_stats']->value['categories'])) {?>
                <div class="dashboard-card">
                    <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("categories");?>
</div>
                    <div class="dashboard-card-content">
                        <h3><a href="<?php echo htmlspecialchars(fn_url("categories.manage"), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(number_format($_smarty_tpl->tpl_vars['general_stats']->value['categories']['total_categories']), ENT_QUOTES, 'UTF-8');?>
</a></h3>
                    </div>
                </div>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['general_stats']->value['companies'])) {?>
                <div class="dashboard-card">
                    <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("vendors");?>
</div>
                    <div class="dashboard-card-content">
                        <h3><a href="<?php echo htmlspecialchars(fn_url("companies.manage"), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(number_format($_smarty_tpl->tpl_vars['general_stats']->value['companies']['total_companies']), ENT_QUOTES, 'UTF-8');?>
</a></h3>
                    </div>
                </div>
            <?php }?>
            <?php if (!empty($_smarty_tpl->tpl_vars['general_stats']->value['pages'])) {?>
                <div class="dashboard-card">
                    <div class="dashboard-card-title"><?php echo $_smarty_tpl->__("web_pages");?>
</div>
                    <div class="dashboard-card-content">
                        <h3><a href="<?php echo htmlspecialchars(fn_url("pages.manage"), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(number_format($_smarty_tpl->tpl_vars['general_stats']->value['pages']['total_pages']), ENT_QUOTES, 'UTF-8');?>
</a></h3>
                    </div>
                </div>
            <?php }?>
        </div>

        <?php if (!is_callable('smarty_modifier_date_format')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\modifier.date_format.php';
?><?php if (!function_exists('smarty_template_function_get_orders')) {
    function smarty_template_function_get_orders($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['get_orders']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
            <?php $_smarty_tpl->tpl_vars['params'] = new Smarty_variable(array('status'=>$_smarty_tpl->tpl_vars['status']->value,'time_from'=>$_smarty_tpl->tpl_vars['time_from']->value,'time_to'=>$_smarty_tpl->tpl_vars['time_to']->value,'period'=>'C'), null, 0);?>
            <?php $_smarty_tpl->tpl_vars['orders'] = new Smarty_variable(fn_get_orders($_smarty_tpl->tpl_vars['params']->value,$_smarty_tpl->tpl_vars['limit']->value), null, 0);?>

            <div class="table-wrapper">
                <table class="table table-middle table-last-td-align-right">
                    <tbody>
                    <?php  $_smarty_tpl->tpl_vars["order"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["order"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['orders']->value[0]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["order"]->key => $_smarty_tpl->tpl_vars["order"]->value) {
$_smarty_tpl->tpl_vars["order"]->_loop = true;
?>
                        <tr>
                            <td>
                                <span class="label btn-info o-status-<?php echo htmlspecialchars(mb_strtolower($_smarty_tpl->tpl_vars['order']->value['status'], 'UTF-8'), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order_statuses']->value[$_smarty_tpl->tpl_vars['order']->value['status']]['description'], ENT_QUOTES, 'UTF-8');?>
</span>
                            </td>
                            <td><a href="<?php echo htmlspecialchars(fn_url("orders.details?order_id=".((string)$_smarty_tpl->tpl_vars['order']->value['order_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("order");?>
 <bdi>#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['order_id'], ENT_QUOTES, 'UTF-8');?>
</bdi></a> <?php echo $_smarty_tpl->__("by");?>
 <?php if ($_smarty_tpl->tpl_vars['order']->value['user_id']) {?><a href="<?php echo htmlspecialchars(fn_url("profiles.update?user_id=".((string)$_smarty_tpl->tpl_vars['order']->value['user_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php }
echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['lastname'], ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['firstname'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['order']->value['user_id']) {?></a><?php }?></td>
                            <td><span class="date"><?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value['timestamp'],((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['date_format']).", ".((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['time_format'])), ENT_QUOTES, 'UTF-8');?>
</span></td>
                            <td><h4><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['order']->value['total']), 0);?>
</h4></td>
                        </tr>
                        <?php }
if (!$_smarty_tpl->tpl_vars["order"]->_loop) {
?>
                        <tr><td><?php echo $_smarty_tpl->__("no_data");?>
</td></tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


        <div class="dashboard-main-column span9">
            <?php if (isset($_smarty_tpl->tpl_vars['dashboard_vendors_activity']->value)) {?>
                <div class="dashboard-row-top">
                    <div class="dashboard-table dashboard-vendors-activity">
                        <h4><?php echo $_smarty_tpl->__("vendors_activity");?>
</h4>
                        <div id="dashboard_vendors_activity">
                            <div class="span6">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="dashboard-vendors-activity__label">
                                            <?php $_smarty_tpl->tpl_vars['url'] = new Smarty_variable("companies.manage?sales_from=".((string)$_smarty_tpl->tpl_vars['time_from']->value)."&sales_to=".((string)$_smarty_tpl->tpl_vars['time_to']->value)."&status=A", null, 0);?>
                                            <a href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['url']->value), ENT_QUOTES, 'UTF-8');?>
">
                                                <?php echo $_smarty_tpl->__("vendors_activity.vendors_with_sales");?>

                                            </a>
                                        </td>
                                        <td class="dashboard-vendors-activity__value">
                                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dashboard_vendors_activity']->value['vendors_with_sales'], ENT_QUOTES, 'UTF-8');?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="dashboard-vendors-activity__label">
                                            <a href="<?php echo htmlspecialchars(fn_url("companies.manage?created_from=".((string)$_smarty_tpl->tpl_vars['time_from']->value)."&created_to=".((string)$_smarty_tpl->tpl_vars['time_to']->value)."&status=A"), ENT_QUOTES, 'UTF-8');?>
">
                                                <?php echo $_smarty_tpl->__("vendors_activity.new_vendors");?>

                                            </a>
                                        </td>
                                        <td class="dashboard-vendors-activity__value">
                                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dashboard_vendors_activity']->value['new_vendors'], ENT_QUOTES, 'UTF-8');?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="dashboard-vendors-activity__label">
                                            <?php $_smarty_tpl->tpl_vars['url'] = new Smarty_variable("companies.manage?extend[]=products&new_products_from=".((string)$_smarty_tpl->tpl_vars['time_from']->value)."&new_products_to=".((string)$_smarty_tpl->tpl_vars['time_to']->value)."&status=A", null, 0);?>
                                            <a href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['url']->value), ENT_QUOTES, 'UTF-8');?>
">
                                                <?php echo $_smarty_tpl->__("vendors_activity.vendors_with_new_products");?>

                                            </a>
                                        </td>
                                        <td class="dashboard-vendors-activity__value">
                                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dashboard_vendors_activity']->value['vendors_with_new_products'], ENT_QUOTES, 'UTF-8');?>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="span6">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="dashboard-vendors-activity__label">
                                            <a href="<?php echo htmlspecialchars(fn_url("companies.manage?not_login_from=".((string)$_smarty_tpl->tpl_vars['time_from']->value)."&not_login_to=".((string)$_smarty_tpl->tpl_vars['time_to']->value)."&status=A"), ENT_QUOTES, 'UTF-8');?>
">
                                                <?php echo $_smarty_tpl->__("vendors_activity.not_logged_in_vendors");?>

                                            </a>
                                        </td>
                                        <td class="dashboard-vendors-activity__value">
                                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dashboard_vendors_activity']->value['vendors_not_logged'], ENT_QUOTES, 'UTF-8');?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="dashboard-vendors-activity__label">
                                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:dashboard_new_products_link")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:dashboard_new_products_link"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                            <?php $_smarty_tpl->tpl_vars['url'] = new Smarty_variable("products.manage?time_from=".((string)$_smarty_tpl->tpl_vars['time_from']->value)."&time_to=".((string)$_smarty_tpl->tpl_vars['time_to']->value)."&period=C&status[]=A&company_status[]=A", null, 0);?>
                                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:dashboard_new_products_link"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                            <a href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['url']->value), ENT_QUOTES, 'UTF-8');?>
">
                                                <?php echo $_smarty_tpl->__("vendors_activity.new_products");?>

                                            </a>
                                        </td>
                                        <td class="dashboard-vendors-activity__value">
                                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dashboard_vendors_activity']->value['new_products'], ENT_QUOTES, 'UTF-8');?>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--dashboard_vendors_activity--></div>
                    </div>
                </div>
            <?php }?>
            <div class="dashboard-row">
                <?php if (!empty($_smarty_tpl->tpl_vars['graphs']->value)) {?>
                    <div class="dashboard-statistics">
                        <h4>
                            <?php echo $_smarty_tpl->__("statistics");?>

                        </h4>
                        <?php $_smarty_tpl->_capture_stack[0][] = array("chart_tabs", null, null); ob_start(); ?>
                            <div id="content_sales_chart">
                                <div id="dashboard_statistics_sales_chart" class="dashboard-statistics-chart spinner">
                                </div>
                            </div>
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:chart_statistic")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:chart_statistic"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:chart_statistic"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                        <div id="statistics_tabs">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/tabsbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('content'=>Smarty::$_smarty_vars['capture']['chart_tabs']), 0);?>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
>
                                Tygh.chart_data = {
                                    <?php  $_smarty_tpl->tpl_vars["graph"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["graph"]->_loop = false;
 $_smarty_tpl->tpl_vars["chart"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['graphs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["graph"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["graph"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["graph"]->key => $_smarty_tpl->tpl_vars["graph"]->value) {
$_smarty_tpl->tpl_vars["graph"]->_loop = true;
 $_smarty_tpl->tpl_vars["chart"]->value = $_smarty_tpl->tpl_vars["graph"]->key;
 $_smarty_tpl->tpl_vars["graph"]->iteration++;
 $_smarty_tpl->tpl_vars["graph"]->last = $_smarty_tpl->tpl_vars["graph"]->iteration === $_smarty_tpl->tpl_vars["graph"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["graphs"]['last'] = $_smarty_tpl->tpl_vars["graph"]->last;
?>
                                    '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['chart']->value, ENT_QUOTES, 'UTF-8');?>
': [
                                        <?php  $_smarty_tpl->tpl_vars["data"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["data"]->_loop = false;
 $_smarty_tpl->tpl_vars["date"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['graph']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["data"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["data"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["data"]->key => $_smarty_tpl->tpl_vars["data"]->value) {
$_smarty_tpl->tpl_vars["data"]->_loop = true;
 $_smarty_tpl->tpl_vars["date"]->value = $_smarty_tpl->tpl_vars["data"]->key;
 $_smarty_tpl->tpl_vars["data"]->iteration++;
 $_smarty_tpl->tpl_vars["data"]->last = $_smarty_tpl->tpl_vars["data"]->iteration === $_smarty_tpl->tpl_vars["data"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["graph"]['last'] = $_smarty_tpl->tpl_vars["data"]->last;
?>
                                        [<?php if ($_smarty_tpl->tpl_vars['is_day']->value) {?>[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['date']->value, ENT_QUOTES, 'UTF-8');?>
, 0, 0, 0]<?php } else { ?>new Date(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['date']->value, ENT_QUOTES, 'UTF-8');?>
)<?php }?>, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['prev'], ENT_QUOTES, 'UTF-8');?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data']->value['cur'], ENT_QUOTES, 'UTF-8');?>
]<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['graph']['last']) {?>,<?php }?>
                                        <?php } ?>
                                    ]<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['graphs']['last']) {?>,<?php }?>
                                    <?php } ?>
                                };
                                Tygh.drawChart(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['is_day']->value, ENT_QUOTES, 'UTF-8');?>
);
                            <?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                            <!--statistics_tabs--></div>
                    </div>
                <?php }?>
                <?php if (!empty($_smarty_tpl->tpl_vars['order_statuses']->value)) {?>
                    <div class="dashboard-recent-orders cm-j-tabs tabs">
                        <h4><?php echo $_smarty_tpl->__("recent_orders");?>
</h4>
                        <ul class="nav nav-pills">
                            <li id="tab_recent_all" class="active cm-js"><a href="#status_all" data-toggle="tab"><?php echo $_smarty_tpl->__("all");?>
</a></li>
                            <?php  $_smarty_tpl->tpl_vars["status"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["status"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_statuses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["status"]->key => $_smarty_tpl->tpl_vars["status"]->value) {
$_smarty_tpl->tpl_vars["status"]->_loop = true;
?>
                                <li id="tab_recent_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['status']->value['status'], ENT_QUOTES, 'UTF-8');?>
" class="cm-js"><a href="#status_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['status']->value['status'], ENT_QUOTES, 'UTF-8');?>
" data-toggle="tab"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['status']->value['description'], ENT_QUOTES, 'UTF-8');?>
</a></li>
                            <?php } ?>
                        </ul>

                        <div class="cm-tabs-content">
                            <div class="tab-pane" id="content_tab_recent_all">
                                <?php smarty_template_function_get_orders($_smarty_tpl,array('status'=>''));?>

                            </div>
                            <?php  $_smarty_tpl->tpl_vars["status"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["status"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_statuses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["status"]->key => $_smarty_tpl->tpl_vars["status"]->value) {
$_smarty_tpl->tpl_vars["status"]->_loop = true;
?>
                                <div class="tab-pane" id="content_tab_recent_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['status']->value['status'], ENT_QUOTES, 'UTF-8');?>
">
                                    <?php smarty_template_function_get_orders($_smarty_tpl,array('status'=>$_smarty_tpl->tpl_vars['status']->value['status']));?>

                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php }?>
            </div>

            <div class="dashboard-row-bottom">
                <div class="dashboard-tables">

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:order_statistic")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:order_statistic"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:order_statistic"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:order_by_statuses")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:order_by_statuses"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <?php if ($_smarty_tpl->tpl_vars['user_can_view_orders']->value&&$_smarty_tpl->tpl_vars['order_by_statuses']->value) {?>
                        <div class="dashboard-table dashboard-table-order-by-statuses">
                            <h4><?php echo $_smarty_tpl->__("order_by_status");?>
</h4>
                            <div class="table-wrap" id="dashboard_order_by_status">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th width="25%"><?php echo $_smarty_tpl->__("status");?>
</th>
                                        <th width="25%"><?php echo $_smarty_tpl->__("qty");?>
</th>
                                        <th width="25%"><?php echo $_smarty_tpl->__('total');?>
</th>
                                        <th width="25%"><?php echo $_smarty_tpl->__("shipping");?>
</th>
                                    </tr>
                                    </thead>
                                </table>
                                <div class="scrollable-table">
                                    <table class="table table-striped">
                                        <tbody>
                                        <?php  $_smarty_tpl->tpl_vars["order_status"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["order_status"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_by_statuses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["order_status"]->key => $_smarty_tpl->tpl_vars["order_status"]->value) {
$_smarty_tpl->tpl_vars["order_status"]->_loop = true;
?>
                                            <?php $_smarty_tpl->tpl_vars['url'] = new Smarty_variable(fn_url("orders.manage?is_search=Y&period=C&time_from=".((string)$_smarty_tpl->tpl_vars['time_from']->value)."&time_to=".((string)$_smarty_tpl->tpl_vars['time_to']->value)."&status[]=".((string)$_smarty_tpl->tpl_vars['order_status']->value['status'])), null, 0);?>
                                            <tr>
                                                <td width="25%"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['url']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order_status']->value['status_name'], ENT_QUOTES, 'UTF-8');?>
</a></td>
                                                <td width="25%"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order_status']->value['count'], ENT_QUOTES, 'UTF-8');?>
</td>
                                                <td width="25%"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['order_status']->value['total']), 0);?>
</td>
                                                <td width="25%"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['order_status']->value['shipping']), 0);?>
</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!--dashboard_order_by_status--></div>
                        </div>
                    <?php }?>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:order_by_statuses"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </div>

                <?php if ($_smarty_tpl->tpl_vars['logs']->value&&fn_check_view_permissions("logs.manage","GET")) {?>
                    <div class="dashboard-activity">
                        <div class="pull-right"><a href="<?php echo htmlspecialchars(fn_url("logs.manage"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__('show_all');?>
</a></div>
                        <h4><?php echo $_smarty_tpl->__("recent_activity");?>
</h4>
                        <?php if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\block.hook.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\modifier.date_format.php';
?><?php if (!function_exists('smarty_template_function_show_log_row')) {
    function smarty_template_function_show_log_row($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['show_log_row']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
                            <?php if ($_smarty_tpl->tpl_vars['item']->value) {?>
                                <div class="item">
                                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:recent_activity")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:recent_activity"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                                    <?php $_smarty_tpl->tpl_vars['_type'] = new Smarty_variable("log_type_".((string)$_smarty_tpl->tpl_vars['item']->value['type']), null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['_action'] = new Smarty_variable("log_action_".((string)$_smarty_tpl->tpl_vars['item']->value['action']), null, 0);?>

                                    <?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['_type']->value);
if ($_smarty_tpl->tpl_vars['item']->value['action']) {?>&nbsp;(<?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['_action']->value);?>
)<?php }?>:

                                    <?php if ($_smarty_tpl->tpl_vars['item']->value['type']=="users"&&fn_check_view_permissions(fn_url("profiles.update?user_id=".((string)$_smarty_tpl->tpl_vars['item']->value['content']['id'])),"GET")) {?>
                                        <?php if ($_smarty_tpl->tpl_vars['item']->value['content']['id']) {?><a href="<?php echo htmlspecialchars(fn_url("profiles.update?user_id=".((string)$_smarty_tpl->tpl_vars['item']->value['content']['id'])), ENT_QUOTES, 'UTF-8');?>
"><?php }
echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['content']['user'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['item']->value['content']['id']) {?></a><?php }?><br>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['type']=="orders"&&fn_check_view_permissions(fn_url("orders.details?order_id=".((string)$_smarty_tpl->tpl_vars['item']->value['content']['id'])),"GET")) {?>
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['content']['status'], ENT_QUOTES, 'UTF-8');?>
<br>
                                        <a href="<?php echo htmlspecialchars(fn_url("orders.details?order_id=".((string)$_smarty_tpl->tpl_vars['item']->value['content']['id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("order");?>
&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['content']['order'], ENT_QUOTES, 'UTF-8');?>
</a><br>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['type']=="products"&&fn_check_view_permissions(fn_url("products.update?product_id=".((string)$_smarty_tpl->tpl_vars['item']->value['content']['id'])),"GET")) {?>
                                        <a href="<?php echo htmlspecialchars(fn_url("products.update?product_id=".((string)$_smarty_tpl->tpl_vars['item']->value['content']['id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['content']['product'], ENT_QUOTES, 'UTF-8');?>
</a><br>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['item']->value['type']=="categories"&&fn_check_view_permissions(fn_url("categories.update?category_id=".((string)$_smarty_tpl->tpl_vars['item']->value['content']['id'])),"GET")) {?>
                                        <a href="<?php echo htmlspecialchars(fn_url("categories.update?category_id=".((string)$_smarty_tpl->tpl_vars['item']->value['content']['id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['content']['category'], ENT_QUOTES, 'UTF-8');?>
</a><br>
                                    <?php }?>

                                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:recent_activity_item")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:recent_activity_item"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:recent_activity_item"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                                        <span class="date"><?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['timestamp'],((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['date_format']).", ".((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['time_format'])), ENT_QUOTES, 'UTF-8');?>
</span>
                                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:recent_activity"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                </div>
                            <?php }?>
                        <?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


                        <div class="dashboard-activity-list">
                            <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['logs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value) {
$_smarty_tpl->tpl_vars["item"]->_loop = true;
?>
                                <?php smarty_template_function_show_log_row($_smarty_tpl,array('item'=>$_smarty_tpl->tpl_vars['item']->value));?>

                            <?php } ?>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
        <!--dashboard--></div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:index"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/daterange_picker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"dashboard_date_picker",'extra_class'=>"pull-right",'data_url'=>fn_url("index.index"),'result_ids'=>"dashboard",'start_date'=>$_smarty_tpl->tpl_vars['time_from']->value,'end_date'=>$_smarty_tpl->tpl_vars['time_to']->value), 0);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }} ?>
