<?php /* Smarty version Smarty-3.1.21, created on 2019-10-30 20:05:06
         compiled from "F:\OSPanel\domains\test.local\design\themes\new_theme\templates\blocks\static_templates\social_icon.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2908683615db81a468b4780-17345789%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c6e8909027578edbe45a79d0ff28fe28ba9fba2' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\new_theme\\templates\\blocks\\static_templates\\social_icon.tpl',
      1 => 1572455100,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '2908683615db81a468b4780-17345789',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db81a47755b41_43715849',
  'variables' => 
  array (
    'runtime' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db81a47755b41_43715849')) {function content_5db81a47755b41_43715849($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><div class="social-icon">
    <div class="footer-copyright">
        <ul class="social-icon">    
            <li><a href="#" class="fa fa-facebook wow fadeInUp" data-wow-delay="0.2s"></a></li>
            <li><a href="#" class="fa fa-twitter wow fadeInUp" data-wow-delay="0.4s"></a></li>
            <li><a href="#" class="fa fa-linkedin wow fadeInUp" data-wow-delay="0.6s"></a></li>
            <li><a href="#" class="fa fa-google-plus wow fadeInUp" data-wow-delay="0.8s"></a></li>
            <li><a href="#" class="fa fa-dribbble wow fadeInUp" data-wow-delay="1s"></a></li>
        </ul>
        <p class="small">&copy Copyright 2018  Miniml HTML Template - All Rights Reserved</p>
    </div>
</div>
<?php echo '<script'; ?>
>
 new WOW().init();
<?php echo '</script'; ?>
><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/static_templates/social_icon.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/static_templates/social_icon.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><div class="social-icon">
    <div class="footer-copyright">
        <ul class="social-icon">    
            <li><a href="#" class="fa fa-facebook wow fadeInUp" data-wow-delay="0.2s"></a></li>
            <li><a href="#" class="fa fa-twitter wow fadeInUp" data-wow-delay="0.4s"></a></li>
            <li><a href="#" class="fa fa-linkedin wow fadeInUp" data-wow-delay="0.6s"></a></li>
            <li><a href="#" class="fa fa-google-plus wow fadeInUp" data-wow-delay="0.8s"></a></li>
            <li><a href="#" class="fa fa-dribbble wow fadeInUp" data-wow-delay="1s"></a></li>
        </ul>
        <p class="small">&copy Copyright 2018  Miniml HTML Template - All Rights Reserved</p>
    </div>
</div>
<?php echo '<script'; ?>
>
 new WOW().init();
<?php echo '</script'; ?>
><?php }?><?php }} ?>
