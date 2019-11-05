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


namespace Tygh\Addons\ProductVariations;


use Tygh\Core\ApplicationInterface;
use Tygh\Core\BootstrapInterface;
use Tygh\Core\HookHandlerProviderInterface;

/**
 * This class describes instructions for loading the product_variations add-on
 *
 * @package Tygh\Addons\ProductVariations
 */
class Bootstrap implements BootstrapInterface, HookHandlerProviderInterface
{
    /**
     * @inheritDoc
     */
    public function boot(ApplicationInterface $app)
    {
        $app->register(new ServiceProvider());
    }

    /**
     * @inheritDoc
     */
    public function getHookHandlerMap()
    {
        return [
            // Retrieving product data
            'get_products' => [
                'addons.product_variations.hook_handlers.products',
                'onGetProducts'
            ],
            'get_product_data_post' => [
                'addons.product_variations.hook_handlers.products',
                'onGetProductDataPost'
            ],
            'get_product_features_post' => [
                'addons.product_variations.hook_handlers.products',
                'onGetProductFeaturesPost'
            ],
            'gather_additional_products_data_params' => [
                'addons.product_variations.hook_handlers.products',
                'onGatherAdditionalProductsDataParams'
            ],
            'gather_additional_product_data_params' => [
                'addons.product_variations.hook_handlers.products',
                'onGatherAdditionalProductDataParams'
            ],
            'load_products_extra_data_pre' => [
                'addons.product_variations.hook_handlers.products',
                'onLoadProductsExtraDataPre'
            ],
            'get_product_name_post' => [
                'addons.product_variations.hook_handlers.products',
                'onGetProductNamePost'
            ],

            // Updating/deleting product data
            'update_product_pre' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateProductPre'
            ],
            'update_product_features_value_pre' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateProductFeaturesValuePre'
            ],
            'update_product_features_value_post' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateProductFeaturesValuePost'
            ],
            'update_product_post' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateProductPost'
            ],
            'update_product_categories_pre' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateProductCategoriesPre'
            ],
            'update_product_categories_post' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateProductCategoriesPost'
            ],
            'add_global_option_link_post' => [
                'addons.product_variations.hook_handlers.products',
                'onAddGlobalOptionLinkPost'
            ],
            'delete_global_option_link_post' => [
                'addons.product_variations.hook_handlers.products',
                'onDeleteGlobalOptionLinkPost'
            ],
            'delete_product_post' => [
                'addons.product_variations.hook_handlers.products',
                'onDeleteProductPost',
                1
            ],
            'update_product_tab_post' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateProductTabPost'
            ],
            'update_product_tab_pre' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateProductTabPre'
            ],
            'clone_product_data' => [
                'addons.product_variations.hook_handlers.products',
                'onCloneProductData'
            ],
            'delete_product_feature' => [
                'addons.product_variations.hook_handlers.products',
                'onDeleteProductFeature'
            ],
            'delete_product_feature_variants_pre' => [
                'addons.product_variations.hook_handlers.products',
                'onDeleteProductFeatureVariantsPre'
            ],
            'update_image_pairs' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateImagePairs'
            ],
            'delete_image_pair' => [
                'addons.product_variations.hook_handlers.products',
                'onDeleteImagePair'
            ],
            'update_product_amount_post' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateProductAmountPost'
            ],
            'update_product_feature' => [
                'addons.product_variations.hook_handlers.products',
                'onUpdateProductFeature'
            ],

            // Routing and urls
            'url_pre' => [
                'addons.product_variations.hook_handlers.seo',
                'onUrlPre'
            ],
            'get_route' => [
                'addons.product_variations.hook_handlers.seo',
                'onGetRoute',
                1900
            ],

            // Discussion
            'get_discussion_pre' => [
                'addons.product_variations.hook_handlers.discussions',
                'onGetDiscussionPre',
                null,
                'discussion'
            ],
            'discussions_variation_group_mark_product_as_main_post' => [
                'hook'    => 'variation_group_mark_product_as_main_post',
                'handler' => [
                    'addons.product_variations.hook_handlers.discussions',
                    'onVariationGroupMarkProductAsMainPost',
                ],
                'addon'   => 'discussion'
            ],

            // Seo
            'seo_variation_group_mark_product_as_main_post' => [
                'hook'    => 'variation_group_mark_product_as_main_post',
                'handler' => [
                    'addons.product_variations.hook_handlers.seo',
                    'onVariationGroupMarkProductAsMainPost',
                ],
                'addon'   => 'seo'
            ],

            // Attachments
            'attachments_variation_group_mark_product_as_main_post' => [
                'hook'    => 'variation_group_mark_product_as_main_post',
                'handler' => [
                    'addons.product_variations.hook_handlers.attachments',
                    'onVariationGroupMarkProductAsMainPost',
                ],
                'addon'   => 'attachments'
            ],
            'get_attachments_pre' => [
                'addons.product_variations.hook_handlers.attachments',
                'onGetAttachmentsPre',
                null,
                'attachments'
            ],

            // Data feeds
            'data_feeds_export_before_get_products' => [
                'addons.product_variations.hook_handlers.products',
                'onDataFeedsExportBeforeGetProducts'
            ],

            // Block manager
            'update_location' => [
                'addons.product_variations.hook_handlers.block_manager',
                'onUpdateLocation'
            ],
            'update_location_post' => [
                'addons.product_variations.hook_handlers.block_manager',
                'onUpdateLocationPost'
            ],
            'update_block_post' => [
                'addons.product_variations.hook_handlers.block_manager',
                'onUpdateBlockPost'
            ],
            'update_block_status_post' => [
                'addons.product_variations.hook_handlers.block_manager',
                'onUpdateBlockStatusPost'
            ],
            'update_snapping_pre' => [
                'addons.product_variations.hook_handlers.block_manager',
                'onUpdateSnappingPre'
            ],
            'update_snapping_post' => [
                'addons.product_variations.hook_handlers.block_manager',
                'onUpdateSnappingPost'
            ],

            // Cart and orders
            'get_order_info' => [
                'addons.product_variations.hook_handlers.carts',
                'onGetOrderInfo'
            ],
            'get_user_edp_post' => [
                'addons.product_variations.hook_handlers.carts',
                'onGetUserEdpPost'
            ],
            'get_cart_products_post' => [
                'addons.product_variations.hook_handlers.carts',
                'onGetCartProductsPost'
            ],

            // Others
            'dispatch_before_display' => [
                'addons.product_variations.hook_handlers.products',
                'onDispatchBeforeDisplay'
            ],
            'view_set_view_tools_pre' => [
                'addons.product_variations.hook_handlers.products',
                'onViewSetViewToolsPre'
            ],
            'last_view_init_pre' => [
                'addons.product_variations.hook_handlers.products',
                'onLastViewInitPre'
            ],
            'vendor_plans_companies_get_products_count_pre' => [
                'addons.product_variations.hook_handlers.products',
                'onVendorPlansCompaniesGetProductsCountPre'
            ],
            'storefront_repository_save_post' => [ServiceProvider::class, 'notifyIfOldProductVariationsExists']
        ];
    }
}
