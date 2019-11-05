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

namespace Tygh\Api\Entities;

use Tygh\Api\AEntity;
use Tygh\Api\Response;
use Tygh\Registry;

class Taxes extends AEntity
{

    public function index($id = 0, $params = [])
    {
        $lang_code = $this->getLanguageCode($params);

        if (!empty($id)) {
            $data = fn_get_tax($id, $lang_code);

            if (empty($data)) {
                $status = Response::STATUS_NOT_FOUND;
            } else {
                $status = Response::STATUS_OK;
            }

        } else {
            $items_per_page = $this->safeGet($params, 'items_per_page', Registry::get('settings.Appearance.admin_elements_per_page'));
            $page = $this->safeGet($params, 'page', 1);

            $data = fn_get_taxes($lang_code);
            $data = array_values($data);
            $total_items_count = count($data);

            if ($items_per_page) {
                $data = array_slice($data, ($page - 1) * $items_per_page, $items_per_page);
            }

            $data = [
                'taxes'  => $data,
                'params' => [
                    'items_per_page' => $items_per_page,
                    'page'           => $page,
                    'total_items'    => $total_items_count,
                ],
            ];
            $status = Response::STATUS_OK;
        }

        return [
            'status' => $status,
            'data'   => $data
        ];
    }

    public function create($params)
    {
        $status = Response::STATUS_BAD_REQUEST;
        $data = [];
        $valid_params = true;

        if (empty($params['tax'])) {
            $data['message'] = __('api_required_field', [
                '[field]' => 'tax'
            ]);
            $valid_params = false;
        }

        if ($valid_params) {
            $tax_id = fn_update_tax($params, 0);

            if ($tax_id) {
                $status = Response::STATUS_CREATED;
                $data = [
                    'tax_id' => $tax_id,
                ];
            }
        }

        return [
            'status' => $status,
            'data'   => $data
        ];
    }

    public function update($id, $params)
    {
        $status = Response::STATUS_BAD_REQUEST;
        $data = [];

        $lang_code = $this->getLanguageCode($params);
        $tax_id = fn_update_tax($params, $id, $lang_code);

        if ($tax_id) {
            $status = Response::STATUS_OK;
            $data = [
                'tax_id' => $tax_id
            ];
        }

        return [
            'status' => $status,
            'data'   => $data
        ];
    }

    public function delete($id)
    {
        $data = [];
        $status = Response::STATUS_NOT_FOUND;

        if (fn_delete_tax($id)) {
            $status = Response::STATUS_NO_CONTENT;
        }

        return [
            'status' => $status,
            'data'   => $data
        ];
    }

    public function privileges()
    {
        return [
            'create' => 'manage_taxes',
            'update' => 'manage_taxes',
            'delete' => 'manage_taxes',
            'index'  => 'view_taxes'
        ];
    }
}
