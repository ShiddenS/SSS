<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 12:50:46
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\common\product_data.tpl" */ ?>
<?php /*%%SmartyHeaderCode:542603105db2c576232785-97602710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9786063284c0be5a62f527e7423b06e610ec962f' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\common\\product_data.tpl',
      1 => 1571056101,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '542603105db2c576232785-97602710',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'product' => 0,
    'settings' => 0,
    'auth' => 0,
    'show_price_values' => 0,
    'show_qty' => 0,
    'obj_id' => 0,
    'show_sku_label' => 0,
    'show_amount_label' => 0,
    'config' => 0,
    'no_ajax' => 0,
    'hide_form' => 0,
    'obj_prefix' => 0,
    'is_ajax' => 0,
    'form_meta' => 0,
    'stay_in_cart' => 0,
    'redirect_url' => 0,
    'no_capture' => 0,
    'capture_name' => 0,
    'show_name' => 0,
    'hide_links' => 0,
    'show_trunc_name' => 0,
    'show_sku' => 0,
    'show_add_to_cart' => 0,
    'add_to_cart_class' => 0,
    'show_list_buttons' => 0,
    'but_role' => 0,
    'quick_view' => 0,
    'show_product_options' => 0,
    'details_page' => 0,
    'opt_but_role' => 0,
    'extra_button' => 0,
    '_but_id' => 0,
    'block_width' => 0,
    'add_to_cart_meta' => 0,
    'product_amount' => 0,
    'out_of_stock_text' => 0,
    'product_notification_enabled' => 0,
    'ldelim' => 0,
    'rdelim' => 0,
    'product_notification_email' => 0,
    'compare_product_id' => 0,
    'capture_buy_now' => 0,
    'show_features' => 0,
    'show_descr' => 0,
    'show_old_price' => 0,
    'show_price' => 0,
    'hide_add_to_cart_button' => 0,
    'currencies' => 0,
    'base_currency' => 0,
    'show_clean_price' => 0,
    'show_list_discount' => 0,
    'show_discount_label' => 0,
    'product_labels_position' => 0,
    'show_product_labels' => 0,
    'show_shipping_label' => 0,
    'product_labels_mini' => 0,
    'product_labels_static' => 0,
    'product_labels_rounded' => 0,
    'label_text' => 0,
    'capture_product_labels' => 0,
    'show_product_amount' => 0,
    'disable_ids' => 0,
    'capture_options_vs_qty' => 0,
    '_disable_ids' => 0,
    'cart_button_exists' => 0,
    'hide_qty_label' => 0,
    'quantity_text' => 0,
    'a_name' => 0,
    'var' => 0,
    'selected_amount' => 0,
    'default_amount' => 0,
    'bulk_add' => 0,
    'min_qty' => 0,
    'show_edp' => 0,
    'images' => 0,
    'image' => 0,
    'object_id' => 0,
    'product_link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2c576d523b1_61458681',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2c576d523b1_61458681')) {function content_5db2c576d523b1_61458681($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.enum.php';
if (!is_callable('smarty_function_live_edit')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.live_edit.php';
if (!is_callable('smarty_modifier_truncate')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.truncate.php';
if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('text_combination_out_of_stock','text_out_of_stock','sku','select_options','notify_when_back_in_stock','email','enter_email','enter_email','go','old_price','list_price','enter_your_price','contact_us_for_price','sign_in_to_view_price','inc_tax','including_tax','you_save','you_save','save_discount','free_shipping','save_discount','save_discount','availability','items','on_backorder','in_stock','availability','in_stock','on_backorder','availability','quantity','text_cart_min_qty','text_edp_product','text_combination_out_of_stock','text_out_of_stock','sku','select_options','notify_when_back_in_stock','email','enter_email','enter_email','go','old_price','list_price','enter_your_price','contact_us_for_price','sign_in_to_view_price','inc_tax','including_tax','you_save','you_save','save_discount','free_shipping','save_discount','save_discount','availability','items','on_backorder','in_stock','availability','in_stock','on_backorder','availability','quantity','text_cart_min_qty','text_edp_product'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_data_content")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_data_content"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if ($_smarty_tpl->tpl_vars['product']->value['tracking']==smarty_modifier_enum("ProductTracking::TRACK_WITH_OPTIONS")) {?>
    <?php $_smarty_tpl->tpl_vars["out_of_stock_text"] = new Smarty_variable($_smarty_tpl->__("text_combination_out_of_stock"), null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["out_of_stock_text"] = new Smarty_variable($_smarty_tpl->__("text_out_of_stock"), null, 0);?>
<?php }?>

<?php if ((floatval($_smarty_tpl->tpl_vars['product']->value['price'])||$_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="P"||$_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="A"||(!floatval($_smarty_tpl->tpl_vars['product']->value['price'])&&$_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="R"))&&!($_smarty_tpl->tpl_vars['settings']->value['Checkout']['allow_anonymous_shopping']=="hide_price_and_add_to_cart"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id'])) {?>
    <?php $_smarty_tpl->tpl_vars["show_price_values"] = new Smarty_variable(true, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["show_price_values"] = new Smarty_variable(false, null, 0);?>
<?php }?>
<?php $_smarty_tpl->_capture_stack[0][] = array("show_price_values", null, null); ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['show_price_values']->value, ENT_QUOTES, 'UTF-8');
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->tpl_vars["cart_button_exists"] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_qty"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['show_qty']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["obj_id"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['obj_id']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['product']->value['product_id'] : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["product_amount"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['product']->value['inventory_amount'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['product']->value['amount'] : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_sku_label"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['show_sku_label']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_amount_label"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['show_amount_label']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php if (!$_smarty_tpl->tpl_vars['config']->value['tweaks']['disable_dhtml']&&!$_smarty_tpl->tpl_vars['no_ajax']->value) {?>
    <?php $_smarty_tpl->tpl_vars["is_ajax"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("form_open_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php if (!$_smarty_tpl->tpl_vars['hide_form']->value) {?>
<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="product_form_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" enctype="multipart/form-data" class="cm-disable-empty-files <?php if ($_smarty_tpl->tpl_vars['is_ajax']->value) {?> cm-ajax cm-ajax-full-render cm-ajax-status-middle<?php }?> <?php if ($_smarty_tpl->tpl_vars['form_meta']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['form_meta']->value, ENT_QUOTES, 'UTF-8');
}?>">
<input type="hidden" name="result_ids" value="cart_status*,wish_list*,checkout*,account_info*" />
<?php if (!$_smarty_tpl->tpl_vars['stay_in_cart']->value) {?>
<input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['redirect_url']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['config']->value['current_url'] : $tmp), ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>
<input type="hidden" name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][product_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("form_open_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("name_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_name")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_name"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if ($_smarty_tpl->tpl_vars['show_name']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['hide_links']->value) {?><strong><?php } else { ?><a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
" class="product-title" title="<?php echo htmlspecialchars(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['product']), ENT_QUOTES, 'UTF-8');?>
" <?php echo smarty_function_live_edit(array('name'=>"product:product:".((string)$_smarty_tpl->tpl_vars['product']->value['product_id']),'phrase'=>$_smarty_tpl->tpl_vars['product']->value['product']),$_smarty_tpl);?>
><?php }
echo $_smarty_tpl->tpl_vars['product']->value['product'];
if ($_smarty_tpl->tpl_vars['hide_links']->value) {?></strong><?php } else { ?></a><?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['show_trunc_name']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['hide_links']->value) {?><strong><?php } else { ?><a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
" class="product-title" title="<?php echo htmlspecialchars(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['product']), ENT_QUOTES, 'UTF-8');?>
" <?php echo smarty_function_live_edit(array('name'=>"product:product:".((string)$_smarty_tpl->tpl_vars['product']->value['product_id']),'phrase'=>$_smarty_tpl->tpl_vars['product']->value['product']),$_smarty_tpl);?>
><?php }
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['product'],44,"...",true);
if ($_smarty_tpl->tpl_vars['hide_links']->value) {?></strong><?php } else { ?></a><?php }?>
    <?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_name"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("name_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("sku_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_sku']->value) {?>
        <div class="ty-control-group ty-sku-item cm-hidden-wrapper<?php if (!$_smarty_tpl->tpl_vars['product']->value['product_code']) {?> hidden<?php }?>" id="sku_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="appearance[show_sku]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_sku']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <?php if ($_smarty_tpl->tpl_vars['show_sku_label']->value) {?>
                <label class="ty-control-group__label" id="sku_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("sku");?>
:</label>
            <?php }?>
            <span class="ty-control-group__item cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_code_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_code'], ENT_QUOTES, 'UTF-8');?>
<!--product_code_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
        </div>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("sku_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("rating_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:data_block")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:data_block"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:data_block"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("rating_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("add_to_cart_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php if ($_smarty_tpl->tpl_vars['show_add_to_cart']->value) {?>
<div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['add_to_cart_class']->value, ENT_QUOTES, 'UTF-8');?>
" id="add_to_cart_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
<input type="hidden" name="appearance[show_add_to_cart]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_add_to_cart']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="appearance[show_list_buttons]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_list_buttons']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="appearance[but_role]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['but_role']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="appearance[quick_view]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['quick_view']->value, ENT_QUOTES, 'UTF-8');?>
" />

<?php $_smarty_tpl->_capture_stack[0][] = array("buttons_product", null, null); ob_start();
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:add_to_cart")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:add_to_cart"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
if ($_smarty_tpl->tpl_vars['product']->value['has_options']&&!$_smarty_tpl->tpl_vars['show_product_options']->value&&!$_smarty_tpl->tpl_vars['details_page']->value) {
if ($_smarty_tpl->tpl_vars['but_role']->value=="text") {
$_smarty_tpl->tpl_vars['opt_but_role'] = new Smarty_variable("text", null, 0);
} else {
$_smarty_tpl->tpl_vars['opt_but_role'] = new Smarty_variable("action", null, 0);
}
echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_id'=>"button_cart_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'but_text'=>$_smarty_tpl->__("select_options"),'but_href'=>"products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id']),'but_role'=>$_smarty_tpl->tpl_vars['opt_but_role']->value,'but_name'=>'','but_meta'=>"ty-btn__primary ty-btn__big"), 0);
} else {
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:add_to_cart_but_id")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:add_to_cart_but_id"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_smarty_tpl->tpl_vars['_but_id'] = new Smarty_variable("button_cart_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:add_to_cart_but_id"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
if ($_smarty_tpl->tpl_vars['extra_button']->value) {
echo $_smarty_tpl->tpl_vars['extra_button']->value;?>
&nbsp;<?php }
echo $_smarty_tpl->getSubTemplate ("buttons/add_to_cart.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_id'=>$_smarty_tpl->tpl_vars['_but_id']->value,'but_name'=>"dispatch[checkout.add..".((string)$_smarty_tpl->tpl_vars['obj_id']->value)."]",'but_role'=>$_smarty_tpl->tpl_vars['but_role']->value,'block_width'=>$_smarty_tpl->tpl_vars['block_width']->value,'obj_id'=>$_smarty_tpl->tpl_vars['obj_id']->value,'product'=>$_smarty_tpl->tpl_vars['product']->value,'but_meta'=>$_smarty_tpl->tpl_vars['add_to_cart_meta']->value), 0);
$_smarty_tpl->tpl_vars["cart_button_exists"] = new Smarty_variable(true, null, 0);
}
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:add_to_cart"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:buttons_block")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:buttons_block"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
if (($_smarty_tpl->tpl_vars['product']->value['zero_price_action']!="R"||$_smarty_tpl->tpl_vars['product']->value['price']!=0)&&($_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']!="Y"||$_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']=="Y"||($_smarty_tpl->tpl_vars['product_amount']->value>0&&$_smarty_tpl->tpl_vars['product_amount']->value>=$_smarty_tpl->tpl_vars['product']->value['min_qty'])||$_smarty_tpl->tpl_vars['product']->value['tracking']==smarty_modifier_enum("ProductTracking::DO_NOT_TRACK")||$_smarty_tpl->tpl_vars['product']->value['is_edp']=="Y"||$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::BUY_IN_ADVANCE"))||($_smarty_tpl->tpl_vars['product']->value['has_options']&&!$_smarty_tpl->tpl_vars['show_product_options']->value)) {
if (trim(Smarty::$_smarty_vars['capture']['buttons_product'])!='&nbsp;') {
if ($_smarty_tpl->tpl_vars['product']->value['avail_since']<=@constant('TIME')||($_smarty_tpl->tpl_vars['product']->value['avail_since']>@constant('TIME')&&$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::BUY_IN_ADVANCE"))) {
echo Smarty::$_smarty_vars['capture']['buttons_product'];
}
}
} elseif (($_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"&&$_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']!="Y"&&(($_smarty_tpl->tpl_vars['product_amount']->value<=0||$_smarty_tpl->tpl_vars['product_amount']->value<$_smarty_tpl->tpl_vars['product']->value['min_qty'])&&$_smarty_tpl->tpl_vars['product']->value['tracking']!=smarty_modifier_enum("ProductTracking::DO_NOT_TRACK"))&&$_smarty_tpl->tpl_vars['product']->value['is_edp']!="Y")) {
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:out_of_stock_block")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:out_of_stock_block"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_smarty_tpl->tpl_vars["show_qty"] = new Smarty_variable(false, null, 0);
if (!$_smarty_tpl->tpl_vars['details_page']->value) {
if ((!$_smarty_tpl->tpl_vars['product']->value['hide_stock_info']&&!(($_smarty_tpl->tpl_vars['product_amount']->value<=0||$_smarty_tpl->tpl_vars['product_amount']->value<$_smarty_tpl->tpl_vars['product']->value['min_qty'])&&($_smarty_tpl->tpl_vars['product']->value['avail_since']>@constant('TIME'))))) {?><span class="ty-qty-out-of-stock ty-control-group__item" id="out_of_stock_info_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['out_of_stock_text']->value, ENT_QUOTES, 'UTF-8');?>
</span><?php }
} elseif ((($_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::SUBSCRIBE"))&&($_smarty_tpl->tpl_vars['product']->value['tracking']!=smarty_modifier_enum("ProductTracking::TRACK_WITH_OPTIONS")))) {
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"product_data:back_in_stock_checkbox")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"product_data:back_in_stock_checkbox"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<div class="ty-control-group"><label for="sw_product_notify_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="ty-strong" id="label_sw_product_notify_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><input id="sw_product_notify_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" type="checkbox" class="checkbox cm-switch-availability cm-switch-visibility" name="product_notify" <?php if ($_smarty_tpl->tpl_vars['product_notification_enabled']->value=="Y") {?>checked="checked"<?php }?> onclick="<?php if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']) {?>if (!this.checked) {Tygh.$.ceAjax('request', '<?php echo htmlspecialchars(fn_url("products.product_notifications?enable="), ENT_QUOTES, 'UTF-8');?>
' + 'N&amp;product_id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
&amp;email=' + $('#product_notify_email_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
').get(0).value, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ldelim']->value, ENT_QUOTES, 'UTF-8');?>
cache: false<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rdelim']->value, ENT_QUOTES, 'UTF-8');?>
);}<?php } else { ?>Tygh.$.ceAjax('request', '<?php echo htmlspecialchars(fn_url("products.product_notifications?enable="), ENT_QUOTES, 'UTF-8');?>
' + (this.checked ? 'Y' : 'N') + '&amp;product_id=' + '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
', <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ldelim']->value, ENT_QUOTES, 'UTF-8');?>
cache: false<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rdelim']->value, ENT_QUOTES, 'UTF-8');?>
);<?php }?>"/><?php echo $_smarty_tpl->__("notify_when_back_in_stock");?>
</label></div><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"product_data:back_in_stock_checkbox"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']) {?><div class="ty-control-group ty-input-append ty-product-notify-email <?php if ($_smarty_tpl->tpl_vars['product_notification_enabled']->value!="Y") {?>hidden<?php }?>" id="product_notify_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><input type="hidden" name="enable" value="Y" disabled /><input type="hidden" name="product_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
" disabled /><label id="product_notify_email_label" for="product_notify_email_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-required cm-email hidden"><?php echo $_smarty_tpl->__("email");?>
</label><input type="text" name="email" id="product_notify_email_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" size="20" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['product_notification_email']->value)===null||$tmp==='' ? $_smarty_tpl->__("enter_email") : $tmp), ENT_QUOTES, 'UTF-8');?>
" class="ty-product-notify-email__input cm-hint" title="<?php echo $_smarty_tpl->__("enter_email");?>
" disabled /><button class="ty-btn-go cm-ajax" type="submit" name="dispatch[products.product_notifications]" title="<?php echo $_smarty_tpl->__("go");?>
"><i class="ty-btn-go__icon ty-icon-right-dir"></i></button></div><?php }
}
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:out_of_stock_block"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
}
if ($_smarty_tpl->tpl_vars['show_list_buttons']->value) {
$_smarty_tpl->_capture_stack[0][] = array("product_buy_now_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start();
$_smarty_tpl->tpl_vars['compare_product_id'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_id'], null, 0);
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:buy_now")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:buy_now"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
if ($_smarty_tpl->tpl_vars['settings']->value['General']['enable_compare_products']=="Y") {
echo $_smarty_tpl->getSubTemplate ("buttons/add_to_compare_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_id'=>$_smarty_tpl->tpl_vars['compare_product_id']->value), 0);
}
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:buy_now"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
$_smarty_tpl->tpl_vars["capture_buy_now"] = new Smarty_variable("product_buy_now_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);
if (trim(Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_buy_now']->value])) {
echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_buy_now']->value];
}
}
if (($_smarty_tpl->tpl_vars['product']->value['avail_since']>@constant('TIME'))) {
echo $_smarty_tpl->getSubTemplate ("common/coming_soon_notice.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('avail_date'=>$_smarty_tpl->tpl_vars['product']->value['avail_since'],'add_to_cart'=>$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']), 0);
}
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:buttons_block"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<!--add_to_cart_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if (Smarty::$_smarty_vars['capture']['cart_button_exists']) {?>
    <?php $_smarty_tpl->tpl_vars["cart_button_exists"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("add_to_cart_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("product_features_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_features")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_features"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if ($_smarty_tpl->tpl_vars['show_features']->value) {?>
        <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_features_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="appearance[show_features]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_features']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_features_short_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('features'=>fn_get_product_features_list($_smarty_tpl->tpl_vars['product']->value),'no_container'=>true), 0);?>

        <!--product_features_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
    <?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_features"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("product_features_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("prod_descr_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_descr']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['product']->value['short_description']) {?>
            <div <?php echo smarty_function_live_edit(array('name'=>"product:short_description:".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])),$_smarty_tpl);?>
><?php echo $_smarty_tpl->tpl_vars['product']->value['short_description'];?>
</div>
        <?php } else { ?>
            <div <?php echo smarty_function_live_edit(array('name'=>"product:full_description:".((string)$_smarty_tpl->tpl_vars['product']->value['product_id']),'phrase'=>$_smarty_tpl->tpl_vars['product']->value['full_description']),$_smarty_tpl);?>
><?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['full_description']),160);?>
</div>
        <?php }?>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("prod_descr_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array("old_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_price_values']->value&&$_smarty_tpl->tpl_vars['show_old_price']->value) {?>
        <span class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="old_price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:old_price")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:old_price"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if ($_smarty_tpl->tpl_vars['product']->value['discount']) {?>
                <span class="ty-list-price ty-nowrap" id="line_old_price_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php if ($_smarty_tpl->tpl_vars['details_page']->value) {
echo $_smarty_tpl->__("old_price");?>
: <?php }?><span class="ty-strike"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>(($tmp = @$_smarty_tpl->tpl_vars['product']->value['original_price'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['product']->value['base_price'] : $tmp),'span_id'=>"old_price_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'class'=>"ty-list-price ty-nowrap"), 0);?>
</span></span>
            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['list_discount']) {?>
                <span class="ty-list-price ty-nowrap" id="line_list_price_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php if ($_smarty_tpl->tpl_vars['details_page']->value) {?><span class="list-price-label"><?php echo $_smarty_tpl->__("list_price");?>
:</span> <?php }?><span class="ty-strike"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['list_price'],'span_id'=>"list_price_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'class'=>"ty-list-price ty-nowrap"), 0);?>
</span></span>
            <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:old_price"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <!--old_price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("old_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array("price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <span class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
 ty-price-update" id="price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <input type="hidden" name="appearance[show_price_values]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_price_values']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <input type="hidden" name="appearance[show_price]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_price']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <?php if ($_smarty_tpl->tpl_vars['show_price_values']->value) {?>
            <?php if ($_smarty_tpl->tpl_vars['show_price']->value) {?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:prices_block")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:prices_block"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php if (floatval($_smarty_tpl->tpl_vars['product']->value['price'])||$_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="P"||($_smarty_tpl->tpl_vars['hide_add_to_cart_button']->value=="Y"&&$_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="A")) {?>
                    <span class="ty-price<?php if (!floatval($_smarty_tpl->tpl_vars['product']->value['price'])&&!$_smarty_tpl->tpl_vars['product']->value['zero_price_action']) {?> hidden<?php }?>" id="line_discounted_price_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['price'],'span_id'=>"discounted_price_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'class'=>"ty-price-num",'live_editor_name'=>"product:price:".((string)$_smarty_tpl->tpl_vars['product']->value['product_id']),'live_editor_phrase'=>$_smarty_tpl->tpl_vars['product']->value['base_price']), 0);?>
</span>
                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="A"&&$_smarty_tpl->tpl_vars['show_add_to_cart']->value) {?>
                    <?php $_smarty_tpl->tpl_vars["base_currency"] = new Smarty_variable($_smarty_tpl->tpl_vars['currencies']->value[@constant('CART_PRIMARY_CURRENCY')], null, 0);?>
                    <span class="ty-price-curency"><span class="ty-price-curency__title"><?php echo $_smarty_tpl->__("enter_your_price");?>
:</span>
                    <div class="ty-price-curency-input">
                        <?php if ($_smarty_tpl->tpl_vars['base_currency']->value['after']!="Y") {
echo $_smarty_tpl->tpl_vars['base_currency']->value['symbol'];
}?>
                        <input class="ty-price-curency__input" type="text" size="3" name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][price]" value="" />
                        <?php if ($_smarty_tpl->tpl_vars['base_currency']->value['after']=="Y") {
echo $_smarty_tpl->tpl_vars['base_currency']->value['symbol'];
}?>
                    </div>
                    </span>

                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="R") {?>
                    <span class="ty-no-price"><?php echo $_smarty_tpl->__("contact_us_for_price");?>
</span>
                    <?php $_smarty_tpl->tpl_vars["show_qty"] = new Smarty_variable(false, null, 0);?>
                <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:prices_block"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php }?>
        <?php } elseif ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['allow_anonymous_shopping']=="hide_price_and_add_to_cart"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id']) {?>
            <span class="ty-price"><?php echo $_smarty_tpl->__("sign_in_to_view_price");?>
</span>
        <?php }?>
    <!--price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array("clean_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_price_values']->value&&$_smarty_tpl->tpl_vars['show_clean_price']->value&&$_smarty_tpl->tpl_vars['settings']->value['Appearance']['show_prices_taxed_clean']=="Y"&&$_smarty_tpl->tpl_vars['product']->value['taxed_price']) {?>
        <span class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="clean_price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="appearance[show_price_values]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_price_values']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <input type="hidden" name="appearance[show_clean_price]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_clean_price']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <?php if ($_smarty_tpl->tpl_vars['product']->value['clean_price']!=$_smarty_tpl->tpl_vars['product']->value['taxed_price']&&$_smarty_tpl->tpl_vars['product']->value['included_tax']) {?>
                <span class="ty-list-price ty-nowrap" id="line_product_price_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">(<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['taxed_price'],'span_id'=>"product_price_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'class'=>"ty-list-price ty-nowrap"), 0);?>
 <?php echo $_smarty_tpl->__("inc_tax");?>
)</span>
            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['clean_price']!=$_smarty_tpl->tpl_vars['product']->value['taxed_price']&&!$_smarty_tpl->tpl_vars['product']->value['included_tax']) {?>
                <span class="ty-list-price ty-nowrap ty-tax-include">(<?php echo $_smarty_tpl->__("including_tax");?>
)</span>
            <?php }?>
        <!--clean_price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("clean_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array("list_discount_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_price_values']->value&&$_smarty_tpl->tpl_vars['show_list_discount']->value&&$_smarty_tpl->tpl_vars['details_page']->value) {?>
        <span class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="line_discount_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="appearance[show_price_values]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_price_values']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <input type="hidden" name="appearance[show_list_discount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_list_discount']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <?php if ($_smarty_tpl->tpl_vars['product']->value['discount']) {?>
                <span class="ty-list-price ty-save-price ty-nowrap" id="line_discount_value_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("you_save");?>
: <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['discount'],'span_id'=>"discount_value_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'class'=>"ty-list-price ty-nowrap"), 0);?>
<span class="ty-save-price__percent">&nbsp;(<span id="prc_discount_value_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="ty-list-price ty-nowrap"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['discount_prc'], ENT_QUOTES, 'UTF-8');?>
</span>%)</span></span>
            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['list_discount']) {?>
                <span class="ty-list-price ty-save-price ty-nowrap" id="line_discount_value_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"> <?php echo $_smarty_tpl->__("you_save");?>
: <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['list_discount'],'span_id'=>"discount_value_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value)), 0);?>
<span class="ty-save-price__percent">&nbsp;(<span id="prc_discount_value_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['list_discount_prc'], ENT_QUOTES, 'UTF-8');?>
</span>%)</span></span>
            <?php }?>
        <!--line_discount_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("list_discount_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array("discount_label_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_discount_label']->value&&($_smarty_tpl->tpl_vars['product']->value['discount_prc']||$_smarty_tpl->tpl_vars['product']->value['list_discount_prc'])&&$_smarty_tpl->tpl_vars['show_price_values']->value) {?>
        <span class="ty-discount-label cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="discount_label_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <span class="ty-discount-label__item" id="line_prc_discount_value_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><span class="ty-discount-label__value" id="prc_discount_value_label_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("save_discount");?>
 <?php if ($_smarty_tpl->tpl_vars['product']->value['discount']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['discount_prc'], ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['list_discount_prc'], ENT_QUOTES, 'UTF-8');
}?>%</span></span>
        <!--discount_label_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("discount_label_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->tpl_vars['product_labels_position'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['product_labels_position']->value)===null||$tmp==='' ? "top-right" : $tmp), null, 0);?>

<?php $_smarty_tpl->_capture_stack[0][] = array("product_labels_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_product_labels']->value) {?>
        <?php $_smarty_tpl->_capture_stack[0][] = array("capture_product_labels_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_labels")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_labels"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if ($_smarty_tpl->tpl_vars['show_shipping_label']->value&&$_smarty_tpl->tpl_vars['product']->value['free_shipping']=="Y") {?>
                <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_label.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('label_meta'=>"ty-product-labels__item--shipping",'label_text'=>$_smarty_tpl->__("free_shipping"),'label_mini'=>$_smarty_tpl->tpl_vars['product_labels_mini']->value,'label_static'=>$_smarty_tpl->tpl_vars['product_labels_static']->value,'label_rounded'=>$_smarty_tpl->tpl_vars['product_labels_rounded']->value), 0);?>

            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['show_discount_label']->value&&($_smarty_tpl->tpl_vars['product']->value['discount_prc']||$_smarty_tpl->tpl_vars['product']->value['list_discount_prc'])&&$_smarty_tpl->tpl_vars['show_price_values']->value) {?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['discount']) {?>
                    <?php ob_start();
echo $_smarty_tpl->__("save_discount");
$_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['label_text'] = new Smarty_variable($_tmp1." ".((string)$_smarty_tpl->tpl_vars['product']->value['discount_prc'])."%", null, 0);?>
                <?php } else { ?>
                    <?php ob_start();
echo $_smarty_tpl->__("save_discount");
$_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['label_text'] = new Smarty_variable($_tmp2." ".((string)$_smarty_tpl->tpl_vars['product']->value['list_discount_prc'])."%", null, 0);?>
                <?php }?>

                <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_label.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('label_meta'=>"ty-product-labels__item--discount",'label_text'=>$_smarty_tpl->tpl_vars['label_text']->value,'label_mini'=>$_smarty_tpl->tpl_vars['product_labels_mini']->value,'label_static'=>$_smarty_tpl->tpl_vars['product_labels_static']->value,'label_rounded'=>$_smarty_tpl->tpl_vars['product_labels_rounded']->value), 0);?>

            <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_labels"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php $_smarty_tpl->tpl_vars['capture_product_labels'] = new Smarty_variable("capture_product_labels_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>

        <?php if (trim(Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_product_labels']->value])) {?>
            <div class="ty-product-labels ty-product-labels--<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_labels_position']->value, ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['product_labels_mini']->value) {?>ty-product-labels--mini<?php }?> <?php if ($_smarty_tpl->tpl_vars['product_labels_static']->value) {?>ty-product-labels--static<?php }?> cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_labels_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_product_labels']->value];?>

            <!--product_labels_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
        <?php }?>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars['capture_name'] = new Smarty_variable("product_labels_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("product_amount_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_amount")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_amount"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if ($_smarty_tpl->tpl_vars['show_product_amount']->value&&$_smarty_tpl->tpl_vars['product']->value['is_edp']!="Y"&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y") {?>
    <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
 stock-wrap" id="product_amount_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <input type="hidden" name="appearance[show_product_amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_product_amount']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <?php if (!$_smarty_tpl->tpl_vars['product']->value['hide_stock_info']) {?>
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['in_stock_field']=="Y") {?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['tracking']!=smarty_modifier_enum("ProductTracking::DO_NOT_TRACK")) {?>
                    <?php if (($_smarty_tpl->tpl_vars['product_amount']->value>0&&$_smarty_tpl->tpl_vars['product_amount']->value>=$_smarty_tpl->tpl_vars['product']->value['min_qty'])&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"||$_smarty_tpl->tpl_vars['details_page']->value) {?>
                        <?php if (($_smarty_tpl->tpl_vars['product_amount']->value>0&&$_smarty_tpl->tpl_vars['product_amount']->value>=$_smarty_tpl->tpl_vars['product']->value['min_qty']||$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::BUY_IN_ADVANCE"))&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y") {?>
                            <div class="ty-control-group product-list-field">
                                <?php if ($_smarty_tpl->tpl_vars['show_amount_label']->value) {?>
                                    <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("availability");?>
:</label>
                                <?php }?>
                                <span id="qty_in_stock_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="ty-qty-in-stock ty-control-group__item">
                                    <?php if ($_smarty_tpl->tpl_vars['product_amount']->value>0) {?>
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_amount']->value, ENT_QUOTES, 'UTF-8');?>
&nbsp;<?php echo $_smarty_tpl->__("items");?>

                                    <?php } else { ?>
                                        <?php echo $_smarty_tpl->__("on_backorder");?>

                                    <?php }?>
                                </span>
                            </div>
                        <?php } elseif ($_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"&&$_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']!="Y") {?>
                            <div class="ty-control-group product-list-field">
                                <?php if ($_smarty_tpl->tpl_vars['show_amount_label']->value) {?>
                                    <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("in_stock");?>
:</label>
                                <?php }?>
                                <span class="ty-qty-out-of-stock ty-control-group__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['out_of_stock_text']->value, ENT_QUOTES, 'UTF-8');?>
</span>
                            </div>
                        <?php }?>
                    <?php }?>
                <?php }?>
            <?php } else { ?>
                <?php if (($_smarty_tpl->tpl_vars['product_amount']->value>0&&$_smarty_tpl->tpl_vars['product_amount']->value>=$_smarty_tpl->tpl_vars['product']->value['min_qty']||$_smarty_tpl->tpl_vars['product']->value['tracking']==smarty_modifier_enum("ProductTracking::DO_NOT_TRACK"))&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"&&$_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']!="Y"||$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"&&($_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']=="Y"||$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::BUY_IN_ADVANCE"))) {?>
                    <div class="ty-control-group product-list-field">
                        <?php if ($_smarty_tpl->tpl_vars['show_amount_label']->value) {?>
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("availability");?>
:</label>
                        <?php }?>
                        <span class="ty-qty-in-stock ty-control-group__item" id="in_stock_info_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                            <?php if ($_smarty_tpl->tpl_vars['product_amount']->value>0) {?>
                                <?php echo $_smarty_tpl->__("in_stock");?>

                            <?php } else { ?>
                                <?php echo $_smarty_tpl->__("on_backorder");?>

                            <?php }?>
                        </span>
                    </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['details_page']->value&&($_smarty_tpl->tpl_vars['product_amount']->value<=0||$_smarty_tpl->tpl_vars['product_amount']->value<$_smarty_tpl->tpl_vars['product']->value['min_qty'])&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"&&$_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']!="Y") {?>
                    <div class="ty-control-group product-list-field">
                        <?php if ($_smarty_tpl->tpl_vars['show_amount_label']->value) {?>
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("availability");?>
:</label>
                        <?php }?>
                        <span class="ty-qty-out-of-stock ty-control-group__item" id="out_of_stock_info_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['out_of_stock_text']->value, ENT_QUOTES, 'UTF-8');?>
</span>
                    </div>
                <?php }?>
            <?php }?>
        <?php }?>
    <!--product_amount_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
<?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_amount"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("product_amount_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("product_options_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_product_options']->value) {?>
    <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_options_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <input type="hidden" name="appearance[show_product_options]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_product_options']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_option_content")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_option_content"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if ($_smarty_tpl->tpl_vars['disable_ids']->value) {?>
                <?php $_smarty_tpl->tpl_vars["_disable_ids"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['disable_ids']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["_disable_ids"] = new Smarty_variable('', null, 0);?>
            <?php }?>
            <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_options.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>$_smarty_tpl->tpl_vars['obj_id']->value,'product_options'=>$_smarty_tpl->tpl_vars['product']->value['product_options'],'name'=>"product_data",'capture_options_vs_qty'=>$_smarty_tpl->tpl_vars['capture_options_vs_qty']->value,'disable_ids'=>$_smarty_tpl->tpl_vars['_disable_ids']->value), 0);?>

        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_option_content"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <!--product_options_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("product_options_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("advanced_options_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_product_options']->value) {?>
        <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="advanced_options_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/product_company_data.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('company_name'=>$_smarty_tpl->tpl_vars['product']->value['company_name'],'company_id'=>$_smarty_tpl->tpl_vars['product']->value['company_id']), 0);?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:options_advanced")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:options_advanced"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:options_advanced"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <!--advanced_options_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("advanced_options_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("qty_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:qty")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:qty"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="qty_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <input type="hidden" name="appearance[show_qty]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_qty']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <input type="hidden" name="appearance[capture_options_vs_qty]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['capture_options_vs_qty']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <?php if (!empty($_smarty_tpl->tpl_vars['product']->value['selected_amount'])) {?>
            <?php $_smarty_tpl->tpl_vars["default_amount"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['selected_amount'], null, 0);?>
        <?php } elseif (!empty($_smarty_tpl->tpl_vars['product']->value['min_qty'])) {?>
            <?php $_smarty_tpl->tpl_vars["default_amount"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['min_qty'], null, 0);?>
        <?php } elseif (!empty($_smarty_tpl->tpl_vars['product']->value['qty_step'])) {?>
            <?php $_smarty_tpl->tpl_vars["default_amount"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['qty_step'], null, 0);?>
        <?php } else { ?>
            <?php $_smarty_tpl->tpl_vars["default_amount"] = new Smarty_variable("1", null, 0);?>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['show_qty']->value&&$_smarty_tpl->tpl_vars['product']->value['is_edp']!=="Y"&&$_smarty_tpl->tpl_vars['cart_button_exists']->value==true&&($_smarty_tpl->tpl_vars['settings']->value['Checkout']['allow_anonymous_shopping']=="allow_shopping"||$_smarty_tpl->tpl_vars['auth']->value['user_id'])&&$_smarty_tpl->tpl_vars['product']->value['avail_since']<=@constant('TIME')||($_smarty_tpl->tpl_vars['product']->value['avail_since']>@constant('TIME')&&$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::BUY_IN_ADVANCE"))) {?>
            <div class="ty-qty clearfix<?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['quantity_changer']=="Y") {?> changer<?php }?>" id="qty_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                <?php if (!$_smarty_tpl->tpl_vars['hide_qty_label']->value) {?><label class="ty-control-group__label" for="qty_count_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['quantity_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("quantity") : $tmp), ENT_QUOTES, 'UTF-8');?>
:</label><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['qty_content']) {?>
                <select name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][amount]" id="qty_count_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                <?php $_smarty_tpl->tpl_vars["a_name"] = new Smarty_variable("product_amount_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["selected_amount"] = new Smarty_variable(false, null, 0);?>
                <?php  $_smarty_tpl->tpl_vars["var"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["var"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value['qty_content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["var"]->key => $_smarty_tpl->tpl_vars["var"]->value) {
$_smarty_tpl->tpl_vars["var"]->_loop = true;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['product']->value['selected_amount']&&($_smarty_tpl->tpl_vars['product']->value['selected_amount']==$_smarty_tpl->tpl_vars['var']->value||($_smarty_tpl->getVariable('smarty')->value['foreach'][$_smarty_tpl->tpl_vars['a_name']->value]['last']&&!$_smarty_tpl->tpl_vars['selected_amount']->value))) {
$_smarty_tpl->tpl_vars["selected_amount"] = new Smarty_variable(true, null, 0);?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
                </select>
                <?php } else { ?>
                <div class="ty-center ty-value-changer cm-value-changer">
                    <?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['quantity_changer']=="Y") {?>
                        <a class="cm-increase ty-value-changer__increase">&#43;</a>
                    <?php }?>
                    <input <?php if ($_smarty_tpl->tpl_vars['product']->value['qty_step']>1) {?>readonly="readonly"<?php }?> type="text" size="5" class="ty-value-changer__input cm-amount" id="qty_count_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['default_amount']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['product']->value['qty_step']>1) {?> data-ca-step="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['qty_step'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> data-ca-min-qty="<?php if ($_smarty_tpl->tpl_vars['product']->value['min_qty']>1) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['min_qty'], ENT_QUOTES, 'UTF-8');
} else { ?>1<?php }?>" />
                    <?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['quantity_changer']=="Y") {?>
                        <a class="cm-decrease ty-value-changer__decrease">&minus;</a>
                    <?php }?>
                </div>
                <?php }?>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['product']->value['prices']) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/products_qty_discounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php }?>
        <?php } elseif (!$_smarty_tpl->tpl_vars['bulk_add']->value) {?>
            <input type="hidden" name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['default_amount']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <?php }?>
        <!--qty_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:qty"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("qty_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("min_qty_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:qty_description")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:qty_description"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->tpl_vars['min_qty']->value&&$_smarty_tpl->tpl_vars['product']->value['min_qty']) {?>
            <p class="ty-min-qty-description"><?php echo $_smarty_tpl->__("text_cart_min_qty",array("[product]"=>$_smarty_tpl->tpl_vars['product']->value['product'],"[quantity]"=>$_smarty_tpl->tpl_vars['product']->value['min_qty']));?>
.</p>
        <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:qty_description"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("min_qty_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("product_edp_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_edp']->value&&$_smarty_tpl->tpl_vars['product']->value['is_edp']=="Y") {?>
        <p class="ty-edp-description"><?php echo $_smarty_tpl->__("text_edp_product");?>
.</p>
        <input type="hidden" name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][is_edp]" value="Y" />
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("product_edp_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("form_close_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php if (!$_smarty_tpl->tpl_vars['hide_form']->value) {?>
</form>
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("form_close_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php  $_smarty_tpl->tpl_vars["image"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["image"]->_loop = false;
 $_smarty_tpl->tpl_vars["object_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["image"]->key => $_smarty_tpl->tpl_vars["image"]->value) {
$_smarty_tpl->tpl_vars["image"]->_loop = true;
 $_smarty_tpl->tpl_vars["object_id"]->value = $_smarty_tpl->tpl_vars["image"]->key;
?>
<?php $_smarty_tpl->tpl_vars["product_link"] = new Smarty_variable($_smarty_tpl->tpl_vars['image']->value['link'], null, 0);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:list_images_block")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:list_images_block"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['obj_id'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <?php if ($_smarty_tpl->tpl_vars['product_link']->value) {?>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_link']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['link'], ENT_QUOTES, 'UTF-8');?>
" name="image[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
][link]" />
        <?php }?>
        <input type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['obj_id'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['width'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['height'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['type'], ENT_QUOTES, 'UTF-8');?>
" name="image[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
][data]" />
        <?php echo $_smarty_tpl->getSubTemplate ("common/image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('image_width'=>$_smarty_tpl->tpl_vars['image']->value['width'],'image_height'=>$_smarty_tpl->tpl_vars['image']->value['height'],'obj_id'=>$_smarty_tpl->tpl_vars['object_id']->value,'images'=>$_smarty_tpl->tpl_vars['product']->value['main_pair']), 0);?>

        <?php if ($_smarty_tpl->tpl_vars['image']->value['link']) {?>
            </a>
        <?php }?>
    <!--<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:list_images_block"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php } ?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_data_content"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_data")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_data"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_data"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="common/product_data.tpl" id="<?php echo smarty_function_set_id(array('name'=>"common/product_data.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_data_content")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_data_content"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if ($_smarty_tpl->tpl_vars['product']->value['tracking']==smarty_modifier_enum("ProductTracking::TRACK_WITH_OPTIONS")) {?>
    <?php $_smarty_tpl->tpl_vars["out_of_stock_text"] = new Smarty_variable($_smarty_tpl->__("text_combination_out_of_stock"), null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["out_of_stock_text"] = new Smarty_variable($_smarty_tpl->__("text_out_of_stock"), null, 0);?>
<?php }?>

<?php if ((floatval($_smarty_tpl->tpl_vars['product']->value['price'])||$_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="P"||$_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="A"||(!floatval($_smarty_tpl->tpl_vars['product']->value['price'])&&$_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="R"))&&!($_smarty_tpl->tpl_vars['settings']->value['Checkout']['allow_anonymous_shopping']=="hide_price_and_add_to_cart"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id'])) {?>
    <?php $_smarty_tpl->tpl_vars["show_price_values"] = new Smarty_variable(true, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["show_price_values"] = new Smarty_variable(false, null, 0);?>
<?php }?>
<?php $_smarty_tpl->_capture_stack[0][] = array("show_price_values", null, null); ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['show_price_values']->value, ENT_QUOTES, 'UTF-8');
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->tpl_vars["cart_button_exists"] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_qty"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['show_qty']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["obj_id"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['obj_id']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['product']->value['product_id'] : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["product_amount"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['product']->value['inventory_amount'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['product']->value['amount'] : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_sku_label"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['show_sku_label']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_amount_label"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['show_amount_label']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php if (!$_smarty_tpl->tpl_vars['config']->value['tweaks']['disable_dhtml']&&!$_smarty_tpl->tpl_vars['no_ajax']->value) {?>
    <?php $_smarty_tpl->tpl_vars["is_ajax"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("form_open_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php if (!$_smarty_tpl->tpl_vars['hide_form']->value) {?>
<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="product_form_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" enctype="multipart/form-data" class="cm-disable-empty-files <?php if ($_smarty_tpl->tpl_vars['is_ajax']->value) {?> cm-ajax cm-ajax-full-render cm-ajax-status-middle<?php }?> <?php if ($_smarty_tpl->tpl_vars['form_meta']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['form_meta']->value, ENT_QUOTES, 'UTF-8');
}?>">
<input type="hidden" name="result_ids" value="cart_status*,wish_list*,checkout*,account_info*" />
<?php if (!$_smarty_tpl->tpl_vars['stay_in_cart']->value) {?>
<input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['redirect_url']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['config']->value['current_url'] : $tmp), ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>
<input type="hidden" name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][product_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("form_open_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("name_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_name")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_name"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if ($_smarty_tpl->tpl_vars['show_name']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['hide_links']->value) {?><strong><?php } else { ?><a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
" class="product-title" title="<?php echo htmlspecialchars(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['product']), ENT_QUOTES, 'UTF-8');?>
" <?php echo smarty_function_live_edit(array('name'=>"product:product:".((string)$_smarty_tpl->tpl_vars['product']->value['product_id']),'phrase'=>$_smarty_tpl->tpl_vars['product']->value['product']),$_smarty_tpl);?>
><?php }
echo $_smarty_tpl->tpl_vars['product']->value['product'];
if ($_smarty_tpl->tpl_vars['hide_links']->value) {?></strong><?php } else { ?></a><?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['show_trunc_name']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['hide_links']->value) {?><strong><?php } else { ?><a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
" class="product-title" title="<?php echo htmlspecialchars(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['product']), ENT_QUOTES, 'UTF-8');?>
" <?php echo smarty_function_live_edit(array('name'=>"product:product:".((string)$_smarty_tpl->tpl_vars['product']->value['product_id']),'phrase'=>$_smarty_tpl->tpl_vars['product']->value['product']),$_smarty_tpl);?>
><?php }
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['product'],44,"...",true);
if ($_smarty_tpl->tpl_vars['hide_links']->value) {?></strong><?php } else { ?></a><?php }?>
    <?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_name"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("name_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("sku_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_sku']->value) {?>
        <div class="ty-control-group ty-sku-item cm-hidden-wrapper<?php if (!$_smarty_tpl->tpl_vars['product']->value['product_code']) {?> hidden<?php }?>" id="sku_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="appearance[show_sku]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_sku']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <?php if ($_smarty_tpl->tpl_vars['show_sku_label']->value) {?>
                <label class="ty-control-group__label" id="sku_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("sku");?>
:</label>
            <?php }?>
            <span class="ty-control-group__item cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_code_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_code'], ENT_QUOTES, 'UTF-8');?>
<!--product_code_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
        </div>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("sku_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("rating_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:data_block")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:data_block"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:data_block"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("rating_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("add_to_cart_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php if ($_smarty_tpl->tpl_vars['show_add_to_cart']->value) {?>
<div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['add_to_cart_class']->value, ENT_QUOTES, 'UTF-8');?>
" id="add_to_cart_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
<input type="hidden" name="appearance[show_add_to_cart]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_add_to_cart']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="appearance[show_list_buttons]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_list_buttons']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="appearance[but_role]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['but_role']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="appearance[quick_view]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['quick_view']->value, ENT_QUOTES, 'UTF-8');?>
" />

<?php $_smarty_tpl->_capture_stack[0][] = array("buttons_product", null, null); ob_start();
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:add_to_cart")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:add_to_cart"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
if ($_smarty_tpl->tpl_vars['product']->value['has_options']&&!$_smarty_tpl->tpl_vars['show_product_options']->value&&!$_smarty_tpl->tpl_vars['details_page']->value) {
if ($_smarty_tpl->tpl_vars['but_role']->value=="text") {
$_smarty_tpl->tpl_vars['opt_but_role'] = new Smarty_variable("text", null, 0);
} else {
$_smarty_tpl->tpl_vars['opt_but_role'] = new Smarty_variable("action", null, 0);
}
echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_id'=>"button_cart_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'but_text'=>$_smarty_tpl->__("select_options"),'but_href'=>"products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id']),'but_role'=>$_smarty_tpl->tpl_vars['opt_but_role']->value,'but_name'=>'','but_meta'=>"ty-btn__primary ty-btn__big"), 0);
} else {
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:add_to_cart_but_id")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:add_to_cart_but_id"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_smarty_tpl->tpl_vars['_but_id'] = new Smarty_variable("button_cart_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:add_to_cart_but_id"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
if ($_smarty_tpl->tpl_vars['extra_button']->value) {
echo $_smarty_tpl->tpl_vars['extra_button']->value;?>
&nbsp;<?php }
echo $_smarty_tpl->getSubTemplate ("buttons/add_to_cart.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_id'=>$_smarty_tpl->tpl_vars['_but_id']->value,'but_name'=>"dispatch[checkout.add..".((string)$_smarty_tpl->tpl_vars['obj_id']->value)."]",'but_role'=>$_smarty_tpl->tpl_vars['but_role']->value,'block_width'=>$_smarty_tpl->tpl_vars['block_width']->value,'obj_id'=>$_smarty_tpl->tpl_vars['obj_id']->value,'product'=>$_smarty_tpl->tpl_vars['product']->value,'but_meta'=>$_smarty_tpl->tpl_vars['add_to_cart_meta']->value), 0);
$_smarty_tpl->tpl_vars["cart_button_exists"] = new Smarty_variable(true, null, 0);
}
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:add_to_cart"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:buttons_block")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:buttons_block"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
if (($_smarty_tpl->tpl_vars['product']->value['zero_price_action']!="R"||$_smarty_tpl->tpl_vars['product']->value['price']!=0)&&($_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']!="Y"||$_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']=="Y"||($_smarty_tpl->tpl_vars['product_amount']->value>0&&$_smarty_tpl->tpl_vars['product_amount']->value>=$_smarty_tpl->tpl_vars['product']->value['min_qty'])||$_smarty_tpl->tpl_vars['product']->value['tracking']==smarty_modifier_enum("ProductTracking::DO_NOT_TRACK")||$_smarty_tpl->tpl_vars['product']->value['is_edp']=="Y"||$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::BUY_IN_ADVANCE"))||($_smarty_tpl->tpl_vars['product']->value['has_options']&&!$_smarty_tpl->tpl_vars['show_product_options']->value)) {
if (trim(Smarty::$_smarty_vars['capture']['buttons_product'])!='&nbsp;') {
if ($_smarty_tpl->tpl_vars['product']->value['avail_since']<=@constant('TIME')||($_smarty_tpl->tpl_vars['product']->value['avail_since']>@constant('TIME')&&$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::BUY_IN_ADVANCE"))) {
echo Smarty::$_smarty_vars['capture']['buttons_product'];
}
}
} elseif (($_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"&&$_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']!="Y"&&(($_smarty_tpl->tpl_vars['product_amount']->value<=0||$_smarty_tpl->tpl_vars['product_amount']->value<$_smarty_tpl->tpl_vars['product']->value['min_qty'])&&$_smarty_tpl->tpl_vars['product']->value['tracking']!=smarty_modifier_enum("ProductTracking::DO_NOT_TRACK"))&&$_smarty_tpl->tpl_vars['product']->value['is_edp']!="Y")) {
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:out_of_stock_block")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:out_of_stock_block"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_smarty_tpl->tpl_vars["show_qty"] = new Smarty_variable(false, null, 0);
if (!$_smarty_tpl->tpl_vars['details_page']->value) {
if ((!$_smarty_tpl->tpl_vars['product']->value['hide_stock_info']&&!(($_smarty_tpl->tpl_vars['product_amount']->value<=0||$_smarty_tpl->tpl_vars['product_amount']->value<$_smarty_tpl->tpl_vars['product']->value['min_qty'])&&($_smarty_tpl->tpl_vars['product']->value['avail_since']>@constant('TIME'))))) {?><span class="ty-qty-out-of-stock ty-control-group__item" id="out_of_stock_info_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['out_of_stock_text']->value, ENT_QUOTES, 'UTF-8');?>
</span><?php }
} elseif ((($_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::SUBSCRIBE"))&&($_smarty_tpl->tpl_vars['product']->value['tracking']!=smarty_modifier_enum("ProductTracking::TRACK_WITH_OPTIONS")))) {
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"product_data:back_in_stock_checkbox")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"product_data:back_in_stock_checkbox"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<div class="ty-control-group"><label for="sw_product_notify_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="ty-strong" id="label_sw_product_notify_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><input id="sw_product_notify_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" type="checkbox" class="checkbox cm-switch-availability cm-switch-visibility" name="product_notify" <?php if ($_smarty_tpl->tpl_vars['product_notification_enabled']->value=="Y") {?>checked="checked"<?php }?> onclick="<?php if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']) {?>if (!this.checked) {Tygh.$.ceAjax('request', '<?php echo htmlspecialchars(fn_url("products.product_notifications?enable="), ENT_QUOTES, 'UTF-8');?>
' + 'N&amp;product_id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
&amp;email=' + $('#product_notify_email_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
').get(0).value, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ldelim']->value, ENT_QUOTES, 'UTF-8');?>
cache: false<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rdelim']->value, ENT_QUOTES, 'UTF-8');?>
);}<?php } else { ?>Tygh.$.ceAjax('request', '<?php echo htmlspecialchars(fn_url("products.product_notifications?enable="), ENT_QUOTES, 'UTF-8');?>
' + (this.checked ? 'Y' : 'N') + '&amp;product_id=' + '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
', <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ldelim']->value, ENT_QUOTES, 'UTF-8');?>
cache: false<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rdelim']->value, ENT_QUOTES, 'UTF-8');?>
);<?php }?>"/><?php echo $_smarty_tpl->__("notify_when_back_in_stock");?>
</label></div><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"product_data:back_in_stock_checkbox"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']) {?><div class="ty-control-group ty-input-append ty-product-notify-email <?php if ($_smarty_tpl->tpl_vars['product_notification_enabled']->value!="Y") {?>hidden<?php }?>" id="product_notify_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><input type="hidden" name="enable" value="Y" disabled /><input type="hidden" name="product_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
" disabled /><label id="product_notify_email_label" for="product_notify_email_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-required cm-email hidden"><?php echo $_smarty_tpl->__("email");?>
</label><input type="text" name="email" id="product_notify_email_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" size="20" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['product_notification_email']->value)===null||$tmp==='' ? $_smarty_tpl->__("enter_email") : $tmp), ENT_QUOTES, 'UTF-8');?>
" class="ty-product-notify-email__input cm-hint" title="<?php echo $_smarty_tpl->__("enter_email");?>
" disabled /><button class="ty-btn-go cm-ajax" type="submit" name="dispatch[products.product_notifications]" title="<?php echo $_smarty_tpl->__("go");?>
"><i class="ty-btn-go__icon ty-icon-right-dir"></i></button></div><?php }
}
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:out_of_stock_block"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
}
if ($_smarty_tpl->tpl_vars['show_list_buttons']->value) {
$_smarty_tpl->_capture_stack[0][] = array("product_buy_now_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start();
$_smarty_tpl->tpl_vars['compare_product_id'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_id'], null, 0);
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:buy_now")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:buy_now"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
if ($_smarty_tpl->tpl_vars['settings']->value['General']['enable_compare_products']=="Y") {
echo $_smarty_tpl->getSubTemplate ("buttons/add_to_compare_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_id'=>$_smarty_tpl->tpl_vars['compare_product_id']->value), 0);
}
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:buy_now"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
$_smarty_tpl->tpl_vars["capture_buy_now"] = new Smarty_variable("product_buy_now_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);
if (trim(Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_buy_now']->value])) {
echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_buy_now']->value];
}
}
if (($_smarty_tpl->tpl_vars['product']->value['avail_since']>@constant('TIME'))) {
echo $_smarty_tpl->getSubTemplate ("common/coming_soon_notice.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('avail_date'=>$_smarty_tpl->tpl_vars['product']->value['avail_since'],'add_to_cart'=>$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']), 0);
}
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:buttons_block"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<!--add_to_cart_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if (Smarty::$_smarty_vars['capture']['cart_button_exists']) {?>
    <?php $_smarty_tpl->tpl_vars["cart_button_exists"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("add_to_cart_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("product_features_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_features")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_features"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if ($_smarty_tpl->tpl_vars['show_features']->value) {?>
        <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_features_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="appearance[show_features]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_features']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_features_short_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('features'=>fn_get_product_features_list($_smarty_tpl->tpl_vars['product']->value),'no_container'=>true), 0);?>

        <!--product_features_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
    <?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_features"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("product_features_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("prod_descr_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_descr']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['product']->value['short_description']) {?>
            <div <?php echo smarty_function_live_edit(array('name'=>"product:short_description:".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])),$_smarty_tpl);?>
><?php echo $_smarty_tpl->tpl_vars['product']->value['short_description'];?>
</div>
        <?php } else { ?>
            <div <?php echo smarty_function_live_edit(array('name'=>"product:full_description:".((string)$_smarty_tpl->tpl_vars['product']->value['product_id']),'phrase'=>$_smarty_tpl->tpl_vars['product']->value['full_description']),$_smarty_tpl);?>
><?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['full_description']),160);?>
</div>
        <?php }?>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("prod_descr_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array("old_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_price_values']->value&&$_smarty_tpl->tpl_vars['show_old_price']->value) {?>
        <span class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="old_price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:old_price")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:old_price"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if ($_smarty_tpl->tpl_vars['product']->value['discount']) {?>
                <span class="ty-list-price ty-nowrap" id="line_old_price_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php if ($_smarty_tpl->tpl_vars['details_page']->value) {
echo $_smarty_tpl->__("old_price");?>
: <?php }?><span class="ty-strike"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>(($tmp = @$_smarty_tpl->tpl_vars['product']->value['original_price'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['product']->value['base_price'] : $tmp),'span_id'=>"old_price_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'class'=>"ty-list-price ty-nowrap"), 0);?>
</span></span>
            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['list_discount']) {?>
                <span class="ty-list-price ty-nowrap" id="line_list_price_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php if ($_smarty_tpl->tpl_vars['details_page']->value) {?><span class="list-price-label"><?php echo $_smarty_tpl->__("list_price");?>
:</span> <?php }?><span class="ty-strike"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['list_price'],'span_id'=>"list_price_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'class'=>"ty-list-price ty-nowrap"), 0);?>
</span></span>
            <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:old_price"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <!--old_price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("old_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array("price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <span class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
 ty-price-update" id="price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <input type="hidden" name="appearance[show_price_values]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_price_values']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <input type="hidden" name="appearance[show_price]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_price']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <?php if ($_smarty_tpl->tpl_vars['show_price_values']->value) {?>
            <?php if ($_smarty_tpl->tpl_vars['show_price']->value) {?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:prices_block")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:prices_block"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php if (floatval($_smarty_tpl->tpl_vars['product']->value['price'])||$_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="P"||($_smarty_tpl->tpl_vars['hide_add_to_cart_button']->value=="Y"&&$_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="A")) {?>
                    <span class="ty-price<?php if (!floatval($_smarty_tpl->tpl_vars['product']->value['price'])&&!$_smarty_tpl->tpl_vars['product']->value['zero_price_action']) {?> hidden<?php }?>" id="line_discounted_price_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['price'],'span_id'=>"discounted_price_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'class'=>"ty-price-num",'live_editor_name'=>"product:price:".((string)$_smarty_tpl->tpl_vars['product']->value['product_id']),'live_editor_phrase'=>$_smarty_tpl->tpl_vars['product']->value['base_price']), 0);?>
</span>
                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="A"&&$_smarty_tpl->tpl_vars['show_add_to_cart']->value) {?>
                    <?php $_smarty_tpl->tpl_vars["base_currency"] = new Smarty_variable($_smarty_tpl->tpl_vars['currencies']->value[@constant('CART_PRIMARY_CURRENCY')], null, 0);?>
                    <span class="ty-price-curency"><span class="ty-price-curency__title"><?php echo $_smarty_tpl->__("enter_your_price");?>
:</span>
                    <div class="ty-price-curency-input">
                        <?php if ($_smarty_tpl->tpl_vars['base_currency']->value['after']!="Y") {
echo $_smarty_tpl->tpl_vars['base_currency']->value['symbol'];
}?>
                        <input class="ty-price-curency__input" type="text" size="3" name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][price]" value="" />
                        <?php if ($_smarty_tpl->tpl_vars['base_currency']->value['after']=="Y") {
echo $_smarty_tpl->tpl_vars['base_currency']->value['symbol'];
}?>
                    </div>
                    </span>

                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['zero_price_action']=="R") {?>
                    <span class="ty-no-price"><?php echo $_smarty_tpl->__("contact_us_for_price");?>
</span>
                    <?php $_smarty_tpl->tpl_vars["show_qty"] = new Smarty_variable(false, null, 0);?>
                <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:prices_block"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php }?>
        <?php } elseif ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['allow_anonymous_shopping']=="hide_price_and_add_to_cart"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id']) {?>
            <span class="ty-price"><?php echo $_smarty_tpl->__("sign_in_to_view_price");?>
</span>
        <?php }?>
    <!--price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array("clean_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_price_values']->value&&$_smarty_tpl->tpl_vars['show_clean_price']->value&&$_smarty_tpl->tpl_vars['settings']->value['Appearance']['show_prices_taxed_clean']=="Y"&&$_smarty_tpl->tpl_vars['product']->value['taxed_price']) {?>
        <span class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="clean_price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="appearance[show_price_values]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_price_values']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <input type="hidden" name="appearance[show_clean_price]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_clean_price']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <?php if ($_smarty_tpl->tpl_vars['product']->value['clean_price']!=$_smarty_tpl->tpl_vars['product']->value['taxed_price']&&$_smarty_tpl->tpl_vars['product']->value['included_tax']) {?>
                <span class="ty-list-price ty-nowrap" id="line_product_price_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">(<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['taxed_price'],'span_id'=>"product_price_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'class'=>"ty-list-price ty-nowrap"), 0);?>
 <?php echo $_smarty_tpl->__("inc_tax");?>
)</span>
            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['clean_price']!=$_smarty_tpl->tpl_vars['product']->value['taxed_price']&&!$_smarty_tpl->tpl_vars['product']->value['included_tax']) {?>
                <span class="ty-list-price ty-nowrap ty-tax-include">(<?php echo $_smarty_tpl->__("including_tax");?>
)</span>
            <?php }?>
        <!--clean_price_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("clean_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array("list_discount_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_price_values']->value&&$_smarty_tpl->tpl_vars['show_list_discount']->value&&$_smarty_tpl->tpl_vars['details_page']->value) {?>
        <span class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="line_discount_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="appearance[show_price_values]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_price_values']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <input type="hidden" name="appearance[show_list_discount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_list_discount']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <?php if ($_smarty_tpl->tpl_vars['product']->value['discount']) {?>
                <span class="ty-list-price ty-save-price ty-nowrap" id="line_discount_value_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("you_save");?>
: <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['discount'],'span_id'=>"discount_value_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value),'class'=>"ty-list-price ty-nowrap"), 0);?>
<span class="ty-save-price__percent">&nbsp;(<span id="prc_discount_value_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="ty-list-price ty-nowrap"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['discount_prc'], ENT_QUOTES, 'UTF-8');?>
</span>%)</span></span>
            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['list_discount']) {?>
                <span class="ty-list-price ty-save-price ty-nowrap" id="line_discount_value_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"> <?php echo $_smarty_tpl->__("you_save");?>
: <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['list_discount'],'span_id'=>"discount_value_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value)), 0);?>
<span class="ty-save-price__percent">&nbsp;(<span id="prc_discount_value_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['list_discount_prc'], ENT_QUOTES, 'UTF-8');?>
</span>%)</span></span>
            <?php }?>
        <!--line_discount_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("list_discount_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array("discount_label_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_discount_label']->value&&($_smarty_tpl->tpl_vars['product']->value['discount_prc']||$_smarty_tpl->tpl_vars['product']->value['list_discount_prc'])&&$_smarty_tpl->tpl_vars['show_price_values']->value) {?>
        <span class="ty-discount-label cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="discount_label_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <span class="ty-discount-label__item" id="line_prc_discount_value_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><span class="ty-discount-label__value" id="prc_discount_value_label_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("save_discount");?>
 <?php if ($_smarty_tpl->tpl_vars['product']->value['discount']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['discount_prc'], ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['list_discount_prc'], ENT_QUOTES, 'UTF-8');
}?>%</span></span>
        <!--discount_label_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></span>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("discount_label_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>


<?php $_smarty_tpl->tpl_vars['product_labels_position'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['product_labels_position']->value)===null||$tmp==='' ? "top-right" : $tmp), null, 0);?>

<?php $_smarty_tpl->_capture_stack[0][] = array("product_labels_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_product_labels']->value) {?>
        <?php $_smarty_tpl->_capture_stack[0][] = array("capture_product_labels_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_labels")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_labels"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if ($_smarty_tpl->tpl_vars['show_shipping_label']->value&&$_smarty_tpl->tpl_vars['product']->value['free_shipping']=="Y") {?>
                <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_label.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('label_meta'=>"ty-product-labels__item--shipping",'label_text'=>$_smarty_tpl->__("free_shipping"),'label_mini'=>$_smarty_tpl->tpl_vars['product_labels_mini']->value,'label_static'=>$_smarty_tpl->tpl_vars['product_labels_static']->value,'label_rounded'=>$_smarty_tpl->tpl_vars['product_labels_rounded']->value), 0);?>

            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['show_discount_label']->value&&($_smarty_tpl->tpl_vars['product']->value['discount_prc']||$_smarty_tpl->tpl_vars['product']->value['list_discount_prc'])&&$_smarty_tpl->tpl_vars['show_price_values']->value) {?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['discount']) {?>
                    <?php ob_start();
echo $_smarty_tpl->__("save_discount");
$_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['label_text'] = new Smarty_variable($_tmp3." ".((string)$_smarty_tpl->tpl_vars['product']->value['discount_prc'])."%", null, 0);?>
                <?php } else { ?>
                    <?php ob_start();
echo $_smarty_tpl->__("save_discount");
$_tmp4=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['label_text'] = new Smarty_variable($_tmp4." ".((string)$_smarty_tpl->tpl_vars['product']->value['list_discount_prc'])."%", null, 0);?>
                <?php }?>

                <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_label.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('label_meta'=>"ty-product-labels__item--discount",'label_text'=>$_smarty_tpl->tpl_vars['label_text']->value,'label_mini'=>$_smarty_tpl->tpl_vars['product_labels_mini']->value,'label_static'=>$_smarty_tpl->tpl_vars['product_labels_static']->value,'label_rounded'=>$_smarty_tpl->tpl_vars['product_labels_rounded']->value), 0);?>

            <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_labels"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php $_smarty_tpl->tpl_vars['capture_product_labels'] = new Smarty_variable("capture_product_labels_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>

        <?php if (trim(Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_product_labels']->value])) {?>
            <div class="ty-product-labels ty-product-labels--<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_labels_position']->value, ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['product_labels_mini']->value) {?>ty-product-labels--mini<?php }?> <?php if ($_smarty_tpl->tpl_vars['product_labels_static']->value) {?>ty-product-labels--static<?php }?> cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_labels_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_product_labels']->value];?>

            <!--product_labels_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
        <?php }?>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars['capture_name'] = new Smarty_variable("product_labels_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("product_amount_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_amount")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_amount"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if ($_smarty_tpl->tpl_vars['show_product_amount']->value&&$_smarty_tpl->tpl_vars['product']->value['is_edp']!="Y"&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y") {?>
    <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
 stock-wrap" id="product_amount_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <input type="hidden" name="appearance[show_product_amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_product_amount']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <?php if (!$_smarty_tpl->tpl_vars['product']->value['hide_stock_info']) {?>
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['in_stock_field']=="Y") {?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['tracking']!=smarty_modifier_enum("ProductTracking::DO_NOT_TRACK")) {?>
                    <?php if (($_smarty_tpl->tpl_vars['product_amount']->value>0&&$_smarty_tpl->tpl_vars['product_amount']->value>=$_smarty_tpl->tpl_vars['product']->value['min_qty'])&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"||$_smarty_tpl->tpl_vars['details_page']->value) {?>
                        <?php if (($_smarty_tpl->tpl_vars['product_amount']->value>0&&$_smarty_tpl->tpl_vars['product_amount']->value>=$_smarty_tpl->tpl_vars['product']->value['min_qty']||$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::BUY_IN_ADVANCE"))&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y") {?>
                            <div class="ty-control-group product-list-field">
                                <?php if ($_smarty_tpl->tpl_vars['show_amount_label']->value) {?>
                                    <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("availability");?>
:</label>
                                <?php }?>
                                <span id="qty_in_stock_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="ty-qty-in-stock ty-control-group__item">
                                    <?php if ($_smarty_tpl->tpl_vars['product_amount']->value>0) {?>
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_amount']->value, ENT_QUOTES, 'UTF-8');?>
&nbsp;<?php echo $_smarty_tpl->__("items");?>

                                    <?php } else { ?>
                                        <?php echo $_smarty_tpl->__("on_backorder");?>

                                    <?php }?>
                                </span>
                            </div>
                        <?php } elseif ($_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"&&$_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']!="Y") {?>
                            <div class="ty-control-group product-list-field">
                                <?php if ($_smarty_tpl->tpl_vars['show_amount_label']->value) {?>
                                    <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("in_stock");?>
:</label>
                                <?php }?>
                                <span class="ty-qty-out-of-stock ty-control-group__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['out_of_stock_text']->value, ENT_QUOTES, 'UTF-8');?>
</span>
                            </div>
                        <?php }?>
                    <?php }?>
                <?php }?>
            <?php } else { ?>
                <?php if (($_smarty_tpl->tpl_vars['product_amount']->value>0&&$_smarty_tpl->tpl_vars['product_amount']->value>=$_smarty_tpl->tpl_vars['product']->value['min_qty']||$_smarty_tpl->tpl_vars['product']->value['tracking']==smarty_modifier_enum("ProductTracking::DO_NOT_TRACK"))&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"&&$_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']!="Y"||$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"&&($_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']=="Y"||$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::BUY_IN_ADVANCE"))) {?>
                    <div class="ty-control-group product-list-field">
                        <?php if ($_smarty_tpl->tpl_vars['show_amount_label']->value) {?>
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("availability");?>
:</label>
                        <?php }?>
                        <span class="ty-qty-in-stock ty-control-group__item" id="in_stock_info_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                            <?php if ($_smarty_tpl->tpl_vars['product_amount']->value>0) {?>
                                <?php echo $_smarty_tpl->__("in_stock");?>

                            <?php } else { ?>
                                <?php echo $_smarty_tpl->__("on_backorder");?>

                            <?php }?>
                        </span>
                    </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['details_page']->value&&($_smarty_tpl->tpl_vars['product_amount']->value<=0||$_smarty_tpl->tpl_vars['product_amount']->value<$_smarty_tpl->tpl_vars['product']->value['min_qty'])&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y"&&$_smarty_tpl->tpl_vars['settings']->value['General']['allow_negative_amount']!="Y") {?>
                    <div class="ty-control-group product-list-field">
                        <?php if ($_smarty_tpl->tpl_vars['show_amount_label']->value) {?>
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("availability");?>
:</label>
                        <?php }?>
                        <span class="ty-qty-out-of-stock ty-control-group__item" id="out_of_stock_info_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['out_of_stock_text']->value, ENT_QUOTES, 'UTF-8');?>
</span>
                    </div>
                <?php }?>
            <?php }?>
        <?php }?>
    <!--product_amount_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
<?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_amount"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("product_amount_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("product_options_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_product_options']->value) {?>
    <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_options_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <input type="hidden" name="appearance[show_product_options]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_product_options']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_option_content")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_option_content"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if ($_smarty_tpl->tpl_vars['disable_ids']->value) {?>
                <?php $_smarty_tpl->tpl_vars["_disable_ids"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['disable_ids']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["_disable_ids"] = new Smarty_variable('', null, 0);?>
            <?php }?>
            <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_options.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>$_smarty_tpl->tpl_vars['obj_id']->value,'product_options'=>$_smarty_tpl->tpl_vars['product']->value['product_options'],'name'=>"product_data",'capture_options_vs_qty'=>$_smarty_tpl->tpl_vars['capture_options_vs_qty']->value,'disable_ids'=>$_smarty_tpl->tpl_vars['_disable_ids']->value), 0);?>

        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_option_content"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <!--product_options_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("product_options_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("advanced_options_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_product_options']->value) {?>
        <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="advanced_options_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/product_company_data.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('company_name'=>$_smarty_tpl->tpl_vars['product']->value['company_name'],'company_id'=>$_smarty_tpl->tpl_vars['product']->value['company_id']), 0);?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:options_advanced")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:options_advanced"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:options_advanced"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <!--advanced_options_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("advanced_options_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("qty_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:qty")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:qty"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="qty_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <input type="hidden" name="appearance[show_qty]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['show_qty']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <input type="hidden" name="appearance[capture_options_vs_qty]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['capture_options_vs_qty']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <?php if (!empty($_smarty_tpl->tpl_vars['product']->value['selected_amount'])) {?>
            <?php $_smarty_tpl->tpl_vars["default_amount"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['selected_amount'], null, 0);?>
        <?php } elseif (!empty($_smarty_tpl->tpl_vars['product']->value['min_qty'])) {?>
            <?php $_smarty_tpl->tpl_vars["default_amount"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['min_qty'], null, 0);?>
        <?php } elseif (!empty($_smarty_tpl->tpl_vars['product']->value['qty_step'])) {?>
            <?php $_smarty_tpl->tpl_vars["default_amount"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['qty_step'], null, 0);?>
        <?php } else { ?>
            <?php $_smarty_tpl->tpl_vars["default_amount"] = new Smarty_variable("1", null, 0);?>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['show_qty']->value&&$_smarty_tpl->tpl_vars['product']->value['is_edp']!=="Y"&&$_smarty_tpl->tpl_vars['cart_button_exists']->value==true&&($_smarty_tpl->tpl_vars['settings']->value['Checkout']['allow_anonymous_shopping']=="allow_shopping"||$_smarty_tpl->tpl_vars['auth']->value['user_id'])&&$_smarty_tpl->tpl_vars['product']->value['avail_since']<=@constant('TIME')||($_smarty_tpl->tpl_vars['product']->value['avail_since']>@constant('TIME')&&$_smarty_tpl->tpl_vars['product']->value['out_of_stock_actions']==smarty_modifier_enum("OutOfStockActions::BUY_IN_ADVANCE"))) {?>
            <div class="ty-qty clearfix<?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['quantity_changer']=="Y") {?> changer<?php }?>" id="qty_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                <?php if (!$_smarty_tpl->tpl_vars['hide_qty_label']->value) {?><label class="ty-control-group__label" for="qty_count_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['quantity_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("quantity") : $tmp), ENT_QUOTES, 'UTF-8');?>
:</label><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['product']->value['qty_content']) {?>
                <select name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][amount]" id="qty_count_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                <?php $_smarty_tpl->tpl_vars["a_name"] = new Smarty_variable("product_amount_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["selected_amount"] = new Smarty_variable(false, null, 0);?>
                <?php  $_smarty_tpl->tpl_vars["var"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["var"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product']->value['qty_content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["var"]->key => $_smarty_tpl->tpl_vars["var"]->value) {
$_smarty_tpl->tpl_vars["var"]->_loop = true;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['product']->value['selected_amount']&&($_smarty_tpl->tpl_vars['product']->value['selected_amount']==$_smarty_tpl->tpl_vars['var']->value||($_smarty_tpl->getVariable('smarty')->value['foreach'][$_smarty_tpl->tpl_vars['a_name']->value]['last']&&!$_smarty_tpl->tpl_vars['selected_amount']->value))) {
$_smarty_tpl->tpl_vars["selected_amount"] = new Smarty_variable(true, null, 0);?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
                </select>
                <?php } else { ?>
                <div class="ty-center ty-value-changer cm-value-changer">
                    <?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['quantity_changer']=="Y") {?>
                        <a class="cm-increase ty-value-changer__increase">&#43;</a>
                    <?php }?>
                    <input <?php if ($_smarty_tpl->tpl_vars['product']->value['qty_step']>1) {?>readonly="readonly"<?php }?> type="text" size="5" class="ty-value-changer__input cm-amount" id="qty_count_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['default_amount']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['product']->value['qty_step']>1) {?> data-ca-step="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['qty_step'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> data-ca-min-qty="<?php if ($_smarty_tpl->tpl_vars['product']->value['min_qty']>1) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['min_qty'], ENT_QUOTES, 'UTF-8');
} else { ?>1<?php }?>" />
                    <?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['quantity_changer']=="Y") {?>
                        <a class="cm-decrease ty-value-changer__decrease">&minus;</a>
                    <?php }?>
                </div>
                <?php }?>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['product']->value['prices']) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/products_qty_discounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            <?php }?>
        <?php } elseif (!$_smarty_tpl->tpl_vars['bulk_add']->value) {?>
            <input type="hidden" name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['default_amount']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <?php }?>
        <!--qty_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:qty"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("qty_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("min_qty_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:qty_description")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:qty_description"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->tpl_vars['min_qty']->value&&$_smarty_tpl->tpl_vars['product']->value['min_qty']) {?>
            <p class="ty-min-qty-description"><?php echo $_smarty_tpl->__("text_cart_min_qty",array("[product]"=>$_smarty_tpl->tpl_vars['product']->value['product'],"[quantity]"=>$_smarty_tpl->tpl_vars['product']->value['min_qty']));?>
.</p>
        <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:qty_description"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("min_qty_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("product_edp_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_edp']->value&&$_smarty_tpl->tpl_vars['product']->value['is_edp']=="Y") {?>
        <p class="ty-edp-description"><?php echo $_smarty_tpl->__("text_edp_product");?>
.</p>
        <input type="hidden" name="product_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
][is_edp]" value="Y" />
    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("product_edp_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("form_close_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, null); ob_start(); ?>
<?php if (!$_smarty_tpl->tpl_vars['hide_form']->value) {?>
</form>
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php if ($_smarty_tpl->tpl_vars['no_capture']->value) {?>
    <?php $_smarty_tpl->tpl_vars["capture_name"] = new Smarty_variable("form_close_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['capture_name']->value];?>

<?php }?>

<?php  $_smarty_tpl->tpl_vars["image"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["image"]->_loop = false;
 $_smarty_tpl->tpl_vars["object_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["image"]->key => $_smarty_tpl->tpl_vars["image"]->value) {
$_smarty_tpl->tpl_vars["image"]->_loop = true;
 $_smarty_tpl->tpl_vars["object_id"]->value = $_smarty_tpl->tpl_vars["image"]->key;
?>
<?php $_smarty_tpl->tpl_vars["product_link"] = new Smarty_variable($_smarty_tpl->tpl_vars['image']->value['link'], null, 0);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:list_images_block")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:list_images_block"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['obj_id'], ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <?php if ($_smarty_tpl->tpl_vars['product_link']->value) {?>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product_link']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['link'], ENT_QUOTES, 'UTF-8');?>
" name="image[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
][link]" />
        <?php }?>
        <input type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['obj_id'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['width'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['height'], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['type'], ENT_QUOTES, 'UTF-8');?>
" name="image[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
][data]" />
        <?php echo $_smarty_tpl->getSubTemplate ("common/image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('image_width'=>$_smarty_tpl->tpl_vars['image']->value['width'],'image_height'=>$_smarty_tpl->tpl_vars['image']->value['height'],'obj_id'=>$_smarty_tpl->tpl_vars['object_id']->value,'images'=>$_smarty_tpl->tpl_vars['product']->value['main_pair']), 0);?>

        <?php if ($_smarty_tpl->tpl_vars['image']->value['link']) {?>
            </a>
        <?php }?>
    <!--<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:list_images_block"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php } ?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_data_content"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_data")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_data"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_data"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?><?php }} ?>
