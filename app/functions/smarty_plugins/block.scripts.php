<?php

use Tygh\Development;
use Tygh\Registry;
use Tygh\Storage;
use \JShrink\Minifier;

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */
function smarty_block_scripts($params, $content, &$smarty, &$repeat)
{
    if ($repeat == true) {
        Registry::set('runtime.inside_scripts', 1);

        return;
    }

    if (Registry::get('config.tweaks.dev_js')) {
        $content .= smarty_helper_inline_scripts($params, $content, $smarty, $repeat);

        return $content;
    }

    $scripts = array();
    $external_scripts = array();
    $dir_root = Registry::get('config.dir.root');
    $return = '';
    $current_location = Registry::get('config.current_location');

    if (preg_match_all('/\<script(.*?)\>(.*?)\<\/script\>/s', $content, $m)) {
        $contents = '';

        foreach ($m[1] as $src) {
            if (!empty($src) && preg_match('/src ?= ?"([^"]+)"/', $src, $_m)) {
                if (strpos($_m[1], $current_location) !== false) {
                    $scripts[] = str_replace($current_location, '', preg_replace('/\?.*?$/', '', $_m[1]));
                } else {
                    $external_scripts[] = $_m[1];
                }
            }
        }

        // Check file changes in dev mode
        $names = $scripts;
        if (Development::isEnabled('compile_check')) {
            foreach ($names as $index => $name) {
                if (is_file($dir_root . '/' . $name)) {
                    $names[$index] .= filemtime($dir_root . '/' . $name);
                }
            }
        }

        $filename = 'js/tygh/scripts-' . md5(implode(',', $names)) . fn_get_storage_data('cache_id') . '.js';
        $file_exists = Storage::instance('assets')->isExist($filename);

        if (!$file_exists) {
            /** @var \Tygh\Lock\Factory $lock_factory */
            $lock_factory = Tygh::$app['lock.factory'];

            $lock = $lock_factory->createLock($filename);

            if (!$lock->acquire() && $lock->wait()) {
                $file_exists = Storage::instance('assets')->isExist($filename);
            }
        }

        if (!$file_exists) {

            foreach ($scripts as $src) {
                $contents .= fn_get_contents(Registry::get('config.dir.root') . $src);
            }

            $contents = str_replace('[files]', implode("\n", $scripts), Registry::get('config.js_css_cache_msg')) . $contents;

            if (function_exists('jsmin')) {
                $contents = jsmin($contents);
            } else {
                $contents = Minifier::minify($contents, array(
                    'flaggedComments' => false
                ));
            }

            Storage::instance('assets')->put($filename, array(
                'contents' => $contents,
                'compress' => false,
                'caching' => true
            ));

            if (isset($lock)) {
                $lock->release();
            }
        }

        $return = '<script type="text/javascript" src="' . Storage::instance('assets')->getUrl($filename) . '"></script>' . "\n";

        if (!empty($external_scripts)) {
            foreach ($external_scripts as $sc) {
                $return .= '<script type="text/javascript" src="' . $sc . '"></script>' . "\n";
            }
        }

        foreach ($m[2] as $sc) {
            if (!empty($sc)) {
                $return .= '<script type="text/javascript">' . $sc . '</script>' . "\n";
            }
        }
    }
    $return .= smarty_helper_inline_scripts($params, $content, $smarty, $repeat);

    return $return;
}

/**
 * @param array $params
 * @param string $content
 * @param \Tygh\SmartyEngine\Core $smarty
 * @param bool $repeat
 *
 * @return string
 * TODO: Make a proper class to work with inline scripts
 */
function smarty_helper_inline_scripts($params, $content, &$smarty, &$repeat)
{
    Registry::del('runtime.inside_scripts');
    // Get inline scripts
    $repeat = false;
    $smarty->loadPlugin('smarty_block_inline_script');
    $inline_scripts = "\n\n<!-- Inline scripts -->\n" . smarty_block_inline_script(array('output' => true), '', $smarty, $repeat);

    // FIXME: Backward compatibility. If {scripts} included at the TOP of the page, do not grab inline scripts.
    Registry::set('runtime.inside_scripts', 1);

    return $inline_scripts;
}
