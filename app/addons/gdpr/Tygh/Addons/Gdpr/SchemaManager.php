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

namespace Tygh\Addons\Gdpr;

/**
 * Provides methods to work with GDPR schema
 *
 * @package Tygh\Addons\Gdpr
 */
class SchemaManager
{
    /** @var array $schemas Cached schemas array */
    protected $schemas = array();

    /**
     * @inheritdoc
     */
    public function getSchema($name)
    {
        if (!isset($this->schemas[$name])) {
            $this->schemas[$name] = fn_get_schema('gdpr', $name);
        }

        return (array) $this->schemas[$name];
    }
}


