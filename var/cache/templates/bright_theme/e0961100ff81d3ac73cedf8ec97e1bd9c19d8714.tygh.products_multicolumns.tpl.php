<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:04:13
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\blocks\products\products_multicolumns.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12037265795db2c89d160d79-40415344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0961100ff81d3ac73cedf8ec97e1bd9c19d8714' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\blocks\\products\\products_multicolumns.tpl',
      1 => 1571056100,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '12037265795db2c89d160d79-40415344',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'block' => 0,
    'items' => 0,
    '_show_add_to_cart' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2c89d197bd5_12529899',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2c89d197bd5_12529899')) {function content_5db2c89d197bd5_12529899($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?>

<?php if ($_smarty_tpl->tpl_vars['block']->value['properties']['hide_add_to_cart_button']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars["_show_add_to_cart"] = new Smarty_variable(false, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["_show_add_to_cart"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("blocks/list_templates/grid_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('products'=>$_smarty_tpl->tpl_vars['items']->value,'columns'=>$_smarty_tpl->tpl_vars['block']->value['properties']['number_of_columns'],'form_prefix'=>"block_manager",'no_sorting'=>"Y",'no_pagination'=>"Y",'no_ids'=>"Y",'obj_prefix'=>((string)$_smarty_tpl->tpl_vars['block']->value['block_id'])."000",'item_number'=>$_smarty_tpl->tpl_vars['block']->value['properties']['item_number'],'show_name'=>true,'show_old_price'=>true,'show_price'=>true,'show_rating'=>true,'show_clean_price'=>true,'show_list_discount'=>true,'show_add_to_cart'=>$_smarty_tpl->tpl_vars['_show_add_to_cart']->value,'but_role'=>"action",'show_features'=>true,'show_product_labels'=>true,'show_discount_label'=>true,'show_shipping_label'=>true), 0);
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/products/products_multicolumns.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/products/products_multicolumns.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?>

<?php if ($_smarty_tpl->tpl_vars['block']->value['properties']['hide_add_to_cart_button']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars["_show_add_to_cart"] = new Smarty_variable(false, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["_show_add_to_cart"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("blocks/list_templates/grid_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('products'=>$_smarty_tpl->tpl_vars['items']->value,'columns'=>$_smarty_tpl->tpl_vars['block']->value['properties']['number_of_columns'],'form_prefix'=>"block_manager",'no_sorting'=>"Y",'no_pagination'=>"Y",'no_ids'=>"Y",'obj_prefix'=>((string)$_smarty_tpl->tpl_vars['block']->value['block_id'])."000",'item_number'=>$_smarty_tpl->tpl_vars['block']->value['properties']['item_number'],'show_name'=>true,'show_old_price'=>true,'show_price'=>true,'show_rating'=>true,'show_clean_price'=>true,'show_list_discount'=>true,'show_add_to_cart'=>$_smarty_tpl->tpl_vars['_show_add_to_cart']->value,'but_role'=>"action",'show_features'=>true,'show_product_labels'=>true,'show_discount_label'=>true,'show_shipping_label'=>true), 0);
}?><?php }} ?>
