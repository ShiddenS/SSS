<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:50
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\block_manager\components\device_switch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:603832015daf1d9e7719e5-18608801%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20feb9693d2edd998d67e501836a677b29dc980a' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\block_manager\\components\\device_switch.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '603832015daf1d9e7719e5-18608801',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'devices' => 0,
    'device' => 0,
    'device_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d9e7f55e4_41835157',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d9e7f55e4_41835157')) {function content_5daf1d9e7f55e4_41835157($_smarty_tpl) {?><?php
\Tygh\Languages\Helper::preloadLangVars(array('block_manager.view_layout.phone','block_manager.view_layout.tablet','block_manager.view_layout.desktop','block_manager.view_layout.reset_filter'));
?>
<?php ob_start();
echo $_smarty_tpl->__("block_manager.view_layout.phone");
$_tmp5=ob_get_clean();?><?php ob_start();
echo $_smarty_tpl->__("block_manager.view_layout.tablet");
$_tmp6=ob_get_clean();?><?php ob_start();
echo $_smarty_tpl->__("block_manager.view_layout.desktop");
$_tmp7=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['devices'] = new Smarty_variable(array(''=>array("name"=>$_smarty_tpl->__("block_manager.view_layout.reset_filter"),"icon_class"=>'',"btn_class"=>"btn btn-primary cm-reset-device-availability"),"phone"=>array("name"=>"<span class=\"mobile-hidden\">".$_tmp5."</span>","icon_class"=>"icon-mobile-phone","btn_class"=>"btn cm-switch-device-availability"),"tablet"=>array("name"=>"<span class=\"mobile-hidden\">".$_tmp6."</span>","icon_class"=>"icon-tablet","btn_class"=>"btn cm-switch-device-availability"),"desktop"=>array("name"=>"<span class=\"mobile-hidden\">".$_tmp7."</span>","icon_class"=>"icon-desktop","btn_class"=>"btn cm-switch-device-availability")), null, 0);?>

<div class="device-switch-wrap" id="device_switch">
    <div class="btn-group device-switch">
        <?php  $_smarty_tpl->tpl_vars['device'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['device']->_loop = false;
 $_smarty_tpl->tpl_vars['device_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['devices']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['device']->key => $_smarty_tpl->tpl_vars['device']->value) {
$_smarty_tpl->tpl_vars['device']->_loop = true;
 $_smarty_tpl->tpl_vars['device_id']->value = $_smarty_tpl->tpl_vars['device']->key;
?>
            <?php smarty_template_function_btn($_smarty_tpl,array('type'=>"text",'text'=>$_smarty_tpl->tpl_vars['device']->value['name'],'icon'=>$_smarty_tpl->tpl_vars['device']->value['icon_class'],'icon_first'=>true,'raw'=>true,'class'=>"device-switch__device ".((string)$_smarty_tpl->tpl_vars['device']->value['btn_class']),'data'=>array("data-ca-device-availability-device"=>$_smarty_tpl->tpl_vars['device_id']->value)));?>

        <?php } ?>
    </div>
<!--device_switch--></div>
<?php }} ?>
