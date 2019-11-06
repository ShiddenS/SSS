<?php /* Smarty version Smarty-3.1.21, created on 2019-10-29 13:20:37
         compiled from "F:\OSPanel\domains\test.local\design\themes\new_theme\templates\blocks\static_templates\team.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1834850275db728392ca3f6-91390210%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '623b441c67e2eaa6c0ac478fb940c1be39e4c17c' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\new_theme\\templates\\blocks\\static_templates\\team.tpl',
      1 => 1572344427,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '1834850275db728392ca3f6-91390210',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db728395ca096_20645064',
  'variables' => 
  array (
    'runtime' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db728395ca096_20645064')) {function content_5db728395ca096_20645064($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?>
<div class="wow fadeInUp ty-column4" data-wow-delay="0.4s">
    <div class="team-thumb">
        <img src="images/companies/1/team/team-img01.jpg" class="img-responsive" alt="Team">
            <div class="team-overlay">
                <h3>David P. Hughley</h3>
                <h4>Web Designer</h4>
                <ul class="social-icon">
                    <li><a href="team" class="fa fa-facebook"></a></li>
                    <li><a href="team" class="fa fa-twitter"></a></li>
                    <li><a href="team" class="fa fa-google-plus"></a></li>
                </ul>
            </div>
    </div>
</div>

<div class="wow fadeInUp ty-column4" data-wow-delay="0.6s">
    <div class="team-thumb">
        <img src="images/companies/1/team/team-img02.jpg" class="img-responsive" alt="Team">
            <div class="team-overlay">
                <h3>William C. Salas</h3>
                <h4>Digital Marketer</h4>
                <ul class="social-icon">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                </ul>
            </div>
    </div>
</div>

<div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
    <div class="team-thumb">
        <img src="images/companies/1/team/team-img03.jpg" class="img-responsive" alt="Team">
            <div class="team-overlay">
                <h3>Kristin J. Martin</h3>
                <h4>Graphics Designer</h4>
                <ul class="social-icon">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                </ul>
            </div>
    </div>
</div>

<div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
    <div class="team-thumb">
        <img src="images/companies/1/team/team-img04.jpg" class="img-responsive" alt="Team">
            <div class="team-overlay">
                <h3>Endrea Manning</h3>
                <h4>UI Designer</h4>
                <ul class="social-icon">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                </ul>
            </div>
    </div>
</div><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/static_templates/team.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/static_templates/team.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?>
<div class="wow fadeInUp ty-column4" data-wow-delay="0.4s">
    <div class="team-thumb">
        <img src="images/companies/1/team/team-img01.jpg" class="img-responsive" alt="Team">
            <div class="team-overlay">
                <h3>David P. Hughley</h3>
                <h4>Web Designer</h4>
                <ul class="social-icon">
                    <li><a href="team" class="fa fa-facebook"></a></li>
                    <li><a href="team" class="fa fa-twitter"></a></li>
                    <li><a href="team" class="fa fa-google-plus"></a></li>
                </ul>
            </div>
    </div>
</div>

<div class="wow fadeInUp ty-column4" data-wow-delay="0.6s">
    <div class="team-thumb">
        <img src="images/companies/1/team/team-img02.jpg" class="img-responsive" alt="Team">
            <div class="team-overlay">
                <h3>William C. Salas</h3>
                <h4>Digital Marketer</h4>
                <ul class="social-icon">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                </ul>
            </div>
    </div>
</div>

<div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
    <div class="team-thumb">
        <img src="images/companies/1/team/team-img03.jpg" class="img-responsive" alt="Team">
            <div class="team-overlay">
                <h3>Kristin J. Martin</h3>
                <h4>Graphics Designer</h4>
                <ul class="social-icon">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                </ul>
            </div>
    </div>
</div>

<div class="wow fadeInUp ty-column4" data-wow-delay="0.8s">
    <div class="team-thumb">
        <img src="images/companies/1/team/team-img04.jpg" class="img-responsive" alt="Team">
            <div class="team-overlay">
                <h3>Endrea Manning</h3>
                <h4>UI Designer</h4>
                <ul class="social-icon">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                </ul>
            </div>
    </div>
</div><?php }?><?php }} ?>
