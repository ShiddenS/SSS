<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:41:14
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\buttons\clone_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3261397965daf231a8b0c29-14432851%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b3c9e29c84f94294519d3754834e87e531b145ad' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\buttons\\clone_delete.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '3261397965daf231a8b0c29-14432851',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href_clone' => 0,
    'href_delete' => 0,
    'id' => 0,
    'no_confirm' => 0,
    'microformats' => 0,
    'delete_target_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf231a9b05c0_10090041',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf231a9b05c0_10090041')) {function content_5daf231a9b05c0_10090041($_smarty_tpl) {?><?php
\Tygh\Languages\Helper::preloadLangVars(array('remove','remove','remove'));
?>
<?php if ($_smarty_tpl->tpl_vars['href_clone']->value) {?>
    <a class="btn-link clone-item cm-tooltip" 
       title="<?php echo $_smarty_tpl->__("remove");?>
"
       href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['href_clone']->value), ENT_QUOTES, 'UTF-8');?>
"
    >
        <i class="icon-remove"></i>
    </a>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['href_delete']->value) {?>
    <a <?php if ($_smarty_tpl->tpl_vars['id']->value) {?>id="rm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"<?php }?>
       class="delete-item cm-tooltip <?php if (!$_smarty_tpl->tpl_vars['no_confirm']->value) {?>cm-confirm<?php }
if ($_smarty_tpl->tpl_vars['microformats']->value) {?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['microformats']->value, ENT_QUOTES, 'UTF-8');
}?>"
       title="<?php echo $_smarty_tpl->__("remove");?>
"
       <?php if ($_smarty_tpl->tpl_vars['href_delete']->value) {?>href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['href_delete']->value), ENT_QUOTES, 'UTF-8');?>
"<?php }?>
       <?php if ($_smarty_tpl->tpl_vars['delete_target_id']->value) {?>data-ca-target-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['delete_target_id']->value, ENT_QUOTES, 'UTF-8');?>
"<?php }?>
    >
        <i class="icon-remove"></i>
    </a>
<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['href_delete']->value&&!$_smarty_tpl->tpl_vars['href_clone']->value) {?>
    <button type="button"
            class="btn-link btn-link--contents delete-item cm-tooltip <?php if (!$_smarty_tpl->tpl_vars['no_confirm']->value) {?>cm-confirm<?php }
if ($_smarty_tpl->tpl_vars['microformats']->value) {?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['microformats']->value, ENT_QUOTES, 'UTF-8');
}?>"
            title="<?php echo $_smarty_tpl->__("remove");?>
"
            <?php if ($_smarty_tpl->tpl_vars['delete_target_id']->value) {?>data-ca-target-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['delete_target_id']->value, ENT_QUOTES, 'UTF-8');?>
"<?php }?>
    >
        <i class="icon-remove"></i>
    </button>
<?php }?>
<?php }} ?>
