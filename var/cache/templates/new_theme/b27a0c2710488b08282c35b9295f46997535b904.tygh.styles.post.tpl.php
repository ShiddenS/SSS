<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 13:09:07
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\addons\image_zoom\hooks\index\styles.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5946689525daed543a9bfa3-88599884%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b27a0c2710488b08282c35b9295f46997535b904' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\addons\\image_zoom\\hooks\\index\\styles.post.tpl',
      1 => 1571327794,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '5946689525daed543a9bfa3-88599884',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'addons' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daed543adbb03_85818261',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daed543adbb03_85818261')) {function content_5daed543adbb03_85818261($_smarty_tpl) {?><?php if (!is_callable('smarty_function_style')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.style.php';
if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><style>
    :root {
        --image-zoom-animation-time: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['addons']->value['image_zoom']['cz_animation_time'], ENT_QUOTES, 'UTF-8');?>
ms;
    }
</style>
<?php echo smarty_function_style(array('src'=>"addons/image_zoom/lib/easyzoom.css"),$_smarty_tpl);?>

<?php echo smarty_function_style(array('src'=>"addons/image_zoom/styles.less"),$_smarty_tpl);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/image_zoom/hooks/index/styles.post.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/image_zoom/hooks/index/styles.post.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><style>
    :root {
        --image-zoom-animation-time: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['addons']->value['image_zoom']['cz_animation_time'], ENT_QUOTES, 'UTF-8');?>
ms;
    }
</style>
<?php echo smarty_function_style(array('src'=>"addons/image_zoom/lib/easyzoom.css"),$_smarty_tpl);?>

<?php echo smarty_function_style(array('src'=>"addons/image_zoom/styles.less"),$_smarty_tpl);?>

<?php }?><?php }} ?>
