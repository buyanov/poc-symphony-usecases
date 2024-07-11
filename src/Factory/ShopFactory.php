<?php

namespace App\Factory;

use App\Entity\Shop;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Shop>
 */
final class ShopFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Shop::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'location' => self::faker()->address(),
            'name' => self::faker()->text(255),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Shop $shop): void {})
        ;
    }
}
