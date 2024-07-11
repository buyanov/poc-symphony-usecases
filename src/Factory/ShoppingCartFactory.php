<?php

namespace App\Factory;

use App\Entity\ShoppingCart;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<ShoppingCart>
 */
final class ShoppingCartFactory extends PersistentProxyObjectFactory
{

    public static function class(): string
    {
        return ShoppingCart::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'createdAt' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'cartItems' => CartItemFactory::createMany(4)
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(ShoppingCart $shoppingCart): void {})
        ;
    }
}
