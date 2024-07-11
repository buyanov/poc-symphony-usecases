<?php

namespace App\Tests\Action;

use App\Action\ShowShoppingCartAction;
use App\Factory\ShoppingCartFactory;
use App\Tests\CustomWebTestCase;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

class ShowShoppingCartActionTest extends CustomWebTestCase
{
    use Factories;

    public function testShowShoppingCartAction(): void
    {
        $client = static::createClient();

        $cart = ShoppingCartFactory::createOne();

        $client->request('GET', $this->route('api_shopping_cart_show', ['id' => $cart->getId()]));

        self::assertResponseIsSuccessful();
        self::assertJsonArrayStructureResponse([
            'id',
            'items' => [
                '*' => [
                    'product',
                    'quantity'
                ]
            ]
        ]);
    }
}
