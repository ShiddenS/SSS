<?php /* Smarty version Smarty-3.1.21, created on 2019-10-25 12:50:43
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\common\pagination.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19656780955db2c573c51ea1-89816882%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e74577a8dff65850d3ac6e974346d8636c9f8981' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\common\\pagination.tpl',
      1 => 1571056101,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '19656780955db2c573c51ea1-89816882',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'search' => 0,
    'save_current_page' => 0,
    'save_current_url' => 0,
    'config' => 0,
    'pagination' => 0,
    'settings' => 0,
    'force_ajax' => 0,
    'c_url' => 0,
    'extra_url' => 0,
    'ajax_class' => 0,
    'pg' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db2c573e141f6_07859929',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db2c573e141f6_07859929')) {function content_5db2c573e141f6_07859929($_smarty_tpl) {?><?php
\Tygh\Languages\Helper::preloadLangVars(array('prev_page','next'));
?>
<?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['id']->value)===null||$tmp==='' ? "pagination_contents" : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars["pagination"] = new Smarty_variable(fn_generate_pagination($_smarty_tpl->tpl_vars['search']->value), null, 0);?>

<?php if (Smarty::$_smarty_vars['capture']['pagination_open']!="Y") {?>
    <div class="ty-pagination-container cm-pagination-container" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
">

    <?php if ($_smarty_tpl->tpl_vars['save_current_page']->value) {?>
        <input type="hidden" name="page" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['search']->value['page'])===null||$tmp==='' ? $_REQUEST['page'] : $tmp), ENT_QUOTES, 'UTF-8');?>
" />
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['save_current_url']->value) {?>
        <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />
    <?php }?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['pagination']->value['total_pages']>1) {?>
    <?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['top_pagination']=="Y"&&Smarty::$_smarty_vars['capture']['pagination_open']!="Y"||Smarty::$_smarty_vars['capture']['pagination_open']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars["c_url"] = new Smarty_variable(fn_query_remove($_smarty_tpl->tpl_vars['config']->value['current_url'],"page"), null, 0);?>

    <?php if (!$_smarty_tpl->tpl_vars['config']->value['tweaks']['disable_dhtml']||$_smarty_tpl->tpl_vars['force_ajax']->value) {?>
        <?php $_smarty_tpl->tpl_vars["ajax_class"] = new Smarty_variable("cm-ajax", null, 0);?>
    <?php }?>

    <?php if (Smarty::$_smarty_vars['capture']['pagination_open']=="Y") {?>
    <div class="ty-pagination__bottom">
    <?php }?>
    <div class="ty-pagination">
        <?php if ($_smarty_tpl->tpl_vars['pagination']->value['prev_range']) {?>
            <a data-ca-scroll=".cm-pagination-container" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&page=".((string)$_smarty_tpl->tpl_vars['pagination']->value['prev_range']).((string)$_smarty_tpl->tpl_vars['extra_url']->value)), ENT_QUOTES, 'UTF-8');?>
" data-ca-page="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pagination']->value['prev_range'], ENT_QUOTES, 'UTF-8');?>
" class="cm-history hidden-phone ty-pagination__item ty-pagination__range <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_class']->value, ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pagination']->value['prev_range_from'], ENT_QUOTES, 'UTF-8');?>
 - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pagination']->value['prev_range_to'], ENT_QUOTES, 'UTF-8');?>
</a>
        <?php }?>
        <a data-ca-scroll=".cm-pagination-container" class="ty-pagination__item ty-pagination__btn <?php if ($_smarty_tpl->tpl_vars['pagination']->value['prev_page']) {?>ty-pagination__prev cm-history <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_class']->value, ENT_QUOTES, 'UTF-8');
}?>" <?php if ($_smarty_tpl->tpl_vars['pagination']->value['prev_page']) {?>href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&page=".((string)$_smarty_tpl->tpl_vars['pagination']->value['prev_page'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-page="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pagination']->value['prev_page'], ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"<?php }?>><i class="ty-pagination__text-arrow"></i>&nbsp;<span class="ty-pagination__text"><?php echo $_smarty_tpl->__("prev_page");?>
</span></a>

        <div class="ty-pagination__items">
            <?php  $_smarty_tpl->tpl_vars["pg"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["pg"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pagination']->value['navi_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["pg"]->key => $_smarty_tpl->tpl_vars["pg"]->value) {
$_smarty_tpl->tpl_vars["pg"]->_loop = true;
?>
                <?php if ($_smarty_tpl->tpl_vars['pg']->value!=$_smarty_tpl->tpl_vars['pagination']->value['current_page']) {?>
                    <a data-ca-scroll=".cm-pagination-container" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&page=".((string)$_smarty_tpl->tpl_vars['pg']->value).((string)$_smarty_tpl->tpl_vars['extra_url']->value)), ENT_QUOTES, 'UTF-8');?>
" data-ca-page="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pg']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-history ty-pagination__item <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_class']->value, ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pg']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                <?php } else { ?>
                    <span class="ty-pagination__selected"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pg']->value, ENT_QUOTES, 'UTF-8');?>
</span>
                <?php }?>
            <?php } ?>
        </div>

        <a data-ca-scroll=".cm-pagination-container" class="ty-pagination__item ty-pagination__btn <?php if ($_smarty_tpl->tpl_vars['pagination']->value['next_page']) {?>ty-pagination__next cm-history <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_class']->value, ENT_QUOTES, 'UTF-8');
}?> ty-pagination__right-arrow" <?php if ($_smarty_tpl->tpl_vars['pagination']->value['next_page']) {?>href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&page=".((string)$_smarty_tpl->tpl_vars['pagination']->value['next_page']).((string)$_smarty_tpl->tpl_vars['extra_url']->value)), ENT_QUOTES, 'UTF-8');?>
" data-ca-page="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pagination']->value['next_page'], ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"<?php }?>><span class="ty-pagination__text"><?php echo $_smarty_tpl->__("next");?>
</span>&nbsp;<i class="ty-pagination__text-arrow"></i></a>

        <?php if ($_smarty_tpl->tpl_vars['pagination']->value['next_range']) {?>
            <a data-ca-scroll=".cm-pagination-container" href="<?php echo htmlspecialchars(fn_url(((string)$_smarty_tpl->tpl_vars['c_url']->value)."&page=".((string)$_smarty_tpl->tpl_vars['pagination']->value['next_range']).((string)$_smarty_tpl->tpl_vars['extra_url']->value)), ENT_QUOTES, 'UTF-8');?>
" data-ca-page="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pagination']->value['next_range'], ENT_QUOTES, 'UTF-8');?>
" class="cm-history ty-pagination__item hidden-phone ty-pagination__range <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_class']->value, ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pagination']->value['next_range_from'], ENT_QUOTES, 'UTF-8');?>
 - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pagination']->value['next_range_to'], ENT_QUOTES, 'UTF-8');?>
</a>
        <?php }?>
    </div>
    <?php if (Smarty::$_smarty_vars['capture']['pagination_open']=="Y") {?>
        </div>
    <?php }?>
    <?php } else { ?>
        <div><a data-ca-scroll=".cm-pagination-container" href="" data-ca-page="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pg']->value, ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" class="hidden"></a></div>
    <?php }?>
<?php }?>

<?php if (Smarty::$_smarty_vars['capture']['pagination_open']=="Y") {?>
    <!--<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
    <?php $_smarty_tpl->_capture_stack[0][] = array("pagination_open", null, null); ob_start(); ?>N<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php } elseif (Smarty::$_smarty_vars['capture']['pagination_open']!="Y") {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("pagination_open", null, null); ob_start(); ?>Y<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }?>
<?php }} ?>
