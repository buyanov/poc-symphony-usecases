<?php

namespace App\Story;

use App\Factory\ShoppingCartFactory;
use Zenstruck\Foundry\Story;

final class ShoppingCartStory extends Story
{
    public function build(): void
    {
        ShoppingCartFactory::createOne();
    }
}
