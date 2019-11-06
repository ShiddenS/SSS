<?php /* Smarty version Smarty-3.1.21, created on 2019-10-24 10:07:17
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\addons\form_builder\hooks\pages\page_content.override.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11700440775db14da5ba7cc7-48375555%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2cba1785d746b8b661830ad0353ce0fb5c21d3e3' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\addons\\form_builder\\hooks\\pages\\page_content.override.tpl',
      1 => 1571327779,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '11700440775db14da5ba7cc7-48375555',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'page' => 0,
    'form_submit_const' => 0,
    'continue_url' => 0,
    'element' => 0,
    'var' => 0,
    'element_id' => 0,
    'form_values' => 0,
    'settings' => 0,
    'k_country' => 0,
    'countries' => 0,
    'code' => 0,
    '_country' => 0,
    'country' => 0,
    'k_state' => 0,
    'states' => 0,
    'state' => 0,
    '_state' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db14da6253415_61361517',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db14da6253415_61361517')) {function content_5db14da6253415_61361517($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_modifier_in_array')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.in_array.php';
if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('continue','select','select_country','select_state','submit','continue','select','select_country','select_state','submit'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['page']->value['page_type']==@constant('PAGE_TYPE_FORM')) {?>
    <?php if ($_REQUEST['sent']=="Y") {?>

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"pages:form_sent")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"pages:form_sent"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php $_smarty_tpl->tpl_vars["form_submit_const"] = new Smarty_variable(@constant('FORM_SUBMIT'), null, 0);?>
        <p><?php echo $_smarty_tpl->tpl_vars['page']->value['form']['general'][$_smarty_tpl->tpl_vars['form_submit_const']->value];?>
</p>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"pages:form_sent"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


        <div class="ty-form-builder__buttons buttons-container">
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("continue"),'but_meta'=>"ty-btn__secondary",'but_href'=>fn_url($_smarty_tpl->tpl_vars['continue_url']->value),'but_role'=>"action"), 0);?>

        </div>
    <?php } else { ?>

    <?php if ($_smarty_tpl->tpl_vars['page']->value['description']) {?>
        <div class="ty-form-builder__description"><?php echo $_smarty_tpl->tpl_vars['page']->value['description'];?>
</div>
    <?php }?>

<div class="ty-form-builder">
    <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="forms_form" enctype="multipart/form-data">
    <input type="hidden" name="fake" value="1" />
    <input type="hidden" name="page_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['page_id'], ENT_QUOTES, 'UTF-8');?>
" />

    <?php  $_smarty_tpl->tpl_vars["element"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["element"]->_loop = false;
 $_smarty_tpl->tpl_vars["element_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['page']->value['form']['elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["element"]->key => $_smarty_tpl->tpl_vars["element"]->value) {
$_smarty_tpl->tpl_vars["element"]->_loop = true;
 $_smarty_tpl->tpl_vars["element_id"]->value = $_smarty_tpl->tpl_vars["element"]->key;
?>

    <?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_SEPARATOR')) {?>
        <hr class="ty-form-builder__separator" />
    <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_HEADER')) {?>

    <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->tpl_vars['element']->value['description']), 0);?>

    
    <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']!=@constant('FORM_IP_ADDRESS')&&$_smarty_tpl->tpl_vars['element']->value['element_type']!=@constant('FORM_REFERER')) {?>
        <div class="ty-control-group">
            <label for="<?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_FILE')) {?>type_<?php echo htmlspecialchars(md5("fb_files[".((string)$_smarty_tpl->tpl_vars['element']->value['element_id'])."]"), ENT_QUOTES, 'UTF-8');
} else { ?>elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');
}?>" class="ty-control-group__title <?php if ($_smarty_tpl->tpl_vars['element']->value['required']=="Y") {?>cm-required<?php }
if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_EMAIL')) {?> cm-email<?php }
if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_PHONE')) {?> cm-mask-phone-label<?php }?> <?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_MULTIPLE_CB')) {?>cm-multiple-checkboxes<?php }?>"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['description'], ENT_QUOTES, 'UTF-8');?>
</label>

            <?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_SELECT')) {?>
                <select id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-form-builder__select" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]">
                    <option label="" value="">- <?php echo $_smarty_tpl->__("select");?>
 -</option>
                <?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['var']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->_loop = true;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value]==$_smarty_tpl->tpl_vars['var']->value['element_id']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['description'], ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
                </select>
                
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_RADIO')) {?>
                <?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['var']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["rd"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["rd"]['iteration']++;
?>
                <label class="ty-form-builder__radio-label">
                    <input class="ty-form-builder__radio radio" <?php if ((!$_smarty_tpl->tpl_vars['form_values']->value&&$_smarty_tpl->getVariable('smarty')->value['foreach']['rd']['iteration']==1)||($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value]==$_smarty_tpl->tpl_vars['var']->value['element_id'])) {?>checked="checked"<?php }?> type="radio" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" /><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['description'], ENT_QUOTES, 'UTF-8');?>
&nbsp;&nbsp;
                </label>
                <?php } ?>
                
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_CHECKBOX')) {?>
                <input type="hidden" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" value="N" />
                <input id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-form-builder__checkbox checkbox" <?php if ($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value]=="Y") {?>checked="checked"<?php }?> type="checkbox" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" value="Y" />
                
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_MULTIPLE_SB')) {?>
                <select class="ty-form-builder__multiple-select" id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
][]" multiple="multiple" >
                    <?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['var']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->_loop = true;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" <?php if (smarty_modifier_in_array($_smarty_tpl->tpl_vars['var']->value['element_id'],$_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value])) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['description'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
                
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_MULTIPLE_CB')) {?>
                <div id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
">
                <?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['var']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->_loop = true;
?>
                    <label class="ty-form-builder__checkbox-label">
                        <input class="ty-form-builder__checkbox" type="checkbox" <?php if (smarty_modifier_in_array($_smarty_tpl->tpl_vars['var']->value['element_id'],$_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value])) {?>checked="checked"<?php }?> id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
][]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" />
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['description'], ENT_QUOTES, 'UTF-8');?>

                    </label>
                <?php } ?>
                </div>
                
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_INPUT')) {?>
                <input id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-form-builder__input-text ty-input-text <?php if ($_smarty_tpl->tpl_vars['element']->value['position']==1) {?>cm-focus <?php }?>" size="50" type="text" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value], ENT_QUOTES, 'UTF-8');?>
" />

            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_TEXTAREA')) {?>
                <textarea id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-form-builder__textarea" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" cols="67" rows="10"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value], ENT_QUOTES, 'UTF-8');?>
</textarea>

            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_DATE')) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/calendar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('date_name'=>"form_values[".((string)$_smarty_tpl->tpl_vars['element']->value['element_id'])."]",'date_id'=>"elm_".((string)$_smarty_tpl->tpl_vars['element']->value['element_id']),'date_val'=>$_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value]), 0);?>


            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_EMAIL')||$_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_NUMBER')||$_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_PHONE')) {?>

                <?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_EMAIL')) {?>
                <input type="hidden" name="customer_email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" />
                <?php }?>
                <input id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text <?php if ($_smarty_tpl->tpl_vars['element']->value['position']==1) {?>cm-focus <?php }
if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_PHONE')) {?> cm-mask-phone<?php }?>" size="50" type="text" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value], ENT_QUOTES, 'UTF-8');?>
" />
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_COUNTRIES')) {?>
                <?php $_smarty_tpl->tpl_vars['_country'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['Checkout']['default_country'] : $tmp), null, 0);?>

                <?php if (!$_smarty_tpl->tpl_vars['k_country']->value) {?>
                    <?php $_smarty_tpl->tpl_vars["k_country"] = new Smarty_variable(1, null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars['k_country'] = new Smarty_variable($_smarty_tpl->tpl_vars['k_country']->value+1, null, 0);?>
                <?php }?>

                <select id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" class="ty-form-builder__country cm-country cm-location-billing_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k_country']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <option value="">- <?php echo $_smarty_tpl->__("select_country");?>
 -</option>
                    <?php $_smarty_tpl->tpl_vars["countries"] = new Smarty_variable(fn_get_simple_countries(1), null, 0);?>
                    <?php  $_smarty_tpl->tpl_vars["country"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["country"]->_loop = false;
 $_smarty_tpl->tpl_vars["code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['countries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["country"]->key => $_smarty_tpl->tpl_vars["country"]->value) {
$_smarty_tpl->tpl_vars["country"]->_loop = true;
 $_smarty_tpl->tpl_vars["code"]->value = $_smarty_tpl->tpl_vars["country"]->key;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['_country']->value==$_smarty_tpl->tpl_vars['code']->value) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['country']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>

            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_STATES')) {?>
                <?php if (!$_smarty_tpl->tpl_vars['k_state']->value) {?>
                    <?php $_smarty_tpl->tpl_vars["k_state"] = new Smarty_variable(1, null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars['k_state'] = new Smarty_variable($_smarty_tpl->tpl_vars['k_state']->value+1, null, 0);?>
                <?php }?>

                <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_scripts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('states'=>fn_get_all_states(1)), 0);?>


                <?php $_smarty_tpl->tpl_vars['_state'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['Checkout']['default_state'] : $tmp), null, 0);?>
                <select class="ty-form-builder__state cm-state cm-location-billing_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k_state']->value, ENT_QUOTES, 'UTF-8');?>
" id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]">
                    <option label="" value="">- <?php echo $_smarty_tpl->__("select_state");?>
 -</option>
                    <?php $_smarty_tpl->tpl_vars["states"] = new Smarty_variable(fn_get_all_states(1), null, 0);?>
                    <?php  $_smarty_tpl->tpl_vars["state"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["state"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["state"]->key => $_smarty_tpl->tpl_vars["state"]->value) {
$_smarty_tpl->tpl_vars["state"]->_loop = true;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['code'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['_state']->value==$_smarty_tpl->tpl_vars['state']->value['code']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['state'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
                <input type="text" class="cm-state cm-location-billing_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k_state']->value, ENT_QUOTES, 'UTF-8');?>
 ty-input-text hidden" id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
_d" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" size="32" maxlength="64" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_state']->value, ENT_QUOTES, 'UTF-8');?>
" disabled="disabled" />
            
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_FILE')) {?>
                <?php echo smarty_function_script(array('src'=>"js/tygh/fileuploader_scripts.js"),$_smarty_tpl);?>

                <?php echo $_smarty_tpl->getSubTemplate ("common/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"fb_files[".((string)$_smarty_tpl->tpl_vars['element']->value['element_id'])."]"), 0);?>

            <?php }?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"pages:form_elements")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"pages:form_elements"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"pages:form_elements"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </div>
    <?php }?>
    <?php } ?>

    <?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"form_builder"), 0);?>


    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"pages:additional_elements")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"pages:additional_elements"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"pages:additional_elements"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    <div class="ty-form-builder__buttons buttons-container">
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_role'=>"submit",'but_text'=>$_smarty_tpl->__("submit"),'but_meta'=>"ty-btn__secondary",'but_name'=>"dispatch[pages.send_form]"), 0);?>

    </div>

    </form>

</div>
<?php }?>
  <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"pages:page_content")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"pages:page_content"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"pages:page_content"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/form_builder/hooks/pages/page_content.override.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/form_builder/hooks/pages/page_content.override.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['page']->value['page_type']==@constant('PAGE_TYPE_FORM')) {?>
    <?php if ($_REQUEST['sent']=="Y") {?>

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"pages:form_sent")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"pages:form_sent"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php $_smarty_tpl->tpl_vars["form_submit_const"] = new Smarty_variable(@constant('FORM_SUBMIT'), null, 0);?>
        <p><?php echo $_smarty_tpl->tpl_vars['page']->value['form']['general'][$_smarty_tpl->tpl_vars['form_submit_const']->value];?>
</p>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"pages:form_sent"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


        <div class="ty-form-builder__buttons buttons-container">
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("continue"),'but_meta'=>"ty-btn__secondary",'but_href'=>fn_url($_smarty_tpl->tpl_vars['continue_url']->value),'but_role'=>"action"), 0);?>

        </div>
    <?php } else { ?>

    <?php if ($_smarty_tpl->tpl_vars['page']->value['description']) {?>
        <div class="ty-form-builder__description"><?php echo $_smarty_tpl->tpl_vars['page']->value['description'];?>
</div>
    <?php }?>

<div class="ty-form-builder">
    <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="forms_form" enctype="multipart/form-data">
    <input type="hidden" name="fake" value="1" />
    <input type="hidden" name="page_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['page_id'], ENT_QUOTES, 'UTF-8');?>
" />

    <?php  $_smarty_tpl->tpl_vars["element"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["element"]->_loop = false;
 $_smarty_tpl->tpl_vars["element_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['page']->value['form']['elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["element"]->key => $_smarty_tpl->tpl_vars["element"]->value) {
$_smarty_tpl->tpl_vars["element"]->_loop = true;
 $_smarty_tpl->tpl_vars["element_id"]->value = $_smarty_tpl->tpl_vars["element"]->key;
?>

    <?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_SEPARATOR')) {?>
        <hr class="ty-form-builder__separator" />
    <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_HEADER')) {?>

    <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->tpl_vars['element']->value['description']), 0);?>

    
    <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']!=@constant('FORM_IP_ADDRESS')&&$_smarty_tpl->tpl_vars['element']->value['element_type']!=@constant('FORM_REFERER')) {?>
        <div class="ty-control-group">
            <label for="<?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_FILE')) {?>type_<?php echo htmlspecialchars(md5("fb_files[".((string)$_smarty_tpl->tpl_vars['element']->value['element_id'])."]"), ENT_QUOTES, 'UTF-8');
} else { ?>elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');
}?>" class="ty-control-group__title <?php if ($_smarty_tpl->tpl_vars['element']->value['required']=="Y") {?>cm-required<?php }
if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_EMAIL')) {?> cm-email<?php }
if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_PHONE')) {?> cm-mask-phone-label<?php }?> <?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_MULTIPLE_CB')) {?>cm-multiple-checkboxes<?php }?>"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['description'], ENT_QUOTES, 'UTF-8');?>
</label>

            <?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_SELECT')) {?>
                <select id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-form-builder__select" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]">
                    <option label="" value="">- <?php echo $_smarty_tpl->__("select");?>
 -</option>
                <?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['var']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->_loop = true;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value]==$_smarty_tpl->tpl_vars['var']->value['element_id']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['description'], ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
                </select>
                
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_RADIO')) {?>
                <?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['var']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["rd"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["rd"]['iteration']++;
?>
                <label class="ty-form-builder__radio-label">
                    <input class="ty-form-builder__radio radio" <?php if ((!$_smarty_tpl->tpl_vars['form_values']->value&&$_smarty_tpl->getVariable('smarty')->value['foreach']['rd']['iteration']==1)||($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value]==$_smarty_tpl->tpl_vars['var']->value['element_id'])) {?>checked="checked"<?php }?> type="radio" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" /><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['description'], ENT_QUOTES, 'UTF-8');?>
&nbsp;&nbsp;
                </label>
                <?php } ?>
                
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_CHECKBOX')) {?>
                <input type="hidden" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" value="N" />
                <input id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-form-builder__checkbox checkbox" <?php if ($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value]=="Y") {?>checked="checked"<?php }?> type="checkbox" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" value="Y" />
                
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_MULTIPLE_SB')) {?>
                <select class="ty-form-builder__multiple-select" id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
][]" multiple="multiple" >
                    <?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['var']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->_loop = true;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" <?php if (smarty_modifier_in_array($_smarty_tpl->tpl_vars['var']->value['element_id'],$_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value])) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['description'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
                
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_MULTIPLE_CB')) {?>
                <div id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
">
                <?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['var']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['element']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->_loop = true;
?>
                    <label class="ty-form-builder__checkbox-label">
                        <input class="ty-form-builder__checkbox" type="checkbox" <?php if (smarty_modifier_in_array($_smarty_tpl->tpl_vars['var']->value['element_id'],$_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value])) {?>checked="checked"<?php }?> id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
][]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" />
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['description'], ENT_QUOTES, 'UTF-8');?>

                    </label>
                <?php } ?>
                </div>
                
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_INPUT')) {?>
                <input id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-form-builder__input-text ty-input-text <?php if ($_smarty_tpl->tpl_vars['element']->value['position']==1) {?>cm-focus <?php }?>" size="50" type="text" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value], ENT_QUOTES, 'UTF-8');?>
" />

            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_TEXTAREA')) {?>
                <textarea id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-form-builder__textarea" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" cols="67" rows="10"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value], ENT_QUOTES, 'UTF-8');?>
</textarea>

            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_DATE')) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/calendar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('date_name'=>"form_values[".((string)$_smarty_tpl->tpl_vars['element']->value['element_id'])."]",'date_id'=>"elm_".((string)$_smarty_tpl->tpl_vars['element']->value['element_id']),'date_val'=>$_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value]), 0);?>


            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_EMAIL')||$_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_NUMBER')||$_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_PHONE')) {?>

                <?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_EMAIL')) {?>
                <input type="hidden" name="customer_email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" />
                <?php }?>
                <input id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text <?php if ($_smarty_tpl->tpl_vars['element']->value['position']==1) {?>cm-focus <?php }
if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_PHONE')) {?> cm-mask-phone<?php }?>" size="50" type="text" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value], ENT_QUOTES, 'UTF-8');?>
" />
                
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_COUNTRIES')) {?>
                <?php $_smarty_tpl->tpl_vars['_country'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['Checkout']['default_country'] : $tmp), null, 0);?>

                <?php if (!$_smarty_tpl->tpl_vars['k_country']->value) {?>
                    <?php $_smarty_tpl->tpl_vars["k_country"] = new Smarty_variable(1, null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars['k_country'] = new Smarty_variable($_smarty_tpl->tpl_vars['k_country']->value+1, null, 0);?>
                <?php }?>

                <select id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" class="ty-form-builder__country cm-country cm-location-billing_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k_country']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <option value="">- <?php echo $_smarty_tpl->__("select_country");?>
 -</option>
                    <?php $_smarty_tpl->tpl_vars["countries"] = new Smarty_variable(fn_get_simple_countries(1), null, 0);?>
                    <?php  $_smarty_tpl->tpl_vars["country"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["country"]->_loop = false;
 $_smarty_tpl->tpl_vars["code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['countries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["country"]->key => $_smarty_tpl->tpl_vars["country"]->value) {
$_smarty_tpl->tpl_vars["country"]->_loop = true;
 $_smarty_tpl->tpl_vars["code"]->value = $_smarty_tpl->tpl_vars["country"]->key;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['_country']->value==$_smarty_tpl->tpl_vars['code']->value) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['country']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>

            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_STATES')) {?>
                <?php if (!$_smarty_tpl->tpl_vars['k_state']->value) {?>
                    <?php $_smarty_tpl->tpl_vars["k_state"] = new Smarty_variable(1, null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars['k_state'] = new Smarty_variable($_smarty_tpl->tpl_vars['k_state']->value+1, null, 0);?>
                <?php }?>

                <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_scripts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('states'=>fn_get_all_states(1)), 0);?>


                <?php $_smarty_tpl->tpl_vars['_state'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['form_values']->value[$_smarty_tpl->tpl_vars['element_id']->value])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['Checkout']['default_state'] : $tmp), null, 0);?>
                <select class="ty-form-builder__state cm-state cm-location-billing_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k_state']->value, ENT_QUOTES, 'UTF-8');?>
" id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]">
                    <option label="" value="">- <?php echo $_smarty_tpl->__("select_state");?>
 -</option>
                    <?php $_smarty_tpl->tpl_vars["states"] = new Smarty_variable(fn_get_all_states(1), null, 0);?>
                    <?php  $_smarty_tpl->tpl_vars["state"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["state"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["state"]->key => $_smarty_tpl->tpl_vars["state"]->value) {
$_smarty_tpl->tpl_vars["state"]->_loop = true;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['code'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['_state']->value==$_smarty_tpl->tpl_vars['state']->value['code']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['state'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
                <input type="text" class="cm-state cm-location-billing_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k_state']->value, ENT_QUOTES, 'UTF-8');?>
 ty-input-text hidden" id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
_d" name="form_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
]" size="32" maxlength="64" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_state']->value, ENT_QUOTES, 'UTF-8');?>
" disabled="disabled" />
            
            <?php } elseif ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_FILE')) {?>
                <?php echo smarty_function_script(array('src'=>"js/tygh/fileuploader_scripts.js"),$_smarty_tpl);?>

                <?php echo $_smarty_tpl->getSubTemplate ("common/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"fb_files[".((string)$_smarty_tpl->tpl_vars['element']->value['element_id'])."]"), 0);?>

            <?php }?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"pages:form_elements")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"pages:form_elements"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"pages:form_elements"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </div>
    <?php }?>
    <?php } ?>

    <?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"form_builder"), 0);?>


    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"pages:additional_elements")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"pages:additional_elements"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"pages:additional_elements"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    <div class="ty-form-builder__buttons buttons-container">
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_role'=>"submit",'but_text'=>$_smarty_tpl->__("submit"),'but_meta'=>"ty-btn__secondary",'but_name'=>"dispatch[pages.send_form]"), 0);?>

    </div>

    </form>

</div>
<?php }?>
  <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"pages:page_content")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"pages:page_content"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"pages:page_content"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }
}?><?php }} ?>
