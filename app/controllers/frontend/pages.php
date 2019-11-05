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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    return;
}

//
// View page details
//
if ($mode == 'view') {

    $_REQUEST['page_id'] = empty($_REQUEST['page_id']) ? 0 : $_REQUEST['page_id'];
    $preview = fn_is_preview_action($auth, $_REQUEST);
    $page = fn_get_page_data($_REQUEST['page_id'], CART_LANGUAGE, $preview);

    if (!empty($_REQUEST['page_id']) && empty($auth['user_id'])) {

        $uids = explode(',', db_get_field('SELECT usergroup_ids FROM ?:pages WHERE page_id = ?i', $_REQUEST['page_id']));

        if (!in_array(USERGROUP_ALL, $uids) && !in_array(USERGROUP_GUEST, $uids)) {
            return array(CONTROLLER_STATUS_REDIRECT, 'auth.login_form?return_url=' . urlencode(Registry::get('config.current_url')));
        }
    }

    if (empty($page) || ($page['status'] == 'D' && !$preview)) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    // perform redirect when accessing a page by the direct link
    if ($page['page_type'] == PAGE_TYPE_LINK) {
        return array(CONTROLLER_STATUS_REDIRECT, $page['link'], true, true);
    }

    if (!empty($page['meta_description']) || !empty($page['meta_keywords'])) {
        Tygh::$app['view']->assign('meta_description', $page['meta_description']);
        Tygh::$app['view']->assign('meta_keywords', $page['meta_keywords']);
    }

    // If page title for this page is exist than assign it to template
    if (!empty($page['page_title'])) {
        Tygh::$app['view']->assign('page_title', $page['page_title']);
    }

    $parent_ids = explode('/', $page['id_path']);
    foreach ($parent_ids as $p_id) {
        $_page = fn_get_page_data($p_id);
        fn_add_breadcrumb($_page['page'], ($p_id == $page['page_id']) ? '' : ($_page['page_type'] == PAGE_TYPE_LINK && !empty($_page['link']) ? $_page['link'] : "pages.view?page_id=$p_id"));
    }

    Tygh::$app['view']->assign('page', $page);

    // custom vendor blocks
    if ($vendor_id = fn_get_runtime_vendor_id()) {
        Tygh::$app['view']->assign('company_id', $vendor_id);
        $_REQUEST['company_id'] = $vendor_id;
    }
}
