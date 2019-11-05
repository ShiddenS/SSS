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

namespace Tygh\Addons;

use Tygh\Registry;
use Tygh\Tygh;

class SchemesManager
{
    public static $schemas;

    /**
     * Creates and returns XmlScheme object for addon
     *
     * @param  string    $addon_id Addon name
     * @param  string    $path     Path to addons
     * @return AXmlScheme object
     */
    public static function getScheme($addon_id, $path = '')
    {
        if (empty($path)) {
            $path = Registry::get('config.dir.addons');
        }

        libxml_use_internal_errors(true);

        if (!isset(self::$schemas[$addon_id])) {
            libxml_clear_errors();

            $_xml = self::readXml($path . $addon_id . '/addon.xml');

            if ($_xml !== false) {
                $versions = self::getVersionDefinition();
                $version = (isset($_xml['scheme'])) ? (string) $_xml['scheme'] : '1.0';
                self::$schemas[$addon_id] = new $versions[$version]($_xml, Tygh::$app);
            } else {
                $errors = libxml_get_errors();

                $text_errors = [];
                foreach ($errors as $error) {
                    $text_errors[] = self::displayXmlError($error, $_xml);
                }

                libxml_clear_errors();
                if (!empty($text_errors)) {
                    fn_set_notification('E', __('xml_error'), '<br/>' . implode('<br/>', $text_errors));
                }

                return false;
            }
        }

        return self::$schemas[$addon_id];
    }

    /**
     * Loads xml
     * @param $filename
     * @return bool
     */
    private static function readXml($filename)
    {
        if (file_exists($filename)) {
            return simplexml_load_file($filename);
        }

        return false;
    }

    /**
     * Returns the scheme in which a class processing any certain xml scheme version is defined.
     * @static
     * @return array
     */
    private static function getVersionDefinition()
    {
        return array(
            '1.0' => 'Tygh\\Addons\\XmlScheme1',
            '2.0' => 'Tygh\\Addons\\XmlScheme2',
            '3.0' => 'Tygh\\Addons\\XmlScheme3',
            '4.0' => 'Tygh\\Addons\\XmlScheme4',
        );
    }

    /**
     * Returns list of add-ons that will not be worked correctly without it.
     *
     * @param string $addon_id  Add-on identified.
     * @param string $lang_code Language code.
     *
     * @return array
     */
    public static function getInstallDependencies($addon_id, $lang_code = CART_LANGUAGE)
    {
        $scheme = self::getScheme($addon_id);
        $dependencies = array();

        if ($scheme !== false) {
            $addons = $scheme->getDependencies();

            foreach ($addons as $addon_id) {
                if ($addon_id && !Registry::isExist('addons.' . $addon_id)) {
                    $name = self::getName($addon_id, $lang_code);
                    $dependencies[$addon_id] = $name ? $name : $addon_id;
                }
            }
        }

        return $dependencies;
    }

    /**
     * Returns list of addons that will not be worked correctly without it
     * @static
     * @param $addon_id
     * @param $lang_code
     * @return array
     */
    public static function getUninstallDependencies($addon_id, $lang_code = CART_LANGUAGE)
    {
        $addons = db_get_array('SELECT addon, dependencies FROM ?:addons WHERE dependencies LIKE ?l', '%' . $addon_id . '%');
        $addons = array_filter($addons, function($addon_data) use ($addon_id) {
            $dependencies = explode(',', $addon_data['dependencies']);

            return array_search($addon_id, $dependencies, true) !== false;
        });

        $dependencies = self::getNames(array_column($addons, 'addon'), true, $lang_code);

        return $dependencies;
    }

    /**
     * Convert add-on's ids list to array of add-on names as addon_id => addon_name.
     *
     * @param array     $addons         List identifiers of add-on.
     * @param boolean   $with_installed If false then retrieve names for only the not installed add-ons.
     * @param string    $lang_code      2 digits language code.
     *
     * @return array
     */
    public static function getNames($addons, $with_installed = true, $lang_code = CART_LANGUAGE)
    {
        $addon_names = array();

        foreach ($addons as $addon_id) {
            if (!empty($addon_id) && (Registry::get('addons.' . $addon_id) == null || $with_installed)) {
                $name = self::getName($addon_id, $lang_code);

                if ($name) {
                    $addon_names[$addon_id] = $name;
                }
            }
        }

        return $addon_names;
    }

    /**
     * Gets the name of the add-on by identifier.
     *
     * @param string $addon_id  Add-on identified.
     * @param string $lang_code Language code.
     *
     * @return null|string Returns null if the addon.xml file of the add-on doesn't exist.
     */
    public static function getName($addon_id, $lang_code)
    {
        $scheme = self::getScheme($addon_id);

        return $scheme !== false ? $scheme->getName($lang_code) : null;
    }

    private static function displayXmlError($error, $xml)
    {
        $return  = $xml[$error->line - 1] . "\n";

        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return .= '<b>'. __('warning') . " $error->code:</b> ";
                break;
             case LIBXML_ERR_ERROR:
                $return .= '<b>'. __('error') . " $error->code:</b> ";
                break;
            case LIBXML_ERR_FATAL:
                $return .= '<b>'. __('error') . " $error->code:</b> ";
                break;
        }

        $return .= trim($error->message) . '<br/>  <b>' . __('line') . "</b>: $error->line" . '<br/>  <b>' . __('column') . "</b>: $error->column";

        if ($error->file) {
            $return .= '<br/> <b>' . $error->file . '</b>';
        }

        return "$return<br/>";
    }

    /**
     * Clear internal cache.
     * @param string $addon_id
     */
    public static function clearInternalCache($addon_id)
    {
        unset(self::$schemas[$addon_id]);
        if (function_exists('opcache_invalidate')) {
            opcache_invalidate(Registry::get('config.dir.addons') . $addon_id . '/addon.xml');
        }
    }
}
