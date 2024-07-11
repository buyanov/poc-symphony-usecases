<?php

namespace App\UseCase\Cart;

use App\Entity\ShoppingCart;
use Doctrine\ORM\EntityManagerInterface;

readonly class CreateShoppingCartUserCase
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    public function execute(): ShoppingCart
    {
        $cart = new ShoppingCart();
        $this->entityManager->persist($cart);
        $this->entityManager->flush();

        return $cart;
    }
}
