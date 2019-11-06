<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:25
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\attachments\views\attachments\update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9062258685daf1d8526d8c0-03444627%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11bac81e971b567a1d66e05f5f37329da50dc051' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\attachments\\views\\attachments\\update.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '9062258685daf1d8526d8c0-03444627',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'attachment' => 0,
    'hide_inputs' => 0,
    'id' => 0,
    'object_id' => 0,
    'object_type' => 0,
    'config' => 0,
    'hide_first_button' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d85332647_03010801',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d85332647_03010801')) {function content_5daf1d85332647_03010801($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_formatfilesize')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.formatfilesize.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('general','name','position','file','usergroups'));
?>
<?php if ($_smarty_tpl->tpl_vars['attachment']->value['attachment_id']) {?>
    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->tpl_vars['attachment']->value['attachment_id'], null, 0);?>    
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable("0", null, 0);?>
<?php }?>

<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" class="form-horizontal form-edit  <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['hide_inputs']->value, ENT_QUOTES, 'UTF-8');?>
" name="attachments_form_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="selected_section" value="attachments" />
<input type="hidden" name="object_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_id']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="object_type" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object_type']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="attachment_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />

<div class="tabs cm-j-tabs clear">
    <ul class="nav nav-tabs">
        <li id="tab_details_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-js active"><a><?php echo $_smarty_tpl->__("general");?>
</a></li>
    </ul>
</div>

<div class="cm-tabs-content">
    <div id="content_tab_details_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <div class="control-group">
            <label for="elm_description_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" class="control-label cm-required"><?php echo $_smarty_tpl->__("name");?>
</label>
            <div class="controls">
                <input type="text" name="attachment_data[description]" id="elm_description_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" size="60" class="input-medium" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attachment']->value['description'], ENT_QUOTES, 'UTF-8');?>
" />
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="elm_position_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("position");?>
</label>
            <div class="controls">
                <input type="text" name="attachment_data[position]" id="elm_position_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" size="3" class="input-micro" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attachment']->value['position'], ENT_QUOTES, 'UTF-8');?>
" />
            </div>
        </div>

        <div class="control-group">
            <label for="type_<?php echo htmlspecialchars(md5("attachment_files[".((string)$_smarty_tpl->tpl_vars['id']->value)."]"), ENT_QUOTES, 'UTF-8');?>
" class="control-label <?php if (!$_smarty_tpl->tpl_vars['attachment']->value) {?>cm-required<?php }?>"><?php echo $_smarty_tpl->__("file");?>
</label>
            <div class="controls">
                <?php if ($_smarty_tpl->tpl_vars['attachment']->value['filename']) {?>
                    <div class="text-type-value">
                        <a href="<?php echo htmlspecialchars(fn_url("attachments.getfile?attachment_id=".((string)$_smarty_tpl->tpl_vars['attachment']->value['attachment_id'])."&object_type=".((string)$_smarty_tpl->tpl_vars['object_type']->value)."&object_id=".((string)$_smarty_tpl->tpl_vars['object_id']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attachment']->value['filename'], ENT_QUOTES, 'UTF-8');?>
</a> (<?php echo smarty_modifier_formatfilesize($_smarty_tpl->tpl_vars['attachment']->value['filesize']);?>
)
                    </div>
                <?php }?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/fileuploader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('var_name'=>"attachment_files[".((string)$_smarty_tpl->tpl_vars['id']->value)."]"), 0);?>
</div>
        </div>

        <div class="control-group">
            <label class="control-label"><?php echo $_smarty_tpl->__("usergroups");?>
</label>
            <div class="controls">
                <?php echo $_smarty_tpl->getSubTemplate ("common/select_usergroups.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"elm_usergroup_".((string)$_smarty_tpl->tpl_vars['id']->value),'name'=>"attachment_data[usergroup_ids]",'usergroups'=>fn_get_usergroups(array("type"=>"C","status"=>array("A","H"))),'usergroup_ids'=>$_smarty_tpl->tpl_vars['attachment']->value['usergroup_ids'],'input_extra'=>'','list_mode'=>false), 0);?>

            </div>
        </div>
    </div>
</div>

<div class="buttons-container">
    <?php if ($_smarty_tpl->tpl_vars['id']->value) {?>
        <?php $_smarty_tpl->tpl_vars["hide_first_button"] = new Smarty_variable($_smarty_tpl->tpl_vars['hide_inputs']->value, null, 0);?>
    <?php }?>

    <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[attachments.update]",'cancel_action'=>"close",'hide_first_button'=>$_smarty_tpl->tpl_vars['hide_first_button']->value,'save'=>$_smarty_tpl->tpl_vars['id']->value), 0);?>

</div>

</form>
<?php }} ?>
