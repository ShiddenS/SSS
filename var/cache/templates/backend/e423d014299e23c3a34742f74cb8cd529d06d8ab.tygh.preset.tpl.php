<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:44:08
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\advanced_import\views\import_presets\components\preset.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7152174805daf23c8634d29-80769798%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e423d014299e23c3a34742f74cb8cd529d06d8ab' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\advanced_import\\views\\import_presets\\components\\preset.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '7152174805daf23c8634d29-80769798',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'preset' => 0,
    'preview_preset_id' => 0,
    'settings' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf23c91e5945_83452838',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf23c91e5945_83452838')) {function content_5daf23c91e5945_83452838($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.enum.php';
if (!is_callable('smarty_modifier_date_format')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.date_format.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('name','import','import','advanced_import.uploading_file','select_file','upload','preview','advanced_import.previewing_fields_mapping','advanced_import.last_launch','advanced_import.never','advanced_import.last_status','advanced_import.last_status.','text_exim_data_imported','advanced_import.file','error_file_not_found','advanced_import.user_upload','advanced_import.has_modifiers','yes','no','edit','delete'));
?>
<tr class="import-preset" id="preset_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset_id'], ENT_QUOTES, 'UTF-8');?>
">
    <td class="left import-preset__checker mobile-hide">
        <input type="checkbox"
               name="preset_ids[]"
               value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset_id'], ENT_QUOTES, 'UTF-8');?>
"
               class="cm-item"
        />
    </td>

    <td class="import-preset__preset" data-th="<?php echo $_smarty_tpl->__("name");?>
">
        <a href="<?php echo htmlspecialchars(fn_url("import_presets.update?preset_id=".((string)$_smarty_tpl->tpl_vars['preset']->value['preset_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset'], ENT_QUOTES, 'UTF-8');?>
</a>
        <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/company_name.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('object'=>$_smarty_tpl->tpl_vars['preset']->value), 0);?>

    </td>

    <td class="import-preset__run">
        <?php if ($_smarty_tpl->tpl_vars['preset']->value['file_type']==smarty_modifier_enum("Addons\\AdvancedImport\\PresetFileTypes::SERVER")&&$_smarty_tpl->tpl_vars['preset']->value['file_path']||$_smarty_tpl->tpl_vars['preset']->value['file_type']==smarty_modifier_enum("Addons\\AdvancedImport\\PresetFileTypes::URL")) {?>
            <a href="<?php echo htmlspecialchars(fn_url("advanced_import.import?preset_id=".((string)$_smarty_tpl->tpl_vars['preset']->value['preset_id'])), ENT_QUOTES, 'UTF-8');?>
"
               class="btn cm-ajax cm-comet cm-post"
            ><?php echo $_smarty_tpl->__("import");?>
</a>
        <?php } elseif ($_smarty_tpl->tpl_vars['preset']->value['file_type']==smarty_modifier_enum("Addons\\AdvancedImport\\PresetFileTypes::LOCAL")) {?>
            <?php smarty_template_function_btn($_smarty_tpl,array('type'=>"dialog",'text'=>$_smarty_tpl->__("import"),'class'=>"btn",'target_id'=>"import_preset_file_upload_".((string)$_smarty_tpl->tpl_vars['preset']->value['preset_id'])));?>


            <?php $_smarty_tpl->_capture_stack[0][] = array("popups", null, null); ob_start(); ?>
                <?php echo Smarty::$_smarty_vars['capture']['popups'];?>


                <input type="hidden" name="preset_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset_id'], ENT_QUOTES, 'UTF-8');?>
">
                <div class="hidden form-horizontal form-edit import-preset__fileuploader-form"
                     title="<?php echo $_smarty_tpl->__("advanced_import.uploading_file",array("[preset]"=>$_smarty_tpl->tpl_vars['preset']->value['preset']));?>
"
                     id="import_preset_file_upload_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset_id'], ENT_QUOTES, 'UTF-8');?>
"
                >
                    <div class="control-group">
                        <label class="control-label"><?php echo $_smarty_tpl->__("select_file");?>
:</label>
                        <div class="controls">
                            <?php echo $_smarty_tpl->getSubTemplate ("addons/advanced_import/views/import_presets/components/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"upload[".((string)$_smarty_tpl->tpl_vars['preset']->value['preset_id'])."]",'prefix'=>$_smarty_tpl->tpl_vars['preset']->value['preset_id'],'allowed_ext'=>array("csv","xml")), 0);?>

                        </div>
                    </div>
                    <div class="buttons-container">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('cancel_action'=>"close",'but_text'=>$_smarty_tpl->__("upload"),'but_meta'=>"cm-ajax cm-comet cm-post",'but_name'=>"dispatch[import_presets.upload]"), 0);?>

                    </div>
                <!--import_preset_file_upload_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset_id'], ENT_QUOTES, 'UTF-8');?>
--></div>
            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['preview_preset_id']->value==$_smarty_tpl->tpl_vars['preset']->value['preset_id']) {?>
            <?php ob_start();
echo htmlspecialchars(fn_url("import_presets.get_fields.import?preset_id=".((string)$_smarty_tpl->tpl_vars['preset']->value['preset_id'])), ENT_QUOTES, 'UTF-8');
$_tmp1=ob_get_clean();?><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"dialog",'text'=>$_smarty_tpl->__("preview"),'class'=>"cm-dialog-auto-width hidden import-preset__preview-fields-mapping",'href'=>$_tmp1,'target_id'=>"import_preset_fields_mapping_".((string)$_smarty_tpl->tpl_vars['preset']->value['preset_id']),'id'=>"import_preset_preview_fields_mapping_".((string)$_smarty_tpl->tpl_vars['preset']->value['preset_id'])));?>


            <div class="hidden form-horizontal form-edit import-preset__fields-mapping"
                 title="<?php echo $_smarty_tpl->__("advanced_import.previewing_fields_mapping",array("[preset]"=>$_smarty_tpl->tpl_vars['preset']->value['preset']));?>
"
                 id="import_preset_fields_mapping_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset_id'], ENT_QUOTES, 'UTF-8');?>
"
            >
            <!--import_preset_fields_mapping_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset_id'], ENT_QUOTES, 'UTF-8');?>
--></div>
        <?php }?>
    </td>

    <td class="import-preset__last-launch" data-th="<?php echo $_smarty_tpl->__("advanced_import.last_launch");?>
">
        <?php if ($_smarty_tpl->tpl_vars['preset']->value['last_launch']) {?>
            <?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['preset']->value['last_launch'],((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['date_format']).", ".((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['time_format'])), ENT_QUOTES, 'UTF-8');?>

        <?php } else { ?>
            <?php echo $_smarty_tpl->__("advanced_import.never");?>

        <?php }?>
    </td>

    <td class="import-preset__last-status" data-th="<?php echo $_smarty_tpl->__("advanced_import.last_status");?>
">
        <span class="status--<?php echo htmlspecialchars(mb_strtolower($_smarty_tpl->tpl_vars['preset']->value['last_status'], 'UTF-8'), ENT_QUOTES, 'UTF-8');?>
">
            <?php echo $_smarty_tpl->__("advanced_import.last_status.".((string)$_smarty_tpl->tpl_vars['preset']->value['last_status']));?>

            <?php if ($_smarty_tpl->tpl_vars['preset']->value['last_status']==smarty_modifier_enum("Addons\\AdvancedImport\\ImportStatuses::SUCCESS")) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("text_exim_data_imported",array("[new]"=>$_smarty_tpl->tpl_vars['preset']->value['last_result']['N'],"[exist]"=>$_smarty_tpl->tpl_vars['preset']->value['last_result']['E'],"[skipped]"=>$_smarty_tpl->tpl_vars['preset']->value['last_result']['S'],"[total]"=>$_smarty_tpl->tpl_vars['preset']->value['last_result']['N']+$_smarty_tpl->tpl_vars['preset']->value['last_result']['E']+$_smarty_tpl->tpl_vars['preset']->value['last_result']['S']))), 0);?>

            <?php } elseif ($_smarty_tpl->tpl_vars['preset']->value['last_status']==smarty_modifier_enum("Addons\\AdvancedImport\\ImportStatuses::FAIL")&&is_array($_smarty_tpl->tpl_vars['preset']->value['last_result']['msg'])) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>implode($_smarty_tpl->tpl_vars['preset']->value['last_result']['msg'],"<br>")), 0);?>

            <?php }?>
        </span>
    </td>

    <td class="import-preset__file" data-th="<?php echo $_smarty_tpl->__("advanced_import.file");?>
">
        <?php if ($_smarty_tpl->tpl_vars['preset']->value['file_type']==smarty_modifier_enum("Addons\\AdvancedImport\\PresetFileTypes::URL")) {?>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['file'], ENT_QUOTES, 'UTF-8');?>
" target="_blank"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['file'], ENT_QUOTES, 'UTF-8');?>
</a>
        <?php } elseif ($_smarty_tpl->tpl_vars['preset']->value['file_type']==smarty_modifier_enum("Addons\\AdvancedImport\\PresetFileTypes::SERVER")) {?>
            <?php if ($_smarty_tpl->tpl_vars['preset']->value['file_path']) {?>
                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['file'], ENT_QUOTES, 'UTF-8');?>

            <?php } else { ?>
                <span class="type-error"><?php echo $_smarty_tpl->__("error_file_not_found",array("[file]"=>$_smarty_tpl->tpl_vars['preset']->value['file']));?>
</span>
            <?php }?>
        <?php } elseif ($_smarty_tpl->tpl_vars['preset']->value['file']) {?>
            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['file'], ENT_QUOTES, 'UTF-8');?>

        <?php } else { ?>
            <?php echo $_smarty_tpl->__("advanced_import.user_upload");?>

        <?php }?>
    </td>

    <td class="import-preset__has-modifiers" data-th="<?php echo $_smarty_tpl->__("advanced_import.has_modifiers");?>
">
        <?php if ((($tmp = @$_smarty_tpl->tpl_vars['preset']->value['has_modifiers'])===null||$tmp==='' ? 0 : $tmp)) {?>
            <?php echo $_smarty_tpl->__("yes");?>

        <?php } else { ?>
            <?php echo $_smarty_tpl->__("no");?>

        <?php }?>
    </td>

    <td class="import-preset__tools">
        <div class="hidden-tools">
            <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"advanced_import:preset_list_extra_links")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"advanced_import:preset_list_extra_links"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("edit"),'href'=>"import_presets.update?preset_id=".((string)$_smarty_tpl->tpl_vars['preset']->value['preset_id'])));?>
</li>
                    <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>$_smarty_tpl->__("delete"),'class'=>"cm-confirm",'href'=>"import_presets.delete?preset_id=".((string)$_smarty_tpl->tpl_vars['preset']->value['preset_id']),'method'=>"POST"));?>
</li>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"advanced_import:preset_list_extra_links"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list']));?>

        </div>
    </td>
<!--preset_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset_id'], ENT_QUOTES, 'UTF-8');?>
--></tr><?php }} ?>
