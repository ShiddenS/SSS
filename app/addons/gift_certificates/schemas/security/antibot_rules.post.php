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

$schema['gift_certificates']['add'] = array(
    'request_method'            => 'POST',
    'verification_scenario'     => 'gift_certificates',
    'save_post_data'            => array(
        'gift_cert_data',
    ),
    'rewrite_controller_status' => array(
        CONTROLLER_STATUS_DENIED,
    ),
);

return $schema;