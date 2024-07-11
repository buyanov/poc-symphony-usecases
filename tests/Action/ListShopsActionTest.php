<?php

namespace App\Tests\Action;

use App\Factory\ShopFactory;
use App\Tests\CustomWebTestCase;
use Zenstruck\Foundry\Test\Factories;

class ListShopsActionTest extends CustomWebTestCase
{
    use Factories;

    public function testListShopsAction(): void
    {
        $client = static::createClient();

        ShopFactory::createMany(5);
        $client->request('GET', '/shops');

        self::assertResponseIsSuccessful();
        self::assertResponseHeaderSame('content-type', 'application/json');
        self::assertJsonArrayStructureResponse(
            ['*' => [
                'id',
                'name',
                'location',
                'products' => [
                    '*' => [
                        'id'
                    ]
                ]
            ]]);
        self::assertJsonCollectionLengthResponse(25);
    }
}
