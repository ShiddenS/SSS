<?php


namespace Tygh\Tests\Unit\Addons\ProductVariations\Service;


use Tygh\Addons\ProductVariations\Product\FeaturePurposes;
use Tygh\Addons\ProductVariations\Product\Group\Group;
use Tygh\Addons\ProductVariations\Product\Group\GroupCodeGenerator;
use Tygh\Addons\ProductVariations\Product\Group\GroupFeature;
use Tygh\Addons\ProductVariations\Product\Group\GroupFeatureCollection;
use Tygh\Addons\ProductVariations\Product\Group\Repository as GroupRepository;
use Tygh\Addons\ProductVariations\Product\ProductIdMap;
use Tygh\Addons\ProductVariations\Product\Repository as ProductRepository;
use Tygh\Addons\ProductVariations\Product\Sync\ProductDataIdentityMapRepository;
use Tygh\Addons\ProductVariations\Service;
use Tygh\Addons\ProductVariations\SyncService;
use Tygh\Tests\Unit\ATestCase;

class CreateGroupTest extends ATestCase
{
    /** @var Service */
    protected $service;

    /** @var \Tygh\Addons\ProductVariations\Product\Group\Repository|\PHPUnit_Framework_MockObject_MockObject */
    protected $group_repository;

    /** @var \Tygh\Addons\ProductVariations\Product\Group\GroupCodeGenerator|\PHPUnit_Framework_MockObject_MockObject */
    protected $group_code_generator;

    /** @var \Tygh\Addons\ProductVariations\Product\Repository|\PHPUnit_Framework_MockObject_MockObject */
    protected $product_repository;

    /** @var \Tygh\Addons\ProductVariations\Product\Sync\ProductDataIdentityMapRepository|\PHPUnit_Framework_MockObject_MockObject */
    protected $identity_map_repository;

    /** @var \Tygh\Addons\ProductVariations\SyncService|\PHPUnit_Framework_MockObject_MockObject */
    protected $sync_service;

    /** @var \Tygh\Addons\ProductVariations\Product\ProductIdMap|\PHPUnit_Framework_MockObject_MockObject */
    protected $product_id_map;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $this->group_repository = $this->getMockBuilder(GroupRepository::class)
            ->setMethods(['save', 'delete', 'findGroupById', 'findGroupByProductId', 'remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->group_code_generator = $this->getMockBuilder(GroupCodeGenerator::class)
            ->setMethods(['next'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->product_repository = $this->getMockBuilder(ProductRepository::class)
            ->setMethods([
                'findProduct',
                'changeProductTypeToSimple',
                'changeProductTypeToChild',
                'findAvailableFeatures',
                'findProducts',
                'loadProductsFeatures',
                'updateProductFeaturesValues',
                'loadProductFeatures'
            ])
            ->disableOriginalConstructor()
            ->getMock();

        $this->identity_map_repository = $this->getMockBuilder(ProductDataIdentityMapRepository::class)
            ->setMethods(['deleteByProductId', 'changeParentProductId', 'deleteByProductIds'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->sync_service = $this->getMockBuilder(SyncService::class)
            ->setMethods(['syncAll'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->product_id_map = $this->getMockBuilder(ProductIdMap::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new Service(
            $this->group_repository,
            $this->group_code_generator,
            $this->product_repository,
            $this->identity_map_repository,
            $this->sync_service,
            $this->product_id_map,
            false, false, false
        );

        $this->requireMockFunction('fn_set_hook');
        $this->requireMockFunction('__');
    }

    public function testCreateGroup()
    {
        $products = [
            12 => [
                'product_id'        => 12,
                'product'           => 'Product 12',
                'parent_product_id' => 0,
                'company_id'        => 1,
            ],
            13 => [
                'product_id'        => 13,
                'product'           => 'Product 13',
                'parent_product_id' => 0,
                'company_id'        => 1,
            ],
            14 => [
                'product_id'        => 14,
                'product'           => 'Product 14',
                'parent_product_id' => 0,
                'company_id'        => 1,
            ],
            15 => [
                'product_id'        => 15,
                'product'           => 'Product 15',
                'parent_product_id' => 0,
                'company_id'        => 1,
            ],
            16 => [
                'product_id'        => 16,
                'product'           => 'Product 16',
                'parent_product_id' => 0,
                'company_id'        => 1,
            ]
        ];

        $products_with_features = [
            12 => [
                'product_id'            => 12,
                'product'               => 'Product 12',
                'parent_product_id'     => 0,
                'company_id'            => 1,
                'variation_feature_ids' => [1, 2],
                'variation_features'    => [
                    1 => [
                        'feature_id'       => 1,
                        'description'      => 'Color',
                        'purpose'          => FeaturePurposes::CREATE_CATALOG_ITEM,
                        'position'         => 0,
                        'variant_id'       => 1,
                        'variant'          => 'White',
                        'variant_position' => 0
                    ],
                    2 => [
                        'feature_id'       => 2,
                        'description'      => 'Size',
                        'purpose'          => FeaturePurposes::CREATE_VARIATION_OF_CATALOG_ITEM,
                        'position'         => 10,
                        'variant_id'       => 1,
                        'variant'          => 'Small',
                        'variant_position' => 10
                    ]
                ]
            ],
            13 => [
                'product_id'            => 13,
                'product'               => 'Product 13',
                'parent_product_id'     => 0,
                'company_id'            => 1,
                'variation_feature_ids' => [1, 2],
                'variation_features'    => [
                    1 => [
                        'feature_id'       => 1,
                        'description'      => 'Color',
                        'purpose'          => FeaturePurposes::CREATE_CATALOG_ITEM,
                        'position'         => 0,
                        'variant_id'       => 1,
                        'variant'          => 'White',
                        'variant_position' => 0
                    ],
                    2 => [
                        'feature_id'       => 2,
                        'description'      => 'Size',
                        'purpose'          => FeaturePurposes::CREATE_VARIATION_OF_CATALOG_ITEM,
                        'position'         => 10,
                        'variant_id'       => 2,
                        'variant'          => 'Large',
                        'variant_position' => 20
                    ]
                ]
            ],
            14 => [
                'product_id'            => 14,
                'product'               => 'Product 14',
                'parent_product_id'     => 0,
                'company_id'            => 1,
                'variation_feature_ids' => [1, 2],
                'variation_features'    => [
                    1 => [
                        'feature_id'       => 1,
                        'description'      => 'Color',
                        'purpose'          => FeaturePurposes::CREATE_CATALOG_ITEM,
                        'position'         => 0,
                        'variant_id'       => 3,
                        'variant'          => 'Black',
                        'variant_position' => 0
                    ],
                    2 => [
                        'feature_id'       => 2,
                        'description'      => 'Size',
                        'purpose'          => FeaturePurposes::CREATE_VARIATION_OF_CATALOG_ITEM,
                        'position'         => 10,
                        'variant_id'       => 1,
                        'variant'          => 'Small',
                        'variant_position' => 10
                    ]
                ]
            ],
            15 => [
                'product_id'            => 15,
                'product'               => 'Product 15',
                'parent_product_id'     => 0,
                'company_id'            => 1,
                'variation_feature_ids' => [1, 2],
                'variation_features'    => [
                    1 => [
                        'feature_id'       => 1,
                        'description'      => 'Color',
                        'purpose'          => FeaturePurposes::CREATE_CATALOG_ITEM,
                        'position'         => 0,
                        'variant_id'       => 3,
                        'variant'          => 'Black',
                        'variant_position' => 0
                    ],
                    2 => [
                        'feature_id'       => 2,
                        'description'      => 'Size',
                        'purpose'          => FeaturePurposes::CREATE_VARIATION_OF_CATALOG_ITEM,
                        'position'         => 10,
                        'variant_id'       => 2,
                        'variant'          => 'Large',
                        'variant_position' => 20
                    ]
                ]
            ],
            16 => [
                'product_id'            => 16,
                'product'               => 'Product 16',
                'parent_product_id'     => 0,
                'company_id'            => 1,
                'variation_feature_ids' => [1, 2],
                'variation_features'    => [
                    1 => [
                        'feature_id'       => 1,
                        'description'      => 'Color',
                        'purpose'          => FeaturePurposes::CREATE_CATALOG_ITEM,
                        'position'         => 0,
                        'variant_id'       => 4,
                        'variant'          => 'Green',
                        'variant_position' => 0
                    ],
                    2 => [
                        'feature_id'       => 2,
                        'description'      => 'Size',
                        'purpose'          => FeaturePurposes::CREATE_VARIATION_OF_CATALOG_ITEM,
                        'position'         => 10,
                        'variant_id'       => 1,
                        'variant'          => 'Small',
                        'variant_position' => 10
                    ]
                ]
            ]
        ];

        $this->product_repository->expects($this->once())->method('findAvailableFeatures')->with(12)->willReturn([
            1 => [
                'feature_id'  => 1,
                'description' => 'Color',
                'purpose'     => FeaturePurposes::CREATE_CATALOG_ITEM,
                'position'    => 0,
            ],
            2 => [
                'feature_id'  => 2,
                'description' => 'Size',
                'purpose'     => FeaturePurposes::CREATE_VARIATION_OF_CATALOG_ITEM,
                'position'    => 10,
            ]
        ]);

        $this->product_repository->expects($this->once())->method('findProducts')->with([12, 13, 14, 15, 16])->willReturn($products);
        $this->product_repository->expects($this->once())->method('loadProductsFeatures')->with($products)->willReturn($products_with_features);
        $this->group_code_generator->expects($this->once())->method('next')->willReturn('PV-1');

        $this->sync_service->expects($this->exactly(2))->method('syncAll')->withConsecutive([12, [13 => 13]], [14, [15 => 15]]);

        $result = $this->service->createGroup([12, 13, 14, 15, 16]);

        /** @var Group $group */
        $group = $result->getData('group');

        $this->assertEquals(new GroupFeatureCollection([
            1 => GroupFeature::create(1, FeaturePurposes::CREATE_CATALOG_ITEM),
            2 => GroupFeature::create(2, FeaturePurposes::CREATE_VARIATION_OF_CATALOG_ITEM),
        ]), $group->getFeatures());

        $this->assertNotEmpty($group->getProduct(12));
        $this->assertEquals(0, $group->getProduct(12)->getParentProductId());

        $this->assertNotEmpty($group->getProduct(13));
        $this->assertEquals(12, $group->getProduct(13)->getParentProductId());

        $this->assertNotEmpty($group->getProduct(14));
        $this->assertEquals(0, $group->getProduct(14)->getParentProductId());

        $this->assertNotEmpty($group->getProduct(15));
        $this->assertEquals(14, $group->getProduct(15)->getParentProductId());

        $this->assertNotEmpty($group->getProduct(16));
        $this->assertEquals(0, $group->getProduct(16)->getParentProductId());

        $this->assertCount(5 ,$group->getProducts());
        $this->assertEquals('PV-1', $group->getCode());
    }
}