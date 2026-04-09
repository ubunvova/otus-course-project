<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing;

enum ImageProcessingStatus: string
{
    case Created = 'created';
    case Processing = 'processing';
    case Completed = 'completed';
    case Failed = 'failed';
}
