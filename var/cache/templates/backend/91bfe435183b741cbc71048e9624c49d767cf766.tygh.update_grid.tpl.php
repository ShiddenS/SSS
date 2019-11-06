<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 14:01:19
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\block_manager\update_grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13575539455db2d5ff8de418-77761026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '91bfe435183b741cbc71048e9624c49d767cf766' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\block_manager\\update_grid.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '13575539455db2d5ff8de418-77761026',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'grid' => 0,
    'id' => 0,
    'elm_id' => 0,
    'location' => 0,
    'grid_params' => 0,
    'index' => 0,
    'grids_schema' => 0,
    'wrapper_template' => 0,
    'wrapper_name' => 0,
    'device' => 0,
    'is_available' => 0,
    'grid_availability_instance' => 0,
    'devices_icon' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2d5ffb84ca5_99801996',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2d5ffb84ca5_99801996')) {function content_5db2d5ffb84ca5_99801996($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('general','width','content_alignment','full_width','left','right','wrapper','none','offset','user_class','block_manager.availability.show_on','block_manager.availability.'));
?>
<?php if ($_smarty_tpl->tpl_vars['grid']->value['grid_id']) {?>
    <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable($_smarty_tpl->tpl_vars['grid']->value['grid_id'], null, 0);?>
    <?php $_smarty_tpl->tpl_vars['elm_id'] = new Smarty_variable($_smarty_tpl->tpl_vars['id']->value, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable(0, null, 0);?>
    <?php $_smarty_tpl->tpl_vars['elm_id'] = new Smarty_variable(uniqid(), null, 0);?>
<?php }?>

<div id="grid_properties_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
">
<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" enctype="multipart/form-data" class="form-horizontal form-edit " name="grid_update_form">
<input type="hidden" id="s_layout" name="s_layout" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['location']->value['layout_id'], ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="grid_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" />

<input type="hidden" name="container_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['grid_params']->value['container_id'], ENT_QUOTES, 'UTF-8');?>
" />
<input type="hidden" name="parent_id" value="<?php echo htmlspecialchars((($tmp = @(($tmp = @$_smarty_tpl->tpl_vars['grid_params']->value['parent_id'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['grid']->value['parent_id'] : $tmp))===null||$tmp==='' ? 0 : $tmp), ENT_QUOTES, 'UTF-8');?>
" />

<div class="tabs cm-j-tabs">
    <ul class="nav nav-tabs">
        <li class="cm-js active"><a><?php echo $_smarty_tpl->__("general");?>
</a></li>
    </ul>
</div>

<div class="cm-tabs-content">
    <div class="control-group cm-no-hide-input">
        <label class="control-label" for="elm_grid_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("width");?>
</label>
        <div class="controls">
        <select id="elm_grid_width_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="width">
            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["width"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['name'] = "width";
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['start'] = (int) (($tmp = @$_smarty_tpl->tpl_vars['grid_params']->value['min_width'])===null||$tmp==='' ? 1 : $tmp)-(($tmp = @1)===null||$tmp==='' ? 0 : $tmp);
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['loop'] = is_array($_loop=(($tmp = @$_smarty_tpl->tpl_vars['grid_params']->value['max_width'])===null||$tmp==='' ? 24 : $tmp)) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["width"]['total']);
?>
                <?php $_smarty_tpl->tpl_vars['index'] = new Smarty_variable($_smarty_tpl->getVariable('smarty')->value['section']['width']['index']+1, null, 0);?>
                <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['index']->value, ENT_QUOTES, 'UTF-8');?>
"
                        <?php if ($_smarty_tpl->tpl_vars['index']->value==$_smarty_tpl->tpl_vars['grid']->value['width']) {?>selected="selected"<?php }?>
                ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['index']->value, ENT_QUOTES, 'UTF-8');?>
</option>
            <?php endfor; endif; ?>
        </select>
        </div>
    </div>

    <div class="control-group cm-no-hide-input">
        <label class="control-label" for="elm_grid_content_align_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("content_alignment");?>
</label>
        <div class="controls">
        <select id="elm_grid_content_align_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="content_align">
            <option value="<?php echo htmlspecialchars(constant("\Tygh\BlockManager\Grid::ALIGN_FULL_WIDTH"), ENT_QUOTES, 'UTF-8');?>
"
                    <?php if ($_smarty_tpl->tpl_vars['grid']->value['content_align']==constant("\Tygh\BlockManager\Grid::ALIGN_FULL_WIDTH")) {?>selected="selected"<?php }?>
            ><?php echo $_smarty_tpl->__("full_width");?>
</option>
            <option value="<?php echo htmlspecialchars(constant("\Tygh\BlockManager\Grid::ALIGN_LEFT"), ENT_QUOTES, 'UTF-8');?>
"
                    <?php if ($_smarty_tpl->tpl_vars['grid']->value['content_align']==constant("\Tygh\BlockManager\Grid::ALIGN_LEFT")) {?>selected="selected"<?php }?>
            ><?php echo $_smarty_tpl->__("left");?>
</option>
            <option value="<?php echo htmlspecialchars(constant("\Tygh\BlockManager\Grid::ALIGN_RIGHT"), ENT_QUOTES, 'UTF-8');?>
"
                    <?php if ($_smarty_tpl->tpl_vars['grid']->value['content_align']==constant("\Tygh\BlockManager\Grid::ALIGN_RIGHT")) {?>selected="selected"<?php }?>
            ><?php echo $_smarty_tpl->__("right");?>
</option>
        </select>
        </div>
    </div>

    <div class="control-group cm-no-hide-input">
        <label class="control-label" for="elm_grid_wrapper_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("wrapper");?>
</label>
        <div class="controls">
            <select id="elm_grid_wrapper_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="wrapper">
                <option value=""><?php echo $_smarty_tpl->__("none");?>
</option>
                <?php  $_smarty_tpl->tpl_vars['wrapper_template'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wrapper_template']->_loop = false;
 $_smarty_tpl->tpl_vars['wrapper_name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['grids_schema']->value['wrappers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wrapper_template']->key => $_smarty_tpl->tpl_vars['wrapper_template']->value) {
$_smarty_tpl->tpl_vars['wrapper_template']->_loop = true;
 $_smarty_tpl->tpl_vars['wrapper_name']->value = $_smarty_tpl->tpl_vars['wrapper_template']->key;
?>
                    <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wrapper_template']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['wrapper_template']->value==$_smarty_tpl->tpl_vars['grid']->value['wrapper']) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wrapper_name']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="control-group cm-no-hide-input">
        <label class="control-label" for="elm_grid_offset_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("offset");?>
</label>
        <div class="controls">
        <select id="elm_grid_offset_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="offset">
            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]);
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['name'] = "offset";
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['start'] = (int) 0;
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['loop'] = is_array($_loop=(($tmp = @$_smarty_tpl->tpl_vars['grid_params']->value['max_width'])===null||$tmp==='' ? 24 : $tmp)) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']["offset"]['total']);
?>
                <?php $_smarty_tpl->tpl_vars["index"] = new Smarty_variable($_smarty_tpl->getVariable('smarty')->value['section']['offset']['index'], null, 0);?>
                <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['index']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['index']->value==$_smarty_tpl->tpl_vars['grid']->value['offset']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['index']->value, ENT_QUOTES, 'UTF-8');?>
</option>
            <?php endfor; endif; ?>
        </select>
        </div>
    </div>

    <div class="control-group cm-no-hide-input">
        <label class="control-label" for="elm_grid_user_class_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("user_class");?>
</label>
        <div class="controls">
        <input id="elm_grid_user_class_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="user_class" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['grid']->value['user_class'], ENT_QUOTES, 'UTF-8');?>
" type="text" />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label cm-required cm-multiple-checkboxes"
               for="grid_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
_availability"
        ><?php echo $_smarty_tpl->__("block_manager.availability.show_on");?>
</label>
        <div class="controls" id="grid_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
_availability">
            <div class="btn-group btn-group-checkbox">
                <?php  $_smarty_tpl->tpl_vars['is_available'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['is_available']->_loop = false;
 $_smarty_tpl->tpl_vars['device'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['grid']->value['availability']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['is_available']->key => $_smarty_tpl->tpl_vars['is_available']->value) {
$_smarty_tpl->tpl_vars['is_available']->_loop = true;
 $_smarty_tpl->tpl_vars['device']->value = $_smarty_tpl->tpl_vars['is_available']->key;
?>
                
                    <?php if ($_smarty_tpl->tpl_vars['device']->value=="phone") {?>
                        <?php $_smarty_tpl->tpl_vars['devices_icon'] = new Smarty_variable("icon-mobile-phone", null, 0);?>
                    <?php } elseif ($_smarty_tpl->tpl_vars['device']->value=="tablet") {?>
                        <?php $_smarty_tpl->tpl_vars['devices_icon'] = new Smarty_variable("icon-tablet", null, 0);?>
                    <?php } elseif ($_smarty_tpl->tpl_vars['device']->value=="desktop") {?>
                        <?php $_smarty_tpl->tpl_vars['devices_icon'] = new Smarty_variable("icon-desktop", null, 0);?>
                    <?php }?>

                    <input type="checkbox"
                        id="elm_grid_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
_show_on_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['device']->value, ENT_QUOTES, 'UTF-8');?>
"
                        class="cm-text-toggle btn-group-checkbox__checkbox"
                        <?php if ($_smarty_tpl->tpl_vars['is_available']->value) {?>checked="checked"<?php }?>
                        data-ca-toggle-text="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['grid_availability_instance']->value->getHiddenClass($_smarty_tpl->tpl_vars['device']->value), ENT_QUOTES, 'UTF-8');?>
"
                        data-ca-toggle-text-mode="onDisable"
                        data-ca-toggle-text-target-elem-id="elm_grid_user_class_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
"
                    />
                    <label class="btn btn-group-checkbox__label" for="elm_grid_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
_show_on_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['device']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <i class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['devices_icon']->value, ENT_QUOTES, 'UTF-8');?>
"></i>
                        <?php echo $_smarty_tpl->__("block_manager.availability.".((string)$_smarty_tpl->tpl_vars['device']->value));?>

                    </label>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"block_manager_update_grid:settings")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"block_manager_update_grid:settings"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"block_manager_update_grid:settings"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    
</div>

<div class="buttons-container">
    <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[block_manager.grid.update]",'cancel_action'=>"close",'but_meta'=>"cm-dialog-closer",'save'=>$_smarty_tpl->tpl_vars['id']->value), 0);?>

</div>
</form>
<!--grid_properties_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['elm_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
<?php }} ?>
