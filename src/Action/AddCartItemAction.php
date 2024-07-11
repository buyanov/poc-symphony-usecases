<?php

namespace App\Action;

use App\Entity\ShoppingCart;
use App\UseCase\CartItem\AddCartItemUseCase;
use App\UseCase\CartItem\Dto\CartItemDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class AddCartItemAction extends AbstractController
{
    #[Route('/cart/{id}/item', name: 'api_cart_add', methods: ['POST'])]
    public function __invoke(
        #[ValueResolver('body')] CartItemDto $cartItemDto,
        AddCartItemUseCase $addCartItemUseCase,
        SerializerInterface $serializer,
        ShoppingCart $cart
    ): JsonResponse {
        return new JsonResponse(
            $serializer->serialize(
                $addCartItemUseCase->execute($cart, $cartItemDto),
                'json',
                ['groups' => 'cart:read']
            ),
            Response::HTTP_CREATED,
            [],
            true
        );
    }
}
