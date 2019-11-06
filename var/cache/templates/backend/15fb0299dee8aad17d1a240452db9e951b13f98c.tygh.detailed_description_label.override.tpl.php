<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:48:07
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\blog\hooks\pages\detailed_description_label.override.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17691431585db2d2e7b596a6-94140722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15fb0299dee8aad17d1a240452db9e951b13f98c' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\blog\\hooks\\pages\\detailed_description_label.override.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '17691431585db2d2e7b596a6-94140722',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_type' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2d2e7c08e96_83436308',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2d2e7c08e96_83436308')) {function content_5db2d2e7c08e96_83436308($_smarty_tpl) {?><?php
\Tygh\Languages\Helper::preloadLangVars(array('post_description','ttc_post_description'));
?>
<?php if ($_smarty_tpl->tpl_vars['page_type']->value==@constant('PAGE_TYPE_BLOG')) {?>
    <label class="control-label" for="elm_page_descr"><?php echo $_smarty_tpl->__("post_description");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("ttc_post_description")), 0);?>
:</label>
<?php }?>
<?php }} ?>
