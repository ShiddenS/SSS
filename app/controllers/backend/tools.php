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
use Tygh\Settings;
use Tygh\Snapshot;
use Tygh\Languages\Languages;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($mode == 'update_quick_menu_item') {
        $_data = $_REQUEST['item'];

        if (empty($_data['position'])) {
            $_data['position'] = db_get_field("SELECT max(position) FROM ?:quick_menu WHERE parent_id = ?i", $_data['parent_id']);
            $_data['position'] = $_data['position'] + 10;
        }

        $_data['user_id'] = $auth['user_id'];
        $_data['url'] = fn_qm_parse_url($_data['url']);

        if (empty($_data['id'])) {
            $id = db_query("INSERT INTO ?:quick_menu ?e", $_data);

            $_data = array (
                'object_id' => $id,
                'description' => $_data['name'],
                'object_holder' => 'quick_menu'
            );

            foreach (Languages::getAll() as $_data['lang_code'] => $v) {
                db_query("INSERT INTO ?:common_descriptions ?e", $_data);
            }
        } else {
            db_query("UPDATE ?:quick_menu SET ?u WHERE menu_id = ?i", $_data, $_data['id']);

            $__data = array(
                'description' => $_data['name']
            );
            db_query("UPDATE ?:common_descriptions SET ?u WHERE object_id = ?i AND object_holder = 'quick_menu' AND lang_code = ?s", $__data, $_data['id'], DESCR_SL);
        }

        return array(CONTROLLER_STATUS_OK, 'tools.show_quick_menu.edit?no_popup=1');
    }

    if ($mode == 'view_changes') {

        if (!empty($_REQUEST['compare_data']['db_name'])) {
            Snapshot::createDb();
            Snapshot::createDb($_REQUEST['compare_data']['db_name']);
        }

        return array(CONTROLLER_STATUS_OK, 'tools.view_changes?db_ready=Y');
    }

    if ($mode == 'update_status') {

        fn_tools_update_status($_REQUEST);

        if (empty($_REQUEST['redirect_url'])) {
            exit;
        }
    }

    return;
}

if ($mode == 'phpinfo') {
    phpinfo();
    exit;

} elseif ($mode == 'show_quick_menu') {
    if (Registry::get('runtime.action') == 'edit') {
        Tygh::$app['view']->assign('edit_quick_menu', true);
    } else {
        Tygh::$app['view']->assign('expand_quick_menu', true);
    }

    if (empty($_REQUEST['no_popup'])) {
        Tygh::$app['view']->assign('show_quick_popup', true);
    }
    Tygh::$app['view']->display('common/quick_menu.tpl');
    exit;

} elseif ($mode == 'get_quick_menu_variant') {
    Tygh::$app['ajax']->assign('description', db_get_field("SELECT description FROM ?:common_descriptions WHERE object_id = ?i AND object_holder = 'quick_menu' AND lang_code = ?s", $_REQUEST['id'], DESCR_SL));
    exit;

} elseif ($mode == 'remove_quick_menu_item') {
    $where = '';
    if (intval($_REQUEST['parent_id']) == 0) {
        $where = db_quote(" OR parent_id = ?i", $_REQUEST['id']);
        $delete_ids = db_get_fields("SELECT menu_id FROM ?:quick_menu WHERE parent_id = ?i", $_REQUEST['id']);
        db_query("DELETE FROM ?:common_descriptions WHERE object_id IN (?n) AND object_holder = 'quick_menu'", $delete_ids);
    }

    db_query("DELETE FROM ?:quick_menu WHERE menu_id = ?i ?p", $_REQUEST['id'], $where);
    db_query("DELETE FROM ?:common_descriptions WHERE object_id = ?i AND object_holder = 'quick_menu'", $_REQUEST['id']);

    Tygh::$app['view']->assign('edit_quick_menu', true);
    Tygh::$app['view']->assign('quick_menu', fn_get_quick_menu_data());
    Tygh::$app['view']->display('common/quick_menu.tpl');
    exit;

} elseif ($mode == 'update_quick_menu_handler') {
    if (!empty($_REQUEST['enable'])) {
        Settings::instance()->updateValue('show_menu_mouseover', $_REQUEST['enable']);

        return array(CONTROLLER_STATUS_REDIRECT, 'tools.show_quick_menu.edit');
    }
    exit;

} elseif ($mode == 'cleanup_history') {
    Tygh::$app['session']['last_edited_items'] = array();
    fn_save_user_additional_data('L', '');
    Tygh::$app['view']->assign('last_edited_items', '');
    Tygh::$app['view']->display('common/last_viewed_items.tpl');
    exit;

// Open/close the store
} elseif ($mode == 'store_mode') {

    fn_set_store_mode($_REQUEST['state']);
    exit;

} elseif ($mode == 'update_position') {

    if (db_has_table($_REQUEST['table'])) {
        $table_name = $_REQUEST['table'];
    } else {
        exit;
    }

    $table_fields = fn_get_table_fields($table_name);
    $id_name = $_REQUEST['id_name'];
    $ids = explode(',', $_REQUEST['ids']);
    $positions = explode(',', $_REQUEST['positions']);
    $fields = array($id_name, 'position');

    if (empty($table_fields) || count(array_intersect($table_fields, $fields)) !== count($fields)) {
        exit;
    }

    foreach ($ids as $k => $id) {
        db_query("UPDATE ?:$table_name SET position = ?i WHERE ?w", $positions[$k], array($id_name => $id));
    }

    fn_set_notification('N', __('notice'), __('positions_updated'));

    exit;

} elseif ($mode == 'view_changes') {

    fn_delete_notification('core_files_have_been_modified');

    Tygh::$app['view']->assign(Snapshot::changes($_REQUEST));

} elseif ($mode == 'create_snapshot') {

    Snapshot::create(array(
        'theme_rel_backend' => fn_get_theme_path('[relative]', 'A'),
        'themes_frontend' => fn_get_theme_path('[themes]', 'C'),
        'themes_repo' => fn_get_theme_path('[repo]', 'C')
    ));

    return array(CONTROLLER_STATUS_OK, 'tools.view_changes');

}

function fn_qm_parse_url($url)
{
    if (strpos($url, '?') !== false) {
        list(, $query_string) = explode('?', $url);
        parse_str($query_string, $params);
        if (!empty($params['dispatch'])) {
            $dispatch = $params['dispatch'];
            unset($params['dispatch']);
            $url = $dispatch . '?' . http_build_query($params);
        }
    }

    return $url;
}
