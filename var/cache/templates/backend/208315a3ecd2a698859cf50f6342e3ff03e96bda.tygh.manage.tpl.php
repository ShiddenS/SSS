<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:12:17
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\menus\manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18009690655db2ca814bd4e9-75904333%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '208315a3ecd2a698859cf50f6342e3ff03e96bda' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\menus\\manage.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '18009690655db2ca814bd4e9-75904333',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'menus' => 0,
    'menu' => 0,
    'manage_items_link' => 0,
    'name' => 0,
    'edit_link' => 0,
    '_href_delete' => 0,
    'dialog_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2ca8167c8b6_62655513',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2ca8167c8b6_62655513')) {function content_5db2ca8167c8b6_62655513($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('editing_menu','manage_items','no_data','new_menu','add_menu','menus'));
?>
<?php echo smarty_function_script(array('src'=>"js/tygh/tabs.js"),$_smarty_tpl);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>

<?php $_smarty_tpl->tpl_vars["r_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>

<div class="items-container" id="manage_tabs_list">

<?php if ($_smarty_tpl->tpl_vars['menus']->value) {?>
<div class="table-responsive-wrapper">
    <table class="table table-middle table-objects table-responsive table-responsive-w-titles">
        <?php  $_smarty_tpl->tpl_vars["menu"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["menu"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["menu"]->key => $_smarty_tpl->tpl_vars["menu"]->value) {
$_smarty_tpl->tpl_vars["menu"]->_loop = true;
?>
            <?php $_smarty_tpl->tpl_vars["_href_delete"] = new Smarty_variable("menus.delete?menu_id=".((string)$_smarty_tpl->tpl_vars['menu']->value['menu_id']), null, 0);?>        
            <?php ob_start();
echo $_smarty_tpl->__("editing_menu");
$_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["dialog_name"] = new Smarty_variable($_tmp1.": ".((string)$_smarty_tpl->tpl_vars['menu']->value['name']), null, 0);?>
            <?php $_smarty_tpl->tpl_vars["name"] = new Smarty_variable($_smarty_tpl->tpl_vars['menu']->value['name'], null, 0);?>
            <?php $_smarty_tpl->tpl_vars["edit_link"] = new Smarty_variable("menus.update?menu_data[menu_id]=".((string)$_smarty_tpl->tpl_vars['menu']->value['menu_id'])."&return_url=".((string)$_smarty_tpl->tpl_vars['r_url']->value), null, 0);?>
            <?php $_smarty_tpl->tpl_vars["manage_items_link"] = new Smarty_variable("static_data.manage?section=A&menu_id=".((string)$_smarty_tpl->tpl_vars['menu']->value['menu_id']), null, 0);?>
            <?php $_smarty_tpl->_capture_stack[0][] = array("items_link", null, null); ob_start(); ?>            
                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("manage_items"),'href'=>$_smarty_tpl->tpl_vars['manage_items_link']->value));?>
</li>
                <li class="divider"></li>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <?php echo $_smarty_tpl->getSubTemplate ("common/object_group.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>$_smarty_tpl->tpl_vars['menu']->value['menu_id'],'text'=>$_smarty_tpl->tpl_vars['name']->value,'href'=>$_smarty_tpl->tpl_vars['edit_link']->value,'main_link'=>$_smarty_tpl->tpl_vars['manage_items_link']->value,'href_edit'=>$_smarty_tpl->tpl_vars['edit_link']->value,'href_delete'=>$_smarty_tpl->tpl_vars['_href_delete']->value,'delete_target_id'=>"manage_tabs_list",'header_text'=>$_smarty_tpl->tpl_vars['dialog_name']->value,'table'=>"menus",'object_id_name'=>"menu_id",'status'=>$_smarty_tpl->tpl_vars['menu']->value['status'],'tool_items'=>Smarty::$_smarty_vars['capture']['items_link'],'no_table'=>true), 0);?>

        <?php } ?>
    </table>
</div>
<?php } else { ?>
    <p class="no-items"><?php echo $_smarty_tpl->__("no_data");?>
</p>
<?php }?>

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

<?php $_smarty_tpl->_capture_stack[0][] = array("adv_buttons", null, null); ob_start(); ?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('act'=>"general",'id'=>"add_menu",'text'=>$_smarty_tpl->__("new_menu"),'title'=>$_smarty_tpl->__("add_menu"),'href'=>"menus.update",'opener_ajax_class'=>"cm-ajax",'icon'=>"icon-plus",'content'=>''), 0);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("menus"),'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'select_languages'=>true,'adv_buttons'=>Smarty::$_smarty_vars['capture']['adv_buttons']), 0);?>

<?php }} ?>
