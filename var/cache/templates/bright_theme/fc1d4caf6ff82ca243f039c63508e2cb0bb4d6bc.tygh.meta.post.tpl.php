<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:03:20
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\addons\social_buttons\hooks\index\meta.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12869934435db2c868581057-15793131%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc1d4caf6ff82ca243f039c63508e2cb0bb4d6bc' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\addons\\social_buttons\\hooks\\index\\meta.post.tpl',
      1 => 1571327750,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '12869934435db2c868581057-15793131',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'display_button_block' => 0,
    'provider_meta_data' => 0,
    'meta_name' => 0,
    'meta_value' => 0,
    'provider_settings' => 0,
    'provider_data' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2c8685cd184_32785960',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2c8685cd184_32785960')) {function content_5db2c8685cd184_32785960($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['display_button_block']->value) {?>
    <?php  $_smarty_tpl->tpl_vars["meta_value"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["meta_value"]->_loop = false;
 $_smarty_tpl->tpl_vars["meta_name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['provider_meta_data']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["meta_value"]->key => $_smarty_tpl->tpl_vars["meta_value"]->value) {
$_smarty_tpl->tpl_vars["meta_value"]->_loop = true;
 $_smarty_tpl->tpl_vars["meta_name"]->value = $_smarty_tpl->tpl_vars["meta_value"]->key;
?>
        <meta property="og:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_name']->value, ENT_QUOTES, 'UTF-8');?>
" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_value']->value, ENT_QUOTES, 'UTF-8');?>
" />
    <?php } ?>

    <?php  $_smarty_tpl->tpl_vars["provider_data"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["provider_data"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['provider_settings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["provider_data"]->key => $_smarty_tpl->tpl_vars["provider_data"]->value) {
$_smarty_tpl->tpl_vars["provider_data"]->_loop = true;
?>
        <?php if ($_smarty_tpl->tpl_vars['provider_data']->value&&$_smarty_tpl->tpl_vars['provider_data']->value['meta_template']) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("addons/social_buttons/meta_templates/".((string)$_smarty_tpl->tpl_vars['provider_data']->value['meta_template']), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php }?>
    <?php } ?>
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/social_buttons/hooks/index/meta.post.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/social_buttons/hooks/index/meta.post.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['display_button_block']->value) {?>
    <?php  $_smarty_tpl->tpl_vars["meta_value"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["meta_value"]->_loop = false;
 $_smarty_tpl->tpl_vars["meta_name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['provider_meta_data']->value['all']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["meta_value"]->key => $_smarty_tpl->tpl_vars["meta_value"]->value) {
$_smarty_tpl->tpl_vars["meta_value"]->_loop = true;
 $_smarty_tpl->tpl_vars["meta_name"]->value = $_smarty_tpl->tpl_vars["meta_value"]->key;
?>
        <meta property="og:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_name']->value, ENT_QUOTES, 'UTF-8');?>
" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_value']->value, ENT_QUOTES, 'UTF-8');?>
" />
    <?php } ?>

    <?php  $_smarty_tpl->tpl_vars["provider_data"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["provider_data"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['provider_settings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["provider_data"]->key => $_smarty_tpl->tpl_vars["provider_data"]->value) {
$_smarty_tpl->tpl_vars["provider_data"]->_loop = true;
?>
        <?php if ($_smarty_tpl->tpl_vars['provider_data']->value&&$_smarty_tpl->tpl_vars['provider_data']->value['meta_template']) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("addons/social_buttons/meta_templates/".((string)$_smarty_tpl->tpl_vars['provider_data']->value['meta_template']), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php }?>
    <?php } ?>
<?php }?>
<?php }?><?php }} ?>
