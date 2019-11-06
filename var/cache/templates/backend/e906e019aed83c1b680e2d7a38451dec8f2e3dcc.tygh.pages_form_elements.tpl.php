<?php /* Smarty version Smarty-3.1.21, created on 2019-10-30 17:30:23
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\form_builder\views\pages\components\pages_form_elements.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17936084105db99e7f42b992-90255864%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e906e019aed83c1b680e2d7a38451dec8f2e3dcc' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\form_builder\\views\\pages\\components\\pages_form_elements.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '17936084105db99e7f42b992-90255864',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_data' => 0,
    'elements' => 0,
    'element' => 0,
    'id' => 0,
    'num' => 0,
    'allow_save' => 0,
    'selectable_elements' => 0,
    'vnum' => 0,
    'var' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db99e7fda0402_41989575',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db99e7fda0402_41989575')) {function content_5db99e7fda0402_41989575($_smarty_tpl) {?><?php if (!is_callable('smarty_block_inline_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.inline_script.php';
if (!is_callable('smarty_function_math')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.math.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('position_short','name','type','required','status','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','position_short','description','position_short','description'));
?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
    function fn_check_element_type(elm, id, selectable_elements)
    {
        var $ = Tygh.$;
        var elem_id = id.replace('elm_', 'box_element_variants_');
        $('#' + elem_id).toggleBy(selectable_elements.indexOf(elm) == -1);

        // Hide description box for separator
        $('#descr_' + id).toggleBy((elm == 'D'));
        $('#hr_' + id).toggleBy((elm != 'D'));

        $('#req_' + id).prop('disabled', (elm == 'D' || elm == 'H'));
    }

    function fn_go_check_element_type(id, selectable_elements)
    {
        var $ = Tygh.$;
        var id = id || '';

        var c = parseInt(id.replace('add_elements', '').replace('_', ''));
        c = (isNaN(c))? 1 : c++;
        var c_id = c.toString();
        $('#elm_add_variants_' + c_id).trigger('change');
    }
<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>



<?php $_smarty_tpl->tpl_vars["allow_save"] = new Smarty_variable(true, null, 0);?>
<?php if (fn_allowed_for("ULTIMATE")) {?>
    <?php $_smarty_tpl->tpl_vars["allow_save"] = new Smarty_variable(fn_allow_save_object($_smarty_tpl->tpl_vars['page_data']->value,"pages"), null, 0);?>
<?php }?>

<div class="table-wrapper">
    <table class="table hidden-inputs table-middle">
    <thead>
        <tr>
            <th width="5%"><?php echo $_smarty_tpl->__("position_short");?>
</th>
            <th width="30%"><?php echo $_smarty_tpl->__("name");?>
</th>
            <th width="30%"><?php echo $_smarty_tpl->__("type");?>
</th>
            <th width="5%"><?php echo $_smarty_tpl->__("required");?>
</th>
            <th width="10%">&nbsp;</th>
            <th width="10%" class="right"><?php echo $_smarty_tpl->__("status");?>
</th>
        </tr>
    </thead>
    <?php  $_smarty_tpl->tpl_vars["element"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["element"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['elements']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["fe_e"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["element"]->key => $_smarty_tpl->tpl_vars["element"]->value) {
$_smarty_tpl->tpl_vars["element"]->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["fe_e"]['iteration']++;
?>
    <?php $_smarty_tpl->tpl_vars["num"] = new Smarty_variable($_smarty_tpl->getVariable('smarty')->value['foreach']['fe_e']['iteration'], null, 0);?>
    <tbody class="cm-row-item cm-row-status-<?php echo htmlspecialchars(mb_strtolower($_smarty_tpl->tpl_vars['element']->value['status'], 'UTF-8'), ENT_QUOTES, 'UTF-8');?>
">
    <tr>
        <td class="nowrap">
            <span id="on_box_element_variants_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo $_smarty_tpl->__("expand_collapse_list");?>
" title="<?php echo $_smarty_tpl->__("expand_collapse_list");?>
" class="hand cm-combination-options-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><span class="icon-caret-right"></span></span>
            <span id="off_box_element_variants_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo $_smarty_tpl->__("expand_collapse_list");?>
" title="<?php echo $_smarty_tpl->__("expand_collapse_list");?>
" class="hand hidden cm-combination-options-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><span class="icon-caret-down"></span> </span>
            <input type="hidden" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][element_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" />
            <input class="input-micro" type="text" size="3" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][position]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['position'], ENT_QUOTES, 'UTF-8');?>
" /></td>
        <td>
            <input id="descr_elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="<?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']==@constant('FORM_SEPARATOR')) {?>hidden<?php }?>" type="text" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][description]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['description'], ENT_QUOTES, 'UTF-8');?>
" />
            <hr id="hr_elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" width="100%" <?php if ($_smarty_tpl->tpl_vars['element']->value['element_type']!=@constant('FORM_SEPARATOR')) {?>class="hidden"<?php }?> /></td>
        <td>
            <?php echo $_smarty_tpl->getSubTemplate ("addons/form_builder/views/pages/components/element_types.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('element_type'=>$_smarty_tpl->tpl_vars['element']->value['element_type'],'elm_id'=>$_smarty_tpl->tpl_vars['element']->value['element_id']), 0);?>
</td>
        <td class="center">
            <input type="hidden" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][required]" value="N" />
            <input id="req_elm_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" type="checkbox" <?php if (strstr("HD",$_smarty_tpl->tpl_vars['element']->value['element_type'])) {?>disabled="disabled"<?php }?> name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][required]" value="Y" <?php if ($_smarty_tpl->tpl_vars['element']->value['required']=="Y") {?>checked="checked"<?php }?> /></td>
        <td>
            <div class="hidden-tools">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/multiple_buttons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('only_delete'=>"Y"), 0);?>

            </div>
        </td>
        <td class="right">
            <?php echo $_smarty_tpl->getSubTemplate ("common/select_popup.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>$_smarty_tpl->tpl_vars['element']->value['element_id'],'prefix'=>"elm",'status'=>$_smarty_tpl->tpl_vars['element']->value['status'],'hidden'=>'','object_id_name'=>"element_id",'table'=>"form_options",'non_editable'=>!$_smarty_tpl->tpl_vars['allow_save']->value), 0);?>

        </td>
    </tr>
    <tr id="box_element_variants_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="<?php if (!substr_count($_smarty_tpl->tpl_vars['selectable_elements']->value,$_smarty_tpl->tpl_vars['element']->value['element_type'])) {?>hidden<?php }?> row-more row-gray hidden">
        <td>&nbsp;</td>
        <td colspan="4">
            <table class="table table-middle">
            <thead>
                <tr class="cm-first-sibling">
                    <th width="5%" class="left"><?php echo $_smarty_tpl->__("position_short");?>
</th>
                    <th><?php echo $_smarty_tpl->__("description");?>
</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['var']->_loop = false;
 $_smarty_tpl->tpl_vars["vnum"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['element']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value) {
$_smarty_tpl->tpl_vars['var']->_loop = true;
 $_smarty_tpl->tpl_vars["vnum"]->value = $_smarty_tpl->tpl_vars['var']->key;
?>
            <tr class="cm-first-sibling cm-row-item">
                <td>
                    <input type="hidden" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][variants][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vnum']->value, ENT_QUOTES, 'UTF-8');?>
][element_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" />
                    <input class="input-micro" size="3" type="text" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][variants][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vnum']->value, ENT_QUOTES, 'UTF-8');?>
][position]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['position'], ENT_QUOTES, 'UTF-8');?>
" /></td>
                <td><input type="text" class="span7" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][variants][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vnum']->value, ENT_QUOTES, 'UTF-8');?>
][description]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['description'], ENT_QUOTES, 'UTF-8');?>
" /></td>
                <td>
                    <div class="hidden-tools">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/multiple_buttons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('only_delete'=>"Y"), 0);?>

                    </div>
                </td>
            </tr>
            <?php } ?>
            <?php echo smarty_function_math(array('equation'=>"x + 1",'assign'=>"vnum",'x'=>(($tmp = @$_smarty_tpl->tpl_vars['vnum']->value)===null||$tmp==='' ? 0 : $tmp)),$_smarty_tpl);?>

            <tr id="box_elm_variants_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['element']->value['element_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-row-item cm-elm-variants">
                <td><input class="input-micro" size="3" type="text" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][variants][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vnum']->value, ENT_QUOTES, 'UTF-8');?>
][position]" /></td>
                <td><input type="text" class="span7" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][variants][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vnum']->value, ENT_QUOTES, 'UTF-8');?>
][description]" /></td>
                <td>
                    <div class="hidden-tools">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/multiple_buttons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('item_id'=>"elm_variants_".((string)$_smarty_tpl->tpl_vars['element']->value['element_id']),'tag_level'=>"5"), 0);?>

                    </div>
                </td>
            </tr>
            </table>
        </td>
        <td>&nbsp;</td>
    </tr>
    </tbody>
    <?php } ?>

    <?php echo smarty_function_math(array('equation'=>"x + 1",'assign'=>"num",'x'=>(($tmp = @$_smarty_tpl->tpl_vars['num']->value)===null||$tmp==='' ? 0 : $tmp)),$_smarty_tpl);?>

    <tbody class="cm-row-item cm-row-status-a" id="box_add_elements">
    <tr class="no-border">
        <td class="right">
            <input class="input-micro" size="3" type="text" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][position]" value="" /></td>
        <td>
            <input id="descr_elm_add_variants" type="text" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][description]" value="" />
            <hr id="hr_elm_add_variants" class="hidden" /></td>
        <td>
            <?php echo $_smarty_tpl->getSubTemplate ("addons/form_builder/views/pages/components/element_types.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('element_type'=>'','elm_id'=>"add_variants"), 0);?>
</td>
        <td class="center">
            <input type="hidden" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][required]" value="N" />
            <input id="req_elm_add_variants" type="checkbox" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][required]" value="Y" checked="checked" /></td>
        <td class="left">
            <div class="hidden-tools">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/multiple_buttons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('item_id'=>"add_elements",'on_add'=>"fn_go_check_element_type();"), 0);?>

            </div>
        </td>
        <td class="right">
            <?php echo $_smarty_tpl->getSubTemplate ("common/select_status.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('input_name'=>"page_data[form][elements_data][".((string)$_smarty_tpl->tpl_vars['num']->value)."][status]",'display'=>"popup"), 0);?>

        </td>
    </tr>
    <tr id="box_element_variants_add_variants" class="row-more row-gray">
        <td>&nbsp;</td>
        <td colspan="4">
            <table class="table table-middle">
            <thead>
                <tr class="cm-first-sibling">
                    <th width="5%" class="left"><?php echo $_smarty_tpl->__("position_short");?>
</th>
                    <th><?php echo $_smarty_tpl->__("description");?>
</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tr id="box_elm_variants_add_variants" class="cm-row-item cm-elm-variants">
                <td><input class="input-micro" size="3" type="text" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][variants][0][position]" /></td>
                <td><input class="span7" type="text" name="page_data[form][elements_data][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['num']->value, ENT_QUOTES, 'UTF-8');?>
][variants][0][description]" /></td>
                <td>
                    <div class="hidden-tools">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/multiple_buttons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('item_id'=>"elm_variants_add_variants",'tag_level'=>"5"), 0);?>

                    </div>
                </td>
            </tr>
            </table>
        </td>
        <td>&nbsp;</td>
    </tr>
    </tbody>


    </table>
</div>
<?php }} ?>
