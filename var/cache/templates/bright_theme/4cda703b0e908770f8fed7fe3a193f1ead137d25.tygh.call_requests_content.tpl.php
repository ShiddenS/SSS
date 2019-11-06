<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:03:48
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\addons\call_requests\views\call_requests\components\call_requests_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17199132695db2c884158041-20983530%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4cda703b0e908770f8fed7fe3a193f1ead137d25' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\addons\\call_requests\\views\\call_requests\\components\\call_requests_content.tpl',
      1 => 1571327775,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '17199132695db2c884158041-20983530',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'id' => 0,
    'product' => 0,
    'obj_prefix' => 0,
    'config' => 0,
    'settings' => 0,
    'call_data' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2c8842497a3_73291934',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2c8842497a3_73291934')) {function content_5db2c8842497a3_73291934($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('your_name','phone','or','email','call_requests.enter_phone_or_email_text','call_requests.convenient_time','submit','your_name','phone','or','email','call_requests.enter_phone_or_email_text','call_requests.convenient_time','submit'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><div id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">

<form name="call_requests_form<?php if (!$_smarty_tpl->tpl_vars['product']->value) {?>_main<?php }?>" id="form_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" class="cm-ajax<?php if (!$_smarty_tpl->tpl_vars['product']->value) {?> cm-ajax-full-render<?php }?> cm-processing-personal-data" data-ca-processing-personal-data-without-click="true" <?php if ($_smarty_tpl->tpl_vars['product']->value) {?> data-ca-product-form="product_form_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"call_requests:call_requests_form")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"call_requests:call_requests_form"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<input type="hidden" name="result_ids" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="return_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />

<?php if ($_smarty_tpl->tpl_vars['product']->value) {?>
    <input type="hidden" name="call_data[product_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
" />
    <div class="ty-cr-product-info-container">
        <div class="ty-cr-product-info-image">
            <?php echo $_smarty_tpl->getSubTemplate ("common/image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('images'=>$_smarty_tpl->tpl_vars['product']->value['main_pair'],'image_width'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_width'],'image_height'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_height']), 0);?>

        </div>
        <div class="ty-cr-product-info-header">
            <h3 class="ty-product-block-title"><bdi><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product'], ENT_QUOTES, 'UTF-8');?>
</bdi></h3>
        </div>
    </div>
<?php }?>

<div class="ty-control-group">
    <label class="ty-control-group__title" for="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_name"><?php echo $_smarty_tpl->__("your_name");?>
</label>
    <input id="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_name" size="50" class="ty-input-text-full" type="text" name="call_data[name]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['call_data']->value['name'], ENT_QUOTES, 'UTF-8');?>
" />
</div>

<div class="ty-control-group">
    <label for="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_phone" class="ty-control-group__title cm-mask-phone-label<?php if (!$_smarty_tpl->tpl_vars['product']->value) {?> cm-required<?php }?>"><?php echo $_smarty_tpl->__("phone");?>
</label>
    <input id="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_phone" class="ty-input-text-full cm-mask-phone ty-inputmask-bdi" size="50" type="text" name="call_data[phone]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['call_data']->value['phone'], ENT_QUOTES, 'UTF-8');?>
" data-enable-custom-mask="true" />
</div>

<?php if ($_smarty_tpl->tpl_vars['product']->value) {?>

    <div class="ty-cr-or">— <?php echo $_smarty_tpl->__("or");?>
 —</div>

    <div class="ty-control-group">
        <label for="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_email" class="ty-control-group__title cm-email"><?php echo $_smarty_tpl->__("email");?>
</label>
        <input id="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_email" class="ty-input-text-full" size="50" type="text" name="call_data[email]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['call_data']->value['email'], ENT_QUOTES, 'UTF-8');?>
" />
    </div>

    <div class="cr-popup-error-box">
        <div class="hidden cm-cr-error-box help-inline">
            <p><?php echo $_smarty_tpl->__("call_requests.enter_phone_or_email_text");?>
</p>
        </div>
    </div>

<?php } else { ?>

    <div class="ty-control-group">
        <label for="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_convenient_time_from" class="ty-control-group__title"><?php echo $_smarty_tpl->__("call_requests.convenient_time");?>
</label>
        <bdi>
            <input id="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_convenient_time_from" class="ty-input-text cm-cr-mask-time" size="6" type="text" name="call_data[time_from]" value="" placeholder="<?php echo htmlspecialchars(@constant('CALL_REQUESTS_DEFAULT_TIME_FROM'), ENT_QUOTES, 'UTF-8');?>
" /> -
            <input id="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_convenient_time_to" class="ty-input-text cm-cr-mask-time" size="6" type="text" name="call_data[time_to]" value="" placeholder="<?php echo htmlspecialchars(@constant('CALL_REQUESTS_DEFAULT_TIME_TO'), ENT_QUOTES, 'UTF-8');?>
" />
        </bdi>
    </div>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"call_request"), 0);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"call_requests:call_requests_form"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<div class="cm-block-add-subscribe">
</div>

<div class="buttons-container">
    <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[call_requests.request]",'but_text'=>$_smarty_tpl->__("submit"),'but_role'=>"submit",'but_meta'=>"ty-btn__primary ty-btn__big cm-form-dialog-closer ty-btn"), 0);?>

</div>

</form>

<!--<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/call_requests/views/call_requests/components/call_requests_content.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/call_requests/views/call_requests/components/call_requests_content.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><div id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">

<form name="call_requests_form<?php if (!$_smarty_tpl->tpl_vars['product']->value) {?>_main<?php }?>" id="form_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" class="cm-ajax<?php if (!$_smarty_tpl->tpl_vars['product']->value) {?> cm-ajax-full-render<?php }?> cm-processing-personal-data" data-ca-processing-personal-data-without-click="true" <?php if ($_smarty_tpl->tpl_vars['product']->value) {?> data-ca-product-form="product_form_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_prefix']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"call_requests:call_requests_form")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"call_requests:call_requests_form"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<input type="hidden" name="result_ids" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="return_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />

<?php if ($_smarty_tpl->tpl_vars['product']->value) {?>
    <input type="hidden" name="call_data[product_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
" />
    <div class="ty-cr-product-info-container">
        <div class="ty-cr-product-info-image">
            <?php echo $_smarty_tpl->getSubTemplate ("common/image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('images'=>$_smarty_tpl->tpl_vars['product']->value['main_pair'],'image_width'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_width'],'image_height'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_height']), 0);?>

        </div>
        <div class="ty-cr-product-info-header">
            <h3 class="ty-product-block-title"><bdi><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product'], ENT_QUOTES, 'UTF-8');?>
</bdi></h3>
        </div>
    </div>
<?php }?>

<div class="ty-control-group">
    <label class="ty-control-group__title" for="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_name"><?php echo $_smarty_tpl->__("your_name");?>
</label>
    <input id="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_name" size="50" class="ty-input-text-full" type="text" name="call_data[name]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['call_data']->value['name'], ENT_QUOTES, 'UTF-8');?>
" />
</div>

<div class="ty-control-group">
    <label for="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_phone" class="ty-control-group__title cm-mask-phone-label<?php if (!$_smarty_tpl->tpl_vars['product']->value) {?> cm-required<?php }?>"><?php echo $_smarty_tpl->__("phone");?>
</label>
    <input id="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_phone" class="ty-input-text-full cm-mask-phone ty-inputmask-bdi" size="50" type="text" name="call_data[phone]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['call_data']->value['phone'], ENT_QUOTES, 'UTF-8');?>
" data-enable-custom-mask="true" />
</div>

<?php if ($_smarty_tpl->tpl_vars['product']->value) {?>

    <div class="ty-cr-or">— <?php echo $_smarty_tpl->__("or");?>
 —</div>

    <div class="ty-control-group">
        <label for="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_email" class="ty-control-group__title cm-email"><?php echo $_smarty_tpl->__("email");?>
</label>
        <input id="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_email" class="ty-input-text-full" size="50" type="text" name="call_data[email]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['call_data']->value['email'], ENT_QUOTES, 'UTF-8');?>
" />
    </div>

    <div class="cr-popup-error-box">
        <div class="hidden cm-cr-error-box help-inline">
            <p><?php echo $_smarty_tpl->__("call_requests.enter_phone_or_email_text");?>
</p>
        </div>
    </div>

<?php } else { ?>

    <div class="ty-control-group">
        <label for="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_convenient_time_from" class="ty-control-group__title"><?php echo $_smarty_tpl->__("call_requests.convenient_time");?>
</label>
        <bdi>
            <input id="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_convenient_time_from" class="ty-input-text cm-cr-mask-time" size="6" type="text" name="call_data[time_from]" value="" placeholder="<?php echo htmlspecialchars(@constant('CALL_REQUESTS_DEFAULT_TIME_FROM'), ENT_QUOTES, 'UTF-8');?>
" /> -
            <input id="call_data_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_convenient_time_to" class="ty-input-text cm-cr-mask-time" size="6" type="text" name="call_data[time_to]" value="" placeholder="<?php echo htmlspecialchars(@constant('CALL_REQUESTS_DEFAULT_TIME_TO'), ENT_QUOTES, 'UTF-8');?>
" />
        </bdi>
    </div>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"call_request"), 0);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"call_requests:call_requests_form"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<div class="cm-block-add-subscribe">
</div>

<div class="buttons-container">
    <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[call_requests.request]",'but_text'=>$_smarty_tpl->__("submit"),'but_role'=>"submit",'but_meta'=>"ty-btn__primary ty-btn__big cm-form-dialog-closer ty-btn"), 0);?>

</div>

</form>

<!--<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
<?php }?><?php }} ?>
