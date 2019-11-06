<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:49
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\block_manager\render\grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7896043725daf1d9d6527e6-52962835%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8adb825af6da95e2642e80c2e1c2054115c284f2' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\block_manager\\render\\grid.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '7896043725daf1d9d6527e6-52962835',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'default_class' => 0,
    'grid' => 0,
    'content' => 0,
    'layout_data' => 0,
    'parent_grid' => 0,
    'fluid_width' => 0,
    'container' => 0,
    'dynamic_object' => 0,
    'show_menu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d9d786590_35119123',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d9d786590_35119123')) {function content_5daf1d9d786590_35119123($_smarty_tpl) {?><?php
\Tygh\Languages\Helper::preloadLangVars(array('grid','add_grid_block','insert_grid','insert_block','grid_options','enable_or_disable_grid','delete_grid','editing_grid','insert_grid','insert_block','grid_options','delete_grid','on_off'));
?>
<div class="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['default_class']->value)===null||$tmp==='' ? "device-specific-block grid" : $tmp), ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['grid']->value['status']!="A") {?>grid-off<?php }?> grid_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['grid']->value['width'], ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['grid']->value['offset']) {?>prefix_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['grid']->value['offset'], ENT_QUOTES, 'UTF-8');
}?> <?php if ($_smarty_tpl->tpl_vars['grid']->value['alpha']) {?>alpha<?php }?> <?php if ($_smarty_tpl->tpl_vars['grid']->value['omega']) {?>omega<?php }?> <?php if ($_smarty_tpl->tpl_vars['grid']->value['content_align']==constant("\Tygh\BlockManager\Grid::ALIGN_RIGHT")) {?>bm-right-align<?php } elseif ($_smarty_tpl->tpl_vars['grid']->value['content_align']==constant("\Tygh\BlockManager\Grid::ALIGN_LEFT")) {?>bm-left-align<?php } else { ?>bm-full-width<?php }?>"
     data-ca-status="<?php if ($_smarty_tpl->tpl_vars['grid']->value['status']!="A") {?>disabled<?php } else { ?>active<?php }?>"
     <?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/components/device_availability_attributes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('item'=>$_smarty_tpl->tpl_vars['grid']->value), 0);?>

     id="grid_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['grid']->value['grid_id'], ENT_QUOTES, 'UTF-8');?>
"
>
    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

    <div class="bm-full-menu grid-control-menu bm-control-menu <?php if ($_smarty_tpl->tpl_vars['grid']->value['width']<=2) {?>hidden keep-hidden<?php }?>">
        <?php echo $_smarty_tpl->getSubTemplate ("views/block_manager/components/device_icons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('item'=>$_smarty_tpl->tpl_vars['grid']->value,'wrapper_class'=>"pull-right"), 0);?>

        <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['layout_width']!="fixed") {?>
            <?php if ($_smarty_tpl->tpl_vars['parent_grid']->value['width']>0) {?>
                <?php $_smarty_tpl->tpl_vars['fluid_width'] = new Smarty_variable(fn_get_grid_fluid_width($_smarty_tpl->tpl_vars['layout_data']->value['width'],$_smarty_tpl->tpl_vars['parent_grid']->value['width'],$_smarty_tpl->tpl_vars['grid']->value['width']), null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars['fluid_width'] = new Smarty_variable($_smarty_tpl->tpl_vars['grid']->value['width'], null, 0);?>
            <?php }?>
        <?php }?>
        <h4 class="grid-control-title <?php if ($_smarty_tpl->tpl_vars['grid']->value['width']<=2) {?>hidden<?php }?>">
            <?php echo $_smarty_tpl->__("grid");?>
&nbsp;<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['grid']->value['width'])===null||$tmp==='' ? "0" : $tmp), ENT_QUOTES, 'UTF-8');?>

            <?php if ($_smarty_tpl->tpl_vars['layout_data']->value['layout_width']!="fixed"&&$_smarty_tpl->tpl_vars['fluid_width']->value>0) {?>
                <small class="muted">(span <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['fluid_width']->value, ENT_QUOTES, 'UTF-8');?>
)</small>
            <?php }?>
        </h4>
        <?php if ($_smarty_tpl->tpl_vars['container']->value['default']==1||$_smarty_tpl->tpl_vars['container']->value['has_displayable_content']&&!$_smarty_tpl->tpl_vars['dynamic_object']->value||$_smarty_tpl->tpl_vars['show_menu']->value||$_smarty_tpl->tpl_vars['container']->value['linked_to_default']!="Y") {?>
            
            <div class="grid-control-menu-actions">
                <div class="btn-group action">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='icon-plus cm-tooltip' data-ce-tooltip-position="top" title="<?php echo $_smarty_tpl->__("add_grid_block");?>
"></span></a>
                    <ul class="dropdown-menu droptop">
                        <li><a href="" class="cm-action bm-action-add-grid"><?php echo $_smarty_tpl->__("insert_grid");?>
</a></li>
                        <li><a href="" class="cm-action bm-action-add-block"><?php echo $_smarty_tpl->__("insert_block");?>
</a></li>
                    </ul>
                </div>
                <div class="cm-action bm-action-properties cm-tooltip icon-cog action" data-ce-tooltip-position="top" title="<?php echo $_smarty_tpl->__("grid_options");?>
"></div>
                <div class="cm-action bm-action-switch cm-tooltip icon-off action" data-ce-tooltip-position="top" title="<?php echo $_smarty_tpl->__("enable_or_disable_grid");?>
"></div>
                <div class="cm-action bm-action-delete cm-tooltip pull-right icon-trash extra action" data-ce-tooltip-position="top" title="<?php echo $_smarty_tpl->__("delete_grid");?>
"></div>
            </div>
        <?php }?>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['container']->value['default']==1||$_smarty_tpl->tpl_vars['container']->value['has_displayable_content']&&!$_smarty_tpl->tpl_vars['dynamic_object']->value||$_smarty_tpl->tpl_vars['show_menu']->value||$_smarty_tpl->tpl_vars['container']->value['linked_to_default']!="Y") {?>
        <div class="bm-compact-menu <?php if ($_smarty_tpl->tpl_vars['grid']->value['width']>2) {?>hidden keep-hidden<?php }?> grid-control-menu bm-control-menu">
            <div class="action-showmenu">
                <div class="btn-group action">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='icon-align-justify cm-tooltip' title="<?php echo $_smarty_tpl->__("editing_grid");?>
"></span></a>
                        <ul class="dropdown-menu droptop">
                            <li><a class="cm-action bm-action-add-grid hand"><?php echo $_smarty_tpl->__("insert_grid");?>
</a></li>
                            <li><a class="cm-action bm-action-add-block hand"><?php echo $_smarty_tpl->__("insert_block");?>
</a></li>
                            <li><a class="cm-action bm-action-properties hand"><?php echo $_smarty_tpl->__("grid_options");?>
</a></li>
                            <li><a class="cm-action bm-action-delete hand"><?php echo $_smarty_tpl->__("delete_grid");?>
</a></li>
                            <li><a class="cm-action bm-action-switch hand"><?php echo $_smarty_tpl->__("on_off");?>
</a></li>
                        </ul>
                </div>

            </div>
        </div>
    <?php }?>
<!--grid_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['grid']->value['grid_id'], ENT_QUOTES, 'UTF-8');?>
--></div>

<?php if ($_smarty_tpl->tpl_vars['grid']->value['clear']) {?>
    <div class="clearfix"></div>
<?php }?>
<?php }} ?>
