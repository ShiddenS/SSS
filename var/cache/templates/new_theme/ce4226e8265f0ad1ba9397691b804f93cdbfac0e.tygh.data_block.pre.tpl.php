<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 12:50:54
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\addons\discussion\hooks\products\data_block.pre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19201982915db2c57ee0ed80-75435732%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce4226e8265f0ad1ba9397691b804f93cdbfac0e' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\addons\\discussion\\hooks\\products\\data_block.pre.tpl',
      1 => 1571327788,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '19201982915db2c57ee0ed80-75435732',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'show_rating' => 0,
    'product' => 0,
    'average_rating' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2c57ee59bf5_04377865',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2c57ee59bf5_04377865')) {function content_5db2c57ee59bf5_04377865($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['show_rating']->value) {?>

    <?php if ($_smarty_tpl->tpl_vars['product']->value['discussion_type']&&$_smarty_tpl->tpl_vars['product']->value['discussion_type']=="R"||$_smarty_tpl->tpl_vars['product']->value['discussion_type']=="B") {?>
        <?php if ($_smarty_tpl->tpl_vars['product']->value['average_rating']) {?>
            <?php $_smarty_tpl->tpl_vars['average_rating'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['average_rating'], null, 0);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['discussion']['average_rating']) {?>
            <?php $_smarty_tpl->tpl_vars['average_rating'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['discussion']['average_rating'], null, 0);?>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['average_rating']->value>0) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("addons/discussion/views/discussion/components/stars.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('stars'=>fn_get_discussion_rating($_smarty_tpl->tpl_vars['average_rating']->value),'link'=>"products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])."&selected_section=discussion#discussion"), 0);?>

        <?php }?>

    <?php }?>

<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/discussion/hooks/products/data_block.pre.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/discussion/hooks/products/data_block.pre.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['show_rating']->value) {?>

    <?php if ($_smarty_tpl->tpl_vars['product']->value['discussion_type']&&$_smarty_tpl->tpl_vars['product']->value['discussion_type']=="R"||$_smarty_tpl->tpl_vars['product']->value['discussion_type']=="B") {?>
        <?php if ($_smarty_tpl->tpl_vars['product']->value['average_rating']) {?>
            <?php $_smarty_tpl->tpl_vars['average_rating'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['average_rating'], null, 0);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['discussion']['average_rating']) {?>
            <?php $_smarty_tpl->tpl_vars['average_rating'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['discussion']['average_rating'], null, 0);?>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['average_rating']->value>0) {?>
            <?php echo $_smarty_tpl->getSubTemplate ("addons/discussion/views/discussion/components/stars.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('stars'=>fn_get_discussion_rating($_smarty_tpl->tpl_vars['average_rating']->value),'link'=>"products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])."&selected_section=discussion#discussion"), 0);?>

        <?php }?>

    <?php }?>

<?php }?>
<?php }?><?php }} ?>
