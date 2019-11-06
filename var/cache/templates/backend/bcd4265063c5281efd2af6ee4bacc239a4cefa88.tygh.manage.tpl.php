<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:27
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\product_options\manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13245593955daf1d8780a0e1-69787998%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bcd4265063c5281efd2af6ee4bacc239a4cefa88' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\product_options\\manage.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '13245593955daf1d8780a0e1-69787998',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'search' => 0,
    'object' => 0,
    'runtime' => 0,
    'product_data' => 0,
    'view_mode' => 0,
    'position' => 0,
    'extra' => 0,
    'product_options' => 0,
    'c_url' => 0,
    'c_icon' => 0,
    'po' => 0,
    'product_id' => 0,
    'allow_save' => 0,
    'query_delete_product_id' => 0,
    'details' => 0,
    'internal_option_name' => 0,
    'hide_for_vendor' => 0,
    'status' => 0,
    'query_product_id' => 0,
    'href_delete' => 0,
    'delete_target_id' => 0,
    'additional_class' => 0,
    'link_text' => 0,
    'non_editable' => 0,
    'select_language' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d8795e900_36926139',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d8795e900_36926139')) {function content_5daf1d8795e900_36926139($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('new_option','add_option','new_option','add_option','apply_to_products','name','code','internal_option_name_tooltip','status','individual','edit','view','view','editing_option','name','code','status','no_data','options'));
?>
<?php echo smarty_function_script(array('src'=>"js/tygh/tabs.js"),$_smarty_tpl);?>


    <?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
    function fn_check_option_type(value, tag_id)
    {
        var id = tag_id.replace('option_type_', '').replace('elm_', '');
        Tygh.$('#tab_option_variants_' + id).toggleBy(!(value == 'S' || value == 'R' || value == 'C'));
        Tygh.$('#required_options_' + id).toggleBy(!(value == 'I' || value == 'T' || value == 'F'));
        Tygh.$('#extra_options_' + id).toggleBy(!(value == 'I' || value == 'T'));
        Tygh.$('#file_options_' + id).toggleBy(!(value == 'F'));

        if (value == 'C') {
            var t = Tygh.$('table', '#content_tab_option_variants_' + id);
            Tygh.$('.cm-non-cb', t).switchAvailability(true); // hide obsolete columns
            Tygh.$('tbody:gt(1)', t).switchAvailability(true); // hide obsolete rows

        } else if (value == 'S' || value == 'R') {
            var t = Tygh.$('table', '#content_tab_option_variants_' + id);
            Tygh.$('.cm-non-cb', t).switchAvailability(false); // show all columns
            Tygh.$('tbody', t).switchAvailability(false); // show all rows
            Tygh.$('#box_add_variant_' + id).show(); // show "add new variants" box

        } else if (value == 'I' || value == 'T') {
            Tygh.$('#extra_options_' + id).show(); // show "add new variants" box
        }
    }
    <?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>



<?php $_smarty_tpl->tpl_vars['c_url'] = new Smarty_variable(fn_query_remove($_smarty_tpl->tpl_vars['config']->value['current_url'],"sort_by","sort_order"), null, 0);?>
<?php $_smarty_tpl->tpl_vars['c_icon'] = new Smarty_variable("<i class=\"icon-".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])."\"></i>", null, 0);?>

<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>

    <?php if ($_smarty_tpl->tpl_vars['object']->value=="global") {?>
        <?php $_smarty_tpl->tpl_vars['select_languages'] = new Smarty_variable(true, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['delete_target_id'] = new Smarty_variable("pagination_contents", null, 0);?>
    <?php } else { ?>
        <?php $_smarty_tpl->tpl_vars['delete_target_id'] = new Smarty_variable("product_options_list", null, 0);?>
    <?php }?>

    <?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


    <?php if (!($_smarty_tpl->tpl_vars['runtime']->value['company_id']&&(fn_allowed_for("MULTIVENDOR")||$_smarty_tpl->tpl_vars['product_data']->value['shared_product']=="Y")&&$_smarty_tpl->tpl_vars['runtime']->value['company_id']!=$_smarty_tpl->tpl_vars['product_data']->value['company_id'])) {?>
        <?php $_smarty_tpl->_capture_stack[0][] = array("toolbar", null, null); ob_start(); ?>
            <?php $_smarty_tpl->_capture_stack[0][] = array("add_new_picker", null, null); ob_start(); ?>
                <?php if ($_smarty_tpl->tpl_vars['product_data']->value) {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/product_options/update.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option_id'=>"0",'company_id'=>$_smarty_tpl->tpl_vars['product_data']->value['company_id'],'disable_company_picker'=>true), 0);?>

                <?php } else { ?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/product_options/update.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option_id'=>"0"), 0);?>

                <?php }?>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <?php if ($_smarty_tpl->tpl_vars['object']->value=="product") {?>
                <?php $_smarty_tpl->tpl_vars['position'] = new Smarty_variable("pull-right", null, 0);?>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['view_mode']->value=="embed") {?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"add_new_option",'text'=>$_smarty_tpl->__("new_option"),'link_text'=>$_smarty_tpl->__("add_option"),'act'=>"general",'content'=>Smarty::$_smarty_vars['capture']['add_new_picker'],'meta'=>$_smarty_tpl->tpl_vars['position']->value,'icon'=>"icon-plus"), 0);?>


            <?php } else { ?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"add_new_option",'text'=>$_smarty_tpl->__("new_option"),'title'=>$_smarty_tpl->__("add_option"),'act'=>"general",'content'=>Smarty::$_smarty_vars['capture']['add_new_picker'],'meta'=>$_smarty_tpl->tpl_vars['position']->value,'icon'=>"icon-plus"), 0);?>

            <?php }?>

        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php echo $_smarty_tpl->tpl_vars['extra']->value;?>

    <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['object']->value!="global") {?>
            <div class="btn-toolbar clearfix cm-toggle-button">
                <?php echo Smarty::$_smarty_vars['capture']['toolbar'];?>

            </div>
        <?php } else { ?>
            <?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
                <?php if ($_smarty_tpl->tpl_vars['product_options']->value&&$_smarty_tpl->tpl_vars['object']->value=="global") {?>
                    <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
                        <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("apply_to_products"),'href'=>"product_options.apply"));?>
</li>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                    <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list']));?>

                <?php }?>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <?php $_smarty_tpl->_capture_stack[0][] = array("adv_buttons", null, null); ob_start(); ?>
                <?php echo Smarty::$_smarty_vars['capture']['toolbar'];?>

            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php }?>

        <div class="items-container" id="product_options_list">
            <?php if ($_smarty_tpl->tpl_vars['product_options']->value) {?>
            <div class="table-responsive-wrapper">
                <table width="100%" class="table table-middle table-objects table-responsive">
                    <?php if ($_smarty_tpl->tpl_vars['object']->value=="global") {?>
                        <thead>
                        <tr>
                            <th>
                                <a class="cm-ajax" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&sort_by=option_name&sort_order=".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="pagination_contents"><?php echo $_smarty_tpl->__("name");?>
</a><?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="option_name") {
echo $_smarty_tpl->tpl_vars['c_icon']->value;
}?> /
                                <a class="cm-ajax" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&sort_by=internal_option_name&sort_order=".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="pagination_contents"><?php echo $_smarty_tpl->__("code");?>
</a><?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="internal_option_name") {
echo $_smarty_tpl->tpl_vars['c_icon']->value;
}
ob_start();?><?php echo $_smarty_tpl->__("internal_option_name_tooltip");?>
<?php $_tmp7=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_tmp7), 0);?>

                            </th>
                            <th></th>
                            <th></th>
                            <th class="pull-right">
                                <a class="cm-ajax" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&sort_by=status&sort_order=".((string)$_smarty_tpl->tpl_vars['search']->value['sort_order_rev'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="pagination_contents"><?php echo $_smarty_tpl->__("status");?>
</a><?php if ($_smarty_tpl->tpl_vars['search']->value['sort_by']=="status") {
echo $_smarty_tpl->tpl_vars['c_icon']->value;
}?>
                            </th>
                        </tr>
                        </thead>
                    <?php }?>
                    <tbody>
                        <?php  $_smarty_tpl->tpl_vars["po"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["po"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['product_options']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["po"]->key => $_smarty_tpl->tpl_vars["po"]->value) {
$_smarty_tpl->tpl_vars["po"]->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['object']->value=="product"&&$_smarty_tpl->tpl_vars['po']->value['product_id']) {?>
                                <?php ob_start();
echo $_smarty_tpl->__("individual");
$_tmp8=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['details'] = new Smarty_variable("(".$_tmp8.")", null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['query_product_id'] = new Smarty_variable('', null, 0);?>
                            <?php } else { ?>
                                <?php $_smarty_tpl->tpl_vars['details'] = new Smarty_variable('', null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['query_product_id'] = new Smarty_variable("&product_id=".((string)$_smarty_tpl->tpl_vars['product_id']->value), null, 0);?>
                            <?php }?>

                            <?php if ($_smarty_tpl->tpl_vars['object']->value=="product") {?>
                                <?php if (!$_smarty_tpl->tpl_vars['po']->value['product_id']) {?>
                                    <?php $_smarty_tpl->tpl_vars['query_product_id'] = new Smarty_variable("&object=".((string)$_smarty_tpl->tpl_vars['object']->value), null, 0);?>
                                <?php } else { ?>
                                    <?php $_smarty_tpl->tpl_vars['query_product_id'] = new Smarty_variable("&product_id=".((string)$_smarty_tpl->tpl_vars['product_id']->value)."&object=".((string)$_smarty_tpl->tpl_vars['object']->value), null, 0);?>
                                <?php }?>
                                <?php $_smarty_tpl->tpl_vars['query_delete_product_id'] = new Smarty_variable("&product_id=".((string)$_smarty_tpl->tpl_vars['product_id']->value), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['allow_save'] = new Smarty_variable(fn_allow_save_object($_smarty_tpl->tpl_vars['product_data']->value,"products"), null, 0);?>
                            <?php } else { ?>
                                <?php $_smarty_tpl->tpl_vars['query_product_id'] = new Smarty_variable('', null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['query_delete_product_id'] = new Smarty_variable('', null, 0);?>
                                <?php $_smarty_tpl->tpl_vars['allow_save'] = new Smarty_variable(fn_allow_save_object($_smarty_tpl->tpl_vars['po']->value,"product_options"), null, 0);?>
                            <?php }?>

                            <?php if (fn_allowed_for("MULTIVENDOR")) {?>
                                <?php if ($_smarty_tpl->tpl_vars['allow_save']->value) {?>
                                    <?php $_smarty_tpl->tpl_vars['link_text'] = new Smarty_variable($_smarty_tpl->__("edit"), null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['additional_class'] = new Smarty_variable("cm-no-hide-input", null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['hide_for_vendor'] = new Smarty_variable(false, null, 0);?>
                                <?php } else { ?>
                                    <?php $_smarty_tpl->tpl_vars['link_text'] = new Smarty_variable($_smarty_tpl->__("view"), null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['additional_class'] = new Smarty_variable('', null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['hide_for_vendor'] = new Smarty_variable(true, null, 0);?>
                                <?php }?>
                            <?php }?>

                            <?php $_smarty_tpl->tpl_vars['status'] = new Smarty_variable($_smarty_tpl->tpl_vars['po']->value['status'], null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['href_delete'] = new Smarty_variable("product_options.delete?option_id=".((string)$_smarty_tpl->tpl_vars['po']->value['option_id']).((string)$_smarty_tpl->tpl_vars['query_delete_product_id']->value), null, 0);?>

                            <?php if (fn_allowed_for("ULTIMATE")) {?>
                                <?php $_smarty_tpl->tpl_vars['non_editable'] = new Smarty_variable(false, null, 0);?>
                                <?php if ($_smarty_tpl->tpl_vars['runtime']->value['company_id']&&(($_smarty_tpl->tpl_vars['product_data']->value['shared_product']=="Y"&&$_smarty_tpl->tpl_vars['runtime']->value['company_id']!=$_smarty_tpl->tpl_vars['product_data']->value['company_id'])||($_smarty_tpl->tpl_vars['object']->value=="global"&&$_smarty_tpl->tpl_vars['runtime']->value['company_id']!=$_smarty_tpl->tpl_vars['po']->value['company_id']))) {?>
                                    <?php $_smarty_tpl->tpl_vars['link_text'] = new Smarty_variable($_smarty_tpl->__("view"), null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['href_delete'] = new Smarty_variable(false, null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['non_editable'] = new Smarty_variable(true, null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['is_view_link'] = new Smarty_variable(true, null, 0);?>
                                <?php }?>
                            <?php }?>

                            <?php $_smarty_tpl->tpl_vars['option_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['po']->value['option_name'], null, 0);?>
                            <?php if ($_smarty_tpl->tpl_vars['po']->value['internal_option_name']) {?>
                                <?php $_smarty_tpl->tpl_vars['internal_option_name'] = new Smarty_variable("<br />".((string)$_smarty_tpl->tpl_vars['po']->value['internal_option_name']), null, 0);?>
                            <?php }?>

                            <?php ob_start();
echo $_smarty_tpl->__("editing_option");
$_tmp9=ob_get_clean();?><?php ob_start();
echo $_smarty_tpl->__("name");
$_tmp10=ob_get_clean();?><?php ob_start();
echo $_smarty_tpl->__("code");
$_tmp11=ob_get_clean();?><?php ob_start();
echo $_smarty_tpl->__("status");
$_tmp12=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("common/object_group.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('no_table'=>true,'no_padding'=>true,'id'=>$_smarty_tpl->tpl_vars['po']->value['option_id'],'id_prefix'=>"_product_option_",'details'=>$_smarty_tpl->tpl_vars['details']->value,'text'=>$_smarty_tpl->tpl_vars['po']->value['option_name'],'href_desc'=>$_smarty_tpl->tpl_vars['internal_option_name']->value,'hide_for_vendor'=>$_smarty_tpl->tpl_vars['hide_for_vendor']->value,'status'=>$_smarty_tpl->tpl_vars['status']->value,'table'=>"product_options",'object_id_name'=>"option_id",'href'=>"product_options.update?option_id=".((string)$_smarty_tpl->tpl_vars['po']->value['option_id']).((string)$_smarty_tpl->tpl_vars['query_product_id']->value),'href_delete'=>$_smarty_tpl->tpl_vars['href_delete']->value,'delete_target_id'=>$_smarty_tpl->tpl_vars['delete_target_id']->value,'header_text'=>$_tmp9.": ".((string)$_smarty_tpl->tpl_vars['po']->value['option_name']),'skip_delete'=>!$_smarty_tpl->tpl_vars['allow_save']->value,'additional_class'=>$_smarty_tpl->tpl_vars['additional_class']->value,'prefix'=>"product_options",'link_text'=>$_smarty_tpl->tpl_vars['link_text']->value,'non_editable'=>$_smarty_tpl->tpl_vars['non_editable']->value,'company_object'=>$_smarty_tpl->tpl_vars['po']->value,'href_desc_row_hint'=>$_tmp10." / ".$_tmp11,'status_row_hint'=>$_tmp12), 0);?>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } else { ?>
                <p class="no-items"><?php echo $_smarty_tpl->__("no_data");?>
</p>
            <?php }?>
            <!--product_options_list--></div>
    <?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if ($_smarty_tpl->tpl_vars['object']->value=="product") {?>
    <?php echo Smarty::$_smarty_vars['capture']['mainbox'];?>

<?php } else { ?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("options"),'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'buttons'=>Smarty::$_smarty_vars['capture']['buttons'],'adv_buttons'=>Smarty::$_smarty_vars['capture']['adv_buttons'],'select_language'=>$_smarty_tpl->tpl_vars['select_language']->value), 0);?>

<?php }?>
<?php }} ?>
