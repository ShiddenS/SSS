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
use Tygh\Languages\Languages;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

$_REQUEST['localization_id'] = empty($_REQUEST['localization_id']) ? 0 : $_REQUEST['localization_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $suffix = '';

    //
    // Update selected localization
    //

    if ($mode == 'update') {

        $localization_id = fn_update_localization($_REQUEST['localization_data'], $_REQUEST['localization_id'], DESCR_SL);

        $suffix = ".update?localization_id=$localization_id";
    }

    //
    // Delete selected localizations
    //
    if ($mode == 'm_delete') {

        if (!empty($_REQUEST['localization_ids'])) {
            fn_delete_localization($_REQUEST['localization_ids']);
        }

        $suffix = '.manage';
    }

    if ($mode == 'delete') {

        if (!empty($_REQUEST['localization_id'])) {
            fn_delete_localization((array) $_REQUEST['localization_id']);
        }

        $suffix = '.manage';
    }

    return array(CONTROLLER_STATUS_OK, 'localizations' . $suffix);
}

if ($mode == 'update') {

    $localizaton = fn_get_localization_data($_REQUEST['localization_id'], DESCR_SL, true);

    if (empty($localizaton)) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    Tygh::$app['view']->assign('localization' , $localizaton);
    Tygh::$app['view']->assign('localization_countries', array_diff(fn_get_simple_countries() , $localizaton['countries']));
    Tygh::$app['view']->assign('localization_currencies' , array_diff(fn_get_simple_currencies() , $localizaton['currencies']));
    Tygh::$app['view']->assign('localization_languages' , array_diff(Languages::getSimpleLanguages(true) , $localizaton['languages']));
    Tygh::$app['view']->assign('default_localization' , fn_get_default_localization(DESCR_SL));

    Registry::set('navigation.tabs', array (
        'general' => array (
            'title' => __('general'),
            'js' => true
        ),
        'details' => array (
            'title' => __('items_title'),
            'js' => true
        )
    ));

} elseif ($mode == 'add') {

    Tygh::$app['view']->assign('localization_countries', fn_get_simple_countries());
    Tygh::$app['view']->assign('localization_currencies' , fn_get_simple_currencies());
    Tygh::$app['view']->assign('localization_languages' , Languages::getSimpleLanguages(true));
    Tygh::$app['view']->assign('default_localization' , fn_get_default_localization(DESCR_SL));

    Registry::set('navigation.tabs', array (
        'general' => array (
            'title' => __('general'),
            'js' => true
        ),
        'details' => array (
            'title' => __('items_title'),
            'js' => true
        )
    ));

} elseif ($mode == 'manage') {

    Tygh::$app['view']->assign('localizations' , fn_get_localizations(DESCR_SL));
}

function fn_delete_localization($localization_ids)
{
    $loc_objects = fn_get_localization_objects();
    fn_set_progress('parts', sizeof($localization_ids) * sizeof($loc_objects));

    foreach ($localization_ids as $loc_id) {
        foreach ($loc_objects as $table) {
            fn_set_progress('echo', __('converting_data_in_table', array(
                '[table]' => $table
            )));
            db_query("UPDATE ?:$table SET localization = ?p", fn_remove_from_set('localization', $loc_id));
        }

        db_query("DELETE FROM ?:localizations WHERE localization_id = ?i", $loc_id);
        db_query("DELETE FROM ?:localization_descriptions WHERE localization_id = ?i", $loc_id);
        db_query("DELETE FROM ?:localization_elements WHERE localization_id = ?i", $loc_id);
    }

    fn_set_notification('N', __('notice'), __('done'));
}

function fn_get_localization_objects()
{
    $_tables = array(
        'products',
        'categories',
        'shippings',
        'payments',
        'pages',
        'destinations'
    );

    fn_set_hook('localization_objects', $_tables);

    return $_tables;
}

//
// C - country
// M - currency
// L - language
//
function fn_update_localization($data, $localization_id = 0, $lang_code = DESCR_SL)
{
    fn_define('POSITIONS_STEP', 10);

    if (!empty($localization_id)) {
        db_query('UPDATE ?:localizations SET ?u WHERE localization_id = ?i', $data, $localization_id);
        db_query('UPDATE ?:localization_descriptions SET ?u WHERE localization_id = ?i AND lang_code = ?s', $data, $localization_id, $lang_code);
        db_query("DELETE FROM ?:localization_elements WHERE localization_id = ?i", $localization_id);
    } else {
        $exist = db_get_field("SELECT COUNT(*) FROM ?:localizations");
        if (empty($exist)) {
            $data['is_default'] = 'Y';
        }
        $localization_id = $data['localization_id'] = db_query("REPLACE INTO ?:localizations ?e", $data);

        foreach (Languages::getAll() as $data['lang_code'] => $_v) {
            db_query("REPLACE INTO ?:localization_descriptions ?e", $data);
        }
    }

    $_data = array(
        'localization_id' => $localization_id,
    );

    if (!empty($data['countries'])) {
        $_data['element_type'] = 'C';
        foreach ($data['countries'] as $key => $value) {
            $_data['element'] = $value;
            $_data['position'] = POSITIONS_STEP * $key;
            db_query('INSERT INTO ?:localization_elements ?e', $_data);
        }
    }

    if (!empty($data['currencies'])) {
        $_data['element_type'] = 'M';
        foreach ($data['currencies'] as $key => $value) {
            $_data['element'] = $value;
            $_data['position'] = POSITIONS_STEP * $key;
            db_query('INSERT INTO ?:localization_elements ?e', $_data);
        }
    }

    if (!empty($data['languages'])) {
        $_data['element_type'] = 'L';
        foreach ($data['languages'] as $key => $value) {
            $_data['element'] = $value;
            $_data['position'] = POSITIONS_STEP * $key;
            db_query('INSERT INTO ?:localization_elements ?e', $_data);
        }
    }

    return $localization_id;
}

function fn_get_default_localization($lang_code = DESCR_SL)
{
    return db_get_row("SELECT a.localization_id, b.localization FROM ?:localizations as a LEFT JOIN ?:localization_descriptions as b ON a.localization_id = b.localization_id AND b.lang_code = ?s WHERE is_default = 'Y'", $lang_code);
}
