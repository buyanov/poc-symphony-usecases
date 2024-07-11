<?php

namespace App\Factory;

use App\Entity\CartItem;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<CartItem>
 */
final class CartItemFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return CartItem::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'quantity' => self::faker()->randomNumber(),
            'product' => ProductFactory::createOne()
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(CartItem $cartItem): void {})
        ;
    }
}
