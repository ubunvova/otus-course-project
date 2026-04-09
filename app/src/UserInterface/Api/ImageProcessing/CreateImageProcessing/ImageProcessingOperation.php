<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing;

enum ImageProcessingOperation: string
{
    case Resize = 'resize';
    case Crop = 'crop';
    case Convert = 'convert';
}
