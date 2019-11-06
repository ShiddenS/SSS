<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:27:07
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\advanced_import\views\import_presets\components\field.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4479515545daf1fcb718a99-44537619%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23525cc38f0096796560b270df2f56e2373acc37' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\advanced_import\\views\\import_presets\\components\\field.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '4479515545daf1fcb718a99-44537619',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'name' => 0,
    'preview' => 0,
    'preset' => 0,
    'preview_item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1fcb80b8f9_01201871',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1fcb80b8f9_01201871')) {function content_5daf1fcb80b8f9_01201871($_smarty_tpl) {?><?php
\Tygh\Languages\Helper::preloadLangVars(array('advanced_import.column_header','advanced_import.product_property','none','advanced_import.first_line_import_value','advanced_import.modifier_title','advanced_import.example_imported_title','advanced_import.example_modified_title','advanced_import.show_more','advanced_import.show_less','advanced_import.modifier','advanced_import.modifier'));
?>
<tr class="import-field" id="field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">
    <td class="import-field__name" data-th="<?php echo $_smarty_tpl->__("advanced_import.column_header");?>
">
        <input type="hidden"
               name="fields[<?php echo htmlspecialchars(md5($_smarty_tpl->tpl_vars['name']->value), ENT_QUOTES, 'UTF-8');?>
][name]"
               value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
"
        />
        <span data-ca-advanced-import-element="field"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
</span>
    </td>
    <td class="import-field__related_object" data-th="<?php echo $_smarty_tpl->__("advanced_import.product_property",array("[product]"=>@constant('PRODUCT_NAME')));?>
">
        <input type="hidden"
               name="fields[<?php echo htmlspecialchars(md5($_smarty_tpl->tpl_vars['name']->value), ENT_QUOTES, 'UTF-8');?>
][related_object_type]"
               id="elm_field_related_object_type_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"
        />
        <span class="cm-adv-import-placeholder hidden" 
              data-ca-advanced-import-field-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"
              data-ca-advanced-import-select-name="fields[<?php echo htmlspecialchars(md5($_smarty_tpl->tpl_vars['name']->value), ENT_QUOTES, 'UTF-8');?>
][related_object]"
              data-ca-advanced-import-field-name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
"
              data-ca-placeholder="-<?php echo $_smarty_tpl->__("none");?>
-"
        ></span>
    </td>
    <td class="import-field__preview" data-th="<?php echo $_smarty_tpl->__("advanced_import.first_line_import_value");?>
">
        <?php if ($_smarty_tpl->tpl_vars['preview']->value) {?>
            <?php  $_smarty_tpl->tpl_vars['preview_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['preview_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['preview']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['preview_item']->key => $_smarty_tpl->tpl_vars['preview_item']->value) {
$_smarty_tpl->tpl_vars['preview_item']->_loop = true;
?>
                <div class="import-field__preview-wrapper cm-show-more__wrapper">
                    <div class="import-field__preview-value cm-show-more__block">
                        <?php if ($_smarty_tpl->tpl_vars['preset']->value['fields'][$_smarty_tpl->tpl_vars['name']->value]['modifier']) {?>
                                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preview_item']->value[$_smarty_tpl->tpl_vars['name']->value]['modified'], ENT_QUOTES, 'UTF-8');?>

                            <div class="import-field__preview-info">
                                <a class="import-field__preview-button"><i class="icon-question-sign"></i></a>
                                <div class="popover fade bottom in">
                                    <div class="arrow"></div>
                                    <h3 class="popover-title"><?php echo $_smarty_tpl->__("advanced_import.modifier_title");?>
</h3>
                                    <div class="popover-content">
                                        <div class="import-field__preview--original">
                                            <strong><?php echo $_smarty_tpl->__("advanced_import.example_imported_title");?>
</strong>
                                            <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preview_item']->value[$_smarty_tpl->tpl_vars['name']->value]['original'], ENT_QUOTES, 'UTF-8');?>
</p>
                                        </div>
                                        <div class="import-field__preview--modified">
                                            <strong><?php echo $_smarty_tpl->__("advanced_import.example_modified_title");?>
</strong>
                                            <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preview_item']->value[$_smarty_tpl->tpl_vars['name']->value]['modified'], ENT_QUOTES, 'UTF-8');?>
</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preview_item']->value[$_smarty_tpl->tpl_vars['name']->value]['original'], ENT_QUOTES, 'UTF-8');?>

                        <?php }?>
                    </div>
                </div>
            <?php } ?>
            <div class="cm-show-more__btn">
                <a href="#" class="cm-show-more__btn-more"><?php echo $_smarty_tpl->__("advanced_import.show_more");?>
</a>
                <a href="#" class="cm-show-more__btn-less"><?php echo $_smarty_tpl->__("advanced_import.show_less");?>
</a>
            </div>
        <?php }?>
    </td>
    <td class="import-field__modifier" data-th="<?php echo $_smarty_tpl->__("advanced_import.modifier");?>
">
        <div class="control-group import-field__modifier-input-group">
            <input type="text"
                   name="fields[<?php echo htmlspecialchars(md5($_smarty_tpl->tpl_vars['name']->value), ENT_QUOTES, 'UTF-8');?>
][modifier]"
                   class="input-text input-hidden import-field__modifier-input"
                   placeholder="<?php echo $_smarty_tpl->__("advanced_import.modifier");?>
"
                   value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['preset']->value['fields'][$_smarty_tpl->tpl_vars['name']->value]['modifier'], ENT_QUOTES, 'UTF-8');?>
"
                   data-ca-advanced-import-original-value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['preview_item']->value[$_smarty_tpl->tpl_vars['name']->value]['original'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8');?>
"
                   data-ca-advanced-import-element="modifier"
            />
        </div>
    </td>
<!--field_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
--></tr>
<?php }} ?>
