<?php

namespace App\UseCase\Shop;

use App\Entity\Shop;
use Doctrine\ORM\EntityManagerInterface;

final readonly class CreateShopUseCase
{

    public function __construct(
        private EntityManagerInterface $entityManager,
    ){
    }

    public function execute(string $name, string $location): Shop
    {
        $shop = new Shop();
        $shop->setName($name);
        $shop->setLocation($location);

        $this->entityManager->persist($shop);
        $this->entityManager->flush();

        return $shop;
    }
}