<?php /* Smarty version Smarty-3.1.21, created on 2019-10-30 16:18:26
         compiled from "F:\OSPanel\domains\test.local\design\themes\new_theme\templates\blocks\static_templates\contact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3577230855db98cf86c7533-27006986%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90fb700fa08b07d7c59d85145fda3d0042375c96' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\new_theme\\templates\\blocks\\static_templates\\contact.tpl',
      1 => 1572441503,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '3577230855db98cf86c7533-27006986',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db98cf878f316_48442836',
  'variables' => 
  array (
    'runtime' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db98cf878f316_48442836')) {function content_5db98cf878f316_48442836($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><div class="wow fadeInUp col-md-4 col-sm-4" data-wow-delay="0.6s">
    <div class="contact-detail">

        <div class="contact-detail-1">
            <h3>Headquarter</h3>
            <p class="small">345 Venue Street, Suite 1800 California United States</p>
            <p class="small">000 243 159 1256 / 000 243 159 4568</p>
            <p class="small">hello@miniml.com</p>
        </div>
        <div class="contact-detail-2">
            <h3>London Office</h3>
            <p class="small">459 New Street, Suite 2000 London</p>
            <p class="small">000 243 159 1256 / 000 243 159 4568</p>
            <p class="small">hello@miniml.com</p>
        </div>

    </div>
</div>

<div class="wow fadeInUp col-md-8 col-sm-8" data-wow-delay="0.4s">
    <form action="contact.php" method="post">
        <div class="col-md-6 col-sm-6">
            <input type="text" class="form-control" placeholder="Your Name" required>
        </div>

        <div class="col-md-6 col-sm-6">
            <input type="email" class="form-control" placeholder="Your Email here" required>
        </div>

        <div class="col-md-12 col-sm-12">
            <input type="tel" class="form-control" placeholder="Your Phone" required>
            <textarea class="form-control" placeholder="Your Message" rows="6" required></textarea>
        </div>

        <div class="col-md-4 col-sm-6">
            <input type="submit" class="form-control" value="Send Message">
        </div>
    </form>
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
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/static_templates/contact.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/static_templates/contact.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><div class="wow fadeInUp col-md-4 col-sm-4" data-wow-delay="0.6s">
    <div class="contact-detail">

        <div class="contact-detail-1">
            <h3>Headquarter</h3>
            <p class="small">345 Venue Street, Suite 1800 California United States</p>
            <p class="small">000 243 159 1256 / 000 243 159 4568</p>
            <p class="small">hello@miniml.com</p>
        </div>
        <div class="contact-detail-2">
            <h3>London Office</h3>
            <p class="small">459 New Street, Suite 2000 London</p>
            <p class="small">000 243 159 1256 / 000 243 159 4568</p>
            <p class="small">hello@miniml.com</p>
        </div>

    </div>
</div>

<div class="wow fadeInUp col-md-8 col-sm-8" data-wow-delay="0.4s">
    <form action="contact.php" method="post">
        <div class="col-md-6 col-sm-6">
            <input type="text" class="form-control" placeholder="Your Name" required>
        </div>

        <div class="col-md-6 col-sm-6">
            <input type="email" class="form-control" placeholder="Your Email here" required>
        </div>

        <div class="col-md-12 col-sm-12">
            <input type="tel" class="form-control" placeholder="Your Phone" required>
            <textarea class="form-control" placeholder="Your Message" rows="6" required></textarea>
        </div>

        <div class="col-md-4 col-sm-6">
            <input type="submit" class="form-control" value="Send Message">
        </div>
    </form>
</div>
<?php echo '<script'; ?>
>
 new WOW().init();
<?php echo '</script'; ?>
><?php }?><?php }} ?>
