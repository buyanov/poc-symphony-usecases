<?php

namespace App\Tests\Action;

use App\Tests\CustomWebTestCase;

class CreateShoppingCartActionTest extends CustomWebTestCase
{

    public function testCreateShoppingCart(): void
    {
        $client = static::createClient();

        $client->request('POST', $this->route('api_cart_create'));

        self::assertResponseIsSuccessful();
        self::assertJsonArrayStructureResponse(['id']);
    }
}
