<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\GetImageProcessingHistory\Output;

use App\Domain\ImageProcessing\ImageProcessingStatus;
use DateTimeImmutable;

final class ImageProcessingOutput
{
    public function __construct(
        public string $id,
        public ImageProcessingStatus $status,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt,
    ) {
    }
}
