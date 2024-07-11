<?php

namespace App\Action;

use App\UseCase\Cart\CreateShoppingCartUserCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class CreateShoppingCartAction extends AbstractController
{
    #[Route('/cart', name: 'api_cart_create', methods: ['POST'])]
    public function __invoke(
        CreateShoppingCartUserCase $cartUserCase,
        SerializerInterface $serializer
    ): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($cartUserCase->execute(), 'json', ['groups' => 'cart:read']),
            Response::HTTP_CREATED,
            [],
            true
        );
    }
}