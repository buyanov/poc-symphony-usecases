<?php

namespace App\UseCase\CartItem;

use App\Entity\CartItem;
use App\Entity\ShoppingCart;
use App\Repository\ProductRepository;
use App\UseCase\CartItem\Dto\CartItemDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class AddCartItemUseCase
{
    public function __construct(
        private ProductRepository $productRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    /**
     * Adds a new item to the shopping cart.
     *
     * @param ShoppingCart $cart
     * @param CartItemDto $cartItemDto
     *
     * @return ShoppingCart
     *
     */
    public function execute(ShoppingCart $cart, CartItemDto $cartItemDto): ShoppingCart
    {
        $product = $this->productRepository->find($cartItemDto->productId)
            ?? throw new NotFoundHttpException('Product not found');

        $item = (new CartItem())
            ->setProduct($product)
            ->setQuantity($cartItemDto->quantity);

        $cart->addCartItem($item);

        $this->entityManager->persist($item);
        $this->entityManager->flush();

        return $cart;
    }
}