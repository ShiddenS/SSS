<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:12:07
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\addons\help_tutorial\hooks\index\content_top.pre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20153675485daf1c474dbcc2-67276887%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c7701f76d54e07d54d70cc137f4c0f2101311b7' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\addons\\help_tutorial\\hooks\\index\\content_top.pre.tpl',
      1 => 1568373053,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '20153675485daf1c474dbcc2-67276887',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1c47713ef1_87789304',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1c47713ef1_87789304')) {function content_5daf1c47713ef1_87789304($_smarty_tpl) {?><?php if (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="block_manager"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("b9F9DGfS34E","H8-3jFXHnIY","0hrAdg8mZ2o","QfNsC4vlPIE"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="themes"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("ujQk7z0awNk"),'open'=>false), 0);?>

<?php } elseif ((fn_allowed_for("ULTIMATE")&&$_smarty_tpl->tpl_vars['runtime']->value['controller']=="companies"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("2nN7DRQ5d8E"),'open'=>fn_allowed_for("ULTIMATE:FREE")&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=='manage','videos_link'=>true), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="index"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="index")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("L2xJJ3zRgig","xNSRtm55ekA","ygiaNCPPT0w"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="seo_rules"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("yNEGtUM3sZs"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="categories"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("jBLJZrGVaAk","21cYpyQZ248"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="products"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("_ZF4Wf_jSY4"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="products"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="update")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("ZyX60aPH8Kg"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="products"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="add")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("ZyX60aPH8Kg"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings_wizard"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="view")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("JqoZaeR29BA"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="menus"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("bL0e7bB17fM"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="templates"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("jk-XPTMTPKE"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="tabs"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("kXF-c5yorec"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="seo_redirects"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("HMyT67CuTKs"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="discussion_manager"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("kcDONAIcde0"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="sitemap"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("IIMa8iIsvh4"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="promotions"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("R7UDijsQjJ8","mzEeklPWrRI","Sbb-vjd4aEc"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="cart"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="cart_list")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("6jqFZ173JPY"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="newsletters"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("n3WRSRbtiNg"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="gift_certificates"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("9ozF0Kern9U"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="banners"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("VbJcUXLBlSw"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="profile_fields"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("lPsm4LmiUqA"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="shippings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("mx1GYt_v8qk"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="payments"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("iocWxNnzTS0"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="orders"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("RxQv7AZ3eMM"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="languages"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("th0MFbmw_rw"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="languages"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="translations")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("th0MFbmw_rw"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="exim"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="export")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("fR-N7gbwrsY"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="exim"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="import")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("KAvcOkSfq70"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="General")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("9Cbcz98CLLQ"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Appearance")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("e31Gqduf8E4"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Company")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("LqzMQmdh8MI"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Stores")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("LqzMQmdh8MI"),'params'=>"&start=62",'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Checkout")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("mSan90fzgDk"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Emails")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("JGWn6mm2ESI"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Thumbnails")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("3QkZqI8ACig"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Security")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("Tkm7hTBew4c"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Sitemap")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("KUyg54ZmCBo"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Upgrade_center")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("5SKkeuZlmr4"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Logging")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("JqoZaeR29BA"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="settings"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['section_id']=="Reports")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("JqoZaeR29BA"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="discussion"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="update"&&$_REQUEST['discussion_type']=="E")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("kcDONAIcde0"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="profiles"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['user_type']=="A")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("JNe_YhHyQ48"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="profiles"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['user_type']=="C")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("PnZ4AdYXzTM","lom4xHHsS3o"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="file_editor"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("sOKSbZAcTAU"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="pages"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['get_tree']=="multi_level"&&$_REQUEST['page_type']!="B")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("oJj1k790Kj0","c3KH4UOBCK0","whCqKKghECc"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="pages"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage"&&$_REQUEST['get_tree']=="multi_level"&&$_REQUEST['page_type']=="B")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("7esgMkMLCbc"),'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="product_filters"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("ZRFmJlxtGQ0"),'params'=>"&start=3",'open'=>false), 0);?>

<?php } elseif (($_smarty_tpl->tpl_vars['runtime']->value['controller']=="product_features"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="manage")) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("addons/help_tutorial/components/video_sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('items'=>array("b9c_K3oldHg"),'params'=>"&start=2",'open'=>false), 0);?>

<?php }?><?php }} ?>
