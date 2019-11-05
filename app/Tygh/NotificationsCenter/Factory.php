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

namespace Tygh\NotificationsCenter;

use Tygh\Enum\NotificationSeverity;

/**
 * Class Factory creates Notifications.
 *
 * @package Tygh\NotificationsCenter
 */
class Factory implements IFactory
{
    /**
     * @param array $data
     *
     * @return \Tygh\NotificationsCenter\Notification
     */
    public function fromArray(array $data)
    {
        $data = array_merge([
            'notification_id' => 0,
            'user_id'         => 0,
            'title'           => '',
            'message'         => '',
            'severity'        => NotificationSeverity::NOTICE,
            'section'         => 'administration',
            'tag'             => '',
            'area'            => 'A',
            'action_url'      => '',
            'is_read'         => false,
            'timestamp'       => time(),
        ], $data);

        $data['is_read'] = (bool) $data['is_read'];

        $notification = new Notification(
            $data['notification_id'],
            $data['user_id'],
            $data['title'],
            $data['message'],
            $data['severity'],
            $data['section'],
            $data['tag'],
            $data['area'],
            $data['action_url'],
            $data['is_read'],
            $data['timestamp']
        );

        return $notification;
    }
}
