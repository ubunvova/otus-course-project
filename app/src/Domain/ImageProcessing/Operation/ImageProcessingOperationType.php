<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing\Operation;

enum ImageProcessingOperationType: string
{
    case Resize = 'resize';
    case Crop = 'crop';
    case Convert = 'convert';
}
