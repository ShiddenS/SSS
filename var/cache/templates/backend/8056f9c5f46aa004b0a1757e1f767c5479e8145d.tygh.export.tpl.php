<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:18:39
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\exim\export.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6837534255daf1dcfca4447-35708998%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8056f9c5f46aa004b0a1757e1f767c5479e8145d' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\exim\\export.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '6837534255daf1dcfca4447-35708998',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pattern' => 0,
    'r_opt' => 0,
    'export_range' => 0,
    'oname' => 0,
    'p_id' => 0,
    'layouts' => 0,
    'l' => 0,
    'active_layout' => 0,
    'ldelim' => 0,
    'rdelim' => 0,
    'o' => 0,
    'k' => 0,
    'export_langs' => 0,
    'vk' => 0,
    'vi' => 0,
    'override_options' => 0,
    'filename_description' => 0,
    'config' => 0,
    'export_files' => 0,
    'file' => 0,
    'file_name' => 0,
    'c_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1dd01fe556_61896015',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1dd01fe556_61896015')) {function content_5daf1dd01fe556_61896015($_smarty_tpl) {?><?php if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
if (!is_callable('smarty_block_notes')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.notes.php';
if (!is_callable('smarty_function_html_checkboxes')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.html_checkboxes.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.date_format.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('error_exim_layout_required_fields','text_objects_for_export','change_range','delete_range','text_select_range','select','general','layouts','delete','no_items','save_layout','or','clear_fields','save_layout_as','save','export_options','csv_delimiter','output','tt_views_exim_export_output','filename','exported_files','filename','filesize','bytes','download','delete','no_data','exported_files','export','export_data'));
?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
(function(_, $) {
    _.tr('error_exim_layout_missed_fields', '<?php echo strtr($_smarty_tpl->__("error_exim_layout_required_fields"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
');

    $(document).ready(function() {
        $(_.doc).on('click', '#exim_select_range', function(event){
            var pattern_id = $('.nav-tabs li.active').attr('id');
            $(this).attr('href', $(this).attr('href') + '&pattern_id=' + pattern_id);
        });
    });
}(Tygh, Tygh.$));
<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php if ($_smarty_tpl->tpl_vars['pattern']->value['range_options']) {?>
    <?php $_smarty_tpl->tpl_vars["r_opt"] = new Smarty_variable($_smarty_tpl->tpl_vars['pattern']->value['range_options'], null, 0);?>
    <?php $_smarty_tpl->tpl_vars["r_url"] = new Smarty_variable(fn_url("exim.export?section=".((string)$_smarty_tpl->tpl_vars['pattern']->value['section'])."&pattern_id=".((string)$_smarty_tpl->tpl_vars['pattern']->value['pattern_id'])), null, 0);?>
    <?php $_smarty_tpl->tpl_vars["oname"] = new Smarty_variable(mb_strtolower($_smarty_tpl->tpl_vars['r_opt']->value['object_name'], 'UTF-8'), null, 0);?>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('notes', array()); $_block_repeat=true; echo smarty_block_notes(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php if ($_smarty_tpl->tpl_vars['export_range']->value) {?>
        <?php echo $_smarty_tpl->__("text_objects_for_export",array("[total]"=>$_smarty_tpl->tpl_vars['export_range']->value,"[name]"=>$_smarty_tpl->tpl_vars['oname']->value));?>

        <p>
        <a href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['r_opt']->value['selector_url']), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("change_range");?>
 &rsaquo;&rsaquo;</a>&nbsp;&nbsp;&nbsp;<a class="cm-post" href="<?php echo htmlspecialchars(fn_url("exim.delete_range?section=".((string)$_smarty_tpl->tpl_vars['pattern']->value['section'])."&pattern_id=".((string)$_smarty_tpl->tpl_vars['pattern']->value['pattern_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("delete_range");?>
 &rsaquo;&rsaquo;</a>
        </p>
    <?php } else { ?>
        <?php echo $_smarty_tpl->__("text_select_range",array("[name]"=>$_smarty_tpl->tpl_vars['oname']->value));?>
: <a href="<?php echo htmlspecialchars(fn_url("exim.select_range?section=".((string)$_smarty_tpl->tpl_vars['pattern']->value['section'])), ENT_QUOTES, 'UTF-8');?>
" id="exim_select_range"><?php echo $_smarty_tpl->__("select");?>
 &rsaquo;&rsaquo;</a>
    <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_notes(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>

<?php $_smarty_tpl->_capture_stack[0][] = array("tabsbox", null, null); ob_start(); ?>
<?php $_smarty_tpl->tpl_vars["p_id"] = new Smarty_variable($_smarty_tpl->tpl_vars['pattern']->value['pattern_id'], null, 0);?>
<div id="content_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
">
    <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("general")), 0);?>

    <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
_set_layout_form" class="form-horizontal form-edit">
    <input type="hidden" name="section" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pattern']->value['section'], ENT_QUOTES, 'UTF-8');?>
" />
    <input type="hidden" name="layout_data[pattern_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
" />

    <div class="control-group">
        <label class="control-label"><?php echo $_smarty_tpl->__("layouts");?>
:</label>
        <div class="controls">
            <?php if ($_smarty_tpl->tpl_vars['layouts']->value) {?>
                <select name="layout_data[layout_id]" id="s_layout_id_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-submit" data-ca-dispatch="dispatch[exim.set_layout]">
                    <?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['layouts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['l']->value['layout_id'], ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['l']->value['active']=="Y") {
$_smarty_tpl->tpl_vars["active_layout"] = new Smarty_variable($_smarty_tpl->tpl_vars['l']->value, null, 0);?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['l']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("delete"),'but_name'=>"dispatch[exim.delete_layout]",'but_meta'=>"cm-confirm"), 0);?>


            <?php } else { ?>
                <p class="lowercase"><?php echo $_smarty_tpl->__("no_items");?>
</p>
            <?php }?>
        </div>
    </div>

    </form>

    <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
_manage_layout_form" class="cm-ajax cm-comet form-edit form-horizontal cm-disable-check-changes">
    <input type="hidden" name="section" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pattern']->value['section'], ENT_QUOTES, 'UTF-8');?>
" />
    <input type="hidden" name="layout_data[pattern_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
" />
    <input type="hidden" name="layout_data[layout_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['active_layout']->value['layout_id'], ENT_QUOTES, 'UTF-8');?>
" />
    <input type="hidden" name="result_ids" value="content_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
" />

    <?php echo $_smarty_tpl->getSubTemplate ("views/exim/components/selectboxes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>$_smarty_tpl->tpl_vars['pattern']->value['export_fields'],'assigned_ids'=>$_smarty_tpl->tpl_vars['active_layout']->value['cols'],'left_name'=>"layout_data[cols]",'left_id'=>"pattern_".((string)$_smarty_tpl->tpl_vars['p_id']->value),'p_id'=>$_smarty_tpl->tpl_vars['p_id']->value), 0);?>


    <?php if ($_smarty_tpl->tpl_vars['pattern']->value['export_notice']) {?><p><?php echo $_smarty_tpl->tpl_vars['pattern']->value['export_notice'];?>
</p><?php }?>

    <div class="row-fluid shift-top export-save-layout">
        <div class="span6 form-inline">
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[exim.store_layout]",'but_text'=>$_smarty_tpl->__("save_layout")), 0);?>

            <?php echo $_smarty_tpl->__("or");?>
&nbsp;&nbsp;&nbsp;
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("clear_fields"),'but_onclick'=>"Tygh."."$"."('#pattern_".((string)$_smarty_tpl->tpl_vars['p_id']->value)."').moveOptions('#pattern_".((string)$_smarty_tpl->tpl_vars['p_id']->value)."_right', ".((string)$_smarty_tpl->tpl_vars['ldelim']->value)."move_all: true".((string)$_smarty_tpl->tpl_vars['rdelim']->value).");",'but_role'=>"edit"), 0);?>

        </div>
        <div class="span6">
            <div class="form-inline pull-right">
                <label for="layout_data"><?php echo $_smarty_tpl->__("save_layout_as");?>
:</label>
                <input type="text" id="layout_data" class="input-text valign" name="layout_data[name]" value="" />
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[exim.store_layout.save_as]",'but_text'=>$_smarty_tpl->__("save")), 0);?>

            </div>
        </div>
    </div>

    <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("export_options")), 0);?>

    <?php if ($_smarty_tpl->tpl_vars['pattern']->value['options']) {?>
        <?php  $_smarty_tpl->tpl_vars['o'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['o']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pattern']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['o']->key => $_smarty_tpl->tpl_vars['o']->value) {
$_smarty_tpl->tpl_vars['o']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['o']->key;
?>
        <?php if (!$_smarty_tpl->tpl_vars['o']->value['import_only']) {?>
        <div class="control-group">
            <label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
" class="control-label">
                <?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['o']->value['title']);
if ($_smarty_tpl->tpl_vars['o']->value['description']) {
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__($_smarty_tpl->tpl_vars['o']->value['description'])), 0);
}?>:
            </label>
            <div class="controls">
                <?php if ($_smarty_tpl->tpl_vars['o']->value['type']=="checkbox") {?>
                    <input type="hidden" name="export_options[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
]" value="N" />
                    <input id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
" type="checkbox" name="export_options[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
]" value="Y" <?php if ($_smarty_tpl->tpl_vars['o']->value['default_value']=="Y") {?>checked="checked"<?php }?> />
                <?php } elseif ($_smarty_tpl->tpl_vars['o']->value['type']=="input") {?>
                    <input id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
" class="input-large" type="text" name="export_options[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['o']->value['default_value'], ENT_QUOTES, 'UTF-8');?>
" />
                <?php } elseif ($_smarty_tpl->tpl_vars['o']->value['type']=="languages") {?>
                    <div class="checkbox-list shift-input">
                        <?php echo smarty_function_html_checkboxes(array('name'=>"export_options[lang_code]",'options'=>$_smarty_tpl->tpl_vars['export_langs']->value,'selected'=>$_smarty_tpl->tpl_vars['o']->value['default_value'],'columns'=>8),$_smarty_tpl);?>

                    </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['o']->value['type']=="select") {?>
                    <select id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
" name="export_options[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
]">
                    <?php if ($_smarty_tpl->tpl_vars['o']->value['variants_function']) {?>
                        <?php  $_smarty_tpl->tpl_vars['vi'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vi']->_loop = false;
 $_smarty_tpl->tpl_vars['vk'] = new Smarty_Variable;
 $_from = call_user_func($_smarty_tpl->tpl_vars['o']->value['variants_function']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vi']->key => $_smarty_tpl->tpl_vars['vi']->value) {
$_smarty_tpl->tpl_vars['vi']->_loop = true;
 $_smarty_tpl->tpl_vars['vk']->value = $_smarty_tpl->tpl_vars['vi']->key;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vk']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['vk']->value==$_smarty_tpl->tpl_vars['o']->value['default_value']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vi']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php } ?>
                    <?php } else { ?>
                        <?php  $_smarty_tpl->tpl_vars['vi'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vi']->_loop = false;
 $_smarty_tpl->tpl_vars['vk'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['o']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vi']->key => $_smarty_tpl->tpl_vars['vi']->value) {
$_smarty_tpl->tpl_vars['vi']->_loop = true;
 $_smarty_tpl->tpl_vars['vk']->value = $_smarty_tpl->tpl_vars['vi']->key;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vk']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['vk']->value==$_smarty_tpl->tpl_vars['o']->value['default_value']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['vi']->value);?>
</option>
                        <?php } ?>
                    <?php }?>
                    </select>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['o']->value['notes']) {?>
                    <p class="muted"><?php echo $_smarty_tpl->tpl_vars['o']->value['notes'];?>
</p>
                <?php }?>
            </div>
        </div>
        <?php }?>
        <?php } ?>
    <?php }?>
    <?php $_smarty_tpl->tpl_vars["override_options"] = new Smarty_variable($_smarty_tpl->tpl_vars['pattern']->value['override_options'], null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['override_options']->value['delimiter']) {?>
        <input type="hidden" name="export_options[delimiter]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['override_options']->value['delimiter'], ENT_QUOTES, 'UTF-8');?>
" />
    <?php } else { ?>
    <div class="control-group">
        <label class="control-label"><?php echo $_smarty_tpl->__("csv_delimiter");?>
:</label>
        <div class="controls">
            <?php echo $_smarty_tpl->getSubTemplate ("views/exim/components/csv_delimiters.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('name'=>"export_options[delimiter]",'value'=>$_smarty_tpl->tpl_vars['active_layout']->value['options']['delimiter']), 0);?>

        </div>
    </div>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['override_options']->value['output']) {?>
        <input type="hidden" name="export_options[output]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['override_options']->value['output'], ENT_QUOTES, 'UTF-8');?>
" />
    <?php } else { ?>
    <div class="control-group">
        <label for="output" class="control-label"><?php echo $_smarty_tpl->__("output");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("tt_views_exim_export_output")), 0);?>
:</label>
        <div class="controls">
            <?php echo $_smarty_tpl->getSubTemplate ("views/exim/components/csv_output.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('name'=>"export_options[output]",'value'=>$_smarty_tpl->tpl_vars['active_layout']->value['options']['output']), 0);?>

        </div>
    </div>
    <?php }?>
    <div class="control-group">
        <label for="filename" class="control-label"><?php echo $_smarty_tpl->__("filename");?>
:</label>
        <div class="controls">
            <input type="text" name="export_options[filename]" id="filename" size="50" class="input-large" value="<?php if ($_smarty_tpl->tpl_vars['pattern']->value['filename']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['pattern']->value['filename'], ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['l']->value['name'], ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars(smarty_modifier_date_format(@constant('TIME'),"%m%d%Y"), ENT_QUOTES, 'UTF-8');?>
.csv<?php }?>" />
            <?php $_smarty_tpl->tpl_vars["filename_description"] = new Smarty_variable($_smarty_tpl->tpl_vars['pattern']->value['filename_description'], null, 0);?>
            <?php if ($_smarty_tpl->tpl_vars['pattern']->value['filename_description']) {?><p><small><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['filename_description']->value);?>
</small></p><?php }?>

            <p class="muted">
                <?php echo $_smarty_tpl->__('text_file_editor_notice',array("[href]"=>fn_url("file_editor.manage?path=/")));?>

            </p>
        </div>
    </div>
</form>
<!--content_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php echo $_smarty_tpl->getSubTemplate ("common/tabsbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('content'=>Smarty::$_smarty_vars['capture']['tabsbox'],'active_tab'=>$_smarty_tpl->tpl_vars['p_id']->value), 0);?>


<?php $_smarty_tpl->tpl_vars["c_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
<div class="hidden" title="<?php echo $_smarty_tpl->__("exported_files");?>
" id="content_exported_files">
<?php if ($_smarty_tpl->tpl_vars['export_files']->value) {?>
    <div class="table-wrapper">
        <table class="table">
        <thead>
            <tr>
                <th width="70%"><?php echo $_smarty_tpl->__("filename");?>
</th>
                <th width="20%"><?php echo $_smarty_tpl->__("filesize");?>
</th>
                <th width="10%">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['file']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['export_files']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value) {
$_smarty_tpl->tpl_vars['file']->_loop = true;
?>
        <?php $_smarty_tpl->tpl_vars["file_name"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['file']->value['name']), null, 0);?>
        <tr>
            <td>
                <a href="<?php echo htmlspecialchars(fn_url("exim.get_file?filename=".((string)$_smarty_tpl->tpl_vars['file_name']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['file']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a></td>
            <td>
                <?php echo htmlspecialchars(number_format($_smarty_tpl->tpl_vars['file']->value['size']), ENT_QUOTES, 'UTF-8');?>
&nbsp;<?php echo $_smarty_tpl->__("bytes");?>
</td>
            <td class="right">
                <div class="hidden-tools">
                    <a href="<?php echo htmlspecialchars(fn_url("exim.get_file?filename=".((string)$_smarty_tpl->tpl_vars['file_name']->value)), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->__("download");?>
" class="cm-tooltip icon-download"></a>    
                    <a class="cm-ajax cm-confirm cm-post icon-trash cm-tooltip" title="<?php echo $_smarty_tpl->__("delete");?>
" href="<?php echo htmlspecialchars(fn_url("exim.delete_file?filename=".((string)$_smarty_tpl->tpl_vars['file_name']->value)."&redirect_url=".((string)$_smarty_tpl->tpl_vars['c_url']->value)), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="content_exported_files"></a>
                </div>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
<?php } else { ?>
    <p class="no-items"><?php echo $_smarty_tpl->__("no_data");?>
</p>
<?php }?>
<!--content_exported_files--></div>

<?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
        <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"dialog",'text'=>$_smarty_tpl->__("exported_files"),'target_id'=>"content_exported_files"));?>
</li>
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list']));?>


    <div class="cm-tab-tools pull-right shift-left" id="tools_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("export"),'but_name'=>"dispatch[exim.export]",'but_role'=>"submit-link",'but_target_form'=>((string)$_smarty_tpl->tpl_vars['p_id']->value)."_manage_layout_form",'but_meta'=>"cm-tab-tools cm-comet"), 0);?>

        <!--tools_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
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

<?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("export_data"),'buttons'=>Smarty::$_smarty_vars['capture']['buttons'],'content'=>Smarty::$_smarty_vars['capture']['mainbox']), 0);?>


<?php if ($_REQUEST['output']=="D") {?>
<meta http-equiv="Refresh" content="0;URL=<?php echo htmlspecialchars(fn_url("exim.get_file?filename=".((string)$_REQUEST['filename'])), ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>
<?php }} ?>
