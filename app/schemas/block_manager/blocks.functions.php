<?php

use Tygh\Enum\ProfileTypes;
use Tygh\Registry;
use Tygh\Enum\YesNo;
use Tygh\Enum\ProfileFieldSections;

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

function fn_blocks_get_vendor_info()
{
    $company_id = isset($_REQUEST['company_id']) ? $_REQUEST['company_id'] : null;

    $company_data = fn_get_company_data($company_id);
    $company_data['logos'] = fn_get_logos($company_id);

    return $company_data;
}

/**
 * Decides whether to disable cache for "products" block.
 *
 * @param $block_data
 *
 * @return bool Whether to disable cache
 */
function fn_block_products_disable_cache($block_data)
{
    // Disable cache for "Recently viewed" filling
    if (isset($block_data['content']['items']['filling'])
        && $block_data['content']['items']['filling'] == 'recent_products'
    ) {
        return true;
    }

    return false;
}

/**
 * Gets the data of companies by parameters.
 *
 * @param array $params An array of search parameters.
 *
 * @return array An array of companies
 */
function fn_blocks_get_vendors($params = array())
{
    $params['company_id'] = empty($params['item_ids']) ? array() : fn_explode(',', $params['item_ids']);

    $params['extend'] = array(
        'products_count' => empty($params['block_data']['properties']['show_products_count']) ? 'N' : $params['block_data']['properties']['show_products_count'],
        'logos'          => true,
        'placement_info' => true,
    );

    $displayed_vendors = empty($params['block_data']['properties']['displayed_vendors']) ? 0 : $params['block_data']['properties']['displayed_vendors'];

    /** @var \Tygh\Storefront\Storefront $storefront */
    $storefront = Tygh::$app['storefront'];
    if ($storefront->getCompanyIds()) {
        $params['company_id'] = $params['company_id']
            ? array_intersect($params['company_id'], $storefront->getCompanyIds())
            : $storefront->getCompanyIds();

        if (!$params['company_id']) {
            return [[]];
        }
    }

    list($companies,) = fn_get_companies($params, Tygh::$app['session']['auth'], $displayed_vendors);

    if ($companies) {
        $companies = fn_array_combine(fn_array_column($companies, 'company_id'), $companies);
    }

    return array($companies);
}

/**
 * Provides list of languages for the Languages block.
 *
 * @return array
 */
function fn_blocks_get_languages()
{
    // there is no need to get languages from the database as they are already initialized
    return Registry::get('languages');
}

/**
 * Fetches profile fields in saved order
 *
 * @param array $params Search parameters
 *
 * @return array
 */
function fn_blocks_get_lite_checkout_profile_fields($params)
{
    $item_ids = isset($params['item_ids']) ? explode(',', $params['item_ids']) : '';
    if (empty($item_ids)) {
        return [];
    }

    $profile_fields = fn_get_profile_fields('ALL', [], DESCR_SL, ['include_ids' => $item_ids]);
    unset($profile_fields[ProfileFieldSections::ESSENTIALS]);

    $section = key($profile_fields);
    $sorted_fields = fn_sort_by_ids($profile_fields[$section], $item_ids, 'field_id');

    $position = 0;
    foreach ($sorted_fields as $field_id => $field) {
        $sorted_fields[$field_id]['position'] = $position;
        $position += 10;
    }

    $prepared_profile_fields = [$section => $sorted_fields];

    return [$prepared_profile_fields];
}

/**
 * Synchronises customer location profile fields visibility
 *
 * @param $block_data
 */
function fn_blocks_update_customer_location_profile_fields_visibility($block_data)
{
    $params = [
        'section'            => ProfileFieldSections::SHIPPING_ADDRESS,
        'force_set_required' => ['s_country', 's_city', 's_state']
    ];

    fn_blocks_update_profile_fields_visibility($block_data, $params);
}

function fn_blocks_update_contact_information_check_required_fields(&$block_data)
{
    if (!isset($block_data['content']['items']['item_ids'])) {
        return;
    }

    $required_field_ids = db_get_hash_single_array(
        'SELECT field_id, field_name FROM ?:profile_fields WHERE field_name IN (?a) AND section = ?s AND profile_type = ?s',
        ['field_name', 'field_id'],
        ['email', 'phone'], ProfileFieldSections::CONTACT_INFORMATION, ProfileTypes::CODE_USER
    );

    if (isset($required_field_ids['email'])) {
        $field_ids = fn_explode(',', $block_data['content']['items']['item_ids']);

        $is_email_exists = in_array($required_field_ids['email'], $field_ids, true);
        $is_phone_exists = isset($required_field_ids['phone']) && in_array($required_field_ids['phone'], $field_ids, true);

        $is_email_required = isset($block_data['content']['items']['required'][sprintf('field_id_%s', $required_field_ids['email'])])
            && $block_data['content']['items']['required'][sprintf('field_id_%s', $required_field_ids['email'])] == YesNo::YES;

        $is_phone_required = isset($block_data['content']['items']['required'][sprintf('field_id_%s', $required_field_ids['phone'])])
            && $block_data['content']['items']['required'][sprintf('field_id_%s', $required_field_ids['phone'])] == YesNo::YES;

        if (!$is_email_exists && !$is_phone_exists) {
            $field_ids[] = $required_field_ids['email'];
            $block_data['content']['items']['required'][sprintf('field_id_%s', $required_field_ids['email'])] = YesNo::YES;

            $field = fn_get_profile_field($required_field_ids['email']);

            fn_set_notification('W', __('warning'),
                implode(PHP_EOL, [
                    __('bm.customer_information_block.warning.email_or_phome_must_be_required'),
                    __('bm.customer_information_block.warning.field_automaticly_added', ['[field_name]' => $field['description']])
                ])
            );
        } elseif ($is_email_exists && !$is_email_required && !$is_phone_required) {
            $block_data['content']['items']['required'][sprintf('field_id_%s', $required_field_ids['email'])] = YesNo::YES;

            $field = fn_get_profile_field($required_field_ids['email']);

            fn_set_notification('W', __('warning'),
                implode(PHP_EOL, [
                    __('bm.customer_information_block.warning.email_or_phome_must_be_required'),
                    __('bm.customer_information_block.warning.field_marked_as_required', ['[field_name]' => $field['description']])
                ])
            );
        } elseif (!$is_email_exists && $is_phone_exists && !$is_phone_required) {
            $block_data['content']['items']['required'][sprintf('field_id_%s', $required_field_ids['phone'])] = YesNo::YES;

            $field = fn_get_profile_field($required_field_ids['phone']);

            fn_set_notification('W', __('warning'),
                implode(PHP_EOL, [
                    __('bm.customer_information_block.warning.email_or_phome_must_be_required'),
                    __('bm.customer_information_block.warning.field_marked_as_required', ['[field_name]' => $field['description']])
                ])
            );
        }

        $block_data['content']['items']['item_ids'] = implode(',', $field_ids);

        if (isset($block_data['content_data']['content'])) {
            $block_data['content_data']['content'] = $block_data['content'];
        }
    }
}

/**
 * Synchronises contact information profile fields visibility
 *
 * @param $block_data
 */
function fn_blocks_update_contact_information_profile_fields_visibility($block_data)
{
    $params = [
        'section' => ProfileFieldSections::CONTACT_INFORMATION,
    ];
    fn_blocks_update_profile_fields_visibility($block_data, $params);
}

/**
 * Synchronises shipping address profile fields visibility
*
* @param $block_data
*/
function fn_blocks_update_shipping_address_profile_fields_visibility($block_data)
{
    $params = [
        'section'       => ProfileFieldSections::SHIPPING_ADDRESS,
        'exclude_names' => ['s_country', 's_city', 's_state'],
    ];
    fn_blocks_update_profile_fields_visibility($block_data, $params);
}

/**
 * Synchronises billing address profile fields visibility
*
* @param $block_data
*/
function fn_blocks_update_billing_address_profile_fields_visibility($block_data)
{
    $params = [
        'section' => ProfileFieldSections::BILLING_ADDRESS,
    ];
    fn_blocks_update_profile_fields_visibility($block_data, $params);
}

/**
 * Synchronises profile fields checkout visibility
 *
 * @param array $block_data Block data
 * @param array $params Picker parameters
 */
function fn_blocks_update_profile_fields_visibility($block_data, $params)
{
    if (!isset($block_data['content']['items']['item_ids'])) {
        return;
    }

    $block_contents = db_get_array(
        'SELECT content FROM ?:bm_blocks_content'
        . ' LEFT JOIN ?:bm_blocks ON ?:bm_blocks.block_id = ?:bm_blocks_content.block_id'
        . ' WHERE ?:bm_blocks.type IN (?a)',
        [
            'lite_checkout_location',
            'lite_checkout_customer_address',
            'lite_checkout_customer_information',
            'lite_checkout_customer_billing'
        ]
    );

    $used_field_ids = [];

    foreach ($block_contents as $block_content) {
        $content = (array) @unserialize($block_content['content']);
        $block_field_ids = isset($content['items']['item_ids']) ? fn_explode(',', $content['items']['item_ids']) : [];

        if (empty($block_field_ids)) {
            continue;
        }

        foreach ($block_field_ids as $field_id) {
            $used_field_ids[$field_id] = $field_id;
        }
    }

    $field_ids = explode(',', $block_data['content']['items']['item_ids']);

    $conditions['section'] = db_quote('section = ?s', $params['section']);
    $conditions['profile_type'] = db_quote('profile_type = ?s', ProfileTypes::CODE_USER);

    if (!empty($params['exclude_names'])) {
        $conditions['exclude_names'] = db_quote('field_name NOT IN (?a)', $params['exclude_names']);
    } elseif (!empty($params['include_names'])) {
        $conditions['include_names'] = db_quote('field_name IN (?a)', $params['include_names']);
    }

    if ($used_field_ids) {
        $conditions['field_ids'] = db_quote('field_id NOT IN (?n)', $used_field_ids);
    }

    db_query(
        'UPDATE ?:profile_fields SET checkout_show = ?s, checkout_required = ?s WHERE ?p',
        YesNo::NO,
        YesNo::NO,
        implode(' AND ', $conditions)
    );

    if (!empty($params['force_set_required']) && is_array($params['force_set_required'])) {
        $params['force_set_required'] = db_get_fields(
            'SELECT field_id FROM ?:profile_fields WHERE field_name IN (?a) AND section = ?s AND profile_type = ?s',
            $params['force_set_required'], $params['section'], ProfileTypes::CODE_USER
        );
    }

    foreach ($field_ids as $field_id) {
        $raw_required_flag = isset($block_data['content']['items']['required']["field_id_{$field_id}"])
            ? $block_data['content']['items']['required']["field_id_{$field_id}"] : null;

        if (!empty($params['force_set_required'])
            && (is_bool($params['force_set_required'])
            || in_array($field_id, $params['force_set_required'])
        )) {
            $required_flag = YesNo::YES;
        } else {
            $required_flag = $raw_required_flag == YesNo::YES ? YesNo::YES : YesNo::NO;
        }

        db_query(
            'UPDATE ?:profile_fields SET checkout_show = ?s, checkout_required = ?s WHERE field_id = ?i',
            YesNo::YES,
            $required_flag,
            $field_id
        );
    }
}

/**
 * Provides storefront ID for caching.
 *
 * @return int
 */
function fn_blocks_get_current_storefront_id()
{
    /** @var \Tygh\Storefront\Storefront $storefront */
    $storefront = Tygh::$app['storefront'];

    return $storefront->storefront_id;
}
