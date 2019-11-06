<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:13:17
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\products\components\advanced_search_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8948695535daf1c8d68c718-87876369%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '251d8965e23402480eb8b6914fa16bd052155e1a' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\products\\components\\advanced_search_form.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '8948695535daf1c8d68c718-87876369',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'filter_features' => 0,
    'splitted_filter' => 0,
    'filters_row' => 0,
    'filter' => 0,
    'id' => 0,
    'prefix' => 0,
    'data_name' => 0,
    'variant_id' => 0,
    'search' => 0,
    'variant' => 0,
    'disable' => 0,
    'date_extra' => 0,
    'settings' => 0,
    'from_value' => 0,
    'to_value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1c8d7d4eb0_92200726',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1c8d7d4eb0_92200726')) {function content_5daf1c8d7d4eb0_92200726($_smarty_tpl) {?><?php if (!is_callable('smarty_function_split')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.split.php';
if (!is_callable('smarty_modifier_sizeof')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.sizeof.php';
if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.enum.php';
if (!is_callable('smarty_modifier_in_array')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.in_array.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('search','none','your_range','none','yes','no'));
?>
<?php echo smarty_function_split(array('data'=>$_smarty_tpl->tpl_vars['filter_features']->value,'size'=>"2",'assign'=>"splitted_filter",'preverse_keys'=>true),$_smarty_tpl);?>


<?php  $_smarty_tpl->tpl_vars["filters_row"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["filters_row"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['splitted_filter']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["filters_row"]->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars["filters_row"]->key => $_smarty_tpl->tpl_vars["filters_row"]->value) {
$_smarty_tpl->tpl_vars["filters_row"]->_loop = true;
 $_smarty_tpl->tpl_vars["filters_row"]->index++;
 $_smarty_tpl->tpl_vars["filters_row"]->first = $_smarty_tpl->tpl_vars["filters_row"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["filters_row"]['first'] = $_smarty_tpl->tpl_vars["filters_row"]->first;
?>

<div class="table-wrapper table-responsive-wrapper">
    <table class="table-responsive table-responsive--nopadding table-responsive--centered">
    <thead>
        <tr>
        <?php  $_smarty_tpl->tpl_vars["filter"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["filter"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['filters_row']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["filter"]->key => $_smarty_tpl->tpl_vars["filter"]->value) {
$_smarty_tpl->tpl_vars["filter"]->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['filter']->value&&$_smarty_tpl->tpl_vars['filter']->value['feature_type']) {?>
            <td><strong><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['filter']->value['filter'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['filter']->value['description'] : $tmp), ENT_QUOTES, 'UTF-8');?>
</strong></td>
            <?php }?>
        <?php } ?>
        </tr>
    </thead>

    <tbody>
        <tr valign="top" <?php if ((smarty_modifier_sizeof($_smarty_tpl->tpl_vars['splitted_filter']->value)>1)&&$_smarty_tpl->getVariable('smarty')->value['foreach']['filters_row']['first']) {?>class="delim"<?php }?>>
        <?php  $_smarty_tpl->tpl_vars["filter"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["filter"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['filters_row']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["filter"]->key => $_smarty_tpl->tpl_vars["filter"]->value) {
$_smarty_tpl->tpl_vars["filter"]->_loop = true;
?>

            <?php if ($_smarty_tpl->tpl_vars['filter']->value&&$_smarty_tpl->tpl_vars['filter']->value['feature_type']) {?>
                <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['filter']->value['filter_id'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['filter']->value['feature_id'] : $tmp), null, 0);?>
                <td width="350px" data-th="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['filter']->value['filter'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['filter']->value['description'] : $tmp), ENT_QUOTES, 'UTF-8');?>
">
                    <?php if ($_smarty_tpl->tpl_vars['filter']->value['feature_type']==smarty_modifier_enum("ProductFeatures::TEXT_SELECTBOX")||$_smarty_tpl->tpl_vars['filter']->value['feature_type']==smarty_modifier_enum("ProductFeatures::EXTENDED")||$_smarty_tpl->tpl_vars['filter']->value['feature_type']==smarty_modifier_enum("ProductFeatures::MULTIPLE_CHECKBOX")||$_smarty_tpl->tpl_vars['filter']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_SELECTBOX")&&!$_smarty_tpl->tpl_vars['id']->value) {?>
                        <div class="object-selector object-selector--mobile-full-width object-selector--half-width">
                            <select id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
variants_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"
                                    class="cm-object-selector"
                                    multiple
                                    name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_name']->value, ENT_QUOTES, 'UTF-8');?>
[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][]"
                                    data-ca-placeholder=<?php echo $_smarty_tpl->__("search");?>

                                    data-ca-enable-images="true"
                                    data-ca-image-width="30"
                                    data-ca-image-height="30"
                                    data-ca-enable-search="true"
                                    data-ca-page-size="10"
                                    <?php if ($_smarty_tpl->tpl_vars['filter']->value['feature_id']) {?>
                                    <?php if ($_smarty_tpl->tpl_vars['filter']->value['use_variant_picker']) {?>
                                    data-ca-load-via-ajax="true"
                                    <?php }?>
                                    data-ca-data-url="<?php echo fn_url("product_features.get_variants_list?feature_id=".((string)$_smarty_tpl->tpl_vars['filter']->value['feature_id']));?>
"
                                    <?php }?>
                                    data-ca-close-on-select="false">
                                <?php  $_smarty_tpl->tpl_vars["variant"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["variant"]->_loop = false;
 $_smarty_tpl->tpl_vars["variant_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['filter']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["variant"]->key => $_smarty_tpl->tpl_vars["variant"]->value) {
$_smarty_tpl->tpl_vars["variant"]->_loop = true;
 $_smarty_tpl->tpl_vars["variant_id"]->value = $_smarty_tpl->tpl_vars["variant"]->key;
?>
                                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variant_id']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if (smarty_modifier_in_array($_smarty_tpl->tpl_vars['variant_id']->value,$_smarty_tpl->tpl_vars['search']->value[$_smarty_tpl->tpl_vars['data_name']->value][$_smarty_tpl->tpl_vars['id']->value])) {?> selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['prefix'], ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value['variant'], ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['suffix'], ENT_QUOTES, 'UTF-8');?>
</option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } elseif ($_smarty_tpl->tpl_vars['filter']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_FIELD")||$_smarty_tpl->tpl_vars['filter']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_SELECTBOX")&&$_smarty_tpl->tpl_vars['id']->value||$_smarty_tpl->tpl_vars['filter']->value['feature_type']==smarty_modifier_enum("ProductFeatures::DATE")||$_smarty_tpl->tpl_vars['filter']->value['condition_type']=="D") {?>
                        <div>
                            <label class="radio"><input class="cm-switch-availability cm-switch-inverse" type="radio" name="range_selected[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
]" id="sw_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
select_custom_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_suffix_N" value="" checked="checked" /><?php echo $_smarty_tpl->__("none");?>

                            </label>
                        </div>

                        <?php $_smarty_tpl->tpl_vars['disable'] = new Smarty_variable(true, null, 0);?>
                        <label class="radio"><input class="cm-switch-availability" type="radio" name="range_selected[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
]" id="sw_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
select_custom_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_suffix_Y" value="1" <?php if ($_smarty_tpl->tpl_vars['search']->value['range_selected'][$_smarty_tpl->tpl_vars['id']->value]) {
$_smarty_tpl->tpl_vars['disable'] = new Smarty_variable(false, null, 0);?>checked="checked"<?php }?>  /><?php echo $_smarty_tpl->__("your_range");?>
</label>

                        <div id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
select_custom_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">
                            <?php if ($_smarty_tpl->tpl_vars['filter']->value['feature_type']==smarty_modifier_enum("ProductFeatures::DATE")) {?>
                                <?php if ($_smarty_tpl->tpl_vars['disable']->value) {?>
                                    <?php $_smarty_tpl->tpl_vars['date_extra'] = new Smarty_variable("disabled=\"disabled\"", null, 0);?>
                                <?php } else { ?>
                                    <?php $_smarty_tpl->tpl_vars['date_extra'] = new Smarty_variable('', null, 0);?>
                                <?php }?>

                                <?php echo $_smarty_tpl->getSubTemplate ("common/calendar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('date_id'=>((string)$_smarty_tpl->tpl_vars['prefix']->value)."range_".((string)$_smarty_tpl->tpl_vars['id']->value)."_from",'date_name'=>((string)$_smarty_tpl->tpl_vars['data_name']->value)."[".((string)$_smarty_tpl->tpl_vars['id']->value)."][0]",'date_val'=>$_smarty_tpl->tpl_vars['search']->value[$_smarty_tpl->tpl_vars['data_name']->value][$_smarty_tpl->tpl_vars['id']->value][0],'extra'=>$_smarty_tpl->tpl_vars['date_extra']->value,'start_year'=>$_smarty_tpl->tpl_vars['settings']->value['Company']['company_start_year']), 0);?>


                                <?php echo $_smarty_tpl->getSubTemplate ("common/calendar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('date_id'=>((string)$_smarty_tpl->tpl_vars['prefix']->value)."range_".((string)$_smarty_tpl->tpl_vars['id']->value)."_to",'date_name'=>((string)$_smarty_tpl->tpl_vars['data_name']->value)."[".((string)$_smarty_tpl->tpl_vars['id']->value)."][1]",'date_val'=>$_smarty_tpl->tpl_vars['search']->value[$_smarty_tpl->tpl_vars['data_name']->value][$_smarty_tpl->tpl_vars['id']->value][1],'extra'=>$_smarty_tpl->tpl_vars['date_extra']->value,'start_year'=>$_smarty_tpl->tpl_vars['settings']->value['Company']['company_start_year']), 0);?>


                            <?php } else { ?>

                                <?php $_smarty_tpl->tpl_vars['from_value'] = new Smarty_variable($_smarty_tpl->tpl_vars['search']->value[$_smarty_tpl->tpl_vars['data_name']->value][$_smarty_tpl->tpl_vars['id']->value][0], null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['to_value'] = new Smarty_variable($_smarty_tpl->tpl_vars['search']->value[$_smarty_tpl->tpl_vars['data_name']->value][$_smarty_tpl->tpl_vars['id']->value][1], null, 0);?>

                                <input type="text" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_name']->value, ENT_QUOTES, 'UTF-8');?>
[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][0]" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
range_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_from" size="3" class="input-mini" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['from_value']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['disable']->value) {?>disabled="disabled"<?php }?> />-<input type="text" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_name']->value, ENT_QUOTES, 'UTF-8');?>
[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][1]" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
range_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_to" size="3" class="input-mini" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['to_value']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['disable']->value) {?>disabled="disabled"<?php }?> />
                            <?php }?>
                        </div>

                    <?php } elseif ($_smarty_tpl->tpl_vars['filter']->value['feature_type']==smarty_modifier_enum("ProductFeatures::SINGLE_CHECKBOX")||$_smarty_tpl->tpl_vars['filter']->value['condition_type']=="C") {?>
                            <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
ranges_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_none" class="radio">
                            <input type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_name']->value, ENT_QUOTES, 'UTF-8');?>
[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][]" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
ranges_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_none" value="" <?php if (!$_smarty_tpl->tpl_vars['search']->value[$_smarty_tpl->tpl_vars['data_name']->value][$_smarty_tpl->tpl_vars['id']->value][0]) {?>checked="checked"<?php }?> />
                            <?php echo $_smarty_tpl->__("none");?>
</label>

                            <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
ranges_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_yes" class="radio">
                            <input type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_name']->value, ENT_QUOTES, 'UTF-8');?>
[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][]" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
ranges_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_yes" value="Y" <?php if ($_smarty_tpl->tpl_vars['search']->value[$_smarty_tpl->tpl_vars['data_name']->value][$_smarty_tpl->tpl_vars['id']->value][0]=="Y") {?>checked="checked"<?php }?> />
                            <?php echo $_smarty_tpl->__("yes");?>
</label>

                            <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
ranges_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_no" class="radio">
                            <input type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_name']->value, ENT_QUOTES, 'UTF-8');?>
[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][]" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefix']->value, ENT_QUOTES, 'UTF-8');?>
ranges_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_no" value="N" <?php if ($_smarty_tpl->tpl_vars['search']->value[$_smarty_tpl->tpl_vars['data_name']->value][$_smarty_tpl->tpl_vars['id']->value][0]=="N") {?>checked="checked"<?php }?> />
                            <?php echo $_smarty_tpl->__("no");?>
</label>

                    <?php } elseif ($_smarty_tpl->tpl_vars['filter']->value['feature_type']==smarty_modifier_enum("ProductFeatures::TEXT_FIELD")) {?>
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['prefix'], ENT_QUOTES, 'UTF-8');?>
<input type="text" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_name']->value, ENT_QUOTES, 'UTF-8');?>
[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][]" class="input-mini" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value[$_smarty_tpl->tpl_vars['data_name']->value][$_smarty_tpl->tpl_vars['id']->value][0], ENT_QUOTES, 'UTF-8');?>
" /><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['suffix'], ENT_QUOTES, 'UTF-8');?>

                    <?php }?>
                </td>
            <?php }?>
        <?php } ?>
        </tr>
    </tbody>
    </table>
</div>
<?php } ?>
<?php }} ?>
