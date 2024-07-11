<?php

namespace App\UseCase\Shop;

use App\Repository\ShopRepository;

final readonly class ListShopsUseCase
{
    public function __construct(
        private ShopRepository $shopRepository
    ) {
    }

    /**
     * Executes the use case to list all shops.
     *
     * @return array
     */
    public function execute(): array
    {
        return $this->shopRepository->findAll();
    }
}
