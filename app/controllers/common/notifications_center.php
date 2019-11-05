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

use Tygh\Common\OperationResult;
use Tygh\Tygh;

defined('BOOTSTRAP') or die('Access denied');

/** @var \Tygh\Ajax $ajax */
$ajax = Tygh::$app['ajax'];

/** @var array $auth */
$auth = Tygh::$app['session']['auth'];

/** @var \Tygh\NotificationsCenter\NotificationsCenter $notifications_center */
$notifications_center = Tygh::$app['notifications_center'];

if (empty($auth['user_id'])) {
    $view_data = $notifications_center->buildViewData([]);
    $ajax->assign('notifications_center', $view_data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($mode === 'set_read') {
        $params = array_merge([
            'is_read'          => true,
            'notification_ids' => [],
        ], $_REQUEST);

        $result = new OperationResult(false);
        if ($params['notification_ids']) {
            $result = $notifications_center->setRead($params['notification_ids'], $params['is_read']);
        }

        $ajax->assign('result', $result->isSuccess());
        if (!$result->isSuccess()) {
            $result->showNotifications();
        }
    } elseif ($mode === 'dismiss') {
        $params = array_merge([
            'notification_ids' => [],
        ], $_REQUEST);

        $result = new OperationResult(false);
        if ($params['notification_ids']) {
            $result = $notifications_center->dismiss($params['notification_ids']);
        }

        $ajax->assign('result', $result->isSuccess());
        if (!$result->isSuccess()) {
            $result->showNotifications();
        }
    }
    exit;
}

if ($mode === 'manage') {
    /** @var \Tygh\NotificationsCenter\Notification[] $notifications */
    $params = array_merge([
        'items_per_page' => null,
    ], $_REQUEST);

    $notifications = $notifications_center->get($params, $params['items_per_page']);

    $view_data = $notifications_center->buildViewData($notifications);

    $ajax->assign('notifications_center', $view_data);
}
exit;
