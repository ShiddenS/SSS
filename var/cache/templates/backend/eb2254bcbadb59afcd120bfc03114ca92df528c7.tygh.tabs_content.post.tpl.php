<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 13:48:13
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\form_builder\hooks\pages\tabs_content.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20760433835db2d2ed2aeae3-75064659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb2254bcbadb59afcd120bfc03114ca92df528c7' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\form_builder\\hooks\\pages\\tabs_content.post.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '20760433835db2d2ed2aeae3-75064659',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_type' => 0,
    'elements' => 0,
    'element' => 0,
    'form' => 0,
    'form_has_elements' => 0,
    'form_submit_const' => 0,
    'form_recipient_const' => 0,
    'form_secure_const' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2d2ed490c20_34366107',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2d2ed490c20_34366107')) {function content_5db2d2ed490c20_34366107($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_in_array')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.in_array.php';
if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('addons.form_builder.email_subject_field','ttc_addons.form_builder.email_subject_field','addons.form_builder.form_fields','addons.form_builder.form_name','addons.form_builder.other_subject','form_submit_text','email_to','form_is_secure'));
?>
<?php if ($_smarty_tpl->tpl_vars['page_type']->value==@constant('PAGE_TYPE_FORM')) {?>
<div id="content_build_form">

    <div class="control-group">
        <label for="form_subject" class="control-label"><?php echo $_smarty_tpl->__("addons.form_builder.email_subject_field");
echo $_smarty_tpl->getSubTemplate ("common/tooltip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tooltip'=>$_smarty_tpl->__("ttc_addons.form_builder.email_subject_field")), 0);?>
:</label>
        <div class="controls">
            <select id="form_subject" name="page_data[form][general][<?php echo htmlspecialchars(@constant('FORM_SUBJECT'), ENT_QUOTES, 'UTF-8');?>
]">
                <?php $_smarty_tpl->tpl_vars['form_has_elements'] = new Smarty_variable(false, null, 0);?>
                <?php $_smarty_tpl->_capture_stack[0][] = array("build_form_elements", null, null); ob_start(); ?>
                    <optgroup label="<?php echo $_smarty_tpl->__("addons.form_builder.form_fields");?>
">
                    <?php  $_smarty_tpl->tpl_vars["element"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["element"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['elements']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["element"]->key => $_smarty_tpl->tpl_vars["element"]->value) {
$_smarty_tpl->tpl_vars["element"]->_loop = true;
?>
                        <?php if (smarty_modifier_in_array($_smarty_tpl->tpl_vars['element']->value['element_type'],array(@constant('FORM_INPUT'),@constant('FORM_SELECT')))) {?>
                            <?php $_smarty_tpl->tpl_vars['form_has_elements'] = new Smarty_variable(true, null, 0);?>
                            <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['form']->value[@constant('FORM_SUBJECT')]===$_smarty_tpl->tpl_vars['element']->value['element_id']) {?> selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['description'], ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php }?>
                    <?php } ?>
                    </optgroup>
                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                <?php if ($_smarty_tpl->tpl_vars['form_has_elements']->value) {?>
                    <?php echo Smarty::$_smarty_vars['capture']['build_form_elements'];?>

                <?php }?>
                <option value=""<?php if ($_smarty_tpl->tpl_vars['form']->value[@constant('FORM_SUBJECT')]=='') {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->__("addons.form_builder.form_name");?>
</option>
                <option value="0"<?php if ($_smarty_tpl->tpl_vars['form']->value[@constant('FORM_SUBJECT')]==="0") {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->__("addons.form_builder.other_subject");?>
</option>
            </select>
            <p class="<?php if ($_smarty_tpl->tpl_vars['form']->value[@constant('FORM_SUBJECT')]!=="0") {?>hidden<?php }?>" id="form_subject_text">
                <input type="text" name="page_data[form][general][<?php echo htmlspecialchars(@constant('FORM_SUBJECT_TEXT'), ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form']->value[@constant('FORM_SUBJECT_TEXT')], ENT_QUOTES, 'UTF-8');?>
" />
            </p>
        </div>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
>
            (function(_, $) {
                $('#form_subject').change(function() {
                    if ($(this).val() === "0") {
                        $('#form_subject_text').removeClass('hidden');
                    } else {
                        $('#form_subject_text').addClass('hidden');
                    }
                });
            })(Tygh, Tygh.$);
        <?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </div>
    
    <div class="control-group">
        <label for="form_submit_text" class="control-label"><?php echo $_smarty_tpl->__("form_submit_text");?>
:</label>
        <?php $_smarty_tpl->tpl_vars["form_submit_const"] = new Smarty_variable(@constant('FORM_SUBMIT'), null, 0);?>
        <div class="controls">
            <textarea id="form_submit_text" class="cm-wysiwyg input-textarea-long" rows="5" cols="50" name="page_data[form][general][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_submit_const']->value, ENT_QUOTES, 'UTF-8');?>
]" rows="5"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form']->value[$_smarty_tpl->tpl_vars['form_submit_const']->value], ENT_QUOTES, 'UTF-8');?>
</textarea>
        </div>
        
    </div>

    <div class="control-group">
        <label for="form_recipient" class="cm-required control-label"><?php echo $_smarty_tpl->__("email_to");?>
:</label>
        <?php $_smarty_tpl->tpl_vars["form_recipient_const"] = new Smarty_variable(@constant('FORM_RECIPIENT'), null, 0);?>
        <div class="controls">
            <input id="form_recipient" class="input-text" type="text" name="page_data[form][general][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_recipient_const']->value, ENT_QUOTES, 'UTF-8');?>
]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form']->value[$_smarty_tpl->tpl_vars['form_recipient_const']->value], ENT_QUOTES, 'UTF-8');?>
">
        </div>
    </div>

    <div class="control-group">
        <label for="form_is_secure" class="control-label"><?php echo $_smarty_tpl->__("form_is_secure");?>
:</label>
        <?php $_smarty_tpl->tpl_vars["form_secure_const"] = new Smarty_variable(@constant('FORM_IS_SECURE'), null, 0);?>
        <div class="controls">
                <input type="hidden" name="page_data[form][general][<?php echo htmlspecialchars(@constant('FORM_IS_SECURE'), ENT_QUOTES, 'UTF-8');?>
]" value="N">
                <span class="checkbox">
                    <input type="checkbox" id="form_is_secure" value="Y" <?php if ($_smarty_tpl->tpl_vars['form']->value[$_smarty_tpl->tpl_vars['form_secure_const']->value]=="Y") {?>checked="checked"<?php }?> name="page_data[form][general][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_secure_const']->value, ENT_QUOTES, 'UTF-8');?>
]">
                </span>
        </div>
    </div>

    <?php echo $_smarty_tpl->getSubTemplate ("addons/form_builder/views/pages/components/pages_form_elements.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


</div>
<?php }?><?php }} ?>
