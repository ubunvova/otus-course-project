<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing;

use App\Domain\ImageProcessing\Operation\ImageProcessingOperationType as DomainImageProcessingOperation;

enum ImageProcessingOperationType: string
{
    case Crop = DomainImageProcessingOperation::Crop->value;
    case Resize = DomainImageProcessingOperation::Resize->value;
    case Rotate = DomainImageProcessingOperation::Rotate->value;

    public function toDomain(): DomainImageProcessingOperation
    {
        return match ($this) {
            self::Crop => DomainImageProcessingOperation::Crop,
            self::Resize => DomainImageProcessingOperation::Resize,
            self::Rotate => DomainImageProcessingOperation::Rotate,
        };
    }
}
