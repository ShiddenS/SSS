<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:25:33
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\advanced_import\views\import_presets\update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8065639885daf1f6d82a2d7-65328014%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb4c89767cc0a654f44cba89cf4dacb99dd0d76b' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\advanced_import\\views\\import_presets\\update.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '8065639885daf1f6d82a2d7-65328014',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'preset' => 0,
    'start_import' => 0,
    'id' => 0,
    'auth' => 0,
    'runtime' => 0,
    'config' => 0,
    'images_path' => 0,
    'auto_delimiter' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1f6da299e9_01243328',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1f6da299e9_01243328')) {function content_5daf1f6da299e9_01243328($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.enum.php';
if (!is_callable('smarty_modifier_to_json')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.to_json.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('advanced_import.run_import_via_cron_message','advanced_import.general_settings','file','name','images_directory','file_editor','text_file_editor_notice_full_link','advanced_import.additional_settings','csv_delimiter','import','import','save','create','advanced_import.general_settings','advanced_import.additional_settings','advanced_import.editing_preset','advanced_import.new_preset'));
?>
<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("tabsbox", null, null); ob_start(); ?>

        <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['preset']->value['preset_id'])===null||$tmp==='' ? 0 : $tmp), null, 0);?>

        <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
"
              method="post"
              name="import_preset_update_form"
              id="import_preset_update_form"
              enctype="multipart/form-data"
              class="form-horizontal form-edit<?php if ($_smarty_tpl->tpl_vars['start_import']->value) {?> cm-ajax cm-comet<?php }?> import-preset-edit"
              data-ca-advanced-import-element="editor"
              data-ca-advanced-import-preset-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"
              data-ca-advanced-import-preset-object-type="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['object_type'], ENT_QUOTES, 'UTF-8');?>
"
              data-ca-advanced-import-preset-name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset'], ENT_QUOTES, 'UTF-8');?>
"
        >

            <input type="hidden" name="preset_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"/>
            <input type="hidden" name="result_ids" value="content_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"/>
            <input type="hidden" name="object_type" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['object_type'], ENT_QUOTES, 'UTF-8');?>
"/>
            <?php if ($_smarty_tpl->tpl_vars['start_import']->value) {?>
                <input type="hidden" name="return_url" value="<?php echo htmlspecialchars("import_presets.update&preset_id=".((string)$_smarty_tpl->tpl_vars['id']->value), ENT_QUOTES, 'UTF-8');?>
"/>
            <?php }?>

            <div id="content_general">

                
                <?php if ($_smarty_tpl->tpl_vars['preset']->value['file']&&$_smarty_tpl->tpl_vars['auth']->value['is_root']=="Y"&&(!$_smarty_tpl->tpl_vars['runtime']->value['company_id']||$_smarty_tpl->tpl_vars['runtime']->value['simple_ultimate'])) {?>
                    <p><?php echo $_smarty_tpl->__("advanced_import.run_import_via_cron_message");?>
</p>
		    <pre><code><?php ob_start();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
<?php $_tmp1=ob_get_clean();?><?php echo htmlspecialchars(fn_get_console_command("php /path/to/cart/",$_smarty_tpl->tpl_vars['config']->value['admin_index'],array("dispatch"=>"advanced_import.import.import","preset_id"=>$_tmp1,"p")), ENT_QUOTES, 'UTF-8');?>
</code></pre>
                <?php }?>

                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("advanced_import.general_settings"),'target'=>"#information"), 0);?>


                <div id="information" class="in collapse">

                    <div class="control-group">
                        <input type="hidden"
                               data-ca-advanced-import-element="file_type"
                               name="file_type"
                               value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['preset']->value['file_type'])===null||$tmp==='' ? (smarty_modifier_enum("Addons\\AdvancedImport\\PresetFileTypes::LOCAL")) : $tmp), ENT_QUOTES, 'UTF-8');?>
"
                        />
                        <input type="hidden"
                               name="file"
                               data-ca-advanced-import-element="file"
                               value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['preset']->value['file'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
"
                        />
                        <label class="control-label"><?php echo $_smarty_tpl->__("file");?>
:</label>
                        <div class="controls import-preset__fileuploader">
                            <?php echo $_smarty_tpl->getSubTemplate ("addons/advanced_import/views/import_presets/components/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"upload[]",'prefix'=>$_smarty_tpl->tpl_vars['id']->value,'allowed_ext'=>array("csv","xml")), 0);?>

                        </div>
                    </div>

                    <div class="control-group <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['options']['target_node']['control_group_meta'], ENT_QUOTES, 'UTF-8');?>
" data-ca-default-hidden="<?php if ($_smarty_tpl->tpl_vars['preset']->value['file']) {?>false<?php } else { ?>true<?php }?>">
                        <label for="target_node" class="control-label">
                            <?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['preset']->value['options']['target_node']['title']);
if ($_smarty_tpl->tpl_vars['preset']->value['options']['target_node']['description']) {
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__($_smarty_tpl->tpl_vars['preset']->value['options']['target_node']['description'])), 0);
}?>:
                        </label>
                        <div class="controls">
                            <input class="input-large"
                                   type="text"
                                   name="options[target_node]"
                                   id="target_node"
                                   size="55"
                                   value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['preset']->value['options']['target_node']['selected_value'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['preset']->value['options']['target_node']['default_value'] : $tmp), ENT_QUOTES, 'UTF-8');?>
"
                            />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="elm_preset" class="control-label cm-required"><?php echo $_smarty_tpl->__("name");?>
:</label>
                        <div class="controls">
                            <input class="input-large"
                                   type="text"
                                   name="preset"
                                   id="elm_preset"
                                   size="55"
                                   value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['preset'], ENT_QUOTES, 'UTF-8');?>
"
                            />
                        </div>
                    </div>

                    <div class="control-group">
                        <?php $_smarty_tpl->tpl_vars['images_path'] = new Smarty_variable($_smarty_tpl->tpl_vars['preset']->value['options']['images_path'], null, 0);?>
                        <label for="images_path" class="control-label"><?php echo $_smarty_tpl->__("images_directory");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__($_smarty_tpl->tpl_vars['images_path']->value['description'])), 0);?>
:</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on" id="advanced_import_images_path_prefix" data-companies-image-directories="<?php echo htmlspecialchars(smarty_modifier_to_json($_smarty_tpl->tpl_vars['images_path']->value['companies_image_directories']), ENT_QUOTES, 'UTF-8');?>
">
                                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['images_path']->value['input_prefix'], ENT_QUOTES, 'UTF-8');?>

                                </span>

                                <input id="images_path"
                                       class="input-large prefixed"
                                       type="text"
                                       name="options[images_path]"
                                       value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['images_path']->value['display_value'], ENT_QUOTES, 'UTF-8');?>
"
                                />
                            </div>

                            <div id="images_path_dialog" class="hidden"></div>
                            <p class="muted"><?php ob_start();
echo $_smarty_tpl->__("file_editor");
$_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->__("text_file_editor_notice_full_link",array("[link]"=>"<a class=\"advanced-import-file-editor-opener\" data-target-input-id=\"images_path\">".$_tmp2."</a>"));?>
</p>
                        </div>
                    </div>

                    <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/company_field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('name'=>"company_id",'id'=>"elm_company_id",'selected'=>$_smarty_tpl->tpl_vars['preset']->value['company_id'],'js_action'=>"$".".ceAdvancedImport('changeCompanyId');"), 0);?>

                </div>

                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("advanced_import.additional_settings"),'target'=>"#import_file",'meta'=>"collapsed"), 0);?>


                <div id="import_file" class="out collapse">

                    <div class="control-group">
                        <label class="control-label"><?php echo $_smarty_tpl->__("csv_delimiter");?>
:</label>
                        <div class="controls" data-ca-advanced-import-element="delimiter_container">
                            <?php $_smarty_tpl->tpl_vars['auto_delimiter'] = new Smarty_variable(smarty_modifier_enum("Addons\AdvancedImport\CsvDelimiters::AUTO"), null, 0);?>
                            <?php ob_start();
echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['preset']->value['options']['delimiter'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['auto_delimiter']->value : $tmp), ENT_QUOTES, 'UTF-8');
$_tmp3=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("views/exim/components/csv_delimiters.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('name'=>"options[delimiter]",'value'=>$_tmp3,'allow_auto_detect'=>true), 0);?>

                        </div>
                    </div>

                    <?php echo $_smarty_tpl->getSubTemplate ("addons/advanced_import/views/import_presets/components/options.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('options'=>(($tmp = @$_smarty_tpl->tpl_vars['preset']->value['options'])===null||$tmp==='' ? array() : $tmp),'field_name_prefix'=>"options",'display'=>true,'tab'=>"general"), 0);?>


                    <?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
                        <?php if ($_smarty_tpl->tpl_vars['start_import']->value) {?>
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("import"),'but_role'=>"action",'but_id'=>"advanced_import_start_import",'but_meta'=>"cm-submit hidden cm-advanced-import-start-import",'but_target_form'=>"import_preset_update_form",'but_name'=>"dispatch[advanced_import.import]"), 0);?>

                        <?php }?>
                        <?php ob_start();
echo $_smarty_tpl->__("import");
$_tmp4=ob_get_clean();?><?php ob_start();
if (!$_smarty_tpl->tpl_vars['id']->value) {?><?php echo " hidden";?><?php }
$_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_tmp4,'but_role'=>"action",'but_id'=>"advanced_import_save_and_import",'but_name'=>"dispatch[import_presets.update.import]",'but_target_form'=>"import_preset_update_form",'but_meta'=>"cm-submit btn-primary".$_tmp5), 0);?>

                        <?php ob_start();
if ($_smarty_tpl->tpl_vars['id']->value) {?><?php echo $_smarty_tpl->__("save");?>
<?php } else { ?><?php echo $_smarty_tpl->__("create");?>
<?php }
$_tmp6=ob_get_clean();?><?php ob_start();
if (!$_smarty_tpl->tpl_vars['id']->value) {?><?php echo " btn-primary";?><?php }
$_tmp7=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_tmp6,'but_role'=>"action",'but_name'=>"dispatch[import_presets.update]",'but_target_form'=>"import_preset_update_form",'but_meta'=>"cm-submit".$_tmp7), 0);?>

                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                </div>

            <!--content_general--></div>

            <div class="hidden" id="content_fields">
            <!--content_fields--></div>

            <div class="hidden" id="content_options">

                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("advanced_import.general_settings"),'target'=>"#settings_general"), 0);?>


                <div id="settings_general" class="out">
                    <?php echo $_smarty_tpl->getSubTemplate ("addons/advanced_import/views/import_presets/components/options.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('options'=>(($tmp = @$_smarty_tpl->tpl_vars['preset']->value['options'])===null||$tmp==='' ? array() : $tmp),'field_name_prefix'=>"options",'display'=>true,'tab'=>"settings",'section'=>"general"), 0);?>

                </div>

                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->__("advanced_import.additional_settings"),'target'=>"#settings_additional",'meta'=>"collapsed"), 0);?>


                <div id="settings_additional" class="out collapse">
                    <?php echo $_smarty_tpl->getSubTemplate ("addons/advanced_import/views/import_presets/components/options.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('options'=>(($tmp = @$_smarty_tpl->tpl_vars['preset']->value['options'])===null||$tmp==='' ? array() : $tmp),'field_name_prefix'=>"options",'display'=>true,'tab'=>"settings",'section'=>"additional"), 0);?>

                </div>
            <!--content_options--></div>

        </form>
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

    <?php echo $_smarty_tpl->getSubTemplate ("common/tabsbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('content'=>Smarty::$_smarty_vars['capture']['tabsbox'],'active_tab'=>"general"), 0);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start(); ?>
    <?php if ((($tmp = @$_smarty_tpl->tpl_vars['preset']->value['preset_id'])===null||$tmp==='' ? 0 : $tmp)) {?>
        <?php echo $_smarty_tpl->__("advanced_import.editing_preset",array("[preset]"=>$_smarty_tpl->tpl_vars['preset']->value['preset']));?>

    <?php } else { ?>
        <?php echo $_smarty_tpl->__("advanced_import.new_preset");?>

    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>Smarty::$_smarty_vars['capture']['mainbox_title'],'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'buttons'=>Smarty::$_smarty_vars['capture']['buttons']), 0);?>

<?php }} ?>
