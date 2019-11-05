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

namespace Tygh\Languages;

class Po
{
    /**
     * Gets meta information from the PO file
     *
     * @param  string       $filename Path to PO file
     * @return array|string List of lang pack meta information or string with error
     */
    public static function getMeta($filename)
    {
        $poparser = new \I18n_Pofile();
        $lang_data = $poparser->read($filename, true);

        if (is_array($lang_data) && isset($lang_data['']['msgstr'])) {
            $po_file_metadata = self::readMetaProperties($lang_data['']['msgstr']);
            $po_file_metadata['pack_file'] = basename($filename);

            // Workaround for crowdin-generated translation
            if (!empty($po_file_metadata['language_team']) &&
                !empty($po_file_metadata['language'])
            ) {
                $po_file_metadata['name'] = $po_file_metadata['language_team'];

                // This line fixes incorrect header in po, returned from crowdin. Should be removed after they fix this
                list($po_file_metadata['language']) = explode("\n", $po_file_metadata['language']);

                if (strpos($po_file_metadata['language'], '_') !== false) {
                    list($po_file_metadata['lang_code'], $po_file_metadata['country_code']) = explode('_', $po_file_metadata['language']);
                }
            }

            $_d = $poparser->read($filename, false, 'LanguageName');
            if (!empty($_d['LanguageName']['msgstr']) && is_array($_d['LanguageName']['msgstr'])) {
                $po_file_metadata['name'] = reset($_d['LanguageName']['msgstr']);
            }
        } else {
            // Return string with error description
            $po_file_metadata = $lang_data;
        }

        return $po_file_metadata;
    }

    /**
     * Explodes meta data by variables
     * Example:
     *  array(
     *      'Pack-Name: English',
     *      'Lang-Code: EN',
     *      'Country-Code: US'
     *  )
     *
     * @param array $metadata_properties list of meta data
     *
     * @return array Exploded properties
     *  Example:
     *   array(
     *      'name' => 'english',
     *      'lang_code' => 'en',
     *      'country_code' => 'us',
     *   )
     */
    public static function readMetaProperties($metadata_properties)
    {
        $return = array();

        foreach ($metadata_properties as $property) {
            if (!empty($property) && (strpos($property, ':') !== false)) {
                list($name, $value) = explode(':', $property);
                $name = strtolower(str_replace('-', '_', trim($name)));

                $return[$name] = trim($value);
            }
        }

        return $return;
    }

    /**
     * Gets values from PO file
     *
     * @param  string $filename Path to PO file
     * @param  string $section  Section to get values for. If section is not specified, all available values will be returned
     * @return mixed  array with values or string with error
     */
    public static function getValues($filename, $section = '')
    {
        $poparser = new \I18n_Pofile();

        $values = $poparser->read($filename, false, $section);
        if (is_array($values)) {
            foreach ($values as $key => $data) {
                // $context = explode(\I18n_Pofile::DELIMITER, $key, 2); // old format with
                $context = explode(\I18n_Pofile::DELIMITER, $key);
                $id = $parent = $section = '';
                if (sizeof($context) == 2) {
                    list(, $id) = $context;
                } elseif (sizeof($context) == 3) {
                    list(, $parent, $id) = $context;
                } elseif (sizeof($context) == 4) {
                    list(, $section, $parent, $id) = $context;
                }
                $values[$key]['id'] = $id;
                $values[$key]['parent'] = $parent;
                $values[$key]['section'] = $section;
            }
        }

        return $values;
    }

    /**
     * Puts values to PO file
     *
     * @param string $section  section to put values for
     * @param array  $values   values
     * @param string $filename file name to put values to
     */
    public static function putValues($section, $values, $filename)
    {
        $output = array();

        $var_output = '';
        foreach ($values as $id => $value) {
            $output[$id] = array(
                'msgctxt' => $section . \I18n_Pofile::DELIMITER . $value['msgctxt'],
                'msgid' => self::filter($value['msgid']),
                'msgstr' => self::filter($value['msgstr']),
            );

            $var_output .= "\n";
            $var_output .= 'msgctxt "' . $output[$id]['msgctxt'] . "\"\n";
            $var_output .= 'msgid "' . $output[$id]['msgid'] . "\"\n";
            $var_output .= 'msgstr "' . $output[$id]['msgstr'] . '"' . "\n";
        }

        fn_put_contents($filename, $var_output, '', DEFAULT_FILE_PERMISSIONS, true);

        return $output;
    }

    /**
     * Creates PO file header
     * @param string $filename PO file name
     * @param array  $lang     language information
     */
    public static function createHeader($filename, $lang)
    {
        $head = <<<HEAD
msgid ""
msgstr "Project-Id-Version: tygh\\n"
"Content-Type: text/plain; charset=UTF-8\\n"
"Language-Team: $lang[name]\\n"
"Language: $lang[lang_code]_$lang[country_code]"\n
HEAD;

        fn_put_contents($filename, $head);
    }

    /**
     * Removes new lines symbols and escapes quotes
     *
     * @param  string $value String to be escaped
     * @return string Escaped string
     */
    private static function filter($value)
    {
        $value = str_replace('"', '\"', $value);
        $value = str_replace(array("\r\n", "\n", "\r"), '', $value);

        return trim($value);
    }

    /**
     * Converts data array to use with putValues method
     * @param  array $array         original data array
     * @param  array $map           key map
     * @param  bool  $allow_overlap allow variables with identical msgid and msgstr
     * @return array converted array
     */
    public static function convert($array, $map = array(), $allow_overlap = false)
    {
        $result = array();

        foreach ($array as $k => $v) {
            $msgid = $v[isset($map['original']) ? $map['original'] : 'original_value'];
            $msgstr = $v[isset($map['value']) ? $map['value'] : 'value'];

            if (empty($msgid)) { // do not store empty translations
                continue;
            }

            // Avoid overlap when original is equal to translation
            if (!$allow_overlap && $msgid == $msgstr) {
                $msgstr = '';
            }

            $result[] = array(
                'msgstr' => $msgstr,
                'msgid' => $msgid,
                'msgctxt' => isset($map['id']) ? ($map['id'] == '%key' ? $k : $v[$map['id']]) : $v['name']
            );
        }

        return $result;
    }
}
