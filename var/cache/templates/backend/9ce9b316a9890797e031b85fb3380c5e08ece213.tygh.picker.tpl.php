<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:12:53
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\pickers\categories\picker.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14133680385daf1c75da33d2-94245872%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ce9b316a9890797e031b85fb3380c5e08ece213' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\pickers\\categories\\picker.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '14133680385daf1c75da33d2-94245872',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rnd' => 0,
    'data_id' => 0,
    'view_mode' => 0,
    'start_pos' => 0,
    'default_name' => 0,
    'but_text' => 0,
    'but_title' => 0,
    'item_ids' => 0,
    'multiple' => 0,
    'extra_url' => 0,
    'disable_cancel' => 0,
    'extra_var' => 0,
    'runtime' => 0,
    'but_icon' => 0,
    '_but_role' => 0,
    'placement' => 0,
    'display' => 0,
    'company_ids' => 0,
    'picker_for' => 0,
    'checkbox_name' => 0,
    'except_id' => 0,
    '_but_text' => 0,
    '_but_icon' => 0,
    'but_meta' => 0,
    '_but_title' => 0,
    'but_' => 0,
    'prepend' => 0,
    'positions' => 0,
    'input_id' => 0,
    'input_name' => 0,
    'extra' => 0,
    'ldelim' => 0,
    'rdelim' => 0,
    'hide_input' => 0,
    'radio_input_name' => 0,
    'hide_link' => 0,
    'hide_delete_button' => 0,
    'main_category' => 0,
    'c_id' => 0,
    'no_item_text' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1c75f31848_96764966',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1c75f31848_96764966')) {function content_5daf1c75f31848_96764966($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include 'F:\\OSPanel\\domains\\test.local\\app\\lib\\vendor\\smarty\\smarty\\libs\\plugins\\function.math.php';
if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('add_categories','add_categories','add_categories','position_short','name','no_items'));
?>

<?php if (!$_smarty_tpl->tpl_vars['rnd']->value) {
echo smarty_function_math(array('equation'=>"rand()",'assign'=>"rnd"),$_smarty_tpl);
}?>

<?php $_smarty_tpl->tpl_vars['data_id'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['data_id']->value)===null||$tmp==='' ? "categories_list" : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['data_id'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['data_id']->value)."_".((string)$_smarty_tpl->tpl_vars['rnd']->value), null, 0);?>
<?php $_smarty_tpl->tpl_vars['view_mode'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['view_mode']->value)===null||$tmp==='' ? "mixed" : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['start_pos'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['start_pos']->value)===null||$tmp==='' ? 0 : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['default_name'] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['default_name']->value), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['but_text']->value) {?>
    <?php $_smarty_tpl->tpl_vars['_but_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['but_text']->value, null, 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['but_title']->value) {?>
    <?php $_smarty_tpl->tpl_vars['_but_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['but_title']->value, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['_but_title'] = new Smarty_variable($_smarty_tpl->__("add_categories"), null, 0);?>
<?php }?>

<?php echo smarty_function_script(array('src'=>"js/tygh/picker.js"),$_smarty_tpl);?>


<?php if ($_smarty_tpl->tpl_vars['item_ids']->value=='') {?>
    <?php $_smarty_tpl->tpl_vars["item_ids"] = new Smarty_variable(null, null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['item_ids']->value&&!is_array($_smarty_tpl->tpl_vars['item_ids']->value)) {?>
    <?php $_smarty_tpl->tpl_vars["item_ids"] = new Smarty_variable(explode(",",$_smarty_tpl->tpl_vars['item_ids']->value), null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['view_mode']->value!="blocks") {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("add_buttons", null, null); ob_start(); ?>
        <?php if ($_smarty_tpl->tpl_vars['view_mode']->value!="list") {?>

            <?php if ($_smarty_tpl->tpl_vars['multiple']->value==true) {?>
                <?php $_smarty_tpl->tpl_vars["display"] = new Smarty_variable("checkbox", null, 0);?>
                <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["display"] = new Smarty_variable("radio", null, 0);?>
            <?php }?>

            <?php if (!$_smarty_tpl->tpl_vars['extra_url']->value) {?>
                <?php $_smarty_tpl->tpl_vars["extra_url"] = new Smarty_variable("&get_tree=multi_level", null, 0);?>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['disable_cancel']->value) {?>
                <?php $_smarty_tpl->tpl_vars['extra_url'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['extra_url']->value)."&disable_cancel=true", null, 0);?>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['extra_var']->value) {?>
                <?php $_smarty_tpl->tpl_vars["extra_var"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['extra_var']->value), null, 0);?>
            <?php }?>

            <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']||$_smarty_tpl->tpl_vars['runtime']->value['controller']!="companies") {?>
        
                <?php if ($_smarty_tpl->tpl_vars['multiple']->value) {?>
                    <?php $_smarty_tpl->tpl_vars["_but_text"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['but_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("add_categories") : $tmp), null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["_but_role"] = new Smarty_variable("add", null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["_but_icon"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['but_icon']->value)===null||$tmp==='' ? "icon-plus" : $tmp), null, 0);?>
                    <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars["_but_text"] = new Smarty_variable("<i class='icon-plus'></i>", null, 0);?>
                    <?php $_smarty_tpl->tpl_vars["_but_role"] = new Smarty_variable("icon", null, 0);?>
                <?php }?>
                
                <?php if ($_smarty_tpl->tpl_vars['_but_role']->value!="icon") {?>
                    <?php if ($_smarty_tpl->tpl_vars['placement']->value=='right') {?>
                    <div class="clearfix">
                        <div class="pull-right">
                    <?php }?>
                        
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_id'=>"opener_picker_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'but_href'=>fn_url("categories.picker?display=".((string)$_smarty_tpl->tpl_vars['display']->value)."&company_ids=".((string)$_smarty_tpl->tpl_vars['company_ids']->value)."&picker_for=".((string)$_smarty_tpl->tpl_vars['picker_for']->value)."&extra=".((string)$_smarty_tpl->tpl_vars['extra_var']->value)."&checkbox_name=".((string)$_smarty_tpl->tpl_vars['checkbox_name']->value)."&root=".((string)$_smarty_tpl->tpl_vars['default_name']->value)."&except_id=".((string)$_smarty_tpl->tpl_vars['except_id']->value)."&data_id=".((string)$_smarty_tpl->tpl_vars['data_id']->value).((string)$_smarty_tpl->tpl_vars['extra_url']->value)),'but_text'=>$_smarty_tpl->tpl_vars['_but_text']->value,'but_role'=>$_smarty_tpl->tpl_vars['_but_role']->value,'but_icon'=>$_smarty_tpl->tpl_vars['_but_icon']->value,'but_target_id'=>"content_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'but_meta'=>((string)$_smarty_tpl->tpl_vars['but_meta']->value)." btn cm-dialog-opener"), 0);?>

                    <?php if ($_smarty_tpl->tpl_vars['placement']->value=='right') {?>
                    </div>
                        </div>
                    <?php }?>
                <?php }?>
                <div class="hidden" id="content_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_but_title']->value, ENT_QUOTES, 'UTF-8');?>
"></div>
            <?php }?>

        <?php } else { ?>

            <?php $_smarty_tpl->tpl_vars["display"] = new Smarty_variable("checkbox", null, 0);?>

            <?php if (!$_smarty_tpl->tpl_vars['extra_url']->value) {?>
                <?php $_smarty_tpl->tpl_vars["extra_url"] = new Smarty_variable("&get_tree=multi_level", null, 0);?>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['extra_var']->value) {?>
                <?php $_smarty_tpl->tpl_vars["extra_var"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['extra_var']->value), null, 0);?>
            <?php }?>

            <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']||$_smarty_tpl->tpl_vars['runtime']->value['controller']!="companies") {?>
                <?php $_smarty_tpl->tpl_vars["_but_text"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['but_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("add_categories") : $tmp), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["_but_role"] = new Smarty_variable("add", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["_but_icon"] = new Smarty_variable("icon-plus", null, 0);?>

            <?php if ($_smarty_tpl->tpl_vars['disable_cancel']->value) {?>
                <?php $_smarty_tpl->tpl_vars['extra_url'] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['extra_url']->value)."&disable_cancel=true", null, 0);?>
            <?php }?>

            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_id'=>"opener_picker_".((string)$_smarty_tpl->tpl_vars['data_id']->value),'but_href'=>fn_url("categories.picker?display=".((string)$_smarty_tpl->tpl_vars['display']->value)."&data_id=".((string)$_smarty_tpl->tpl_vars['data_id']->value)."&company_ids=".((string)$_smarty_tpl->tpl_vars['company_ids']->value).((string)$_smarty_tpl->tpl_vars['extra_url']->value)),'but_text'=>$_smarty_tpl->tpl_vars['_but_text']->value,'but_role'=>$_smarty_tpl->tpl_vars['_but_role']->value,'but_icon'=>$_smarty_tpl->tpl_vars['_but_icon']->value,'but_meta'=>((string)$_smarty_tpl->tpl_vars['but_meta']->value)." cm-dialog-opener",'but_target_id'=>"content_".((string)$_smarty_tpl->tpl_vars['data_id']->value)), 0);?>


            <?php }?>
            <div class="hidden" id="content_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_but_title']->value, ENT_QUOTES, 'UTF-8');?>
"></div>
        <?php }?>
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    
    <?php if (!$_smarty_tpl->tpl_vars['prepend']->value) {?>
        <?php echo Smarty::$_smarty_vars['capture']['add_buttons'];?>

        <?php $_smarty_tpl->_capture_stack[0][] = array("add_buttons", null, null); ob_start();
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php }?>
    
<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['extra_var']->value&&$_smarty_tpl->tpl_vars['view_mode']->value!="button") {?>
    <?php if ($_smarty_tpl->tpl_vars['multiple']->value) {?>
    <div class="table-wrapper">
        <table  width="100%" class="table table-middle">
        <thead>
        <tr>
            <?php if ($_smarty_tpl->tpl_vars['positions']->value) {?><th width="5%"><?php echo $_smarty_tpl->__("position_short");?>
</th><?php }?>
            <th><?php echo $_smarty_tpl->__("name");?>
</th>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"category_picker:manage_header")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"category_picker:manage_header"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"category_picker:manage_header"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if (!$_smarty_tpl->tpl_vars['item_ids']->value) {?> class="hidden"<?php }?>>
    <?php } else { ?>
        <div id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="<?php if ($_smarty_tpl->tpl_vars['multiple']->value&&!$_smarty_tpl->tpl_vars['item_ids']->value) {?>hidden<?php } elseif (!$_smarty_tpl->tpl_vars['multiple']->value) {
if ($_smarty_tpl->tpl_vars['view_mode']->value!="list") {?>cm-display-radio<?php }
}?> choose-category">
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['multiple']->value) {?>
        <tr class="hidden">
            <td colspan="<?php if ($_smarty_tpl->tpl_vars['positions']->value) {?>3<?php } else { ?>2<?php }?>">
    <?php }?>
            <input id="<?php if ($_smarty_tpl->tpl_vars['input_id']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['input_id']->value, ENT_QUOTES, 'UTF-8');
} else { ?>c<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_ids<?php }?>" type="hidden" class="cm-picker-value" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['input_name']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php if (is_array($_smarty_tpl->tpl_vars['item_ids']->value)) {
echo htmlspecialchars(implode(",",$_smarty_tpl->tpl_vars['item_ids']->value), ENT_QUOTES, 'UTF-8');
}?>" <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra']->value, ENT_QUOTES, 'UTF-8');?>
 />
    <?php if ($_smarty_tpl->tpl_vars['multiple']->value) {?>
            </td>
        </tr>
    <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['multiple']->value) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("pickers/categories/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('category_id'=>((string)$_smarty_tpl->tpl_vars['ldelim']->value)."category_id".((string)$_smarty_tpl->tpl_vars['rdelim']->value),'holder'=>$_smarty_tpl->tpl_vars['data_id']->value,'hide_input'=>$_smarty_tpl->tpl_vars['hide_input']->value,'input_name'=>$_smarty_tpl->tpl_vars['input_name']->value,'radio_input_name'=>$_smarty_tpl->tpl_vars['radio_input_name']->value,'clone'=>true,'hide_link'=>$_smarty_tpl->tpl_vars['hide_link']->value,'hide_delete_button'=>$_smarty_tpl->tpl_vars['hide_delete_button']->value,'position_field'=>$_smarty_tpl->tpl_vars['positions']->value,'position'=>"0"), 0);?>

        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['view_mode']->value=="list") {?>
            <?php  $_smarty_tpl->tpl_vars["c_id"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["c_id"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item_ids']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["c_id"]->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["c_id"]->key => $_smarty_tpl->tpl_vars["c_id"]->value) {
$_smarty_tpl->tpl_vars["c_id"]->_loop = true;
 $_smarty_tpl->tpl_vars["c_id"]->index++;
 $_smarty_tpl->tpl_vars["c_id"]->first = $_smarty_tpl->tpl_vars["c_id"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['first'] = $_smarty_tpl->tpl_vars["c_id"]->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['iteration']++;
?>
                <?php echo $_smarty_tpl->getSubTemplate ("pickers/categories/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('main_category'=>$_smarty_tpl->tpl_vars['main_category']->value,'category_id'=>$_smarty_tpl->tpl_vars['c_id']->value,'holder'=>$_smarty_tpl->tpl_vars['data_id']->value,'hide_input'=>$_smarty_tpl->tpl_vars['hide_input']->value,'input_name'=>$_smarty_tpl->tpl_vars['input_name']->value,'clone'=>true,'hide_link'=>$_smarty_tpl->tpl_vars['hide_link']->value,'first_item'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['items']['first'],'view_mode'=>"list"), 0);?>

            <?php }
if (!$_smarty_tpl->tpl_vars["c_id"]->_loop) {
?>
                <?php echo $_smarty_tpl->getSubTemplate ("pickers/categories/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('category_id'=>'','holder'=>$_smarty_tpl->tpl_vars['data_id']->value,'hide_input'=>$_smarty_tpl->tpl_vars['hide_input']->value,'input_name'=>$_smarty_tpl->tpl_vars['input_name']->value,'clone'=>true,'hide_link'=>$_smarty_tpl->tpl_vars['hide_link']->value,'view_mode'=>"list"), 0);?>

            <?php } ?>
        <?php } else { ?>
            <?php  $_smarty_tpl->tpl_vars["c_id"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["c_id"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item_ids']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["c_id"]->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars["c_id"]->key => $_smarty_tpl->tpl_vars["c_id"]->value) {
$_smarty_tpl->tpl_vars["c_id"]->_loop = true;
 $_smarty_tpl->tpl_vars["c_id"]->index++;
 $_smarty_tpl->tpl_vars["c_id"]->first = $_smarty_tpl->tpl_vars["c_id"]->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['first'] = $_smarty_tpl->tpl_vars["c_id"]->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["items"]['iteration']++;
?>
                <?php if (!$_smarty_tpl->tpl_vars['multiple']->value) {?><div class="input-append choose-input"><?php }?>
                <?php echo $_smarty_tpl->getSubTemplate ("pickers/categories/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('category_id'=>$_smarty_tpl->tpl_vars['c_id']->value,'holder'=>$_smarty_tpl->tpl_vars['data_id']->value,'hide_input'=>$_smarty_tpl->tpl_vars['hide_input']->value,'input_name'=>$_smarty_tpl->tpl_vars['input_name']->value,'hide_link'=>$_smarty_tpl->tpl_vars['hide_link']->value,'hide_delete_button'=>$_smarty_tpl->tpl_vars['hide_delete_button']->value,'first_item'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['items']['first'],'position_field'=>$_smarty_tpl->tpl_vars['positions']->value,'position'=>$_smarty_tpl->getVariable('smarty')->value['foreach']['items']['iteration']+$_smarty_tpl->tpl_vars['start_pos']->value), 0);?>

                <?php if (!$_smarty_tpl->tpl_vars['multiple']->value) {?></div><?php }?><!-- /.choose-input -->
            <?php }
if (!$_smarty_tpl->tpl_vars["c_id"]->_loop) {
?>
                <?php if (!$_smarty_tpl->tpl_vars['multiple']->value) {?>
                <div class="input-append choose-input">
                    <?php echo $_smarty_tpl->getSubTemplate ("pickers/categories/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('category_id'=>'','holder'=>$_smarty_tpl->tpl_vars['data_id']->value,'hide_input'=>$_smarty_tpl->tpl_vars['hide_input']->value,'input_name'=>$_smarty_tpl->tpl_vars['input_name']->value,'hide_link'=>$_smarty_tpl->tpl_vars['hide_link']->value,'hide_delete_button'=>$_smarty_tpl->tpl_vars['hide_delete_button']->value), 0);?>

                    <?php echo Smarty::$_smarty_vars['capture']['add_buttons'];?>

                </div>
                <?php }?>
            <?php } ?>
        <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['multiple']->value) {?>
        </tbody>
        <tbody id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['data_id']->value, ENT_QUOTES, 'UTF-8');?>
_no_item"<?php if ($_smarty_tpl->tpl_vars['item_ids']->value) {?> class="hidden"<?php }?>>
        <tr class="no-items">
            <td colspan="<?php if ($_smarty_tpl->tpl_vars['positions']->value) {?>3<?php } else { ?>2<?php }?>"><p><?php echo (($tmp = @$_smarty_tpl->tpl_vars['no_item_text']->value)===null||$tmp==='' ? $_smarty_tpl->__("no_items") : $tmp);?>
</p></td>
        </tr>
        </tbody>
    </table>
    </div>
    <?php } else { ?></div><?php }?>
<?php }?>
<?php }} ?>
