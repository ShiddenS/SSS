<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:56:30
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\blog\hooks\block_manager\update_block_picker_extra_url.override.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13462190655db2d4dee59422-30098728%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80371d67923aabe183239d11e6da343836b0b8a8' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\blog\\hooks\\block_manager\\update_block_picker_extra_url.override.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '13462190655db2d4dee59422-30098728',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dynamic_object_scheme' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2d4df07cb02_56045488',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2d4df07cb02_56045488')) {function content_5db2d4df07cb02_56045488($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['dynamic_object_scheme']->value['customer_dispatch']=="pages.view?page_type=".((string)@constant('PAGE_TYPE_BLOG'))) {?>
    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dynamic_object_scheme']->value['picker_params']['extra_url'], ENT_QUOTES, 'UTF-8');?>
&page_type=<?php echo htmlspecialchars(@constant('PAGE_TYPE_BLOG'), ENT_QUOTES, 'UTF-8');?>

<?php }?><?php }} ?>
