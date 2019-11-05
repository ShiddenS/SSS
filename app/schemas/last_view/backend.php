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

return array(
    'products' => array (
        'func' => 'fn_get_products',
        'item_id' => 'product_id'
    ),
    'pages' => array (
        'func' => 'fn_get_pages',
        'item_id' => 'page_id'
    ),
    'profiles' => array (
        'func' => 'fn_get_users',
        'item_id' => 'user_id',
        'auth' => true
    ),
    'orders' => array (
        'update_mode' => 'details',
        'func' => 'fn_get_orders',
        'item_id' => 'order_id',
        'links_label' => 'order',
        'show_item_id' => true,
        'list_mode' => 'update_status'
    ),
    'shipments' => array (
        'update_mode' => 'details',
        'func' => 'fn_get_shipments_info',
        'item_id' => 'shipment_id'
    ),
    'categories' => array (
        'update_mode' => 'update',
        'func' => 'fn_get_categories',
        'item_id' => 'category_id'
    ),
    'product_features' => array(
        'func' => 'fn_get_product_features',
        'item_id' => 'feature_id'
    ),
    'product_options' => array(
        'func' => 'fn_get_product_global_options',
        'item_id' => 'option_id'
    ),
    'cart' => array(
        'list_mode' => 'cart_list',
        'func' => 'fn_get_carts',
        'item_id' => 'user_id',
    )
);
