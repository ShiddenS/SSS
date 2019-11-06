<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:58
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\tabs\manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:938381135daf1da6c8e1e5-39546367%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6863bcc49d3ff6cf04a6d08dfc4680b740440428' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\tabs\\manage.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '938381135daf1da6c8e1e5-39546367',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'dynamic_object' => 0,
    'product_tabs' => 0,
    'tab' => 0,
    'non_editable' => 0,
    'location' => 0,
    'r_url' => 0,
    'dynamic_object_href' => 0,
    '_href_update' => 0,
    '_href_delete' => 0,
    'draggable' => 0,
    'additional_class' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1da70e1231_58424906',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1da70e1231_58424906')) {function content_5daf1da70e1231_58424906($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('block_settings','block_settings','block','editing_tab','no_data','new_tab','add_tab','product_tabs'));
?>
<?php echo smarty_function_script(array('src'=>"js/tygh/tabs.js"),$_smarty_tpl);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>

<?php $_smarty_tpl->tpl_vars["r_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
<?php if (fn_check_view_permissions("tabs.update")) {?>
    <?php $_smarty_tpl->tpl_vars["non_editable"] = new Smarty_variable(false, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["non_editable"] = new Smarty_variable(true, null, 0);?>
<?php }?>
<div class="items-container <?php if (!$_smarty_tpl->tpl_vars['dynamic_object']->value) {?>cm-sortable<?php }?>" data-ca-sortable-table="product_tabs" data-ca-sortable-id-name="tab_id"  id="manage_tabs_list">

    <div class="table-responsive-wrapper">
        <table width="100%" class="table table-middle table-objects table-responsive table-responsive-w-titles">
            <tbody>
        <?php  $_smarty_tpl->tpl_vars["tab"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["tab"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product_tabs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["tab"]->key => $_smarty_tpl->tpl_vars["tab"]->value) {
$_smarty_tpl->tpl_vars["tab"]->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['tab']->value['is_primary']=="Y"||$_smarty_tpl->tpl_vars['dynamic_object']->value||$_smarty_tpl->tpl_vars['non_editable']->value) {?>
                <?php $_smarty_tpl->tpl_vars["_href_delete"] = new Smarty_variable('', null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["_href_delete"] = new Smarty_variable("tabs.delete?tab_id=".((string)$_smarty_tpl->tpl_vars['tab']->value['tab_id']), null, 0);?>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['dynamic_object']->value) {?>
                <?php $_smarty_tpl->tpl_vars["dynamic_object_href"] = new Smarty_variable("&dynamic_object[object_type]=".((string)$_smarty_tpl->tpl_vars['dynamic_object']->value['object_type'])."&dynamic_object[object_id]=".((string)$_smarty_tpl->tpl_vars['dynamic_object']->value['object_id'])."&selected_location=".((string)$_smarty_tpl->tpl_vars['location']->value['location_id'])."&hide_status=1", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["r_url"] = new Smarty_variable(urlencode("products.update?product_id=".((string)$_smarty_tpl->tpl_vars['dynamic_object']->value['object_id'])."&selected_section=product_tabs"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["additional_class"] = new Smarty_variable('', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["draggable"] = new Smarty_variable(false, null, 0);?>
                <?php $_smarty_tpl->tpl_vars["_href_update"] = new Smarty_variable('', null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["dynamic_object_href"] = new Smarty_variable('', null, 0);?>
                <?php $_smarty_tpl->tpl_vars["r_url"] = new Smarty_variable("tabs.manage", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["additional_class"] = new Smarty_variable("cm-sortable-row cm-sortable-id-".((string)$_smarty_tpl->tpl_vars['tab']->value['tab_id']), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["draggable"] = new Smarty_variable(true, null, 0);?>
                <?php $_smarty_tpl->tpl_vars["_href_update"] = new Smarty_variable("tabs.update?tab_data[tab_id]=".((string)$_smarty_tpl->tpl_vars['tab']->value['tab_id'])."&return_url=".((string)$_smarty_tpl->tpl_vars['r_url']->value), null, 0);?>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['tab']->value['product_ids']) {?>
                <?php $_smarty_tpl->tpl_vars["confirm"] = new Smarty_variable(true, null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["confirm"] = new Smarty_variable('', null, 0);?>
            <?php }?>

            <?php $_smarty_tpl->_capture_stack[0][] = array("tool_items", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['tab']->value['tab_type']=="B") {?><span class="small-note lowercase">(<?php if ($_smarty_tpl->tpl_vars['tab']->value['block_id']&&$_smarty_tpl->tpl_vars['dynamic_object']->value) {
echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"edit_block_properties_".((string)$_smarty_tpl->tpl_vars['tab']->value['block_id'])."_tab_".((string)$_smarty_tpl->tpl_vars['tab']->value['tab_id']),'text'=>$_smarty_tpl->__("block_settings"),'link_text'=>$_smarty_tpl->__("block_settings"),'act'=>"link",'href'=>"block_manager.update_block?block_data[block_id]=".((string)$_smarty_tpl->tpl_vars['tab']->value['block_id'])."&r_url=".((string)$_smarty_tpl->tpl_vars['r_url']->value)."&html_id=tab_".((string)$_smarty_tpl->tpl_vars['tab']->value['tab_id']).((string)$_smarty_tpl->tpl_vars['dynamic_object_href']->value),'action'=>"block_manager.update_block",'opener_ajax_class'=>"cm-ajax",'link_class'=>"cm-ajax-force",'content'=>''), 0);
} else {
echo $_smarty_tpl->__("block");
}?>)</span>
                <?php }?>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <?php ob_start();
echo $_smarty_tpl->__("editing_tab");
$_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("common/object_group.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>$_smarty_tpl->tpl_vars['tab']->value['tab_id'],'text'=>$_smarty_tpl->tpl_vars['tab']->value['name'],'href'=>$_smarty_tpl->tpl_vars['_href_update']->value,'href_delete'=>$_smarty_tpl->tpl_vars['_href_delete']->value,'delete_target_id'=>"pagination_contents",'header_text'=>$_tmp1.": ".((string)$_smarty_tpl->tpl_vars['tab']->value['name']),'table'=>"product_tabs",'object_id_name'=>"tab_id",'draggable'=>$_smarty_tpl->tpl_vars['draggable']->value,'update_controller'=>'tabs','dynamic_object'=>$_smarty_tpl->tpl_vars['dynamic_object_href']->value,'status'=>$_smarty_tpl->tpl_vars['tab']->value['status'],'additional_class'=>$_smarty_tpl->tpl_vars['additional_class']->value,'href_desc'=>Smarty::$_smarty_vars['capture']['tool_items'],'non_editable'=>$_smarty_tpl->tpl_vars['dynamic_object']->value,'no_table'=>true,'can_change_status'=>true), 0);?>

        <?php }
if (!$_smarty_tpl->tpl_vars["tab"]->_loop) {
?>

            <p class="no-items"><?php echo $_smarty_tpl->__("no_data");?>
</p>

        <?php } ?>
            </tbody>
        </table>
    </div>
<!--manage_tabs_list--></div>

<div class="buttons-container">
    <?php $_smarty_tpl->_capture_stack[0][] = array("extra_tools", null, null); ob_start(); ?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"currencies:import_rates")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"currencies:import_rates"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"currencies:import_rates"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
</div>

<?php if (!$_smarty_tpl->tpl_vars['dynamic_object']->value) {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("adv_buttons", null, null); ob_start(); ?>
        <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('act'=>"general",'id'=>"add_tab",'text'=>$_smarty_tpl->__("new_tab"),'title'=>$_smarty_tpl->__("add_tab"),'icon'=>"icon-plus",'href'=>"tabs.update",'action'=>"tabs.update",'opener_ajax_class'=>"cm-ajax",'link_class'=>"cm-ajax-force",'content'=>''), 0);?>

    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if (!$_smarty_tpl->tpl_vars['dynamic_object']->value) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("product_tabs"),'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'adv_buttons'=>Smarty::$_smarty_vars['capture']['adv_buttons'],'select_languages'=>true), 0);?>

<?php } else { ?>
    <?php echo Smarty::$_smarty_vars['capture']['mainbox'];?>

<?php }?>

<?php }} ?>
