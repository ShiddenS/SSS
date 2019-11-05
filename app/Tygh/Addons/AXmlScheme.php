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

use Tygh\Core\ApplicationInterface;
use Tygh\ExSimpleXmlElement;
use Tygh\Registry;
use Tygh\Languages\Languages;
use Tygh\Languages\Helper as LanguageHelper;
use Tygh\Snapshot;
use Tygh\Tools\Url;

abstract class AXmlScheme
{
    /**
     * @var ExSimpleXmlElement
     */
    protected $_xml;

    /**
     * @var array Available languages
     */
    private $languages;

    /**
     * @var ApplicationInterface
     */
    protected $app;

    protected $addon_dir;

    /**
     * @var \Composer\Autoload\ClassLoader
     */
    protected $class_loader;

    /**
     * Gets add-on directory path.
     *
     * @return string
     */
    public function getAddonDir()
    {
        return $this->addon_dir . $this->getId() . '/';
    }

    /**
     * Gets available languages
     * @return array languages list
     */
    public function getLanguages()
    {
        if (empty($this->languages)) {
            $this->languages = Languages::getAll();
        }

        return $this->languages;
    }

    /**
     * Returns array of types for addons setting
     * @return array
     */
    protected function _getTypes()
    {
        return array (
            'input' => 'I',
            'textarea' => 'T',
            'radiogroup' => 'R',
            'selectbox' => 'S',
            'password' => 'P',
            'checkbox' => 'C',
            'multiple select' => 'M',
            'multiple checkboxes' => 'N',
            'countries list' => 'X',
            'states list' => 'W',
            'file' => 'F',
            'info' => 'O',
            'header' => 'H',
            'selectable_box' => 'B',
            'template' => 'E',
            'permanent_template' => 'Z',
            'hidden' => 'D',
            'phone' => 'L'
        );
    }

    /**
     * Creates instance of class
     *
     * @param $addon_xml ExSimpleXmlElement with addon scheme
     * @param $app       ApplicationInterface Application instance
     */
    public function __construct($addon_xml, ApplicationInterface $app)
    {
        $this->_xml = $addon_xml;
        $this->app = $app;
        $this->addon_dir = Registry::get('config.dir.addons');
        $this->class_loader = $app['class_loader'];
    }

    /**
     * Returns text id of addon from xml
     * @return string
     */
    public function getId()
    {
        return (string) $this->_xml->id;
    }

    /**
     * Returns addons text name from xml.
     * @param  string $lang_code
     * @return string
     */
    public function getName($lang_code = CART_LANGUAGE)
    {
        $name = $this->_getTranslation($this->_xml, 'name', $lang_code);

        return ($name == '') ? (string) $this->_xml->name : $name;
    }

    /**
     * Returns addons text description from xml.
     * @param  string $lang_code
     * @return string
     */
    public function getDescription($lang_code = CART_LANGUAGE)
    {
        $description = $this->_getTranslation($this->_xml, 'description', $lang_code);

        return ($description == '') ? (string) $this->_xml->description : $description;
    }

    /**
     * Returns priority of addon from xml
     * @return int
     */
    public function getPriority()
    {
        return (isset($this->_xml->priority)) ? (int) $this->_xml->priority  : 0;
    }

    /**
     * Returns priority of addon from xml
     * @return string
     */
    public function getStatus()
    {
        $statuses = array(
            'active' => 'A',
            'disabled' => 'D'
        );

        return isset($this->_xml->status) ? $statuses[(string) $this->_xml->status] : 'D';
    }

    /**
     * Returns array of addon's ids
     * @return array
     */
    public function getDependencies()
    {
        return (isset($this->_xml->dependencies)) ? explode(',', (string) $this->_xml->dependencies) : array();
    }

    /**
     * Returns unmanaged status
     * @return boolean
     */
    public function getUnmanaged()
    {
        return (isset($this->_xml->unmanaged));
    }

    /**
     * Return assray of names of conflicted addons
     */
    public function getConflicts()
    {
        $conflicts = array();
        foreach ($this->_xml->xpath('//conflicts') as $addon) {
            $conflicts[] = (string) $addon;
        }

        return $conflicts;
    }

    /**
     * Returns array of editions
     * @return array
     */
    public function autoInstallFor()
    {
        return (isset($this->_xml->auto_install)) ? explode(',', (string) $this->_xml->auto_install) : array();
    }

    /**
     * Returns comma separated list of editions for addon section
     * @return string
     */
    public function getEditionType()
    {
        return $this->_getEditionType($this->_xml->settings);
    }

    /**
     * Returns way how will be displayed addon settings list.
     * popup - in popup box
     * separate - in new window
     * @return string
     */
    public function getSettingsLayout()
    {
        return "popup";
    }

    /**
     * Executes queries from addon scheme.
     *
     * @param  string $mode
     * @param  string $addon_path
     * @return bool
     */
    public function processQueries($mode, $addon_path)
    {
        Registry::set('runtime.database.skip_errors', true);

        $languages = $this->getLanguages();
        $queries = $this->getQueries($mode);

        $lang_queries = array();

        if (!empty($queries) && is_array($queries)) {
            foreach ($queries as $query) {
                if (!empty($query['lang']) && !empty($query['table'])) {
                    $lang_queries[(string) $query['table']][(string) $query['lang']][] = $query;
                } else {
                    $this->_executeQuery($query, $addon_path);
                }
            }
        }

        $default_lang = $this->getDefaultLanguage();
        foreach ($lang_queries as $table_name => $queries) {
            // Check and execute default language queries
            if (isset($queries[$default_lang])) {
                // Actions with default language
                foreach ($queries[$default_lang] as $default_query) {
                    $this->_executeQuery($default_query, $addon_path);

                    // Clone default values to all other languages
                    foreach ($languages as $lang_code => $lang_data) {
                        LanguageHelper::cloneLanguageValues((string) $default_query['table'], $lang_code, (string) $default_query['lang']);
                    }
                }
            }

            // execute other languages queries
            foreach ($languages as $lang_code => $lang_data) {
                if (isset($queries[$lang_code])) {
                    foreach ($queries[$lang_code] as $query) {
                        $this->_executeQuery($query, $addon_path);
                    }
                }
            }
        }

        Registry::set('runtime.database.skip_errors', false);

        $errors = Registry::get('runtime.database.errors');
        if (!empty($errors)) {
            $error_text = '';
            foreach ($errors as $error) {
                $error_text .= '<br/>' . $error['message'] . ': <code>'. $error['query'] . '</code>';
            }
            $notification_text = ($mode == 'uninstall') ? __('addon_uninstall_sql_error') : __('addon_sql_error');
            fn_set_notification('E', $notification_text, $error_text);

            Registry::set('runtime.database.errors', array());

            return false;
        } else {
            return true;
        }
    }

    /**
     * Executes query from addon xml scheme
     * @return bool always true
     */
    protected function _executeQuery($query, $addon_path)
    {
        if (isset($query['type']) && (string) $query['type'] == 'file') {
            $query = (string) $query;
            $files = fn_get_dev_files("{$addon_path}/{$query}", true, true);
            foreach ($files as $query) {
                db_import_sql_file($query, 16384, false, 1, true);
            }
        } else {
            db_query((string) $query);
        }

        return true;
    }

    /**
     * Returns tab order
     * @return string
     */
    public function getTabOrder()
    {
        return (isset($this->_xml->tab_order)) ? $this->_xml->tab_order : 'append';
    }

    /**
     * Returns addon promo status
     * @return bool
     */
    public function isPromo()
    {
        $addon_name = (string) $this->_xml->id;

        return !fn_check_addon_snapshot($addon_name);
    }

    /**
     * Checks if addon has custom icon
     * @return bool
     */
    public function hasIcon()
    {
        return (isset($this->_xml->has_icon)) ? (bool) $this->_xml->has_icon : false;
    }

    /**
     * Returns addon promo status
     * @return bool
     */
    public function getVersion()
    {
        return (isset($this->_xml->version)) ? (string) $this->_xml->version : '';
    }

    /**
     * Returns addon supplier
     * @return string
     */
    public function getSupplier()
    {
        $result = '';

        if (isset($this->_xml->supplier)) {
            $result = (string) $this->_xml->supplier;
        } elseif ($this->isCoreAddon()) {
            $result = 'CS-Cart';
        }

        return $result;
    }


    /**
     * Return addon supplier link
     * @return null|string http://example.com
     */
    public function getSupplierLink()
    {
        $url = '';
        
        if (isset($this->_xml->supplier_link)) {
            $url = (string) $this->_xml->supplier_link;
        } elseif ($this->isCoreAddon()) {
            $url = Registry::get('config.resources.core_addons_supplier_url');
        }

        if (!empty($url) && Url::isValid($url)) {
            return $url;
        }

        return null;
    }

    /**
     * Returns edition type for this node.
     * If in this node has no edition type returns edition type of it's parent.
     * If for all parents of this node has no edition type returns ROOT.
     * @param  \SimpleXMLElement|array $xml_node
     * @return string
     */
    public function _getEditionType($xml_node)
    {
        $edition_type = 'ROOT'; // Set default value of edition type

        if (isset($xml_node['edition_type'])) {
            $edition_type = (string) $xml_node['edition_type'];
        } else { // Try to take parent edition type
            if (is_object($xml_node)) {
                $parent = $xml_node->xpath('parent::*');
                if (is_array($parent)) {
                    $parent = current($parent);
                    if (!empty($parent)) {
                        $edition_type = $this->_getEditionType($parent);
                    }
                }
            }
        }

        return $edition_type;
    }

    /**
     * Returns translations of description and addon name.
     * @return array|bool
     */
    public function getAddonTranslations()
    {
        return $this->_getTranslations($this->_xml);
    }

    public function callCustomFunctions($action)
    {
        // Execute custom functions
        if (isset($this->_xml->functions)) {
            Registry::set('runtime.database.skip_errors', true);

            $addon_name = (string) $this->_xml->id;
            // Include func.php file of this addon
            if (is_file(Registry::get('config.dir.addons') . $addon_name . '/func.php')) {
                require_once(Registry::get('config.dir.addons') . $addon_name . '/func.php');

                if (is_file(Registry::get('config.dir.addons') . $addon_name . '/config.php')) {
                    require_once(Registry::get('config.dir.addons') . $addon_name . '/config.php');
                }

                foreach ($this->_xml->functions->item as $v) {
                    if (($action == 'install' && !isset($v['for'])) || (string) $v['for'] == $action) {
                        if (function_exists((string) $v)) {
                            call_user_func((string) $v, $v, $action);
                        }
                    }
                }
            }

            Registry::set('runtime.database.skip_errors', false);

            $errors = Registry::get('runtime.database.errors');
            if (!empty($errors)) {
                $error_text = '';
                foreach ($errors as $error) {
                    $error_text .= '<br/>' . $error['message'] . ': <code>'. $error['query'] . '</code>';
                }
                $notification_text = ($action == 'uninstall') ? __('addon_uninstall_sql_error') : __('addon_sql_error');
                fn_set_notification('E', $notification_text, $error_text);

                Registry::set('runtime.database.errors', array());

                return false;
            }
        }

        return true;
    }

    /**
     * Uninstall all langvars
     */
    public function uninstallLanguageValues()
    {
        $node = $this->_getLangVarsSectionName();
        $langvars = $this->_xml->xpath($node . '/item');
        if (!empty($langvars) && is_array($langvars)) {
            foreach ($langvars as $langvar) {
                db_query("DELETE FROM ?:language_values WHERE name = ?s", (string) $langvar['id']);

                if (fn_allowed_for('ULTIMATE')) {
                    db_query("DELETE FROM ?:ult_language_values WHERE name = ?s", (string) $langvar['id']);
                }
            }
        }
    }

    /**
     * Install all langvars from addon xml scheme
     */
    public function getLanguageValues($only_originals = false)
    {
        $language_variables = array();
        $node = $this->_getLangVarsSectionName();
        $default_lang = $this->getDefaultLanguage();

        $original_langvars = (array) $this->_xml->xpath($node . "/item[@lang='en']");
        $_original = array();

        foreach ($original_langvars as $_v) {
            $_original[(string) $_v['id']] = (string) $_v;
        }

        $default_langvars = $this->_xml->xpath($node . "/item[@lang='$default_lang']");
        if (!empty($default_langvars)) {
            // Fill all languages by default laguage values
            foreach ($this->getLanguages() as $lang_code => $_v) {
                // Install default
                foreach ($default_langvars as $lang_var) {
                    $original = isset($_original[(string) $lang_var['id']]) ? $_original[(string) $lang_var['id']] : (string) $lang_var;

                    if ($only_originals) {
                        $language_variables[] = array(
                            'msgctxt' => 'Languages' . \I18n_Pofile::DELIMITER . (string) $lang_var['id'],
                            'msgid' => $original,
                        );

                    } else {
                        $language_variables[] = array(
                            'lang_code' => $lang_code,
                            'name' => (string) $lang_var['id'],
                            'value' => (string) $lang_var,
                        );
                    }
                }

                if ($lang_code != $default_lang) {
                    $current_langvars = $this->_xml->xpath($node . "/item[@lang='$lang_code']");
                    if (!empty($current_langvars)) {
                        foreach ($current_langvars as $lang_var) {
                            $original = isset($_original[(string) $lang_var['id']]) ? $_original[(string) $lang_var['id']] : (string) $lang_var;

                            if ($only_originals) {
                                $language_variables[] = array(
                                    'msgctxt' => 'Languages' . \I18n_Pofile::DELIMITER . (string) $lang_var['id'],
                                    'msgid' => $original,
                                );

                            } else {
                                $language_variables[] = array(
                                    'lang_code' => $lang_code,
                                    'name' => (string) $lang_var['id'],
                                    'value' => (string) $lang_var,
                                );
                            }
                        }
                    }
                }
            }
        }

        return $language_variables;
    }

    /**
     * Gets original values for language-dependence name/description
     *
     * @return array Original values
     */
    public function getOriginals()
    {
        return false;
    }

    /**
     * Gets path to PO translation for specified language
     *
     * @param  string      $lang_code 2-letters language identifier
     * @return string|bool Path to file if exists of false otherwise
     */
    public function getPoPath($lang_code)
    {
        return false;
    }

    /**
     * Gets email templates.
     *
     * @return array
     */
    public function getEmailTemplates()
    {
        return array();
    }

    /**
     * Gets document templates.
     *
     * @return array
     */
    public function getDocumentTemplates()
    {
        return array();
    }

    /**
     * Gets snippet templates.
     *
     * @return array
     */
    public function getSnippetTemplates()
    {
        return array();
    }

    /**
     * Returns one translation for some node for some language
     * @param $node
     * @param string $for
     * @param $lang_code
     * @return string
     */
    protected function _getTranslation($node, $for = '', $lang_code= CART_LANGUAGE)
    {
        $name = '';

        if (isset($node->translations)) {
            foreach ($node->translations->item as $item) {
                $a = isset($item['for']) && $for != '';
                $b = (string) $item['for'] == $for;
                $c = (string) $item['lang'] == $lang_code;
                if ($c && ($a && $b || !$a)) {
                    $name = (string) $item;
                }
            }
        }

        return $name;
    }

    /**
     * Returns all translations for xml_node for all installed laguages if it is presents in addon xml
     * @param  \SimpleXMLElement|array $xml_node
     * @return array|bool
     */
    protected function _getTranslations($xml_node)
    {
        $translations = array();

        $default_language = $this->getDefaultLanguage();

        // Generate id from attribute or property
        if (isset($xml_node['id'])) {
            $id = (string) $xml_node['id'];
        } elseif (isset($xml_node->id)) {
            $id = (string) $xml_node->id;
        } else {
            return false;
        }

        $default_translation = array(
            'lang_code' => $default_language,
            'name' => $id,
            'value' => (string) $xml_node->name,
            'tooltip' => isset($xml_node->tooltip) ? (string) $xml_node->tooltip : '',
            'description' => isset($xml_node->description) ? (string) $xml_node->description : '',
        );

        // Fill all languages by default laguage values
        foreach ($this->getLanguages() as $lang_code => $_v) {
            $value = $xml_node->xpath("translations/item[(not(@for) or @for='name') and @lang='$lang_code']");
            $tooltip = $xml_node->xpath("translations/item[@for='tooltip' and @lang='$lang_code']");
            $description = $xml_node->xpath("translations/item[@for='description' and @lang='$lang_code']");
            if (!empty($value) || !empty($default_translation['value'])) {
                $translations[] = array(
                    'lang_code' =>  $lang_code,
                    'name' => $default_translation['name'],
                    'value' => !empty($value) && is_array($value) ? (string) current($value) : $default_translation['value'],
                    'tooltip' => !empty($tooltip) && is_array($tooltip) ? (string) current($tooltip) : $default_translation['tooltip'],
                    'description' => !empty($description) && is_array($description) ? (string) current($description) : $default_translation['description'],
                );
            }
        }

        return $translations;
    }

    /**
     * Returns array of setting item data from xml node
     * @param $xml_node
     * @return array
     */
    protected function _getSettingItem($xml_node)
    {
        if (isset($xml_node['id'])) {
            $_types = $this->_getTypes();
            $setting = array(
                'edition_type' =>  $this->_getEditionType($xml_node),
                'id' => (string) $xml_node['id'],
                'name' => (string) $xml_node->name,
                'type' => isset($_types[(string) $xml_node->type]) ? $_types[(string) $xml_node->type] : '',
                'translations' => $this->_getTranslations($xml_node),
                'default_value' => isset($xml_node->default_value) ? (string) $xml_node->default_value : '',
                'variants' => $this->_getVariants($xml_node),
                'handler' => isset($xml_node->handler) ? (string) $xml_node->handler : '',
                'parent_id' => isset($xml_node['parent_id']) ? (string) $xml_node['parent_id'] : '',
                'original' => '',
            );

            return $setting;
        } else {
            return array();
        }
    }

    /**
     * Returns array of variants of setting item from xml node
     * @param $xml_node
     * @return array
     */
    protected function _getVariants($xml_node)
    {
        $variants = array();
        if (isset($xml_node->variants)) {
            foreach ($xml_node->variants->item as $variant) {
                $variants[] = array(
                    'id' => (string) $variant['id'],
                    'name' => (string) $variant->name,
                    'translations' => $this->_getTranslations($variant),
                    'original' => '',
                );
            }
        }

        return $variants;
    }

    /**
     * Returns array of language variables of addon.
     *
     * @abstract
     * @return array
     */
    abstract protected function _getLangVarsSectionName();

    /**
     * Returns array of settings sections of addon.
     * In current version of cart it is tabs on addon's update settings page
     *
     * @abstract
     * @return array
     */
    abstract public function getSections();

    /**
     * Returns array of settings on section
     * @abstract
     * @param $section_id
     * @return array
     */
    abstract public function getSettings($section_id);

    /**
     * Returns array of SQL queries
     * @abstract
     * @param  string $mode May be install or uninstall
     * @return array
     */
    abstract protected function getQueries($mode = '');

    /**
     * Returns 2digits lang code
     * @abstract
     * @return string
     */
    abstract public function getDefaultLanguage();

    /**
     * Magic method for _serialize
     * @return array
     */
    public function __sleep ()
    {
        $this->_xml = $this->_xml->asXML();

        return array('_xml');
    }

    /**
     * Return flag is core addon
     * @return bool
     */
    public function isCoreAddon()
    {
        $core_addons = Snapshot::getCoreAddons();

        return in_array($this->getId(), $core_addons);
    }

    /**
     * Loads an add-on into the application runtime.
     *
     * @return void
     */
    public function loadAddon()
    {
        $this->registerAutoloadEntries();

        $addon_directory = $this->getAddonDir();

        if (file_exists($addon_directory . '/init.php')) {
            require_once($addon_directory . '/init.php');
        }
        if (file_exists($addon_directory . '/func.php')) {
            require_once($addon_directory . '/func.php');
        }
        if (file_exists($addon_directory . '/config.php')) {
            require_once($addon_directory . '/config.php');
        }
    }

    /**
     * Registers autoloader entries listed at the XML schema. Usually this is done at the very beginning of the add-on
     * loading process.
     *
     * @see \Tygh\Addons\AXmlScheme::getPsr0AutoloadEntries()
     * @see \Tygh\Addons\AXmlScheme::getPsr4AutoloadEntries()
     *
     * @return void
     */
    public function registerAutoloadEntries()
    {
        foreach ($this->getPsr0AutoloadEntries() as $prefix => $paths) {
            $this->class_loader->add($prefix, $paths);
        }

        foreach ($this->getPsr4AutoloadEntries() as $prefix => $paths) {
            $this->class_loader->addPsr4($prefix, $paths);
        }
    }

    /**
     * @see \Composer\Autoload\ClassLoader::add()
     * @return array Key-value pairs, where key is auloloading prefix and value is either string or array of FS paths.
     */
    public function getPsr0AutoloadEntries()
    {
        $autoload = [];

        $autoload[''] = $this->getAddonDir();

        return $autoload;
    }

    /**
     * @see \Composer\Autoload\ClassLoader::addPsr4()
     * @return array Key-value pairs, where key is auloloading prefix and value is either string or array of FS paths.
     */
    public function getPsr4AutoloadEntries()
    {
        return [];
    }
}
