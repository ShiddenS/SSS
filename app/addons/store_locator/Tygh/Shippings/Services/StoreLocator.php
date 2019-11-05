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

namespace Tygh\Shippings\Services;

use Tygh\Shippings\IService;
use Tygh\Shippings\IPickupService;
use Tygh\Shippings\Shippings;
use Tygh\Registry;
use Tygh\Tygh;

class StoreLocator implements IService, IPickupService
{
    /**
     * Availability multithreading in this module
     *
     * @var bool $_allow_multithreading
     */
    private $allow_multithreading = false;

    /**
     * @var array $shipping_info Shipping information
     */
    private $shipping_info;

    /**
     * Current Company id environment
     *
     * @var int $company_id
     */
    public $company_id = 0;

    /**
     * Checks if shipping service allows to use multithreading
     *
     * @return bool true if allow
     */
    public function allowMultithreading()
    {
        return $this->allow_multithreading;
    }

    public function processErrors($response) {}

    /**
     * Sets data to internal class variable
     *
     * @param  array $shipping_info
     *
     * @return array|void
     */
    public function prepareData($shipping_info)
    {
        $this->shipping_info = $shipping_info;
        $this->company_id = Registry::get('runtime.company_id');
    }

    /**
     * Prepare request information
     *
     * @return array Prepared data
     */
    public function getRequestData()
    {
        return [];
    }

    /**
     * Process simple request to shipping service server
     *
     * @return string Server response
     */
    public function getSimpleRates()
    {
        return fn_get_shipping_destinations($this->shipping_info['shipping_id'], $this->shipping_info, CART_LANGUAGE);
    }

    /**
     * Gets shipping cost and information about possible errors
     *
     * @param array $destination_rates Shipping rates
     *
     * @return array Shipping cost and errors
     */
    public function processResponse($destination_rates)
    {
        $result = [
            'cost'           => false,
            'error'          => false,
            'delivery_time'  => false,
            'destination_id' => false,
        ];

        $location = $this->shipping_info['package_info']['location'];
        $destination_id = fn_get_available_destination($location);
        if (empty($destination_id)) {
            $result['error'] = __('destination_nothing_found');
            return $result;
        }

        $active_stores = $this->getActiveStores($destination_id);
        if (empty($active_stores)) {
            $result['error'] = __('stores_nothing_found');
            return $result;
        }

        $available_stores = $this->extractAvailableStores($destination_rates, $active_stores);
        if (empty($available_stores)) {
            $result['error'] = __('stores_sort_nothing_found');
            return $result;
        }

        if (!empty($available_stores)) {
            $result['cost'] = 0; // zero for now, manual rate amount will be added later
            $this->saveStoresToSession($available_stores);
        }

        $selected_store = $this->findSelectedStore($available_stores);
        if ($selected_store) {
            $result['destination_id'] = $selected_store['main_destination_id'];
            $result['delivery_time'] = $selected_store['delivery_time'];
        } elseif ($available_stores) {
            $available_store = reset($available_stores);
            $result['destination_id'] = $available_store['main_destination_id'];
        }

        if (empty($result['destination_id']) && !empty($this->shipping_info['rate_info']['destination_id'])) {
            $result['destination_id'] = $this->shipping_info['rate_info']['destination_id'];
        }

        return $result;
    }

    /**
     * Fetches active stores
     *
     * @param int $destination_id Destination identifiers
     *
     * @return array
     */
    protected function getActiveStores($destination_id)
    {
        $fields['all'] = '*';
        $joins['store_location_descriptions'] = db_quote('LEFT JOIN ?:store_location_descriptions as descriptions ON locations.store_location_id = descriptions.store_location_id');
        $conditions['status'] = db_quote('locations.status = ?s AND descriptions.lang_code = ?s', 'A', CART_LANGUAGE);
        $conditions['destination_ids'] = db_quote('(?p)', fn_find_array_in_set([$destination_id], 'locations.pickup_destinations_ids', true));
        $conditions['main_destination_id'] = db_quote('main_destination_id IS NOT NULL');

        /**
         * Executes before fetching available stores list for shipping
         *
         * @param int   $destination_id Destination identifier
         * @param array $fields         Fields to select
         * @param array $joins          Tables to join
         * @param array $conditions     Query conditions
         */
        fn_set_hook('get_store_locations_for_shipping_before_select', $destination_id, $fields, $joins, $conditions);

        $active_stores = db_get_hash_array(
            'SELECT ?p FROM ?:store_locations as locations ?p WHERE 1=1 AND ?p',
            'store_location_id',
            implode(', ', $fields),
            implode(' ', $joins),
            implode(' AND ', $conditions)
        );

        return $active_stores;
    }

    /**
     * Extracts stores that are available for shipping method
     *
     * @param array $destination_rates Shipping rates
     * @param array $active_stores     Active stores
     *
     * @return array
     */
    protected function extractAvailableStores($destination_rates, array $active_stores)
    {
        $service_params = $this->shipping_info['service_params'];
        $no_stores_restrictions_set = empty($service_params['active_stores']);
        if ($no_stores_restrictions_set) {
            return $active_stores;
        }

        $available_stores = [];
        foreach ($service_params['active_stores'] as $position => $store_id) {
            if (!isset($active_stores[$store_id])) {
                continue;
            }

            $store = $active_stores[$store_id];
            $destination_id = $store['main_destination_id'];
            $manual_rate = Shippings::getRateByDestination($this->shipping_info, (int) $destination_id);

            $cannot_pickup_from_store = $manual_rate === false;
            if ($cannot_pickup_from_store) {
                continue;
            }

            $store['pickup_rate'] = $manual_rate;
            $store['shipping_position'] = $position;
            $store['delivery_time'] = $this->shipping_info['delivery_time'];
            if (!empty($destination_rates[$destination_id]['delivery_time'])) {
                $store['delivery_time'] = $destination_rates[$destination_id]['delivery_time'];
            }

            $available_stores[$store_id] = $store;
        }

        $sorting = !empty($service_params['sorting']) ? $service_params['sorting'] : 'shipping_position';
        $available_stores = fn_sort_array_by_key($available_stores, $sorting);

        return $available_stores;
    }

    /**
     * Saves store to session
     *
     * @param array $stores Stores available for shipping method
     *
     * @return $this
     */
    private function saveStoresToSession($stores)
    {
        list($group_key, $shipping_id) = $this->getShippingIdentifiers();
        Tygh::$app['session']['cart']['shippings_extra']['data'][$group_key][$shipping_id]['stores'] = $stores;
        return $this;
    }

    /**
     * Fetches stored stores from session
     *
     * @return array
     */
    private function getStoresFromSession()
    {
        list($group_key, $shipping_id) = $this->getShippingIdentifiers();
        if (empty(Tygh::$app['session']['cart']['shippings_extra']['data'][$group_key][$shipping_id]['stores'])) {
            return [];
        }

        return Tygh::$app['session']['cart']['shippings_extra']['data'][$group_key][$shipping_id]['stores'];
    }

    /**
     * Fetches selected store from session
     *
     * @param array $stores Available stores
     *
     * @return bool
     */
    protected function findSelectedStore($stores)
    {
        $store = [];
        if (!empty(Tygh::$app['session']['cart']['select_store'])) {
            $selected_store = Tygh::$app['session']['cart']['select_store'];
            list($group_key, $shipping_id) = $this->getShippingIdentifiers();
            $store_id = !empty($selected_store[$group_key][$shipping_id])
                ? $selected_store[$group_key][$shipping_id]
                : false;

            if ($store_id && isset($stores[$store_id])) {
                $store = $stores[$store_id];
            }
        }

        return $store;
    }

    protected function getShippingIdentifiers()
    {
        return [
            isset($this->shipping_info['keys']['group_key']) ? $this->shipping_info['keys']['group_key'] : null,
            isset($this->shipping_info['keys']['shipping_id']) ? $this->shipping_info['keys']['shipping_id'] : null,
        ];
    }

    public function prepareAddress($address) {}

    /**
     * Returns shipping service information
     *
     * @return array information
     */
    public static function getInfo()
    {
        return array(
            'name'         => __('carrier_store_locator'),
            'tracking_url' => '#',
        );
    }

    /**
     * @inheritdoc
     */
    public function getPickupMinCost()
    {
        $stores = $this->getStoresFromSession();
        $min_cost = null;
        foreach ($stores as $store) {
            $pickup_rate = isset($store['pickup_rate']) ? $store['pickup_rate'] : null;
            $min_cost = $min_cost == null || $min_cost > $pickup_rate ? $pickup_rate : $min_cost;
        }

        return $min_cost;
    }

    /**
     * @inheritdoc
     */
    public function getPickupPoints()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getPickupPointsQuantity()
    {
        $stores = $this->getStoresFromSession();
        return count($stores) ?: false;
    }
}
