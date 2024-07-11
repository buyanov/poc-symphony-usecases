<?php

namespace App\Action;

use App\UseCase\Shop\ListShopsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
final class ListShopsAction extends AbstractController
{
    #[Route('/shops', name: 'api_shop_list', methods: ['GET'])]
    public function __invoke(
        ListShopsUseCase $listShopsUseCase,
        SerializerInterface $serializer
    ): JsonResponse {
        return new JsonResponse(
            $serializer->serialize($listShopsUseCase->execute(), 'json', ['groups' => 'shop:read']),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
