<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:53
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\block_manager\components\update_layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1935655795daf1da1804f08-23931601%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '485fbe39c531674e673300555843ab99a898a373' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\block_manager\\components\\update_layout.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '1935655795daf1da1804f08-23931601',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'layout_data' => 0,
    'id' => 0,
    'default_layouts_sources' => 0,
    'layout_source' => 0,
    'themes' => 0,
    'all_layouts' => 0,
    'layout' => 0,
    'theme_manifest' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1da1c59912_09562767',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1da1c59912_09562767')) {function content_5daf1da1c59912_09562767($_smarty_tpl) {?><?php if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('block_manager.forbid_changing_layout_in_css_mode','general','name','copy_from_layout','restore_original','default','block_manager.grid_columns','block_manager.layout_width','block_manager.fixed_layout','block_manager.fluid_layout','block_manager.full_width_layout','block_manager.min_width','block_manager.max_width','delete'));
?>
<?php if ($_smarty_tpl->tpl_vars['layout_data']->value) {?>
    <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable($_smarty_tpl->tpl_vars['layout_data']->value['layout_id'], null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable(0, null, 0);?>
<?php }?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
Tygh.tr({
    'block_manager.forbid_changing_layout_in_css_mode': '<?php echo strtr($_smarty_tpl->__("block_manager.forbid_changing_layout_in_css_mode",array("[url]"=>fn_url("customization.update_mode?type=theme_editor&status=enable&s_layout=".((string)$_smarty_tpl->tpl_vars['id']->value)))), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
',
});
<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" enctype="multipart/form-data" name="update_layout_form" class="form-horizontal form-edit ">
<input type="hidden" name="layout_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">

<div class="add-new-object-group">
    <div class="tabs cm-j-tabs">
        <ul class="nav nav-tabs">
            <li id="tab_update_layout_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-js active"><a><?php echo $_smarty_tpl->__("general");?>
</a></li>
        </ul>
    </div>

    <div class="cm-tabs-content" id="content_tab_update_layout_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">
    <fieldset>
        <div class="control-group">
            <label class="control-label cm-required" for="elm_layout_name_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("name");?>
</label>
            <div class="controls">
                <input type="text" id="elm_layout_name_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" name="layout_data[name]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout_data']->value['name'], ENT_QUOTES, 'UTF-8');?>
" />
            </div>
        </div>
        
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"block_manager:change_layout_param")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"block_manager:change_layout_param"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"block_manager:change_layout_param"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


        <?php if (!$_smarty_tpl->tpl_vars['id']->value) {?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"block_manager:update_layout_copy")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"block_manager:update_layout_copy"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <div class="control-group">
            <label class="control-label cm-required" for="elm_layout_copy_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("copy_from_layout");?>
</label>
            <div class="controls">
                <select name="layout_data[from_layout_id]" id="elm_layout_copy_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <?php  $_smarty_tpl->tpl_vars["layout_source"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["layout_source"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['default_layouts_sources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["layout_source"]->key => $_smarty_tpl->tpl_vars["layout_source"]->value) {
$_smarty_tpl->tpl_vars["layout_source"]->_loop = true;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout_source']->value['theme_name'], ENT_QUOTES, 'UTF-8');?>
|<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout_source']->value['filename'], ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("restore_original");?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['themes']->value['installed'][$_smarty_tpl->tpl_vars['layout_source']->value['theme_name']]['title'], ENT_QUOTES, 'UTF-8');?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout_source']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                    <?php  $_smarty_tpl->tpl_vars["layout"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["layout"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['all_layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["layout"]->key => $_smarty_tpl->tpl_vars["layout"]->value) {
$_smarty_tpl->tpl_vars["layout"]->_loop = true;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout']->value['layout_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['themes']->value['installed'][$_smarty_tpl->tpl_vars['layout']->value['theme_name']]['title'], ENT_QUOTES, 'UTF-8');?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['layout']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"block_manager:update_layout_copy"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }?>

        <div class="control-group">
            <label class="control-label" for="elm_layout_is_default_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("default");?>
</label>
            <div class="controls">
                <input type="checkbox" id="elm_layout_is_default_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" name="layout_data[is_default]" value="1" <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['is_default']) {?>checked="checked" disabled="disabled"<?php }?> />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="elm_layout_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("block_manager.grid_columns");?>
</label>
            <div class="controls">
                <select name="layout_data[width]" id="elm_layout_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <option value="12" <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['width']=="12") {?>selected="selected"<?php }?>>12</option>
                    <option value="16" <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['width']=="16"||!$_smarty_tpl->tpl_vars['layout_data']->value['width']) {?>selected="selected"<?php }?>>16</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="elm_layout_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("block_manager.layout_width");?>
</label>
            <div class="controls">
                <select name="layout_data[layout_width]" id="elm_layout_type_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">
                    <option value="fixed" <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['layout_width']=="fixed") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("block_manager.fixed_layout");?>
</option>
                    <option value="fluid" <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['layout_width']=="fluid") {?>selected="selected"<?php }?> ><?php echo $_smarty_tpl->__("block_manager.fluid_layout");?>
</option>
                    <option value="full_width" <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['layout_width']=="full_width") {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__("block_manager.full_width_layout");?>
</option>
                </select>
            </div>
        </div>

        <div id="fluid_layout_settings_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['layout_width']!="fluid") {?>class="hidden"<?php }?>>
            <div class="control-group">
                <label class="control-label" for="elm_min_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("block_manager.min_width");?>
</label>
                <div class="controls">
                    <input type="text" id="elm_min_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" name="layout_data[min_width]" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['layout_data']->value['min_width'])===null||$tmp==='' ? 760 : $tmp), ENT_QUOTES, 'UTF-8');?>
" />
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="elm_max_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("block_manager.max_width");?>
</label>
                <div class="controls">
                    <input type="text" id="elm_max_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" name="layout_data[max_width]" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['layout_data']->value['max_width'])===null||$tmp==='' ? 960 : $tmp), ENT_QUOTES, 'UTF-8');?>
" />
                </div>
            </div>
        </div>

    </fieldset>
    </div>
</div>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
    (function(_, $) {
        var is_theme_converted_to_css = !!parseInt('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['theme_manifest']->value['converted_to_css'], ENT_QUOTES, 'UTF-8');?>
'),
            prev_value;

        $("#elm_layout_type_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
").one('focus', function() {
            prev_value = this.value;
        }).change(function(){
            if (is_theme_converted_to_css) {
                $.ceNotification('show', {
                    type: 'E',
                    title: _.tr('error'),
                    message: _.tr('block_manager.forbid_changing_layout_in_css_mode'),
                });
                this.value = prev_value;
            } else {
                if(this.value == "fluid") {
                    $("#fluid_layout_settings_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
").removeClass('hidden');
                } else {
                    $("#fluid_layout_settings_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
").addClass('hidden');
                }
            }
        });
    }(Tygh, Tygh.$));
<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<div class="buttons-container">
    <?php if ($_smarty_tpl->tpl_vars['id']->value&&!$_smarty_tpl->tpl_vars['layout_data']->value['is_default']) {?>
        <a href="<?php echo htmlspecialchars(fn_url("block_manager.delete_layout?layout_id=".((string)$_smarty_tpl->tpl_vars['layout_data']->value['layout_id'])), ENT_QUOTES, 'UTF-8');?>
" class="cm-confirm cm-post pull-left btn cm-tooltip" title="<?php echo $_smarty_tpl->__("delete");?>
"><i class="icon-trash"></i></a>
    <?php }?>
    <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[block_manager.update_layout]",'cancel_action'=>"close",'save'=>$_smarty_tpl->tpl_vars['id']->value), 0);?>

</div>

</form>
<?php }} ?>
