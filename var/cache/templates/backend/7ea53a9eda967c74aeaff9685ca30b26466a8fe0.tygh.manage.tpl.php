<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 12:24:40
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\themes\manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19315678415db2bf5888b1e3-12159128%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7ea53a9eda967c74aeaff9685ca30b26466a8fe0' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\themes\\manage.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '19315678415db2bf5888b1e3-12159128',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'available_themes' => 0,
    'conflicts' => 0,
    'requested_theme_name' => 0,
    'setting_section' => 0,
    'setting' => 0,
    'theme_name' => 0,
    'theme' => 0,
    'layout' => 0,
    'images_dir' => 0,
    'available_layout' => 0,
    'style' => 0,
    'has_styles' => 0,
    'styles_descr' => 0,
    'o' => 0,
    'but_meta' => 0,
    'can_manage_themes' => 0,
    'installed_theme' => 0,
    'theme_id' => 0,
    'can_remove' => 0,
    'tooltip' => 0,
    'runtime' => 0,
    'but_text' => 0,
    'splitted_themes' => 0,
    'repo_themes' => 0,
    'repo_theme' => 0,
    'dev_modes' => 0,
    'settings' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2bf5a4303f5_21299140',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2bf5a4303f5_21299140')) {function content_5db2bf5a4303f5_21299140($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_modifier_replace')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php';
if (!is_callable('smarty_modifier_count')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.count.php';
if (!is_callable('smarty_function_split')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.split.php';
if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('settings_overwrite_title','settings_overwrite_text','current_setting_value','new_setting_value','cancel','overwrite_selected_settings','current_theme','general','directory','name','description','theme_styles_and_layouts','layout','theme_editor.style','none','theme_no_styles_text','theme_editor','theme_editor_not_supported','theme_editor','edit_layout_on_site','edit_content_on_site','active','cannot_remove_theme_has_dependent_themes','remove_theme','layouts','theme_editor.styles','activate','use_this_style','currently_in_use','currently_in_use','activate','no_themes_available','install','preview','install','no_themes_available','clone_theme','rebuild_cache_automatically','rebuild_cache_automatically_tooltip','theme_information','name','directory','layouts','theme_editor.styles','developer','marketplace','marketplace_find_more','upload_theme','upload_theme','clone_theme','themes'));
?>
<?php echo smarty_function_script(array('src'=>"js/lib/bootstrap_switch/js/bootstrapSwitch.js"),$_smarty_tpl);?>


<?php echo $_smarty_tpl->getSubTemplate ("common/previewer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>

<?php $_smarty_tpl->_capture_stack[0][] = array("upload_theme", null, null); ob_start(); ?>
    <?php echo $_smarty_tpl->getSubTemplate ("views/themes/components/upload_theme.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->tpl_vars['theme'] = new Smarty_variable($_smarty_tpl->tpl_vars['available_themes']->value['current'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['theme_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['available_themes']->value['current']['theme_name'], null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['conflicts']->value) {?>
    <div id="conflicts">
        <h4><?php echo $_smarty_tpl->__("settings_overwrite_title");?>
</h4>
        <p><?php echo $_smarty_tpl->__("settings_overwrite_text",array("[theme_name]"=>$_smarty_tpl->tpl_vars['requested_theme_name']->value));?>
:</p>
        <form method="post" action="<?php echo htmlspecialchars(fn_url("themes.set"), ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="theme_name" value="<?php echo htmlspecialchars($_GET['theme_name'], ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="style" value="<?php echo htmlspecialchars($_GET['style'], ENT_QUOTES, 'UTF-8');?>
">
            <div class="table-wrapper">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th width="1"><?php echo $_smarty_tpl->getSubTemplate ("common/check_items.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
</th>
                            <th></th>
                            <th width="20%"><?php echo $_smarty_tpl->__("current_setting_value");?>
</th>
                            <th width="20%"><?php echo $_smarty_tpl->__("new_setting_value");?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  $_smarty_tpl->tpl_vars["setting_section"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["setting_section"]->_loop = false;
 $_smarty_tpl->tpl_vars["section_name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['conflicts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["setting_section"]->key => $_smarty_tpl->tpl_vars["setting_section"]->value) {
$_smarty_tpl->tpl_vars["setting_section"]->_loop = true;
 $_smarty_tpl->tpl_vars["section_name"]->value = $_smarty_tpl->tpl_vars["setting_section"]->key;
?>
                        <?php  $_smarty_tpl->tpl_vars["setting"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["setting"]->_loop = false;
 $_smarty_tpl->tpl_vars["setting_name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['setting_section']->value['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["setting"]->key => $_smarty_tpl->tpl_vars["setting"]->value) {
$_smarty_tpl->tpl_vars["setting"]->_loop = true;
 $_smarty_tpl->tpl_vars["setting_name"]->value = $_smarty_tpl->tpl_vars["setting"]->key;
?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="settings_values[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['setting']->value['object_id'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['setting']->value['object_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-item" checked="checked">
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['setting_section']->value['name'], ENT_QUOTES, 'UTF-8');?>
</strong>: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['setting']->value['name'], ENT_QUOTES, 'UTF-8');?>

                                </td>
                                <td>
                                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['setting']->value['current_value_readable'], ENT_QUOTES, 'UTF-8');?>

                                </td>
                                <td>
                                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['setting']->value['new_value_readable'], ENT_QUOTES, 'UTF-8');?>

                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="clearfix right">
                <a class="btn" href="<?php echo htmlspecialchars(fn_url("themes.manage"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("cancel");?>
</a>
                <button class="btn btn-primary" type="submit" name="allow_overwrite" value="Y"><?php echo $_smarty_tpl->__("overwrite_selected_settings");?>
</button>
            </div>
        </form>
    </div>
<?php } else { ?>

<div class="themes" id="themes_list">

<h4><?php echo $_smarty_tpl->__("current_theme");?>
</h4>
<div class="row">
    <?php $_smarty_tpl->_capture_stack[0][] = array("add_new_picker", null, null); ob_start(); ?>
        <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="clone_theme_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
_form" class="cm-ajax cm-comet cm-form-dialog-closer form-horizontal form-edit cm-skip-check-items">
            <input type="hidden" name="theme_data[theme_src]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="result_ids" value="themes_list,elm_sidebar">

            <div class="add-new-object-group">
                <div class="tabs cm-j-tabs">
                    <ul class="nav nav-tabs">
                        <li id="tab_clone_theme_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-js active"><a><?php echo $_smarty_tpl->__("general");?>
</a></li>
                    </ul>
                </div>

                <div class="cm-tabs-content" id="content_tab_clone_theme_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label cm-required" for="elm_theme_dir_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("directory");?>
</label>
                            <div class="controls">
                                <input type="text" id="elm_theme_dir_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
" name="theme_data[theme_dest]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
_clone" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="elm_theme_title_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("name");?>
</label>
                            <div class="controls">
                                <input type="text" id="elm_theme_title_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
" name="theme_data[title]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme']->value['title'], ENT_QUOTES, 'UTF-8');?>
" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="elm_theme_desc_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("description");?>
</label>
                            <div class="controls">
                                <textarea name="theme_data[description]" id="elm_theme_desc_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
" cols="50" rows="4" class="span9"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme']->value['description'], ENT_QUOTES, 'UTF-8');?>
</textarea>
                            </div>
                        </div>

                    </fieldset>
                </div>
            </div>

            <div class="buttons-container">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[themes.clone]",'cancel_action'=>"close",'save'=>true), 0);?>

            </div>

        </form>
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if ($_smarty_tpl->tpl_vars['theme']->value['screenshot']) {?>
    <div id="theme_image" class="span4">
        <?php if ($_smarty_tpl->tpl_vars['theme']->value['styles'][$_smarty_tpl->tpl_vars['layout']->value['style_id']]['image']) {?>
            <img class="screenshot" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme']->value['styles'][$_smarty_tpl->tpl_vars['layout']->value['style_id']]['image'], ENT_QUOTES, 'UTF-8');?>
">
        <?php } else { ?>
            <img class="screenshot" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['images_dir']->value, ENT_QUOTES, 'UTF-8');?>
/user_styles.png" alt="">
        <?php }?>

    <!--theme_image--></div>
<?php }?>
<div class="span8 theme-description" id="theme_description_container">
    <h4 class="lead"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme']->value['title'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['layout']->value['style_name']) {?>: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout']->value['style_name'], ENT_QUOTES, 'UTF-8');
}?></h4>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"themes:current_theme_options")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"themes:current_theme_options"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <span class="muted"><?php echo $_smarty_tpl->__("theme_styles_and_layouts");?>
</span>
        <div class="table-wrapper">
            <table class="table table-middle">
                <thead>
                    <tr>
                        <th><?php echo $_smarty_tpl->__("layout");?>
</th>
                        <th><?php echo $_smarty_tpl->__("theme_editor.style");?>
</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $_smarty_tpl->tpl_vars['has_styles'] = new Smarty_variable(!!$_smarty_tpl->tpl_vars['theme']->value['styles'], null, 0);?>
                    <?php  $_smarty_tpl->tpl_vars['available_layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['available_layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['theme']->value['layouts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['available_layout']->key => $_smarty_tpl->tpl_vars['available_layout']->value) {
$_smarty_tpl->tpl_vars['available_layout']->_loop = true;
?>
                        <tr>
                            <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['available_layout']->value['name'], ENT_QUOTES, 'UTF-8');?>
</td>
                            <td>
                                <?php $_smarty_tpl->tpl_vars['styles_descr'] = new Smarty_variable(array(), null, 0);?>
                                <?php  $_smarty_tpl->tpl_vars['style'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['style']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['available_themes']->value['current']['styles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['style']->key => $_smarty_tpl->tpl_vars['style']->value) {
$_smarty_tpl->tpl_vars['style']->_loop = true;
?>
                                    <?php $_smarty_tpl->createLocalArrayVariable('styles_descr', null, 0);
$_smarty_tpl->tpl_vars['styles_descr']->value[$_smarty_tpl->tpl_vars['style']->value['style_id']] = $_smarty_tpl->tpl_vars['style']->value['name'];?>
                                <?php } ?>

                                <?php if ($_smarty_tpl->tpl_vars['has_styles']->value) {?>
                                    <?php echo $_smarty_tpl->getSubTemplate ("common/select_popup.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>$_smarty_tpl->tpl_vars['available_layout']->value['layout_id'],'status'=>$_smarty_tpl->tpl_vars['available_layout']->value['style_id'],'items_status'=>$_smarty_tpl->tpl_vars['styles_descr']->value,'update_controller'=>"themes.styles",'status_target_id'=>"theme_description_container,themes_list",'statuses'=>$_smarty_tpl->tpl_vars['available_themes']->value['current']['styles'],'btn_meta'=>mb_strtolower("btn-text o-status-".((string)$_smarty_tpl->tpl_vars['o']->value['status']), 'UTF-8'),'default_status_text'=>$_smarty_tpl->__("none")), 0);?>

                                <?php } else { ?>
                                    <span class="muted"><?php echo $_smarty_tpl->__("theme_no_styles_text");?>
</span>
                                <?php }?>
                            </td>
                            <td class="right btn-toolbar btn-toolbar--theme-editor">
                                <?php if ($_smarty_tpl->tpl_vars['available_layout']->value['is_default']) {?>
                                    <?php $_smarty_tpl->tpl_vars['but_meta'] = new Smarty_variable("btn-small btn-primary cm-post", null, 0);?>
                                <?php } else { ?>
                                    <?php $_smarty_tpl->tpl_vars['but_meta'] = new Smarty_variable("btn-small cm-post", null, 0);?>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['has_styles']->value) {?>
                                    <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"customization.update_mode?type=theme_editor&status=enable&s_layout=".((string)$_smarty_tpl->tpl_vars['available_layout']->value['layout_id']),'but_text'=>$_smarty_tpl->__("theme_editor"),'but_role'=>"action",'but_meta'=>$_smarty_tpl->tpl_vars['but_meta']->value,'but_target'=>"_blank"), 0);?>

                                <?php } else { ?>
                                    <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("theme_editor_not_supported"),'but_text'=>$_smarty_tpl->__("theme_editor"),'but_role'=>"btn",'but_meta'=>"btn btn-small disabled cm-tooltip"), 0);?>

                                <?php }?>
                                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"customization.update_mode?type=block_manager&status=enable&s_layout=".((string)$_smarty_tpl->tpl_vars['available_layout']->value['layout_id']),'but_text'=>$_smarty_tpl->__("edit_layout_on_site"),'but_role'=>"action",'but_meta'=>$_smarty_tpl->tpl_vars['but_meta']->value,'but_target'=>"_blank"), 0);?>

                                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"customization.update_mode?type=live_editor&status=enable&s_layout=".((string)$_smarty_tpl->tpl_vars['available_layout']->value['layout_id']),'but_text'=>$_smarty_tpl->__("edit_content_on_site"),'but_role'=>"action",'but_meta'=>$_smarty_tpl->tpl_vars['but_meta']->value,'but_target'=>"_blank"), 0);?>

                            </td>
                        <tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"themes:current_theme_options"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<!--theme_description_container--></div>
</div>

<?php $_smarty_tpl->_capture_stack[0][] = array("tabsbox", null, null); ob_start(); ?>
<?php if ($_smarty_tpl->tpl_vars['can_manage_themes']->value) {?>
<div id="content_installed_themes">
    <div id="themes_manage" class="themes-current clearfix">

    <div class="themes-available">
    <?php if ($_smarty_tpl->tpl_vars['available_themes']->value['installed']) {?>
    <?php  $_smarty_tpl->tpl_vars['installed_theme'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['installed_theme']->_loop = false;
 $_smarty_tpl->tpl_vars['theme_id'] = new Smarty_Variable;
 $_from = array_reverse($_smarty_tpl->tpl_vars['available_themes']->value['installed'],true); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['installed_theme']->key => $_smarty_tpl->tpl_vars['installed_theme']->value) {
$_smarty_tpl->tpl_vars['installed_theme']->_loop = true;
 $_smarty_tpl->tpl_vars['theme_id']->value = $_smarty_tpl->tpl_vars['installed_theme']->key;
?>
        <div class="row-fluid">
        <?php if ($_smarty_tpl->tpl_vars['installed_theme']->value) {?>
            <div class="theme-subtitle clearfix">
                <h4 id="anchor_<?php echo htmlspecialchars(smarty_modifier_replace($_smarty_tpl->tpl_vars['installed_theme']->value['title']," ","_"), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['installed_theme']->value['title'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['theme_id']->value==$_smarty_tpl->tpl_vars['theme_name']->value) {?> <span class="label label-success"><?php echo $_smarty_tpl->__("active");?>
</span><?php }?></h4>
                <?php if ($_smarty_tpl->tpl_vars['installed_theme']->value['dependent_themes']) {?>
                    <?php $_smarty_tpl->tpl_vars['can_remove'] = new Smarty_variable(false, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['tooltip'] = new Smarty_variable($_smarty_tpl->__("cannot_remove_theme_has_dependent_themes",array("[dependent_themes]"=>implode(', ',$_smarty_tpl->tpl_vars['installed_theme']->value['dependent_themes']))), null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars['can_remove'] = new Smarty_variable(true, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['tooltip'] = new Smarty_variable($_smarty_tpl->__("remove_theme"), null, 0);?>
                <?php }?>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"themes:remove_theme")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"themes:remove_theme"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <a class="<?php if ($_smarty_tpl->tpl_vars['can_remove']->value) {?>cm-confirm cm-post <?php }?>cm-tooltip btn pull-right btn-small"<?php if (!$_smarty_tpl->tpl_vars['can_remove']->value) {?> disabled="disabled"<?php }?> data-ce-tooltip-position="top"<?php if ($_smarty_tpl->tpl_vars['can_remove']->value) {?> href="<?php echo htmlspecialchars(fn_url("themes.delete?theme_name=".((string)$_smarty_tpl->tpl_vars['theme_id']->value)), ENT_QUOTES, 'UTF-8');?>
"<?php }?> title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tooltip']->value, ENT_QUOTES, 'UTF-8');?>
"> <i class="icon-trash"></i> </a>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"themes:remove_theme"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <span class="label pull-right"><?php echo htmlspecialchars(smarty_modifier_count($_smarty_tpl->tpl_vars['installed_theme']->value['layouts']), ENT_QUOTES, 'UTF-8');?>
 <?php echo $_smarty_tpl->__("layouts");?>
</span>
                <span class="label pull-right"><?php echo htmlspecialchars(smarty_modifier_count($_smarty_tpl->tpl_vars['installed_theme']->value['styles']), ENT_QUOTES, 'UTF-8');?>
 <?php echo $_smarty_tpl->__("theme_editor.styles");?>
</span>
            </div>
            <div class="themes-list">
            <?php if ($_smarty_tpl->tpl_vars['installed_theme']->value['styles']) {?>
                <?php  $_smarty_tpl->tpl_vars['style'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['style']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['installed_theme']->value['styles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['style']->key => $_smarty_tpl->tpl_vars['style']->value) {
$_smarty_tpl->tpl_vars['style']->_loop = true;
?>
                    <div class="span3">
                        <div class="theme <?php if ($_smarty_tpl->tpl_vars['style']->value['style_id']==$_smarty_tpl->tpl_vars['layout']->value['style_id']&&$_smarty_tpl->tpl_vars['layout']->value['theme_name']==$_smarty_tpl->tpl_vars['theme_id']->value) {?>theme-selected<?php }?>">
                            <div class="theme-title">
                               <span title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['installed_theme']->value['title'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['installed_theme']->value['title'], ENT_QUOTES, 'UTF-8');?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['style']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span>
                            </div>
                            <?php if ($_smarty_tpl->tpl_vars['theme_id']->value!=$_smarty_tpl->tpl_vars['runtime']->value['layout']['theme_name']||$_smarty_tpl->tpl_vars['style']->value['style_id']!=$_smarty_tpl->tpl_vars['layout']->value['style_id']) {?>
                                <div class="theme-use">
                                    <?php if ($_smarty_tpl->tpl_vars['theme_id']->value!=$_smarty_tpl->tpl_vars['runtime']->value['layout']['theme_name']) {?>
                                        <?php $_smarty_tpl->tpl_vars['but_text'] = new Smarty_variable($_smarty_tpl->__("activate"), null, 0);?>
                                    <?php } else { ?>
                                        <?php $_smarty_tpl->tpl_vars['but_text'] = new Smarty_variable($_smarty_tpl->__("use_this_style"), null, 0);?>
                                    <?php }?>

                                    <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"themes.set?theme_name=".((string)$_smarty_tpl->tpl_vars['theme_id']->value)."&amp;style=".((string)$_smarty_tpl->tpl_vars['style']->value['style_id']),'but_text'=>$_smarty_tpl->tpl_vars['but_text']->value,'but_role'=>"action",'but_meta'=>"btn-primary cm-post"), 0);?>

                                </div>
                            <?php }?>

                            <?php if ($_smarty_tpl->tpl_vars['style']->value['image']) {?>
                                <a id="image_img_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['style']->value['style_id'], ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['style']->value['image'], ENT_QUOTES, 'UTF-8');?>
" data-ca-image-id="img_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['style']->value['style_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-previewer">
                                    <?php if ($_smarty_tpl->tpl_vars['style']->value['style_id']==$_smarty_tpl->tpl_vars['layout']->value['style_id']&&$_smarty_tpl->tpl_vars['layout']->value['theme_name']==$_smarty_tpl->tpl_vars['theme_id']->value) {?>
                                        <span class="theme-in-use"><?php echo $_smarty_tpl->__("currently_in_use");?>
</span>
                                    <?php }?>
                                    <img class="screenshot" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['style']->value['image'], ENT_QUOTES, 'UTF-8');?>
" alt="">
                                </a>
                            <?php } else { ?>
                                <div>
                                    <?php if ($_smarty_tpl->tpl_vars['style']->value['style_id']==$_smarty_tpl->tpl_vars['layout']->value['style_id']&&$_smarty_tpl->tpl_vars['layout']->value['theme_name']==$_smarty_tpl->tpl_vars['theme_id']->value) {?>
                                        <span class="theme-in-use"><?php echo $_smarty_tpl->__("currently_in_use");?>
</span>
                                    <?php }?>
                                    <img class="screenshot" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['images_dir']->value, ENT_QUOTES, 'UTF-8');?>
/user_styles.png" alt="">
                                </div>
                            <?php }?>
                        </div>
                    </div>
                <?php } ?>

            <?php } else { ?>
                <div class="span3">
                    <div class="theme">
                        <div class="theme-title">
                           <span title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme']->value['title'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['installed_theme']->value['title'], ENT_QUOTES, 'UTF-8');?>
</span>
                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['theme_id']->value!=$_smarty_tpl->tpl_vars['runtime']->value['layout']['theme_name']) {?>
                            <div class="theme-use">
                                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"themes.set?theme_name=".((string)$_smarty_tpl->tpl_vars['theme_id']->value),'but_text'=>$_smarty_tpl->__("activate"),'but_role'=>"action",'but_meta'=>"btn-primary cm-post"), 0);?>

                            </div>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['installed_theme']->value['screenshot']) {?>
                            <a id="image_img_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_id']->value, ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['installed_theme']->value['screenshot'], ENT_QUOTES, 'UTF-8');?>
" data-ca-image-id="img_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-previewer"><img class="screenshot" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['installed_theme']->value['screenshot'], ENT_QUOTES, 'UTF-8');?>
" alt=""></a>
                        <?php }?>
                    </div>
                </div>
            <?php }?>
        </div>
        <?php }?>
        <!--/row--></div>
    <?php } ?>
    <?php } else { ?>
        <div class="no-items">
            <?php echo $_smarty_tpl->__("no_themes_available");?>

        </div>
    <?php }?>
    </div>
</div>
</div>
<div id="content_browse_all_available_themes">

<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"themes:install_themes")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"themes:install_themes"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


    <?php echo smarty_function_split(array('data'=>$_smarty_tpl->tpl_vars['available_themes']->value['repo'],'size'=>3,'assign'=>"splitted_themes",'simple'=>true),$_smarty_tpl);?>

    <div class="themes-available">

    <?php if ($_smarty_tpl->tpl_vars['available_themes']->value['repo']) {?>
    <?php  $_smarty_tpl->tpl_vars["repo_themes"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["repo_themes"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['splitted_themes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["repo_themes"]->key => $_smarty_tpl->tpl_vars["repo_themes"]->value) {
$_smarty_tpl->tpl_vars["repo_themes"]->_loop = true;
?>
    <div class="row-fluid">
        <div class="themes-list">
        <?php  $_smarty_tpl->tpl_vars["repo_theme"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["repo_theme"]->_loop = false;
 $_smarty_tpl->tpl_vars["theme_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['repo_themes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["repo_theme"]->key => $_smarty_tpl->tpl_vars["repo_theme"]->value) {
$_smarty_tpl->tpl_vars["repo_theme"]->_loop = true;
 $_smarty_tpl->tpl_vars["theme_id"]->value = $_smarty_tpl->tpl_vars["repo_theme"]->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['repo_theme']->value) {?>
                <div class="span3">
                    <div class="theme">

                        <div class="theme-title">
                        <span title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme']->value['title'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['repo_theme']->value['title'], ENT_QUOTES, 'UTF-8');?>
</span>
                        </div>

                        <div class="theme-use">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"themes.install?theme_name=".((string)$_smarty_tpl->tpl_vars['theme_id']->value),'but_text'=>$_smarty_tpl->__("install"),'but_role'=>"action",'but_meta'=>"btn-primary cm-comet cm-ajax cm-post",'but_target_id'=>"themes_list"), 0);?>

                        </div>

                        <?php if ($_smarty_tpl->tpl_vars['repo_theme']->value['screenshot']) {?>
                        <a id="image_img_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_id']->value, ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['repo_theme']->value['screenshot'], ENT_QUOTES, 'UTF-8');?>
" data-ca-image-id="img_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-previewer"><img class="screenshot" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['repo_theme']->value['screenshot'], ENT_QUOTES, 'UTF-8');?>
" alt="" width="250"></a>
                        <?php }?>

                        <div class="theme-actions">
                            <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>

                                <?php if ($_smarty_tpl->tpl_vars['repo_theme']->value['screenshot']) {?>
                                <li><a id="image_img_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_id']->value, ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['repo_theme']->value['screenshot'], ENT_QUOTES, 'UTF-8');?>
" data-ca-image-id="img_button_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-previewer"><?php echo $_smarty_tpl->__("preview");?>
</a></li>
                                <?php }?>

                                
                                <li><a class="cm-comet cm-ajax cm-post" data-ca-target-id="themes_list" href="<?php echo htmlspecialchars(fn_url("themes.install?theme_name=".((string)$_smarty_tpl->tpl_vars['theme_id']->value)), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="themes_list"><?php echo $_smarty_tpl->__("install");?>
</a></li>
                            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                            <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list'],'placement'=>"right"));?>

                        </div>
                    </div>
                </div>
            <?php }?>
        <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php } else { ?>
        <div class="no-items">
            <?php echo $_smarty_tpl->__("no_themes_available");?>

        </div>
    <?php }?>
    </div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"themes:install_themes"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


    <?php $_smarty_tpl->tpl_vars['theme_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['available_themes']->value['current']['theme_name'], null, 0);?>
    <div class="hidden" id="content_elm_clone_theme_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_name']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->__("clone_theme");?>
">
        <?php echo Smarty::$_smarty_vars['capture']['add_new_picker'];?>

    </div>

</div>
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php echo $_smarty_tpl->getSubTemplate ("common/tabsbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('content'=>Smarty::$_smarty_vars['capture']['tabsbox'],'active_tab'=>$_REQUEST['selected_section']), 0);?>

<!--themes_list--></div>
<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("sidebar", null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['can_manage_themes']->value) {?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"themes:manage_sidebar")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"themes:manage_sidebar"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="container themes-side">

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"themes:settings")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"themes:settings"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <div class="sidebar-row">
            <ul class="unstyled list-with-btns">
                <li>
                    <div class="list-description">
                        <?php echo $_smarty_tpl->__("rebuild_cache_automatically");?>
 <i class="cm-tooltip icon-question-sign" title="<?php echo $_smarty_tpl->__("rebuild_cache_automatically_tooltip");?>
"></i>
                    </div>
                    <div class="switch switch-mini cm-switch-change list-btns" id="rebuild_cache_automatically">
                        <input type="checkbox" name="compile_check" value="1" <?php if ($_smarty_tpl->tpl_vars['dev_modes']->value['compile_check']) {?>checked="checked"<?php }?>/>
                    </div>
                </li>
            </ul>
        </div>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">

            (function (_, $) {
                $(_.doc).on('switch-change', '.cm-switch-change', function (e, data) {
                    var value = data.value;
                    $.ceAjax('request', fn_url("themes.update_dev_mode"), {
                        method: 'post',
                        data: {
                            dev_mode: data.el.prop('name'),
                            state: value ? 1 : 0
                        }
                    });
                });

                $.ceEvent('on', 'ce.ajaxdone', function(){
                    if ($('.switch .switch-mini').length == 0) {
                        $('.switch')['bootstrapSwitch']();
                    }
                });
            }(Tygh, Tygh.$));
        <?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <hr>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"themes:settings"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"themes:options")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"themes:options"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <div class="form-horizontal sidebar-row clearfix">
            <h6><?php echo $_smarty_tpl->__("theme_information");?>
</h6>
            <div class="control-group">
                <div class="control-label muted"><?php echo $_smarty_tpl->__("name");?>
</div>
                <div class="controls right"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme']->value['title'], ENT_QUOTES, 'UTF-8');?>
</div>
            </div>
            <div class="control-group">
                <div class="control-label muted" title="/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value['theme_name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("directory");?>
</div>
                <div class="controls right"><a class="pull-right" href="<?php echo htmlspecialchars(fn_url("templates.manage?selected_path=".((string)$_smarty_tpl->tpl_vars['settings']->value['theme_name'])), ENT_QUOTES, 'UTF-8');?>
">/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value['theme_name'], ENT_QUOTES, 'UTF-8');?>
</a></div>
            </div>
            <div class="control-group">
                <div class="control-label muted"><?php echo $_smarty_tpl->__("layouts");?>
</div>
                <div class="controls right"><a href="<?php echo htmlspecialchars(fn_url("block_manager.manage"), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(smarty_modifier_count($_smarty_tpl->tpl_vars['theme']->value['layouts']), ENT_QUOTES, 'UTF-8');?>
</a></div>
            </div>
            <div class="control-group">
                <div class="control-label muted"><?php echo $_smarty_tpl->__("theme_editor.styles");?>
</div>
                <div class="controls right"><a href="#anchor_<?php echo htmlspecialchars(smarty_modifier_replace($_smarty_tpl->tpl_vars['theme']->value['title']," ","_"), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(smarty_modifier_count($_smarty_tpl->tpl_vars['theme']->value['styles']), ENT_QUOTES, 'UTF-8');?>
</a> </div>
            </div>
            <div class="control-group">
                <div class="control-label muted" ><?php echo $_smarty_tpl->__("developer");?>
</div>
                <div class="controls right"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme']->value['developer'], ENT_QUOTES, 'UTF-8');?>
</div>
            </div>
        </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"themes:options"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


        <hr>
        <div class="sidebar-row marketplace">
            <h6><?php echo $_smarty_tpl->__("marketplace");?>
</h6>
            <p class="marketplace-link"><?php echo $_smarty_tpl->__("marketplace_find_more",array("[href]"=>$_smarty_tpl->tpl_vars['config']->value['resources']['marketplace_url']));?>
</p>
        </div>
    </div>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"themes:manage_sidebar"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("adv_buttons", null, null); ob_start(); ?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"themes:adv_buttons")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"themes:adv_buttons"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if ((fn_allowed_for("ULTIMATE")&&$_smarty_tpl->tpl_vars['runtime']->value['company_id'])||(fn_allowed_for("MULTIVENDOR")&&!$_smarty_tpl->tpl_vars['runtime']->value['company_id'])) {?>
        <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"upload_theme",'text'=>$_smarty_tpl->__("upload_theme"),'title'=>$_smarty_tpl->__("upload_theme"),'content'=>Smarty::$_smarty_vars['capture']['upload_theme'],'act'=>"general",'link_class'=>"cm-dialog-auto-size",'icon'=>"icon-plus",'link_text'=>''), 0);?>

    <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"themes:adv_buttons"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['can_manage_themes']->value) {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"themes:tools_list")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"themes:tools_list"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"dialog",'text'=>$_smarty_tpl->__("clone_theme"),'target_id'=>"content_elm_clone_theme_".((string)$_smarty_tpl->tpl_vars['theme_name']->value)));?>
</li>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"themes:tools_list"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

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

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php ob_start();?><?php echo $_smarty_tpl->__("themes");?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_tmp1,'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'sidebar'=>Smarty::$_smarty_vars['capture']['sidebar'],'adv_buttons'=>Smarty::$_smarty_vars['capture']['adv_buttons'],'buttons'=>Smarty::$_smarty_vars['capture']['buttons']), 0);?>

<?php }} ?>
