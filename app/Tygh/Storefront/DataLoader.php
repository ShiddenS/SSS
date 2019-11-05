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

namespace Tygh\Storefront;

use Tygh\Database\Connection;

/**
 * Class DataLoader provides lazy-loading functionality for Storefronts.
 *
 * @package Tygh\Storefront
 */
class DataLoader
{
    /**
     * @var \Tygh\Database\Connection
     */
    protected $db;

    /**
     * @var array
     */
    protected $countries_list;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Gets countries that are directly linked to the storefront.
     *
     * @param int $storefront_id
     *
     * @return string[]
     */
    public function getCountryCodes($storefront_id)
    {
        $country_codes = $this->db->getColumn(
            'SELECT country_code FROM ?:storefronts_countries WHERE storefront_id = ?i',
            $storefront_id
        );

        return $country_codes;
    }

    /**
     * Gets companies that are directly linked to the storefront.
     *
     * @param int $storefront_id
     *
     * @return int[]
     */
    public function getCompanyIds($storefront_id)
    {
        $company_ids = $this->db->getColumn(
            'SELECT company_id FROM ?:storefronts_companies WHERE storefront_id = ?i',
            $storefront_id
        );

        return $company_ids;
    }

    /**
     * Gets currencies that are directly linked to the storefront.
     *
     * @param int $storefront_id
     *
     * @return int[]
     */
    public function getCurrencyIds($storefront_id)
    {
        $currency_ids = $this->db->getColumn(
            'SELECT currency_id FROM ?:storefronts_currencies WHERE storefront_id = ?i',
            $storefront_id
        );

        return $currency_ids;
    }

    /**
     * Gets languages that are directly linked to the storefront.
     *
     * @param int $storefront_id
     *
     * @return int[]
     */
    public function getLanguageIds($storefront_id)
    {
        $language_ids = $this->db->getColumn(
            'SELECT language_id FROM ?:storefronts_languages WHERE storefront_id = ?i',
            $storefront_id
        );

        return $language_ids;
    }

    /**
     * Gets all countries that are present in a store.
     *
     * @return array
     */
    public function getCountriesList()
    {
        if ($this->countries_list === null) {
            $this->countries_list = fn_get_simple_countries();
        }

        return $this->countries_list;
    }
}
