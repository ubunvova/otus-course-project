<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing;

use App\Domain\ImageProcessing\ImageProcessingStatus as DomainImageProcessingStatus;

enum ImageProcessingStatus: string
{
    case Created = DomainImageProcessingStatus::Created->value;
    case Processing = DomainImageProcessingStatus::Processing->value;
    case Completed = DomainImageProcessingStatus::Completed->value;
    case Failed = DomainImageProcessingStatus::Failed->value;
}
