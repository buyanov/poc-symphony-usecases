<?php

declare(strict_types=1);

namespace App\ValueResolver;

use App\Http\Dto\InputDtoInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsTargetedValueResolver;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;

#[AsTargetedValueResolver('body')]
final readonly class JsonBodyResolver implements ValueResolverInterface
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): array
    {
        $argumentType = $argument->getType();

        if (!$argumentType || !str_ends_with($argumentType, 'Dto')) {
            return [];
        }

        return [
            $this->serializer->deserialize(
                $request->getContent(),
                $argument->getType(),
                'json'
            ),
        ];
    }
}
