<?php

namespace App\Action;

use App\Entity\ShoppingCart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
final class ShowShoppingCartAction extends AbstractController
{
    #[Route('/shopping-cart/{id}', name: 'api_shopping_cart_show', methods: ['GET'])]
    public function __invoke(
        ShoppingCart $shoppingCart,
        SerializerInterface $serializer
    ): JsonResponse {
        return new JsonResponse(
            $serializer->serialize($shoppingCart, 'json', ['groups' => 'cart:read']),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
