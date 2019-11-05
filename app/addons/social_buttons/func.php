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

use Tygh\Embedded;
use Tygh\Settings;
use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_get_sb_provider_settings($params)
{
    $view = Tygh::$app['view'];
    $addon_settings = Registry::get('settings.social_buttons');

    $provider_settings = array();
    if (!empty($addon_settings)) {
        foreach ($addon_settings as $provider_name => $provider_data) {
            if (!empty($provider_data[$provider_name . '_enable']) && $provider_data[$provider_name . '_enable'] === 'Y') {
                $func_name = 'fn_' . $provider_name . '_prepare_settings';
                if (is_callable($func_name)) {
                    $provider_settings[$provider_name]['data'] = call_user_func($func_name, $provider_data, $params);
                }
                $provider_settings[$provider_name]['template'] = $provider_name . '.tpl';
                if ($view->templateExists('addons/social_buttons/meta_templates/' . $provider_name . '.tpl')) {
                    $provider_settings[$provider_name]['meta_template'] = $provider_name . '.tpl';
                }
            }
        }
    }

    return $provider_settings;
}

function fn_pinterest_prepare_settings($pinterest_settings, $params)
{
    if (empty($pinterest_settings['pinterest_display_on'][$params['object']]) || $pinterest_settings['pinterest_display_on'][$params['object']] != 'Y') {
        return '';
    }

    $pinterest_fields = array(
       'data-pin-do' => 'buttonPin',
       'data-pin-shape' => $pinterest_settings['pinterest_shape'],
       'data-pin-height' => $pinterest_settings['pinterest_size'],
       'data-pin-color' => $pinterest_settings['pinterest_color'],
    );

    $pinterest_params = array(
        'url' => urlencode(fn_sb_get_url()),
        'media' => urlencode(fn_get_sb_image_url($params)),
        'description' => rawurlencode(fn_truncate_chars(htmlspecialchars(fn_get_sb_description($params)), 200)),
        'params' => '',
    );
    $_pinterest_params = '';
    foreach ($pinterest_fields as $field_name => $value) {
        if (!empty($value)) {
            $pinterest_params['params'] .= $field_name . '="' . $value . '" ';
        }
    }

    return $pinterest_params;
}

function fn_twitter_prepare_settings($twitter_settings, $params)
{
    if (empty($twitter_settings['twitter_display_on'][$params['object']]) || $twitter_settings['twitter_display_on'][$params['object']] != 'Y') {
        return '';
    }

    $default_twitter_fields = array(
        'data-lang' => $params['lang_code'],
        'data-size' => $twitter_settings['twitter_size'],
        'data-via' => $twitter_settings['twitter_via'],
        'data-count' => $twitter_settings['twitter_display_count'],
        'data-url' => fn_sb_get_url()
    );

    $twitter_params = '';
    foreach ($default_twitter_fields as $field_name => $value) {
        if (!empty($value)) {
            $twitter_params .= $field_name . '="' . $value . '" ';
        }
    }

    return $twitter_params;
}

function fn_facebook_prepare_settings($facebook_settings, $params)
{
    if (empty($facebook_settings['facebook_display_on'][$params['object']]) || $facebook_settings['facebook_display_on'][$params['object']] != 'Y') {
        return '';
    }

    $facebook_fields = array(
        'data-lang' => $params['lang_code'],
        'data-layout' => $facebook_settings['facebook_layout'],
        'data-href' => !empty($facebook_settings['facebook_href']) ? $facebook_settings['facebook_href'] : fn_sb_get_url(),
        'data-send' => ($facebook_settings['facebook_send'] != 'Y' ? 'false' : 'true'),
        'data-show-faces' => ($facebook_settings['facebook_show_faces'] != 'Y' ? 'false' : 'true'),
        'data-action' => $facebook_settings['facebook_action'],
        'data-font' => $facebook_settings['facebook_action_font'],
        'data-colorscheme' => $facebook_settings['facebook_colorscheme'],
        'data-width' => $facebook_settings['facebook_width'],
    );

    $facebook_params = '';
    foreach ($facebook_fields as $field_name => $value) {
        if (!empty($value)) {
            $facebook_params .= $field_name . '="' . $value . '" ';
        }
    }

    return $facebook_params;
}

function fn_vkontakte_prepare_settings($vkontakte_settings, $params)
{
    if (empty($vkontakte_settings['vkontakte_display_on'][$params['object']]) || $vkontakte_settings['vkontakte_display_on'][$params['object']] != 'Y') {
        return '';
    }

    $vkontakte_fields = array(
        'type' => $vkontakte_settings['vkontakte_button_style'],
        'width' => $vkontakte_settings['vkontakte_width'],
        'height' => $vkontakte_settings['vkontakte_height'],
        'pageImage' => fn_get_sb_image_url($params),
        'pageTitle' => fn_get_vkontakte_title($params),
        'pageDescription' => fn_js_escape(fn_truncate_chars(fn_get_sb_description($params), 200)),
        'pageUrl' => fn_sb_get_url(),
        'verb' => $vkontakte_settings['vkontakte_buttons_name'] == 'like' ? 0 : 1,
    );

    $default_values = array(
        'pageTitle' => fn_sb_format_page_title(),
    );
    //By default VK caches all data. We need to recalculate hash in order for VK to change the data in their cache
    $page_id = md5(implode(",", $vkontakte_fields));

    $vk_settings = '{';
    foreach ($vkontakte_fields as $field_name => $value) {
        if (empty($value) && !empty($default_values[$field_name])) {
            $value = $default_values[$field_name];
        }
        if (!empty($value)) {
            $vk_settings .= $field_name . ": '" . $value . "', ";
        }
    }
    $vk_settings .= "}, '" . $page_id . "'";

    return $vk_settings;
}

function fn_yandex_prepare_settings($yandex_settings, $params)
{
    if (empty($yandex_settings['yandex_display_on'][$params['object']]) || $yandex_settings['yandex_display_on'][$params['object']] != 'Y') {
        return '';
    }

    return $yandex_settings['yandex_share_code'];
}

function fn_get_sb_description($params)
{
    $description = '';

    if ($params['object'] == 'products') {
        $product = Tygh::$app['view']->getTemplateVars('product');
        $description = htmlspecialchars(strip_tags($product['full_description']));
    } elseif ($params['object'] == 'pages') {
        $page = Tygh::$app['view']->getTemplateVars('page');
        $description = htmlspecialchars(strip_tags($page['description']));
    }

    return $description;
}

function fn_get_vkontakte_title($params)
{
    $title = '';

    if ($params['object'] == 'products') {
        $product = Tygh::$app['view']->getTemplateVars('product');
        $title = htmlspecialchars(strip_tags($product['product']));
    } elseif ($params['object'] == 'pages') {
        $page = Tygh::$app['view']->getTemplateVars('page');
        $title = htmlspecialchars(strip_tags($page['page']));
    }

    return $title;
}

function fn_get_sb_image_url($params)
{
    $image_url = '';

    if ($params['object'] == 'products') {

        $product = Tygh::$app['view']->getTemplateVars('product');
        $image_url = isset($product['main_pair']['detailed']['image_path']) ? $product['main_pair']['detailed']['image_path'] : Registry::get('config.current_location') . '/images/no_image.png';

    } elseif ($params['object'] == 'pages') {
        $logos = fn_get_logos();
        if (fn_allowed_for('ULTIMATE')) {
            $company_id = Registry::ifGet('runtime.company_id', fn_get_default_company_id());
            $logos = fn_get_logos($company_id);
        }
        if (!empty($logos['theme']['image']['image_path'])) {
            $image_url = $logos['theme']['image']['image_path'];
        }
    }

    return $image_url;
}

function fn_get_sb_providers_meta_data($params)
{
    $addon_settings = Registry::get('settings.social_buttons');
    $providers_meta_data = array();

    if (fn_allowed_for('ULTIMATE')) {
        $company_id = Registry::ifGet('runtime.company_id', fn_get_default_company_id());
        $site_name = fn_get_company_name($company_id);
    }

    if ($params['object'] == 'products') {
        $product = Tygh::$app['view']->getTemplateVars('product');
        $providers_meta_data['all'] = array(
            'title' => fn_sb_format_page_title(),
            'url' => fn_url('products.view?product_id=' . $params['object_id']),
            'image' => !empty($product['main_pair']['detailed']['image_path']) ? $product['main_pair']['detailed']['image_path'] : '',
            'image:width' => !empty($product['main_pair']['detailed']['image_x']) ? $product['main_pair']['detailed']['image_x'] : '',
            'image:height' => !empty($product['main_pair']['detailed']['image_y']) ? $product['main_pair']['detailed']['image_y'] : '',
            'site_name' => !empty($site_name) ? $site_name : Registry::get('settings.Company.company_name'),
            'type' => 'product',
        );

    } elseif ($params['object'] == 'pages') {
        $page = Tygh::$app['view']->getTemplateVars('page');
        $logos = fn_get_logos();

        if (fn_allowed_for('ULTIMATE')) {
            $logos = fn_get_logos($company_id);
        }

        $providers_meta_data['all'] = array(
            'title' => $page['page'],
            'url' => !empty($page['link']) ? $page['link'] : fn_url('pages.view?page_id=' . $params['object_id']),
            'image' => !empty($logos['theme']['image']['image_path']) ? $logos['theme']['image']['image_path'] : '',
            'image:width' => !empty($logos['theme']['image']['image_x']) ? $logos['theme']['image']['image_x'] : '',
            'image:height' => !empty($logos['theme']['image']['image_y']) ? $logos['theme']['image']['image_y'] : '',
            'site_name' => !empty($site_name) ? $site_name : Registry::get('settings.Company.company_name'),
            'type' => 'article',
        );
    }

    if (!empty($addon_settings)) {
        foreach ($addon_settings as $provider_name => $provider_data) {
            $func_name = 'fn_' . $provider_name . '_prepare_meta_data';
            if (is_callable($func_name)) {
                $providers_meta_data[$provider_name] = call_user_func($func_name, $provider_data, $params);
            }

            if (!empty($providers_meta_data[$provider_name]['type'])) {
                $providers_meta_data['all']['type'] = $providers_meta_data[$provider_name]['type'];
            }
        }
    }

    return $providers_meta_data;
}

function fn_facebook_prepare_meta_data($provider_data, $params)
{
    $addon_settings = Registry::get('settings.social_buttons');

    if ($params['object'] == 'products') {
        $product = Tygh::$app['view']->getTemplateVars('product');
        $return = array(
            'type' => !empty($product['facebook_obj_type']) ? $product['facebook_obj_type'] : '',
            'app_id' => !empty($addon_settings['facebook']['facebook_app_id']) ? $addon_settings['facebook']['facebook_app_id'] : '',
        );
    } elseif ($params['object'] == 'pages') {
        $page = Tygh::$app['view']->getTemplateVars('page');
        $logos = fn_get_logos();

        $return = array(
            'type' => !empty($page['facebook_obj_type']) ? $page['facebook_obj_type'] : '',
            'app_id' => !empty($addon_settings['facebook']['facebook_app_id']) ? $addon_settings['facebook']['facebook_app_id'] : '',
        );
    }

    return $return;
}

function fn_sb_format_page_title()
{
    $page_title = Tygh::$app['view']->getTemplateVars('page_title');
    if (empty($page_title)) {
        $breadcrumbs = Tygh::$app['view']->getTemplateVars('breadcrumbs');
        $breadcrumb_titles = fn_array_column($breadcrumbs, 'title');
        if (fn_is_rtl_language()) {
            $page_title = implode(' :: ', array_reverse($breadcrumb_titles));
        } else {
            $page_title = implode(' :: ', $breadcrumb_titles);
        }
    }

    return $page_title;
}

function fn_social_buttons_before_dispatch()
{
    //For the stores works as widget. We need to redirect the customer to thee site where the Like button was clicked.
    if (isset($_REQUEST['_escaped_fragment_'])) {
        fn_redirect($_REQUEST['_escaped_fragment_'], true, true);
    }
}

function fn_social_buttons_settings_variants_image_verification_use_for(&$objects)
{
    $objects['email_share'] = __('use_for_email_share');
}

function fn_email_prepare_settings($email_settings, $params)
{
    if (empty($email_settings['email_display_on'][$params['object']]) || $email_settings['email_display_on'][$params['object']] != 'Y') {
        return '';
    }

    return $email_settings;
}

/**
 * Gets current URL taking into account embedded mode
 * @return string current URL
 */
function fn_sb_get_url()
{
    $url = fn_url(Registry::get('config.current_url'));

    if (Embedded::isEnabled()) {
        // If SEO addon is enabled, the relative url will contain the current path,
        // which is not what expected and therefore removed here
        $_url = fn_url(Registry::get('config.current_url'), AREA, 'rel');
        $_path = Registry::get('config.current_path');
        if (!empty($_path) && strpos($_url, $_path) === 0) {
            $_url = substr($_url, strlen($_path));
        }
        $url = Embedded::getUrl() . '#!/' . $_url;
    }

    return $url;
}

function fn_sb_display_block($provider_settings = array())
{
    $result = false;
    $settings = Registry::get('addons.social_buttons');

    if (!empty($settings)) {
        foreach ($settings as $setting_name => $setting_value) {
            $pos = strpos($setting_name, '_display_on');
            if ($pos && is_array($setting_value)) {
                $provider = substr($setting_name, 0, $pos);
                foreach ($setting_value as $value) {
                    if ($value == 'Y' && !empty($provider_settings[$provider]['data'])) {
                        $result = true;
                        break;
                    }
                }
            }
        }
    }

    return $result;
}
