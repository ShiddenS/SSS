<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:13:24
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\pickers\products\picker.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3060318135daf1c94af2555-78599454%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a4858d9ac243c8e25cc4d8fca4afb19e3cdcb6c' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\pickers\\products\\picker.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '3060318135daf1c94af2555-78599454',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data_id' => 0,
    'rnd' => 0,
    'view_mode' => 0,
    'start_pos' => 0,
    'icon' => 0,
    'show_but_text' => 0,
    'item_ids' => 0,
    'type' => 0,
    'placement' => 0,
    'meta' => 0,
    'but_text' => 0,
    'input_name' => 0,
    'positions' => 0,
    'ldelim' => 0,
    'rdelim' => 0,
    'product' => 0,
    'no_item_text' => 0,
    'picker_view' => 0,
    'display' => 0,
    'prod_opts' => 0,
    'product_name' => 0,
    'product_id' => 0,
    'colspan' => 0,
    'input_id' => 0,
    'hide_input' => 0,
    'hide_link' => 0,
    'hide_delete_button' => 0,
    'extra_var' => 0,
    'no_container' => 0,
    'company_id' => 0,
    'company_ids' => 0,
    'picker_for' => 0,
    'checkbox_name' => 0,
    'aoc' => 0,
    'is_order_management' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1c94c5e5c2_10867861',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1c94c5e5c2_10867861')) {function content_5daf1c94c5e5c2_10867861($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.math.php';
if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_modifier_count')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.count.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('add_products','position_short','name','deleted_product','no_items','close','editing_defined_products','defined_items','name','quantity','options','any_option_combinations','deleted_product','no_items','add_products','add_products'));
?>
<?php echo smarty_function_math(array('equation'=>"rand()",'assign'=>"rnd"),$_smarty_tpl);?>

<?php $_smarty_tpl->tpl_vars["data_id"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['data_id']->value)."_".((string)$_smarty_tpl->tpl_vars['rnd']->value), null, 0);?>
<?php $_smarty_tpl->tpl_vars["view_mode"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['view_mode']->value)===null||$tmp==='' ? "mixed" : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["start_pos"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['start_pos']->value)===null||$tmp==='' ? 0 : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["icon"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['icon']->value)===null||$tmp==='' ? "icon-plus" : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["show_but_text"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['show_but_text']->value)===null||$tmp==='' ? true : $tmp), null, 0);?>
<?php echo smarty_function_script(array('src'=>"js/tygh/picker.js"),$_smarty_tpl);?>


<?php if ($_smarty_tpl->tpl_vars['item_ids']->value&&!is_array($_smarty_tpl->tpl_vars['item_ids']->value)&&$_smarty_tpl->tpl_vars['type']->value!="table") {?>
        <?php $_smarty_tpl->tpl_vars["item_ids"] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['item_ids']->value), null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['view_mode']->value!="list") {?>
    <?php if ($_smarty_tpl->tpl_vars['placement']->value=='right') {?>
        <div class="clearfix">
            <div class="pull-right">
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['type']->value!="single") {?>
    <a data-ca-external-click-id="opener_picker_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-external-click btn <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta']->value, ENT_QUOTES, 'UTF-8');?>
">
        <?php if ($_smarty_tpl->tpl_vars['icon']->value) {?><i class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['icon']->value, ENT_QUOTES, 'UTF-8');?>
"></i><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['show_but_text']->value) {?>
            <?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['but_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("add_products") : $tmp), ENT_QUOTES, 'UTF-8');?>

        <?php }?>
    </a>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['placement']->value=='right') {?>
            </div>
        </div>
    <?php }?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['view_mode']->value!="button") {?>
<?php if ($_smarty_tpl->tpl_vars['type']->value=="links") {?>
    <input type="hidden" id="p<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_ids" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['input_name']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {
echo htmlspecialchars(implode(",",$_smarty_tpl->tpl_vars['item_ids']->value), ENT_QUOTES, 'UTF-8');
}?>" />
    <?php $_smarty_tpl->_capture_stack[0][] = array("products_list", null, null); ob_start(); ?>
    <div class="table-responsive-wrapper">
        <table class="table table-middle table-responsive">
        <thead>
        <tr>
            <?php if ($_smarty_tpl->tpl_vars['positions']->value) {?><th width="5%"><?php echo $_smarty_tpl->__("position_short");?>
</th><?php }?>
            <th width="100%"><?php echo $_smarty_tpl->__("name");?>
</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="<?php if (!$_smarty_tpl->tpl_vars['item_ids']->value) {?>hidden<?php }?> cm-picker-product">
        <?php echo $_smarty_tpl->getSubTemplate ("pickers/products/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('clone'=>true,'product'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."product".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'root_id'=>$_smarty_tpl->tpl_vars['data_id']->value,'delete_id'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."delete_id".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'type'=>"product",'position_field'=>$_smarty_tpl->tpl_vars['positions']->value,'position'=>"0"), 0);?>

        <?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {?>
        <?php  $_smarty_tpl->tpl_vars["product"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["product"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item_ids']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["product"]->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["product"]->key => $_smarty_tpl->tpl_vars["product"]->value) {
$_smarty_tpl->tpl_vars["product"]->_loop = true;
 $_smarty_tpl->tpl_vars["product"]->index++;
 $_smarty_tpl->tpl_vars["product"]->first = $_smarty_tpl->tpl_vars["product"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['first'] = $_smarty_tpl->tpl_vars["product"]->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['iteration']++;
?>
            <?php echo $_smarty_tpl->getSubTemplate ("pickers/products/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_id'=>$_smarty_tpl->tpl_vars['product']->value,'product'=>(($tmp = @fn_get_product_name($_smarty_tpl->tpl_vars['product']->value))===null||$tmp==='' ? $_smarty_tpl->__("deleted_product") : $tmp),'root_id'=>$_smarty_tpl->tpl_vars['data_id']->value,'delete_id'=>strtr($_smarty_tpl->tpl_vars['product']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" )),'type'=>"product",'first_item'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['items']['first'],'position_field'=>$_smarty_tpl->tpl_vars['positions']->value,'position'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['items']['iteration']+$_smarty_tpl->tpl_vars['start_pos']->value), 0);?>

        <?php } ?>
        <?php }?>
        </tbody>
        <tbody id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_no_item"<?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {?> class="hidden"<?php }?>>
        <tr class="no-items">
            <td colspan="<?php if ($_smarty_tpl->tpl_vars['positions']->value) {?>4<?php } else { ?>3<?php }?>"><p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['no_item_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("no_items") : $tmp);?>
</p></td>
        </tr>
        </tbody>
        </table>

        <?php if ($_smarty_tpl->tpl_vars['picker_view']->value) {?>
            <div class="buttons-container">
                <a class="cm-dialog-closer cm-cancel tool-link btn btn-primary"><?php echo $_smarty_tpl->__("close");?>
</a>
            </div>
        <?php }?>
    </div>
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php if ($_smarty_tpl->tpl_vars['picker_view']->value) {?>
        <div class="shift-button">
        <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"inner_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'link_text'=>smarty_modifier_count($_smarty_tpl->tpl_vars['item_ids']->value),'act'=>"link",'content'=>Smarty::$_smarty_vars['capture']['products_list'],'text'=>$_smarty_tpl->__("editing_defined_products"),'picker_meta'=>"cm-bg-close",'method'=>"GET",'no_icon_link'=>true), 0);
echo $_smarty_tpl->__("defined_items");?>

        </div>
    <?php } else { ?>
        <?php echo Smarty::$_smarty_vars['capture']['products_list'];?>

    <?php }?>
<?php } elseif ($_smarty_tpl->tpl_vars['type']->value=="table") {?>
    <?php if (!isset($_smarty_tpl->tpl_vars['display']->value)) {?>
        <?php $_smarty_tpl->tpl_vars["display"] = new Smarty_variable("options", null, 0);?>
    <?php }?>
    <div class="table-wrapper">
    <table class="table table-middle">
    <thead>
    <tr>
        <th width="80%"><?php echo $_smarty_tpl->__("name");?>
</th>
        <th class="center"><?php echo $_smarty_tpl->__("quantity");?>
</th>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"product_picker:table_header")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"product_picker:table_header"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"product_picker:table_header"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="<?php if (!$_smarty_tpl->tpl_vars['item_ids']->value) {?>hidden <?php }?>cm-picker<?php if ($_smarty_tpl->tpl_vars['display']->value) {?>-options<?php }?>">
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"product_picker:table_rows")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"product_picker:table_rows"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {?>
    <?php  $_smarty_tpl->tpl_vars["product"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["product"]->_loop = false;
 $_smarty_tpl->tpl_vars["product_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['item_ids']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["product"]->key => $_smarty_tpl->tpl_vars["product"]->value) {
$_smarty_tpl->tpl_vars["product"]->_loop = true;
 $_smarty_tpl->tpl_vars["product_id"]->value = $_smarty_tpl->tpl_vars["product"]->key;
?>
        <?php if ($_smarty_tpl->tpl_vars['display']->value) {?>
            <?php $_smarty_tpl->_capture_stack[0][] = array("product_options", null, null); ob_start(); ?>
                <?php $_smarty_tpl->tpl_vars["prod_opts"] = new Smarty_variable(fn_get_product_options($_smarty_tpl->tpl_vars['product']->value['product_id']), null, 0);?>
                <?php if ($_smarty_tpl->tpl_vars['prod_opts']->value&&!$_smarty_tpl->tpl_vars['product']->value['product_options']) {?>
                    <span><?php echo $_smarty_tpl->__("options");?>
: </span>&nbsp;<?php echo $_smarty_tpl->__("any_option_combinations");?>

                <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['product_options']) {?>
                    <?php if ($_smarty_tpl->tpl_vars['product']->value['product_options_value']) {?>
                        <?php echo $_smarty_tpl->getSubTemplate ("common/options_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_options'=>$_smarty_tpl->tpl_vars['product']->value['product_options_value']), 0);?>

                    <?php } else { ?>
                        <?php echo $_smarty_tpl->getSubTemplate ("common/options_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_options'=>fn_get_selected_product_options_info($_smarty_tpl->tpl_vars['product']->value['product_options'])), 0);?>

                    <?php }?>
                <?php }?>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['product']->value['product']) {?>
            <?php $_smarty_tpl->tpl_vars["product_name"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product'], null, 0);?>
        <?php } else { ?>
            <?php $_smarty_tpl->tpl_vars["product_name"] = new Smarty_variable((($tmp = @fn_get_product_name($_smarty_tpl->tpl_vars['product']->value['product_id']))===null||$tmp==='' ? $_smarty_tpl->__("deleted_product") : $tmp), null, 0);?>
        <?php }?>
        <?php echo $_smarty_tpl->getSubTemplate ("pickers/products/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product'=>$_smarty_tpl->tpl_vars['product_name']->value,'root_id'=>$_smarty_tpl->tpl_vars['data_id']->value,'delete_id'=>$_smarty_tpl->tpl_vars['product_id']->value,'input_name'=>((string)$_smarty_tpl->tpl_vars['input_name']->value)."[".((string)$_smarty_tpl->tpl_vars['product_id']->value)."]",'amount'=>$_smarty_tpl->tpl_vars['product']->value['amount'],'amount_input'=>"text",'type'=>"options",'options'=>Smarty::$_smarty_vars['capture']['product_options'],'options_array'=>$_smarty_tpl->tpl_vars['product']->value['product_options'],'product_id'=>$_smarty_tpl->tpl_vars['product']->value['product_id'],'product_info'=>$_smarty_tpl->tpl_vars['product']->value), 0);?>

    <?php } ?>
    <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"product_picker:table_rows"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php echo $_smarty_tpl->getSubTemplate ("pickers/products/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('clone'=>true,'product'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."product".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'root_id'=>$_smarty_tpl->tpl_vars['data_id']->value,'delete_id'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."delete_id".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'input_name'=>((string)$_smarty_tpl->tpl_vars['input_name']->value)."[".((string)$_smarty_tpl->tpl_vars['ldelim']->value)."product_id".((string)$_smarty_tpl->tpl_vars['rdelim']->value)."]",'amount'=>"1",'amount_input'=>"text",'type'=>"options",'options'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."options".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'product_id'=>''), 0);?>

    </tbody>
    <tbody id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_no_item"<?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {?> class="hidden"<?php }?>>
    <tr class="no-items">
        <td colspan="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['colspan']->value)===null||$tmp==='' ? "3" : $tmp), ENT_QUOTES, 'UTF-8');?>
"><p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['no_item_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("no_items") : $tmp);?>
</p></td>
    </tr>
    </tbody>
    </table>
    </div>
<?php } elseif ($_smarty_tpl->tpl_vars['type']->value=="single") {?>
<div class="cm-display-radio" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
">
    <input id="<?php if ($_smarty_tpl->tpl_vars['input_id']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['input_id']->value, ENT_QUOTES, 'UTF-8');
} else { ?>c<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_ids<?php }?>" type="hidden" class="cm-picker-value" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['input_name']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php if (is_array($_smarty_tpl->tpl_vars['item_ids']->value)) {
echo htmlspecialchars(implode(",",$_smarty_tpl->tpl_vars['item_ids']->value), ENT_QUOTES, 'UTF-8');
}?>" />
    <div class="input-append choose-input">
        <?php echo $_smarty_tpl->getSubTemplate ("pickers/products/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_id'=>'','holder'=>$_smarty_tpl->tpl_vars['data_id']->value,'hide_input'=>$_smarty_tpl->tpl_vars['hide_input']->value,'input_name'=>$_smarty_tpl->tpl_vars['input_name']->value,'hide_link'=>$_smarty_tpl->tpl_vars['hide_link']->value,'hide_delete_button'=>$_smarty_tpl->tpl_vars['hide_delete_button']->value,'type'=>"single"), 0);?>

        <?php echo Smarty::$_smarty_vars['capture']['add_buttons'];?>

    </div>
</div>
<?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['view_mode']->value!="list") {?>
    <div class="hidden">
        <?php if ($_smarty_tpl->tpl_vars['extra_var']->value) {?>
            <?php $_smarty_tpl->tpl_vars["extra_var"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['extra_var']->value), null, 0);?>
        <?php }?>
        <?php if (!$_smarty_tpl->tpl_vars['no_container']->value) {?><div class="buttons-container"><?php }
if ($_smarty_tpl->tpl_vars['picker_view']->value) {?>[<?php }?>
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_id'=>"opener_picker_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'but_href'=>fn_url("products.picker?display=".((string)$_smarty_tpl->tpl_vars['display']->value)."&company_id=".((string)$_smarty_tpl->tpl_vars['company_id']->value)."&company_ids=".((string)$_smarty_tpl->tpl_vars['company_ids']->value)."&picker_for=".((string)$_smarty_tpl->tpl_vars['picker_for']->value)."&extra=".((string)$_smarty_tpl->tpl_vars['extra_var']->value)."&checkbox_name=".((string)$_smarty_tpl->tpl_vars['checkbox_name']->value)."&aoc=".((string)$_smarty_tpl->tpl_vars['aoc']->value)."&data_id=".((string)$_smarty_tpl->tpl_vars['data_id']->value)."&is_order_management=".((string)$_smarty_tpl->tpl_vars['is_order_management']->value)),'but_text'=>(($tmp = @$_smarty_tpl->tpl_vars['but_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("add_products") : $tmp),'but_role'=>"add",'but_target_id'=>"content_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'but_meta'=>"cm-dialog-opener"), 0);?>

        <?php if ($_smarty_tpl->tpl_vars['picker_view']->value) {?>]<?php }
if (!$_smarty_tpl->tpl_vars['no_container']->value) {?></div><?php }?>
        <div class="hidden" id="content_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['but_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("add_products") : $tmp), ENT_QUOTES, 'UTF-8');?>
">
        </div>
    </div>
<?php }?><?php }} ?>
