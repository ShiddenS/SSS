<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:16:55
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\common\form_file_uploader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7920237975daf1d672ace45-98338455%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a761bfe25bff1def627b12ffcf539a837623ffd' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\common\\form_file_uploader.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '7920237975daf1d672ace45-98338455',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'image_object_id' => 0,
    'thumbnail_width' => 0,
    'thumbnail_height' => 0,
    'server_env' => 0,
    'existing_pairs' => 0,
    'pair' => 0,
    'existing_files' => 0,
    'template_id' => 0,
    'file_name' => 0,
    'upload_max_filesize' => 0,
    'post_max_size' => 0,
    'image_pair_types' => 0,
    'allow_update_files' => 0,
    'object_id' => 0,
    'upload_file_text' => 0,
    'breadcrumbs' => 0,
    'hide_server' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d67a6ff87_10279695',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d67a6ff87_10279695')) {function content_5daf1d67a6ff87_10279695($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sizeof')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.sizeof.php';
if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('drop_images_to_upload','or','drop_images_select_short','drop_images_select','add_image_from_server','add_image_from_url','delete_all_images','alternative_text','preview','remove','image_has_been_deleted','recover','url','cannot_upload_file'));
?>
<?php $_smarty_tpl->tpl_vars['object_id'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['image_object_id']->value)===null||$tmp==='' ? "0" : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['template_id'] = new Smarty_variable(uniqid("fileupload_template_"), null, 0);?>
<?php $_smarty_tpl->tpl_vars['thumbnail_width'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['thumbnail_width']->value)===null||$tmp==='' ? 250 : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['thumbnail_height'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['thumbnail_height']->value)===null||$tmp==='' ? 250 : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['post_max_size'] = new Smarty_variable(fn_return_bytes($_smarty_tpl->tpl_vars['server_env']->value->getIniVar("post_max_size"))/(1024*1024), null, 0);?>
<?php $_smarty_tpl->tpl_vars['upload_max_filesize'] = new Smarty_variable(fn_return_bytes($_smarty_tpl->tpl_vars['server_env']->value->getIniVar("upload_max_filesize"))/(1024*1024), null, 0);?>
<?php $_smarty_tpl->tpl_vars['existing_files'] = new Smarty_variable(array(), null, 0);?>

<?php  $_smarty_tpl->tpl_vars['pair'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pair']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['existing_pairs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pair']->key => $_smarty_tpl->tpl_vars['pair']->value) {
$_smarty_tpl->tpl_vars['pair']->_loop = true;
?>
    <?php $_smarty_tpl->createLocalArrayVariable('existing_files', null, 0);
$_smarty_tpl->tpl_vars['existing_files']->value[intval($_smarty_tpl->tpl_vars['pair']->value['pair_id'])] = array();?>

    <?php if ($_smarty_tpl->tpl_vars['pair']->value['image_id']) {?>
        <?php $_smarty_tpl->createLocalArrayVariable('existing_files', null, 0);
$_smarty_tpl->tpl_vars['existing_files']->value[intval($_smarty_tpl->tpl_vars['pair']->value['pair_id'])]['icon'] = fn_image_to_display($_smarty_tpl->tpl_vars['pair']->value['icon'],$_smarty_tpl->tpl_vars['thumbnail_width']->value,$_smarty_tpl->tpl_vars['thumbnail_height']->value);?>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['pair']->value['detailed_id']) {?>
        <?php $_smarty_tpl->createLocalArrayVariable('existing_files', null, 0);
$_smarty_tpl->tpl_vars['existing_files']->value[intval($_smarty_tpl->tpl_vars['pair']->value['pair_id'])]['detailed'] = fn_image_to_display($_smarty_tpl->tpl_vars['pair']->value['detailed'],$_smarty_tpl->tpl_vars['thumbnail_width']->value,$_smarty_tpl->tpl_vars['thumbnail_height']->value);?>
    <?php }?>
<?php } ?>

<div class="file-uploader cm-file-uploader"
    data-ca-upload-url="<?php echo htmlspecialchars(fn_url("image.upload"), ENT_QUOTES, 'UTF-8');?>
"
    data-ca-thumbnail-width="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['thumbnail_width']->value, ENT_QUOTES, 'UTF-8');?>
"
    data-ca-thumbnail-height="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['thumbnail_height']->value, ENT_QUOTES, 'UTF-8');?>
"
    data-ca-existing-pairs="<?php echo htmlspecialchars(json_encode(array_values((($tmp = @$_smarty_tpl->tpl_vars['existing_pairs']->value)===null||$tmp==='' ? array() : $tmp))), ENT_QUOTES, 'UTF-8');?>
"
    data-ca-existing-pair-thumbnails="<?php echo htmlspecialchars(json_encode($_smarty_tpl->tpl_vars['existing_files']->value), ENT_QUOTES, 'UTF-8');?>
"
    data-ca-template-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['template_id']->value, ENT_QUOTES, 'UTF-8');?>
"
    data-ca-max-files-count="100"
    data-ca-new-files-param-name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['file_name']->value, ENT_QUOTES, 'UTF-8');?>
"
    data-ca-default-image-pair-type="A"
    data-ca-max-file-size="<?php echo htmlspecialchars(min(array($_smarty_tpl->tpl_vars['upload_max_filesize']->value,$_smarty_tpl->tpl_vars['post_max_size']->value)), ENT_QUOTES, 'UTF-8');?>
"

    data-ca-image-pair-types="<?php echo htmlspecialchars(json_encode(array_filter((($tmp = @$_smarty_tpl->tpl_vars['image_pair_types']->value)===null||$tmp==='' ? array() : $tmp))), ENT_QUOTES, 'UTF-8');?>
"
    data-ca-allow-sorting="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['allow_update_files']->value, ENT_QUOTES, 'UTF-8');?>
"
    data-ca-destroy-after-initializing="<?php echo htmlspecialchars(!$_smarty_tpl->tpl_vars['allow_update_files']->value, ENT_QUOTES, 'UTF-8');?>
"
    data-ca-allow-thumbnail-upload="true"
    data-ca-image-pair-object-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
">

    <div class="file-uploader__files-container clearfix" data-ca-fileuploader-files-container>

    <?php if ($_smarty_tpl->tpl_vars['allow_update_files']->value) {?>
        <div class="file-uploader__pickers">
            <div class="file-uploader__file-square <?php if (!$_smarty_tpl->tpl_vars['existing_files']->value) {?>file-uploader__file-square--no-files<?php }?>">
                <div class="file-uploader__pickers-content">
                    <p><i class="file-uploader__pickers-icon icon icon-picture"></i></p>
                    <p class="file-uploader__pickers-text">
                        <?php echo $_smarty_tpl->__("drop_images_to_upload");?>

                        <span class="file-uploader__pickers-text file-uploader__pickers-text--small"><?php echo $_smarty_tpl->__("or");?>
</span>
                    </p>
                    <div class="btn-group file-uploader__pickers-buttons" id="last_edited_items">
                        <a class="btn file-uploader__pickers-buttons-select" data-ca-fileupload-picker-local>
                            <?php if ($_smarty_tpl->tpl_vars['existing_files']->value) {?>
                                <?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['upload_file_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("drop_images_select_short") : $tmp), ENT_QUOTES, 'UTF-8');?>

                            <?php } else { ?>
                                <?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['upload_file_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("drop_images_select") : $tmp), ENT_QUOTES, 'UTF-8');?>

                            <?php }?>
                        </a>
                        <a class="btn file-uploader__pickers-buttons-select dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php if (smarty_modifier_sizeof($_smarty_tpl->tpl_vars['breadcrumbs']->value)>=1) {?>
                                <?php if (!($_smarty_tpl->tpl_vars['hide_server']->value||defined("RESTRICTED_ADMIN"))) {?>
                                    <li><a data-ca-fileupload-picker-server><?php echo $_smarty_tpl->__("add_image_from_server");?>
</a></li>
                                <?php }?>
                                <li><a data-ca-fileupload-picker-url><?php echo $_smarty_tpl->__("add_image_from_url");?>
</a></li>
                                <?php if ($_smarty_tpl->tpl_vars['existing_files']->value) {?>
                                    <li class="divider"></li>
                                    <li><a data-ca-fileupload-remove-all><?php echo $_smarty_tpl->__("delete_all_images");?>
</a></li>
                                <?php }?>
                            <?php }?>
                        </ul>
                    <!--last_edited_items--></div>
                </div>
            </div>
        </div>
    <?php }?>

    </div>
</div>

<div id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['template_id']->value, ENT_QUOTES, 'UTF-8');?>
" style="display: none;">
    <div class="file-uploader__file">
        <div class="file-uploader__file-square">
            <div class="file-uploader__file-progressbar">
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"
                    aria-valuenow="0">
                    <div class="bar" style="width: 0;" data-dz-uploadprogress></div>
                </div>
            </div>
            <div class="file-uploader__file-section file-uploader__file-section_text-data" data-dz-errormessage></div>
            <div class="file-uploader__file-section file-uploader__file-section_image">
                <img class="file-uploader__file-preview-image" data-dz-thumbnail/>
            </div>

            <div class="file-uploader__file-section file-uploader__file-section_under-image">
                <textarea 
                    class="cm-file-uploader-dynamic-field file-uploader__file-description-input"
                    data-ca-alt-text-detailed   
                    placeholder="<?php echo $_smarty_tpl->__("alternative_text");?>
"></textarea>

                <div class="file-uploader__file-control-menu file-uploader__file-control-menu--expanded">
                    <div class="file-uploader__file-control-menu-buttons-wrapper">
                        <a href="" target="_blank" class="cm-tooltip file-uploader__file-button file-uploader__file-button-preview" data-ca-preview-detailed
                            title="<?php echo $_smarty_tpl->__("preview");?>
"><i class="icon icon-eye-open"></i></a>
                        <?php if ($_smarty_tpl->tpl_vars['allow_update_files']->value) {?>
                            <a class="cm-tooltip file-uploader__file-button file-uploader__file-button-delete"
                                data-ca-dz-remove title="<?php echo $_smarty_tpl->__("remove");?>
">
                                <i class="icon icon-trash"></i>
                            </a>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="cm-hide-with-inputs">
                <div class="file-uploader__remove-overlay hidden">
                    <div class="file-uploader__remove-text"><?php echo $_smarty_tpl->__("image_has_been_deleted");?>
</div>
                    <div>
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_onclick'=>"javascript:void(0)",'but_meta'=>"file-uploader__remove-button-recover",'but_text'=>$_smarty_tpl->__("recover")), 0);?>

                    </div>
                </div>
                <input type="hidden" name="product_data[removed_image_pair_ids][]" value="" data-ca-image-remove>
                <input type="hidden" name="" value="" class="cm-file-uploader-dynamic-field" data-ca-image-type>
                <input type="hidden" name="" value="" class="cm-file-uploader-dynamic-field" data-ca-image-object-id>
                <input type="hidden" name="" value="" class="cm-file-uploader-dynamic-field" data-ca-image-pair-id>
                <input type="hidden" name="" value="" class="cm-file-uploader-dynamic-field" data-ca-image-position>
                <input type="hidden" name="" value="" class="cm-file-uploader-dynamic-field" data-ca-upload-type>
                <input type="hidden" name="" value="" class="cm-file-uploader-dynamic-field" data-ca-upload-file>
                <input type="hidden" name="" value="" class="cm-file-uploader-dynamic-field" data-ca-is-new-file>
            </div>
        </div>
    </div>
</div>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
    Tygh.lang.url = '<?php echo strtr($_smarty_tpl->__("url"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
';
    Tygh.lang.cannot_upload_file = '<?php echo strtr($_smarty_tpl->__("cannot_upload_file"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
';
<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php }} ?>
