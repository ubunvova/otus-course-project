<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\ProcessImageProcessing;

final class ProcessImageProcessingMessage
{
    public function __construct(
        public string $id,
    ) {
    }
}
