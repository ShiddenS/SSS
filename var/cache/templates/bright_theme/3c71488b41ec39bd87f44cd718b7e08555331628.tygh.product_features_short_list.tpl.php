<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:04:13
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\views\products\components\product_features_short_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21391597035db2c89d9b0ee1-76180945%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c71488b41ec39bd87f44cd718b7e08555331628' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\views\\products\\components\\product_features_short_list.tpl',
      1 => 1571056103,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '21391597035db2c89d9b0ee1-76180945',
  'function' => 
  array (
    'feature_value' => 
    array (
      'parameter' => 
      array (
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'image_size' => 0,
    'feature' => 0,
    'product' => 0,
    'settings' => 0,
    'fvariant' => 0,
    'features' => 0,
    'no_container' => 0,
    'feature_image' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2c89da864b0_30472450',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2c89da864b0_30472450')) {function content_5db2c89da864b0_30472450($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.enum.php';
if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
$_smarty_tpl->tpl_vars["image_size"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['image_size']->value)===null||$tmp==='' ? 80 : $tmp), null, 0);?>
<?php if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\modifier.enum.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\modifier.date_format.php';
?><?php if (!function_exists('smarty_template_function_feature_value')) {
    function smarty_template_function_feature_value($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['feature_value']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
    <?php if ($_smarty_tpl->tpl_vars['feature']->value['features_hash']&&$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::EXTENDED")) {?><a href="<?php echo htmlspecialchars(fn_url("categories.view?category_id=".((string)$_smarty_tpl->tpl_vars['product']->value['main_category'])."&features_hash=".((string)$_smarty_tpl->tpl_vars['feature']->value['features_hash'])), ENT_QUOTES, 'UTF-8');?>
"><?php }
if ($_smarty_tpl->tpl_vars['feature']->value['prefix']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['prefix'], ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::DATE")) {
echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['feature']->value['value_int'],((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['date_format'])), ENT_QUOTES, 'UTF-8');
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::MULTIPLE_CHECKBOX")) {
$_smarty_tpl->tpl_vars["fvariant"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["fvariant"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['feature']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["fvariant"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["fvariant"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["fvariant"]->key => $_smarty_tpl->tpl_vars["fvariant"]->value) {
$_smarty_tpl->tpl_vars["fvariant"]->_loop = true;
 $_smarty_tpl->tpl_vars["fvariant"]->iteration++;
 $_smarty_tpl->tpl_vars["fvariant"]->last = $_smarty_tpl->tpl_vars["fvariant"]->iteration === $_smarty_tpl->tpl_vars["fvariant"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["ffev"]['last'] = $_smarty_tpl->tpl_vars["fvariant"]->last;
echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['fvariant']->value['variant'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['fvariant']->value['value'] : $tmp), ENT_QUOTES, 'UTF-8');
if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['ffev']['last']) {?>, <?php }
}
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::TEXT_SELECTBOX")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_SELECTBOX")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::EXTENDED")) {
echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['feature']->value['variant'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['feature']->value['value'] : $tmp), ENT_QUOTES, 'UTF-8');
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::SINGLE_CHECKBOX")) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['description'], ENT_QUOTES, 'UTF-8');
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_FIELD")) {
echo htmlspecialchars(floatval($_smarty_tpl->tpl_vars['feature']->value['value_int']), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['value'], ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['feature']->value['suffix']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['suffix'], ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::EXTENDED")&&$_smarty_tpl->tpl_vars['feature']->value['features_hash']) {?></a><?php }?>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


<?php if ($_smarty_tpl->tpl_vars['features']->value) {?>
    <?php if (!$_smarty_tpl->tpl_vars['no_container']->value) {?><div class="ty-features-list"><?php }
$_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['feature']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['features']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['feature']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['feature']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['feature']->key => $_smarty_tpl->tpl_vars['feature']->value) {
$_smarty_tpl->tpl_vars['feature']->_loop = true;
 $_smarty_tpl->tpl_vars['feature']->iteration++;
 $_smarty_tpl->tpl_vars['feature']->last = $_smarty_tpl->tpl_vars['feature']->iteration === $_smarty_tpl->tpl_vars['feature']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['features_list']['last'] = $_smarty_tpl->tpl_vars['feature']->last;
if ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::DATE")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_FIELD")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_SELECTBOX")) {
echo $_smarty_tpl->tpl_vars['feature']->value['description'];?>
:<?php }
if ($_smarty_tpl->tpl_vars['feature_image']->value&&$_smarty_tpl->tpl_vars['feature']->value['variants'][$_smarty_tpl->tpl_vars['feature']->value['variant_id']]['image_pairs']) {
$_smarty_tpl->tpl_vars["obj_id"] = new Smarty_variable($_smarty_tpl->tpl_vars['feature']->value['variant_id'], null, 0);?><a href="<?php echo htmlspecialchars(fn_url("categories.view?category_id=".((string)$_smarty_tpl->tpl_vars['product']->value['main_category'])."&features_hash=".((string)$_smarty_tpl->tpl_vars['feature']->value['features_hash'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->getSubTemplate ("common/image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('image_width'=>$_smarty_tpl->tpl_vars['image_size']->value,'images'=>$_smarty_tpl->tpl_vars['feature']->value['variants'][$_smarty_tpl->tpl_vars['feature']->value['variant_id']]['image_pairs'],'no_ids'=>true), 0);?>
</a><?php } else {
smarty_template_function_feature_value($_smarty_tpl,array('feature'=>$_smarty_tpl->tpl_vars['feature']->value));
if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['features_list']['last']) {?>, <?php }
}
}
if (!$_smarty_tpl->tpl_vars['no_container']->value) {?></div><?php }?>
<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/products/components/product_features_short_list.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/products/components/product_features_short_list.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
$_smarty_tpl->tpl_vars["image_size"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['image_size']->value)===null||$tmp==='' ? 80 : $tmp), null, 0);?>
<?php if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\modifier.enum.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\modifier.date_format.php';
?><?php if (!function_exists('smarty_template_function_feature_value')) {
    function smarty_template_function_feature_value($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['feature_value']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
    <?php if ($_smarty_tpl->tpl_vars['feature']->value['features_hash']&&$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::EXTENDED")) {?><a href="<?php echo htmlspecialchars(fn_url("categories.view?category_id=".((string)$_smarty_tpl->tpl_vars['product']->value['main_category'])."&features_hash=".((string)$_smarty_tpl->tpl_vars['feature']->value['features_hash'])), ENT_QUOTES, 'UTF-8');?>
"><?php }
if ($_smarty_tpl->tpl_vars['feature']->value['prefix']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['prefix'], ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::DATE")) {
echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['feature']->value['value_int'],((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['date_format'])), ENT_QUOTES, 'UTF-8');
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::MULTIPLE_CHECKBOX")) {
$_smarty_tpl->tpl_vars["fvariant"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["fvariant"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['feature']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["fvariant"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["fvariant"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["fvariant"]->key => $_smarty_tpl->tpl_vars["fvariant"]->value) {
$_smarty_tpl->tpl_vars["fvariant"]->_loop = true;
 $_smarty_tpl->tpl_vars["fvariant"]->iteration++;
 $_smarty_tpl->tpl_vars["fvariant"]->last = $_smarty_tpl->tpl_vars["fvariant"]->iteration === $_smarty_tpl->tpl_vars["fvariant"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["ffev"]['last'] = $_smarty_tpl->tpl_vars["fvariant"]->last;
echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['fvariant']->value['variant'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['fvariant']->value['value'] : $tmp), ENT_QUOTES, 'UTF-8');
if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['ffev']['last']) {?>, <?php }
}
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::TEXT_SELECTBOX")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_SELECTBOX")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::EXTENDED")) {
echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['feature']->value['variant'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['feature']->value['value'] : $tmp), ENT_QUOTES, 'UTF-8');
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::SINGLE_CHECKBOX")) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['description'], ENT_QUOTES, 'UTF-8');
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_FIELD")) {
echo htmlspecialchars(floatval($_smarty_tpl->tpl_vars['feature']->value['value_int']), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['value'], ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['feature']->value['suffix']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['suffix'], ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::EXTENDED")&&$_smarty_tpl->tpl_vars['feature']->value['features_hash']) {?></a><?php }?>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


<?php if ($_smarty_tpl->tpl_vars['features']->value) {?>
    <?php if (!$_smarty_tpl->tpl_vars['no_container']->value) {?><div class="ty-features-list"><?php }
$_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['feature']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['features']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['feature']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['feature']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['feature']->key => $_smarty_tpl->tpl_vars['feature']->value) {
$_smarty_tpl->tpl_vars['feature']->_loop = true;
 $_smarty_tpl->tpl_vars['feature']->iteration++;
 $_smarty_tpl->tpl_vars['feature']->last = $_smarty_tpl->tpl_vars['feature']->iteration === $_smarty_tpl->tpl_vars['feature']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['features_list']['last'] = $_smarty_tpl->tpl_vars['feature']->last;
if ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::DATE")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_FIELD")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_SELECTBOX")) {
echo $_smarty_tpl->tpl_vars['feature']->value['description'];?>
:<?php }
if ($_smarty_tpl->tpl_vars['feature_image']->value&&$_smarty_tpl->tpl_vars['feature']->value['variants'][$_smarty_tpl->tpl_vars['feature']->value['variant_id']]['image_pairs']) {
$_smarty_tpl->tpl_vars["obj_id"] = new Smarty_variable($_smarty_tpl->tpl_vars['feature']->value['variant_id'], null, 0);?><a href="<?php echo htmlspecialchars(fn_url("categories.view?category_id=".((string)$_smarty_tpl->tpl_vars['product']->value['main_category'])."&features_hash=".((string)$_smarty_tpl->tpl_vars['feature']->value['features_hash'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->getSubTemplate ("common/image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('image_width'=>$_smarty_tpl->tpl_vars['image_size']->value,'images'=>$_smarty_tpl->tpl_vars['feature']->value['variants'][$_smarty_tpl->tpl_vars['feature']->value['variant_id']]['image_pairs'],'no_ids'=>true), 0);?>
</a><?php } else {
smarty_template_function_feature_value($_smarty_tpl,array('feature'=>$_smarty_tpl->tpl_vars['feature']->value));
if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['features_list']['last']) {?>, <?php }
}
}
if (!$_smarty_tpl->tpl_vars['no_container']->value) {?></div><?php }?>
<?php }
}?><?php }} ?>
