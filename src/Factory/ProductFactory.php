<?php

namespace App\Factory;

use App\Entity\Product;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Product>
 */
final class ProductFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Product::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->text(255),
            'price' => self::faker()->randomNumber(),
            'sku' => self::faker()->text(255),
            'shop' => ShopFactory::random()
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Product $product): void {})
        ;
    }
}
