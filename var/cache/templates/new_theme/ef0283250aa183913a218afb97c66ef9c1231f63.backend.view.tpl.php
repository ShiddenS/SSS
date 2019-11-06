<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:11:17
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\theme_editor\view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18504835195db2ca45288026-47313944%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef0283250aa183913a218afb97c66ef9c1231f63' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\theme_editor\\view.tpl',
      1 => 1568373054,
      2 => 'backend',
    ),
  ),
  'nocache_hash' => '18504835195db2ca45288026-47313944',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'current_style' => 0,
    'theme_manifest' => 0,
    'selected_css_file' => 0,
    'selected_section' => 0,
    'is_theme_editor_allowed' => 0,
    'props_schema' => 0,
    'layouts' => 0,
    'layout_data' => 0,
    'layout' => 0,
    'theme_url' => 0,
    'current_style_name' => 0,
    'styles_list' => 0,
    's_item' => 0,
    'te_sections' => 0,
    'section' => 0,
    's' => 0,
    'css_files_list' => 0,
    'css_file' => 0,
    'cse_logos' => 0,
    'id' => 0,
    'image' => 0,
    'field' => 0,
    'name' => 0,
    'cse_logo_types' => 0,
    'type' => 0,
    'a' => 0,
    'cp_value' => 0,
    'family' => 0,
    'family_name' => 0,
    'size_name' => 0,
    'current_value' => 0,
    'font_size' => 0,
    'prop' => 0,
    'prop_name' => 0,
    'key' => 0,
    'field_name' => 0,
    'color' => 0,
    'field_gradient' => 0,
    'gradient_color' => 0,
    'theme_patterns' => 0,
    'pattern' => 0,
    'repeat_title' => 0,
    'scroll_title' => 0,
    'css_content' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2ca45ee7990_30851833',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2ca45ee7990_30851833')) {function content_5db2ca45ee7990_30851833($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_to_json')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.to_json.php';
if (!is_callable('smarty_modifier_count')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.count.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_modifier_replace')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.replace.php';
if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('theme_editor.style_name','theme_editor.incorrect_style_name','theme_editor.text_close_editor','theme_editor.text_close_editor_unsaved','theme_editor.text_reset_changes','theme_editor.error_style_exists','theme_editor.confirm_enable_less','theme_editor.hide_show','theme_editor.close','theme_editor.page_cant_be_configured','layout','layout','theme_editor','theme_editor.styles','none','clone','delete','save','theme_editor.customize','save','files','none','save','theme_editor.favicon','theme_editor.favicon_size','theme_editor.on','theme_editor.off','theme_editor.reset_general','theme_editor.reset_css','theme_editor.','theme_editor.','alt_text','image','theme_editor.reset_colors','theme_editor.system_fonts','theme_editor.popular_fonts','theme_editor.other_fonts','theme_editor.reset_fonts','theme_editor.background_color','theme_editor.gradient','theme_editor.on','theme_editor.off','theme_editor.full_width','theme_editor.on','theme_editor.off','theme_editor.full_width','theme_editor.on','theme_editor.off','theme_editor.transparent','theme_editor.pattern','theme_editor.upload_image','theme_editor.position','theme_editor.repeat','theme_editor.repeat','theme_editor.repeat_x','theme_editor.repeat_x','theme_editor.repeat_y','theme_editor.repeat_y','theme_editor.no_repeat','theme_editor.no_repeat','theme_editor.repeat','theme_editor.scroll','theme_editor.scroll','theme_editor.fixed','theme_editor.fixed','theme_editor.scroll','theme_editor.reset_backgrounds','theme_editor.enable_less','theme_editor.warning_css_changes_will_be_reverted','theme_editor.style_name','theme_editor.incorrect_style_name','theme_editor.text_close_editor','theme_editor.text_close_editor_unsaved','theme_editor.text_reset_changes','theme_editor.error_style_exists','theme_editor.confirm_enable_less','theme_editor.hide_show','theme_editor.close','theme_editor.page_cant_be_configured','layout','layout','theme_editor','theme_editor.styles','none','clone','delete','save','theme_editor.customize','save','files','none','save','theme_editor.favicon','theme_editor.favicon_size','theme_editor.on','theme_editor.off','theme_editor.reset_general','theme_editor.reset_css','theme_editor.','theme_editor.','alt_text','image','theme_editor.reset_colors','theme_editor.system_fonts','theme_editor.popular_fonts','theme_editor.other_fonts','theme_editor.reset_fonts','theme_editor.background_color','theme_editor.gradient','theme_editor.on','theme_editor.off','theme_editor.full_width','theme_editor.on','theme_editor.off','theme_editor.full_width','theme_editor.on','theme_editor.off','theme_editor.transparent','theme_editor.pattern','theme_editor.upload_image','theme_editor.position','theme_editor.repeat','theme_editor.repeat','theme_editor.repeat_x','theme_editor.repeat_x','theme_editor.repeat_y','theme_editor.repeat_y','theme_editor.no_repeat','theme_editor.no_repeat','theme_editor.repeat','theme_editor.scroll','theme_editor.scroll','theme_editor.fixed','theme_editor.fixed','theme_editor.scroll','theme_editor.reset_backgrounds','theme_editor.enable_less','theme_editor.warning_css_changes_will_be_reverted'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><div id="theme_editor">

<?php echo '<script'; ?>
 type="text/javascript">
Tygh.tr({
    'theme_editor.style_name': '<?php echo strtr($_smarty_tpl->__("theme_editor.style_name"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.incorrect_style_name': '<?php echo strtr($_smarty_tpl->__("theme_editor.incorrect_style_name"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.text_close_editor': '<?php echo strtr($_smarty_tpl->__("theme_editor.text_close_editor"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.text_close_editor_unsaved': '<?php echo strtr($_smarty_tpl->__("theme_editor.text_close_editor_unsaved"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.text_reset_changes': '<?php echo strtr($_smarty_tpl->__("theme_editor.text_reset_changes"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.error_style_exists': '<?php echo strtr($_smarty_tpl->__("theme_editor.error_style_exists"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.confirm_enable_less': '<?php echo strtr($_smarty_tpl->__("theme_editor.confirm_enable_less"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
});
Tygh.te_custom_fonts = <?php echo smarty_modifier_to_json($_smarty_tpl->tpl_vars['current_style']->value['custom_fonts']);?>
;
<?php echo '</script'; ?>
>

<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" class="cm-ajax" name="theme_editor_form" enctype="multipart/form-data">
<?php if ($_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css']) {?>
    <input type="hidden" name="selected_css_file" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_css_file']->value, ENT_QUOTES, 'UTF-8');?>
" />
<?php } else { ?>
    <input type="hidden" name="style_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['style_id'], ENT_QUOTES, 'UTF-8');?>
" data-ca-is-default="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['is_default'], ENT_QUOTES, 'UTF-8');?>
">
    <input type="hidden" name="style[name]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
<?php }?>
<input type="hidden" name="selected_section" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_section']->value, ENT_QUOTES, 'UTF-8');?>
">
<input type="hidden" name="result_ids" value="theme_editor">

<span class="te-nav"><a id="sw_theme_editor_container" class="te-minimize cm-combination" title="<?php echo $_smarty_tpl->__("theme_editor.hide_show");?>
">
        <i class="glyph-left-open icon-left-open"></i><i class="glyph-right-open icon-right-open hidden"></i>
    </a>
<a href="<?php echo htmlspecialchars(fn_url("customization.disable_mode?type=theme_editor"), ENT_QUOTES, 'UTF-8');?>
" class="te-close cm-te-close-editor" title="<?php echo $_smarty_tpl->__("theme_editor.close");?>
"><i class="glyph-cancel icon-cancel"></i></a>
        </span>
</span>

<div class="theme-editor <?php if ($_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css']) {?> te-converted-to-css<?php }?>" data-ca-te-use-dynamic-style="<?php if ($_smarty_tpl->tpl_vars['runtime']->value['vendor_id']) {?>true<?php } else { ?>false<?php }?>" id="theme_editor_container" data-bp-sidebar="true">
    <div class="te-overlay<?php if ((($tmp = @$_smarty_tpl->tpl_vars['is_theme_editor_allowed']->value)===null||$tmp==='' ? true : $tmp)) {?> hidden<?php }?>">
        <div class="te-notification-wrapper">
            <p class="notification-content alert-warning"><?php echo $_smarty_tpl->__("theme_editor.page_cant_be_configured");?>
</p>
        </div>
    </div>
    <div class="te-header<?php if (!$_smarty_tpl->tpl_vars['props_schema']->value) {?> te-header-no-schema<?php }?>" id="te_styles_list">
        <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['layouts']->value)==1) {?>
            <a class="te-layout-name"><span class="te-layout-label"><?php echo $_smarty_tpl->__("layout");?>
: </span><span class="te-layout-title te-layout-nolink"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout_data']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span></a>
        <?php } else { ?>
            <a id="sw_te-layouts" class="te-layout-name cm-combination"><span class="te-layout-label"><?php echo $_smarty_tpl->__("layout");?>
: </span><span class="te-layout-title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout_data']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span></a>
            <ul id="te-layouts" class="te-layout-dropdown cm-popup-box">
                <?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value) {
$_smarty_tpl->tpl_vars['layout']->_loop = true;
?>
                    <li><a class="cm-te-change-layout" data-ca-layout-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout']->value['layout_id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['layout_id']!=$_smarty_tpl->tpl_vars['layout']->value['layout_id']) {?>href="<?php echo htmlspecialchars(fn_link_attach($_smarty_tpl->tpl_vars['theme_url']->value,"s_layout=".((string)$_smarty_tpl->tpl_vars['layout']->value['layout_id'])), ENT_QUOTES, 'UTF-8');?>
"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a></li>
                <?php } ?>
            </ul>
        <?php }?>
        <span class="te-title">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"theme_editor:title")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"theme_editor:title"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php echo $_smarty_tpl->__("theme_editor");?>

            <?php if (!$_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css']&&!$_smarty_tpl->tpl_vars['runtime']->value['vendor_id']) {?>
                <a class="te-action-link cm-te-convert-to-css cm-confirm">
                    <span class="te-action-link-title"><?php echo $_smarty_tpl->__('theme_editor.convert_to_css');?>
&nbsp;<i class="ty-icon-help-circle cm-tooltip" title="<?php echo $_smarty_tpl->__('theme_editor.text_convert_to_css');?>
"></i></span>
                </a>
            <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"theme_editor:title"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </span>

        <?php if (!$_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css']) {?>

            <?php if ($_smarty_tpl->tpl_vars['props_schema']->value) {?>
            <span class="te-subtitle"><?php echo $_smarty_tpl->__("theme_editor.styles");?>
</span>
            <div class="te-header-menu-wrap">
                <div class="te-header-menu-wrap-left">
                    <?php $_smarty_tpl->tpl_vars['current_style_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['current_style']->value['name'], null, 0);?>

                    <div class="te-select-box cm-te-selectbox te-theme" tabindex="0"><span class="cm-style-title"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['current_style_name']->value)===null||$tmp==='' ? $_smarty_tpl->__("none") : $tmp), ENT_QUOTES, 'UTF-8');?>
</span><i class="ty-icon-d-arrow"></i>
                    <ul class="te-select-dropdown" id="elm_te_styles">
                        <?php  $_smarty_tpl->tpl_vars["s_item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["s_item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['styles_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["s_item"]->key => $_smarty_tpl->tpl_vars["s_item"]->value) {
$_smarty_tpl->tpl_vars["s_item"]->_loop = true;
?>
                            <li class="<?php if ($_smarty_tpl->tpl_vars['runtime']->value['layout']['style_id']===$_smarty_tpl->tpl_vars['s_item']->value['style_id']) {?>active<?php }?>">
                                <a class="cm-te-load-style te-list-item <?php if ($_smarty_tpl->tpl_vars['runtime']->value['layout']['style_id']===$_smarty_tpl->tpl_vars['s_item']->value['style_id']) {?>active<?php }?>" data-ca-target-id="theme_editor" href="<?php echo htmlspecialchars(fn_url("theme_editor.view?style_id=".((string)$_smarty_tpl->tpl_vars['s_item']->value['style_id'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-style-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['s_item']->value['style_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['s_item']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a>

                                <a class="ty-icon-wrap-duplicate cm-te-duplicate-style" data-ca-style-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['s_item']->value['style_id'], ENT_QUOTES, 'UTF-8');?>
"><i class="ty-icon-docs" title="<?php echo $_smarty_tpl->__("clone");?>
"></i></a>

                                <?php if ((($tmp = @$_smarty_tpl->tpl_vars['s_item']->value['is_removable'])===null||$tmp==='' ? true : $tmp)) {?>
                                    <a class="ty-icon-wrap-remove cm-ajax cm-confirm" data-ca-target-id="te_styles_list" href="<?php echo htmlspecialchars(fn_url("theme_editor.delete_style?style_id=".((string)$_smarty_tpl->tpl_vars['s_item']->value['style_id'])), ENT_QUOTES, 'UTF-8');?>
"><i class="ty-icon-trashcan" title="<?php echo $_smarty_tpl->__("delete");?>
"></i></a>
                                <?php }?>
                            </li>
                        <?php }
if (!$_smarty_tpl->tpl_vars["s_item"]->_loop) {
?>
                            <li class="active">
                                <a class="cm-te-load-style te-list-item active">--</a>
                            </li>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
                <div class="te-header-menu-wrap-right">
                    <button class="te-btn-action ty-float-right" type="submit" name="dispatch[theme_editor.save]"><?php echo $_smarty_tpl->__("save");?>
</button>
                </div>
            </div>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['te_sections']->value) {?>
                <span class="te-subtitle"><?php echo $_smarty_tpl->__("theme_editor.customize");?>
</span>
                <div class="te-select-box cm-te-selectbox te-customize" tabindex="0">
                    <span><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['te_sections']->value[$_smarty_tpl->tpl_vars['selected_section']->value]);?>
</span><i class="ty-icon-d-arrow"></i>
                    <ul class="te-select-dropdown cm-te-sections">
                        <?php  $_smarty_tpl->tpl_vars["s"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["s"]->_loop = false;
 $_smarty_tpl->tpl_vars["section"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['te_sections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["s"]->key => $_smarty_tpl->tpl_vars["s"]->value) {
$_smarty_tpl->tpl_vars["s"]->_loop = true;
 $_smarty_tpl->tpl_vars["section"]->value = $_smarty_tpl->tpl_vars["s"]->key;
?>
                        <li <?php if ($_smarty_tpl->tpl_vars['selected_section']->value==$_smarty_tpl->tpl_vars['section']->value) {?>class="active"<?php }?> data-ca-target-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['section']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['s']->value);?>
</li>
                        <?php } ?>
                    </ul>
                </div>
            <?php }?>
            <?php if (!$_smarty_tpl->tpl_vars['props_schema']->value) {?>
                <div class="te-no-schema">
                    <button class="te-btn-action ty-float-right" type="submit" name="dispatch[theme_editor.save]"><?php echo $_smarty_tpl->__("save");?>
</button>
                </div>
            <?php }?>
        <?php } else { ?>
            <span class="te-subtitle"><?php echo $_smarty_tpl->__("files");?>
</span>
            <div class="te-header-menu-wrap">
                <div class="te-header-menu-wrap-left">
                    <div class="te-select-box cm-te-selectbox te-theme" tabindex="0"><span class="cm-style-title"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['selected_css_file']->value)===null||$tmp==='' ? $_smarty_tpl->__("none") : $tmp), ENT_QUOTES, 'UTF-8');?>
</span><i class="ty-icon-d-arrow"></i>
                        <ul class="te-select-dropdown">
                            <?php  $_smarty_tpl->tpl_vars["css_file"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["css_file"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['css_files_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["css_file"]->key => $_smarty_tpl->tpl_vars["css_file"]->value) {
$_smarty_tpl->tpl_vars["css_file"]->_loop = true;
?>
                                <li class="<?php if ($_smarty_tpl->tpl_vars['css_file']->value==$_smarty_tpl->tpl_vars['selected_css_file']->value) {?>active<?php }?>">
                                    <a class="te-list-item <?php if ($_smarty_tpl->tpl_vars['css_file']->value==$_smarty_tpl->tpl_vars['selected_css_file']->value) {?>active<?php }?> cm-te-change-css-file" data-ca-target-id="theme_editor" href="<?php echo htmlspecialchars(fn_url("theme_editor.view?selected_css_file=".((string)$_smarty_tpl->tpl_vars['css_file']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['css_file']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                                </li>
                            <?php }
if (!$_smarty_tpl->tpl_vars["css_file"]->_loop) {
?>
                                <li class="active">
                                    <a class="te-list-item active">--</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="te-header-menu-wrap-right">
                    <button class="te-btn-action float-right" type="submit" name="dispatch[theme_editor.save]"><?php echo $_smarty_tpl->__("save");?>
</button>
                </div>
            </div>


        <?php }?>
    <!--te_styles_list--></div>
<div class="te-content<?php if (!$_smarty_tpl->tpl_vars['props_schema']->value) {?> te-content-no-schema<?php }?>">
<div class="te-section cm-te-disable-scroll">
<?php if (!$_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css']) {?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_general']) {?>
    <div class="te-wrap te-general cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_general") {?>hidden<?php }?>" id="te_general">
        <div class="te-inner-wrap">
            <div class="te-general-group">

                <?php if ($_smarty_tpl->tpl_vars['cse_logos']->value&&$_smarty_tpl->tpl_vars['cse_logos']->value['favicon']) {?>
                    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->tpl_vars['cse_logos']->value['favicon']['logo_id'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable($_smarty_tpl->tpl_vars['cse_logos']->value['favicon']['image'], null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable(array(), null, 0);?>
                <?php }?>

                <input type="text" class="hidden" name="logotypes_image_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][type]" value="M">
                <input type="text" class="hidden" name="logotypes_image_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][object_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">

                <div class="te-image te-favicon-wrap clearfix">
                    <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.favicon");?>
&nbsp;<i class="ty-icon-help-circle cm-tooltip" title="<?php echo $_smarty_tpl->__("theme_editor.favicon_size");?>
"></i></span><?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"logotypes_image_icon[".((string)$_smarty_tpl->tpl_vars['id']->value)."]",'disabled'=>$_smarty_tpl->tpl_vars['current_style']->value['is_default']), 0);?>

                    <div class="te-favicon cm-te-logo" data-ca-image-area="favicon" style="background-image: url('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['image_path'], ENT_QUOTES, 'UTF-8');?>
'); background-repeat: no-repeat; background-position: center center;"></div>
                </div>

            </div>

            <?php  $_smarty_tpl->tpl_vars["field"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["field"]->_loop = false;
 $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['props_schema']->value['general']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["field"]->key => $_smarty_tpl->tpl_vars["field"]->value) {
$_smarty_tpl->tpl_vars["field"]->_loop = true;
 $_smarty_tpl->tpl_vars["name"]->value = $_smarty_tpl->tpl_vars["field"]->key;
?>

                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="checkbox") {?>
                    <div class="te-general-group">
                        <div class="te-checkbox clearfix">
                            <label for="elm_toggle_general_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                <input type="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="false" class="cm-te-value-changer" />
                                <input type="checkbox" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
]" class="cm-te-value-changer" id="elm_toggle_general_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="true" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value]=="true") {?>checked="checked"<?php }?>><span class="te-toggle"><span class="te-toggle-on"><?php echo $_smarty_tpl->__("theme_editor.on");?>
</span><span class="te-toggle-off"><?php echo $_smarty_tpl->__("theme_editor.off");?>
</span><span class="te-toggle-trigger"></span></span><span class="te-bg-title"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['field']->value['description']);?>
</span></label>
                        </div>
                    </div>
                <?php }?>

            <?php } ?>
        </div>

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset"><?php echo $_smarty_tpl->__("theme_editor.reset_general");?>
</button></div>
    <!--te_general--></div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_css']) {?>
    <div class="te-wrap te-css cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_css") {?>hidden<?php }?>" id="te_css">
        <div class="te-inner-wrap">
            <textarea name="style[custom_css]" cols="30" rows="10"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['custom_css'], ENT_QUOTES, 'UTF-8');?>
</textarea>
        </div>

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset"><?php echo $_smarty_tpl->__("theme_editor.reset_css");?>
</button></div>

    <!--te_css--></div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_logos']) {?>
    <div class="te-wrap te-logos cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_logos") {?>hidden<?php }?>" id="te_logos">

        <div class="te-tabs cm-te-tabs">
            <ul class="te-pills">
                <?php  $_smarty_tpl->tpl_vars["logo"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["logo"]->_loop = false;
 $_smarty_tpl->tpl_vars["type"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cse_logo_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["logo"]->key => $_smarty_tpl->tpl_vars["logo"]->value) {
$_smarty_tpl->tpl_vars["logo"]->_loop = true;
 $_smarty_tpl->tpl_vars["type"]->value = $_smarty_tpl->tpl_vars["logo"]->key;
?>
                <?php if ($_smarty_tpl->tpl_vars['type']->value=="favicon") {?>
                    <?php continue 1;?>
                <?php }?>
                <li <?php if ($_smarty_tpl->tpl_vars['type']->value=="theme") {?>class="active"<?php }?>><a data-ca-target-id="elm_logo_section_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->__("theme_editor.".((string)$_smarty_tpl->tpl_vars['type']->value));?>
"><span><?php echo $_smarty_tpl->__("theme_editor.".((string)$_smarty_tpl->tpl_vars['type']->value));?>
</span></a></li>
                <?php } ?>
            </ul>

            <?php  $_smarty_tpl->tpl_vars["logo"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["logo"]->_loop = false;
 $_smarty_tpl->tpl_vars["type"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cse_logo_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["logo"]->key => $_smarty_tpl->tpl_vars["logo"]->value) {
$_smarty_tpl->tpl_vars["logo"]->_loop = true;
 $_smarty_tpl->tpl_vars["type"]->value = $_smarty_tpl->tpl_vars["logo"]->key;
?>
                <?php if ($_smarty_tpl->tpl_vars['type']->value=="favicon") {?>
                    <?php continue 1;?>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['cse_logos']->value&&$_smarty_tpl->tpl_vars['cse_logos']->value[$_smarty_tpl->tpl_vars['type']->value]) {?>
                    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->tpl_vars['cse_logos']->value[$_smarty_tpl->tpl_vars['type']->value]['logo_id'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable($_smarty_tpl->tpl_vars['cse_logos']->value[$_smarty_tpl->tpl_vars['type']->value]['image'], null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable(array(), null, 0);?>
                <?php }?>

                <div class="cm-te-tab-contents" <?php if ($_smarty_tpl->tpl_vars['type']->value!="theme") {?>style="display:none;"<?php }?> id="elm_logo_section_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <input type="text" class="hidden" name="logotypes_image_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][type]" value="M">
                    <input type="text" class="hidden" name="logotypes_image_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][object_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <div class="attach-images">
                        <div class="upload-box clearfix">
                            <div class="image-wrap pull-left">
                                <div class="te-image">
                                    <div class="te-bg-image cm-te-logo" data-ca-image-area="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value, ENT_QUOTES, 'UTF-8');?>
" style="background-image: url('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['image_path'], ENT_QUOTES, 'UTF-8');?>
'); background-repeat: no-repeat; background-position: center center;"></div>
                                </div>
                                <div class="logo-alt"><input type="text" class="cm-image-field" id="alt_text_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['a']->value, ENT_QUOTES, 'UTF-8');?>
" name="logotypes_image_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][image_alt]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['alt'], ENT_QUOTES, 'UTF-8');?>
" placeholder="<?php echo $_smarty_tpl->__("alt_text");?>
"></div>
                            </div>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"theme_editor:logo_uploader")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"theme_editor:logo_uploader"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <div class="te-logos-upload clearfix">
                                <span class="te-bg-title"><?php echo $_smarty_tpl->__("image");?>
&nbsp;</span>
                                <?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"logotypes_image_icon[".((string)$_smarty_tpl->tpl_vars['id']->value)."]",'disabled'=>$_smarty_tpl->tpl_vars['current_style']->value['is_default']), 0);?>

                            </div>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"theme_editor:logo_uploader"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        
    <!--te_logos--></div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_colors']) {?>
    <div class="te-wrap te-colors cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_colors") {?>hidden<?php }?>" id="te_colors">

        <?php  $_smarty_tpl->tpl_vars["field"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["field"]->_loop = false;
 $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['props_schema']->value['colors']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["field"]->key => $_smarty_tpl->tpl_vars["field"]->value) {
$_smarty_tpl->tpl_vars["field"]->_loop = true;
 $_smarty_tpl->tpl_vars["name"]->value = $_smarty_tpl->tpl_vars["field"]->key;
?>
        <div class="te-colors clearfix">
            <label for="elm_te_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['field']->value['description']);?>
</label>

            <?php $_smarty_tpl->tpl_vars['cp_value'] = new Smarty_variable((($tmp = @($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value]))===null||$tmp==='' ? "#ffffff" : $tmp), null, 0);?>

            <?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/colorpicker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cp_name'=>"style[data][".((string)$_smarty_tpl->tpl_vars['name']->value)."]",'cp_id'=>"storage_elm_te_".((string)$_smarty_tpl->tpl_vars['name']->value),'cp_value'=>$_smarty_tpl->tpl_vars['cp_value']->value,'cp_class'=>"cm-te-value-changer",'cp_storage'=>"theme_editor"), 0);?>

        </div>
        <?php } ?>

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset"><?php echo $_smarty_tpl->__("theme_editor.reset_colors");?>
</button></div>

    <!--te_colors--></div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_fonts']) {?>
    <div class="te-wrap te-fonts cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_fonts") {?>hidden<?php }?>" id="te_fonts">
        <div class="te-inner-wrap">
            <?php  $_smarty_tpl->tpl_vars["field"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["field"]->_loop = false;
 $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['props_schema']->value['fonts']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["field"]->key => $_smarty_tpl->tpl_vars["field"]->value) {
$_smarty_tpl->tpl_vars["field"]->_loop = true;
 $_smarty_tpl->tpl_vars["name"]->value = $_smarty_tpl->tpl_vars["field"]->key;
?>
            <div class="ty-control-group control-group te-font-group">
                <label for="elm_te_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['field']->value['description']);?>
</label>
                <div class="te-select-box cm-te-selectbox cm-te-google cm-te-value-changer" tabindex="0" data-ca-select-box-default="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value], ENT_QUOTES, 'UTF-8');?>
"><span></span><i class="ty-icon-d-arrow"></i>
                    <input type="text" class="hidden cm-te-selectbox-storage" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value]) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value], ENT_QUOTES, 'UTF-8');
} else { ?>Arial,Helvetica,sans-serif<?php }?>">

                    <ul class="te-select-dropdown">
                        <li class="te-selectbox-group cm-te-selectbox-group"><?php echo $_smarty_tpl->__("theme_editor.system_fonts");?>
</li>

                        <?php  $_smarty_tpl->tpl_vars["family_name"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["family_name"]->_loop = false;
 $_smarty_tpl->tpl_vars["family"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['props_schema']->value['fonts']['families']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["family_name"]->key => $_smarty_tpl->tpl_vars["family_name"]->value) {
$_smarty_tpl->tpl_vars["family_name"]->_loop = true;
 $_smarty_tpl->tpl_vars["family"]->value = $_smarty_tpl->tpl_vars["family_name"]->key;
?>
                        <li data-ca-select-box-value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['family']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value]==$_smarty_tpl->tpl_vars['family']->value) {?>class="active"<?php }?> style="font-family: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['family']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['family_name']->value, ENT_QUOTES, 'UTF-8');?>
</li>
                        <?php } ?>

                        <li class="te-selectbox-group cm-te-selectbox-group cm-te-google-popular"><?php echo $_smarty_tpl->__("theme_editor.popular_fonts");?>
</li>
                        <li class="te-selectbox-group cm-te-selectbox-group cm-te-google-other"><?php echo $_smarty_tpl->__("theme_editor.other_fonts");?>
</li>
                        <li class="hidden te-selectbox-group cm-te-selectbox-group cm-te-google-custom"></li>
                    </ul>
                </div>

                <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['size']) {?>
                    <?php $_smarty_tpl->tpl_vars['size_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['field']->value['properties']['size']['match'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['current_value'] = new Smarty_variable(smarty_modifier_replace($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['size_name']->value],$_smarty_tpl->tpl_vars['field']->value['properties']['size']['unit'],''), null, 0);?>

                    <div class="te-select-box te-font-size cm-te-selectbox cm-te-value-changer" tabindex="0"><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_value']->value, ENT_QUOTES, 'UTF-8');?>
</span><i class="ty-icon-d-arrow"></i>
                        <input type="text" class="hidden cm-te-selectbox-storage" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['size_name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['size_name']->value], ENT_QUOTES, 'UTF-8');?>
">
                        <ul class="te-select-dropdown">
                            <?php  $_smarty_tpl->tpl_vars["font_size"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["font_size"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['field']->value['properties']['size']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["font_size"]->key => $_smarty_tpl->tpl_vars["font_size"]->value) {
$_smarty_tpl->tpl_vars["font_size"]->_loop = true;
?>
                            <li data-ca-select-box-value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['font_size']->value, ENT_QUOTES, 'UTF-8');?>
px" <?php if ($_smarty_tpl->tpl_vars['current_value']->value==$_smarty_tpl->tpl_vars['font_size']->value) {?>class="active"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['font_size']->value, ENT_QUOTES, 'UTF-8');?>
</li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['style']) {?>
                <?php  $_smarty_tpl->tpl_vars["prop"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["prop"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['field']->value['properties']['style']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["prop"]->key => $_smarty_tpl->tpl_vars["prop"]->value) {
$_smarty_tpl->tpl_vars["prop"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["prop"]->key;
?>
                <?php $_smarty_tpl->tpl_vars['prop_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['prop']->value['match'], null, 0);?>

                <div class="te-font-style-wrap">
                    <input type="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prop_name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prop']->value['default'], ENT_QUOTES, 'UTF-8');?>
" />
                    <input class="cm-te-value-changer te-font-style-checkbox" type="checkbox" id="font_style_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prop_name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prop']->value['property'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['prop_name']->value]==$_smarty_tpl->tpl_vars['prop']->value['property']) {?>checked="checked"<?php }?> /><label for="font_style_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
" class="te-font-style <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prop']->value['property'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
</label>
                </div>
                <?php } ?>
                <?php }?>
            </div>
            <?php } ?>
        </div>

    <div class="te-reset-wrap"><button class="te-btn cm-te-reset"><?php echo $_smarty_tpl->__("theme_editor.reset_fonts");?>
</button></div>

    <!--te_fonts--></div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_backgrounds']) {?>
    <div class="te-wrap te-bg cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_backgrounds") {?>hidden<?php }?>" id="te_backgrounds">

        <div class="te-inner-wrap">
            <?php  $_smarty_tpl->tpl_vars["field"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["field"]->_loop = false;
 $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['props_schema']->value['backgrounds']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["field"]->key => $_smarty_tpl->tpl_vars["field"]->value) {
$_smarty_tpl->tpl_vars["field"]->_loop = true;
 $_smarty_tpl->tpl_vars["name"]->value = $_smarty_tpl->tpl_vars["field"]->key;
?>
            <div class="ty-control-group te-bg-group">
                <label for="elm_te_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['field']->value['description']);?>
</label>

                <div>
                    <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['color']) {?>
                        <?php $_smarty_tpl->tpl_vars['field_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['field']->value['properties']['color']['match'], null, 0);?>

                        <div class="te-color-picker-container te-colors clearfix">
                            <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.background_color");?>
&nbsp;</span>

                            <?php if ($_smarty_tpl->tpl_vars['field']->value['gradient']||$_smarty_tpl->tpl_vars['field']->value['transparent']||$_smarty_tpl->tpl_vars['field']->value['full_width']) {?>
                            <a id="sw_backgrounds_adv_color_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-combination te-advanced-options"><i class="glyph-cog"></i></a>
                            <?php }?>

                            <?php $_smarty_tpl->tpl_vars['color'] = new Smarty_variable(smarty_modifier_replace($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field_name']->value],"transparent",''), null, 0);?>
                            <?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/colorpicker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cp_name'=>"style[data][".((string)$_smarty_tpl->tpl_vars['field_name']->value)."]",'cp_id'=>"storage_elm_te_".((string)$_smarty_tpl->tpl_vars['name']->value),'cp_value'=>(($tmp = @$_smarty_tpl->tpl_vars['color']->value)===null||$tmp==='' ? "#ffffff" : $tmp),'cp_class'=>"cm-te-value-changer",'cp_storage'=>"theme_editor"), 0);?>

                        </div>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['field']->value['gradient']||$_smarty_tpl->tpl_vars['field']->value['transparent']||$_smarty_tpl->tpl_vars['field']->value['full_width']) {?>
                    <div id="backgrounds_adv_color_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="te-bg-advanced hidden clearfix">
                            <div class="te-advanced-connector"></div>

                        <?php if ($_smarty_tpl->tpl_vars['field']->value['gradient']) {?>
                        <?php $_smarty_tpl->tpl_vars['field_gradient'] = new Smarty_variable($_smarty_tpl->tpl_vars['field']->value['gradient']['match'], null, 0);?>
                        <div class="te-gradient-color clearfix">
                            <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.gradient");?>
&nbsp;</span>
                            <?php $_smarty_tpl->tpl_vars['gradient_color'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field_gradient']->value])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field_name']->value] : $tmp), null, 0);?>
                            <?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/colorpicker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cp_name'=>"style[data][".((string)$_smarty_tpl->tpl_vars['field_gradient']->value)."]",'cp_id'=>"storage_elm_te_".((string)$_smarty_tpl->tpl_vars['name']->value)."_gradient",'cp_value'=>(($tmp = @(smarty_modifier_replace($_smarty_tpl->tpl_vars['gradient_color']->value,"transparent",'')))===null||$tmp==='' ? "#ffffff" : $tmp),'cp_class'=>"cm-te-value-changer",'cp_storage'=>"theme_editor"), 0);?>

                        </div>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['field']->value['full_width']) {?>
                            <?php if ($_smarty_tpl->tpl_vars['field']->value['full_width']['type']) {?>
                            <div class="te-fullwidth te-checkbox clearfix">
                                <label for="elm_toggle_full_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                    <input type="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['full_width']['match'], ENT_QUOTES, 'UTF-8');?>
]" value="false" class="cm-te-value-changer" />
                                    <input type="checkbox" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['full_width']['match'], ENT_QUOTES, 'UTF-8');?>
]" class="cm-te-value-changer" id="elm_toggle_full_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="true" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['full_width']['match']]=="true") {?>checked="checked"<?php }?>>
                                    <span class="te-toggle">
                                        <span class="te-toggle-on"><?php echo $_smarty_tpl->__("theme_editor.on");?>
</span>
                                        <span class="te-toggle-off"><?php echo $_smarty_tpl->__("theme_editor.off");?>
</span>
                                        <span class="te-toggle-trigger"></span>
                                    </span>
                                        <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.full_width");?>
</span>
                                    </label>
                            </div>
                            <?php } else { ?>
                            <div class="te-fullwidth te-checkbox clearfix">
                                <label for="elm_toggle_full_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                    <input type="hidden" name="style[data][copy][full_width][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="0">
                                    <input type="checkbox" name="style[data][copy][full_width][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
]" class="cm-te-value-changer" id="elm_toggle_full_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['color']['match']]==$_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['full_width']['match']]) {?>checked="checked"<?php }?>>
                                    <span class="te-toggle">
                                        <span class="te-toggle-on"><?php echo $_smarty_tpl->__("theme_editor.on");?>
</span>
                                        <span class="te-toggle-off"><?php echo $_smarty_tpl->__("theme_editor.off");?>
</span>
                                        <span class="te-toggle-trigger"></span>
                                    </span>
                                        <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.full_width");?>
</span>
                                </label>
                            </div>
                            <?php }?>
                        <?php }?>


                        <?php if ($_smarty_tpl->tpl_vars['field']->value['transparent']) {?>
                        <div class="te-transparent te-checkbox clearfix">
                            <label for="elm_toggle_transparent_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                <input type="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['transparent']['match'], ENT_QUOTES, 'UTF-8');?>
]" value="false" class="cm-te-value-changer">
                                <input type="checkbox" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['transparent']['match'], ENT_QUOTES, 'UTF-8');?>
]" class="cm-te-value-changer" id="elm_toggle_transparent_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="true" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['transparent']['match']]=="true") {?>checked="checked"<?php }?>>
                                <span class="te-toggle">
                                    <span class="te-toggle-on"><?php echo $_smarty_tpl->__("theme_editor.on");?>
</span>
                                    <span class="te-toggle-off"><?php echo $_smarty_tpl->__("theme_editor.off");?>
</span>
                                    <span class="te-toggle-trigger"></span>
                                </span>
                                <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.transparent");?>
</span>
                            </label>
                        </div>
                        <?php }?>
                    </div>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['pattern']) {?>
                        <div class="te-bg-pattern-group clearfix">
                            <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.pattern");?>
</span>
                            <a id="sw_backgrounds_adv_pattern_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="te-advanced-options cm-combination"><i class="glyph-cog"></i></a>
                            <div id="elm_preview_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="te-pattern-preview <?php if (!$_smarty_tpl->tpl_vars['current_style']->value['parsed']) {?> te-pattern-empty<?php }?> input-prepend cm-te-pattern-selector" data-ca-pattern-dialog="backgrounds_adv_pattern_selector_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                <?php if ($_smarty_tpl->tpl_vars['current_style']->value['parsed']) {?>
                                    <img width="100%" height="100%" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['parsed'][$_smarty_tpl->tpl_vars['field']->value['properties']['pattern']], ENT_QUOTES, 'UTF-8');?>
" />
                                <?php } else { ?>
                                    <i class="ty-icon-image"></i>
                                <?php }?>
                            </div>
                            <div id="backgrounds_adv_pattern_selector_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="hidden te-bg-pattern-selector cm-te-patterns-container">
                                <div class="te-bg-pattern-container">
                                    <div class="te-bg-pattern-list">
                                        <ul class="cm-te-pattern-list" data-ca-holder-id="elm_holder_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                            <li><div class="te-pattern-preview te-pattern-empty cm-te-select-pattern">
                                                    <i class="ty-icon-image"></i>
                                                </div></li>
                                            <?php  $_smarty_tpl->tpl_vars["pattern"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["pattern"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['theme_patterns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["pattern"]->key => $_smarty_tpl->tpl_vars["pattern"]->value) {
$_smarty_tpl->tpl_vars["pattern"]->_loop = true;
?>
                                                <li><div class="te-pattern-preview cm-te-select-pattern">
                                                        <img width="100%" height="100%" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pattern']->value, ENT_QUOTES, 'UTF-8');?>
?<?php echo htmlspecialchars(@constant('TIME'), ENT_QUOTES, 'UTF-8');?>
" />
                                                    </div></li>
                                            <?php } ?>
                                            <li class="divider"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="hidden cm-te-pattern-holder cm-te-value-changer" id="elm_holder_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['pattern'], ENT_QUOTES, 'UTF-8');?>
]" data-ca-preview-id="elm_preview_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['current_style']->value['parsed'][$_smarty_tpl->tpl_vars['field']->value['properties']['pattern']])===null||$tmp==='' ? "transparent" : $tmp), ENT_QUOTES, 'UTF-8');?>
">
                        </div>
                    <?php }?>

                    <div id="backgrounds_adv_pattern_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="te-bg-advanced hidden">
                        <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['pattern']) {?>
                            <div class="te-bg-custome-image clearfix">
                                <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.upload_image");?>
</span>
                            <?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"backgrounds[".((string)$_smarty_tpl->tpl_vars['field']->value['properties']['pattern'])."]",'disabled'=>$_smarty_tpl->tpl_vars['current_style']->value['is_default']), 0);?>

                            </div>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['position']) {?>
                            <div class="te-advanced-connector"></div>
                            <div class="te-bg-position clearfix">
                            <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.position");?>
&nbsp;</span>
                                <div class="sse-bg-position-main-wrap clearfix">
                                    <div class="te-bg-position-wrap clearfix">
                                        <div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="top_left" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="top left" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="top left") {?>checked="checked"<?php }?> /><label for="top_left"><i class="glyph-arrow-up-left"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="top_center" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="top center" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="top center") {?>checked="checked"<?php }?> /><label for="top_center"><i class="glyph-arrow-up"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="top_right" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="top right" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="top right") {?>checked="checked"<?php }?> /><label for="top_right"><i class="glyph-arrow-up-right"></i></label></div>
                                    </div>
                                    <div class="te-bg-position-wrap clearfix">
                                        <div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="center_left" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" if="center_left" value="center left" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="center left") {?>checked="checked"<?php }?> /><label for="center_left"><i class="glyph-arrow-left"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="center_center" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="center center" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="center center") {?>checked="checked"<?php }?> /><label for="center_center"><i class="glyph-square"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="center_right" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="center right" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="center right") {?>checked="checked"<?php }?> /><label for="center_right"><i class="glyph-arrow-right"></i></label></div>
                                    </div>
                                    <div class="te-bg-position-wrap clearfix">
                                        <div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="bottom_left" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="bottom left" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="bottom left") {?>checked="checked"<?php }?> /><label for="bottom_left"><i class="glyph-arrow-down-left"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="bottom_center" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="bottom center" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="bottom center") {?>checked="checked"<?php }?> /><label for="bottom_center"><i class="glyph-arrow-down"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="bottom_right" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="bottom right" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="bottom right") {?>checked="checked"<?php }?> /><label for="bottom_right"><i class="glyph-arrow-down-right"></i></label></div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['repeat']) {?>
                        <div>
                            <?php $_smarty_tpl->_capture_stack[0][] = array("repeat_content", null, null); ob_start(); ?>
                                <input type="text" class="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['repeat'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['repeat']])===null||$tmp==='' ? "repeat" : $tmp), ENT_QUOTES, 'UTF-8');?>
">
                                <ul class="te-select-dropdown">
                                    <li data-ca-select-box-value="repeat" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['repeat']]=="repeat") {?>class="active" <?php $_smarty_tpl->tpl_vars['repeat_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.repeat"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.repeat");?>
</li>
                                    <li data-ca-select-box-value="repeat-x" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['repeat']]=="repeat-x") {?>class="active" <?php $_smarty_tpl->tpl_vars['repeat_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.repeat_x"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.repeat_x");?>
</li>
                                    <li data-ca-select-box-value="repeat-y" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['repeat']]=="repeat-y") {?>class="active" <?php $_smarty_tpl->tpl_vars['repeat_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.repeat_y"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.repeat_y");?>
</li>
                                    <li data-ca-select-box-value="no-repeat" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['repeat']]=="no-repeat") {?>class="active" <?php $_smarty_tpl->tpl_vars['repeat_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.no_repeat"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.no_repeat");?>
</li>
                                </ul>
                            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                            <div class="te-select-box cm-te-selectbox cm-te-value-changer" tabindex="0"><span><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['repeat_title']->value)===null||$tmp==='' ? $_smarty_tpl->__("theme_editor.repeat") : $tmp), ENT_QUOTES, 'UTF-8');?>
</span><i class="ty-icon-d-arrow"></i>
                                <?php echo Smarty::$_smarty_vars['capture']['repeat_content'];?>

                            </div>
                        </div>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['attachment']) {?>
                        <div>
                            <?php $_smarty_tpl->_capture_stack[0][] = array("scroll_content", null, null); ob_start(); ?>
                                <input type="text" class="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['attachment'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['attachment']])===null||$tmp==='' ? "scroll" : $tmp), ENT_QUOTES, 'UTF-8');?>
">
                                <ul class="te-select-dropdown">
                                    <li data-ca-select-box-value="scroll" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['attachment']]=="scroll") {?>class="active" <?php $_smarty_tpl->tpl_vars['scroll_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.scroll"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.scroll");?>
</li>
                                    <li data-ca-select-box-value="fixed" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['attachment']]=="fixed") {?>class="active" <?php $_smarty_tpl->tpl_vars['scroll_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.fixed"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.fixed");?>
</li>
                                </ul>
                            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                            <div class="te-select-box cm-te-selectbox cm-te-value-changer" tabindex="0"><span><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['scroll_title']->value)===null||$tmp==='' ? $_smarty_tpl->__("theme_editor.scroll") : $tmp), ENT_QUOTES, 'UTF-8');?>
</span><i class="ty-icon-d-arrow"></i>
                                <?php echo Smarty::$_smarty_vars['capture']['scroll_content'];?>

                            </div>
                        </div>
                        <?php }?>
                    </div>

                </div>
            </div>
            <?php } ?>
        </div>

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset"><?php echo $_smarty_tpl->__("theme_editor.reset_backgrounds");?>
</button></div>

    <!--te_backgrounds--></div>
    <?php }?>
<?php } else { ?>
    <div class="te-wrap te-css cm-te-section">
        <div class="te-inner-wrap">
            <div id="css_content" class="cm-te-css-editor"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['css_content']->value, ENT_QUOTES, 'UTF-8');?>
</div>
        </div>

        <div class="te-reset-wrap te-enable-less-container">
            <button class="te-btn cm-te-restore-less"><?php echo $_smarty_tpl->__("theme_editor.enable_less");?>
</button>
            <span class="te-warning-info"><?php echo $_smarty_tpl->__("theme_editor.warning_css_changes_will_be_reverted");?>
</span>
        </div>

    </div>

<?php }?>
</div>
</div>


</div>

</form>
<!--theme_editor--></div>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="backend:views/theme_editor/view.tpl" id="<?php echo smarty_function_set_id(array('name'=>"backend:views/theme_editor/view.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><div id="theme_editor">

<?php echo '<script'; ?>
 type="text/javascript">
Tygh.tr({
    'theme_editor.style_name': '<?php echo strtr($_smarty_tpl->__("theme_editor.style_name"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.incorrect_style_name': '<?php echo strtr($_smarty_tpl->__("theme_editor.incorrect_style_name"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.text_close_editor': '<?php echo strtr($_smarty_tpl->__("theme_editor.text_close_editor"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.text_close_editor_unsaved': '<?php echo strtr($_smarty_tpl->__("theme_editor.text_close_editor_unsaved"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.text_reset_changes': '<?php echo strtr($_smarty_tpl->__("theme_editor.text_reset_changes"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.error_style_exists': '<?php echo strtr($_smarty_tpl->__("theme_editor.error_style_exists"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
    'theme_editor.confirm_enable_less': '<?php echo strtr($_smarty_tpl->__("theme_editor.confirm_enable_less"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
});
Tygh.te_custom_fonts = <?php echo smarty_modifier_to_json($_smarty_tpl->tpl_vars['current_style']->value['custom_fonts']);?>
;
<?php echo '</script'; ?>
>

<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" class="cm-ajax" name="theme_editor_form" enctype="multipart/form-data">
<?php if ($_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css']) {?>
    <input type="hidden" name="selected_css_file" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_css_file']->value, ENT_QUOTES, 'UTF-8');?>
" />
<?php } else { ?>
    <input type="hidden" name="style_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['style_id'], ENT_QUOTES, 'UTF-8');?>
" data-ca-is-default="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['is_default'], ENT_QUOTES, 'UTF-8');?>
">
    <input type="hidden" name="style[name]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
<?php }?>
<input type="hidden" name="selected_section" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['selected_section']->value, ENT_QUOTES, 'UTF-8');?>
">
<input type="hidden" name="result_ids" value="theme_editor">

<span class="te-nav"><a id="sw_theme_editor_container" class="te-minimize cm-combination" title="<?php echo $_smarty_tpl->__("theme_editor.hide_show");?>
">
        <i class="glyph-left-open icon-left-open"></i><i class="glyph-right-open icon-right-open hidden"></i>
    </a>
<a href="<?php echo htmlspecialchars(fn_url("customization.disable_mode?type=theme_editor"), ENT_QUOTES, 'UTF-8');?>
" class="te-close cm-te-close-editor" title="<?php echo $_smarty_tpl->__("theme_editor.close");?>
"><i class="glyph-cancel icon-cancel"></i></a>
        </span>
</span>

<div class="theme-editor <?php if ($_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css']) {?> te-converted-to-css<?php }?>" data-ca-te-use-dynamic-style="<?php if ($_smarty_tpl->tpl_vars['runtime']->value['vendor_id']) {?>true<?php } else { ?>false<?php }?>" id="theme_editor_container" data-bp-sidebar="true">
    <div class="te-overlay<?php if ((($tmp = @$_smarty_tpl->tpl_vars['is_theme_editor_allowed']->value)===null||$tmp==='' ? true : $tmp)) {?> hidden<?php }?>">
        <div class="te-notification-wrapper">
            <p class="notification-content alert-warning"><?php echo $_smarty_tpl->__("theme_editor.page_cant_be_configured");?>
</p>
        </div>
    </div>
    <div class="te-header<?php if (!$_smarty_tpl->tpl_vars['props_schema']->value) {?> te-header-no-schema<?php }?>" id="te_styles_list">
        <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['layouts']->value)==1) {?>
            <a class="te-layout-name"><span class="te-layout-label"><?php echo $_smarty_tpl->__("layout");?>
: </span><span class="te-layout-title te-layout-nolink"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout_data']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span></a>
        <?php } else { ?>
            <a id="sw_te-layouts" class="te-layout-name cm-combination"><span class="te-layout-label"><?php echo $_smarty_tpl->__("layout");?>
: </span><span class="te-layout-title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout_data']->value['name'], ENT_QUOTES, 'UTF-8');?>
</span></a>
            <ul id="te-layouts" class="te-layout-dropdown cm-popup-box">
                <?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value) {
$_smarty_tpl->tpl_vars['layout']->_loop = true;
?>
                    <li><a class="cm-te-change-layout" data-ca-layout-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout']->value['layout_id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['layout_id']!=$_smarty_tpl->tpl_vars['layout']->value['layout_id']) {?>href="<?php echo htmlspecialchars(fn_link_attach($_smarty_tpl->tpl_vars['theme_url']->value,"s_layout=".((string)$_smarty_tpl->tpl_vars['layout']->value['layout_id'])), ENT_QUOTES, 'UTF-8');?>
"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a></li>
                <?php } ?>
            </ul>
        <?php }?>
        <span class="te-title">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"theme_editor:title")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"theme_editor:title"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php echo $_smarty_tpl->__("theme_editor");?>

            <?php if (!$_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css']&&!$_smarty_tpl->tpl_vars['runtime']->value['vendor_id']) {?>
                <a class="te-action-link cm-te-convert-to-css cm-confirm">
                    <span class="te-action-link-title"><?php echo $_smarty_tpl->__('theme_editor.convert_to_css');?>
&nbsp;<i class="ty-icon-help-circle cm-tooltip" title="<?php echo $_smarty_tpl->__('theme_editor.text_convert_to_css');?>
"></i></span>
                </a>
            <?php }?>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"theme_editor:title"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        </span>

        <?php if (!$_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css']) {?>

            <?php if ($_smarty_tpl->tpl_vars['props_schema']->value) {?>
            <span class="te-subtitle"><?php echo $_smarty_tpl->__("theme_editor.styles");?>
</span>
            <div class="te-header-menu-wrap">
                <div class="te-header-menu-wrap-left">
                    <?php $_smarty_tpl->tpl_vars['current_style_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['current_style']->value['name'], null, 0);?>

                    <div class="te-select-box cm-te-selectbox te-theme" tabindex="0"><span class="cm-style-title"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['current_style_name']->value)===null||$tmp==='' ? $_smarty_tpl->__("none") : $tmp), ENT_QUOTES, 'UTF-8');?>
</span><i class="ty-icon-d-arrow"></i>
                    <ul class="te-select-dropdown" id="elm_te_styles">
                        <?php  $_smarty_tpl->tpl_vars["s_item"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["s_item"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['styles_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["s_item"]->key => $_smarty_tpl->tpl_vars["s_item"]->value) {
$_smarty_tpl->tpl_vars["s_item"]->_loop = true;
?>
                            <li class="<?php if ($_smarty_tpl->tpl_vars['runtime']->value['layout']['style_id']===$_smarty_tpl->tpl_vars['s_item']->value['style_id']) {?>active<?php }?>">
                                <a class="cm-te-load-style te-list-item <?php if ($_smarty_tpl->tpl_vars['runtime']->value['layout']['style_id']===$_smarty_tpl->tpl_vars['s_item']->value['style_id']) {?>active<?php }?>" data-ca-target-id="theme_editor" href="<?php echo htmlspecialchars(fn_url("theme_editor.view?style_id=".((string)$_smarty_tpl->tpl_vars['s_item']->value['style_id'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-style-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['s_item']->value['style_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['s_item']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a>

                                <a class="ty-icon-wrap-duplicate cm-te-duplicate-style" data-ca-style-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['s_item']->value['style_id'], ENT_QUOTES, 'UTF-8');?>
"><i class="ty-icon-docs" title="<?php echo $_smarty_tpl->__("clone");?>
"></i></a>

                                <?php if ((($tmp = @$_smarty_tpl->tpl_vars['s_item']->value['is_removable'])===null||$tmp==='' ? true : $tmp)) {?>
                                    <a class="ty-icon-wrap-remove cm-ajax cm-confirm" data-ca-target-id="te_styles_list" href="<?php echo htmlspecialchars(fn_url("theme_editor.delete_style?style_id=".((string)$_smarty_tpl->tpl_vars['s_item']->value['style_id'])), ENT_QUOTES, 'UTF-8');?>
"><i class="ty-icon-trashcan" title="<?php echo $_smarty_tpl->__("delete");?>
"></i></a>
                                <?php }?>
                            </li>
                        <?php }
if (!$_smarty_tpl->tpl_vars["s_item"]->_loop) {
?>
                            <li class="active">
                                <a class="cm-te-load-style te-list-item active">--</a>
                            </li>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
                <div class="te-header-menu-wrap-right">
                    <button class="te-btn-action ty-float-right" type="submit" name="dispatch[theme_editor.save]"><?php echo $_smarty_tpl->__("save");?>
</button>
                </div>
            </div>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['te_sections']->value) {?>
                <span class="te-subtitle"><?php echo $_smarty_tpl->__("theme_editor.customize");?>
</span>
                <div class="te-select-box cm-te-selectbox te-customize" tabindex="0">
                    <span><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['te_sections']->value[$_smarty_tpl->tpl_vars['selected_section']->value]);?>
</span><i class="ty-icon-d-arrow"></i>
                    <ul class="te-select-dropdown cm-te-sections">
                        <?php  $_smarty_tpl->tpl_vars["s"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["s"]->_loop = false;
 $_smarty_tpl->tpl_vars["section"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['te_sections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["s"]->key => $_smarty_tpl->tpl_vars["s"]->value) {
$_smarty_tpl->tpl_vars["s"]->_loop = true;
 $_smarty_tpl->tpl_vars["section"]->value = $_smarty_tpl->tpl_vars["s"]->key;
?>
                        <li <?php if ($_smarty_tpl->tpl_vars['selected_section']->value==$_smarty_tpl->tpl_vars['section']->value) {?>class="active"<?php }?> data-ca-target-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['section']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['s']->value);?>
</li>
                        <?php } ?>
                    </ul>
                </div>
            <?php }?>
            <?php if (!$_smarty_tpl->tpl_vars['props_schema']->value) {?>
                <div class="te-no-schema">
                    <button class="te-btn-action ty-float-right" type="submit" name="dispatch[theme_editor.save]"><?php echo $_smarty_tpl->__("save");?>
</button>
                </div>
            <?php }?>
        <?php } else { ?>
            <span class="te-subtitle"><?php echo $_smarty_tpl->__("files");?>
</span>
            <div class="te-header-menu-wrap">
                <div class="te-header-menu-wrap-left">
                    <div class="te-select-box cm-te-selectbox te-theme" tabindex="0"><span class="cm-style-title"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['selected_css_file']->value)===null||$tmp==='' ? $_smarty_tpl->__("none") : $tmp), ENT_QUOTES, 'UTF-8');?>
</span><i class="ty-icon-d-arrow"></i>
                        <ul class="te-select-dropdown">
                            <?php  $_smarty_tpl->tpl_vars["css_file"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["css_file"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['css_files_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["css_file"]->key => $_smarty_tpl->tpl_vars["css_file"]->value) {
$_smarty_tpl->tpl_vars["css_file"]->_loop = true;
?>
                                <li class="<?php if ($_smarty_tpl->tpl_vars['css_file']->value==$_smarty_tpl->tpl_vars['selected_css_file']->value) {?>active<?php }?>">
                                    <a class="te-list-item <?php if ($_smarty_tpl->tpl_vars['css_file']->value==$_smarty_tpl->tpl_vars['selected_css_file']->value) {?>active<?php }?> cm-te-change-css-file" data-ca-target-id="theme_editor" href="<?php echo htmlspecialchars(fn_url("theme_editor.view?selected_css_file=".((string)$_smarty_tpl->tpl_vars['css_file']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['css_file']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                                </li>
                            <?php }
if (!$_smarty_tpl->tpl_vars["css_file"]->_loop) {
?>
                                <li class="active">
                                    <a class="te-list-item active">--</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="te-header-menu-wrap-right">
                    <button class="te-btn-action float-right" type="submit" name="dispatch[theme_editor.save]"><?php echo $_smarty_tpl->__("save");?>
</button>
                </div>
            </div>


        <?php }?>
    <!--te_styles_list--></div>
<div class="te-content<?php if (!$_smarty_tpl->tpl_vars['props_schema']->value) {?> te-content-no-schema<?php }?>">
<div class="te-section cm-te-disable-scroll">
<?php if (!$_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css']) {?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_general']) {?>
    <div class="te-wrap te-general cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_general") {?>hidden<?php }?>" id="te_general">
        <div class="te-inner-wrap">
            <div class="te-general-group">

                <?php if ($_smarty_tpl->tpl_vars['cse_logos']->value&&$_smarty_tpl->tpl_vars['cse_logos']->value['favicon']) {?>
                    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->tpl_vars['cse_logos']->value['favicon']['logo_id'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable($_smarty_tpl->tpl_vars['cse_logos']->value['favicon']['image'], null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable(array(), null, 0);?>
                <?php }?>

                <input type="text" class="hidden" name="logotypes_image_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][type]" value="M">
                <input type="text" class="hidden" name="logotypes_image_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][object_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">

                <div class="te-image te-favicon-wrap clearfix">
                    <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.favicon");?>
&nbsp;<i class="ty-icon-help-circle cm-tooltip" title="<?php echo $_smarty_tpl->__("theme_editor.favicon_size");?>
"></i></span><?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"logotypes_image_icon[".((string)$_smarty_tpl->tpl_vars['id']->value)."]",'disabled'=>$_smarty_tpl->tpl_vars['current_style']->value['is_default']), 0);?>

                    <div class="te-favicon cm-te-logo" data-ca-image-area="favicon" style="background-image: url('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['image_path'], ENT_QUOTES, 'UTF-8');?>
'); background-repeat: no-repeat; background-position: center center;"></div>
                </div>

            </div>

            <?php  $_smarty_tpl->tpl_vars["field"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["field"]->_loop = false;
 $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['props_schema']->value['general']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["field"]->key => $_smarty_tpl->tpl_vars["field"]->value) {
$_smarty_tpl->tpl_vars["field"]->_loop = true;
 $_smarty_tpl->tpl_vars["name"]->value = $_smarty_tpl->tpl_vars["field"]->key;
?>

                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="checkbox") {?>
                    <div class="te-general-group">
                        <div class="te-checkbox clearfix">
                            <label for="elm_toggle_general_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                <input type="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="false" class="cm-te-value-changer" />
                                <input type="checkbox" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
]" class="cm-te-value-changer" id="elm_toggle_general_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="true" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value]=="true") {?>checked="checked"<?php }?>><span class="te-toggle"><span class="te-toggle-on"><?php echo $_smarty_tpl->__("theme_editor.on");?>
</span><span class="te-toggle-off"><?php echo $_smarty_tpl->__("theme_editor.off");?>
</span><span class="te-toggle-trigger"></span></span><span class="te-bg-title"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['field']->value['description']);?>
</span></label>
                        </div>
                    </div>
                <?php }?>

            <?php } ?>
        </div>

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset"><?php echo $_smarty_tpl->__("theme_editor.reset_general");?>
</button></div>
    <!--te_general--></div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_css']) {?>
    <div class="te-wrap te-css cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_css") {?>hidden<?php }?>" id="te_css">
        <div class="te-inner-wrap">
            <textarea name="style[custom_css]" cols="30" rows="10"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['custom_css'], ENT_QUOTES, 'UTF-8');?>
</textarea>
        </div>

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset"><?php echo $_smarty_tpl->__("theme_editor.reset_css");?>
</button></div>

    <!--te_css--></div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_logos']) {?>
    <div class="te-wrap te-logos cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_logos") {?>hidden<?php }?>" id="te_logos">

        <div class="te-tabs cm-te-tabs">
            <ul class="te-pills">
                <?php  $_smarty_tpl->tpl_vars["logo"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["logo"]->_loop = false;
 $_smarty_tpl->tpl_vars["type"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cse_logo_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["logo"]->key => $_smarty_tpl->tpl_vars["logo"]->value) {
$_smarty_tpl->tpl_vars["logo"]->_loop = true;
 $_smarty_tpl->tpl_vars["type"]->value = $_smarty_tpl->tpl_vars["logo"]->key;
?>
                <?php if ($_smarty_tpl->tpl_vars['type']->value=="favicon") {?>
                    <?php continue 1;?>
                <?php }?>
                <li <?php if ($_smarty_tpl->tpl_vars['type']->value=="theme") {?>class="active"<?php }?>><a data-ca-target-id="elm_logo_section_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->__("theme_editor.".((string)$_smarty_tpl->tpl_vars['type']->value));?>
"><span><?php echo $_smarty_tpl->__("theme_editor.".((string)$_smarty_tpl->tpl_vars['type']->value));?>
</span></a></li>
                <?php } ?>
            </ul>

            <?php  $_smarty_tpl->tpl_vars["logo"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["logo"]->_loop = false;
 $_smarty_tpl->tpl_vars["type"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cse_logo_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["logo"]->key => $_smarty_tpl->tpl_vars["logo"]->value) {
$_smarty_tpl->tpl_vars["logo"]->_loop = true;
 $_smarty_tpl->tpl_vars["type"]->value = $_smarty_tpl->tpl_vars["logo"]->key;
?>
                <?php if ($_smarty_tpl->tpl_vars['type']->value=="favicon") {?>
                    <?php continue 1;?>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['cse_logos']->value&&$_smarty_tpl->tpl_vars['cse_logos']->value[$_smarty_tpl->tpl_vars['type']->value]) {?>
                    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->tpl_vars['cse_logos']->value[$_smarty_tpl->tpl_vars['type']->value]['logo_id'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable($_smarty_tpl->tpl_vars['cse_logos']->value[$_smarty_tpl->tpl_vars['type']->value]['image'], null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable(array(), null, 0);?>
                <?php }?>

                <div class="cm-te-tab-contents" <?php if ($_smarty_tpl->tpl_vars['type']->value!="theme") {?>style="display:none;"<?php }?> id="elm_logo_section_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <input type="text" class="hidden" name="logotypes_image_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][type]" value="M">
                    <input type="text" class="hidden" name="logotypes_image_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][object_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <div class="attach-images">
                        <div class="upload-box clearfix">
                            <div class="image-wrap pull-left">
                                <div class="te-image">
                                    <div class="te-bg-image cm-te-logo" data-ca-image-area="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['type']->value, ENT_QUOTES, 'UTF-8');?>
" style="background-image: url('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['image_path'], ENT_QUOTES, 'UTF-8');?>
'); background-repeat: no-repeat; background-position: center center;"></div>
                                </div>
                                <div class="logo-alt"><input type="text" class="cm-image-field" id="alt_text_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['a']->value, ENT_QUOTES, 'UTF-8');?>
" name="logotypes_image_data[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
][image_alt]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['alt'], ENT_QUOTES, 'UTF-8');?>
" placeholder="<?php echo $_smarty_tpl->__("alt_text");?>
"></div>
                            </div>

                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"theme_editor:logo_uploader")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"theme_editor:logo_uploader"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                            <div class="te-logos-upload clearfix">
                                <span class="te-bg-title"><?php echo $_smarty_tpl->__("image");?>
&nbsp;</span>
                                <?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"logotypes_image_icon[".((string)$_smarty_tpl->tpl_vars['id']->value)."]",'disabled'=>$_smarty_tpl->tpl_vars['current_style']->value['is_default']), 0);?>

                            </div>
                            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"theme_editor:logo_uploader"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        
    <!--te_logos--></div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_colors']) {?>
    <div class="te-wrap te-colors cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_colors") {?>hidden<?php }?>" id="te_colors">

        <?php  $_smarty_tpl->tpl_vars["field"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["field"]->_loop = false;
 $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['props_schema']->value['colors']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["field"]->key => $_smarty_tpl->tpl_vars["field"]->value) {
$_smarty_tpl->tpl_vars["field"]->_loop = true;
 $_smarty_tpl->tpl_vars["name"]->value = $_smarty_tpl->tpl_vars["field"]->key;
?>
        <div class="te-colors clearfix">
            <label for="elm_te_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['field']->value['description']);?>
</label>

            <?php $_smarty_tpl->tpl_vars['cp_value'] = new Smarty_variable((($tmp = @($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value]))===null||$tmp==='' ? "#ffffff" : $tmp), null, 0);?>

            <?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/colorpicker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cp_name'=>"style[data][".((string)$_smarty_tpl->tpl_vars['name']->value)."]",'cp_id'=>"storage_elm_te_".((string)$_smarty_tpl->tpl_vars['name']->value),'cp_value'=>$_smarty_tpl->tpl_vars['cp_value']->value,'cp_class'=>"cm-te-value-changer",'cp_storage'=>"theme_editor"), 0);?>

        </div>
        <?php } ?>

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset"><?php echo $_smarty_tpl->__("theme_editor.reset_colors");?>
</button></div>

    <!--te_colors--></div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_fonts']) {?>
    <div class="te-wrap te-fonts cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_fonts") {?>hidden<?php }?>" id="te_fonts">
        <div class="te-inner-wrap">
            <?php  $_smarty_tpl->tpl_vars["field"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["field"]->_loop = false;
 $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['props_schema']->value['fonts']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["field"]->key => $_smarty_tpl->tpl_vars["field"]->value) {
$_smarty_tpl->tpl_vars["field"]->_loop = true;
 $_smarty_tpl->tpl_vars["name"]->value = $_smarty_tpl->tpl_vars["field"]->key;
?>
            <div class="ty-control-group control-group te-font-group">
                <label for="elm_te_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['field']->value['description']);?>
</label>
                <div class="te-select-box cm-te-selectbox cm-te-google cm-te-value-changer" tabindex="0" data-ca-select-box-default="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value], ENT_QUOTES, 'UTF-8');?>
"><span></span><i class="ty-icon-d-arrow"></i>
                    <input type="text" class="hidden cm-te-selectbox-storage" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value]) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value], ENT_QUOTES, 'UTF-8');
} else { ?>Arial,Helvetica,sans-serif<?php }?>">

                    <ul class="te-select-dropdown">
                        <li class="te-selectbox-group cm-te-selectbox-group"><?php echo $_smarty_tpl->__("theme_editor.system_fonts");?>
</li>

                        <?php  $_smarty_tpl->tpl_vars["family_name"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["family_name"]->_loop = false;
 $_smarty_tpl->tpl_vars["family"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['props_schema']->value['fonts']['families']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["family_name"]->key => $_smarty_tpl->tpl_vars["family_name"]->value) {
$_smarty_tpl->tpl_vars["family_name"]->_loop = true;
 $_smarty_tpl->tpl_vars["family"]->value = $_smarty_tpl->tpl_vars["family_name"]->key;
?>
                        <li data-ca-select-box-value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['family']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['name']->value]==$_smarty_tpl->tpl_vars['family']->value) {?>class="active"<?php }?> style="font-family: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['family']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['family_name']->value, ENT_QUOTES, 'UTF-8');?>
</li>
                        <?php } ?>

                        <li class="te-selectbox-group cm-te-selectbox-group cm-te-google-popular"><?php echo $_smarty_tpl->__("theme_editor.popular_fonts");?>
</li>
                        <li class="te-selectbox-group cm-te-selectbox-group cm-te-google-other"><?php echo $_smarty_tpl->__("theme_editor.other_fonts");?>
</li>
                        <li class="hidden te-selectbox-group cm-te-selectbox-group cm-te-google-custom"></li>
                    </ul>
                </div>

                <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['size']) {?>
                    <?php $_smarty_tpl->tpl_vars['size_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['field']->value['properties']['size']['match'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['current_value'] = new Smarty_variable(smarty_modifier_replace($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['size_name']->value],$_smarty_tpl->tpl_vars['field']->value['properties']['size']['unit'],''), null, 0);?>

                    <div class="te-select-box te-font-size cm-te-selectbox cm-te-value-changer" tabindex="0"><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_value']->value, ENT_QUOTES, 'UTF-8');?>
</span><i class="ty-icon-d-arrow"></i>
                        <input type="text" class="hidden cm-te-selectbox-storage" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['size_name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['size_name']->value], ENT_QUOTES, 'UTF-8');?>
">
                        <ul class="te-select-dropdown">
                            <?php  $_smarty_tpl->tpl_vars["font_size"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["font_size"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['field']->value['properties']['size']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["font_size"]->key => $_smarty_tpl->tpl_vars["font_size"]->value) {
$_smarty_tpl->tpl_vars["font_size"]->_loop = true;
?>
                            <li data-ca-select-box-value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['font_size']->value, ENT_QUOTES, 'UTF-8');?>
px" <?php if ($_smarty_tpl->tpl_vars['current_value']->value==$_smarty_tpl->tpl_vars['font_size']->value) {?>class="active"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['font_size']->value, ENT_QUOTES, 'UTF-8');?>
</li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['style']) {?>
                <?php  $_smarty_tpl->tpl_vars["prop"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["prop"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['field']->value['properties']['style']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["prop"]->key => $_smarty_tpl->tpl_vars["prop"]->value) {
$_smarty_tpl->tpl_vars["prop"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["prop"]->key;
?>
                <?php $_smarty_tpl->tpl_vars['prop_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['prop']->value['match'], null, 0);?>

                <div class="te-font-style-wrap">
                    <input type="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prop_name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prop']->value['default'], ENT_QUOTES, 'UTF-8');?>
" />
                    <input class="cm-te-value-changer te-font-style-checkbox" type="checkbox" id="font_style_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prop_name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prop']->value['property'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['prop_name']->value]==$_smarty_tpl->tpl_vars['prop']->value['property']) {?>checked="checked"<?php }?> /><label for="font_style_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
" class="te-font-style <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prop']->value['property'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
</label>
                </div>
                <?php } ?>
                <?php }?>
            </div>
            <?php } ?>
        </div>

    <div class="te-reset-wrap"><button class="te-btn cm-te-reset"><?php echo $_smarty_tpl->__("theme_editor.reset_fonts");?>
</button></div>

    <!--te_fonts--></div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['te_sections']->value['te_backgrounds']) {?>
    <div class="te-wrap te-bg cm-te-section <?php if ($_smarty_tpl->tpl_vars['selected_section']->value!="te_backgrounds") {?>hidden<?php }?>" id="te_backgrounds">

        <div class="te-inner-wrap">
            <?php  $_smarty_tpl->tpl_vars["field"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["field"]->_loop = false;
 $_smarty_tpl->tpl_vars["name"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['props_schema']->value['backgrounds']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["field"]->key => $_smarty_tpl->tpl_vars["field"]->value) {
$_smarty_tpl->tpl_vars["field"]->_loop = true;
 $_smarty_tpl->tpl_vars["name"]->value = $_smarty_tpl->tpl_vars["field"]->key;
?>
            <div class="ty-control-group te-bg-group">
                <label for="elm_te_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['field']->value['description']);?>
</label>

                <div>
                    <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['color']) {?>
                        <?php $_smarty_tpl->tpl_vars['field_name'] = new Smarty_variable($_smarty_tpl->tpl_vars['field']->value['properties']['color']['match'], null, 0);?>

                        <div class="te-color-picker-container te-colors clearfix">
                            <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.background_color");?>
&nbsp;</span>

                            <?php if ($_smarty_tpl->tpl_vars['field']->value['gradient']||$_smarty_tpl->tpl_vars['field']->value['transparent']||$_smarty_tpl->tpl_vars['field']->value['full_width']) {?>
                            <a id="sw_backgrounds_adv_color_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-combination te-advanced-options"><i class="glyph-cog"></i></a>
                            <?php }?>

                            <?php $_smarty_tpl->tpl_vars['color'] = new Smarty_variable(smarty_modifier_replace($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field_name']->value],"transparent",''), null, 0);?>
                            <?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/colorpicker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cp_name'=>"style[data][".((string)$_smarty_tpl->tpl_vars['field_name']->value)."]",'cp_id'=>"storage_elm_te_".((string)$_smarty_tpl->tpl_vars['name']->value),'cp_value'=>(($tmp = @$_smarty_tpl->tpl_vars['color']->value)===null||$tmp==='' ? "#ffffff" : $tmp),'cp_class'=>"cm-te-value-changer",'cp_storage'=>"theme_editor"), 0);?>

                        </div>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['field']->value['gradient']||$_smarty_tpl->tpl_vars['field']->value['transparent']||$_smarty_tpl->tpl_vars['field']->value['full_width']) {?>
                    <div id="backgrounds_adv_color_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="te-bg-advanced hidden clearfix">
                            <div class="te-advanced-connector"></div>

                        <?php if ($_smarty_tpl->tpl_vars['field']->value['gradient']) {?>
                        <?php $_smarty_tpl->tpl_vars['field_gradient'] = new Smarty_variable($_smarty_tpl->tpl_vars['field']->value['gradient']['match'], null, 0);?>
                        <div class="te-gradient-color clearfix">
                            <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.gradient");?>
&nbsp;</span>
                            <?php $_smarty_tpl->tpl_vars['gradient_color'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field_gradient']->value])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field_name']->value] : $tmp), null, 0);?>
                            <?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/colorpicker.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cp_name'=>"style[data][".((string)$_smarty_tpl->tpl_vars['field_gradient']->value)."]",'cp_id'=>"storage_elm_te_".((string)$_smarty_tpl->tpl_vars['name']->value)."_gradient",'cp_value'=>(($tmp = @(smarty_modifier_replace($_smarty_tpl->tpl_vars['gradient_color']->value,"transparent",'')))===null||$tmp==='' ? "#ffffff" : $tmp),'cp_class'=>"cm-te-value-changer",'cp_storage'=>"theme_editor"), 0);?>

                        </div>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['field']->value['full_width']) {?>
                            <?php if ($_smarty_tpl->tpl_vars['field']->value['full_width']['type']) {?>
                            <div class="te-fullwidth te-checkbox clearfix">
                                <label for="elm_toggle_full_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                    <input type="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['full_width']['match'], ENT_QUOTES, 'UTF-8');?>
]" value="false" class="cm-te-value-changer" />
                                    <input type="checkbox" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['full_width']['match'], ENT_QUOTES, 'UTF-8');?>
]" class="cm-te-value-changer" id="elm_toggle_full_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="true" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['full_width']['match']]=="true") {?>checked="checked"<?php }?>>
                                    <span class="te-toggle">
                                        <span class="te-toggle-on"><?php echo $_smarty_tpl->__("theme_editor.on");?>
</span>
                                        <span class="te-toggle-off"><?php echo $_smarty_tpl->__("theme_editor.off");?>
</span>
                                        <span class="te-toggle-trigger"></span>
                                    </span>
                                        <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.full_width");?>
</span>
                                    </label>
                            </div>
                            <?php } else { ?>
                            <div class="te-fullwidth te-checkbox clearfix">
                                <label for="elm_toggle_full_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                    <input type="hidden" name="style[data][copy][full_width][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
]" value="0">
                                    <input type="checkbox" name="style[data][copy][full_width][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
]" class="cm-te-value-changer" id="elm_toggle_full_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['color']['match']]==$_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['full_width']['match']]) {?>checked="checked"<?php }?>>
                                    <span class="te-toggle">
                                        <span class="te-toggle-on"><?php echo $_smarty_tpl->__("theme_editor.on");?>
</span>
                                        <span class="te-toggle-off"><?php echo $_smarty_tpl->__("theme_editor.off");?>
</span>
                                        <span class="te-toggle-trigger"></span>
                                    </span>
                                        <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.full_width");?>
</span>
                                </label>
                            </div>
                            <?php }?>
                        <?php }?>


                        <?php if ($_smarty_tpl->tpl_vars['field']->value['transparent']) {?>
                        <div class="te-transparent te-checkbox clearfix">
                            <label for="elm_toggle_transparent_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                <input type="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['transparent']['match'], ENT_QUOTES, 'UTF-8');?>
]" value="false" class="cm-te-value-changer">
                                <input type="checkbox" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['transparent']['match'], ENT_QUOTES, 'UTF-8');?>
]" class="cm-te-value-changer" id="elm_toggle_transparent_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="true" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['transparent']['match']]=="true") {?>checked="checked"<?php }?>>
                                <span class="te-toggle">
                                    <span class="te-toggle-on"><?php echo $_smarty_tpl->__("theme_editor.on");?>
</span>
                                    <span class="te-toggle-off"><?php echo $_smarty_tpl->__("theme_editor.off");?>
</span>
                                    <span class="te-toggle-trigger"></span>
                                </span>
                                <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.transparent");?>
</span>
                            </label>
                        </div>
                        <?php }?>
                    </div>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['pattern']) {?>
                        <div class="te-bg-pattern-group clearfix">
                            <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.pattern");?>
</span>
                            <a id="sw_backgrounds_adv_pattern_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="te-advanced-options cm-combination"><i class="glyph-cog"></i></a>
                            <div id="elm_preview_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="te-pattern-preview <?php if (!$_smarty_tpl->tpl_vars['current_style']->value['parsed']) {?> te-pattern-empty<?php }?> input-prepend cm-te-pattern-selector" data-ca-pattern-dialog="backgrounds_adv_pattern_selector_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                <?php if ($_smarty_tpl->tpl_vars['current_style']->value['parsed']) {?>
                                    <img width="100%" height="100%" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['current_style']->value['parsed'][$_smarty_tpl->tpl_vars['field']->value['properties']['pattern']], ENT_QUOTES, 'UTF-8');?>
" />
                                <?php } else { ?>
                                    <i class="ty-icon-image"></i>
                                <?php }?>
                            </div>
                            <div id="backgrounds_adv_pattern_selector_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="hidden te-bg-pattern-selector cm-te-patterns-container">
                                <div class="te-bg-pattern-container">
                                    <div class="te-bg-pattern-list">
                                        <ul class="cm-te-pattern-list" data-ca-holder-id="elm_holder_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
">
                                            <li><div class="te-pattern-preview te-pattern-empty cm-te-select-pattern">
                                                    <i class="ty-icon-image"></i>
                                                </div></li>
                                            <?php  $_smarty_tpl->tpl_vars["pattern"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["pattern"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['theme_patterns']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["pattern"]->key => $_smarty_tpl->tpl_vars["pattern"]->value) {
$_smarty_tpl->tpl_vars["pattern"]->_loop = true;
?>
                                                <li><div class="te-pattern-preview cm-te-select-pattern">
                                                        <img width="100%" height="100%" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pattern']->value, ENT_QUOTES, 'UTF-8');?>
?<?php echo htmlspecialchars(@constant('TIME'), ENT_QUOTES, 'UTF-8');?>
" />
                                                    </div></li>
                                            <?php } ?>
                                            <li class="divider"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="hidden cm-te-pattern-holder cm-te-value-changer" id="elm_holder_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['pattern'], ENT_QUOTES, 'UTF-8');?>
]" data-ca-preview-id="elm_preview_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['current_style']->value['parsed'][$_smarty_tpl->tpl_vars['field']->value['properties']['pattern']])===null||$tmp==='' ? "transparent" : $tmp), ENT_QUOTES, 'UTF-8');?>
">
                        </div>
                    <?php }?>

                    <div id="backgrounds_adv_pattern_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
" class="te-bg-advanced hidden">
                        <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['pattern']) {?>
                            <div class="te-bg-custome-image clearfix">
                                <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.upload_image");?>
</span>
                            <?php echo $_smarty_tpl->getSubTemplate ("backend:views/theme_editor/components/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"backgrounds[".((string)$_smarty_tpl->tpl_vars['field']->value['properties']['pattern'])."]",'disabled'=>$_smarty_tpl->tpl_vars['current_style']->value['is_default']), 0);?>

                            </div>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['position']) {?>
                            <div class="te-advanced-connector"></div>
                            <div class="te-bg-position clearfix">
                            <span class="te-bg-title"><?php echo $_smarty_tpl->__("theme_editor.position");?>
&nbsp;</span>
                                <div class="sse-bg-position-main-wrap clearfix">
                                    <div class="te-bg-position-wrap clearfix">
                                        <div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="top_left" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="top left" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="top left") {?>checked="checked"<?php }?> /><label for="top_left"><i class="glyph-arrow-up-left"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="top_center" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="top center" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="top center") {?>checked="checked"<?php }?> /><label for="top_center"><i class="glyph-arrow-up"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="top_right" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="top right" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="top right") {?>checked="checked"<?php }?> /><label for="top_right"><i class="glyph-arrow-up-right"></i></label></div>
                                    </div>
                                    <div class="te-bg-position-wrap clearfix">
                                        <div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="center_left" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" if="center_left" value="center left" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="center left") {?>checked="checked"<?php }?> /><label for="center_left"><i class="glyph-arrow-left"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="center_center" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="center center" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="center center") {?>checked="checked"<?php }?> /><label for="center_center"><i class="glyph-square"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="center_right" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="center right" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="center right") {?>checked="checked"<?php }?> /><label for="center_right"><i class="glyph-arrow-right"></i></label></div>
                                    </div>
                                    <div class="te-bg-position-wrap clearfix">
                                        <div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="bottom_left" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="bottom left" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="bottom left") {?>checked="checked"<?php }?> /><label for="bottom_left"><i class="glyph-arrow-down-left"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="bottom_center" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="bottom center" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="bottom center") {?>checked="checked"<?php }?> /><label for="bottom_center"><i class="glyph-arrow-down"></i></label></div><div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="bottom_right" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['position'], ENT_QUOTES, 'UTF-8');?>
]" value="bottom right" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['position']]=="bottom right") {?>checked="checked"<?php }?> /><label for="bottom_right"><i class="glyph-arrow-down-right"></i></label></div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['repeat']) {?>
                        <div>
                            <?php $_smarty_tpl->_capture_stack[0][] = array("repeat_content", null, null); ob_start(); ?>
                                <input type="text" class="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['repeat'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['repeat']])===null||$tmp==='' ? "repeat" : $tmp), ENT_QUOTES, 'UTF-8');?>
">
                                <ul class="te-select-dropdown">
                                    <li data-ca-select-box-value="repeat" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['repeat']]=="repeat") {?>class="active" <?php $_smarty_tpl->tpl_vars['repeat_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.repeat"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.repeat");?>
</li>
                                    <li data-ca-select-box-value="repeat-x" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['repeat']]=="repeat-x") {?>class="active" <?php $_smarty_tpl->tpl_vars['repeat_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.repeat_x"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.repeat_x");?>
</li>
                                    <li data-ca-select-box-value="repeat-y" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['repeat']]=="repeat-y") {?>class="active" <?php $_smarty_tpl->tpl_vars['repeat_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.repeat_y"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.repeat_y");?>
</li>
                                    <li data-ca-select-box-value="no-repeat" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['repeat']]=="no-repeat") {?>class="active" <?php $_smarty_tpl->tpl_vars['repeat_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.no_repeat"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.no_repeat");?>
</li>
                                </ul>
                            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                            <div class="te-select-box cm-te-selectbox cm-te-value-changer" tabindex="0"><span><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['repeat_title']->value)===null||$tmp==='' ? $_smarty_tpl->__("theme_editor.repeat") : $tmp), ENT_QUOTES, 'UTF-8');?>
</span><i class="ty-icon-d-arrow"></i>
                                <?php echo Smarty::$_smarty_vars['capture']['repeat_content'];?>

                            </div>
                        </div>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['field']->value['properties']['attachment']) {?>
                        <div>
                            <?php $_smarty_tpl->_capture_stack[0][] = array("scroll_content", null, null); ob_start(); ?>
                                <input type="text" class="hidden" name="style[data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['field']->value['properties']['attachment'], ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['attachment']])===null||$tmp==='' ? "scroll" : $tmp), ENT_QUOTES, 'UTF-8');?>
">
                                <ul class="te-select-dropdown">
                                    <li data-ca-select-box-value="scroll" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['attachment']]=="scroll") {?>class="active" <?php $_smarty_tpl->tpl_vars['scroll_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.scroll"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.scroll");?>
</li>
                                    <li data-ca-select-box-value="fixed" <?php if ($_smarty_tpl->tpl_vars['current_style']->value['data'][$_smarty_tpl->tpl_vars['field']->value['properties']['attachment']]=="fixed") {?>class="active" <?php $_smarty_tpl->tpl_vars['scroll_title'] = new Smarty_variable($_smarty_tpl->__("theme_editor.fixed"), null, 0);
}?>><?php echo $_smarty_tpl->__("theme_editor.fixed");?>
</li>
                                </ul>
                            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                            <div class="te-select-box cm-te-selectbox cm-te-value-changer" tabindex="0"><span><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['scroll_title']->value)===null||$tmp==='' ? $_smarty_tpl->__("theme_editor.scroll") : $tmp), ENT_QUOTES, 'UTF-8');?>
</span><i class="ty-icon-d-arrow"></i>
                                <?php echo Smarty::$_smarty_vars['capture']['scroll_content'];?>

                            </div>
                        </div>
                        <?php }?>
                    </div>

                </div>
            </div>
            <?php } ?>
        </div>

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset"><?php echo $_smarty_tpl->__("theme_editor.reset_backgrounds");?>
</button></div>

    <!--te_backgrounds--></div>
    <?php }?>
<?php } else { ?>
    <div class="te-wrap te-css cm-te-section">
        <div class="te-inner-wrap">
            <div id="css_content" class="cm-te-css-editor"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['css_content']->value, ENT_QUOTES, 'UTF-8');?>
</div>
        </div>

        <div class="te-reset-wrap te-enable-less-container">
            <button class="te-btn cm-te-restore-less"><?php echo $_smarty_tpl->__("theme_editor.enable_less");?>
</button>
            <span class="te-warning-info"><?php echo $_smarty_tpl->__("theme_editor.warning_css_changes_will_be_reverted");?>
</span>
        </div>

    </div>

<?php }?>
</div>
</div>


</div>

</form>
<!--theme_editor--></div>
<?php }?><?php }} ?>
