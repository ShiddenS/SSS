<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:12:32
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\pickers\categories\js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7366970475db2ca904326c8-92820529%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b51baf3029a46a68b636c60bc70cd368ce312b22' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\pickers\\categories\\js.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '7366970475db2ca904326c8-92820529',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category_id' => 0,
    'category_data' => 0,
    'ldelim' => 0,
    'rdelim' => 0,
    'runtime' => 0,
    'owner_company_id' => 0,
    'default_name' => 0,
    'multiple' => 0,
    'clone' => 0,
    'holder' => 0,
    'position_field' => 0,
    'input_name' => 0,
    'position' => 0,
    'show_only_name' => 0,
    'category' => 0,
    'view_only' => 0,
    'hide_delete_button' => 0,
    'view_mode' => 0,
    'first_item' => 0,
    'single_line' => 0,
    'extra_class' => 0,
    'display_input_id' => 0,
    'extra' => 0,
    'but_text' => 0,
    'data_id' => 0,
    'display' => 0,
    'company_ids' => 0,
    'picker_for' => 0,
    'extra_var' => 0,
    'checkbox_name' => 0,
    'except_id' => 0,
    'extra_url' => 0,
    '_but_text' => 0,
    '_but_role' => 0,
    '_but_icon' => 0,
    'but_meta' => 0,
    'hide_input' => 0,
    'radio_input_name' => 0,
    'default_category_id' => 0,
    'show_active_path' => 0,
    'default_category_path_items' => 0,
    'default_category' => 0,
    'main_category' => 0,
    'path_id' => 0,
    'path_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2ca90801143_44685912',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2ca90801143_44685912')) {function content_5db2ca90801143_44685912($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.math.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('edit','remove','add_categories','remove','remove','remove'));
?>
<?php if ($_smarty_tpl->tpl_vars['category_id']->value) {?>
    <?php $_smarty_tpl->tpl_vars["category_data"] = new Smarty_variable(fn_get_category_data($_smarty_tpl->tpl_vars['category_id']->value,@constant('CART_LANGUAGE'),'',false,true,false,true), null, 0);?>
    <?php $_smarty_tpl->tpl_vars["category"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['category_data']->value['category'])===null||$tmp==='' ? ((string)$_smarty_tpl->tpl_vars['ldelim']->value)."category".((string)$_smarty_tpl->tpl_vars['rdelim']->value) : $tmp), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['company_id']&&($_smarty_tpl->tpl_vars['owner_company_id']->value&&$_smarty_tpl->tpl_vars['owner_company_id']->value!=$_smarty_tpl->tpl_vars['runtime']->value['company_id']&&$_smarty_tpl->tpl_vars['category_data']->value['company_id']!=$_smarty_tpl->tpl_vars['runtime']->value['company_id']||$_smarty_tpl->tpl_vars['category_data']->value['company_id']!=$_smarty_tpl->tpl_vars['runtime']->value['company_id'])) {?>
        <?php $_smarty_tpl->tpl_vars["show_only_name"] = new Smarty_variable(true, null, 0);?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['company_id']&&$_smarty_tpl->tpl_vars['owner_company_id']->value&&$_smarty_tpl->tpl_vars['owner_company_id']->value!=$_smarty_tpl->tpl_vars['runtime']->value['company_id']) {?>
        <?php $_smarty_tpl->tpl_vars["hide_delete_button"] = new Smarty_variable(true, null, 0);?>
    <?php }?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["category"] = new Smarty_variable(rawurldecode($_smarty_tpl->tpl_vars['default_name']->value), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['multiple']->value) {?>
    <tr <?php if (!$_smarty_tpl->tpl_vars['clone']->value) {?>id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['holder']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_id']->value, ENT_QUOTES, 'UTF-8');?>
" <?php }?>class="cm-js-item <?php if ($_smarty_tpl->tpl_vars['clone']->value) {?> cm-clone hidden<?php }?>">
        <?php if ($_smarty_tpl->tpl_vars['position_field']->value) {?><td width="5%"><input type="text" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['input_name']->value, ENT_QUOTES, 'UTF-8');?>
[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_id']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo smarty_function_math(array('equation'=>"a*b",'a'=>$_smarty_tpl->tpl_vars['position']->value,'b'=>10),$_smarty_tpl);?>
" size="3" class="input-micro"<?php if ($_smarty_tpl->tpl_vars['clone']->value) {?> disabled="disabled"<?php }?> /></td><?php }?>
        <td>
            <?php if (!$_smarty_tpl->tpl_vars['show_only_name']->value) {?>
                <a href="<?php echo htmlspecialchars(fn_url("categories.update?category_id=".((string)$_smarty_tpl->tpl_vars['category_id']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value, ENT_QUOTES, 'UTF-8');?>
</a>
            <?php } else { ?>
                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value, ENT_QUOTES, 'UTF-8');?>
 <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/company_name.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('object'=>$_smarty_tpl->tpl_vars['category_data']->value), 0);?>

            <?php }?>
        </td>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"category_picker:manage_data")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"category_picker:manage_data"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"category_picker:manage_data"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <td width="5%" class="nowrap">
        <?php if (!$_smarty_tpl->tpl_vars['view_only']->value||$_smarty_tpl->tpl_vars['show_only_name']->value) {?>
            <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("edit"),'href'=>"categories.update?category_id=".((string)$_smarty_tpl->tpl_vars['category_id']->value)));?>
</li>
                <?php if (!$_smarty_tpl->tpl_vars['hide_delete_button']->value) {?>
                    <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("remove"),'onclick'=>"Tygh."."$".".cePicker('delete_js_item', '".((string)$_smarty_tpl->tpl_vars['holder']->value)."', '".((string)$_smarty_tpl->tpl_vars['category_id']->value)."', 'c'); return false;"));?>
</li>
                <?php }?>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <div class="hidden-tools">
                <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list']));?>

            </div>
        <?php }?>
        </td>
    </tr>
<?php } else { ?>
    <?php if ($_smarty_tpl->tpl_vars['view_mode']->value!="list") {?>
        <span <?php if (!$_smarty_tpl->tpl_vars['clone']->value) {?>id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['holder']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_id']->value, ENT_QUOTES, 'UTF-8');?>
" <?php }?>class="cm-js-item <?php if ($_smarty_tpl->tpl_vars['clone']->value) {?> cm-clone hidden<?php }?>">
        <?php if (!$_smarty_tpl->tpl_vars['first_item']->value&&$_smarty_tpl->tpl_vars['single_line']->value) {?><span class="cm-comma<?php if ($_smarty_tpl->tpl_vars['clone']->value) {?> hidden<?php }?>">,&nbsp;&nbsp;</span><?php }?>

        <div class="input-append">
        <input class="cm-picker-value-description <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra_class']->value, ENT_QUOTES, 'UTF-8');?>
" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['display_input_id']->value) {?>id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['display_input_id']->value, ENT_QUOTES, 'UTF-8');?>
"<?php }?> size="10" name="category_name" readonly="readonly" <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra']->value, ENT_QUOTES, 'UTF-8');?>
 id="appendedInputButton">
        <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']||$_smarty_tpl->tpl_vars['runtime']->value['controller']!="companies") {?>
        <?php if ($_smarty_tpl->tpl_vars['multiple']->value) {?>
            <?php $_smarty_tpl->tpl_vars["_but_text"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['but_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("add_categories") : $tmp), null, 0);?>
            <?php $_smarty_tpl->tpl_vars["_but_role"] = new Smarty_variable("add", null, 0);?>
            <?php $_smarty_tpl->tpl_vars["_but_icon"] = new Smarty_variable("icon-plus", null, 0);?>
        <?php } else { ?>
            <?php $_smarty_tpl->tpl_vars["_but_text"] = new Smarty_variable("<i class='icon-plus'></i>", null, 0);?>
            <?php $_smarty_tpl->tpl_vars["_but_role"] = new Smarty_variable("icon", null, 0);?>
        <?php }?>
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_id'=>"opener_picker_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'but_href'=>fn_url("categories.picker?display=".((string)$_smarty_tpl->tpl_vars['display']->value)."&company_ids=".((string)$_smarty_tpl->tpl_vars['company_ids']->value)."&picker_for=".((string)$_smarty_tpl->tpl_vars['picker_for']->value)."&extra=".((string)$_smarty_tpl->tpl_vars['extra_var']->value)."&checkbox_name=".((string)$_smarty_tpl->tpl_vars['checkbox_name']->value)."&root=".((string)$_smarty_tpl->tpl_vars['default_name']->value)."&except_id=".((string)$_smarty_tpl->tpl_vars['except_id']->value)."&data_id=".((string)$_smarty_tpl->tpl_vars['data_id']->value).((string)$_smarty_tpl->tpl_vars['extra_url']->value)),'but_text'=>$_smarty_tpl->tpl_vars['_but_text']->value,'but_role'=>$_smarty_tpl->tpl_vars['_but_role']->value,'but_icon'=>$_smarty_tpl->tpl_vars['_but_icon']->value,'but_target_id'=>"content_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'but_meta'=>((string)$_smarty_tpl->tpl_vars['but_meta']->value)." cm-dialog-opener add-on btn"), 0);?>

        <?php }?>
        </div>
        </span>
    <?php } else { ?>
        <?php $_smarty_tpl->tpl_vars["default_category"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['ldelim']->value)."category".((string)$_smarty_tpl->tpl_vars['rdelim']->value), null, 0);?>
        <?php $_smarty_tpl->tpl_vars["default_category_id"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['ldelim']->value)."category_id".((string)$_smarty_tpl->tpl_vars['rdelim']->value), null, 0);?>
        <?php $_smarty_tpl->tpl_vars["default_category_path_items"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['ldelim']->value)."path_items".((string)$_smarty_tpl->tpl_vars['rdelim']->value), null, 0);?>
        <?php if ($_smarty_tpl->tpl_vars['first_item']->value||!$_smarty_tpl->tpl_vars['category_id']->value) {?>
            <p class="cm-js-item cm-clone hidden">
                <?php if ($_smarty_tpl->tpl_vars['hide_input']->value!="Y") {?>
                    <label class="radio inline-block" for="category_rb_category_id">
                        <input id="category_rb_category_id" type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['radio_input_name']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['default_category_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                    </label>
                <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['show_active_path']->value) {?>
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['default_category_path_items']->value, ENT_QUOTES, 'UTF-8');?>

                        <a target="_blank" href="<?php echo htmlspecialchars(fn_url("categories.update&category_id=".((string)$_smarty_tpl->tpl_vars['default_category_id']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['default_category']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                    <?php } else { ?>
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['default_category']->value, ENT_QUOTES, 'UTF-8');?>

                    <?php }?>
                    <a class="icon-remove-sign cm-tooltip hand hidden" onclick="Tygh.$.cePicker('delete_js_item', '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['holder']->value, ENT_QUOTES, 'UTF-8');?>
', '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['default_category_id']->value, ENT_QUOTES, 'UTF-8');?>
', 'c'); return false;" title="<?php echo $_smarty_tpl->__("remove");?>
"></a>
            </p>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['category_id']->value) {?>
        <div class="cm-js-item <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra_class']->value, ENT_QUOTES, 'UTF-8');?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['holder']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_id']->value, ENT_QUOTES, 'UTF-8');?>
" <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra']->value, ENT_QUOTES, 'UTF-8');?>
>
            <?php if ($_smarty_tpl->tpl_vars['hide_input']->value!="Y") {?>
                <label class="radio inline-block" for="category_radio_button_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <input id="category_radio_button_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_id']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['main_category']->value==$_smarty_tpl->tpl_vars['category_id']->value) {?>checked<?php }?> type="radio" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['radio_input_name']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_id']->value, ENT_QUOTES, 'UTF-8');?>
" />
                </label>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['show_active_path']->value) {?>
                <?php  $_smarty_tpl->tpl_vars["path_name"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["path_name"]->_loop = false;
 $_smarty_tpl->tpl_vars["path_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['category_data']->value['path_names']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["path_name"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["path_name"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["path_name"]->key => $_smarty_tpl->tpl_vars["path_name"]->value) {
$_smarty_tpl->tpl_vars["path_name"]->_loop = true;
 $_smarty_tpl->tpl_vars["path_id"]->value = $_smarty_tpl->tpl_vars["path_name"]->key;
 $_smarty_tpl->tpl_vars["path_name"]->iteration++;
 $_smarty_tpl->tpl_vars["path_name"]->last = $_smarty_tpl->tpl_vars["path_name"]->iteration === $_smarty_tpl->tpl_vars["path_name"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["path_names"]['last'] = $_smarty_tpl->tpl_vars["path_name"]->last;
?>
                    <a target="_blank" class="<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['path_names']['last']) {?>ty-breadcrumbs__a<?php } else { ?>ty-breadcrumbs__current<?php }?>" href="<?php echo htmlspecialchars(fn_url("categories.update&category_id=".((string)$_smarty_tpl->tpl_vars['path_id']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['path_name']->value, ENT_QUOTES, 'UTF-8');?>
</a><?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['path_names']['last']) {?> / <?php }?>
                <?php } ?>
            <?php } else { ?>
                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value, ENT_QUOTES, 'UTF-8');?>

            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['category_data']->value['company_id']) {
echo $_smarty_tpl->getSubTemplate ("views/companies/components/company_name.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('object'=>$_smarty_tpl->tpl_vars['category_data']->value,'simple'=>true), 0);
}?>

            <?php if (fn_allowed_for("ULTIMATE")) {?>
                <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']||($_smarty_tpl->tpl_vars['runtime']->value['company_id']&&($_smarty_tpl->tpl_vars['category_data']->value['company_id']==$_smarty_tpl->tpl_vars['runtime']->value['company_id']||$_smarty_tpl->tpl_vars['runtime']->value['company_id']==$_smarty_tpl->tpl_vars['owner_company_id']->value))) {?>
                    <a onclick="Tygh.$.cePicker('delete_js_item', '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['holder']->value, ENT_QUOTES, 'UTF-8');?>
', '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_id']->value, ENT_QUOTES, 'UTF-8');?>
', 'c'); return false;" class="icon-remove-sign cm-tooltip hand hidden" title="<?php echo $_smarty_tpl->__("remove");?>
"></a>
                <?php }?>
            <?php } else { ?>
                <a onclick="Tygh.$.cePicker('delete_js_item', '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['holder']->value, ENT_QUOTES, 'UTF-8');?>
', '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_id']->value, ENT_QUOTES, 'UTF-8');?>
', 'c'); return false;" class="icon-remove-sign cm-tooltip hand hidden" title="<?php echo $_smarty_tpl->__("remove");?>
"></a>
            <?php }?>
        </div>
        <?php }?>
    <?php }?>
<?php }?>
<?php }} ?>
