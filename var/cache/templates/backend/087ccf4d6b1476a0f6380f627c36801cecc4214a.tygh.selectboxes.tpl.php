<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:18:40
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\exim\components\selectboxes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17835033435daf1dd0eff502-08542168%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '087ccf4d6b1476a0f6380f627c36801cecc4214a' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\exim\\components\\selectboxes.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '17835033435daf1dd0eff502-08542168',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'left_id' => 0,
    'left_name' => 0,
    'assigned_ids' => 0,
    'key' => 0,
    'items' => 0,
    'label' => 0,
    'item' => 0,
    'ldelim' => 0,
    'rdelim' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1dd10ab605_65345466',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1dd10ab605_65345466')) {function content_5daf1dd10ab605_65345466($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_in_array')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.in_array.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('text_exim_export_notice','exported_fields','available_fields'));
?>
<p class="muted"><?php echo $_smarty_tpl->__("text_exim_export_notice");?>
</p>
<div class="table-wrapper">
    <table width="100%">
        <tr>
            <td class="center">
                <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-required cm-all multiply-select-header"><?php echo $_smarty_tpl->__("exported_fields");?>
</label></td>
            <td>&nbsp;</td>
            <td class="center">
               <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_id']->value, ENT_QUOTES, 'UTF-8');?>
_right"><?php echo $_smarty_tpl->__("available_fields");?>
</label>
            </td>
        </tr>
    </table>
</div>
<hr>
<div class="table-wrapper">
    <table width="100%">
        <tr>
            <td width="48%">
                <select id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_name']->value, ENT_QUOTES, 'UTF-8');?>
[]" multiple="multiple" class="input-full toll-select">
                <?php  $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['key']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['assigned_ids']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['key']->key => $_smarty_tpl->tpl_vars['key']->value) {
$_smarty_tpl->tpl_vars['key']->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->tpl_vars['key']->value]) {?>
                        <?php $_smarty_tpl->tpl_vars['label'] = new Smarty_variable(fn_exim_get_field_label($_smarty_tpl->tpl_vars['key']->value), null, 0);?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
" selected="selected" <?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->tpl_vars['key']->value]['required']) {?>class=" selectbox-highlighted cm-required"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['label']->value) {?> — <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8');
}?></option>
                    <?php }?>
                <?php } ?>
                <?php  $_smarty_tpl->tpl_vars["item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["item"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->key => $_smarty_tpl->tpl_vars["item"]->value) {
$_smarty_tpl->tpl_vars["item"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["item"]->key;
?>
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['required']&&!smarty_modifier_in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['assigned_ids']->value)) {?>
                        <?php $_smarty_tpl->tpl_vars['label'] = new Smarty_variable(fn_exim_get_field_label($_smarty_tpl->tpl_vars['key']->value), null, 0);?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
" selected="selected"  class="selectbox-highlighted cm-required"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['label']->value) {?> — <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8');
}?></option>
                    <?php }?>
                <?php } ?>
                </select>
                <p class="left">
                    <span class="icon-chevron-up hand" onclick="Tygh.$('#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_id']->value, ENT_QUOTES, 'UTF-8');?>
').swapOptions('up');"></span>
                    <span class="icon-chevron-down hand" onclick="Tygh.$('#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_id']->value, ENT_QUOTES, 'UTF-8');?>
').swapOptions('down');"></span>
                </p>
            </td>
            <td width="4%" class="center chevron-icons">
                        <span class="icon-chevron-left hand" onclick="Tygh.$('#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_id']->value, ENT_QUOTES, 'UTF-8');?>
_right').moveOptions('#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_id']->value, ENT_QUOTES, 'UTF-8');?>
');"></span>
                        <br>
                        <span class="icon-chevron-right hand" onclick="Tygh.$('#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_id']->value, ENT_QUOTES, 'UTF-8');?>
').moveOptions('#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_id']->value, ENT_QUOTES, 'UTF-8');?>
_right', <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ldelim']->value, ENT_QUOTES, 'UTF-8');?>
check_required: true, message: Tygh.tr('error_exim_layout_missed_fields')<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rdelim']->value, ENT_QUOTES, 'UTF-8');?>
);"></span>
            </td>
            <td width="48%" class="top">
                <select id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left_id']->value, ENT_QUOTES, 'UTF-8');?>
_right" name="unset_mbox[]" multiple="multiple" class="input-full toll-select">
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                    <?php if (!smarty_modifier_in_array($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['assigned_ids']->value)&&!$_smarty_tpl->tpl_vars['item']->value['required']) {?>
                        <?php $_smarty_tpl->tpl_vars['label'] = new Smarty_variable(fn_exim_get_field_label($_smarty_tpl->tpl_vars['key']->value), null, 0);?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['required']) {?>class="selectbox-highlighted cm-required"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['label']->value) {?> — <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value, ENT_QUOTES, 'UTF-8');
}?></option>
                    <?php }?>
                <?php } ?>
                </select>
            </td>
        </tr>
    </table>
</div>
<?php }} ?>
