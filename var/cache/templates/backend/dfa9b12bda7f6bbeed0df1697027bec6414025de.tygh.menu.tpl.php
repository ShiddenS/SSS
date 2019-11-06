<?php /* Smarty version Smarty-3.1.21, created on 2019-10-22 18:12:09
         compiled from "F:\OSPanel\domains\test.local\design\backend\templates\menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2764422995daf1c49e1ccc9-06146127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfa9b12bda7f6bbeed0df1697027bec6414025de' => 
    array (
      0 => 'F:\\OSPanel\\domains\\test.local\\design\\backend\\templates\\menu.tpl',
      1 => 1568373054,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '2764422995daf1c49e1ccc9-06146127',
  'function' => 
  array (
    'menu_attrs' => 
    array (
      'parameter' => 
      array (
        'attrs' => 
        array (
        ),
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'attrs' => 0,
    'attr' => 0,
    'value' => 0,
    'sticky_top' => 0,
    'sticky_padding' => 0,
    'runtime' => 0,
    'settings' => 0,
    'auth' => 0,
    'storefront_url' => 0,
    'name' => 0,
    'storefront_status_icon' => 0,
    'company_name' => 0,
    'navigation' => 0,
    'first_level_title' => 0,
    'm' => 0,
    'second_level' => 0,
    'second_level_title' => 0,
    'sm' => 0,
    'subitem_title' => 0,
    'languages' => 0,
    'currencies' => 0,
    'config' => 0,
    'secondary_currency' => 0,
    'user_info' => 0,
    'id_prefix' => 0,
    'onclick' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_5daf1c4a21d1e6_49473400',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5daf1c4a21d1e6_49473400')) {function content_5daf1c4a21d1e6_49473400($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\block.hook.php';
if (!is_callable('smarty_modifier_truncate')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.truncate.php';
if (!is_callable('smarty_modifier_enum')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.enum.php';
if (!is_callable('smarty_modifier_sizeof')) include 'F:/OSPanel/domains/test.local/app/functions/smarty_plugins\\modifier.sizeof.php';
?><?php
\Tygh\Languages\Helper::preloadLangVars(array('all_vendors','view_storefront','storefront_url_not_defined','manage_stores','vendor','manage_stores','view_storefront','vendor','manage_vendors','signed_in_as','edit_profile','sign_out','feedback_values','send_feedback','search_tooltip','close','vendor','signed_in_as','edit_profile','sign_out','manage_stores','feedback_values','send_feedback','view_storefront','view_storefront','view_storefront','view_storefront','home','language','currency','go_back','search','more'));
?>
<?php if (defined("THEMES_PANEL")) {?>
    <?php $_smarty_tpl->tpl_vars['sticky_top'] = new Smarty_variable(-5, null, 0);?>
    <?php $_smarty_tpl->tpl_vars['sticky_padding'] = new Smarty_variable(35, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['sticky_top'] = new Smarty_variable(-40, null, 0);?>
    <?php $_smarty_tpl->tpl_vars['sticky_padding'] = new Smarty_variable(0, null, 0);?>
<?php }?>

<?php if (!function_exists('smarty_template_function_menu_attrs')) {
    function smarty_template_function_menu_attrs($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['menu_attrs']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
    <?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['attr'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['attrs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['attr']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attr']->value, ENT_QUOTES, 'UTF-8');?>
="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['value']->value, ENT_QUOTES, 'UTF-8');?>
"
    <?php } ?>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>

<div class="navbar-admin-top cm-sticky-scroll" data-ca-stick-on-screens="sm-large,md,md-large,lg,uhd" data-ca-top="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sticky_top']->value, ENT_QUOTES, 'UTF-8');?>
" data-ca-padding="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sticky_padding']->value, ENT_QUOTES, 'UTF-8');?>
">
    <!--Navbar-->
    <div class="navbar navbar-inverse mobile-hidden" id="header_navbar">
        <div class="navbar-inner<?php if ($_smarty_tpl->tpl_vars['runtime']->value['is_current_storefront_closed']||$_smarty_tpl->tpl_vars['runtime']->value['are_all_storefronts_closed']) {?> navbar-inner--disabled<?php }?>">
        <?php if ($_smarty_tpl->tpl_vars['runtime']->value['company_data']['company']) {?>
            <?php $_smarty_tpl->tpl_vars['name'] = new Smarty_variable($_smarty_tpl->tpl_vars['runtime']->value['company_data']['company'], null, 0);?>
        <?php } else { ?>
            <?php $_smarty_tpl->tpl_vars['name'] = new Smarty_variable($_smarty_tpl->tpl_vars['settings']->value['Company']['company_name'], null, 0);?>
        <?php }?>

        <?php if (fn_allowed_for("ULTIMATE")) {?>
            <?php if ($_smarty_tpl->tpl_vars['runtime']->value['is_current_storefront_closed']||$_smarty_tpl->tpl_vars['runtime']->value['are_all_storefronts_closed']) {?>
                <?php $_smarty_tpl->tpl_vars['storefront_status_icon'] = new Smarty_variable("icon-lock", null, 0);?>
            <?php } elseif ($_smarty_tpl->tpl_vars['runtime']->value['have_closed_storefronts']) {?>
                <?php $_smarty_tpl->tpl_vars['storefront_status_icon'] = new Smarty_variable("icon-unlock-alt", null, 0);?>
            <?php }?>

            <div class="nav-ult">
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"menu:storefront_icon")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"menu:storefront_icon"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_data']['company_id']) {?>
                        <?php $_smarty_tpl->tpl_vars['name'] = new Smarty_variable($_smarty_tpl->__("all_vendors"), null, 0);?>
                    <?php }?>
                <li class="nav-company">
                <?php if ($_smarty_tpl->tpl_vars['runtime']->value['company_data']['storefront']) {?>
                    <?php $_smarty_tpl->tpl_vars['storefront_url'] = new Smarty_variable(fn_url("profiles.act_as_user?user_id=".((string)$_smarty_tpl->tpl_vars['auth']->value['user_id'])."&area=C"), null, 0);?>
                    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['storefront_url']->value, ENT_QUOTES, 'UTF-8');?>
" target="_blank" class="brand" title="<?php echo $_smarty_tpl->__("view_storefront");?>
">
                        <i class="icon-shopping-cart icon-white"></i>
                    </a>
                <?php } else { ?>
                    <a class="brand" title="<?php echo $_smarty_tpl->__("storefront_url_not_defined");?>
"><i class="icon-shopping-cart icon-white cm-tooltip"></i></a>
                <?php }?>
                </li>
                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"menu:storefront_icon"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php if ($_smarty_tpl->tpl_vars['runtime']->value['companies_available_count']>1) {?>
                    <ul class="nav">
                    <?php $_smarty_tpl->_capture_stack[0][] = array("extra_content", null, null); ob_start(); ?>
                        <?php if (fn_check_view_permissions("companies.manage","GET")) {?>
                            <li class="divider"></li>
                            <li><a href="<?php echo htmlspecialchars(fn_url("companies.manage?switch_company_id=0"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("manage_stores");?>
...</a></li>
                        <?php }?>
                    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                    <?php echo $_smarty_tpl->getSubTemplate ("common/ajax_select_object.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('data_url'=>"companies.get_companies_list?show_all=Y&action=href",'text'=>$_smarty_tpl->tpl_vars['name']->value,'dropdown_icon'=>$_smarty_tpl->tpl_vars['storefront_status_icon']->value,'id'=>"top_company_id",'type'=>"list",'extra_content'=>Smarty::$_smarty_vars['capture']['extra_content']), 0);?>


                    </ul>
                <?php } else { ?>
                    <ul class="nav">
                        <?php if ($_smarty_tpl->tpl_vars['auth']->value['company_id']) {?>
                            <li class="dropdown">
                                <a href="<?php echo htmlspecialchars(fn_url("companies.update?company_id=".((string)$_smarty_tpl->tpl_vars['runtime']->value['company_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("vendor");?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['runtime']->value['company_data']['company'], ENT_QUOTES, 'UTF-8');?>
</a>
                            </li>
                        <?php } else { ?>
                            <?php if (fn_check_view_permissions("companies.manage","GET")) {?>
                                <li class="dropdown vendor-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span><?php echo htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['name']->value,60,"...",true), ENT_QUOTES, 'UTF-8');?>
</span><?php if ($_smarty_tpl->tpl_vars['storefront_status_icon']->value) {?><i class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['storefront_status_icon']->value, ENT_QUOTES, 'UTF-8');?>
 dropdown-menu__icon"></i><?php }?><b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu" id="top_company_id_ajax_select_object">
                                        <li><a href="<?php echo htmlspecialchars(fn_url("companies.manage?switch_company_id=0"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("manage_stores");?>
...</a></li>
                                    </ul>
                                </li>
                            <?php }?>
                        <?php }?>
                    </ul>
                <?php }?>
            </div>
        <?php }?>

        <?php if (fn_allowed_for("MULTIVENDOR")&&!$_smarty_tpl->tpl_vars['runtime']->value['simple_ultimate']) {?>

            <?php if ($_smarty_tpl->tpl_vars['runtime']->value['are_all_storefronts_closed']) {?>
                <?php $_smarty_tpl->tpl_vars['storefront_status_icon'] = new Smarty_variable("icon-lock", null, 0);?>
            <?php } elseif ($_smarty_tpl->tpl_vars['runtime']->value['have_closed_storefronts']) {?>
                <?php $_smarty_tpl->tpl_vars['storefront_status_icon'] = new Smarty_variable("icon-unlock-alt", null, 0);?>
            <?php }?>

            <ul class="nav">
                <li class="nav-company">
                    <?php if ($_smarty_tpl->tpl_vars['auth']->value['user_type']==smarty_modifier_enum("UserTypes::ADMIN")) {?>
                        <?php $_smarty_tpl->tpl_vars['storefront_url'] = new Smarty_variable(fn_url("profiles.act_as_user?user_id=".((string)$_smarty_tpl->tpl_vars['auth']->value['user_id'])."&area=C"), null, 0);?>
                    <?php } else { ?>
                        <?php $_smarty_tpl->tpl_vars['storefront_url'] = new Smarty_variable(fn_url('',"C"), null, 0);?>
                        <?php if ($_smarty_tpl->tpl_vars['runtime']->value['storefront_access_key']) {?>
                            <?php $_smarty_tpl->tpl_vars['storefront_url'] = new Smarty_variable(fn_link_attach($_smarty_tpl->tpl_vars['storefront_url']->value,"store_access_key=".((string)$_smarty_tpl->tpl_vars['runtime']->value['storefront_access_key'])), null, 0);?>
                        <?php }?>
                    <?php }?>
                    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['storefront_url']->value, ENT_QUOTES, 'UTF-8');?>
" target="_blank" class="brand" title="<?php echo $_smarty_tpl->__("view_storefront");?>
">
                        <i class="icon-shopping-cart icon-white"></i>
                    </a>
                    <a href="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" class="brand company-name"><?php echo htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['settings']->value['Company']['company_name'],60,"...",true), ENT_QUOTES, 'UTF-8');?>
</a>
                    <?php if ($_smarty_tpl->tpl_vars['storefront_status_icon']->value) {?>
                    <a href="<?php echo htmlspecialchars(fn_url("storefronts.manage"), ENT_QUOTES, 'UTF-8');?>
" class="brand">
                        <i class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['storefront_status_icon']->value, ENT_QUOTES, 'UTF-8');?>
 dropdown-menu__icon"></i>
                    </a>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['live_editor']) {?>
                        <?php $_smarty_tpl->tpl_vars["company_name"] = new Smarty_variable($_smarty_tpl->tpl_vars['runtime']->value['company_data']['company'], null, 0);?>
                    <?php } else { ?>
                        <?php $_smarty_tpl->tpl_vars["company_name"] = new Smarty_variable(smarty_modifier_truncate($_smarty_tpl->tpl_vars['runtime']->value['company_data']['company'],43,"...",true), null, 0);?>
                    <?php }?>
                </li>
                <?php if ($_smarty_tpl->tpl_vars['auth']->value['company_id']) {?>
                    <li class="dropdown">
                        <a href="<?php echo htmlspecialchars(fn_url("companies.update?company_id=".((string)$_smarty_tpl->tpl_vars['runtime']->value['company_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("vendor");?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['runtime']->value['company_data']['company'], ENT_QUOTES, 'UTF-8');?>
</a>
                    </li>
                <?php } else { ?>
                    <?php if (fn_check_view_permissions("companies.get_companies_list","GET")) {?>
                        <?php $_smarty_tpl->_capture_stack[0][] = array("extra_content", null, null); ob_start(); ?>
                            <li class="divider"></li>
                            <li><a href="<?php echo htmlspecialchars(fn_url("companies.manage?switch_company_id=0"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("manage_vendors");?>
...</a></li>
                        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                        <?php echo $_smarty_tpl->getSubTemplate ("common/ajax_select_object.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('data_url'=>"companies.get_companies_list?show_all=Y&action=href",'text'=>$_smarty_tpl->tpl_vars['company_name']->value,'dropdown_icon'=>false,'id'=>"top_company_id",'type'=>"list",'extra_content'=>Smarty::$_smarty_vars['capture']['extra_content']), 0);?>

                    <?php } else { ?>
                        <li class="dropdown">
                            <a class="unedited-element"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_name']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                        </li>
                    <?php }?>
                <?php }?>
            </ul>
        <?php }?>

            <ul id="mainrightnavbar" class="nav hover-show navbar-right">
            <?php if ($_smarty_tpl->tpl_vars['auth']->value['user_id']&&$_smarty_tpl->tpl_vars['navigation']->value['static']) {?>

                <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_smarty_tpl->tpl_vars['first_level_title'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navigation']->value['static']['top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
 $_smarty_tpl->tpl_vars['first_level_title']->value = $_smarty_tpl->tpl_vars['m']->key;
?>
                    <li class="dropdown dropdown-top-menu-item<?php if ($_smarty_tpl->tpl_vars['first_level_title']->value==$_smarty_tpl->tpl_vars['navigation']->value['selected_tab']) {?> active<?php }?> navigate-items">
                        <a id="elm_menu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_level_title']->value, ENT_QUOTES, 'UTF-8');?>
" href="#" class="dropdown-toggle <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_level_title']->value, ENT_QUOTES, 'UTF-8');?>
">
                            <?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['first_level_title']->value);?>

                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <?php  $_smarty_tpl->tpl_vars["second_level"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["second_level"]->_loop = false;
 $_smarty_tpl->tpl_vars['second_level_title'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['m']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["second_level"]->key => $_smarty_tpl->tpl_vars["second_level"]->value) {
$_smarty_tpl->tpl_vars["second_level"]->_loop = true;
 $_smarty_tpl->tpl_vars['second_level_title']->value = $_smarty_tpl->tpl_vars["second_level"]->key;
?>
                                <li class="<?php if ($_smarty_tpl->tpl_vars['second_level']->value['subitems']) {?>dropdown-submenu<?php }
if ($_smarty_tpl->tpl_vars['second_level_title']->value==$_smarty_tpl->tpl_vars['navigation']->value['subsection']) {?> active<?php }?> <?php if ($_smarty_tpl->tpl_vars['second_level']->value['is_promo']) {?>cm-promo-popup<?php }?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class'], ENT_QUOTES, 'UTF-8');?>
" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['second_level']->value['attrs']['main']));?>
>
                                    <?php if ($_smarty_tpl->tpl_vars['second_level']->value['type']=="title") {?>
                                        <a id="elm_menu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_level_title']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level_title']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class_href']) {?>class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class_href'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['second_level']->value['attrs']['href']));?>
>
                                            <?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['second_level']->value['title'])===null||$tmp==='' ? $_smarty_tpl->__($_smarty_tpl->tpl_vars['second_level_title']->value) : $tmp), ENT_QUOTES, 'UTF-8');?>

                                            <?php if ($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class']=="is-addon") {?><span><i class="icon-is-addon"></i></span><?php }?>
                                        </a>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['second_level']->value['type']!="divider") {?>
                                        <a id="elm_menu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_level_title']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level_title']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class_href']) {?>class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class_href'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['second_level']->value['href']), ENT_QUOTES, 'UTF-8');?>
" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['second_level']->value['attrs']['href']));?>
>
                                            <?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['second_level']->value['title'])===null||$tmp==='' ? $_smarty_tpl->__($_smarty_tpl->tpl_vars['second_level_title']->value) : $tmp), ENT_QUOTES, 'UTF-8');?>

                                            <?php if ($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class']=="is-addon") {?><span><i class="icon-is-addon"></i></span><?php }?>
                                        </a>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['second_level']->value['subitems']) {?>
                                        <ul class="dropdown-menu">
                                            <?php  $_smarty_tpl->tpl_vars['sm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sm']->_loop = false;
 $_smarty_tpl->tpl_vars['subitem_title'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['second_level']->value['subitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sm']->key => $_smarty_tpl->tpl_vars['sm']->value) {
$_smarty_tpl->tpl_vars['sm']->_loop = true;
 $_smarty_tpl->tpl_vars['subitem_title']->value = $_smarty_tpl->tpl_vars['sm']->key;
?>
                                                <?php if ($_smarty_tpl->tpl_vars['sm']->value['type']!="divider") {?>
                                                <li class="<?php if ($_smarty_tpl->tpl_vars['sm']->value['active']) {?>active<?php }?> <?php if ($_smarty_tpl->tpl_vars['sm']->value['is_promo']) {?>cm-promo-popup<?php }?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class'], ENT_QUOTES, 'UTF-8');?>
" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['sm']->value['attrs']['main']));?>
>
                                                    <?php if ($_smarty_tpl->tpl_vars['sm']->value['type']=="title") {?>
                                                        <?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['subitem_title']->value);?>

                                                    <?php } elseif ($_smarty_tpl->tpl_vars['sm']->value['type']!="divider") {?>
                                                        <a id="elm_menu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_level_title']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level_title']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subitem_title']->value, ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['sm']->value['href']), ENT_QUOTES, 'UTF-8');?>
" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['sm']->value['attrs']['href']));?>
><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['sm']->value['title'])===null||$tmp==='' ? $_smarty_tpl->__($_smarty_tpl->tpl_vars['subitem_title']->value) : $tmp), ENT_QUOTES, 'UTF-8');?>
</a>
                                                    <?php }?>
                                                </li>
                                                <?php } elseif ($_smarty_tpl->tpl_vars['sm']->value['type']=="divider") {?>
                                                    <li class="divider"></li>
                                                <?php }?>
                                            <?php } ?>
                                        </ul>
                                    <?php }?>
                                </li>
                                <?php if ($_smarty_tpl->tpl_vars['second_level']->value['type']=="divider") {?>
                                    <li class="divider"></li>
                                <?php }?>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            <?php }?>
                <!-- end navbar-->

            <?php if ($_smarty_tpl->tpl_vars['auth']->value['user_id']) {?>

                <?php if (smarty_modifier_sizeof($_smarty_tpl->tpl_vars['languages']->value)>1||smarty_modifier_sizeof($_smarty_tpl->tpl_vars['currencies']->value)>1) {?>
                    <li class="divider-vertical"></li>
                <?php }?>

                <!--language-->
                <?php if (!fn_allowed_for("ULTIMATE:FREE")) {?>
                    <?php if (smarty_modifier_sizeof($_smarty_tpl->tpl_vars['languages']->value)>1) {?>
                        <?php echo $_smarty_tpl->getSubTemplate ("common/select_object.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('style'=>"dropdown",'link_tpl'=>fn_link_attach($_smarty_tpl->tpl_vars['config']->value['current_url'],"sl="),'items'=>$_smarty_tpl->tpl_vars['languages']->value,'selected_id'=>@constant('CART_LANGUAGE'),'display_icons'=>true,'key_name'=>"name",'key_selected'=>"lang_code",'class'=>"languages"), 0);?>

                    <?php }?>
                <?php }?>
                <!--end language-->

                <!-- Notification Center -->
                    <?php echo $_smarty_tpl->getSubTemplate ("components/notifications_center/opener.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                <!-- /Notification Center -->

                <!--Curriencies-->
                <?php if (smarty_modifier_sizeof($_smarty_tpl->tpl_vars['currencies']->value)>1) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/select_object.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('style'=>"dropdown",'link_tpl'=>fn_link_attach($_smarty_tpl->tpl_vars['config']->value['current_url'],"currency="),'items'=>$_smarty_tpl->tpl_vars['currencies']->value,'selected_id'=>$_smarty_tpl->tpl_vars['secondary_currency']->value,'display_icons'=>false,'key_name'=>"description",'key_selected'=>"currency_code"), 0);?>

                <?php }?>
                <!--end curriencies-->

                <li class="divider-vertical"></li>

                <!-- user menu -->
                <li class="dropdown dropdown-top-menu-item">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:top_links")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:top_links"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <a class="dropdown-toggle">
                            <i class="icon-white icon-user"></i>
                            <b class="caret"></b>
                        </a>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:top_links"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <ul class="dropdown-menu pull-right">
                        <li class="disabled">
                            <a><strong><?php echo $_smarty_tpl->__("signed_in_as");?>
</strong><br><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user_info']->value['email'], ENT_QUOTES, 'UTF-8');?>
</a>
                        </li>
                        <li class="divider"></li>
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"menu:profile")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"menu:profile"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <li><a href="<?php echo htmlspecialchars(fn_url("profiles.update?user_id=".((string)$_smarty_tpl->tpl_vars['auth']->value['user_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("edit_profile");?>
</a></li>
                        <li><a href="<?php echo htmlspecialchars(fn_url("auth.logout"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("sign_out");?>
</a></li>
                        <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']) {?>
                            <li class="divider"></li>
                            <li>
                                <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"group".((string)$_smarty_tpl->tpl_vars['id_prefix']->value)."feedback",'edit_onclick'=>$_smarty_tpl->tpl_vars['onclick']->value,'text'=>$_smarty_tpl->__("feedback_values"),'act'=>"link",'picker_meta'=>"cm-clear-content",'link_text'=>$_smarty_tpl->__("send_feedback",array("[product]"=>@constant('PRODUCT_NAME'))),'content'=>Smarty::$_smarty_vars['capture']['update_block'],'href'=>"feedback.prepare",'no_icon_link'=>true,'but_name'=>"dispatch[feedback.send]",'opener_ajax_class'=>"cm-ajax"), 0);?>

                            </li>
                        <?php }?>
                        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"menu:profile"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    </ul>
                </li>
                <!--end user menu -->
            <?php }?>
            </ul>

        </div>
    <!--header_navbar--></div>

    <!--Subnav-->
    <div class="subnav" id="header_subnav">
        <!--quick search-->
        <div class="search pull-right">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"index:global_search")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"index:global_search"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <form id="global_search" method="get" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
">
                    <input type="hidden" name="dispatch" value="search.results" />
                    <input type="hidden" name="compact" value="Y" />
                    <button class="icon-search cm-tooltip " type="submit" title="<?php echo $_smarty_tpl->__("search_tooltip");?>
" id="search_button"></button>
                    <label for="gs_text"><input type="text" class="cm-autocomplete-off" id="gs_text" name="q" value="<?php echo htmlspecialchars($_REQUEST['q'], ENT_QUOTES, 'UTF-8');?>
" /></label>
                </form>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"index:global_search"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


        </div>
        <!--end quick search-->

        <!-- quick menu -->
        <?php echo $_smarty_tpl->getSubTemplate ("common/quick_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <!-- end quick menu -->

        <ul class="nav hover-show nav-pills">
            <li class="mobile-hidden"><a href="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" class="home"><i class="icon-home"></i></a></li>

            <div class="menu-heading mobile-visible">

                <button class="btn btn-primary mobile-visible-inline mobile-menu-closer"><?php echo $_smarty_tpl->__("close");?>
</button>

                <?php if (fn_allowed_for("ULTIMATE")) {?>
                    <!-- title of heading -->
                    <p class="menu-heading__title-block ult">
                        <span class="menu-heading__title-block--text">
                            <?php if ($_smarty_tpl->tpl_vars['auth']->value['company_id']) {?>
                                <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['runtime']->value['company_data']['company'], ENT_QUOTES, 'UTF-8');?>
</span>
                            <?php } else { ?>
                                <?php if (fn_check_view_permissions("companies.manage","GET")) {?>
                                    <span><?php echo htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['name']->value,60,"...",true), ENT_QUOTES, 'UTF-8');?>
</span>
                                <?php }?>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['storefront_status_icon']->value) {?><i class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['storefront_status_icon']->value, ENT_QUOTES, 'UTF-8');?>
"></i><?php }?>
                            <span class="caret"></span>
                        </span>
                    </p>
                <?php }?>

                <?php if (fn_allowed_for("MULTIVENDOR")&&!$_smarty_tpl->tpl_vars['runtime']->value['simple_ultimate']) {?>
                    <!-- title of heading (if multivendor edition) -->
                    <p class="menu-heading__title-block mve">
                        <span class="menu-heading__title-block--text">
                            <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_name']->value, ENT_QUOTES, 'UTF-8');?>
</span>
                            <a href="<?php echo htmlspecialchars(fn_url("storefronts.manage"), ENT_QUOTES, 'UTF-8');?>
">
                                <i class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['storefront_status_icon']->value, ENT_QUOTES, 'UTF-8');?>
"></i>
                            </a>
                            <span class="caret"></span>
                        </span>
                    </p>
                <?php }?>

                <div class="menu-heading__dropdowned closed">
                <ul class="dropdown-menu menu-heading__dropdowned-menu">
                    
                    <?php if (fn_allowed_for("MULTIVENDOR")&&!$_smarty_tpl->tpl_vars['runtime']->value['simple_ultimate']) {?>
                        <li class="divider"></li>
                        <?php if ($_smarty_tpl->tpl_vars['auth']->value['company_id']) {?>
                            <li class="dropdown" data-disable-dropdown-processing="true">
                                <a href="<?php echo htmlspecialchars(fn_url("companies.update?company_id=".((string)$_smarty_tpl->tpl_vars['runtime']->value['company_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("vendor");?>
: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['runtime']->value['company_data']['company'], ENT_QUOTES, 'UTF-8');?>
</a>
                            </li>
                        <?php } else { ?>
                            <?php if (fn_check_view_permissions("companies.get_companies_list","GET")) {?>
                                <li class="dropdown" data-disable-dropdown-processing="true">
                                    <a
                                        class="unedited-element mobile-menu--js-companies-popup"
                                        data-ca-selector-href="companies.get_companies_list?show_all=Y&action=href&render_html=N"
                                        data-ca-selector-elements="20"
                                        data-ca-selector-start="0"
                                    ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_name']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                                </li>
                            <?php } else { ?>
                                <li class="dropdown" data-disable-dropdown-processing="true">
                                    <a class="unedited-element"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_name']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                                </li>
                            <?php }?>
                        <?php }?>
                    <?php }?>
                    

                    
                    <?php if (fn_allowed_for("ULTIMATE")) {?>
                        <?php if ($_smarty_tpl->tpl_vars['runtime']->value['companies_available_count']>1) {?>
                            <?php if (fn_check_view_permissions("companies.get_companies_list","GET")) {?>
                                <li class="dropdown" data-disable-dropdown-processing="true">
                                    <a
                                        class="unedited-element mobile-menu--js-companies-popup"
                                        data-ca-selector-href="companies.get_companies_list?show_all=Y&action=href&render_html=N"
                                        data-ca-selector-elements="20"
                                        data-ca-selector-start="0"
                                    ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                                </li>
                            <?php } else { ?>
                                <li class="dropdown" data-disable-dropdown-processing="true">
                                    <a class="unedited-element"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                                </li>
                            <?php }?>
                        <?php }?>
                    <?php }?>
                    

                    
                    <li class="disabled">
                        <a><strong><?php echo $_smarty_tpl->__("signed_in_as");?>
</strong><br><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user_info']->value['email'], ENT_QUOTES, 'UTF-8');?>
</a>
                    </li>
                    <li class="divider"></li>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"menu:profile")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"menu:profile"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <li><a href="<?php echo htmlspecialchars(fn_url("profiles.update?user_id=".((string)$_smarty_tpl->tpl_vars['auth']->value['user_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("edit_profile");?>
</a></li>
                        <li><a href="<?php echo htmlspecialchars(fn_url("auth.logout"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("sign_out");?>
</a></li>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"menu:profile"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    

                    <?php if (fn_allowed_for("ULTIMATE")) {?>
                        <?php if (fn_check_view_permissions("companies.manage","GET")) {?>
                            <li class="divider"></li>
                            <li><a href="<?php echo htmlspecialchars(fn_url("companies.manage?switch_company_id=0"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("manage_stores");?>
...</a></li>
                        <?php }?>
                    <?php }?>

                    
                    <?php if (!$_smarty_tpl->tpl_vars['runtime']->value['company_id']) {?>
                        <li class="divider"></li>
                        <li>
                            <?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"group".((string)$_smarty_tpl->tpl_vars['id_prefix']->value)."feedback",'edit_onclick'=>$_smarty_tpl->tpl_vars['onclick']->value,'text'=>$_smarty_tpl->__("feedback_values"),'act'=>"link",'picker_meta'=>"cm-clear-content",'link_text'=>$_smarty_tpl->__("send_feedback",array("[product]"=>@constant('PRODUCT_NAME'))),'content'=>Smarty::$_smarty_vars['capture']['update_block'],'href'=>"feedback.prepare",'no_icon_link'=>true,'but_name'=>"dispatch[feedback.send]",'opener_ajax_class'=>"cm-ajax"), 0);?>

                        </li>
                    <?php }?>
                    
                </ul>
                </div>
            </div>

            <ul class="nav hover-show nav-pills nav-child mobile-visible nav-first">
            <?php if ($_smarty_tpl->tpl_vars['runtime']->value['company_data']['storefront']) {?>
                <li class="dropdown">
                    <?php $_smarty_tpl->tpl_vars['storefront_url'] = new Smarty_variable(fn_url("profiles.act_as_user?user_id=".((string)$_smarty_tpl->tpl_vars['auth']->value['user_id'])."&area=C"), null, 0);?>
                    <a  href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['storefront_url']->value, ENT_QUOTES, 'UTF-8');?>
"
                        target="_blank"
                        title="<?php echo $_smarty_tpl->__("view_storefront");?>
"
                        class="dropdown-toggle"
                    ><?php echo $_smarty_tpl->__("view_storefront");?>
</a>
                </li>
            <?php } elseif (fn_allowed_for("MULTIVENDOR")) {?>
                <li class="dropdown">
                    <?php if ($_smarty_tpl->tpl_vars['auth']->value['user_type']==smarty_modifier_enum("UserTypes::ADMIN")) {?>
                        <?php $_smarty_tpl->tpl_vars['storefront_url'] = new Smarty_variable(fn_url("profiles.act_as_user?user_id=".((string)$_smarty_tpl->tpl_vars['auth']->value['user_id'])."&area=C"), null, 0);?>
                    <?php } else { ?>
                        <?php $_smarty_tpl->tpl_vars['storefront_url'] = new Smarty_variable(fn_url('',"C"), null, 0);?>
                        <?php if ($_smarty_tpl->tpl_vars['runtime']->value['storefront_access_key']) {?>
                            <?php $_smarty_tpl->tpl_vars['storefront_url'] = new Smarty_variable(fn_link_attach($_smarty_tpl->tpl_vars['storefront_url']->value,"store_access_key=".((string)$_smarty_tpl->tpl_vars['runtime']->value['storefront_access_key'])), null, 0);?>
                        <?php }?>
                    <?php }?>
                    <a  href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['storefront_url']->value, ENT_QUOTES, 'UTF-8');?>
"
                        target="_blank"
                        title="<?php echo $_smarty_tpl->__("view_storefront");?>
"
                        class="dropdown-toggle"
                    ><?php echo $_smarty_tpl->__("view_storefront");?>
</a>
                </li>
            <?php }?>
                <li class="dropdown"><a href="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" class="dropdown-toggle"><?php echo $_smarty_tpl->__("home");?>
</a></li>
            </ul>

            <?php if ($_smarty_tpl->tpl_vars['auth']->value['user_id']&&$_smarty_tpl->tpl_vars['navigation']->value['static']['central']) {?>
            <hr class="mobile-visible navbar-hr" />
            <ul class="nav hover-show nav-pills nav-child">
            <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_smarty_tpl->tpl_vars['first_level_title'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navigation']->value['static']['central']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
 $_smarty_tpl->tpl_vars['first_level_title']->value = $_smarty_tpl->tpl_vars['m']->key;
?>
                <li class="dropdown <?php if ($_smarty_tpl->tpl_vars['first_level_title']->value==$_smarty_tpl->tpl_vars['navigation']->value['selected_tab']) {?> active<?php }?> ">
                    <a href="#" class="dropdown-toggle">
                        <?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['first_level_title']->value);?>

                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <?php  $_smarty_tpl->tpl_vars["second_level"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["second_level"]->_loop = false;
 $_smarty_tpl->tpl_vars['second_level_title'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['m']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["second_level"]->key => $_smarty_tpl->tpl_vars["second_level"]->value) {
$_smarty_tpl->tpl_vars["second_level"]->_loop = true;
 $_smarty_tpl->tpl_vars['second_level_title']->value = $_smarty_tpl->tpl_vars["second_level"]->key;
?>
                            <li class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level_title']->value, ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['second_level']->value['subitems']) {?> dropdown-submenu<?php }
if ($_smarty_tpl->tpl_vars['second_level_title']->value==$_smarty_tpl->tpl_vars['navigation']->value['subsection']&&$_smarty_tpl->tpl_vars['first_level_title']->value==$_smarty_tpl->tpl_vars['navigation']->value['selected_tab']) {?> active<?php }?>" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['second_level']->value['attrs']['main']));?>
><a class="<?php if ($_smarty_tpl->tpl_vars['second_level']->value['is_promo']) {?>cm-promo-popup<?php }?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class'], ENT_QUOTES, 'UTF-8');?>
" <?php if (!$_smarty_tpl->tpl_vars['second_level']->value['is_promo']) {?>href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['second_level']->value['href']), ENT_QUOTES, 'UTF-8');?>
"<?php }?> <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['second_level']->value['attrs']['href']));?>
>
                                <span><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['second_level_title']->value);
if ($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class']=="is-addon") {?><i class="icon-is-addon"></i><?php }?></span>
                                <?php if ($_smarty_tpl->__($_smarty_tpl->tpl_vars['second_level']->value['description'])!="_".((string)$_smarty_tpl->tpl_vars['second_level_title']->value)."_menu_description") {
if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['show_menu_descriptions']=="Y") {?><span class="hint"><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['second_level']->value['description']);?>
</span><?php }
}?></a>

                                <?php if ($_smarty_tpl->tpl_vars['second_level']->value['subitems']) {?>
                                    <ul class="dropdown-menu">
                                        <?php  $_smarty_tpl->tpl_vars['sm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sm']->_loop = false;
 $_smarty_tpl->tpl_vars['subitem_title'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['second_level']->value['subitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sm']->key => $_smarty_tpl->tpl_vars['sm']->value) {
$_smarty_tpl->tpl_vars['sm']->_loop = true;
 $_smarty_tpl->tpl_vars['subitem_title']->value = $_smarty_tpl->tpl_vars['sm']->key;
?>
                                            <li class="<?php if ($_smarty_tpl->tpl_vars['sm']->value['active']) {?>active<?php }?> <?php if ($_smarty_tpl->tpl_vars['sm']->value['is_promo']) {?>cm-promo-popup<?php }?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class'], ENT_QUOTES, 'UTF-8');?>
" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['sm']->value['attrs']['main']));?>
><a href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['sm']->value['href']), ENT_QUOTES, 'UTF-8');?>
" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['sm']->value['attrs']['href']));?>
><?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['subitem_title']->value);?>
</a></li>
                                        <?php } ?>
                                    </ul>
                                <?php }?>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            </ul>
            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['auth']->value['user_id']&&$_smarty_tpl->tpl_vars['navigation']->value['static']['top']) {?>
            <hr class="mobile-visible navbar-hr" />
            <ul class="nav hover-show nav-pills nav-child mobile-visible">
            <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_smarty_tpl->tpl_vars['first_level_title'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['navigation']->value['static']['top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
 $_smarty_tpl->tpl_vars['first_level_title']->value = $_smarty_tpl->tpl_vars['m']->key;
?>
                <li class="dropdown dropdown-top-menu-item<?php if ($_smarty_tpl->tpl_vars['first_level_title']->value==$_smarty_tpl->tpl_vars['navigation']->value['selected_tab']) {?> active<?php }?> navigate-items">
                    <a id="elm_menu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_level_title']->value, ENT_QUOTES, 'UTF-8');?>
" href="#" class="dropdown-toggle <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_level_title']->value, ENT_QUOTES, 'UTF-8');?>
">
                        <?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['first_level_title']->value);?>

                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <?php  $_smarty_tpl->tpl_vars["second_level"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["second_level"]->_loop = false;
 $_smarty_tpl->tpl_vars['second_level_title'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['m']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["second_level"]->key => $_smarty_tpl->tpl_vars["second_level"]->value) {
$_smarty_tpl->tpl_vars["second_level"]->_loop = true;
 $_smarty_tpl->tpl_vars['second_level_title']->value = $_smarty_tpl->tpl_vars["second_level"]->key;
?>
                            <li class="<?php if ($_smarty_tpl->tpl_vars['second_level']->value['subitems']) {?>dropdown-submenu<?php }
if ($_smarty_tpl->tpl_vars['second_level_title']->value==$_smarty_tpl->tpl_vars['navigation']->value['subsection']) {?> active<?php }?> <?php if ($_smarty_tpl->tpl_vars['second_level']->value['is_promo']) {?>cm-promo-popup<?php }?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class'], ENT_QUOTES, 'UTF-8');?>
" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['second_level']->value['attrs']['main']));?>
>
                                <?php if ($_smarty_tpl->tpl_vars['second_level']->value['type']=="title") {?>
                                    <a id="elm_menu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_level_title']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level_title']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class_href']) {?>class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class_href'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['second_level']->value['attrs']['href']));?>
><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['second_level']->value['title'])===null||$tmp==='' ? $_smarty_tpl->__($_smarty_tpl->tpl_vars['second_level_title']->value) : $tmp), ENT_QUOTES, 'UTF-8');?>
</a>
                                <?php } elseif ($_smarty_tpl->tpl_vars['second_level']->value['type']!="divider") {?>
                                    <a id="elm_menu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_level_title']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level_title']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class_href']) {?>class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class_href'], ENT_QUOTES, 'UTF-8');?>
"<?php }?> href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['second_level']->value['href']), ENT_QUOTES, 'UTF-8');?>
" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['second_level']->value['attrs']['href']));?>
><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['second_level']->value['title'])===null||$tmp==='' ? $_smarty_tpl->__($_smarty_tpl->tpl_vars['second_level_title']->value) : $tmp), ENT_QUOTES, 'UTF-8');?>

                                        <?php if ($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class']=="is-addon") {?><span><i class="icon-is-addon"></i></span><?php }?>
                                    </a>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['second_level']->value['subitems']) {?>
                                    <ul class="dropdown-menu">
                                        <?php  $_smarty_tpl->tpl_vars['sm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sm']->_loop = false;
 $_smarty_tpl->tpl_vars['subitem_title'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['second_level']->value['subitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sm']->key => $_smarty_tpl->tpl_vars['sm']->value) {
$_smarty_tpl->tpl_vars['sm']->_loop = true;
 $_smarty_tpl->tpl_vars['subitem_title']->value = $_smarty_tpl->tpl_vars['sm']->key;
?>
                                            <li class="<?php if ($_smarty_tpl->tpl_vars['sm']->value['active']) {?>active<?php }?> <?php if ($_smarty_tpl->tpl_vars['sm']->value['is_promo']) {?>cm-promo-popup<?php }?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level']->value['attrs']['class'], ENT_QUOTES, 'UTF-8');?>
" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['sm']->value['attrs']['main']));?>
>
                                                <?php if ($_smarty_tpl->tpl_vars['sm']->value['type']=="title") {?>
                                                    <?php echo $_smarty_tpl->__($_smarty_tpl->tpl_vars['subitem_title']->value);?>

                                                <?php } elseif ($_smarty_tpl->tpl_vars['sm']->value['type']!="divider") {?>
                                                    <a id="elm_menu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['first_level_title']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['second_level_title']->value, ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subitem_title']->value, ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars(fn_url($_smarty_tpl->tpl_vars['sm']->value['href']), ENT_QUOTES, 'UTF-8');?>
" <?php smarty_template_function_menu_attrs($_smarty_tpl,array('attrs'=>$_smarty_tpl->tpl_vars['sm']->value['attrs']['href']));?>
><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['sm']->value['title'])===null||$tmp==='' ? $_smarty_tpl->__($_smarty_tpl->tpl_vars['subitem_title']->value) : $tmp), ENT_QUOTES, 'UTF-8');?>
</a>
                                                <?php }?>
                                            </li>
                                            <?php if ($_smarty_tpl->tpl_vars['sm']->value['type']=="divider") {?>
                                                <li class="divider"></li>
                                            <?php }?>
                                        <?php } ?>
                                    </ul>
                                <?php }?>
                            </li>
                            <?php if ($_smarty_tpl->tpl_vars['second_level']->value['type']=="divider") {?>
                                <li class="divider"></li>
                            <?php }?>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            </ul>
            <?php }?>

            <hr class="mobile-visible navbar-hr" />
            <ul class="nav hover-show nav-pills nav-child mobile-visible">
                <!--language-->
                <?php if (smarty_modifier_sizeof($_smarty_tpl->tpl_vars['languages']->value)>1) {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("common/select_object.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('style'=>"dropdown",'link_tpl'=>fn_link_attach($_smarty_tpl->tpl_vars['config']->value['current_url'],"sl="),'items'=>$_smarty_tpl->tpl_vars['languages']->value,'selected_id'=>@constant('CART_LANGUAGE'),'display_icons'=>true,'key_name'=>"name",'key_selected'=>"lang_code",'class'=>"languages",'plain_name'=>$_smarty_tpl->__("language")), 0);?>

                <?php }?>
                <!--end language-->

                <!--curriencies-->
                <?php if (smarty_modifier_sizeof($_smarty_tpl->tpl_vars['currencies']->value)>1) {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("common/select_object.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('style'=>"dropdown",'link_tpl'=>fn_link_attach($_smarty_tpl->tpl_vars['config']->value['current_url'],"currency="),'items'=>$_smarty_tpl->tpl_vars['currencies']->value,'selected_id'=>$_smarty_tpl->tpl_vars['secondary_currency']->value,'display_icons'=>false,'key_name'=>"description",'key_selected'=>"currency_code",'plain_name'=>$_smarty_tpl->__("currency")), 0);?>

                <?php }?>
                <!--end curriencies-->
            </ul>
            <hr class="mobile-visible navbar-hr" />

        </ul>
    <!--header_subnav--></div>
</div>


<div class="overlayed-mobile-menu mobile-visible">
    <div class="overlayed-mobile-menu__content">
        <div class="overlayed-mobile-menu__title-container">
            <h3 class="overlayed-mobile-menu-title"></h3>
        </div>

        <div class="overlayed-mobile-menu-closer">
            <button class="mobile-visible-inline overlay-navbar-close btn btn-primary"><?php echo $_smarty_tpl->__("go_back");?>
</button>
        </div>
    </div>

    <div class="overlayed-mobile-menu__content">
    </div>
    <div class="overlayed-mobile-menu-container"></div>
</div>



<div class="hidden store-vendor-selector--dummy-dialog"></div>

<ul class="hidden store-vendor-selector--list-container">
    <input
        class="store-vendor-selector--search cm-ajax-content-input"
        type="text"
        value=""
        placeholder="<?php echo $_smarty_tpl->__("search");?>
"
    />
    <div class="store-vendor-selector--list-wrapper-container">
        <ul class="store-vendor-selector--list-wrapper"></ul>
    </div>
</ul>
<li class="hidden store-vendor-selector--list-element">
    <a class="store-vendor-selector--list-element-link" href="#"></a>
</li>
<button class="hidden btn btn-primary store-vendor-selector--show-more-btn"><?php echo $_smarty_tpl->__("more");?>
</button>
<span class="hidden store-vendor-selector--list-element-storefront-status"><i class="icon-lock dropdown-menu__item-icon"></i></span>

<?php }} ?>
