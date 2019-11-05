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

namespace Tygh\BlockManager;

use Tygh\CompanySingleton;
use Tygh\ExSimpleXmlElement;
use Tygh\Languages\Languages;
use Tygh\Registry;

class Exim extends CompanySingleton
{
    /**
     * @var int Exported layout ID
     */
    private $layout_id = 0;

    /**
     * @var string|null Theme name the layout belongs to
     */
    private $theme_name = null;

    /**
     * @var array Default settings for XML layout
     */
    protected $settings = array();

    /**
     * Imports blocks from file
     * @param  string $xml_filepath Path to file
     * @param  array  $params
     * @return bool   True on success false otherwise
     */
    public function importFromFile($xml_filepath, $params = array('override_by_dispatch' => 'Y'))
    {
        $result = false;

        $structure = $this->getStructure($xml_filepath);
        if (!empty($structure)) {
            $result = $this->import($structure, $params);
        }

        return $result;
    }

    /**
     * Export layout data to file
     *
     * @param string $layout_id    Exported layout id
     * @param array  $location_ids List of exported locations
     * @param string $filename     Name of the export file
     *
     * @return string|bool   Filename if export was success or false otherwise
     */
    public function exportToFile($layout_id, $location_ids, $filename = '')
    {
        $content = $this->export($layout_id, $location_ids);

        $filename = empty($filename) ? date('mdY', TIME) . '.xml' : $filename;
        $file_path = ($this->_company_id) ? sprintf('%s/%s', $this->_company_id, $filename) : $filename;

        fn_mkdir(dirname(Registry::get('config.dir.layouts') . $file_path));

        $result = fn_put_contents(Registry::get('config.dir.layouts') . $file_path, $content);

        return $result ? $filename : $result;
    }

    /**
     * Imports blocks from XML structure
     *
     * @param  ExSimpleXmlElement $structure
     * @param  array              $params
     * @return bool               True on success false otherwise
     */
    public function import($structure, $params = array())
    {
        if ($structure === false) {
            fn_set_notification('E', __('error'), __('text_unable_to_parse_xml'));

            return false;
        }

        if (empty($structure->location)) {
            // We have no locations and cannot proceed
            return false;
        }

        $import_style = empty($params['import_style']) ? 'update' : $params['import_style'];
        $layout_data = empty($structure->layout) ? array() : (array) $structure->layout;
        unset($layout_data['layout_id'], $layout_data['company_id']);

        // FIXME: Backward compability
        if (empty($layout_data) && $import_style == 'create') {
            $layout_data = array(
                'name' => 'Main',
                'is_default' => 1,
                'width' => 16,
                'layout_width' => 'fixed',
                'min_width' => 760,
                'max_width' => 960,
                'style_id' => '',
            );
        }

        if ($import_style == 'create' && empty($layout_data)) {
            fn_set_notification('E', __('error'), __('text_unable_to_create_layout_empty_data'));

            return false;
        }

        if (!empty($layout_data['@attributes']['edition'])) {
            $allowed_editions = explode(',', $layout_data['@attributes']['edition']);

            if (!in_array(PRODUCT_EDITION, $allowed_editions)) {
                return false;
            }
        }

        if ($import_style == 'create') {
            $layout_data['theme_name'] = $this->theme_name;
            $layout_id = Layout::instance($this->_company_id)->update($layout_data);
            $this->layout_id = $layout_id;

        } elseif (!empty($layout_data)) {
            $layout_data['theme_name'] = $this->theme_name;
            $layout_id = Layout::instance($this->_company_id)->update($layout_data, $this->layout_id);

        } else {
            $layout_id = $this->layout_id;
        }

        if (!isset($params['override_by_dispatch'])) {
            $params['override_by_dispatch'] = 'Y';
        }

        $this->settings = (array) $structure->settings;

        if (!empty($params['clean_up']) && $params['clean_up'] == 'Y') {
            $location_ids = Location::instance($this->layout_id)->getList(array(), DESCR_SL);
            $location_ids = array_keys($location_ids);

            foreach ($location_ids as $location_id) {
                Location::instance($this->layout_id)->remove($location_id, true);
            }
        }

        if (empty($layout_data)) {
            if (!empty($this->_company_id) && !empty($layout_id)) {
                $layout_data = Layout::instance($this->_company_id)->get($layout_id);
            }
        }

        $layout_width = 16;
        if (!empty($layout_data['width'])) {
            $layout_width = $layout_data['width'];

        }

        /** @var ExSimpleXmlElement $location */
        foreach ($structure->location as $location) {
            // Create location first
            $location_attrs = $this->getNodeAttrs($location);
            if ($this->_company_id) {
                $location_attrs['company_id'] = $this->_company_id;
            }

            $this->setLayoutElementsWidth($layout_width, $location, $location_attrs);

            // Check if location already exists
            $_existing = array();
            $location_existing = false;
            if ($params['override_by_dispatch'] == 'Y') {
                $_existing = Location::instance($this->layout_id)->get($location_attrs['dispatch']);
                if (!empty($_existing)) {
                    $location_existing = ($_existing['dispatch'] == $location_attrs['dispatch']) ? true : false;
                }
            }

            // Imported locations cannot be assingned to dynamic objects
            $location_attrs['object_ids'] = '';

            $location_id = Location::instance($this->layout_id)->update($location_attrs);
            if (!empty($location_attrs['is_default'])) {
                Location::instance($this->layout_id)->setDefault($location_id);
            }

            if (!empty($location_existing)) {
                Location::instance($this->layout_id)->remove($_existing['location_id']);
            }

            $_default_containers = Container::getList(array(
                'location_id' => $location_id,
            ));

            /** @var ExSimpleXmlElement $container */
            foreach ($location->containers->container as $container) {
                $container_attrs = $this->getNodeAttrs($container);
                $container_attrs['location_id'] = $location_id;
                $container_attrs['container_id'] = $_default_containers[$container_attrs['position']]['container_id'];

                $this->setLayoutElementsWidth($layout_width, $container, $container_attrs);

                Container::update($container_attrs);
                $container_id = $container_attrs['container_id'];

                if (isset($container->grid)) {
                    $this->parseGridStructure($container, $container_id, $layout_width);
                }
            }

            if (!empty($location->translations)) {

                $avail_langs = array_keys(Languages::getAll());
                foreach ($location->translations->translation as $translation) {

                    $translation_lang_code = (string) $translation['lang_code'];
                    if (!in_array($translation_lang_code, $avail_langs)) {
                        continue;
                    }

                    $location_attrs = array (
                        'location_id' => $location_id,
                        'lang_code' => $translation_lang_code,
                        'meta_description' => (string) $translation->meta_description,
                        'meta_keywords' => (string) $translation->meta_keywords,
                        'title' => (string) $translation->page_title,
                        'name' => (string) $translation->name,
                    );

                    Location::instance($this->layout_id)->update($location_attrs);
                }
            }
        }

        return $layout_id;
    }

    /**
     * Export blocks to XML structure
     *
     * @param int    $layout_id    Exported layout identifier
     * @param int[]  $location_ids Exproted layout pages identifiers
     * @param array  $params       Export parameters
     * @param string $lang_code    Two-letter language code
     *
     * @return string Layout XML structure
     */
    public function export($layout_id, $location_ids = [], $params = [], $lang_code = DESCR_SL)
    {
        /* Exclude unnecessary fields*/
        $except_location_fields = [
            'location_id',
            'company_id',
        ];
        $except_container_fields = array(
            'container_id',
            'location_id',
            'dispatch',
            'is_default',
            'company_id',
            'default',
            'availability',
        );
        $except_grid_fields = [
            'container_id',
            'location_id',
            'position',
            'grid_id',
            'parent_id',
            'order',
            'children',
            'availability',
        ];
        $except_layout_fields = [
            'layout_id',
            'theme_name',
            'company_id',
        ];

        $except_location_fields = array_flip($except_location_fields);
        $except_container_fields = array_flip($except_container_fields);
        $except_grid_fields = array_flip($except_grid_fields);
        $except_layout_fields = array_flip($except_layout_fields);

        $layout_data = Layout::instance($this->_company_id)->get($layout_id);
        $layout_data = array_diff_key($layout_data, $except_layout_fields);

        $xml_root = new ExSimpleXmlElement('<block_scheme></block_scheme>');
        $xml_root->addAttribute('scheme', '1.0');

        $settings = $xml_root->addChild('settings');
        $settings->addChild('default_language', $lang_code);

        $layout_xml = $xml_root->addChild('layout');
        foreach ($layout_data as $field_name => $field_value) {
            $layout_xml->addChild($field_name, $field_value);
        }

        if (empty($location_ids)) {
            $location_ids = Location::instance($layout_id)->getList(array(), $lang_code);
            $location_ids = array_keys($location_ids);
        }

        foreach ($location_ids as $location_id) {
            $location = Location::instance($layout_id)->getById($location_id, $lang_code);
            $containers = Container::getList(array(
                'location_id' => $location_id,
            ));

            $xml_location = $xml_root->addChild('location');
            $location = array_diff_key($location, $except_location_fields);
            foreach ($location as $attr => $value) {
                $xml_location->addAttribute($attr, $value);
            }

            $xml_containers = $xml_location->addChild('containers');

            $xml_translations = $xml_location->addChild('translations');

            $translations = Location::instance($layout_id)->getAllDescriptions($location_id);
            foreach ($translations as $translation) {
                if ($translation['lang_code'] == $lang_code) {
                    // We do not needed default language
                    continue;
                }

                /** @var ExSimpleXmlElement $xml_translation */
                $xml_translation = $xml_translations->addChild('translation');
                $xml_translation->addChildCData('meta_keywords', $translation['meta_keywords']);
                $xml_translation->addChildCData('page_title', $translation['title']);
                $xml_translation->addChildCData('meta_description', $translation['meta_description']);
                $xml_translation->addChild('name', $translation['name']);
                $xml_translation->addAttribute('lang_code', $translation['lang_code']);
            }

            unset($xml_translations);

            foreach ($containers as $position => $container) {
                $grids = Grid::getList(array(
                    'container_ids' => $container['container_id'],
                ));

                /** @var ExSimpleXmlElement $xml_container */
                $xml_container = $xml_containers->addChild('container');
                $attrs =  array_diff_key($container, $except_container_fields);
                foreach ($attrs as $attr => $value) {
                    $xml_container->addAttribute($attr, $value);
                }

                if (!empty($grids) && isset($grids[$container['container_id']])) {
                    $grids = $grids[$container['container_id']];
                    $grids = fn_build_hierarchic_tree($grids, 'grid_id');

                    $this->buildGridStructure($xml_container, $grids, $except_grid_fields, $lang_code);
                }
            }
        }

        return $this->formatXml($xml_root);
    }

    /**
     * Formats output XML
     *
     * @param  ExSimpleXmlElement $xml simplexml object
     *
     * @return string formatted XML
     */
    protected function formatXml($xml)
    {
        // prettify xml output if DOM extension is exist
        if (function_exists('dom_import_simplexml')) {
            $dom = dom_import_simplexml($xml)->ownerDocument;
            $dom->formatOutput = true;
            $output = $dom->saveXML();
        } else {
            $output = $xml->asXML();
        }

        // Convert &#nnn entities to utf8 symbols
        return preg_replace_callback("/&#(\\d+);/u", function($matches) {
            $char = intval(is_array($matches) ? $matches[1] : $matches);
            if ($char < 0x80) {
                if ($char >= 0x20) {
                    return htmlspecialchars(chr($char));
                } else {
                    return "&#$char;";
                }
            } elseif ($char < 0x8000) {
                return chr(0xc0 | (0x1f & ($char >> 6))) . chr(0x80 | (0x3f & $char));
            } else {
                return chr(0xe0 | (0x0f & ($char >> 12))) . chr(0x80 | (0x3f & ($char >> 6))). chr(0x80 | (0x3f & $char));
            }
        }, $output);
    }

    public function getUniqueBlockKey($type, $properties, $name, $content = '')
    {
        $key = array(
            'type' => $type,
            'properties' => $properties,
            'name' => $name,
            'content' => $content,
        );

        if ($this->_company_id) {
            $key['company_id'] = $this->_company_id;
        }

        return md5(serialize($key));
    }

    /**
     * Get layout data
     *
     * @param  string $xml_filepath
     * @param  bool   $skip_edition_check
     *
     * @return array
     */
    public function getLayoutData($xml_filepath, $skip_edition_check = true)
    {
        $structure = $this->getStructure($xml_filepath);
        $layout_data = empty($structure->layout) ? array() : (array) $structure->layout;

        if (empty($skip_edition_check)) {
            if (!empty($layout_data['@attributes']['edition'])) {
                $allowed_editions = explode(',', $layout_data['@attributes']['edition']);

                if (!in_array(PRODUCT_EDITION, $allowed_editions)) {
                    $layout_data = array();
                }
            }
        }

        unset($layout_data['@attributes']);

        return $layout_data;
    }

    /**
     * Get layout file structure as simpleXML object
     *
     * @param string $xml_filepath

     * @return ExSimpleXmlElement|null
     */
    public function getStructure($xml_filepath)
    {
        $structure = null;

        if (file_exists($xml_filepath)) {
            $structure = @simplexml_load_file($xml_filepath, '\\Tygh\\ExSimpleXmlElement', LIBXML_NOCDATA);
        }

        return $structure;
    }

    /**
     * @param  ExSimpleXmlElement $xml_node
     * @param  bool               $use_attr_param
     * @return array|string
     */
    private function getNodeAttrs($xml_node, $use_attr_param = true)
    {
        $attrs = array();

        if ($use_attr_param) {
            foreach ($xml_node->attributes() as $attr => $value) {
                $attrs[$attr] = (string) $value;
            }
        } else {
            if ($xml_node->exCount() > 0) {
                /** @var ExSimpleXmlElement $child_node */
                foreach ($xml_node->children() as $child_node) {
                    if ($child_node->exCount() > 0) {
                        $attrs[$child_node->getName()] = $this->getNodeAttrs($child_node, false);
                    } else {
                        $attrs[$child_node->getName()] = (string) $child_node;
                    }
                }
            } else {
                $attrs = (string) $xml_node;
            }

            if (is_array($attrs) && empty($attrs)) {
                $attrs = '';
            }
        }

        return $attrs;
    }

    private function parseGridStructure(&$xml_node, $container_id, $layout_width, $parent_id = 0)
    {
        foreach ($xml_node->grid as $grid) {
            if (!empty($grid)) {
                $grid_attrs = $this->getNodeAttrs($grid);
                $grid_attrs['container_id'] = $container_id;
                $grid_attrs['parent_id'] = $parent_id;

                $this->setLayoutElementsWidth($layout_width, $grid, $grid_attrs);

                $grid_id = Grid::update($grid_attrs);

                if (isset($grid->grid)) {
                    $this->parseGridStructure($grid, $container_id, $layout_width, $grid_id);
                }

                if (!empty($grid->blocks)) {
                    $this->parseBlockStructure($grid_id, $grid->blocks);
                }
            }
        }
    }

    private function parseBlockStructure($grid_id, $blocks)
    {
        $unique_blocks = array();
        $langs = Languages::getAll();

        $_unique = Block::instance($this->_company_id)->getAllUnique();

        if (!empty($_unique)) {
            foreach ($_unique as $block_id => $block) {
                $key = $this->getUniqueBlockKey($block['type'], $block['properties'], $block['name']);

                $unique_blocks[$key] = $block_id;
            }
        }

        $order = 0;
        foreach ($blocks->block as $block) {
            $block_data = $this->getNodeAttrs($block, false);

            if (!isset($block_data['type'])) {
                continue;
            }

            if ($this->_company_id) {
                $block_data['company_id'] = $this->_company_id;
            }

            // FIXME
            $default_name = $block_data['name'];
            if (!empty($block->translations)) {
                foreach ($block->translations->translation as $translation) {
                    if ((string) $translation['lang_code'] == CART_LANGUAGE) {
                        $block_data['name'] = (string) $translation;
                    }
                }
            }

            $key = $this->getUniqueBlockKey($block_data['type'], $block_data['properties'], $block_data['name']);

            if (isset($unique_blocks[$key])) {
                $block_data['block_id'] = $unique_blocks[$key];
                $block_data['apply_to_all_langs'] = 'Y';
            }

            if (isset($block_data['content'])) {
                $block_data['content_data']['content'] = $block_data['content'];
            } else {
                $block_data['content_data']['content'] = array('empty');
            }

            $block_id = Block::instance($this->_company_id)->update($block_data, $block_data);

            $snapping_data = array(
                'block_id' => $block_id,
                'grid_id' => $grid_id,
                'wrapper' => isset($block_data['wrapper']) ? $block_data['wrapper'] : '',
                'user_class' => isset($block_data['user_class']) ? $block_data['user_class'] : '',
                'order' => isset($block_data['order']) ? $block_data['order'] : $order,
                'status' => !empty($block_data['status']) ? $block_data['status'] : 'A',
            );
            $snapping_id = Block::instance($this->_company_id)->updateSnapping($snapping_data);

            $this->importDynamicStatuses($snapping_id, $block_data);
            $this->importContent($block_id, $snapping_id, $block);

            if (!empty($block->translations)) {
                $_block_translation = array();
                if (!empty($this->settings['default_language'])) {
                    $_block_translation[$this->settings['default_language']] = $default_name;
                }

                foreach ($block->translations->translation as $translation) {
                    $lang_code = (string) $translation['lang_code'];
                    $_block_translation[$lang_code] = (string) $translation;
                }

                foreach ($_block_translation as $lang_code => $translation) {
                    if (isset($langs[$lang_code])) {
                        Block::instance($this->_company_id)->update(
                            array (
                                'block_id' => $block_id,
                            ),
                            array (
                                'name' => $translation,
                                'lang_code' => $lang_code,
                            )
                        );
                    }
                }
            }

            $order++;
        }
    }

    /**
     * Imports block statuses on dynamic obejcts
     *
     * @param  int   $snapping_id Snapping identifier
     * @param  array $block_data  Array of product data
     * @return bool  True on success, false otherwise
     */
    private function importDynamicStatuses($snapping_id, $block_data)
    {
        if (!empty($block_data['statuses']) && is_array($block_data['statuses'])) {
            foreach ($block_data['statuses'] as $object_type => $object_ids) {
                Block::instance($this->_company_id)->updateStatuses(
                    array(
                        'snapping_id' => $snapping_id,
                        'object_type' => $object_type,
                        'object_ids' => $object_ids,
                    )
                );
            }

            return true;
        } else {
            return false;
        }
    }

    private function importContent($block_id, $snapping_id, $block_data)
    {
        if (isset($block_data->contents)) {
            foreach ($block_data->contents->item as $content) {
                $_content = $this->getNodeAttrs($content, false);
                $_content['snapping_id'] = $snapping_id;

                $data = array (
                    'block_id' => $block_id,
                    'type' => (string) $block_data->type,
                    'content_data' => $_content,
                );

                if (!empty($_content['lang_code'])) {
                    $data['content_data']['lang_code'] = $_content['lang_code'];
                }

                Block::instance($this->_company_id)->update($data);
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * @param ExSimpleXmlElement $parent
     * @param array              $attrs
     */
    private function buildAttrStructure(&$parent, $attrs)
    {
        foreach ($attrs as $attr => $value) {
            // items_array is exploded by comma item_ids. So it's not needed.
            if (($attr == 0 && $value == 'empty') || $attr == 'items_array' || $attr == 'items_count') {
                // Skip empty values
                continue;
            }

            if (is_array($value)) {
                /** @var ExSimpleXmlElement $xml_attr */
                $xml_attr = $parent->addChild($attr);
                $this->buildAttrStructure($xml_attr, $value);

            } else {
                $child = $parent->addChild($attr);
                $node = dom_import_simplexml($child);
                $no = $node->ownerDocument;
                $node->appendChild($no->createCDATASection($value));
            }
        }
    }

    /**
     * @param ExSimpleXmlElement $parent
     * @param $grids
     * @param array  $except_fields
     * @param string $lang_code
     */
    private function buildGridStructure(&$parent, $grids, $except_fields = array(), $lang_code = DESCR_SL)
    {
        $except_block_fields = array_flip(array(
            'block_id',
            'snapping_id',
            'grid_id',
            'company_id',
        ));

        foreach ($grids as $grid) {
            /** @var ExSimpleXmlElement $xml_grid */
            $xml_grid = $parent->addChild('grid');
            $blocks = Block::instance($this->_company_id)->getList(array('?:bm_snapping.*', '?:bm_blocks.*'), array($grid['grid_id']));

            if (!empty($blocks)) {
                $blocks = $blocks[$grid['grid_id']];
            }

            $attrs =  array_diff_key($grid, $except_fields);
            foreach ($attrs as $attr => $value) {
                $xml_grid->addAttribute($attr, $value);
            }

            if (!empty($grid['children'])) {
                $grid['children'] = fn_sort_array_by_key($grid['children'], 'grid_id');
                $this->buildGridStructure($xml_grid, $grid['children'], $except_fields, $lang_code);
            }

            if (!empty($blocks)) {
                $xml_blocks = $xml_grid->addChild('blocks');

                foreach ($blocks as $block_id => $block) {
                    $block_descr = Block::instance($this->_company_id)->getFullDescription($block['block_id']);
                    $block = array_merge(Block::instance($this->_company_id)->getById($block['block_id'], 0, array(), $lang_code), $block);
                    $block = array_diff_key($block, $except_block_fields);

                    /** @var ExSimpleXmlElement $xml_block */
                    $xml_block = $xml_blocks->addChild('block');
                    $this->buildAttrStructure($xml_block, $block);

                    /** @var ExSimpleXmlElement $xml_translations */
                    $xml_translations = $xml_block->addChild('translations');
                    foreach ($block_descr as $_lang_code => $data) {
                        if ($_lang_code == $lang_code) {
                            // We do not needed default language
                            continue;
                        }

                        $xml_translation = $xml_translations->addChildCData('translation', $data['name']);
                        $xml_translation->addAttribute('lang_code', $_lang_code);
                        unset($xml_translation);
                    }

                    $contents = Block::instance($this->_company_id)->getAllContents($block_id);
                    /** @var ExSimpleXmlElement $xml_contents */
                    $xml_contents = $xml_block->addChild('contents');
                    foreach ($contents as $content) {
                        if (!empty($content['lang_code']) && $content['lang_code'] == $lang_code) {
                            continue;
                        }

                        if (!empty($content['content'])) {
                            $this->buildAttrStructure($xml_contents , array('item' => array_diff_key($content, $except_block_fields)));
                        }
                    }
                }
            }
        }
    }

    /**
     * Returns object instance of Exim class or create it if not exists
     *
     * @static
     *
     * @param int    $company_id Company identifier
     * @param int    $layout_id  Layout identifier
     * @param string $theme_name Theme name the layout belongs to
     *
     * @return Exim
     */
    public static function instance($company_id = 0, $layout_id = 0, $theme_name = '')
    {
        /** @var \Tygh\BlockManager\Exim $instance */
        $instance = parent::instance($company_id);

        if (empty($layout_id)) {
            $layout_id = Registry::get('runtime.layout.layout_id');
        }

        if (empty($theme_name)) {
            $theme_name = Registry::get('runtime.layout.theme_name');
        }

        $instance->layout_id = $layout_id;
        $instance->theme_name = $theme_name;

        return $instance;
    }

    /**
     * Replaces the width of the location, container, grid of the XML layout with the width of the layout itself
     *
     * The width of the location, container, grid is changed if it is larger than the width of the layout.
     * The function replaces the width of the layout element when the layout is created.
     *
     * @param  int                $layout_width The width of the created layout
     * @param  ExSimpleXmlElement $content      The XML structure of the layout element
     * @param  array              $attrs        The array of attributes of the layout element
     *
     * @return void
     */
    public function setLayoutElementsWidth($layout_width, &$content, &$attrs)
    {
        if (!empty($layout_width) && !empty($attrs['width'])) {
            $attrs_width = (int) $attrs['width'];

            if ($attrs_width > $layout_width || !empty($attrs['position'])) {
                $attrs['width'] = $layout_width;
                $content->attributes()->{'width'} = $layout_width;
            }
        }
    }
}
