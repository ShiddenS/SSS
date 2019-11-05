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

$_REQUEST['category_id'] = empty($_REQUEST['category_id']) ? 0 : $_REQUEST['category_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Define trusted variables that shouldn't be stripped
    fn_trusted_vars (
        'category_data',
        'categories_data'
    );

    //
    // Create/update category
    //
    if ($mode == 'update') {
        if (fn_allowed_for('ULTIMATE')) {
            if (!empty($_REQUEST['category_id']) && !fn_check_company_id('categories', 'category_id', $_REQUEST['category_id'])) {
                fn_company_access_denied_notification();

                return array(CONTROLLER_STATUS_OK, 'categories.update?category_id=' . $_REQUEST['category_id']);
            }
        }

        $category_id = fn_update_category($_REQUEST['category_data'], $_REQUEST['category_id'], DESCR_SL);

        if (!empty($category_id)) {
            fn_attach_image_pairs('category_main', 'category', $category_id, DESCR_SL);

            $suffix = ".update?category_id=$category_id" . (!empty($_REQUEST['category_data']['block_id']) ? "&selected_block_id=" . $_REQUEST['category_data']['block_id'] : "");
        } else {
            $suffix = '.manage';
        }
    }

    //
    // Processing mulitple addition of new category elements
    //
    if ($mode == 'm_add') {
        if (!fn_is_empty($_REQUEST['categories_data'])) {
            $is_added = false;
            foreach ($_REQUEST['categories_data'] as $k => $v) {
                if (!empty($v['category'])) {  // Checking for required fields for new category
                    if (fn_update_category($v)) {
                        $is_added = true;
                    }
                }
            }

            if ($is_added) {
                fn_set_notification('N', __('notice'), __('categories_have_been_added'));
            }
        }


        $suffix = ".manage";
    }

    //
    // Processing multiple updating of category elements
    //
    if ($mode == 'm_update') {

        // Update multiple categories data
        if (is_array($_REQUEST['categories_data'])) {
            fn_attach_image_pairs('category_main', 'category', 0, DESCR_SL);

            foreach ($_REQUEST['categories_data'] as $k => $v) {
                if (!fn_allowed_for('ULTIMATE') || (fn_allowed_for('ULTIMATE') && fn_check_company_id('categories', 'category_id', $k))) {
                    if (fn_allowed_for('ULTIMATE')) {
                        fn_set_company_id($v);
                    }
                    fn_update_category($v, $k, DESCR_SL);
                }
            }
        }

        $suffix = ".manage";
    }

    //
    // Processing deleting of multiple category elements
    //
    if ($mode == 'm_delete') {

        if (isset($_REQUEST['category_ids'])) {

            $category_deletion_queue = fn_filter_redundant_deleting_category_ids((array) $_REQUEST['category_ids']);
            $deleted_categories = array();

            foreach ($category_deletion_queue as $category_id) {
                if (fn_allowed_for('MULTIVENDOR')
                    ||
                    (fn_allowed_for('ULTIMATE') && fn_check_company_id('categories', 'category_id', $category_id))
                ) {
                    $deleted_now = fn_delete_category($category_id, true);
                    $deleted_categories = array_merge($deleted_categories, $deleted_now);
                }
            }

            if (fn_allowed_for('ULTIMATE')) {
                $products_adopted = fn_adopt_orphaned_products($deleted_categories);
                if ($products_adopted) {
                    fn_set_notification(
                        'N', __('notice'), __('products_adopted', array(count($products_adopted)))
                    );
                }

                list($orphaned_products, $trashes) = fn_trash_orphaned_products($deleted_categories);
                if ($orphaned_products) {
                    $trash_category_id = reset($trashes);
                    fn_set_notification(
                        'N',
                        __('notice'),
                        __('products_moved_to_trash', array(
                            '[count]' => count($orphaned_products),
                            '[url]' => fn_url('products.manage?cid=' . $trash_category_id)
                        )),
                        'S'
                    );
                }
            }
        }

        unset(Tygh::$app['session']['category_ids']);

        if ($deleted_categories) {
            fn_set_notification('N', __('notice'), __('text_categories_have_been_deleted'));
        }
        $suffix = ".manage";
    }


    //
    // Store selected fields for using in 'm_update' mode
    //
    if ($mode == 'store_selection') {

        if (!empty($_REQUEST['category_ids'])) {
            Tygh::$app['session']['category_ids'] = $_REQUEST['category_ids'];
            Tygh::$app['session']['selected_fields'] = $_REQUEST['selected_fields'];

            $suffix = ".m_update";
        } else {
            $suffix = ".manage";
        }
    }

    //
    // Delete category
    //
    if ($mode == 'delete') {

        if (!empty($_REQUEST['category_id'])) {
            $deleted_categories = fn_delete_category($_REQUEST['category_id']);
            if (fn_allowed_for('ULTIMATE')) {

                $products_adopted = fn_adopt_orphaned_products($deleted_categories);
                if ($products_adopted) {
                    fn_set_notification(
                        'N', __('notice'), __('products_adopted', array(count($products_adopted)))
                    );
                }

                list($orphaned_products, $trashes) = fn_trash_orphaned_products($deleted_categories);
                if ($orphaned_products) {
                    $trash_category_id = reset($trashes);
                    fn_set_notification(
                        'N',
                        __('notice'),
                        __('products_moved_to_trash', array(
                            '[count]' => count($orphaned_products),
                            '[url]' => fn_url('products.manage?cid=' . $trash_category_id)
                        ))
                    );
                }
            }

            if ($deleted_categories) {
                fn_set_notification('N', __('notice'), __('text_category_has_been_deleted'));
            }
        }

        $suffix = ".manage";
    }

    return array(CONTROLLER_STATUS_OK, 'categories' . $suffix);
}

//
// 'Add new category' page
//
if ($mode == 'add') {

    // [Page sections]
    Registry::set('navigation.tabs', array (
        'detailed' => array (
            'title' => __('general'),
            'js' => true
        ),
        'addons' => array (
            'title' => __('addons'),
            'js' => true
        ),
        'views' => array(
            'title' => __('views'),
            'js' => true
        ),
    ));
    // [/Page sections]


    if (!empty($_REQUEST['parent_id'])) {
        $category_data['parent_id'] = $_REQUEST['parent_id'];
        Tygh::$app['view']->assign('category_data', $category_data);
    }

//
// 'Multiple categories addition' page
//
} elseif ($mode == 'm_add') {

//
// 'category update' page
//
} elseif ($mode == 'update') {

    $category_id = $_REQUEST['category_id'];
    // Get current category data
    $category_data = fn_get_category_data($category_id, DESCR_SL);

    if (empty($category_data)) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    // [Page sections]
    $tabs = array (
        'detailed' => array (
            'title' => __('general'),
            'js' => true
        )
    );

    $tabs['addons'] = array (
        'title' => __('addons'),
        'js' => true
    );

    $tabs['views'] = array (
        'title' => __('views'),
        'js' => true
    );
    Registry::set('navigation.tabs', $tabs);
    // [/Page sections]
    Tygh::$app['view']->assign('category_data', $category_data);

    $params = array (
        'active_category_id' => $category_id,
    );

    $condition = fn_get_company_condition('?:categories.company_id');
    $category_count = db_get_field('SELECT COUNT(*) FROM ?:categories WHERE 1=1 ?p', $condition);
    if ($category_count > CATEGORY_THRESHOLD) {
        $params['current_category_id'] = $category_id;
        $params['visible'] = true;
    }
    list($categories_tree, ) = fn_get_categories($params, DESCR_SL);
    Tygh::$app['view']->assign('categories_tree', $categories_tree);

//
// 'Mulitple categories updating' page
//
} elseif ($mode == 'm_update') {

    $category_ids = Tygh::$app['session']['category_ids'];
    $selected_fields = Tygh::$app['session']['selected_fields'];

    if (empty($category_ids) || empty($selected_fields) || empty($selected_fields['object']) || $selected_fields['object'] != 'category') {
        return array(CONTROLLER_STATUS_REDIRECT, 'categories.manage');
    }

    $field_groups = array (
        'A' => array (
            'category' => 'categories_data',
            'page_title' => 'categories_data',
            'position' => 'categories_data',
        ),

        'C' => array ( // textareas
            'description' => 'categories_data',
            'meta_keywords' => 'categories_data',
            'meta_description' => 'categories_data',
        ),
    );

    $get_main_pair = false;

    $fields2update = $selected_fields['data'];

    $data_search_fields = implode($fields2update, ', ');

    if (!empty($data_search_fields)) {
        $data_search_fields = ', ' . $data_search_fields;
    }

    if (!empty($selected_fields['images'])) {
        foreach ($selected_fields['images'] as $value) {
            $fields2update[] = $value;
            if ($value == 'image_pair') {
                $get_main_pair = true;
            }
        }
    }

    $filled_groups = array();
    $field_names = array();
    foreach ($fields2update as $field) {
        if ($field == 'usergroup_ids') {
            $desc = 'usergroups';
        } elseif ($field == 'timestamp') {
            $desc = 'creation_date';
        } else {
            $desc = $field;
        }
        if ($field == 'category_id') {
            continue;
        }

        if (!empty($field_groups['A'][$field])) {
            $filled_groups['A'][$field] = __($desc);
            continue;
        } elseif (!empty($field_groups['B'][$field])) {
            $filled_groups['B'][$field] = __($desc);
            continue;
        } elseif (!empty($field_groups['C'][$field])) {
            $filled_groups['C'][$field] = __($desc);
            continue;
        }

        $field_names[$field] = __($desc);
    }

    ksort($filled_groups, SORT_STRING);

    $categories_data = array();
    foreach ($category_ids as $value) {
        $categories_data[$value] = fn_get_category_data($value, DESCR_SL, '?:categories.category_id, ?:categories.company_id' . $data_search_fields, $get_main_pair);
    }

    Tygh::$app['view']->assign('field_groups', $field_groups);
    Tygh::$app['view']->assign('filled_groups', $filled_groups);

    Tygh::$app['view']->assign('fields2update', $fields2update);
    Tygh::$app['view']->assign('field_names', $field_names);

    Tygh::$app['view']->assign('categories_data', $categories_data);

//
// 'Management' page
//
} elseif ($mode == 'manage' || $mode == 'picker') {

    if ($mode == 'manage') {
        unset(Tygh::$app['session']['category_ids']);
        unset(Tygh::$app['session']['selected_fields']);
        Tygh::$app['view']->assign('categories_stats', fn_get_categories_stats());
    }

    $category_count = db_get_field("SELECT COUNT(*) FROM ?:categories");
    $category_id = empty($_REQUEST['category_id']) ? 0 : $_REQUEST['category_id'];
    $except_id = 0;
    if (!empty($_REQUEST['except_id'])) {
        $except_id = $_REQUEST['except_id'];
        Tygh::$app['view']->assign('except_id', $_REQUEST['except_id']);
    }

    $params = array(
        'simple' => false,
        'add_root' => !empty($_REQUEST['root']) ? $_REQUEST['root'] : '',
        'b_id' => !empty($_REQUEST['b_id']) ? $_REQUEST['b_id'] : '',
        'except_id' => $except_id,
        'company_ids' => !empty($_REQUEST['company_ids']) ? $_REQUEST['company_ids'] : '',
        'save_view_results' => !empty($_REQUEST['save_view_results']) ? $_REQUEST['save_view_results'] : ''
    );

    if ($category_count < CATEGORY_THRESHOLD) {
        Tygh::$app['view']->assign('show_all', true);
    } else {
        $params['category_id'] = $category_id;
        $params['current_category_id'] = $category_id;
        $params['visible'] = true;
    }

    list($categories_tree) = fn_get_categories($params, DESCR_SL);
    Tygh::$app['view']->assign('categories_tree', $categories_tree);

    if ($category_count < CATEGORY_SHOW_ALL) {
        Tygh::$app['view']->assign('expand_all', true);
    }
    if (defined('AJAX_REQUEST')) {
        if (!empty($_REQUEST['random'])) {
            Tygh::$app['view']->assign('random', $_REQUEST['random']);
        }
        Tygh::$app['view']->assign('category_id', $category_id);
    }
} elseif ($mode == 'get_categories_list') {
    /** @var \Tygh\SmartyEngine\Core $view */
    $view = Tygh::$app['view'];

    $page = isset($_REQUEST['page']) ? (int) $_REQUEST['page'] : 1;
    $items_per_page = isset($_REQUEST['page_size']) ? (int) $_REQUEST['page_size'] : 10;
    $search_query = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
    $lang_code = isset($_REQUEST['lang_code']) ? $_REQUEST['lang_code'] : CART_LANGUAGE;
    $category_ids = isset($_REQUEST['id']) ? array_filter((array) $_REQUEST['id']) : null;
    $company_id = Registry::get('runtime.company_id');
    $item_template = empty($_REQUEST['template']) ? 'categories_select2_item' : trim($_REQUEST['template'], '.\\/');
    $objects = array();

    if (!$category_ids) {
        $params = array(
            'simple'            => false,
            'group_by_level'    => false,
            'get_company_name'  => true,
            'sort_by'           => 'name',
            'page'              => $page,
            'search_query'      => $search_query,
            'items_per_page'    => $items_per_page,
        );


        list($categories, $params) = fn_get_categories($params, $lang_code);

        $category_ids = array_keys($categories);
    }

    if ($category_ids) {
        $categories_data = fn_get_categories_list_with_parents($category_ids, $lang_code);

        $objects = array_values(array_map(function ($category) use ($view, $company_id, $item_template) {
            $view->assign('category', $category);

            return array(
                'id' => $category['category_id'],
                'text' => $category['category'],
                'data' => array(
                    'disabled' => $company_id && !empty($category['company_id']) && $company_id != $category['company_id'],
                    'content' => $view->fetch("views/categories/components/{$item_template}.tpl")
                )
            );
        }, $categories_data));
    }

    Tygh::$app['ajax']->assign('objects', $objects);
    Tygh::$app['ajax']->assign('total_objects', isset($params['total_items']) ? $params['total_items'] : count($objects));

    exit;
}

//
// Categories picker
//
if ($mode == 'picker') {
    if (isset($_REQUEST['disable_cancel'])) {
        if ($_REQUEST['disable_cancel']) {
            Tygh::$app['view']->assign('disable_cancel', $_REQUEST['disable_cancel']);
        }
    }

    Tygh::$app['view']->display('pickers/categories/picker_contents.tpl');
    exit;
}
