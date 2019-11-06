<?php /* Smarty version Smarty-3.1.21, created on 2019-10-30 17:30:24
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\form_builder\views\pages\components\element_types.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16108647565db99e80482f42-07910135%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a433970cf0d923cac10cc888b10ea65bdae8a5e' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\form_builder\\views\\pages\\components\\element_types.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '16108647565db99e80482f42-07910135',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'elm_id' => 0,
    'num' => 0,
    'selectable_elements' => 0,
    'element_type' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db99e80549354_81188414',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db99e80549354_81188414')) {function content_5db99e80549354_81188414($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('base','selectbox','radiogroup','multiple_checkboxes','multiple_selectbox','checkbox','input_field','textarea','header','separator','special','date','email','number','phone','countries_list','states_list','file','referer','ip_address'));
?>
<select id="elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][element_type]" onchange="fn_check_element_type(this.value, this.id, '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selectable_elements']->value, ENT_QUOTES, 'UTF-8');?>
');">
    <optgroup label="<?php echo $_smarty_tpl->__("base");?>
">
    <option value="<?php echo htmlspecialchars(@constant('FORM_SELECT'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_SELECT')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("selectbox");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_RADIO'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_RADIO')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("radiogroup");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_MULTIPLE_CB'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_MULTIPLE_CB')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("multiple_checkboxes");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_MULTIPLE_SB'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_MULTIPLE_SB')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("multiple_selectbox");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_CHECKBOX'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_CHECKBOX')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("checkbox");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_INPUT'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_INPUT')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("input_field");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_TEXTAREA'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_TEXTAREA')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("textarea");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_HEADER'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_HEADER')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("header");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_SEPARATOR'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_SEPARATOR')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("separator");?>
</option>
    </optgroup>
    <optgroup label="<?php echo $_smarty_tpl->__("special");?>
">
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"pages:form_elements")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"pages:form_elements"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <option value="<?php echo htmlspecialchars(@constant('FORM_DATE'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_DATE')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("date");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_EMAIL'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_EMAIL')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("email");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_NUMBER'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_NUMBER')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("number");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_PHONE'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_PHONE')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("phone");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_COUNTRIES'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_COUNTRIES')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("countries_list");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_STATES'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_STATES')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("states_list");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_FILE'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_FILE')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("file");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_REFERER'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_REFERER')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("referer");?>
</option>
    <option value="<?php echo htmlspecialchars(@constant('FORM_IP_ADDRESS'), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['element_type']->value==@constant('FORM_IP_ADDRESS')) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("ip_address");?>
</option>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"pages:form_elements"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </optgroup>
</select><?php }} ?>
