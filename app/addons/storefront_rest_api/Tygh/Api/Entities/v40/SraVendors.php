<?php

namespace Tygh\Api\Entities\v40;

use Tygh\Api\Entities\Vendors;
use Tygh\Api\Response;
use Tygh\Registry;

class SraVendors extends Vendors
{
    /**
     * @var array $company_data
     */
    protected $company_data;

    /**
     * Fields that are listed in contact information section.
     *
     * @var array $contact_information_fields
     */
    protected $contact_information_fields = array('email', 'phone', 'fax', 'url');

    /**
     * Fields that are listed in shipping address information section.
     *
     * @var array $shipping_address_fields
     */
    protected $shipping_address_fields = array('address', 'city', 'state', 'country', 'zipcode');

    /**
     * Fields that will be returned for a vendor.
     *
     * @var array $response_fields
     */
    protected $response_fields = array(
        'company_id',
        'lang_code',
        'email',
        'company',
        'timestamp',
        'status',
        'logo_url',
        'description',
        'contact_information',
        'shipping_address',
        'products_count',
    );

    /** @inheritdoc */
    public function index($id = 0, $params = array())
    {
        $params['status'] = 'A';

        $response = parent::index($id, $params);

        // do not process response when the parent entity request resulted in failure
        if ($response['status'] != Response::STATUS_OK) {
            return $response;
        }

        // do not process disabled vendor data
        if ($id && $response['data']['status'] !== 'A') {
            return array(
                'status' => Response::STATUS_NOT_FOUND,
                'data'   => array()
            );
        }

        $lang_code = $this->getLanguageCode($params);

        $is_discussion_enabled = SraDiscussion::isAddonEnabled();

        if ($id) {
            $response['data'] = $this->stripServiceData($response['data']);
            $response['data'] = $this->getAdditionalData($response['data'], $lang_code);
            if ($is_discussion_enabled) {
                $response['data'] = SraDiscussion::setDiscussionType($response['data'], DISCUSSION_OBJECT_TYPE_COMPANY);
            }
        } else {
            foreach ($response['data']['sravendors'] as &$company_data) {
                $company_data = $this->stripServiceData($company_data);
                $company_data = $this->getAdditionalData($company_data, $lang_code);
                if ($is_discussion_enabled) {
                    $company_data = SraDiscussion::setDiscussionType($company_data, DISCUSSION_OBJECT_TYPE_COMPANY);
                }
            }
            unset($company_data);
        }

        return $response;
    }

    /**
     * Removes sensitive info from vendor data.
     *
     * @param array $company_data Company data to strip
     *
     * @return array Sanitized data
     */
    protected function stripServiceData(array $company_data)
    {
        foreach (array_keys($company_data) as $field) {
            if (!in_array($field, $this->response_fields)) {
                unset($company_data[$field]);
            }
        }

        return $company_data;
    }

    /**
     * Gathers additional vendor data.
     *
     * @param array  $company_data Company data to gather additional data for
     * @param string $lang_code    Two-letter language code
     *
     * @return array Company data with additional data appended
     */
    protected function getAdditionalData(array $company_data, $lang_code = DEFAULT_LANGUAGE)
    {
        $company_data['logo_url'] = $this->getLogoUrl($company_data['company_id']);

        $company_data['description'] = $this->getDescription($company_data['company_id'], $lang_code);

        $company_data['contact_information'] = $this->getContactInformation($company_data['company_id'], $lang_code);

        $company_data['shipping_address'] = $this->getShippingAddress($company_data['company_id'], $lang_code);

        $company_data['products_count'] = $this->getProductsCount($company_data['company_id']);

        return $company_data;
    }

    /**
     * Gets vendor products count.
     *
     * @param int    $company_id Company identifier
     * @param string $lang_code  Two-letter language code
     *
     * @return int Count of products.
     */
    protected function getProductsCount($company_id)
    {

        $params = array();
        
        $params['extend'] = array('products_count' => $company_id);
        $params['company_id'] = $company_id;

        list($data) = fn_get_companies($params, $this->auth, 0);

        $count = 0;

        if (isset($company_id)) {
            $data = reset($data);
            $count = $data['products_count'];
        }

        return (int)$count;
    }

    /**
     * Gets vendor logo URL.
     *
     * @param int $company_id Company identifier
     *
     * @return string Logo URL
     */
    protected function getLogoUrl($company_id)
    {
        $company_logos = fn_get_logos($company_id);

        $theme_logo = array();
        if (!empty($company_logos['theme']['image'])) {
            $theme_logo = fn_image_to_display($company_logos['theme']['image']);
        }

        $logo_url = empty($theme_logo['image_path'])
            ? (Registry::get('config.http_location') . '/images/no_image.png')
            : $theme_logo['image_path'];

        return $logo_url;
    }

    /**
     * Obtains vendor description.
     *
     * @param int    $company_id Company identifier
     * @param string $lang_code  Two-letter language code
     *
     * @return string Company description
     */
    protected function getDescription($company_id, $lang_code = DEFAULT_LANGUAGE)
    {
        if ($this->company_data === null) {
            $this->company_data = fn_get_company_data($company_id, $lang_code);
        }

        return $this->company_data['company_description'];
    }

    /**
     * Obtains vendor contact information.
     *
     * @param int    $company_id Company identifier
     * @param string $lang_code  Two-letter language code
     *
     * @return array Contact infromation as displayed on vendor detailed page
     */
    protected function getContactInformation($company_id, $lang_code = DEFAULT_LANGUAGE)
    {
        if ($this->company_data === null) {
            $this->company_data = fn_get_company_data($company_id, $lang_code);
        }

        $company_data = array();

        foreach ($this->contact_information_fields as $field_name) {
            if (isset($this->company_data[$field_name])) {
                $company_data[$field_name] = $this->company_data[$field_name];
            } else {
                $company_data[$field_name] = '';
            }
        }

        return $company_data;
    }

    /**
     * Obtains vendor shipping address.
     *
     * @param int    $company_id Company identifier
     * @param string $lang_code  Two-letter language code
     *
     * @return array Shipping infromation as displayed on vendor detailed page
     */
    protected function getShippingAddress($company_id, $lang_code = DEFAULT_LANGUAGE)
    {
        if ($this->company_data === null) {
            $this->company_data = fn_get_company_data($company_id, $lang_code);
        }

        $shipping_address = array();

        foreach ($this->shipping_address_fields as $field_name) {
            if (isset($this->company_data[$field_name])) {
                $shipping_address[$field_name] = $this->company_data[$field_name];
            } else {
                $shipping_address[$field_name] = '';
            }
        }

        $shipping_address['country_code'] = $shipping_address['country'];
        $shipping_address['country'] = fn_get_country_name(
            $shipping_address['country_code'],
            $lang_code
        );

        $shipping_address['state_code'] = $shipping_address['state'];
        $shipping_address['state'] = fn_get_state_name(
            $shipping_address['state_code'],
            $shipping_address['country_code'],
            $lang_code
        );

        return $shipping_address;
    }

    /** @inheritdoc */
    public function privilegesCustomer()
    {
        $privileges = array(
            'index' => fn_allowed_for('MULTIVENDOR'),
        );

        return $privileges;
    }
}
