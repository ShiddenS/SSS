<?php /* Smarty version Smarty-3.1.21, created on 2019-10-24 10:07:21
         compiled from "F:\OSPanel\domains\test.local\design\themes\responsive\templates\addons\blog\hooks\pages\page_extra.pre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69378905db14da969b0a0-11256637%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c19dc179b5bf8654b0d28b0604104b50eada16b' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\themes\\responsive\\templates\\addons\\blog\\hooks\\pages\\page_extra.pre.tpl',
      1 => 1571327768,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '69378905db14da969b0a0-11256637',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'page' => 0,
    'subpages' => 0,
    'subpage' => 0,
    'settings' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5db14da978a9c5_79581997',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5db14da978a9c5_79581997')) {function content_5db14da978a9c5_79581997($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_live_edit')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.live_edit.php';
if (!is_callable('smarty_function_set_id')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.set_id.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('by','blog.read_more','by','blog.read_more'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['page']->value['page_type']==@constant('PAGE_TYPE_BLOG')) {?>

<?php if ($_smarty_tpl->tpl_vars['subpages']->value) {?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start();
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

    <div class="ty-blog">
        <?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


        <?php  $_smarty_tpl->tpl_vars["subpage"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["subpage"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subpages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["subpage"]->key => $_smarty_tpl->tpl_vars["subpage"]->value) {
$_smarty_tpl->tpl_vars["subpage"]->_loop = true;
?>
            <div class="ty-blog__item">
                <a href="<?php echo htmlspecialchars(fn_url("pages.view?page_id=".((string)$_smarty_tpl->tpl_vars['subpage']->value['page_id'])), ENT_QUOTES, 'UTF-8');?>
">
                    <h2 class="ty-blog__post-title">
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subpage']->value['page'], ENT_QUOTES, 'UTF-8');?>

                    </h2>
                </a>
                <div class="ty-blog__date"><?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['subpage']->value['timestamp'],((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['date_format'])), ENT_QUOTES, 'UTF-8');?>
</div>
                <div class="ty-blog__author"><?php echo $_smarty_tpl->__("by");?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subpage']->value['author'], ENT_QUOTES, 'UTF-8');?>
</div>
                <?php if ($_smarty_tpl->tpl_vars['subpage']->value['main_pair']) {?>
                <a href="<?php echo htmlspecialchars(fn_url("pages.view?page_id=".((string)$_smarty_tpl->tpl_vars['subpage']->value['page_id'])), ENT_QUOTES, 'UTF-8');?>
">
                    <div class="ty-blog__img-block">
                        <?php echo $_smarty_tpl->getSubTemplate ("common/image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('obj_id'=>$_smarty_tpl->tpl_vars['subpage']->value['page_id'],'images'=>$_smarty_tpl->tpl_vars['subpage']->value['main_pair']), 0);?>

                    </div>
                </a>
                <?php }?>
                <div class="ty-blog__description">
                    <div class="ty-wysiwyg-content">
                        <div><?php echo $_smarty_tpl->tpl_vars['subpage']->value['spoiler'];?>
</div>
                    </div>
                    <div class="ty-blog__read-more ty-mt-l">
                        <a class="ty-btn ty-btn__secondary" href="<?php echo htmlspecialchars(fn_url("pages.view?page_id=".((string)$_smarty_tpl->tpl_vars['subpage']->value['page_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("blog.read_more");?>
</a>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </div>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['page']->value['description']) {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start(); ?><span class="ty-blog__post-title" <?php echo smarty_function_live_edit(array('name'=>"page:page:".((string)$_smarty_tpl->tpl_vars['page']->value['page_id'])),$_smarty_tpl);?>
><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['page'], ENT_QUOTES, 'UTF-8');?>
</span><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }?>

<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/blog/hooks/pages/page_extra.pre.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/blog/hooks/pages/page_extra.pre.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['page']->value['page_type']==@constant('PAGE_TYPE_BLOG')) {?>

<?php if ($_smarty_tpl->tpl_vars['subpages']->value) {?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start();
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

    <div class="ty-blog">
        <?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


        <?php  $_smarty_tpl->tpl_vars["subpage"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["subpage"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['subpages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["subpage"]->key => $_smarty_tpl->tpl_vars["subpage"]->value) {
$_smarty_tpl->tpl_vars["subpage"]->_loop = true;
?>
            <div class="ty-blog__item">
                <a href="<?php echo htmlspecialchars(fn_url("pages.view?page_id=".((string)$_smarty_tpl->tpl_vars['subpage']->value['page_id'])), ENT_QUOTES, 'UTF-8');?>
">
                    <h2 class="ty-blog__post-title">
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subpage']->value['page'], ENT_QUOTES, 'UTF-8');?>

                    </h2>
                </a>
                <div class="ty-blog__date"><?php echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['subpage']->value['timestamp'],((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['date_format'])), ENT_QUOTES, 'UTF-8');?>
</div>
                <div class="ty-blog__author"><?php echo $_smarty_tpl->__("by");?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subpage']->value['author'], ENT_QUOTES, 'UTF-8');?>
</div>
                <?php if ($_smarty_tpl->tpl_vars['subpage']->value['main_pair']) {?>
                <a href="<?php echo htmlspecialchars(fn_url("pages.view?page_id=".((string)$_smarty_tpl->tpl_vars['subpage']->value['page_id'])), ENT_QUOTES, 'UTF-8');?>
">
                    <div class="ty-blog__img-block">
                        <?php echo $_smarty_tpl->getSubTemplate ("common/image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('obj_id'=>$_smarty_tpl->tpl_vars['subpage']->value['page_id'],'images'=>$_smarty_tpl->tpl_vars['subpage']->value['main_pair']), 0);?>

                    </div>
                </a>
                <?php }?>
                <div class="ty-blog__description">
                    <div class="ty-wysiwyg-content">
                        <div><?php echo $_smarty_tpl->tpl_vars['subpage']->value['spoiler'];?>
</div>
                    </div>
                    <div class="ty-blog__read-more ty-mt-l">
                        <a class="ty-btn ty-btn__secondary" href="<?php echo htmlspecialchars(fn_url("pages.view?page_id=".((string)$_smarty_tpl->tpl_vars['subpage']->value['page_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("blog.read_more");?>
</a>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </div>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['page']->value['description']) {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start(); ?><span class="ty-blog__post-title" <?php echo smarty_function_live_edit(array('name'=>"page:page:".((string)$_smarty_tpl->tpl_vars['page']->value['page_id'])),$_smarty_tpl);?>
><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['page'], ENT_QUOTES, 'UTF-8');?>
</span><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }?>

<?php }
}?><?php }} ?>
