<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:17:26
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\discussion\views\discussion_manager\components\new_discussion_popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17603661505daf1d86b4ffe0-01162184%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8db0ed47c3a5e5a3119c2acac33c8b977674859a' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\discussion\\views\\discussion_manager\\components\\new_discussion_popup.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '17603661505daf1d86b4ffe0-01162184',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'object_company_id' => 0,
    'discussion' => 0,
    'config' => 0,
    'auth' => 0,
    'user_info' => 0,
    'post_data' => 0,
    'settings' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1d86c0c1d2_97130482',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1d86c0c1d2_97130482')) {function content_5daf1d86c0c1d2_97130482($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('general','name','creation_date','your_rating','your_message','add','new_post'));
?>
<?php if (fn_check_view_permissions("discussion.add")&&!(fn_allowed_for("MULTIVENDOR")&&$_smarty_tpl->tpl_vars['runtime']->value['company_id']&&($_smarty_tpl->tpl_vars['runtime']->value['company_id']!=$_smarty_tpl->tpl_vars['object_company_id']->value||$_smarty_tpl->tpl_vars['discussion']->value['object_type']=='M'))) {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("add_new_picker", null, null); ob_start(); ?>
        <div class="tabs cm-j-tabs">
            <ul class="nav nav-tabs">
                <li id="tab_add_post" class="cm-js active"><a><?php echo $_smarty_tpl->__("general");?>
</a></li>
            </ul>
        </div>
        <form id='form' action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" class="form-horizontal form-edit cm-disable-empty-files" enctype="multipart/form-data">

            <div class="cm-tabs-content cm-no-hide-input" id="content_tab_add_post">
                <input type ="hidden" name="post_data[thread_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['discussion']->value['thread_id'], ENT_QUOTES, 'UTF-8');?>
" />
                <input type ="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
&amp;selected_section=discussion" />

                <div class="control-group">
                    <label for="post_data_name" class="cm-required control-label"><?php echo $_smarty_tpl->__("name");?>
:</label>
                    <div class="controls">
                        <input type="text" name="post_data[name]" id="post_data_name" value="<?php if ($_smarty_tpl->tpl_vars['auth']->value['user_id']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['user_info']->value['firstname'], ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user_info']->value['lastname'], ENT_QUOTES, 'UTF-8');
}?>" disabled="disabled">
                    </div>
                </div>

                <div class="control-group">
                    <label for="post_data_timestamp" class="control-label"><?php echo $_smarty_tpl->__("creation_date");?>
:</label>
                    <div class="controls">
                        <?php echo $_smarty_tpl->getSubTemplate ("common/calendar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('date_id'=>"post_data_timestamp",'date_name'=>"post_data[date]",'date_val'=>(($tmp = @$_smarty_tpl->tpl_vars['post_data']->value['timestamp'])===null||$tmp==='' ? @constant('TIME') : $tmp),'start_year'=>$_smarty_tpl->tpl_vars['settings']->value['Company']['company_start_year'],'show_time'=>true,'time_name'=>"post_data[time]"), 0);?>

                    </div>
                </div>

                <?php if (fn_check_view_permissions("discussion.update")) {?>
                    <?php if ($_smarty_tpl->tpl_vars['discussion']->value['type']=="R"||$_smarty_tpl->tpl_vars['discussion']->value['type']=="B") {?>
                        <div class="control-group">
                            <label for="rating_value" class="control-label cm-required cm-multiple-radios"><?php echo $_smarty_tpl->__("your_rating");?>
</label>
                            <div class="controls clearfix">
                                <?php echo $_smarty_tpl->getSubTemplate ("addons/discussion/views/discussion_manager/components/rate.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('rate_id'=>"rating_value",'rate_name'=>"post_data[rating_value]",'disabled'=>true), 0);?>

                            </div>
                        </div>
                    <?php }?>
                <?php }?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"discussion:add_post")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"discussion:add_post"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php if ($_smarty_tpl->tpl_vars['discussion']->value['type']=="C"||$_smarty_tpl->tpl_vars['discussion']->value['type']=="B") {?>
                    <div class="control-group">
                        <label for="message" class="control-label"><?php echo $_smarty_tpl->__("your_message");?>
:</label>
                        <div class="controls">
                            <textarea name="post_data[message]" id="message" class="input-textarea-long" cols="70" rows="8" disabled="disabled"></textarea>
                        </div>
                    </div>
                <?php }?>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"discussion:add_post"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            </div>

            <div class="buttons-container">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>$_smarty_tpl->__("add"),'but_name'=>"dispatch[discussion.add]",'cancel_action'=>"close",'hide_first_button'=>false), 0);?>

            </div>

        </form>
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

    <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"add_new_post",'text'=>$_smarty_tpl->__("new_post"),'content'=>Smarty::$_smarty_vars['capture']['add_new_picker'],'act'=>"fake"), 0);?>

<?php }?>
<?php }} ?>
