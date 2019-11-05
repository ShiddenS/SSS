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

use Tygh as Tygh;
use Tygh\Api\AEntity;
use Tygh\Api\Response;
use Tygh\Registry;
use Tygh\BlockManager\Block;
use Tygh\BlockManager\SchemesManager;

class Blocks extends AEntity
{
    public function index($id = 0, $params = array())
    {
        $lang_code = $this->getLanguageCode($params);

        if ($id) {

            $data = Block::instance()->getById($id, 0, array(), $lang_code);
            if ($data) {
                unset(
                    $data['snapping_id'],
                    $data['object_id'],
                    $data['object_type']
                );
                $status = Response::STATUS_OK;
            } else {
                $status = Response::STATUS_NOT_FOUND;
            }

        } else {

            $data = Block::instance()->getAllUnique($lang_code);
            $data = array_values($data);

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

        if (empty($params['name'])) {
            $data['message'] = __('api_required_field', array(
                '[field]' => 'name'
            ));

        } elseif (empty($params['type'])) {
            $data['message'] = __('api_required_field', array(
                '[field]' => 'type'
            ));

        } else {

            $lang_code = $this->getLanguageCode($params);

            unset($params['block_id']);
            $params['apply_to_all_langs'] = 'Y';

            $params['company_id'] = $this->getCompanyId($params);

            if (!is_numeric($params['company_id'])) {
                $data['message'] = __('api_need_store');
            } else {

                $params['content_data']['lang_code'] = $lang_code;
                if (!empty($params['content'])) {
                    $params['content_data']['content'] = $params['content'];
                }
                
                $description = $this->prepareDescription($params, $lang_code);

                $block_id = Block::instance()->update($params, $description);

                if ($block_id) {
                    $status = Response::STATUS_CREATED;
                    $data = array(
                        'block_id' => $block_id,
                    );
                }
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

        if (empty($params['type'])) {
            $data['message'] = __('api_required_field', array(
                '[field]' => 'type'
            ));

        } else {

            if (Block::instance()->getById($id)) {

                $params['block_id'] = $id;
                unset($params['company_id']);
                $lang_code = $this->getLanguageCode($params);

                $params['content_data']['lang_code'] = $lang_code;
                if (!empty($params['content'])) {
                    $params['content_data']['content'] = $params['content'];
                }

                $description = $this->prepareDescription($params, $lang_code);

                $block_id = Block::instance()->update($params, $description);

                if ($block_id) {
                    $status = Response::STATUS_OK;
                    $data = array(
                        'block_id' => $id
                    );
                }
            }
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

        if ($this->isBlockOwner($id)) {

            if (Block::instance()->remove($id)) {
                $status = Response::STATUS_NO_CONTENT;
            }
        }

        return array(
            'status' => $status,
            'data' => $data
        );
    }

    public function privileges()
    {
        return array(
            'create' => 'edit_blocks',
            'update' => 'edit_blocks',
            'delete' => 'edit_blocks',
            'index'  => 'edit_blocks'
        );
    }

    /**
     * @inheritdoc
     */
    public function isAccessable($method_name)
    {
        $is_accessable = true;

        if ($method_name != 'index'
            && $this->isVendorUser()
        ) {
            $is_accessable = Registry::get('settings.Vendors.can_edit_blocks') == 'Y';
        }

        if ($is_accessable) {
            $is_accessable = parent::isAccessable($method_name);
        }

        return $is_accessable;
    }

    protected function getCompanyId($params)
    {
        if ($this->isVendorUser()) {
            $company_id = $this->auth['company_id'];
        } elseif (!empty($params['company_id'])) {
            $company_id = $params['company_id'];
        } elseif (Registry::get('runtime.simple_ultimate')) {
            $company_id = Registry::get('runtime.forced_company_id');
        } else {
            $company_id = Registry::get('runtime.company_id');
        }

        return $company_id;
    }

    protected function prepareDescription($data, $lang_code = DEFAULT_LANGUAGE)
    {
        $description = array();

        if (!empty($data['description'])) {
            $description = $data['description'];
        }

        $fields = array('name');
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $description[$field] = $data[$field];
            }
        }

        $description['lang_code'] = $lang_code;

        return $description;
    }

    /**
     * Checks if current user in the owner of a block by it's id
     *
     * @param $id Block id
     *
     * @return bool
     */
    protected function isBlockOwner($id)
    {
        $result = true;

        if ($this->isVendorUser()) {
            // if block is empty it does not mean that user tries to remove other company's block
            // it might mean that there is no such a block at all
            // so NOT_FOUND status is fine in this case
            $block = Block::instance($this->auth['company_id'])->getById($id);
            $result = !empty($block['block_id']);
        }

        return $result;
    }


}
