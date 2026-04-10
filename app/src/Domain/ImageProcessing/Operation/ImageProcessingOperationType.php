<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing\Operation;

enum ImageProcessingOperationType: string
{
    case Crop = 'crop';
    case Resize = 'resize';
    case Rotate = 'rotate';
}
