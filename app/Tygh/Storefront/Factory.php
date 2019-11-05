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
use Tygh\Enum\StorefrontStatuses;
use Tygh\Enum\YesNo;

/**
 * Class Factory creates Storefronts.
 *
 * @package Tygh\Storefront
 */
class Factory
{
    /**
     * @var \Tygh\Database\Connection
     */
    protected $db;

    /**
     * @var \Tygh\Storefront\DataLoader
     */
    protected $data_loader;

    /**
     * @var \Tygh\Storefront\Normalizer
     */
    protected $normalizer;

    public function __construct(Connection $db, DataLoader $data_loader, Normalizer $normalizer)
    {
        $this->db = $db;
        $this->data_loader = $data_loader;
        $this->normalizer = $normalizer;
    }

    /**
     * Creates a storefront from an array.
     *
     * @param array $data Storefront data
     *
     * @return \Tygh\Storefront\Storefront
     */
    public function fromArray(array $data)
    {
        $data = array_merge([
            'storefront_id'     => 0,
            'url'               => '',
            'is_default'        => false,
            'redirect_customer' => false,
            'status'            => StorefrontStatuses::OPEN,
            'access_key'        => '',
            'country_codes'     => null,
            'company_ids'       => null,
            'currency_ids'      => null,
            'language_ids'      => null,
        ], $data);

        $redirect_customer = YesNo::toBool($data['redirect_customer']);
        $is_default = YesNo::toBool($data['is_default']);

        $data = $this->normalizer->normalizeStorefrontData($data);

        $storefront = new Storefront(
            $data['storefront_id'],
            $data['url'],
            $is_default,
            $redirect_customer,
            $data['status'],
            $data['access_key'],
            $this->data_loader,
            $data['country_codes'],
            $data['company_ids'],
            $data['currency_ids'],
            $data['language_ids']
        );

        return $storefront;
    }

    /**
     * Creates a blank storefront to fill it with data.
     *
     * @return \Tygh\Storefront\Storefront
     */
    public function getBlank()
    {
        return new Storefront(
            0,
            '',
            false,
            false,
            StorefrontStatuses::OPEN,
            '',
            $this->data_loader
        );
    }
}
