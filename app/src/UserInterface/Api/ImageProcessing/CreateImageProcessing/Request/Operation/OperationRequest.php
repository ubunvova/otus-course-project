<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation;

use App\Application\ImageProcessing\ImageProcessingOperationType;
use Symfony\Component\Serializer\Attribute\DiscriminatorMap;
use Symfony\Component\Validator\Constraints as SymfonyAssert;

#[DiscriminatorMap(typeProperty: 'type', mapping: [
    ImageProcessingOperationType::Crop->value => CropOperationRequest::class,
    ImageProcessingOperationType::Resize->value => ResizeOperationRequest::class,
    ImageProcessingOperationType::Rotate->value => RotateOperationRequest::class,
])]
abstract class OperationRequest
{
    #[SymfonyAssert\Sequentially([
        new SymfonyAssert\NotNull(),
        new SymfonyAssert\Type('string'),
        new SymfonyAssert\Choice(callback: [ImageProcessingOperationType::class, 'values']),
    ])]
    public string $type;
}
