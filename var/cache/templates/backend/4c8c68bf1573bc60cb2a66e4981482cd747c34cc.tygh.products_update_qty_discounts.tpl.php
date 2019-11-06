<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:15
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\products\components\products_update_qty_discounts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20441493215daf1d7b9656c7-97482466%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c8c68bf1573bc60cb2a66e4981482cd747c34cc' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\products\\components\\products_update_qty_discounts.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '20441493215daf1d7b9656c7-97482466',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product_data' => 0,
    'no_hide_input_if_shared_product' => 0,
    'price' => 0,
    '_key' => 0,
    'primary_currency' => 0,
    'currencies' => 0,
    'usergroup' => 0,
    'usergroups' => 0,
    'default_usergroup_name' => 0,
    'show_update_for_all' => 0,
    'new_key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d7bcba8e0_74898490',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d7bcba8e0_74898490')) {function content_5daf1d7bcba8e0_74898490($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.math.php';
if (!is_callable('smarty_function_cycle')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.cycle.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('quantity','value','type','qty_discount_type_tooltip','usergroup','quantity','value','type','absolute','percent','absolute','percent','usergroup','all','quantity','value','type','absolute','percent','usergroup'));
?>
<?php if (!fn_allowed_for("ULTIMATE:FREE")) {?>
    <?php $_smarty_tpl->tpl_vars["usergroups"] = new Smarty_variable(fn_get_usergroups(array("type"=>"C","status"=>array("A","H"))), null, 0);?>
<?php }?>

<div id="content_qty_discounts" class="hidden">
    <div class="table-responsive-wrapper">
        <table class="table table-middle table-responsive" width="100%">
        <thead class="cm-first-sibling">
        <tr>
            <th width="5%"><?php echo $_smarty_tpl->__("quantity");?>
</th>
            <th width="20%"><?php echo $_smarty_tpl->__("value");?>
</th>
            <th width="25%"><?php echo $_smarty_tpl->__("type");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("qty_discount_type_tooltip")), 0);?>
</th>
            <?php if (!fn_allowed_for("ULTIMATE:FREE")) {?>
                <th width="25%"><?php echo $_smarty_tpl->__("usergroup");?>
</th>
            <?php }?>
            <th width="15%">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php  $_smarty_tpl->tpl_vars["price"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["price"]->_loop = false;
 $_smarty_tpl->tpl_vars["_key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['product_data']->value['prices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["price"]->key => $_smarty_tpl->tpl_vars["price"]->value) {
$_smarty_tpl->tpl_vars["price"]->_loop = true;
 $_smarty_tpl->tpl_vars["_key"]->value = $_smarty_tpl->tpl_vars["price"]->key;
?>
        <tr class="cm-row-item">
            <td width="5%" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
" data-th="<?php echo $_smarty_tpl->__("quantity");?>
">
                <?php if ($_smarty_tpl->tpl_vars['price']->value['lower_limit']=="1"&&$_smarty_tpl->tpl_vars['price']->value['usergroup_id']=="0") {?>
                    &nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['price']->value['lower_limit'], ENT_QUOTES, 'UTF-8');?>

                <?php } else { ?>
                <input type="text" name="product_data[prices][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_key']->value, ENT_QUOTES, 'UTF-8');?>
][lower_limit]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['price']->value['lower_limit'], ENT_QUOTES, 'UTF-8');?>
" class="input-micro" />
                <?php }?></td>
            <td width="20%" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
" data-th="<?php echo $_smarty_tpl->__("value");?>
">
                <?php if ($_smarty_tpl->tpl_vars['price']->value['lower_limit']=="1"&&$_smarty_tpl->tpl_vars['price']->value['usergroup_id']=="0") {?>
                    &nbsp;<?php if ($_smarty_tpl->tpl_vars['price']->value['percentage_discount']==0) {
echo htmlspecialchars(fn_format_price((($tmp = @$_smarty_tpl->tpl_vars['price']->value['price'])===null||$tmp==='' ? "0.00" : $tmp),$_smarty_tpl->tpl_vars['primary_currency']->value,null,false), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['price']->value['percentage_discount'], ENT_QUOTES, 'UTF-8');
}?>
                <?php } else { ?>
                <input type="text" name="product_data[prices][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_key']->value, ENT_QUOTES, 'UTF-8');?>
][price]" value="<?php if ($_smarty_tpl->tpl_vars['price']->value['percentage_discount']==0) {
echo htmlspecialchars(fn_format_price((($tmp = @$_smarty_tpl->tpl_vars['price']->value['price'])===null||$tmp==='' ? "0.00" : $tmp),$_smarty_tpl->tpl_vars['primary_currency']->value,null,false), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['price']->value['percentage_discount'], ENT_QUOTES, 'UTF-8');
}?>" size="10" class="input-medium" />
                <?php }?></td>
            <td width="25%" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
" data-th="<?php echo $_smarty_tpl->__("type");?>
">
                <?php if ($_smarty_tpl->tpl_vars['price']->value['lower_limit']=="1"&&$_smarty_tpl->tpl_vars['price']->value['usergroup_id']=="0") {?>
                    &nbsp;<?php if ($_smarty_tpl->tpl_vars['price']->value['percentage_discount']==0) {
echo $_smarty_tpl->__("absolute");
} else {
echo $_smarty_tpl->__("percent");
}?>
                <?php } else { ?>
                <select class="span3" name="product_data[prices][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_key']->value, ENT_QUOTES, 'UTF-8');?>
][type]">
                    <option value="A" <?php if ($_smarty_tpl->tpl_vars['price']->value['percentage_discount']==0) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("absolute");?>
 (<?php echo $_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]['symbol'];?>
)</option>
                    <option value="P" <?php if ($_smarty_tpl->tpl_vars['price']->value['percentage_discount']!=0) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("percent");?>
 (%)</option>
                </select>
                <?php }?></td>
            <?php if (!fn_allowed_for("ULTIMATE:FREE")) {?>
            <td width="25%" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
" data-th="<?php echo $_smarty_tpl->__("usergroup");?>
">
                <?php if ($_smarty_tpl->tpl_vars['price']->value['lower_limit']=="1"&&$_smarty_tpl->tpl_vars['price']->value['usergroup_id']=="0") {?>
                    &nbsp;<?php echo $_smarty_tpl->__("all");?>

                <?php } else { ?>
                <select id="usergroup_id" name="product_data[prices][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_key']->value, ENT_QUOTES, 'UTF-8');?>
][usergroup_id]" class="span3">
                    <?php  $_smarty_tpl->tpl_vars["usergroup"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["usergroup"]->_loop = false;
 $_from = fn_get_default_usergroups(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["usergroup"]->key => $_smarty_tpl->tpl_vars["usergroup"]->value) {
$_smarty_tpl->tpl_vars["usergroup"]->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['price']->value['usergroup_id']!=$_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id']) {?>
                            <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usergroup']->value['usergroup'], ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php } else { ?>
                            
                            <?php $_smarty_tpl->tpl_vars["default_usergroup_name"] = new Smarty_variable($_smarty_tpl->tpl_vars['usergroup']->value['usergroup'], null, 0);?>
                        <?php }?>
                    <?php } ?>
                    <?php  $_smarty_tpl->tpl_vars["usergroup"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["usergroup"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['usergroups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["usergroup"]->key => $_smarty_tpl->tpl_vars["usergroup"]->value) {
$_smarty_tpl->tpl_vars["usergroup"]->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['price']->value['usergroup_id']!=$_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id']) {?>
                            <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usergroup']->value['usergroup'], ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php }?>
                    <?php } ?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['price']->value['usergroup_id'], ENT_QUOTES, 'UTF-8');?>
" selected="selected"><?php if ($_smarty_tpl->tpl_vars['default_usergroup_name']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['default_usergroup_name']->value, ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars(fn_get_usergroup_name($_smarty_tpl->tpl_vars['price']->value['usergroup_id']), ENT_QUOTES, 'UTF-8');
}?></option>
                </select>
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"price_".((string)$_smarty_tpl->tpl_vars['_key']->value),'name'=>"update_all_vendors[prices][".((string)$_smarty_tpl->tpl_vars['_key']->value)."]"), 0);?>

                <?php $_smarty_tpl->tpl_vars["default_usergroup_name"] = new Smarty_variable('', null, 0);?>
                <?php }?></td>
            <?php }?>
            <td width="15%" class="nowrap <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
 right">
                <?php if ($_smarty_tpl->tpl_vars['price']->value['lower_limit']=="1"&&$_smarty_tpl->tpl_vars['price']->value['usergroup_id']=="0") {?>
                &nbsp;<?php } else { ?>
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/clone_delete.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('dummy_href'=>true,'microformats'=>"cm-delete-row",'no_confirm'=>true), 0);?>

                <?php }?>
            </td>
        </tr>
        <?php } ?>
        <?php echo smarty_function_math(array('equation'=>"x+1",'x'=>(($tmp = @$_smarty_tpl->tpl_vars['_key']->value)===null||$tmp==='' ? 0 : $tmp),'assign'=>"new_key"),$_smarty_tpl);?>

        <tr class="<?php echo smarty_function_cycle(array('values'=>"table-row , ",'reset'=>1),$_smarty_tpl);
echo htmlspecialchars($_smarty_tpl->tpl_vars['no_hide_input_if_shared_product']->value, ENT_QUOTES, 'UTF-8');?>
" id="box_add_qty_discount">
            <td width="5%" data-th="<?php echo $_smarty_tpl->__("quantity");?>
">
                <input type="text" name="product_data[prices][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['new_key']->value, ENT_QUOTES, 'UTF-8');?>
][lower_limit]" value="" class="input-micro" /></td>
            <td width="20%" data-th="<?php echo $_smarty_tpl->__("value");?>
">
                <input type="text" name="product_data[prices][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['new_key']->value, ENT_QUOTES, 'UTF-8');?>
][price]" value="0.00" size="10" class="input-medium" /></td>
            <td width="25%" data-th="<?php echo $_smarty_tpl->__("type");?>
">
            <select class="span3" name="product_data[prices][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['new_key']->value, ENT_QUOTES, 'UTF-8');?>
][type]">
                <option value="A" selected="selected"><?php echo $_smarty_tpl->__("absolute");?>
 (<?php echo $_smarty_tpl->tpl_vars['currencies']->value[$_smarty_tpl->tpl_vars['primary_currency']->value]['symbol'];?>
)</option>
                <option value="P"><?php echo $_smarty_tpl->__("percent");?>
 (%)</option>
            </select></td>
            <?php if (!fn_allowed_for("ULTIMATE:FREE")) {?>
            <td width="25%" data-th="<?php echo $_smarty_tpl->__("usergroup");?>
">
                <select id="usergroup_id" name="product_data[prices][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['new_key']->value, ENT_QUOTES, 'UTF-8');?>
][usergroup_id]" class="span3">
                    <?php  $_smarty_tpl->tpl_vars["usergroup"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["usergroup"]->_loop = false;
 $_from = fn_get_default_usergroups(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["usergroup"]->key => $_smarty_tpl->tpl_vars["usergroup"]->value) {
$_smarty_tpl->tpl_vars["usergroup"]->_loop = true;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usergroup']->value['usergroup'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                    <?php  $_smarty_tpl->tpl_vars["usergroup"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["usergroup"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['usergroups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["usergroup"]->key => $_smarty_tpl->tpl_vars["usergroup"]->value) {
$_smarty_tpl->tpl_vars["usergroup"]->_loop = true;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usergroup']->value['usergroup'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/update_for_all.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('display'=>$_smarty_tpl->tpl_vars['show_update_for_all']->value,'object_id'=>"price_".((string)$_smarty_tpl->tpl_vars['new_key']->value),'name'=>"update_all_vendors[prices][".((string)$_smarty_tpl->tpl_vars['new_key']->value)."]"), 0);?>

            </td>
            <?php }?>
            <td width="15%" class="right">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/multiple_buttons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('item_id'=>"add_qty_discount"), 0);?>

            </td>
        </tr>
        </tbody>
        </table>
    </div>

</div>
<?php }} ?>
