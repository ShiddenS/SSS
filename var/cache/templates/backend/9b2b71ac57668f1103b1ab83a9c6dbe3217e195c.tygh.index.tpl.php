<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:11:51
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\views\index\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18844269505daf1c37c19961-35892997%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b2b71ac57668f1103b1ab83a9c6dbe3217e195c' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\views\\index\\index.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '18844269505daf1c37c19961-35892997',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'show_dashboard_preloader' => 0,
    'show_welcome' => 0,
    'company' => 0,
    'config' => 0,
    'auth' => 0,
    'user_data' => 0,
    'c_url' => 0,
    'link_storefront' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1c381af932_72090072',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1c381af932_72090072')) {function content_5daf1c381af932_72090072($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\function.script.php';
if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('dashboard','installer_complete_title','welcome_screen.administrator_info','admin_panel','welcome_screen.go_admin_panel','welcome_screen.go_settings_wizard','settings_wizard','welcome_screen.run_settings_wizard','storefront','welcome_screen.go_storefront','welcome_screen.learn_more_configuration','welcome_screen.knowledge_base','welcome_screen.thanks'));
?>
<?php echo smarty_function_script(array('src'=>"js/tygh/tabs.js"),$_smarty_tpl);?>

<?php echo smarty_function_script(array('src'=>"js/tygh/backend/dashboard.js"),$_smarty_tpl);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['show_dashboard_preloader']->value) {?>
        <?php echo $_smarty_tpl->getSubTemplate ("views/index/components/dashboard_preloader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php } else { ?>
        <?php echo $_smarty_tpl->getSubTemplate ("views/index/components/dashboard.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('buttons'=>Smarty::$_smarty_vars['capture']['buttons'],'no_sidebar'=>true,'title'=>$_smarty_tpl->__("dashboard"),'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'tools'=>Smarty::$_smarty_vars['capture']['tools'],'box_id'=>"dashboard_content"), 0);?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:welcome_dialog")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:welcome_dialog"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if ($_smarty_tpl->tpl_vars['show_welcome']->value) {?>
    <div class="hidden cm-dialog-auto-open cm-dialog-auto-size" title="<?php echo $_smarty_tpl->__("installer_complete_title");?>
" id="after_install_dialog" data-ca-dialog-class="welcome-screen-dialog">
        <?php $_smarty_tpl->tpl_vars["company"] = new Smarty_variable(fn_get_company_data("1"), null, 0);?>
        <?php if (fn_allowed_for("ULTIMATE")) {?>
            <?php $_smarty_tpl->tpl_vars['link_storefront'] = new Smarty_variable("http://".((string)$_smarty_tpl->tpl_vars['company']->value['storefront']), null, 0);?>
        <?php } else { ?>
            <?php ob_start();
echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['config']->value['http_location']), ENT_QUOTES, 'UTF-8');
$_tmp5=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['link_storefront'] = new Smarty_variable($_tmp5, null, 0);?>
        <?php }?>
        <div class="welcome-screen">
            <p>
                <?php $_smarty_tpl->tpl_vars['user_data'] = new Smarty_variable(fn_get_user_info($_smarty_tpl->tpl_vars['auth']->value['user_id']), null, 0);?>
                <?php echo $_smarty_tpl->__("welcome_screen.administrator_info",array('[email]'=>$_smarty_tpl->tpl_vars['user_data']->value['email']));?>

            </p>
            <div class="welcome-location-wrapper clearfix">
                <div class="welcome-location-block pull-left center">
                    <h4 class="install-title"><?php echo $_smarty_tpl->__("admin_panel");?>
</h4>
                    <div class="welcome-screen-location welcome-screen-admin">
                        <div class="welcome-screen-overlay">
                            <a class="btn cm-dialog-closer welcome-screen-overlink"><?php echo $_smarty_tpl->__("welcome_screen.go_admin_panel");?>
</a>
                        </div>
                    </div>
                    <div class="welcome-screen-arrow"></div>
                    <p>
                        <?php echo $_smarty_tpl->__("welcome_screen.go_settings_wizard");?>

                    </p>
                    <?php $_smarty_tpl->tpl_vars['c_url'] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
                    <a class="cm-dialog-opener cm-ajax btn btn-primary strong" data-ca-target-id="content_settings_wizard" title="<?php echo $_smarty_tpl->__("settings_wizard");?>
" href="<?php echo htmlspecialchars(fn_url("settings_wizard.view?return_url=".((string)$_smarty_tpl->tpl_vars['c_url']->value)), ENT_QUOTES, 'UTF-8');?>
" target="_blank"><?php echo $_smarty_tpl->__("welcome_screen.run_settings_wizard");?>
</a>
                </div>
                <div class="welcome-location-block pull-right center">
                    <h4 class="install-title"><?php echo $_smarty_tpl->__("storefront");?>
</h4>
                    <div class="welcome-screen-location welcome-screen-store">
                        <div class="welcome-screen-overlay">
                            <a class="btn welcome-screen-overlink" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link_storefront']->value, ENT_QUOTES, 'UTF-8');?>
" target="_blank"><?php echo $_smarty_tpl->__("welcome_screen.go_storefront");?>
</a>
                        </div>
                    </div>
                    <div class="welcome-screen-arrow"></div>
                    <p>
                        <?php echo $_smarty_tpl->__("welcome_screen.learn_more_configuration");?>

                    </p>
                    <a class="kbase-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['resources']['knowledge_base'], ENT_QUOTES, 'UTF-8');?>
" target="_blank"><?php echo $_smarty_tpl->__("welcome_screen.knowledge_base");?>
</a>
                </div>
            </div>
            <div class="welcome-screen-social center">
                <p>
                    <?php echo $_smarty_tpl->__("welcome_screen.thanks",array("[product]"=>@constant('PRODUCT_NAME')));?>

                </p>
                <?php echo $_smarty_tpl->getSubTemplate ("common/share.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

            </div>
        </div>
    </div>
<?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:welcome_dialog"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>
