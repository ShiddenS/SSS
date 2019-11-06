<?php /* Smarty version Smarty-3.1.21, created on 2019-10-30 19:29:14
         compiled from "F:\OSPanel\domains\test.local\design\themes\new_theme\templates\addons\first_addon\hooks\index\scripts.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1568956155db72b52120a78-68234684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e6bb4bc9e076fc563d12ee7d02bb8d3f6c6145b' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\new_theme\\templates\\addons\\first_addon\\hooks\\index\\scripts.post.tpl',
      1 => 1572452614,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '1568956155db72b52120a78-68234684',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db72b521afb63_83489994',
  'variables' => 
  array (
    'runtime' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db72b521afb63_83489994')) {function content_5db72b521afb63_83489994($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
echo smarty_function_script(array('src'=>"js/addons/first_addon/wow.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/jquery.easypiechart.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/custom.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/jquery.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/bootstrap.min.js"),$_smarty_tpl);?>


<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/imagesloaded.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/isotope.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/jquery.magnific-popup.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/typed.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/magnific-popup-options.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/typed-options.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"),$_smarty_tpl);
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/first_addon/hooks/index/scripts.post.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/first_addon/hooks/index/scripts.post.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
echo smarty_function_script(array('src'=>"js/addons/first_addon/wow.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/jquery.easypiechart.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/custom.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/jquery.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/bootstrap.min.js"),$_smarty_tpl);?>


<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/imagesloaded.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/isotope.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/jquery.magnific-popup.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/typed.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/magnific-popup-options.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/addons/first_addon/typed-options.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"),$_smarty_tpl);
}?><?php }} ?>
