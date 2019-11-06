<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:48
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\block_manager\manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6674299585daf1d9c8db635-66893295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2a1b9055dd9f34b7481d8600e545cad1c8837ee' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\block_manager\\manage.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '6674299585daf1d9c8db635-66893295',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dynamic_object' => 0,
    'runtime' => 0,
    'location' => 0,
    'dynamic_object_scheme' => 0,
    'edit_object_id' => 0,
    'edit_object_type' => 0,
    'show_layout_controls' => 0,
    'navigation' => 0,
    'key' => 0,
    'id_suffix' => 0,
    'tab' => 0,
    'layouts' => 0,
    'layout' => 0,
    'config' => 0,
    'layout_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d9cc79751_00412196',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d9cc79751_00412196')) {function content_5daf1d9cc79751_00412196($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
if (!is_callable('smarty_function_style')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.style.php';
if (!is_callable('smarty_function_render_location')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.render_location.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_modifier_replace')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('block_already_exists_in_grid','new_layout','add_layout','export_layout','import_layout','edit_layout_on_site','block_manager','manage_blocks','export_layout','import_layout','block_manager.editing_layout_page','block_manager.add_layout_page','block_manager.new_layout_page','switch_layout','preview','make_default','editing_layout','properties','delete','widget_code','widget_what_is_it','select_all','editing_layout'));
?>
<?php $_smarty_tpl->tpl_vars['show_layout_controls'] = new Smarty_variable(!$_smarty_tpl->tpl_vars['dynamic_object']->value['object_id']&&(fn_allowed_for("ULTIMATE")||!$_smarty_tpl->tpl_vars['runtime']->value['company_id']), null, 0);?>
<?php $_smarty_tpl->tpl_vars['m_url'] = new Smarty_variable(rawurlencode($_REQUEST['manage_url']), null, 0);?>

<?php echo smarty_function_script(array('src'=>"js/tygh/block_manager.js"),$_smarty_tpl);?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript" class="cm-ajax-force">
    var selected_location = '<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['location']->value['location_id'])===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
';

    var dynamic_object_id = '<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['dynamic_object']->value['object_id'])===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
';
    var dynamic_object_type = '<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['dynamic_object_scheme']->value['object_type'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
';

    var BlockManager = new BlockManager_Class();

    // New traslations
    Tygh.tr({
        block_already_exists_in_grid: '<?php echo strtr($_smarty_tpl->__("block_already_exists_in_grid"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
'
    });

    var editObjectId = <?php echo htmlspecialchars(strtr((($tmp = @$_smarty_tpl->tpl_vars['edit_object_id']->value)===null||$tmp==='' ? 0 : $tmp), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" )), ENT_QUOTES, 'UTF-8');?>
,
        editObjectType = '<?php echo htmlspecialchars(strtr((($tmp = @$_smarty_tpl->tpl_vars['edit_object_type']->value)===null||$tmp==='' ? '' : $tmp), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" )), ENT_QUOTES, 'UTF-8');?>
';


    if (dynamic_object_id > 0) {
        var items = null;
        var grid_items = null;
    } else {
        var items = '.block';
        var grid_items = '.grid';
    }

    (function(_, $) {
        $(document).ready(function() {
            $('#content_location_' + selected_location).appear(function(){
                BlockManager.init('.grid', {
                    // UI settings
                    connectWith: '.grid',
                    items: items,
                    grid_items: grid_items,
                    revert: true,
                    placeholder: 'ui-hover-block',
                    opacity: 0.5,

                    // BlockManager_Class settings
                    parent: this,
                    container_class: 'container',
                    grid_class: 'grid',
                    block_class: 'block',
                    hover_element_class: 'hover-element',

                    // Controls selectors
                    controls_selector: '.grid-control-menu,.block-control-menu',
                    sortable_selector: '.ui-sortable',

                    device_availability_switcher: {
                        switch_selector: '.cm-switch-device-availability',
                        reset_selector: '.cm-reset-device-availability',
                        switcher_active_class: 'btn-primary',
                        device_attribute: 'data-ca-device-availability-device',
                        block_selector: '.device-specific-block',
                        block_availability_prefix: 'data-ca-device-availability-',
                        storage_cookie: 'device_filter'
                    },

                    edit_object_id: editObjectId,
                    edit_object_type: editObjectType
                });
            });
        });
    }(Tygh, Tygh.$));

<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php if ($_smarty_tpl->tpl_vars['dynamic_object']->value['object_id']>0) {?>
    <?php echo smarty_function_style(array('src'=>"block_manager_in_tab.css"),$_smarty_tpl);?>

<?php }?>
<?php echo smarty_function_style(array('src'=>"lib/960/960.css"),$_smarty_tpl);?>


<div id="block_window" class="grid-block hidden"></div>
<div id="block_manager_menu" class="grid-menu hidden"></div>
<div id="block_manager_prop" class="grid-prop hidden"></div>

<?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/render/grid.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('default_class'=>"base-grid hidden",'show_menu'=>true), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/render/block.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('default_class'=>"base-block hidden",'block_data'=>true), 0);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>
<?php $_smarty_tpl->_capture_stack[0][] = array("tabsbox", null, null); ob_start(); ?>
    <?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/components/device_switch.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('container_id'=>"content_location_".((string)$_smarty_tpl->tpl_vars['location']->value['location_id'])), 0);?>

    <div class="block-manager-location" id="content_location_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['location']->value['location_id'], ENT_QUOTES, 'UTF-8');?>
">
        <?php echo smarty_function_render_location(array('dispatch'=>$_smarty_tpl->tpl_vars['location']->value['dispatch'],'location_id'=>$_smarty_tpl->tpl_vars['location']->value['location_id'],'area'=>'A','lang_code'=>$_smarty_tpl->tpl_vars['location']->value['lang_code'],'device'=>$_REQUEST['device']),$_smarty_tpl);?>

    <!--content_location_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['location']->value['location_id'], ENT_QUOTES, 'UTF-8');?>
--></div>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("adv_buttons", null, null); ob_start(); ?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("add_new_picker", null, null); ob_start(); ?>
        <?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/components/update_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('layout_data'=>array()), 0);?>

    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php if ($_smarty_tpl->tpl_vars['show_layout_controls']->value) {?>
        <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"add_new_layout",'text'=>$_smarty_tpl->__("new_layout"),'content'=>Smarty::$_smarty_vars['capture']['add_new_picker'],'act'=>"general",'icon'=>"icon-plus",'title'=>$_smarty_tpl->__("add_layout")), 0);?>

    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("export_layout", null, null); ob_start(); ?>
    <?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/components/export_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('text'=>$_smarty_tpl->__("export_layout"),'content'=>Smarty::$_smarty_vars['capture']['export_layout'],'id'=>"export_layout_manager"), 0);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("import_layout", null, null); ob_start(); ?>
    <?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/components/import_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('text'=>$_smarty_tpl->__("import_layout"),'content'=>Smarty::$_smarty_vars['capture']['import_layout'],'id'=>"import_layout_manager"), 0);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
    
    <?php if ($_smarty_tpl->tpl_vars['show_layout_controls']->value) {?>
        <?php if ($_smarty_tpl->tpl_vars['location']->value['is_frontend_editing_allowed']) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"customization.update_mode?type=block_manager&status=enable",'but_text'=>$_smarty_tpl->__("edit_layout_on_site"),'but_role'=>"action",'but_meta'=>"btn cm-post",'but_target'=>"_blank"), 0);?>

        <?php }?>

        <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
            <li>
                <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"manage_blocks",'text'=>$_smarty_tpl->__("block_manager"),'link_text'=>$_smarty_tpl->__("manage_blocks"),'link_class'=>"cm-action bm-action-manage-blocks",'act'=>"link",'content'=>'','general_class'=>"action-btn"), 0);?>

            </li>
            <li class="divider"></li>
            <li>
                <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"export_layout_manager",'link_text'=>$_smarty_tpl->__("export_layout"),'act'=>"link",'content'=>'','general_class'=>"action-btn"), 0);?>

            </li>
            <li>
                <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"import_layout_manager",'link_text'=>$_smarty_tpl->__("import_layout"),'act'=>"link",'link_class'=>"cm-dialog-auto-size",'content'=>'','general_class'=>"action-btn"), 0);?>

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

<?php echo smarty_function_script(array('src'=>"js/tygh/tabs.js"),$_smarty_tpl);?>


<div class="cm-j-tabs tabs tabs-with-conf">
    <ul class="nav nav-tabs">
        <input type="hidden" id="s_layout" name="s_layout" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['location']->value['layout_id'], ENT_QUOTES, 'UTF-8');?>
" />
        <?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navigation']->value['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['tab']->key;
?>
                <li id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');
echo htmlspecialchars($_smarty_tpl->tpl_vars['id_suffix']->value, ENT_QUOTES, 'UTF-8');?>
" class="<?php if ($_smarty_tpl->tpl_vars['tab']->value['hidden']=="Y") {?>hidden <?php }
if ($_smarty_tpl->tpl_vars['key']->value=="location_".((string)$_smarty_tpl->tpl_vars['location']->value['location_id'])) {?>active extra-tab<?php }?>">
                    <?php if ($_smarty_tpl->tpl_vars['key']->value=="location_".((string)$_smarty_tpl->tpl_vars['location']->value['location_id'])&&$_smarty_tpl->tpl_vars['show_layout_controls']->value) {?>
                        <?php ob_start();
echo $_smarty_tpl->__("block_manager.editing_layout_page");
$_tmp1=ob_get_clean();?><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"dialog",'class'=>"cm-ajax-force hand icon-cog",'href'=>"block_manager.update_location?location=".((string)$_smarty_tpl->tpl_vars['location']->value['location_id'])."&s_layout=".((string)$_smarty_tpl->tpl_vars['location']->value['layout_id']),'id'=>"tab_location_".((string)$_smarty_tpl->tpl_vars['location']->value['location_id']),'title'=>$_tmp1.": ".((string)$_smarty_tpl->tpl_vars['tab']->value['title'])));?>

                    <?php }?>
                    <a <?php if ($_smarty_tpl->tpl_vars['tab']->value['href']) {?>href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['tab']->value['href']), ENT_QUOTES, 'UTF-8');?>
"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tab']->value['title'], ENT_QUOTES, 'UTF-8');?>
</a>
                </li>
        <?php } ?>
        <?php if ($_smarty_tpl->tpl_vars['show_layout_controls']->value) {?>
            <li class="cm-no-highlight">
                <?php ob_start();
echo $_smarty_tpl->__("block_manager.add_layout_page");
$_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"add_new_location",'text'=>$_smarty_tpl->__("block_manager.new_layout_page"),'link_text'=>$_tmp2."…",'act'=>"link",'href'=>"block_manager.update_location?s_layout=".((string)$_smarty_tpl->tpl_vars['location']->value['layout_id']),'opener_ajax_class'=>"cm-ajax",'link_class'=>"cm-ajax-force",'icon'=>"icon-plus",'content'=>''), 0);?>
</li>
        <?php }?>
    </ul>
</div>
<div class="cm-tabs-content">
    <?php echo Smarty::$_smarty_vars['capture']['tabsbox'];?>

</div>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("sidebar", null, null); ob_start(); ?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"block_manager:manage_sidebar")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"block_manager:manage_sidebar"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div id="block_manager_sidebar">
        <div class="sidebar-row layouts">
            <h6><?php echo $_smarty_tpl->__("switch_layout");?>
</h6>
            <ul class="nav nav-list">
                <?php  $_smarty_tpl->tpl_vars["layout"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["layout"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["layout"]->key => $_smarty_tpl->tpl_vars["layout"]->value) {
$_smarty_tpl->tpl_vars["layout"]->_loop = true;
?>
                    <li class="with-menu <?php if ($_smarty_tpl->tpl_vars['layout']->value['layout_id']==$_smarty_tpl->tpl_vars['runtime']->value['layout']['layout_id']) {?> active<?php }?>">
                        <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
                            <li><?php ob_start();
echo htmlspecialchars(fn_url("?s_layout=".((string)$_smarty_tpl->tpl_vars['layout']->value['layout_id']),"C"), ENT_QUOTES, 'UTF-8');
$_tmp3=ob_get_clean();?><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("preview"),'href'=>$_tmp3,'target'=>"_blank"));?>
</li>
                            <?php if ($_smarty_tpl->tpl_vars['show_layout_controls']->value) {?>
                                <li class="divider"></li>
                                <?php if (!$_smarty_tpl->tpl_vars['layout']->value['is_default']) {?>
                                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("make_default"),'href'=>"block_manager.set_default_layout?layout_id=".((string)$_smarty_tpl->tpl_vars['layout']->value['layout_id']),'class'=>"cm-ajax",'data'=>array("data-ca-target-id"=>"block_manager_sidebar"),'method'=>"POST"));?>
</li>
                                <?php }?>

                                <li>
                                    <?php $_smarty_tpl->_capture_stack[0][] = array("add_new_picker", null, null); ob_start(); ?>
                                        <?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/components/update_layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('layout_data'=>$_smarty_tpl->tpl_vars['layout']->value), 0);?>

                                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                                    <?php ob_start();
echo $_smarty_tpl->__("editing_layout");
$_tmp4=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"upate_layout_".((string)$_smarty_tpl->tpl_vars['layout']->value['layout_id']),'text'=>$_tmp4.": ".((string)$_smarty_tpl->tpl_vars['layout']->value['name']),'content'=>Smarty::$_smarty_vars['capture']['add_new_picker'],'act'=>"link",'link_text'=>$_smarty_tpl->__("properties")), 0);?>

                                </li>

                                <?php if (!$_smarty_tpl->tpl_vars['layout']->value['is_default']) {?>
                                    <li class="divider"></li>
                                    <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("delete"),'href'=>"block_manager.delete_layout?layout_id=".((string)$_smarty_tpl->tpl_vars['layout']->value['layout_id']),'class'=>"cm-confirm",'method'=>"POST"));?>
</li>
                                <?php }?>
                            <?php }?>
                        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                        <div class="pull-right">
                            <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list']));?>

                        </div>
                        <a href="<?php echo htmlspecialchars(fn_url("block_manager.manage?s_layout=".((string)$_smarty_tpl->tpl_vars['layout']->value['layout_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <hr>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"layouts:sidebar")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"layouts:sidebar"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php if ($_smarty_tpl->tpl_vars['show_layout_controls']->value) {?>
        <div class="sidebar-row">
<?php $_smarty_tpl->_capture_stack[0][] = array("widget_code", null, null); ob_start(); ?>
<?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/widget_code.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <h6><?php echo $_smarty_tpl->__("widget_code");?>
</h6>
            <div class="clearfix">
                <fieldset>
                    <textarea class="copy-field" id="widget_code_box" readonly="readonly" cols="30" rows="10"><?php echo htmlspecialchars(smarty_modifier_replace(Smarty::$_smarty_vars['capture']['widget_code']," data-no-defer",''), ENT_QUOTES, 'UTF-8');?>
</textarea>
                    <div class="pull-left"><?php echo $_smarty_tpl->__("widget_what_is_it",array("[href]"=>$_smarty_tpl->tpl_vars['config']->value['resources']['widget_mode_url']));?>
</div>
                    <a class="pull-right cm-select-text" data-ca-select-id="widget_code_box"><?php echo $_smarty_tpl->__("select_all");?>
</a>
                </fieldset>
            </div>
        </div>
            <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"layouts:sidebar"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    <!--block_manager_sidebar--></div>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"block_manager:manage_sidebar"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if ($_smarty_tpl->tpl_vars['dynamic_object']->value['object_id']) {?>
    <?php echo Smarty::$_smarty_vars['capture']['mainbox'];?>

<?php } else { ?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title_start'=>$_smarty_tpl->__("editing_layout"),'title_end'=>$_smarty_tpl->tpl_vars['layout_data']->value['name'],'adv_buttons'=>Smarty::$_smarty_vars['capture']['adv_buttons'],'buttons'=>Smarty::$_smarty_vars['capture']['buttons'],'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'select_languages'=>true,'sidebar'=>Smarty::$_smarty_vars['capture']['sidebar'],'mainbox_content_wrapper_class'=>"block-manager-wrapper"), 0);?>

<?php }?>
<?php }} ?>
