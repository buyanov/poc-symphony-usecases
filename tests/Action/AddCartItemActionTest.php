<?php

namespace App\Tests\Action;

use App\Action\AddCartItemAction;
use App\Factory\CartItemFactory;
use App\Factory\ProductFactory;
use App\Factory\ShoppingCartFactory;
use App\Tests\CustomWebTestCase;
use Zenstruck\Foundry\Test\Factories;

class AddCartItemActionTest extends CustomWebTestCase
{
    use Factories;

    public function testAddCartItemAction(): void
    {
        $client = static::createClient();

        $cart = ShoppingCartFactory::createOne();
        $product = ProductFactory::random();

        $client->request('POST',
            $this->route('api_cart_add', ['id' => $cart->getId()]),
            content: json_encode([
                'quantity' => 1,
                'productId' => $product->getId()
            ], JSON_THROW_ON_ERROR)
        );

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
