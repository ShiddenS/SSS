<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 12:22:41
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\buttons\sign_in.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9235989625db2bee1b19da2-31010585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13d4a4b86b02fac0fcbf5943ceda5b57a8a9d870' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\buttons\\sign_in.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '9235989625db2bee1b19da2-31010585',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'but_onclick' => 0,
    'but_href' => 0,
    'but_role' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2bee1b4a2d0_13402014',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2bee1b4a2d0_13402014')) {function content_5db2bee1b4a2d0_13402014($_smarty_tpl) {?><?php
\Tygh\Languages\Helper::preloadLangVars(array('sign_in'));
?>
<?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("sign_in"),'but_onclick'=>$_smarty_tpl->tpl_vars['but_onclick']->value,'but_href'=>$_smarty_tpl->tpl_vars['but_href']->value,'but_arrow'=>"on",'but_role'=>$_smarty_tpl->tpl_vars['but_role']->value), 0);?>
<?php }} ?>