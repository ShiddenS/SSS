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

class Categories extends AEntity
{
    public function index($id = 0, $params = array())
    {
        $lang_code = $this->getLanguageCode($params);

        if (!empty($id)) {
            $data = fn_get_category_data($id, $lang_code);

            if (empty($data)) {
                $status = Response::STATUS_NOT_FOUND;
            } else {
                $status = Response::STATUS_OK;
            }

        } else {
            if (isset($params['category_ids'])) {
                $params['item_ids'] = $params['category_ids'];
                unset($params['category_ids']);
            }
            if (isset($params['item_ids']) && is_array($params['item_ids'])) {
                $params['item_ids'] = implode(',', $params['item_ids']);
            }
            $params['plain'] = $this->safeGet($params, 'plain', true);
            $params['simple'] = $this->safeGet($params, 'simple', false);
            $params['group_by_level'] = $this->safeGet($params, 'group_by_level', false);
            $params['items_per_page'] = $this->safeGet($params, 'items_per_page', Registry::get('settings.Appearance.admin_elements_per_page'));
            $params['page'] = $this->safeGet($params, 'page', 1);

            list($data, $params) = fn_get_categories($params, $lang_code);

            $data = array(
                'categories' => $data,
                'params' => $params,
            );
            $status = Response::STATUS_OK;
        }

        return array(
            'status' => $status,
            'data' => $data
        );
    }

    public function create($params)
    {
        $status = Response::STATUS_BAD_REQUEST;
        $data = array();
        $valid_params = true;

        unset($params['category_id']);

        if (empty($params['category'])) {
            $data['message'] = __('api_required_field', array(
                '[field]' => 'category'
            ));
            $valid_params = false;
        }

        if ($valid_params) {
            $category_id = fn_update_category($params, 0);

            if ($category_id) {
                $this->prepareImages($params, $category_id, 'category_main');
                fn_attach_image_pairs('category_main', 'category', $category_id, DESCR_SL);

                $status = Response::STATUS_CREATED;
                $data = array(
                    'category_id' => $category_id,
                );
            }
        }

        return array(
            'status' => $status,
            'data' => $data
        );
    }

    public function update($id, $params)
    {
        $data = array();
        $status = Response::STATUS_BAD_REQUEST;
        unset($params['category_id']);

        $lang_code = $this->getLanguageCode($params);
        $category_id = fn_update_category($params, $id, $lang_code);
        $this->prepareImages($params, $id, 'category_main');
        $updated = fn_attach_image_pairs('category_main', 'category', $id, DESCR_SL);

        if ($category_id || $updated) {
            if ($updated && fn_notification_exists('extra', '404')) {
                fn_delete_notification('404');
            }

            $status = Response::STATUS_OK;
            $data = array(
                'category_id' => $id
            );
        }

        return array(
            'status' => $status,
            'data' => $data
        );
    }

    public function delete($id)
    {
        $data = array();
        $status = Response::STATUS_NOT_FOUND;

        if (fn_delete_category($id)) {
            $status = Response::STATUS_NO_CONTENT;
        }

        return array(
            'status' => $status,
            'data' => $data
        );
    }

    public function privileges()
    {
        return array(
            'create' => 'manage_catalog',
            'update' => 'manage_catalog',
            'delete' => 'manage_catalog',
            'index'  => 'view_catalog'
        );
    }

    public function privilegesCustomer()
    {
        return array(
            'index' => true
        );
    }

    public function childEntities()
    {
        return array(
            'products'
        );
    }
}
