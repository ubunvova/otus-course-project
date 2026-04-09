<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\Command;

use App\Domain\ImageProcessing\Operation\ImageProcessingOperationType as DomainImageProcessingOperation;

enum ImageProcessingOperationType: string
{
    case Resize = DomainImageProcessingOperation::Resize->value;
    case Crop = DomainImageProcessingOperation::Crop->value;
    case Convert = DomainImageProcessingOperation::Convert->value;

    public function toDomain(): DomainImageProcessingOperation
    {
        return match ($this) {
            self::Resize => DomainImageProcessingOperation::Resize,
            self::Crop => DomainImageProcessingOperation::Crop,
            self::Convert => DomainImageProcessingOperation::Convert,
        };
    }
}
