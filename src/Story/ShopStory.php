<?php

namespace App\Story;

use App\Factory\ShopFactory;
use Zenstruck\Foundry\Story;

final class ShopStory extends Story
{
    public function build(): void
    {
        ShopFactory::createMany(20);
    }
}
