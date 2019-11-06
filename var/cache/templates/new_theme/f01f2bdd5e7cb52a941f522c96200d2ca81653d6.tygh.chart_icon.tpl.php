<?php /* Smarty version Smarty-3.1.21, created on 2019-10-30 19:01:10
         compiled from "F:\OSPanel\domains\test.local\design\themes\new_theme\templates\blocks\static_templates\chart_icon.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5275319105db8489f9947c1-22091742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f01f2bdd5e7cb52a941f522c96200d2ca81653d6' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\new_theme\\templates\\blocks\\static_templates\\chart_icon.tpl',
      1 => 1572451267,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '5275319105db8489f9947c1-22091742',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db848a00841c5_87621737',
  'variables' => 
  array (
    'runtime' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db848a00841c5_87621737')) {function content_5db848a00841c5_87621737($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?>
 <div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
                        <div class="chart" data-percent="85">
                            <div class="chart-icon"><i class="fa fa-laptop"></i></div>
                        </div>
                        <h3>Creative Design</h3>
                    </div>

                    <div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
                        <div class="chart" data-percent="90">
                            <div class="chart-icon"><i class="fa fa-wordpress"></i></div>
                        </div>
                        <h3>Web Development</h3>
                    </div>
                    <div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
                        <div class="chart" data-percent="80">
                            <div class="chart-icon"><i class="fa fa-cogs"></i></div>
                        </div>
                        <h3>Graphic Design</h3>
                    </div>
                    <div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
                        <div class="chart" data-percent="95">
                            <div class="chart-icon"><i class="fa fa-html5"></i></div>
                        </div>
                        <h3>Multimedia</h3>
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
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/static_templates/chart_icon.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/static_templates/chart_icon.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?>
 <div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
                        <div class="chart" data-percent="85">
                            <div class="chart-icon"><i class="fa fa-laptop"></i></div>
                        </div>
                        <h3>Creative Design</h3>
                    </div>

                    <div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
                        <div class="chart" data-percent="90">
                            <div class="chart-icon"><i class="fa fa-wordpress"></i></div>
                        </div>
                        <h3>Web Development</h3>
                    </div>
                    <div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
                        <div class="chart" data-percent="80">
                            <div class="chart-icon"><i class="fa fa-cogs"></i></div>
                        </div>
                        <h3>Graphic Design</h3>
                    </div>
                    <div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
                        <div class="chart" data-percent="95">
                            <div class="chart-icon"><i class="fa fa-html5"></i></div>
                        </div>
                        <h3>Multimedia</h3>
                    </div>
                    
<?php echo '<script'; ?>
>
 new WOW().init();
<?php echo '</script'; ?>
><?php }?><?php }} ?>
