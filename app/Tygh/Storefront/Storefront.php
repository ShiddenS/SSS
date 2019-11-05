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

/**
 * Class Storefront represents a separate storefront with the unique URL.
 * Each storefront displays a part of the whole catalogue.
 *
 * @package Tygh\Storefront
 */
class Storefront
{
    /**
     * Storefront URL
     *
     * @var string
     */
    public $url;

    /**
     * Storefront ID
     *
     * @var int
     */
    public $storefront_id;

    /**
     * @var bool
     */
    public $redirect_customer;

    /**
     * @var bool
     */
    public $is_default;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $access_key;

    /**
     * Vendors that are displayed on the storefront
     *
     * @var int[]
     */
    protected $company_ids;

    /**
     * Currencies that are displayed on the storefront
     *
     * @var int[]
     */
    protected $currency_ids;

    /**
     * Languages that are displayed on the storefront
     *
     * @var int[]
     */
    protected $language_ids;

    /**
     * @var string[]
     */
    protected $country_codes;

    /**
     * @var \Tygh\Storefront\DataLoader
     */
    protected $data_loader;

    /**
     * Storefront constructor.
     *
     * @param int                         $storefront_id
     * @param string                      $url
     * @param bool                        $is_default
     * @param bool                        $redirect_customer
     * @param string                      $status
     * @param string                      $access_key
     * @param \Tygh\Storefront\DataLoader $data_loader
     * @param string[]|null               $country_codes
     * @param int[]|null                  $company_ids
     * @param int[]|null                  $currency_ids
     * @param int[]|null                  $language_ids
     */
    public function __construct(
        $storefront_id,
        $url,
        $is_default,
        $redirect_customer,
        $status,
        $access_key,
        DataLoader $data_loader,
        $country_codes = null,
        $company_ids = null,
        $currency_ids = null,
        $language_ids = null
    ) {
        $this->storefront_id = $storefront_id;
        $this->url = $url;
        $this->data_loader = $data_loader;
        $this->is_default = $is_default;
        $this->redirect_customer = $redirect_customer;
        $this->status = $status;
        $this->access_key = $access_key;

        $this->country_codes = $country_codes;
        $this->company_ids = $company_ids;
        $this->currency_ids = $currency_ids;
        $this->language_ids = $language_ids;
    }

    /**
     * Gets vendors that are displayed on the storefront.
     *
     * @return int[]
     */
    public function getCompanyIds()
    {
        if ($this->company_ids === null) {
            $this->company_ids = $this->data_loader->getCompanyIds($this->storefront_id);
        }

        return $this->company_ids;
    }

    /**
     * Gets currencies that are displayed on the storefront.
     *
     * @return int[]
     */
    public function getCurrencyIds()
    {
        if ($this->currency_ids === null) {
            $this->currency_ids = $this->data_loader->getCurrencyIds($this->storefront_id);
        }

        return $this->currency_ids;
    }

    /**
     * Gets currencies that are displayed on the storefront.
     *
     * @return int[]
     */
    public function getLanguageIds()
    {
        if ($this->language_ids === null) {
            $this->language_ids = $this->data_loader->getLanguageIds($this->storefront_id);
        }

        return $this->language_ids;
    }

    /**
     * Gets countries the storefront is available at.
     *
     * @return string[]
     */
    public function getCountriesList()
    {
        $country_codes = $this->getCountryCodes();

        $countries_list = array_intersect_key(
            $this->data_loader->getCountriesList(),
            array_combine($country_codes, $country_codes)
        );

        return $countries_list;
    }

    /**
     * Gets country codes the storefront is available at.
     *
     * @return string[]
     */
    public function getCountryCodes()
    {
        if ($this->country_codes === null) {
            $this->country_codes = $this->data_loader->getCountryCodes($this->storefront_id);
        }

        return $this->country_codes;
    }

    public function toArray($get_id = true, $prefetch = false)
    {
        $storefront_data = [
            // entity fields
            'url'               => $this->url,
            'redirect_customer' => $this->redirect_customer,
            'is_default'        => $this->is_default,
            'status'            => $this->status,
            'access_key'        => $this->access_key,
            // lazy-loaded fields
            'company_ids'       => $prefetch ? $this->getCompanyIds() : $this->company_ids,
            'currency_ids'      => $prefetch ? $this->getCurrencyIds() : $this->currency_ids,
            'language_ids'      => $prefetch ? $this->getLanguageIds() : $this->language_ids,
            'country_codes'     => $prefetch ? $this->getCountryCodes() : $this->country_codes,
        ];

        if ($get_id) {
            $storefront_data['storefront_id'] = $this->storefront_id;
        }

        return $storefront_data;
    }

    /**
     * @param string[] $contry_codes
     */
    public function setCountryCodes($contry_codes)
    {
        $this->country_codes = $contry_codes;
    }

    /**
     * @param int[] $company_ids
     */
    public function setCompanyIds($company_ids)
    {
        $this->company_ids = $company_ids;
    }

    /**
     * @param int[] $language_ids
     */
    public function setLanguageIds($language_ids)
    {
        $this->language_ids = $language_ids;
    }

    /**
     * @param int[] $currency_ids
     */
    public function setCurrencyIds($currency_ids)
    {
        $this->currency_ids = $currency_ids;
    }
}
