<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:03:55
         compiled from "F:\OSPanel\domains\test.local\design\themes\bright_theme\templates\blocks\products\products_scroller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6779916295db2c88b99c467-16376902%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11745ce28b294d81a5fe0fa15128000ab085370c' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\bright_theme\\templates\\blocks\\products\\products_scroller.tpl',
      1 => 1571056107,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '6779916295db2c88b99c467-16376902',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'settings' => 0,
    'block' => 0,
    'items' => 0,
    'product' => 0,
    'obj_prefix' => 0,
    'show_quick_view' => 0,
    'obj_id' => 0,
    'form_open' => 0,
    'product_labels' => 0,
    'item_number' => 0,
    'cur_number' => 0,
    'name' => 0,
    'hide_price' => 0,
    'old_price' => 0,
    'price' => 0,
    'clean_price' => 0,
    'list_discount' => 0,
    'rating' => 0,
    'quick_nav_ids' => 0,
    'show_add_to_cart' => 0,
    'add_to_cart' => 0,
    'form_close' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2c88bae4c83_57140478',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2c88bae4c83_57140478')) {function content_5db2c88bae4c83_57140478($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_function_math')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.math.php';
if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?>

<?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['enable_quick_view']=="Y"&&$_smarty_tpl->tpl_vars['block']->value['properties']['enable_quick_view']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars['quick_nav_ids'] = new Smarty_variable(fn_fields_from_multi_level($_smarty_tpl->tpl_vars['items']->value,"product_id","product_id"), null, 0);?>    
    <?php $_smarty_tpl->tpl_vars['show_quick_view'] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['block']->value['properties']['hide_add_to_cart_button']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars["show_add_to_cart"] = new Smarty_variable(false, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["show_add_to_cart"] = new Smarty_variable(true, null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['block']->value['properties']['show_price']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars["hide_price"] = new Smarty_variable(false, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["hide_price"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php $_smarty_tpl->tpl_vars["show_trunc_name"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_old_price"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_price"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_rating"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_clean_price"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_list_discount"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["but_role"] = new Smarty_variable("action", null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_product_labels"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_discount_label"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_shipping_label"] = new Smarty_variable(true, null, 0);?>


<?php echo smarty_function_script(array('src'=>"js/tygh/product_image_gallery.js"),$_smarty_tpl);?>


<?php $_smarty_tpl->tpl_vars["obj_prefix"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['block']->value['block_id'])."000", null, 0);?>
<?php $_smarty_tpl->createLocalArrayVariable('block', null, 0);
$_smarty_tpl->tpl_vars['block']->value['properties']['outside_navigation'] = "N";?>

<div id="scroll_list_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['block_id'], ENT_QUOTES, 'UTF-8');?>
" class="owl-carousel ty-scroller-list grid-list ty-scroller-advanced">
    <?php  $_smarty_tpl->tpl_vars["product"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["product"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["product"]->key => $_smarty_tpl->tpl_vars["product"]->value) {
$_smarty_tpl->tpl_vars["product"]->_loop = true;
?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_scroller_advanced_list")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_scroller_advanced_list"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <div class="ty-scroller-list__item">
            <?php if ($_smarty_tpl->tpl_vars['product']->value) {?>
                <?php $_smarty_tpl->tpl_vars["obj_id"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_id'], null, 0);?>
                <?php $_smarty_tpl->tpl_vars["obj_id_prefix"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['product']->value['product_id']), null, 0);?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/product_data.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0);?>


                <div class="ty-grid-list__item ty-quick-view-button__wrapper ty-left
                <?php if ($_smarty_tpl->tpl_vars['show_quick_view']->value) {?> ty-grid-list__item--overlay<?php }?>">
                    <?php $_smarty_tpl->tpl_vars["form_open"] = new Smarty_variable("form_open_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['form_open']->value];?>


                    <div class="ty-grid-list__image">
                        <?php $_smarty_tpl->tpl_vars["product_labels"] = new Smarty_variable("product_labels_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                        <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['product_labels']->value];?>


                        <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_icon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'show_gallery'=>true), 0);?>

                    </div>

                    <div class="ty-grid-list__item-name">
                        <?php if ($_smarty_tpl->tpl_vars['item_number']->value=="Y") {?>
                            <span class="item-number"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_number']->value, ENT_QUOTES, 'UTF-8');?>
.&nbsp;</span>
                            <?php echo smarty_function_math(array('equation'=>"num + 1",'num'=>$_smarty_tpl->tpl_vars['cur_number']->value,'assign'=>"cur_number"),$_smarty_tpl);?>

                        <?php }?>

                        <?php $_smarty_tpl->tpl_vars["name"] = new Smarty_variable("name_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                        <bdi><?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['name']->value];?>
</bdi>
                    </div>

                    <?php if (!$_smarty_tpl->tpl_vars['hide_price']->value) {?>
                        <div class="ty-grid-list__price <?php if ($_smarty_tpl->tpl_vars['product']->value['price']==0) {?>ty-grid-list__no-price<?php }?>">
                            <?php $_smarty_tpl->tpl_vars["old_price"] = new Smarty_variable("old_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php if (trim(Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['old_price']->value])) {
echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['old_price']->value];
}?>

                            <?php $_smarty_tpl->tpl_vars["price"] = new Smarty_variable("price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['price']->value];?>


                            <?php $_smarty_tpl->tpl_vars["clean_price"] = new Smarty_variable("clean_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['clean_price']->value];?>


                            <?php $_smarty_tpl->tpl_vars["list_discount"] = new Smarty_variable("list_discount_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['list_discount']->value];?>

                        </div>
                    <?php }?>

                    <?php $_smarty_tpl->tpl_vars["rating"] = new Smarty_variable("rating_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                    <?php if (Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['rating']->value]) {?>
                        <div class="grid-list__rating">
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['rating']->value];?>

                        </div>
                    <?php }?>

                    <?php $_smarty_tpl->_capture_stack[0][] = array("product_multicolumns_list_control_data_wrapper", null, null); ob_start(); ?>
                        <div class="ty-grid-list__control">
                            <?php $_smarty_tpl->_capture_stack[0][] = array("product_multicolumns_list_control_data", null, null); ob_start(); ?>
                                <?php if ($_smarty_tpl->tpl_vars['show_quick_view']->value) {?>
                                    <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/quick_view_link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('quick_nav_ids'=>$_smarty_tpl->tpl_vars['quick_nav_ids']->value), 0);?>

                                <?php }?>

                                <?php if ($_smarty_tpl->tpl_vars['show_add_to_cart']->value) {?>
                                    <div class="button-container">
                                        <?php $_smarty_tpl->tpl_vars['add_to_cart'] = new Smarty_variable("add_to_cart_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                                        <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['add_to_cart']->value];?>

                                    </div>
                                <?php }?>
                            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                            <?php echo Smarty::$_smarty_vars['capture']['product_multicolumns_list_control_data'];?>

                        </div>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>


                    <?php if (trim(Smarty::$_smarty_vars['capture']['product_multicolumns_list_control_data'])) {?>
                        <?php echo Smarty::$_smarty_vars['capture']['product_multicolumns_list_control_data_wrapper'];?>

                    <?php }?>

                    <?php $_smarty_tpl->tpl_vars["form_close"] = new Smarty_variable("form_close_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['form_close']->value];?>

                </div>
            <?php }?>
        </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_scroller_advanced_list"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php } ?>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("common/scroller_init.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/products/products_scroller.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/products/products_scroller.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?>

<?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['enable_quick_view']=="Y"&&$_smarty_tpl->tpl_vars['block']->value['properties']['enable_quick_view']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars['quick_nav_ids'] = new Smarty_variable(fn_fields_from_multi_level($_smarty_tpl->tpl_vars['items']->value,"product_id","product_id"), null, 0);?>    
    <?php $_smarty_tpl->tpl_vars['show_quick_view'] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['block']->value['properties']['hide_add_to_cart_button']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars["show_add_to_cart"] = new Smarty_variable(false, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["show_add_to_cart"] = new Smarty_variable(true, null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['block']->value['properties']['show_price']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars["hide_price"] = new Smarty_variable(false, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["hide_price"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php $_smarty_tpl->tpl_vars["show_trunc_name"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_old_price"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_price"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_rating"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_clean_price"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_list_discount"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["but_role"] = new Smarty_variable("action", null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_product_labels"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_discount_label"] = new Smarty_variable(true, null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_shipping_label"] = new Smarty_variable(true, null, 0);?>


<?php echo smarty_function_script(array('src'=>"js/tygh/product_image_gallery.js"),$_smarty_tpl);?>


<?php $_smarty_tpl->tpl_vars["obj_prefix"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['block']->value['block_id'])."000", null, 0);?>
<?php $_smarty_tpl->createLocalArrayVariable('block', null, 0);
$_smarty_tpl->tpl_vars['block']->value['properties']['outside_navigation'] = "N";?>

<div id="scroll_list_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['block_id'], ENT_QUOTES, 'UTF-8');?>
" class="owl-carousel ty-scroller-list grid-list ty-scroller-advanced">
    <?php  $_smarty_tpl->tpl_vars["product"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["product"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["product"]->key => $_smarty_tpl->tpl_vars["product"]->value) {
$_smarty_tpl->tpl_vars["product"]->_loop = true;
?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:product_scroller_advanced_list")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:product_scroller_advanced_list"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <div class="ty-scroller-list__item">
            <?php if ($_smarty_tpl->tpl_vars['product']->value) {?>
                <?php $_smarty_tpl->tpl_vars["obj_id"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_id'], null, 0);?>
                <?php $_smarty_tpl->tpl_vars["obj_id_prefix"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['product']->value['product_id']), null, 0);?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/product_data.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0);?>


                <div class="ty-grid-list__item ty-quick-view-button__wrapper ty-left
                <?php if ($_smarty_tpl->tpl_vars['show_quick_view']->value) {?> ty-grid-list__item--overlay<?php }?>">
                    <?php $_smarty_tpl->tpl_vars["form_open"] = new Smarty_variable("form_open_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['form_open']->value];?>


                    <div class="ty-grid-list__image">
                        <?php $_smarty_tpl->tpl_vars["product_labels"] = new Smarty_variable("product_labels_".((string)$_smarty_tpl->tpl_vars['obj_prefix']->value).((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                        <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['product_labels']->value];?>


                        <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/product_icon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'show_gallery'=>true), 0);?>

                    </div>

                    <div class="ty-grid-list__item-name">
                        <?php if ($_smarty_tpl->tpl_vars['item_number']->value=="Y") {?>
                            <span class="item-number"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cur_number']->value, ENT_QUOTES, 'UTF-8');?>
.&nbsp;</span>
                            <?php echo smarty_function_math(array('equation'=>"num + 1",'num'=>$_smarty_tpl->tpl_vars['cur_number']->value,'assign'=>"cur_number"),$_smarty_tpl);?>

                        <?php }?>

                        <?php $_smarty_tpl->tpl_vars["name"] = new Smarty_variable("name_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                        <bdi><?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['name']->value];?>
</bdi>
                    </div>

                    <?php if (!$_smarty_tpl->tpl_vars['hide_price']->value) {?>
                        <div class="ty-grid-list__price <?php if ($_smarty_tpl->tpl_vars['product']->value['price']==0) {?>ty-grid-list__no-price<?php }?>">
                            <?php $_smarty_tpl->tpl_vars["old_price"] = new Smarty_variable("old_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php if (trim(Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['old_price']->value])) {
echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['old_price']->value];
}?>

                            <?php $_smarty_tpl->tpl_vars["price"] = new Smarty_variable("price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['price']->value];?>


                            <?php $_smarty_tpl->tpl_vars["clean_price"] = new Smarty_variable("clean_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['clean_price']->value];?>


                            <?php $_smarty_tpl->tpl_vars["list_discount"] = new Smarty_variable("list_discount_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['list_discount']->value];?>

                        </div>
                    <?php }?>

                    <?php $_smarty_tpl->tpl_vars["rating"] = new Smarty_variable("rating_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                    <?php if (Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['rating']->value]) {?>
                        <div class="grid-list__rating">
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['rating']->value];?>

                        </div>
                    <?php }?>

                    <?php $_smarty_tpl->_capture_stack[0][] = array("product_multicolumns_list_control_data_wrapper", null, null); ob_start(); ?>
                        <div class="ty-grid-list__control">
                            <?php $_smarty_tpl->_capture_stack[0][] = array("product_multicolumns_list_control_data", null, null); ob_start(); ?>
                                <?php if ($_smarty_tpl->tpl_vars['show_quick_view']->value) {?>
                                    <?php echo $_smarty_tpl->getSubTemplate ("views/products/components/quick_view_link.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('quick_nav_ids'=>$_smarty_tpl->tpl_vars['quick_nav_ids']->value), 0);?>

                                <?php }?>

                                <?php if ($_smarty_tpl->tpl_vars['show_add_to_cart']->value) {?>
                                    <div class="button-container">
                                        <?php $_smarty_tpl->tpl_vars['add_to_cart'] = new Smarty_variable("add_to_cart_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                                        <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['add_to_cart']->value];?>

                                    </div>
                                <?php }?>
                            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                            <?php echo Smarty::$_smarty_vars['capture']['product_multicolumns_list_control_data'];?>

                        </div>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>


                    <?php if (trim(Smarty::$_smarty_vars['capture']['product_multicolumns_list_control_data'])) {?>
                        <?php echo Smarty::$_smarty_vars['capture']['product_multicolumns_list_control_data_wrapper'];?>

                    <?php }?>

                    <?php $_smarty_tpl->tpl_vars["form_close"] = new Smarty_variable("form_close_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                    <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['form_close']->value];?>

                </div>
            <?php }?>
        </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:product_scroller_advanced_list"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php } ?>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("common/scroller_init.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?><?php }} ?>
