<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD']	== 'POST') {

    fn_trusted_vars('banners', 'banner_data');
    $suffix = '';

    //
    // Delete banners
    //
    if ($mode == 'm_delete') {
        foreach ($_REQUEST['banner_ids'] as $v) {
            fn_delete_banner_by_id($v);
        }

        $suffix = '.manage';
    }

    //
    // Add/edit banners
    //
    if ($mode == 'update') {
        $banner_id = fn_banners_update_banner($_REQUEST['banner_data'], $_REQUEST['banner_id'], DESCR_SL);

        $suffix = ".update?banner_id=$banner_id";
    }

    if ($mode == 'delete') {
        if (!empty($_REQUEST['banner_id'])) {
            fn_delete_banner_by_id($_REQUEST['banner_id']);
        }

        $suffix = '.manage';
    }

    return array(CONTROLLER_STATUS_OK, 'banners' . $suffix);
}

if ($mode == 'update') {
    $banner = fn_get_banner_data($_REQUEST['banner_id'], DESCR_SL);

    if (empty($banner)) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    Registry::set('navigation.tabs', array (
        'general' => array (
            'title' => __('general'),
            'js' => true
        ),
    ));

    Tygh::$app['view']->assign('banner', $banner);

} elseif ($mode == 'manage' || $mode == 'picker') {

    list($banners, $params) = fn_get_banners($_REQUEST, DESCR_SL, Registry::get('settings.Appearance.admin_elements_per_page'));

    Tygh::$app['view']->assign(array(
        'banners'  => $banners,
        'search' => $params,
    ));
}

//
// Banners picker
//
if ($mode == 'picker') {
    Tygh::$app['view']->display('addons/banners/pickers/banners/picker_contents.tpl');
    exit;
}
