<?php

namespace Tygh\Tests\Unit\Storefront;

use Tygh\Database\Connection;
use Tygh\Enum\StorefrontStatuses;
use Tygh\Storefront\DataLoader;
use Tygh\Storefront\Factory;
use Tygh\Storefront\Normalizer;
use Tygh\Storefront\Repository;
use Tygh\Storefront\Storefront;
use Tygh\Tests\Unit\ATestCase;

class RepositoryTest extends ATestCase
{
    /** @var Repository */
    protected $repository;

    public function setUp()
    {
        $this->repository = new Repository(
            $this->createMock(Connection::class),
            $this->createMock(Factory::class),
            $this->createMock(Normalizer::class)
        );
    }

    /**
     * @dataProvider dpFindClosestMatchingByPath
     */
    public function testFindClosestMatchingByPath($path, $storefronts, $expected)
    {
        $actual = $this->repository->findClosestMatchingByPath($path, $storefronts);

        $this->assertEquals($expected, $actual);
    }

    public function dpFindClosestMatchingByPath()
    {
        $data_loader = $this->createMock(DataLoader::class);
        $status = StorefrontStatuses::OPEN;

        $storefront = new Storefront(0, 'example.com', false, false, $status, '', $data_loader);
        $storefront_1 = new Storefront(1, 'example.com/store1', false, false, $status, '', $data_loader);
        $storefront_1_1 = new Storefront(11, 'example.com/store1/substore1', false, false, $status, '', $data_loader);
        $storefront_1_2 = new Storefront(12, 'example.com/store1/substore2', false, false, $status, '', $data_loader);
        $storefront_2 = new Storefront(2, 'example.com/store2', false, false, $status, '', $data_loader);
        $storefront_2_1 = new Storefront(21, 'example.com/store2/substore1', false, false, $status, '', $data_loader);
        $storefront_2_2 = new Storefront(22, 'example.com/store2/substore2', false, false, $status, '', $data_loader);

        $storefronts = [
            $storefront,
            $storefront_1,
            $storefront_1_1,
            $storefront_1_2,
            $storefront_2,
            $storefront_2_1,
            $storefront_2_2,
        ];

        return [
            [
                '',
                [],
                null,
            ],
            [
                '',
                $storefronts,
                $storefront,
            ],
            [
                '/',
                $storefronts,
                $storefront,
            ],
            [
                '/electronics/tv/lg.html',
                $storefronts,
                $storefront,
            ],
            [
                '/store1',
                $storefronts,
                $storefront_1,
            ],
            [
                '/store1/electronics/tv/lg.html',
                $storefronts,
                $storefront_1,
            ],
            [
                '/store1/substore1',
                $storefronts,
                $storefront_1_1,
            ],
            [
                '/store1/substore1/electronics/tv/lg.html',
                $storefronts,
                $storefront_1_1,
            ],
        ];
    }
}
