<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:12:08
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\help_tutorial\components\video_sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3813790515daf1c48c1ce23-71334368%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7970bab8228bbdf7af3dce6551550e6902fef8eb' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\help_tutorial\\components\\video_sidebar.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '3813790515daf1c48c1ce23-71334368',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'open' => 0,
    'items' => 0,
    'hash' => 0,
    'params' => 0,
    'language_direction' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1c493186d5_39200825',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1c493186d5_39200825')) {function content_5daf1c493186d5_39200825($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_modifier_count')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.count.php';
if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('help_tutorial.videos_show'));
?>
<?php echo smarty_function_script(array('src'=>"js/lib/owlcarousel/owl.carousel.min.js"),$_smarty_tpl);?>


<div class="help-tutorial-wrapper <?php if (!$_smarty_tpl->tpl_vars['open']->value) {?>close-content<?php }?> <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['items']->value)>1) {?>help-tutorial-video<?php }?>" id="help_tutorial_video"><div class="help-tutorial-content clearfix <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['items']->value)>1) {?>owl-carousel help-tutorial-slider<?php }?> <?php if ($_smarty_tpl->tpl_vars['open']->value) {?> open<?php }?>" id="help_tutorial_content"><?php  $_smarty_tpl->tpl_vars['hash'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['hash']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['hash']->key => $_smarty_tpl->tpl_vars['hash']->value) {
$_smarty_tpl->tpl_vars['hash']->_loop = true;
?><div class="help-tutorial-content_width_big"><iframe width="640" height="360" src="//www.youtube.com/embed/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['hash']->value, ENT_QUOTES, 'UTF-8');?>
?enablejsapi=1&wmode=transparent&rel=0&html5=1<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['params']->value, ENT_QUOTES, 'UTF-8');?>
" frameborder="0" allowfullscreen></iframe></div><?php } ?></div><div class="help-tutorial-all-video"><a href="https://www.cs-cart.ru/videos/admin/" target="_blank"><?php echo $_smarty_tpl->__("help_tutorial.videos_show");?>
</a></div></div><?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">(function(_, $) {$(function() {$('#help_tutorial_link').on('click', function() {$(this).toggleClass('open');$('#help_tutorial_content').toggleClass('open');$('#help_tutorial_video').toggleClass('close-content');});if ($('#help_tutorial_video').length) {$('#header').addClass('help-tutorial-video-header');}});$(document).on('click', '.help-tutorial-video .owl-controls', function() {$('.help-tutorial-video').find('iframe').each(function() {$(this)[0].contentWindow.postMessage(JSON.stringify({"event": "command","func": "pauseVideo","args": ""}), "*");});});$(document).on('click', '.help-tutorial-close', function() {$('.help-tutorial-video').find('iframe').each(function() {$(this)[0].contentWindow.postMessage(JSON.stringify({"event": "command","func": "pauseVideo","args": ""}), "*");});});$.ceEvent('on', 'ce.commoninit', function(context) {var slider = context.find('#help_tutorial_content.help-tutorial-slider');if (slider.length) {slider.owlCarousel({direction: '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['language_direction']->value, ENT_QUOTES, 'UTF-8');?>
',items: 1,singleItem : true,autoPlay: false,stopOnHover: true,pagination: true,paginationNumbers: true,navigation: true,navigationText: ['', '']});}});}(Tygh, Tygh.$));<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>
