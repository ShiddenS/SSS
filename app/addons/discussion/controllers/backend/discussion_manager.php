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

use Tygh\Enum\Addons\Discussion\DiscussionObjectTypes;
use Tygh\Enum\Addons\Discussion\DiscussionTypes;
use Tygh\Registry;

if (!defined('BOOTSTRAP')) {
    die('Access denied');
}

if ($mode == 'manage') {

    $discussion_object_types = fn_get_discussion_objects();
    $discussion_object_titles = fn_get_discussion_titles();

    $params = array_merge([
        'object_type' => key($discussion_object_types),
    ], $_REQUEST);

    $runtime_company_id = fn_get_runtime_company_id();

    $discussion_manager_url = fn_query_remove(Registry::get('config.current_url'), 'object_type', 'page');
    $are_testimonials_enabled = Registry::ifGet('addons.discussion.home_page_testimonials', DiscussionTypes::TYPE_DISABLED) !== DiscussionTypes::TYPE_DISABLED;

    foreach ($discussion_object_types as $obj_type => $obj) {
        if ($obj_type === DiscussionObjectTypes::TESTIMONIALS_AND_LAYOUT && !$are_testimonials_enabled) {
            continue;
        }

        $_name = __($discussion_object_titles[$obj_type]);

        Registry::set('navigation.tabs.' . $obj, [
            'title' => $_name,
            'href'  => $discussion_manager_url . '&object_type=' . $obj_type,
        ]);
    }

    list($posts, $search) = fn_get_discussions($params, Registry::get('settings.Appearance.admin_elements_per_page'));

    if (!empty($posts)) {
        foreach ($posts as $k => $v) {
            $posts[$k]['object_data'] = fn_get_discussion_object_data($v['object_id'], $v['object_type'], DESCR_SL);
        }
    }

    Tygh::$app['view']->assign('posts', $posts);
    Tygh::$app['view']->assign('search', $search);
    Tygh::$app['view']->assign('discussion_object_type', $params['object_type']);
    Tygh::$app['view']->assign('discussion_object_types', $discussion_object_types);
}
