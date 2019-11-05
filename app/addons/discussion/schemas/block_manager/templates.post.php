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

if (fn_allowed_for('MULTIVENDOR') && !empty($schema['blocks/vendor_list_templates/featured_vendors.tpl'])) {
    $schema['blocks/vendor_list_templates/featured_vendors.tpl']['settings']['show_rating'] = array(
        'type' => 'checkbox',
        'default_value' => 'Y'
    );
}

return $schema;
