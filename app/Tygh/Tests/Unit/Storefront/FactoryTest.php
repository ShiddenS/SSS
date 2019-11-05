<?php

namespace Tygh\Tests\Unit\Storefront;

use Tygh\Database\Connection;
use Tygh\Enum\StorefrontStatuses;
use Tygh\Enum\YesNo;
use Tygh\Storefront\DataLoader;
use Tygh\Storefront\Factory;
use Tygh\Storefront\Normalizer;
use Tygh\Storefront\Storefront;
use Tygh\Tests\Unit\ATestCase;

class FactoryTest extends ATestCase
{
    /** @var \Tygh\Storefront\Factory */
    protected $factory;

    public function setUp()
    {
        $normalizer = $this->createMock(Normalizer::class);
        $normalizer->method('normalizeStorefrontData')
            ->will($this->returnCallback(function ($args) {
                return $args;
            }));

        $this->factory = new Factory(
            $this->createMock(Connection::class),
            $this->createMock(DataLoader::class),
            $normalizer
        );
    }

    /**
     * @dataProvider dpFromArray
     */
    public function testFromArray($data)
    {
        /** @var Storefront $actual */
        $actual = $this->factory->fromArray($data);

        $expected = new Storefront(
            1,
            'example.com',
            false,
            false,
            StorefrontStatuses::OPEN,
            '1',
            $this->createMock(DataLoader::class),
            ['RU', 'US'],
            [1, 2],
            [3, 4],
            [5, 6]
        );

        $this->assertEquals($expected->storefront_id, $actual->storefront_id);
        $this->assertEquals($expected->url, $actual->url);
        $this->assertEquals($expected->is_default, $actual->is_default);
        $this->assertEquals($expected->redirect_customer, $actual->redirect_customer);
        $this->assertEquals($expected->status, $actual->status);
        $this->assertEquals($expected->access_key, $actual->access_key);
        $this->assertEquals($expected->getCountryCodes(), $actual->getCountryCodes());
        $this->assertEquals($expected->getCompanyIds(), $actual->getCompanyIds());
        $this->assertEquals($expected->getLanguageIds(), $actual->getLanguageIds());
        $this->assertEquals($expected->getCurrencyIds(), $actual->getCurrencyIds());
    }

    public function dpFromArray()
    {
        return [
            [
                [
                    'storefront_id'     => 1,
                    'url'               => 'example.com',
                    'is_default'        => false,
                    'redirect_customer' => false,
                    'status'            => StorefrontStatuses::OPEN,
                    'access_key'        => '1',
                    'country_codes'     => ['RU', 'US'],
                    'company_ids'       => [1, 2],
                    'currency_ids'      => [3, 4],
                    'language_ids'      => [5, 6],
                ],
            ],

            [
                [
                    'storefront_id'     => 1,
                    'url'               => 'example.com',
                    'is_default'        => YesNo::NO,
                    'redirect_customer' => YesNo::NO,
                    'status'            => StorefrontStatuses::OPEN,
                    'access_key'        => '1',
                    'country_codes'     => ['RU', 'US'],
                    'company_ids'       => [1, 2],
                    'currency_ids'      => [3, 4],
                    'language_ids'      => [5, 6],
                ],
            ],

        ];
    }
}
