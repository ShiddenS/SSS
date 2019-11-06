<?php /* Smarty version Smarty-3.1.21, created on 2019-10-28 12:59:50
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\companies\manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14519551695db6bc160f8a57-66144943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '38abd0066c517fc9cf3dae596be045a344d61f14' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\companies\\manage.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '14519551695db6bc160f8a57-66144943',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'search' => 0,
    'companies' => 0,
    'c_url' => 0,
    'c_icon' => 0,
    'c_dummy' => 0,
    'company' => 0,
    'storefront_href' => 0,
    'settings' => 0,
    'runtime' => 0,
    'return_current_url' => 0,
    'notify' => 0,
    'return_url' => 0,
    'is_companies_limit_reached' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db6bc17c47b60_44980615',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db6bc17c47b60_44980615')) {function content_5db6bc17c47b60_44980615($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.enum.php';
if (!is_callable('smarty_modifier_puny_decode')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.puny_decode.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.date_format.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('id','name','email','storefront','registered','status','ttc_stores_status','stores_status','id','name','email','storefront','registered','tools','view_vendor_products','view_vendor_users','view_vendor_orders','merge','edit','delete','delete','status','notify_vendor','stores_status','no_data','proceed','activate_selected','activate_selected','proceed','disable_selected','disable_selected','activate_selected','disable_selected','export_selected','invite_vendors_title','invite_vendors','ultimate_or_storefront_license_required','add_vendor','add_vendor','vendors'));
?>
<?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_scripts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>

<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="companies_form" id="companies_form">
<input type="hidden" name="fake" value="1" />

<?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('save_current_page'=>true,'save_current_url'=>true), 0);?>


<?php $_smarty_tpl->tpl_vars["c_url"] = new Smarty_variable(fn_query_remove($_smarty_tpl->tpl_vars['config']->value['current_url'],"sort_by","sort_order"), null, 0);?>
<?php $_smarty_tpl->tpl_vars["c_icon"] = new Smarty_variable("<i class=\"icon-".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])."\"></i>", null, 0);?>
<?php $_smarty_tpl->tpl_vars["c_dummy"] = new Smarty_variable("<i class=\"icon-dummy\"></i>", null, 0);?>

<?php $_smarty_tpl->tpl_vars["return_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['companies']->value) {?>
<div class="table-responsive-wrapper">
    <table width="100%" class="table table-middle table-responsive">
    <thead>
    <tr>
        <th width="1%" class="left mobile-hide">
            <?php echo $_smarty_tpl->getSubTemplate ("common/check_items.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</th>
        <th width="6%"><a class="cm-ajax" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&sort_by=id&sort_order=".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="pagination_contents"><?php echo $_smarty_tpl->__("id");
if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="id") {
echo $_smarty_tpl->tpl_vars['c_icon']->value;
} else {
echo $_smarty_tpl->tpl_vars['c_dummy']->value;
}?></a></th>
        <th width="25%"><a class="cm-ajax" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&sort_by=company&sort_order=".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="pagination_contents"><?php echo $_smarty_tpl->__("name");
if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="company") {
echo $_smarty_tpl->tpl_vars['c_icon']->value;
} else {
echo $_smarty_tpl->tpl_vars['c_dummy']->value;
}?></a></th>
        <?php if (fn_allowed_for("MULTIVENDOR")) {?>
            <th width="25%"><a class="cm-ajax" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&sort_by=email&sort_order=".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="pagination_contents"><?php echo $_smarty_tpl->__("email");
if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="email") {
echo $_smarty_tpl->tpl_vars['c_icon']->value;
} else {
echo $_smarty_tpl->tpl_vars['c_dummy']->value;
}?></a></th>
        <?php }?>
        <?php if (fn_allowed_for("ULTIMATE")) {?>
            <th width="25%"><a class="cm-ajax" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&sort_by=storefront&sort_order=".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="pagination_contents"><?php echo $_smarty_tpl->__("storefront");
if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="storefront") {
echo $_smarty_tpl->tpl_vars['c_icon']->value;
} else {
echo $_smarty_tpl->tpl_vars['c_dummy']->value;
}?></a></th>
        <?php }?>
        <th width="20%"><a class="cm-ajax" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&sort_by=date&sort_order=".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="pagination_contents"><?php echo $_smarty_tpl->__("registered");
if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="date") {
echo $_smarty_tpl->tpl_vars['c_icon']->value;
} else {
echo $_smarty_tpl->tpl_vars['c_dummy']->value;
}?></a></th>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"companies:list_extra_th")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"companies:list_extra_th"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"companies:list_extra_th"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <th width="10%" class="nowrap">&nbsp;</th>
        <?php if (fn_allowed_for("MULTIVENDOR")) {?>
            <th width="10%" class="right"><a class="cm-ajax" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&sort_by=status&sort_order=".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="pagination_contents"><?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="status") {
echo $_smarty_tpl->tpl_vars['c_icon']->value;
} else {
echo $_smarty_tpl->tpl_vars['c_dummy']->value;
}
echo $_smarty_tpl->__("status");?>
</a></th>
        <?php } else { ?>
            <th width="13%"><span class="cm-tooltip" title="<?php echo $_smarty_tpl->__("ttc_stores_status");?>
"><?php echo $_smarty_tpl->__("stores_status");?>
&nbsp;<i class="icon-question-sign"></i><?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="stores_status") {
echo $_smarty_tpl->tpl_vars['c_icon']->value;
} else {
echo $_smarty_tpl->tpl_vars['c_dummy']->value;
}?></span></th>
        <?php }?>
    </tr>
    </thead>
    <?php  $_smarty_tpl->tpl_vars['company'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['company']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['companies']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['company']->key => $_smarty_tpl->tpl_vars['company']->value) {
$_smarty_tpl->tpl_vars['company']->_loop = true;
?>
    <tr class="cm-row-status-<?php echo htmlspecialchars(mb_strtolower($_smarty_tpl->tpl_vars['company']->value['status'], 'UTF-8'), ENT_QUOTES, 'UTF-8');?>
" data-ct-company-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company_id'], ENT_QUOTES, 'UTF-8');?>
">
        <td class="left mobile-hide">
            <input type="checkbox" name="company_ids[]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-item" />
        </td>
        <td class="row-status" data-th="<?php echo $_smarty_tpl->__("id");?>
"><a href="<?php echo htmlspecialchars(fn_url("companies.update?company_id=".((string)$_smarty_tpl->tpl_vars['company']->value['company_id'])), ENT_QUOTES, 'UTF-8');?>
">&nbsp;<span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company_id'], ENT_QUOTES, 'UTF-8');?>
</span>&nbsp;</a></td>
        <td class="row-status" data-th="<?php echo $_smarty_tpl->__("name");?>
"><a href="<?php echo htmlspecialchars(fn_url("companies.update?company_id=".((string)$_smarty_tpl->tpl_vars['company']->value['company_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company'], ENT_QUOTES, 'UTF-8');?>
</a></td>
        <?php if (fn_allowed_for("MULTIVENDOR")) {?>
            <td class="row-status" data-th="<?php echo $_smarty_tpl->__("email");?>
"><a href="mailto:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['email'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['email'], ENT_QUOTES, 'UTF-8');?>
</a></td>
        <?php }?>
        <?php if (fn_allowed_for("ULTIMATE")) {?>
            <?php $_smarty_tpl->tpl_vars['storefront_href'] = new Smarty_variable("http://".((string)$_smarty_tpl->tpl_vars['company']->value['storefront']), null, 0);?>
            <?php if ($_smarty_tpl->tpl_vars['company']->value['storefront_status']===smarty_modifier_enum("StorefrontStatuses::CLOSED")&&$_smarty_tpl->tpl_vars['company']->value['store_access_key']) {?>
                <?php $_smarty_tpl->tpl_vars['storefront_href'] = new Smarty_variable(fn_link_attach($_smarty_tpl->tpl_vars['storefront_href']->value,"store_access_key=".((string)$_smarty_tpl->tpl_vars['company']->value['store_access_key'])), null, 0);?>
            <?php }?>
            <td data-th="<?php echo $_smarty_tpl->__("storefront");?>
" id="storefront_url_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company_id'], ENT_QUOTES, 'UTF-8');?>
"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['storefront_href']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(smarty_modifier_puny_decode($_smarty_tpl->tpl_vars['company']->value['storefront']), ENT_QUOTES, 'UTF-8');?>
</a><!--storefront_url_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company']->value['company_id'], ENT_QUOTES, 'UTF-8');?>
--></td>
        <?php }?>
        <td class="row-status" data-th="<?php echo $_smarty_tpl->__("registered");?>
"><?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['company']->value['timestamp'],((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['date_format']).", ".((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['time_format'])), ENT_QUOTES, 'UTF-8');?>
</td>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"companies:list_extra_td")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"companies:list_extra_td"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"companies:list_extra_td"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <td class="nowrap" data-th="<?php echo $_smarty_tpl->__("tools");?>
">
            <?php $_smarty_tpl->_capture_stack[0][] = array("tools_items", null, null); ob_start(); ?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"companies:list_extra_links")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"companies:list_extra_links"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'href'=>"products.manage?company_id=".((string)$_smarty_tpl->tpl_vars['company']->value['company_id']),'text'=>$_smarty_tpl->__("view_vendor_products")));?>
</li>
                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'href'=>"profiles.manage?company_id=".((string)$_smarty_tpl->tpl_vars['company']->value['company_id']),'text'=>$_smarty_tpl->__("view_vendor_users")));?>
</li>
                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'href'=>"orders.manage?company_id=".((string)$_smarty_tpl->tpl_vars['company']->value['company_id']),'text'=>$_smarty_tpl->__("view_vendor_orders")));?>
</li>
                <?php if (!fn_allowed_for("ULTIMATE")&&!$_smarty_tpl->tpl_vars['runtime']->value['company_id']) {?>
                    <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'href'=>"companies.merge?company_id=".((string)$_smarty_tpl->tpl_vars['company']->value['company_id']),'text'=>$_smarty_tpl->__("merge")));?>
</li>
                <?php }?>
                <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']&&fn_check_view_permissions("companies.update","POST")) {?>
                    <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'href'=>"companies.update?company_id=".((string)$_smarty_tpl->tpl_vars['company']->value['company_id']),'text'=>$_smarty_tpl->__("edit")));?>
</li>
                    <li class="divider"></li>
                    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['simple_ultimate']) {?>
                        <li class="disabled"><a><?php echo $_smarty_tpl->__("delete");?>
</a></li>
                    <?php } else { ?>
                        <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'class'=>"cm-confirm",'href'=>"companies.delete?company_id=".((string)$_smarty_tpl->tpl_vars['company']->value['company_id'])."&redirect_url=".((string)$_smarty_tpl->tpl_vars['return_current_url']->value),'text'=>$_smarty_tpl->__("delete"),'method'=>"POST"));?>
</li>
                    <?php }?>
                <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"companies:list_extra_links"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <div class="hidden-tools">
                <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_items']));?>

            </div>
        </td>
        <?php if (fn_allowed_for("MULTIVENDOR")) {?>
            <td class="right nowrap" data-th="<?php echo $_smarty_tpl->__("status");?>
">
                <?php $_smarty_tpl->tpl_vars["notify"] = new Smarty_variable(true, null, 0);?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/select_popup.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>$_smarty_tpl->tpl_vars['company']->value['company_id'],'status'=>$_smarty_tpl->tpl_vars['company']->value['status'],'items_status'=>fn_get_predefined_statuses("companies",$_smarty_tpl->tpl_vars['company']->value['status']),'object_id_name'=>"company_id",'hide_for_vendor'=>$_smarty_tpl->tpl_vars['runtime']->value['company_id'],'update_controller'=>"companies",'notify'=>$_smarty_tpl->tpl_vars['notify']->value,'notify_text'=>$_smarty_tpl->__("notify_vendor"),'status_target_id'=>"pagination_contents",'extra'=>"&return_url=".((string)$_smarty_tpl->tpl_vars['return_url']->value)), 0);?>

            </td>
        <?php } else { ?>
            <td class="row-status" data-th="<?php echo $_smarty_tpl->__("stores_status");?>
">
                <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/company_status_switcher.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('company'=>$_smarty_tpl->tpl_vars['company']->value), 0);?>

            </td>
        <?php }?>
    </tr>
    <?php } ?>
    </table>
</div>
<?php } else { ?>
    <p class="no-items"><?php echo $_smarty_tpl->__("no_data");?>
</p>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['companies']->value) {?>
    <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']) {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("activate_selected", null, null); ob_start(); ?>
        <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/reason_container.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('type'=>"activate"), 0);?>

        <div class="buttons-container">
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("proceed"),'but_name'=>"dispatch[companies.m_activate]",'cancel_action'=>"close",'but_meta'=>"cm-process-items"), 0);?>

        </div>
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"activate_selected",'text'=>$_smarty_tpl->__("activate_selected"),'content'=>Smarty::$_smarty_vars['capture']['activate_selected'],'link_text'=>$_smarty_tpl->__("activate_selected")), 0);?>


    <?php $_smarty_tpl->_capture_stack[0][] = array("disable_selected", null, null); ob_start(); ?>
        <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/reason_container.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('type'=>"disable"), 0);?>

        <div class="buttons-container">
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("proceed"),'but_name'=>"dispatch[companies.m_disable]",'cancel_action'=>"close",'but_meta'=>"cm-process-items"), 0);?>

        </div>
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"disable_selected",'text'=>$_smarty_tpl->__("disable_selected"),'content'=>Smarty::$_smarty_vars['capture']['disable_selected'],'link_text'=>$_smarty_tpl->__("disable_selected")), 0);?>

    <?php }?>
<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</form>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("tools_items", null, null); ob_start(); ?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"companies:manage_tools_list")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"companies:manage_tools_list"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if ($_smarty_tpl->tpl_vars['companies']->value&&!$_smarty_tpl->tpl_vars['runtime']->value['company_id']&&!fn_allowed_for("ULTIMATE")) {?>
                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("activate_selected"),'dispatch'=>"dispatch[companies.export_range]",'form'=>"companies_form",'class'=>"cm-process-items cm-dialog-opener",'data'=>array("data-ca-target-id"=>"content_activate_selected")));?>
</li>                    
                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("disable_selected"),'dispatch'=>"dispatch[companies.export_range]",'form'=>"companies_form",'class'=>"cm-process-items cm-dialog-opener",'data'=>array("data-ca-target-id"=>"content_disable_selected")));?>
</li>                    
            <?php }?>
            <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']&&fn_check_view_permissions("companies.update","POST")) {?>
                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"delete_selected",'dispatch'=>"dispatch[companies.m_delete]",'form'=>"companies_form"));?>
</li>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['companies']->value&&fn_allowed_for("MULTIVENDOR")) {?>
                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("export_selected"),'dispatch'=>"dispatch[companies.export_range]",'form'=>"companies_form"));?>
</li>
            <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"companies:manage_tools_list"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_items'],'class'=>"mobile-hide"));?>


    <?php if (fn_allowed_for("MULTIVENDOR")) {?>
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_role'=>"text",'but_href'=>"companies.invite",'title'=>$_smarty_tpl->__("invite_vendors_title"),'but_text'=>$_smarty_tpl->__("invite_vendors"),'but_meta'=>"btn cm-dialog-opener"), 0);?>

    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("adv_buttons", null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['is_companies_limit_reached']->value) {?>
        <?php $_smarty_tpl->tpl_vars['promo_popup_title'] = new Smarty_variable($_smarty_tpl->__("ultimate_or_storefront_license_required",array("[product]"=>@constant('PRODUCT_NAME'))), null, 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("common/tools.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tool_override_meta'=>"btn cm-dialog-opener cm-dialog-auto-height",'tool_href'=>"functionality_restrictions.ultimate_or_storefront_license_required",'prefix'=>"top",'hide_tools'=>true,'title'=>$_smarty_tpl->__("add_vendor"),'icon'=>"icon-plus",'meta_data'=>"data-ca-dialog-title=\"".((string)$_smarty_tpl->tpl_vars['promo_popup_title']->value)."\""), 0);?>

    <?php } else { ?>
        <?php echo $_smarty_tpl->getSubTemplate ("common/tools.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tool_href'=>"companies.add",'prefix'=>"top",'hide_tools'=>true,'title'=>$_smarty_tpl->__("add_vendor"),'icon'=>"icon-plus"), 0);?>

    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("sidebar", null, null); ob_start(); ?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"companies:manage_sidebar")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"companies:manage_sidebar"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php echo $_smarty_tpl->getSubTemplate ("common/saved_search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('dispatch'=>"companies.manage",'view_type'=>"companies"), 0);?>

    <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/companies_search_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('dispatch'=>"companies.manage"), 0);?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"companies:manage_sidebar"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("vendors"),'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'buttons'=>Smarty::$_smarty_vars['capture']['buttons'],'adv_buttons'=>Smarty::$_smarty_vars['capture']['adv_buttons'],'sidebar'=>Smarty::$_smarty_vars['capture']['sidebar']), 0);?>

<?php }} ?>
