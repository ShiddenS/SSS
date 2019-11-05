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

use Tygh\Common\OperationResult;
use Tygh\Database\Connection;
use Tygh\Enum\YesNo;

/**
 * Class Repository fetches, saves and removes Storefronts.
 *
 * @package Tygh\Storefront
 */
class Repository
{
    /**
     * @var \Tygh\Database\Connection
     */
    protected $db;

    /**
     * @var \Tygh\Storefront\Factory
     */
    protected $factory;

    /**
     * @var \Tygh\Storefront\Normalizer
     */
    protected $normalizer;

    public function __construct(
        Connection $db,
        Factory $factory,
        Normalizer $normalizer
    ) {
        $this->db = $db;
        $this->factory = $factory;
        $this->normalizer = $normalizer;
    }

    /**
     * Gets storefront by its URL.
     *
     * @param string $url URL (host + path)
     *
     * @return \Tygh\Storefront\Storefront|null
     */
    public function findByUrl($url)
    {
        if (parse_url($url, PHP_URL_SCHEME) === null) {
            $url = '//' . $url;
        }

        $host = parse_url($url, PHP_URL_HOST);
        $host_without_www = preg_replace('/^www\d*\./', '', $host);
        $path = trim(parse_url($url, PHP_URL_PATH) ?: '', '/');

        list($storefronts_by_host,) = $this->find([
            'host'       => $host_without_www,
            'sort_by'    => 'host',
            'sort_order' => 'desc',
        ]);

        if (count($storefronts_by_host) === 1) {
            $storefront = reset($storefronts_by_host);

            return $storefront;
        }

        $storefront = $this->findClosestMatchingByPath($path, $storefronts_by_host);

        return $storefront;
    }

    /**
     * Gets storefront by its ID.
     *
     * @param int $storefront_id
     *
     * @return \Tygh\Storefront\Storefront|null
     */
    public function findById($storefront_id)
    {
        list($storefronts,) = $this->find(['storefront_id' => $storefront_id]);

        $storefront = reset($storefronts);

        return $storefront;
    }

    /**
     * Gets default storefront.
     *
     * @return \Tygh\Storefront\Storefront|null
     */
    public function findDefault()
    {
        list($storefronts,) = $this->find(['is_default' => true]);

        $storefront = reset($storefronts);

        return $storefront;
    }

    /**
     * Gets storefronts with a specific company assigned to.
     *
     * @param int  $company_id
     * @param bool $get_single
     *
     * @return \Tygh\Storefront\Storefront[]|\Tygh\Storefront\Storefront
     */
    public function findByCompanyId($company_id, $get_single = true)
    {
        list($storefronts,) = $this->find(['company_ids' => [$company_id]]);

        if ($get_single) {
            $storefront = reset($storefronts);

            return $storefront;
        }

        return $storefronts;
    }

    /**
     * Finds the most suitable storefront by its path.
     *
     * @param string                        $path        Requested path
     * @param \Tygh\Storefront\Storefront[] $storefronts Storefronts to search in
     *
     * @return \Tygh\Storefront\Storefront|null
     */
    public function findClosestMatchingByPath($path, array $storefronts)
    {
        $path_parts = explode('/', trim($path, '/'));

        $matching_storefront = null;
        $max_path_match = 0;
        foreach ($storefronts as $storefront) {
            $storefront_path = trim(parse_url('//' . $storefront->url, PHP_URL_PATH) ?: '', '/');
            $storefront_path_parts = explode('/', $storefront_path);

            if (!$storefront_path && !$matching_storefront) {
                $matching_storefront = $storefront;
                continue;
            }

            $matching_path_parts = array_intersect_assoc($storefront_path_parts, $path_parts);

            if (count($matching_path_parts) > $max_path_match) {
                $max_path_match = count($matching_path_parts);
                $matching_storefront = $storefront;
            }
        }

        return $matching_storefront;
    }

    /**
     * Searches storefronts by the specified params.
     *
     * @param array $params         Search parameters
     * @param int   $items_per_page Amount of items per page
     *
     * @return array Contains found storefronts and search parameters
     */
    public function find(array $params = [], $items_per_page = 0)
    {
        $params = $this->populateDefaultFindParameters($params);

        $fields = [
            '' => 'storefronts.*',
        ];
        $join = $this->buildJoins($params);
        $conditions = $this->buildConditions($params);
        $order_by = $this->buildOrderBy($params);
        $group_by = $this->buildGroupBy($params);
        $having = [];
        $limit = $this->buildLimit($params, $items_per_page);

        /**
         * Executes when searching storefronts before the query is executed,
         * allows you to modify SQL query parts.
         *
         * @param array    $params         Search parameters
         * @param int      $items_per_page Amount of items per page
         * @param string[] $fields         Fields to fetch
         * @param string[] $join           JOIN parts of the query
         * @param string[] $conditions     WHERE parts of the query
         * @param string   $group_by       GROUP BY part of the query
         * @param string[] $having         HAVING parts of the query
         * @param string   $order_by       ORDER BY part of the query
         * @param string   $limit          LIMIT part of the query
         */
        fn_set_hook(
            'storefront_repository_find',
            $params,
            $items_per_page,
            $fields,
            $join,
            $conditions,
            $group_by,
            $having,
            $order_by,
            $limit
        );

        $storefronts = $this->db->getHash(
            'SELECT ?p FROM ?:storefronts AS storefronts ?p WHERE ?p ?p ?p ?p ?p',
            'storefront_id',
            implode(',', $fields),
            implode(' ', $join),
            implode(' ', $conditions),
            $group_by ? 'GROUP BY ' . $group_by : '',
            $having ? 'HAVING ' . implode(' ', $having) : '',
            $order_by,
            $limit
        );

        foreach ($storefronts as &$storefront) {
            $storefront = $this->factory->fromArray($storefront);
        }
        unset($storefront);

        $params['total_items'] = $this->getCount($params);

        return [$storefronts, $params];
    }

    /**
     * Counts amount of storefronts that match criteria.
     *
     * @param array $params Search parameters
     *
     * @return int
     */
    public function getCount(array $params = [])
    {
        $params = $this->populateDefaultFindParameters($params);

        $fields = [
            '' => 'COUNT(*)',
        ];
        $join = $this->buildJoins($params);
        $conditions = $this->buildConditions($params);

        /**
         * Executes when counting storefronts before the query is executed,
         * allows you to modify SQL query parts.
         *
         * @param array    $params         Search parameters
         * @param string[] $fields         Fields to fetch
         * @param string[] $join           JOIN parts of the query
         * @param string[] $conditions     WHERE parts of the query
         */
        fn_set_hook(
            'storefront_repository_get_count',
            $params,
            $fields,
            $join,
            $conditions
        );

        $count = (int) $this->db->getField(
            'SELECT ?p FROM ?:storefronts AS storefronts ?p WHERE ?p',
            implode(',', $fields),
            implode(' ', $join),
            implode(' ', $conditions)
        );

        return $count;
    }

    /**
     * Updates or creates a storefront.
     *
     * @param \Tygh\Storefront\Storefront $storefront
     *
     * @return \Tygh\Common\OperationResult
     */
    public function save(Storefront $storefront)
    {
        $validation_result = $this->validateBeforeSave($storefront);
        if (!$validation_result->isSuccess()) {
            return $validation_result;
        }

        $save_result = new OperationResult(true);

        $storefront_data = $storefront->toArray(false);
        $storefront_data = $this->normalizeDataBeforeSave($storefront_data);

        $storefront_id = $this->updateStorefront($storefront->storefront_id, $storefront_data);

        if (isset($storefront_data['country_codes'])) {
            $this->updateCountries($storefront_id, $storefront_data['country_codes']);
        }

        if (isset($storefront_data['language_ids'])) {
            $this->updateLanguages($storefront_id, $storefront_data['language_ids']);
        }

        if (isset($storefront_data['currency_ids'])) {
            $this->updateCurrencies($storefront_id, $storefront_data['currency_ids']);
        }

        if (isset($storefront_data['company_ids'])) {
            $this->updateCompanies($storefront_id, $storefront_data['company_ids']);
        }

        if ($storefront->is_default) {
            $this->undefaultOherStorefronts($storefront_id);
        }

        $save_result->setData($storefront_id);

        /**
         * Executes when saving storefront, allows to perform additional actions
         *
         * @param \Tygh\Storefront\Storefront  $storefront  storefront
         * @param \Tygh\Common\OperationResult $save_result result of the save process
         */
        fn_set_hook(
            'storefront_repository_save_post',
            $storefront,
            $save_result
        );

        return $save_result;
    }

    /**
     * Deletes a storefront.
     *
     * @param \Tygh\Storefront\Storefront $storefront
     *
     * @return \Tygh\Common\OperationResult
     */
    public function delete(Storefront $storefront)
    {
        $operation_result = new OperationResult(true);

        $this->deleteCountries($storefront->storefront_id);
        $this->deleteLanguages($storefront->storefront_id);
        $this->deleteCompanies($storefront->storefront_id);
        $this->deleteCurrencies($storefront->storefront_id);
        $this->deleteStorefront($storefront->storefront_id);

        /**
         * Executes when deleting storefront, allows you to clear additional storefront data
         *
         * @param \Tygh\Storefront\Storefront  $storefront       storefront for remove
         * @param \Tygh\Common\OperationResult $operation_result result of the storefront removal process
         */
        fn_set_hook(
            'storefront_repository_delete_post',
            $storefront,
            $operation_result
        );

        return $operation_result;
    }

    /**
     * Updates storefront itself.
     *
     * @param int   $storefront_id
     * @param array $storefront_data
     *
     * @return int Updated storefront ID or created storefront ID
     */
    protected function updateStorefront($storefront_id, array $storefront_data)
    {
        if ($storefront_id) {
            $storefront_data['storefront_id'] = $storefront_id;
        }

        $this->db->replaceInto('storefronts', $storefront_data);
        if (!$storefront_id) {
            $storefront_id = $this->db->getInsertId();
        }

        return $storefront_id;
    }

    /**
     * Stores country codes a storefront is assigned to.
     *
     * @param int      $storefront_id
     * @param string[] $country_codes ISO-3166-1 country codes
     */
    protected function updateCountries($storefront_id, array $country_codes)
    {
        $this->deleteCountries($storefront_id);

        if (!$country_codes) {
            return;
        }

        $storefronts_countries = array_map(function ($country_code) use ($storefront_id) {
            return [
                'storefront_id' => $storefront_id,
                'country_code'  => $country_code,
            ];
        }, $country_codes);

        $this->db->query('INSERT INTO ?:storefronts_countries ?m', $storefronts_countries);
    }

    /**
     * Stores languages assigned to a storefront.
     *
     * @param int   $storefront_id
     * @param int[] $language_ids
     */
    protected function updateLanguages($storefront_id, $language_ids)
    {
        $this->deleteLanguages($storefront_id);

        if (!$language_ids) {
            return;
        }

        $storefronts_languages = array_map(function ($language_id) use ($storefront_id) {
            return [
                'storefront_id' => $storefront_id,
                'language_id'   => $language_id,
            ];
        }, $language_ids);

        $this->db->query('INSERT INTO ?:storefronts_languages ?m', $storefronts_languages);
    }

    /**
     * Stores currencies assigned to a storefront.
     *
     * @param int   $storefront_id
     * @param int[] $currency_ids
     */
    protected function updateCurrencies($storefront_id, $currency_ids)
    {
        $this->deleteCurrencies($storefront_id);

        if (!$currency_ids) {
            return;
        }

        $storefronts_currencies = array_map(function ($currency_id) use ($storefront_id) {
            return [
                'storefront_id' => $storefront_id,
                'currency_id'   => $currency_id,
            ];
        }, $currency_ids);

        $this->db->query('INSERT INTO ?:storefronts_currencies ?m', $storefronts_currencies);
    }

    /**
     * Stores companies assigned to a storefront.
     *
     * @param int   $storefront_id
     * @param int[] $company_ids
     */
    protected function updateCompanies($storefront_id, $company_ids)
    {
        $this->deleteCompanies($storefront_id);

        if (!$company_ids) {
            return;
        }

        $storefronts_companies = array_map(function ($company_id) use ($storefront_id) {
            return [
                'storefront_id' => $storefront_id,
                'company_id'    => $company_id,
            ];
        }, $company_ids);

        $this->db->query('INSERT INTO ?:storefronts_companies ?m', $storefronts_companies);
    }

    /**
     * Deletes storefront's counties.
     *
     * @param int $storefront_id
     */
    protected function deleteCountries($storefront_id)
    {
        $this->db->query('DELETE FROM ?:storefronts_countries WHERE storefront_id = ?i', $storefront_id);
    }

    /**
     * Deletes storefront's languages.
     *
     * @param int $storefront_id
     */
    protected function deleteLanguages($storefront_id)
    {
        $this->db->query('DELETE FROM ?:storefronts_languages WHERE storefront_id = ?i', $storefront_id);
    }

    /**
     * Deletes storefront's currencies.
     *
     * @param int $storefront_id
     */
    protected function deleteCurrencies($storefront_id)
    {
        $this->db->query('DELETE FROM ?:storefronts_currencies WHERE storefront_id = ?i', $storefront_id);
    }

    /**
     * Deletes storefront's companies.
     *
     * @param int $storefront_id
     */
    protected function deleteCompanies($storefront_id)
    {
        $this->db->query('DELETE FROM ?:storefronts_companies WHERE storefront_id = ?i', $storefront_id);
    }

    /**
     * Deletes storefront.
     *
     * @param int $storefront_id
     */
    protected function deleteStorefront($storefront_id)
    {
        $this->db->query('DELETE FROM ?:storefronts WHERE storefront_id = ?i', $storefront_id);
    }

    /**
     * Provides a set of strings that are used in an SQL query to search a storefront by host.
     *
     * @param string $host Storerfont host
     *
     * @return string[]
     */
    protected function getHostVariants($host)
    {
        $www_host = "www.{$host}";
        $www_n_host = "www_.{$host}";
        $dir = "{$host}/%";
        $www_dir = "www.{$host}/%";
        $www_n_dir = "www_.{$host}/%";

        return [
            $host,
            $www_host,
            $www_n_host,
            $dir,
            $www_dir,
            $www_n_dir,
        ];
    }

    /**
     * Provides WHERE part data of an SQL query for storefronts search.
     *
     * @param array $params Search parameters
     *
     * @return string[]
     */
    protected function buildConditions(array $params)
    {
        $conditions = [
            '' => '1 = 1',
        ];

        if ($params['storefront_id'] !== null) {
            $conditions['storefront_id'] = $this->db->quote(
                'AND storefronts.storefront_id IN (?n)',
                (array) $params['storefront_id']
            );
        }
        if ($params['status']) {
            $conditions['status'] = $this->db->quote(
                'AND storefronts.status IN (?a)',
                (array) $params['status']
            );
        }
        if ($params['redirect_customer']) {
            $conditions['redirect_customer'] = $this->db->quote(
                'AND storefronts.redirect_customer IN (?a)',
                YesNo::toId($params['redirect_customer'])
            );
        }
        if ($params['is_default'] !== null) {
            $conditions['is_default'] = $this->db->quote(
                'AND storefronts.is_default IN (?a)',
                YesNo::toId($params['is_default'])
            );
        }
        if ($params['url'] !== null && $params['url'] !== '') {
            if ($params['is_search']) {
                $conditions['url'] = $this->db->quote('AND storefronts.url LIKE ?l', "%{$params['url']}%");
            } else {
                $conditions['url'] = $this->db->quote('AND storefronts.url = ?s', $params['url']);
            }
        }

        if ($params['host'] !== null) {
            list($host, $www_host, $www_n_host, $dir, $www_dir, $www_n_dir) = $this->getHostVariants($params['host']);

            $conditions['host'] = $this->db->quote(
                'AND (storefronts.url = ?s OR storefronts.url = ?s OR storefronts.url LIKE ?l OR storefronts.url LIKE ?l OR storefronts.url LIKE ?l OR storefronts.url LIKE ?l)',
                $host,
                $www_host,
                $www_n_host,
                $dir,
                $www_dir,
                $www_n_dir
            );
        }

        $is_search = YesNo::toBool($params['is_search']);

        if ($params['currency_ids']) {
            $all_currencies_condition = $is_search
                ? $this->db->quote('OR currencies.currency_id IS NULL')
                : '';
            $conditions['currency_ids'] = $this->db->quote(
                'AND (currencies.currency_id IN (?n) ?p)',
                $this->normalizer->getEnumeration($params['currency_ids']),
                $all_currencies_condition
            );
        }

        if ($params['language_ids']) {
            $all_languages_condition = $is_search
                ? $this->db->quote('OR languages.language_id IS NULL')
                : '';
            $conditions['language_ids'] = $this->db->quote(
                'AND (languages.language_id IN (?n) ?p)',
                $this->normalizer->getEnumeration($params['language_ids']),
                $all_languages_condition
            );
        }

        if ($params['company_ids']) {
            $all_companies_condition = $is_search
                ? $this->db->quote('OR companies.company_id IS NULL')
                : '';
            $conditions['company_ids'] = $this->db->quote(
                'AND (companies.company_id IN (?n) ?p)',
                $this->normalizer->getEnumeration($params['company_ids']),
                $all_companies_condition
            );
        }

        if ($params['country_codes']) {
            $all_countries_condition = $is_search
                ? $this->db->quote('OR countries.country_code IS NULL')
                : '';
            $conditions['country_codes'] = $this->db->quote(
                'AND (countries.country_code IN (?a) ?p)',
                $this->normalizer->getEnumeration($params['country_codes']),
                $all_countries_condition
            );
        }

        return $conditions;
    }

    /**
     * Provides JOIN part data of an SQL query for storefronts search.
     *
     * @param array $params Search parameters
     *
     * @return string[]
     */
    protected function buildJoins(array $params)
    {
        $joins = [];

        if ($params['currency_ids']) {
            $joins['currencies'] = $this->db->quote('LEFT JOIN ?:storefronts_currencies AS currencies ON storefronts.storefront_id = currencies.storefront_id');
        }

        if ($params['language_ids']) {
            $joins['languages'] = $this->db->quote('LEFT JOIN ?:storefronts_languages AS languages ON storefronts.storefront_id = languages.storefront_id');
        }

        if ($params['company_ids']) {
            $joins['companies'] = $this->db->quote('LEFT JOIN ?:storefronts_companies AS companies ON storefronts.storefront_id = companies.storefront_id');
        }

        if ($params['country_codes']) {
            $joins['countries'] = $this->db->quote('LEFT JOIN ?:storefronts_countries AS countries ON storefronts.storefront_id = countries.storefront_id');
        }

        return $joins;
    }

    /**
     * Provides ORDER BY part data of an SQL query for storefronts search.
     *
     * @param array $params Search parameters
     *
     * @return string
     */
    protected function buildOrderBy(array &$params)
    {
        $sortings = [
            'storefront_id'     => 'storefronts.storefront_id',
            'url'               => 'storefronts.url',
            'status'            => 'storefronts.status',
            'redirect_customer' => 'storefronts.redirect_customer',
            'is_default'        => 'storefronts.is_default',
        ];

        if ($params['host'] !== null) {
            list($host, $www_host, $www_n_host, $dir, $www_dir, $www_n_dir) = $this->getHostVariants($params['host']);

            $sortings['host'] = $this->db->quote(
                'storefronts.url = ?s DESC, storefronts.url = ?s DESC, storefronts.url LIKE ?l DESC, storefronts.url LIKE ?l DESC, storefronts.url LIKE ?l DESC, storefronts.url LIKE ?l',
                $host,
                $www_host,
                $www_n_host,
                $dir,
                $www_dir,
                $www_n_dir
            );
        }

        $order_by = db_sort($params, $sortings, 'is_default', 'desc');

        return $order_by;
    }

    /**
     * Populates default storefronts search parameters.
     *
     * @param array $params Search parameters
     *
     * @return array
     */
    protected function populateDefaultFindParameters(array $params)
    {
        $populated_params = array_merge([
            'host'              => null,
            'url'               => null,
            'storefront_id'     => null,
            'status'            => null,
            'is_default'        => null,
            'redirect_customer' => null,
            'sort_by'           => 'is_default',
            'sort_order'        => 'desc',
            'page'              => 1,
            'country_codes'     => [],
            'currency_ids'      => [],
            'language_ids'      => [],
            'company_ids'       => [],
            'is_search'         => false,
            'group_by'          => 'storefront_id',
        ], $params);

        return $populated_params;
    }

    /**
     * Provides LIMIT part data of an SQL query for storefronts search.
     *
     * @param array $params         Search parameters
     * @param int   $items_per_page Items per page
     *
     * @return string[]
     */
    protected function buildLimit(array $params, $items_per_page = 0)
    {
        $limit = '';
        if ($items_per_page !== 0) {
            $limit = db_paginate($params['page'], $items_per_page);
        }

        return $limit;
    }

    /**
     * Provides GROUP BY part data of an SQL query for storefronts search.
     *
     * @param array $params Search parameters
     *
     * @return string
     */
    protected function buildGroupBy(array $params)
    {
        $grouppings = [
            'storefront_id' => 'storefronts.storefront_id',
            'none'          => '',
        ];

        if (isset($grouppings[$params['group_by']])) {
            return $grouppings[$params['group_by']];
        }

        return '';
    }

    /**
     * Normalizes storefront data before save.
     *
     * @param array $data
     *
     * @return array
     */
    protected function normalizeDataBeforeSave(array $data)
    {
        unset($data['storefront_id']);

        $data = $this->normalizer->normalizeStorefrontData($data);

        if (isset($data['is_default'])) {
            $data['is_default'] = YesNo::toId($data['is_default']);
        }

        if (isset($data['redirect_customer'])) {
            $data['redirect_customer'] = YesNo::toId($data['redirect_customer']);
        }

        return $data;
    }

    /**
     * Adds companies to storefronts.
     *
     * @param int[] $company_ids
     * @param int[] $storefront_ids
     */
    public function addCompaniesToStorefronts($company_ids, $storefront_ids)
    {
        $company_ids = (array) $company_ids;

        /** @var \Tygh\Storefront\Storefront[] $storefronts */
        list($storefronts) = $this->find(['storefront_id' => $storefront_ids]);
        foreach ($storefronts as $storefront) {
            $storefront_company_ids = array_merge($storefront->getCompanyIds(), $company_ids);
            $storefront_company_ids = array_unique($storefront_company_ids);
            $storefront->setCompanyIds($storefront_company_ids);
            $this->save($storefront);
        }
    }

    /**
     * Removes companies from storefronts.
     *
     * @param int[] $company_ids
     * @param int[] $storefront_ids
     */
    public function removeCompaniesFromStorefronts($company_ids, $storefront_ids)
    {
        $company_ids = (array) $company_ids;

        /** @var \Tygh\Storefront\Storefront[] $storefronts */
        list($storefronts) = $this->find(['storefront_id' => $storefront_ids]);
        foreach ($storefronts as $storefront) {
            $storefront_company_ids = array_diff($storefront->getCompanyIds(), $company_ids);
            $storefront->setCompanyIds($storefront_company_ids);
            $this->save($storefront);
        }
    }

    /**
     * Validates storefront before saving it.
     *
     * @param \Tygh\Storefront\Storefront $storefront
     *
     * @return \Tygh\Common\OperationResult
     */
    protected function validateBeforeSave(Storefront $storefront)
    {
        $result = new OperationResult(true);

        if ($storefront->storefront_id && !$storefront->is_default) {
            $current_storefront = $this->findById($storefront->storefront_id);
            $is_default_changed = $current_storefront->is_default != $storefront->is_default;
            if ($is_default_changed && $this->getCount(['is_default' => true]) === 1) {
                $result->setSuccess(false);
                $result->addError(1, 'default_storefront_must_exist');
            }
        }

        list($storefronts_with_same_url,) = $this->find(['url' => $storefront->url]);
        foreach ($storefronts_with_same_url as $storefront_with_same_url) {
            if ($storefront_with_same_url->storefront_id != $storefront->storefront_id) {
                $result->setSuccess(false);
                $result->addError(2, 'storefront_with_same_url_exists');
                break;
            }
        }

        return $result;
    }

    /**
     * Disables default status from the previous default storefront after the new default storefront was selected.
     *
     * @param int $new_default_storefront_id
     */
    protected function undefaultOherStorefronts($new_default_storefront_id)
    {
        list($default_storefronts,) = $this->find(['is_default' => true]);
        foreach ($default_storefronts as $old_default_storefront) {
            if ($old_default_storefront->storefront_id != $new_default_storefront_id) {
                $old_default_storefront->is_default = false;
                $this->save($old_default_storefront);
            }
        }
    }
}
