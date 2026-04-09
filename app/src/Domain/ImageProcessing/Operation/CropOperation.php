<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing\Operation;

final class CropOperation extends Operation
{
    public function __construct(
        public int $x,
        public int $y,
        public int $width,
        public int $height,
        ImageProcessingOperationType $type,
    ) {
        parent::__construct(
            type: $type,
        );
    }
}
