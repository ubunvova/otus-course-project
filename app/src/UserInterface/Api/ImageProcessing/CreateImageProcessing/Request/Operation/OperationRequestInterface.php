<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation;

use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\ImageProcessingOperation;
use Symfony\Component\Serializer\Attribute\DiscriminatorMap;

#[DiscriminatorMap(typeProperty: 'type', mapping: [
    ImageProcessingOperation::Resize->value => ResizeOperationRequest::class,
    ImageProcessingOperation::Crop->value => CropOperationRequest::class,
    ImageProcessingOperation::Convert->value => ConvertOperationRequest::class,
])]
interface OperationRequestInterface
{
}
