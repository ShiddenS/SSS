<?php /* Smarty version Smarty-3.1.21, created on 2019-10-30 16:07:39
         compiled from "F:\OSPanel\domains\test.local\design\themes\new_theme\templates\blocks\static_templates\knopka_service.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6747598875db98a8f9fa695-44499180%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45754d103794e79b9553b779cee1ee59a3840d60' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\new_theme\\templates\\blocks\\static_templates\\knopka_service.tpl',
      1 => 1572440856,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '6747598875db98a8f9fa695-44499180',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db98a8fa9b150_53453342',
  'variables' => 
  array (
    'runtime' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db98a8fa9b150_53453342')) {function content_5db98a8fa9b150_53453342($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><div class="col-md-offset-2 col-md-8 col-sm-12">
    <p class="wow fadeInUp" data-wow-delay="0.4s">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
    <a href="" class="wow fadeInUp btn btn-success" data-wow-delay="0.8s">CHECK OUR WORKS</a>
</div><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/static_templates/knopka_service.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/static_templates/knopka_service.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><div class="col-md-offset-2 col-md-8 col-sm-12">
    <p class="wow fadeInUp" data-wow-delay="0.4s">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
    <a href="" class="wow fadeInUp btn btn-success" data-wow-delay="0.8s">CHECK OUR WORKS</a>
</div><?php }?><?php }} ?>
