<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 12:32:48
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\block_manager\update_block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6502721785db2c1408f4765-66184564%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb474a6ea8bb997d7b026a8f692a408619453161' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\block_manager\\update_block.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '6502721785db2c1408f4765-66184564',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'block' => 0,
    'snapping_data' => 0,
    'id' => 0,
    'snapping_id' => 0,
    'block_scheme' => 0,
    'editable_content' => 0,
    'html_id' => 0,
    'dynamic_object' => 0,
    'location' => 0,
    'active_tab' => 0,
    'dynamic_object_scheme' => 0,
    'hide_status' => 0,
    'editable_template_name' => 0,
    'k' => 0,
    'v' => 0,
    'setting_data' => 0,
    'name' => 0,
    'editable_wrapper' => 0,
    'w' => 0,
    'device' => 0,
    'is_available' => 0,
    'block_availability_instance' => 0,
    'devices_icon' => 0,
    'url' => 0,
    'changed_content_stat' => 0,
    'stat' => 0,
    'start_position' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2c140d304c5_49710361',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2c140d304c5_49710361')) {function content_5db2c140d304c5_49710361($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_function_include_ext')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.include_ext.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('general','content','block_settings','status','name','template','settings','wrapper','user_class','block_manager.availability.show_on','block_manager.availability.','dynamic_content','override_by_this','tt_views_block_manager_update_block_override_by_this','content_changed_for','global_status','active','disabled','disable_for','enable_for'));
?>
<?php if ($_smarty_tpl->tpl_vars['block']->value) {?>
    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->tpl_vars['block']->value['block_id'], null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable(0, null, 0);?>
<?php }?>

<?php $_smarty_tpl->tpl_vars["uid"] = new Smarty_variable(uniqid(4), null, 0);?>
<?php $_smarty_tpl->tpl_vars["snapping_id"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['snapping_data']->value['snapping_id'])===null||$tmp==='' ? "0" : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["html_id"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['id']->value)."_".((string)$_smarty_tpl->tpl_vars['snapping_id']->value)."_".((string)$_smarty_tpl->tpl_vars['block']->value['type']), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['id']->value==0) {?>
    <?php $_smarty_tpl->tpl_vars["hide_status"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php if ($_REQUEST['active_tab']) {?>
    <?php $_smarty_tpl->tpl_vars["active_tab"] = new Smarty_variable($_REQUEST['active_tab'], null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["active_tab"] = new Smarty_variable('block_general', null, 0);?>
<?php }?>

<?php echo smarty_function_script(array('src'=>"js/tygh/tabs.js"),$_smarty_tpl);?>


<?php if ($_REQUEST['dynamic_object']['object_id']>0) {?>
    <?php $_smarty_tpl->tpl_vars["dynamic_object"] = new Smarty_variable($_REQUEST['dynamic_object'], null, 0);?>
<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("block_content", null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['block_scheme']->value['content']) {?>
        <?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/components/block_content.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('content_type'=>$_smarty_tpl->tpl_vars['block']->value['properties']['content_type'],'block_scheme'=>$_smarty_tpl->tpl_vars['block_scheme']->value,'block'=>$_smarty_tpl->tpl_vars['block']->value,'editable'=>$_smarty_tpl->tpl_vars['editable_content']->value,'tab_id'=>((string)$_smarty_tpl->tpl_vars['html_id']->value)), 0);?>

    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" enctype="multipart/form-data" class="form-horizontal form-edit cm-skip-check-items <?php if ($_smarty_tpl->tpl_vars['dynamic_object']->value) {?>cm-hide-inputs<?php }?>  <?php if ($_REQUEST['ajax_update']) {?>cm-ajax cm-form-dialog-closer<?php }?>" name="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
_update_form">
<div id="block_properties_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
">
    <?php if ($_REQUEST['dynamic_object']['object_id']>0) {?>
        <input type="hidden" name="dynamic_object[object_id]" value="<?php echo htmlspecialchars($_REQUEST['dynamic_object']['object_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input"/>    
        <input type="hidden" name="dynamic_object[object_type]" value="<?php echo htmlspecialchars($_REQUEST['dynamic_object']['object_type'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input"/>    
    <?php }?>
    <input type="hidden" id="s_layout" name="s_layout" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['location']->value['layout_id'], ENT_QUOTES, 'UTF-8');?>
" />
    <input type="hidden" name="block_data[type]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['type'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input"/>
    <input type="hidden" name="block_data[block_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input"/>
    <input type="hidden" name="block_data[content_data][snapping_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['snapping_data']->value['snapping_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input"/>    

    <?php if (!$_smarty_tpl->tpl_vars['block_scheme']->value['multilanguage']) {?>
        <input type="hidden" name="block_data[apply_to_all_langs]" value="Y" class="cm-no-hide-input"/>
    <?php }?>
    
    <input type="hidden" name="snapping_data[snapping_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['snapping_data']->value['snapping_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input"/>
    <input type="hidden" name="snapping_data[grid_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['snapping_data']->value['grid_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input"/>
    <input type="hidden" name="selected_location" value="<?php echo htmlspecialchars((($tmp = @$_REQUEST['selected_location'])===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input" />
    <?php if ($_REQUEST['assign_to']) {?>
        <input type="hidden" name="assign_to" value="<?php echo htmlspecialchars($_REQUEST['assign_to'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input"/>
    <?php }?>
    <input type="hidden" name="result_ids" value="<?php if ($_REQUEST['r_result_ids']) {
echo htmlspecialchars($_REQUEST['r_result_ids'], ENT_QUOTES, 'UTF-8');?>
,<?php }?>block_properties_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input"/>

    
    
    <?php if ($_REQUEST['r_url']) {?>
        <input type="hidden" name="r_url" value="<?php echo htmlspecialchars($_REQUEST['r_url'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input"/>
    <?php }?>
    <div class="tabs cm-j-tabs cm-track">
        <ul class="nav nav-tabs">
            <li id="block_general_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-js <?php if ($_smarty_tpl->tpl_vars['active_tab']->value=="block_general_".((string)$_smarty_tpl->tpl_vars['html_id']->value)) {?> active<?php }?>"><a><?php echo $_smarty_tpl->__("general");?>
</a></li>
            <?php if (trim(Smarty::$_smarty_vars['capture']['block_content'])) {?><li id="block_contents_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-js<?php if ($_smarty_tpl->tpl_vars['active_tab']->value=="block_contents_".((string)$_smarty_tpl->tpl_vars['html_id']->value)) {?> active<?php }?>"><a><?php echo $_smarty_tpl->__("content");?>
</a></li><?php }?>
            <?php if ($_smarty_tpl->tpl_vars['block_scheme']->value['settings']) {?>
                <li id="block_settings_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-js<?php if ($_smarty_tpl->tpl_vars['active_tab']->value=="block_settings_".((string)$_smarty_tpl->tpl_vars['html_id']->value)) {?> active<?php }?>"><a><?php echo $_smarty_tpl->__("block_settings");?>
</a></li>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['dynamic_object_scheme']->value&&!$_smarty_tpl->tpl_vars['hide_status']->value) {?>
                <li id="block_status_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-js<?php if ($_smarty_tpl->tpl_vars['active_tab']->value=="block_status_".((string)$_smarty_tpl->tpl_vars['html_id']->value)) {?> active<?php }?>"><a><?php echo $_smarty_tpl->__("status");?>
</a></li>
            <?php }?>
        </ul>
    </div>

    <div class="cm-tabs-content" id="tabs_content_block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <div id="content_block_general_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
">
            <div class="control-group <?php if ($_smarty_tpl->tpl_vars['editable_template_name']->value) {?>cm-no-hide-input<?php }?>">
                <label for="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_name" class="control-label cm-required"><?php echo $_smarty_tpl->__("name");?>
</label>
                <div class="controls">
                <?php if ($_REQUEST['html_id']&&$_smarty_tpl->tpl_vars['id']->value>0) {?>
                    <div class="text-type-value"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['name'], ENT_QUOTES, 'UTF-8');?>
</div>
                <?php } else { ?>
                    <input type="text" name="block_data[description][name]" id="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_name" class="span9" size="25" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['name'], ENT_QUOTES, 'UTF-8');?>
" />
                <?php }?>
                </div>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['block_scheme']->value['templates']) {?>
                <div class="control-group <?php if ($_smarty_tpl->tpl_vars['editable_template_name']->value) {?>cm-no-hide-input<?php }?>">
                    <label class="control-label" for="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_template"><?php echo $_smarty_tpl->__("template");?>
</label>
                    <div class="controls">
                    <?php if (is_array($_smarty_tpl->tpl_vars['block_scheme']->value['templates'])) {?>
                        <select id="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_template" name="block_data[properties][template]"  class="cm-reload-form">
                            <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['block_scheme']->value['templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                                <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['block']->value['properties']['template']==$_smarty_tpl->tpl_vars['k']->value) {?>selected="selected"<?php }?>><?php if ($_smarty_tpl->tpl_vars['v']->value['name']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['v']->value['name'], ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');
}?></option>
                            <?php } ?>
                        </select>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['dynamic_object']->value) {?>
                        <input type="hidden" name="block_data[properties][template]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['properties']['template'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input" />
                    <?php }?>
                    <?php if (is_array($_smarty_tpl->tpl_vars['block_scheme']->value['templates'][$_smarty_tpl->tpl_vars['block']->value['properties']['template']]['settings'])) {?>
                        <a href="#" id="sw_case_settings_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="open cm-combination" onclick="return false">
                            <?php echo $_smarty_tpl->__("settings");?>

                            <span class="combo-arrow"></span>
                        </a>
                    <?php }?>
                    </div>
                </div>
            <?php }?>
            
            <?php if (is_array($_smarty_tpl->tpl_vars['block_scheme']->value['templates'][$_smarty_tpl->tpl_vars['block']->value['properties']['template']]['settings'])) {?>        
                <div id="case_settings_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="hidden">
                <?php  $_smarty_tpl->tpl_vars['setting_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['setting_data']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['block_scheme']->value['templates'][$_smarty_tpl->tpl_vars['block']->value['properties']['template']]['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['setting_data']->key => $_smarty_tpl->tpl_vars['setting_data']->value) {
$_smarty_tpl->tpl_vars['setting_data']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['setting_data']->key;
?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/components/setting_element.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>$_smarty_tpl->tpl_vars['setting_data']->value,'name'=>$_smarty_tpl->tpl_vars['name']->value,'block'=>$_smarty_tpl->tpl_vars['block']->value,'html_id'=>"block_".((string)$_smarty_tpl->tpl_vars['html_id']->value)."_properties_".((string)$_smarty_tpl->tpl_vars['name']->value),'html_name'=>"block_data[properties][".((string)$_smarty_tpl->tpl_vars['name']->value)."]",'editable'=>$_smarty_tpl->tpl_vars['editable_template_name']->value,'value'=>$_smarty_tpl->tpl_vars['block']->value['properties'][$_smarty_tpl->tpl_vars['name']->value]), 0);?>

                <?php } ?>
                </div>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['editable_wrapper']->value) {?>
                <div class="control-group">
                    <label class="control-label" for="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_wrapper"><?php echo $_smarty_tpl->__("wrapper");?>
</label>
                    <div class="controls">
                    <select name="snapping_data[wrapper]" id="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_wrapper">
                        <option value="">--</option>
                        <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['block_scheme']->value['wrappers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value) {
$_smarty_tpl->tpl_vars['w']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['w']->key;
?>                            
                            <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['block']->value['wrapper']==$_smarty_tpl->tpl_vars['k']->value) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['w']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_user_class"><?php echo $_smarty_tpl->__("user_class");?>
</label>
                    <div class="controls">
                    <input type="text" name="snapping_data[user_class]" id="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_user_class" size="25" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['user_class'], ENT_QUOTES, 'UTF-8');?>
"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label cm-required cm-multiple-checkboxes"
                           for="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_availability"
                    ><?php echo $_smarty_tpl->__("block_manager.availability.show_on");?>
</label>
                    <div class="controls" id="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_availability">
                        <div class="btn-group btn-group-checkbox">
                            <?php  $_smarty_tpl->tpl_vars['is_available'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['is_available']->_loop = false;
 $_smarty_tpl->tpl_vars['device'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['block']->value['availability']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['is_available']->key => $_smarty_tpl->tpl_vars['is_available']->value) {
$_smarty_tpl->tpl_vars['is_available']->_loop = true;
 $_smarty_tpl->tpl_vars['device']->value = $_smarty_tpl->tpl_vars['is_available']->key;
?>
                            
                                <?php if ($_smarty_tpl->tpl_vars['device']->value=="phone") {?>
                                    <?php $_smarty_tpl->tpl_vars['devices_icon'] = new Smarty_variable("icon-mobile-phone", null, 0);?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['device']->value=="tablet") {?>
                                    <?php $_smarty_tpl->tpl_vars['devices_icon'] = new Smarty_variable("icon-tablet", null, 0);?>
                                <?php } elseif ($_smarty_tpl->tpl_vars['device']->value=="desktop") {?>
                                    <?php $_smarty_tpl->tpl_vars['devices_icon'] = new Smarty_variable("icon-desktop", null, 0);?>
                                <?php }?>

                                <input type="checkbox"
                                    id="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_show_on_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['device']->value, ENT_QUOTES, 'UTF-8');?>
"
                                    class="cm-text-toggle btn-group-checkbox__checkbox"
                                    <?php if ($_smarty_tpl->tpl_vars['is_available']->value) {?>checked="checked"<?php }?>
                                    data-ca-toggle-text="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block_availability_instance']->value->getHiddenClass($_smarty_tpl->tpl_vars['device']->value), ENT_QUOTES, 'UTF-8');?>
"
                                    data-ca-toggle-text-mode="onDisable"
                                    data-ca-toggle-text-target-elem-id="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_user_class"
                                />
                                <label class="btn btn-group-checkbox__label" for="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_show_on_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['device']->value, ENT_QUOTES, 'UTF-8');?>
">
                                    <i class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['devices_icon']->value, ENT_QUOTES, 'UTF-8');?>
"></i>
                                    <?php echo $_smarty_tpl->__("block_manager.availability.".((string)$_smarty_tpl->tpl_vars['device']->value));?>

                                </label>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php }?>            
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"block_manager:settings")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"block_manager:settings"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"block_manager:settings"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </div>
        <?php if (Smarty::$_smarty_vars['capture']['block_content']) {?>
            <div id="content_block_contents_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
" >
                <?php if ($_smarty_tpl->tpl_vars['dynamic_object']->value['object_id']>0) {?>
                    <input type="hidden" name="block_data[content_data][object_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dynamic_object']->value['object_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input" />
                    <input type="hidden" name="block_data[content_data][object_type]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dynamic_object']->value['object_type'], ENT_QUOTES, 'UTF-8');?>
" class="cm-no-hide-input" />
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['block']->value['object_id']>0) {?>
                    <div class="text-tip">                
                        <?php $_smarty_tpl->tpl_vars["url"] = new Smarty_variable(fn_url(((string)$_smarty_tpl->tpl_vars['dynamic_object_scheme']->value['customer_dispatch'])."&".((string)$_smarty_tpl->tpl_vars['dynamic_object_scheme']->value['key'])."=".((string)$_smarty_tpl->tpl_vars['dynamic_object']->value['object_id']),'C','http',@constant('DESCR_SL')), null, 0);?>
                        <?php echo $_smarty_tpl->__("dynamic_content",array("[url]"=>$_smarty_tpl->tpl_vars['url']->value));?>

                    </div>
                <?php }?>

                <?php echo Smarty::$_smarty_vars['capture']['block_content'];?>


                <?php $_smarty_tpl->_capture_stack[0][] = array("content_stat", null, null); ob_start();
$_smarty_tpl->tpl_vars['stat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['stat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['changed_content_stat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['stat']->key => $_smarty_tpl->tpl_vars['stat']->value) {
$_smarty_tpl->tpl_vars['stat']->_loop = true;
if ($_smarty_tpl->tpl_vars['stat']->value['object_type']!='') {?><div><?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"show_objects_".((string)$_smarty_tpl->tpl_vars['block']->value['block_id'])."_".((string)$_smarty_tpl->tpl_vars['stat']->value['object_type']),'text'=>$_smarty_tpl->__($_smarty_tpl->tpl_vars['stat']->value['object_type']),'link_text'=>((string)$_smarty_tpl->tpl_vars['stat']->value['contents_count']),'act'=>"link",'href'=>"block_manager.show_objects?object_type=".((string)$_smarty_tpl->tpl_vars['stat']->value['object_type'])."&block_id=".((string)$_smarty_tpl->tpl_vars['block']->value['block_id']),'opener_ajax_class'=>"cm-ajax",'link_class'=>"cm-ajax-force",'content'=>''), 0);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['stat']->value['object_type'], ENT_QUOTES, 'UTF-8');?>
</div><?php }
}
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                <?php if (Smarty::$_smarty_vars['capture']['content_stat']) {?>
                <div class="control-group">
                    <label class="control-label" for="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_override_by_this"><?php echo $_smarty_tpl->__("override_by_this");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("tt_views_block_manager_update_block_override_by_this")), 0);?>
</label>
                    <div class="controls">
                        <input type="hidden" class="cm-no-hide-input" name="block_data[content_data][override_by_this]" value="N" />
                        <input id="block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
_override_by_this" type="checkbox" class="cm-no-hide-input" name="block_data[content_data][override_by_this]" value="Y" />
                    </div>
                </div>
                <div class="statistics-box">
                    <div class="statistics-body">
                        <p class="strong"><?php echo $_smarty_tpl->__("content_changed_for");?>
</p>
                        <?php echo Smarty::$_smarty_vars['capture']['content_stat'];?>

                    </div>
                </div>
                <?php }?>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['block_scheme']->value['settings']) {?>
            <div id="content_block_settings_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
" >
                    <?php  $_smarty_tpl->tpl_vars['setting_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['setting_data']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['block_scheme']->value['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['setting_data']->key => $_smarty_tpl->tpl_vars['setting_data']->value) {
$_smarty_tpl->tpl_vars['setting_data']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['setting_data']->key;
?>
                        <?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/components/setting_element.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>$_smarty_tpl->tpl_vars['setting_data']->value,'name'=>$_smarty_tpl->tpl_vars['name']->value,'block'=>$_smarty_tpl->tpl_vars['block']->value,'html_id'=>"block_".((string)$_smarty_tpl->tpl_vars['html_id']->value)."_properties_".((string)$_smarty_tpl->tpl_vars['name']->value),'html_name'=>"block_data[properties][".((string)$_smarty_tpl->tpl_vars['name']->value)."]",'editable'=>$_smarty_tpl->tpl_vars['editable_template_name']->value,'value'=>$_smarty_tpl->tpl_vars['block']->value['properties'][$_smarty_tpl->tpl_vars['name']->value]), 0);?>

                    <?php } ?>
            </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['dynamic_object_scheme']->value&&!$_smarty_tpl->tpl_vars['hide_status']->value) {?>
        <div id="content_block_status_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
" >
            <div class="control-group">
                <label class="control-label"><?php echo $_smarty_tpl->__("global_status");?>
:</label>
                <div class="controls">
                    <p>
                        <?php if ($_smarty_tpl->tpl_vars['block']->value['status']=='A') {
echo $_smarty_tpl->__("active");
} else {
echo $_smarty_tpl->__("disabled");
}?>
                    </p>
                </div>
            </div>
            <input type="hidden" class="cm-no-hide-input" name="snapping_data[object_type]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dynamic_object_scheme']->value['object_type'], ENT_QUOTES, 'UTF-8');?>
" />
            <div class="control-group cm-no-hide-input">                        
                <label class="control-label"><?php if ($_smarty_tpl->tpl_vars['block']->value['status']=='A') {
echo $_smarty_tpl->__("disable_for");
} else {
echo $_smarty_tpl->__("enable_for");
}?></label>
                <?php $_smarty_tpl->_capture_stack[0][] = array("picker_extra_url", null, null); ob_start(); ?>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"block_manager:update_block_picker_extra_url")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"block_manager:update_block_picker_extra_url"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dynamic_object_scheme']->value['picker_params']['extra_url'], ENT_QUOTES, 'UTF-8');?>

                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"block_manager:update_block_picker_extra_url"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                <?php $_smarty_tpl->createLocalArrayVariable('dynamic_object_scheme', null, 0);
$_smarty_tpl->tpl_vars['dynamic_object_scheme']->value['picker_params']['extra_url'] = trim(Smarty::$_smarty_vars['capture']['picker_extra_url']);?>
                <div class="controls">
                <?php echo smarty_function_include_ext(array('file'=>$_smarty_tpl->tpl_vars['dynamic_object_scheme']->value['picker'],'data_id'=>"block_".((string)$_smarty_tpl->tpl_vars['html_id']->value)."_object_ids_d",'input_name'=>"snapping_data[object_ids]",'item_ids'=>$_smarty_tpl->tpl_vars['block']->value['object_ids'],'view_mode'=>"links",'params_array'=>$_smarty_tpl->tpl_vars['dynamic_object_scheme']->value['picker_params'],'start_pos'=>$_smarty_tpl->tpl_vars['start_position']->value),$_smarty_tpl);?>

                </div>
            </div>
        </div>
        <?php }?>
    </div>
    <!--block_properties_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['html_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
    <div class="buttons-container">
        <?php if ($_REQUEST['force_close']) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[block_manager.update_block]",'cancel_action'=>"close",'save'=>$_smarty_tpl->tpl_vars['id']->value), 0);?>

        <?php } else { ?>
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[block_manager.update_block]",'cancel_action'=>"close",'save'=>$_smarty_tpl->tpl_vars['id']->value), 0);?>

        <?php }?>
    </div>
</form>
<?php }} ?>
