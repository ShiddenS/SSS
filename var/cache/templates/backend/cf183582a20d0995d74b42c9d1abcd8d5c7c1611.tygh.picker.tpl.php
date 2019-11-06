<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:13:21
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\pickers\orders\picker.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18625443955daf1c910c42e8-15122707%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf183582a20d0995d74b42c9d1abcd8d5c7c1611' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\pickers\\orders\\picker.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '18625443955daf1c910c42e8-15122707',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data_id' => 0,
    'rnd' => 0,
    'view_mode' => 0,
    'item_ids' => 0,
    'extra_var' => 0,
    'no_container' => 0,
    'picker_view' => 0,
    'display' => 0,
    'picker_for' => 0,
    'checkbox_name' => 0,
    'aoc' => 0,
    'max_displayed_qty' => 0,
    'but_text' => 0,
    'input_name' => 0,
    'ldelim' => 0,
    'rdelim' => 0,
    'o' => 0,
    'no_item_text' => 0,
    'view_only' => 0,
    'order_info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1c914fe991_45778673',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1c914fe991_45778673')) {function content_5daf1c914fe991_45778673($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.math.php';
if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_modifier_count')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.count.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('add_orders','clear','add_orders','id','status','customer','date','total','no_items'));
?>
<?php echo smarty_function_math(array('equation'=>"rand()",'assign'=>"rnd"),$_smarty_tpl);?>

<?php $_smarty_tpl->tpl_vars["data_id"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['data_id']->value)."_".((string)$_smarty_tpl->tpl_vars['rnd']->value), null, 0);?>
<?php $_smarty_tpl->tpl_vars["view_mode"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['view_mode']->value)===null||$tmp==='' ? "mixed" : $tmp), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['view_mode']->value=="simple") {?>
    <?php $_smarty_tpl->tpl_vars["display"] = new Smarty_variable("simple", null, 0);?>
    <?php $_smarty_tpl->tpl_vars["max_displayed_qty"] = new Smarty_variable("50", null, 0);?>
<?php }?>

<?php echo smarty_function_script(array('src'=>"js/tygh/picker.js"),$_smarty_tpl);?>


<?php if ($_smarty_tpl->tpl_vars['item_ids']->value&&!is_array($_smarty_tpl->tpl_vars['item_ids']->value)) {?>
    <?php $_smarty_tpl->tpl_vars["item_ids"] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['item_ids']->value), null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['view_mode']->value!="list") {?>
    <div class="clearfix">
        <?php if ($_smarty_tpl->tpl_vars['extra_var']->value) {?>
            <?php $_smarty_tpl->tpl_vars["extra_var"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['extra_var']->value), null, 0);?>
        <?php }?>

        <?php if (!$_smarty_tpl->tpl_vars['no_container']->value) {?><div class="buttons-container pull-right"><?php }
if ($_smarty_tpl->tpl_vars['picker_view']->value) {?>[<?php }?>

            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_id'=>"opener_picker_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'but_href'=>fn_url("orders.picker?display=".((string)$_smarty_tpl->tpl_vars['display']->value)."&picker_for=".((string)$_smarty_tpl->tpl_vars['picker_for']->value)."&extra=".((string)$_smarty_tpl->tpl_vars['extra_var']->value)."&checkbox_name=".((string)$_smarty_tpl->tpl_vars['checkbox_name']->value)."&aoc=".((string)$_smarty_tpl->tpl_vars['aoc']->value)."&data_id=".((string)$_smarty_tpl->tpl_vars['data_id']->value)."&max_displayed_qty=".((string)$_smarty_tpl->tpl_vars['max_displayed_qty']->value)),'but_text'=>(($tmp = @$_smarty_tpl->tpl_vars['but_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("add_orders") : $tmp),'but_role'=>"add",'but_target_id'=>"content_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'but_meta'=>"btn cm-dialog-opener",'but_icon'=>"icon-plus"), 0);?>


            <?php if ($_smarty_tpl->tpl_vars['view_mode']->value=="simple") {?>
                <span id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_clear" class="reload-container<?php if (!$_smarty_tpl->tpl_vars['item_ids']->value) {?> hidden<?php }?>">
                    <?php ob_start();
echo htmlspecialchars(fn_url("orders.manage?order_id="), ENT_QUOTES, 'UTF-8');
$_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_id'=>"opener_picker_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'but_onclick'=>"Tygh."."$".".cePicker('delete_js_item', '".((string)$_smarty_tpl->tpl_vars['data_id']->value)."', 'delete_all', 'o'); Tygh."."$".".cePicker('check_items_qty', '".((string)$_smarty_tpl->tpl_vars['data_id']->value)."', '".$_tmp5."', ".((string)$_smarty_tpl->tpl_vars['max_displayed_qty']->value)."); return false;",'but_text'=>(($tmp = @$_smarty_tpl->tpl_vars['but_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("clear") : $tmp),'but_role'=>"action",'but_icon'=>"icon-repeat",'but_target_id'=>"content_".((string)$_smarty_tpl->tpl_vars['data_id']->value)), 0);?>

                </span>
            <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['picker_view']->value) {?>]<?php }
if (!$_smarty_tpl->tpl_vars['no_container']->value) {?></div><?php }?>
        <div class="hidden" id="content_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['but_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("add_orders") : $tmp), ENT_QUOTES, 'UTF-8');?>
">
        </div>
    </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['view_mode']->value=="simple") {?>
    <input id="o<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_ids" type="hidden" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['input_name']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {
echo htmlspecialchars(implode(",",$_smarty_tpl->tpl_vars['item_ids']->value), ENT_QUOTES, 'UTF-8');
}?>" />
    <span id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if (!$_smarty_tpl->tpl_vars['item_ids']->value) {?> class="hidden"<?php }?>>
        <?php echo $_smarty_tpl->getSubTemplate ("pickers/orders/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('order_id'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."order_id".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'clone'=>true), 0);?>

        <?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {?>
        <?php  $_smarty_tpl->tpl_vars["o"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["o"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item_ids']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["o"]->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["o"]->key => $_smarty_tpl->tpl_vars["o"]->value) {
$_smarty_tpl->tpl_vars["o"]->_loop = true;
 $_smarty_tpl->tpl_vars["o"]->index++;
 $_smarty_tpl->tpl_vars["o"]->first = $_smarty_tpl->tpl_vars["o"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['first'] = $_smarty_tpl->tpl_vars["o"]->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['iteration']++;
?>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['items']['iteration']<=$_smarty_tpl->tpl_vars['max_displayed_qty']->value) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("pickers/orders/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('order_id'=>$_smarty_tpl->tpl_vars['o']->value,'first_item'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['items']['first'],'holder'=>$_smarty_tpl->tpl_vars['data_id']->value), 0);?>

            <?php } else { ?>
            <?php echo $_smarty_tpl->getSubTemplate ("pickers/orders/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('order_id'=>$_smarty_tpl->tpl_vars['o']->value,'first_item'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['items']['first'],'holder'=>$_smarty_tpl->tpl_vars['data_id']->value,'hidden'=>true), 0);?>

            <?php }?>
        <?php } ?>
        <?php }?>
    </span>
    <span id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_details"<?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['item_ids']->value)<=$_smarty_tpl->tpl_vars['max_displayed_qty']->value) {?> class="hidden"<?php }?>><a href="<?php echo htmlspecialchars(fn_url("orders.manage?order_id="), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['item_ids']->value) {
echo htmlspecialchars(implode(',',$_smarty_tpl->tpl_vars['item_ids']->value), ENT_QUOTES, 'UTF-8');
}?>">..</a></span>
    <span id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_no_item"<?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {?> class="hidden"<?php }?>><?php echo $_smarty_tpl->tpl_vars['no_item_text']->value;?>
</span>

<?php } elseif ($_smarty_tpl->tpl_vars['view_mode']->value!="button") {?>

    <input id="o<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_ids" type="hidden" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['input_name']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {
echo htmlspecialchars(implode(",",$_smarty_tpl->tpl_vars['item_ids']->value), ENT_QUOTES, 'UTF-8');
}?>" />
    <div class="table-wrapper">
        <table class="table table-middle">
            <thead>
                <tr>
                    <th width="10%"><?php echo $_smarty_tpl->__("id");?>
</th>
                    <th width="15%"><?php echo $_smarty_tpl->__("status");?>
</th>
                    <th width="25%"><?php echo $_smarty_tpl->__("customer");?>
</th>
                    <th width="25%"><?php echo $_smarty_tpl->__("date");?>
</th>
                    <th width="24%" class="right"><?php echo $_smarty_tpl->__("total");?>
</th>
                    <?php if (!$_smarty_tpl->tpl_vars['view_only']->value) {?><th>&nbsp;</th><?php }?>
                </tr>
            </thead>
            <tbody id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if (!$_smarty_tpl->tpl_vars['item_ids']->value) {?> class="hidden"<?php }?>>
            <?php echo $_smarty_tpl->getSubTemplate ("pickers/orders/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('order_id'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."order_id".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'status'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."status".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'customer'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."customer".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'timestamp'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."timestamp".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'total'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."total".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'holder'=>$_smarty_tpl->tpl_vars['data_id']->value,'clone'=>true), 0);?>

            <?php  $_smarty_tpl->tpl_vars["o"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["o"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item_ids']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["o"]->key => $_smarty_tpl->tpl_vars["o"]->value) {
$_smarty_tpl->tpl_vars["o"]->_loop = true;
?>
                <?php $_smarty_tpl->tpl_vars["order_info"] = new Smarty_variable(fn_get_order_short_info($_smarty_tpl->tpl_vars['o']->value), null, 0);?>
                <?php echo $_smarty_tpl->getSubTemplate ("pickers/orders/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('order_id'=>$_smarty_tpl->tpl_vars['o']->value,'status'=>$_smarty_tpl->tpl_vars['order_info']->value['status'],'customer'=>((string)$_smarty_tpl->tpl_vars['order_info']->value['firstname'])." ".((string)$_smarty_tpl->tpl_vars['order_info']->value['lastname']),'timestamp'=>$_smarty_tpl->tpl_vars['order_info']->value['timestamp'],'total'=>$_smarty_tpl->tpl_vars['order_info']->value['total'],'holder'=>$_smarty_tpl->tpl_vars['data_id']->value), 0);?>

            <?php } ?>
            </tbody>
            <tbody id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_no_item"<?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {?> class="hidden"<?php }?>>
            <tr class="no-items">
                <td colspan="<?php if (!$_smarty_tpl->tpl_vars['view_only']->value) {?>6<?php } else { ?>5<?php }?>"><p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['no_item_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("no_items") : $tmp);?>
</p></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php }?><?php }} ?>
