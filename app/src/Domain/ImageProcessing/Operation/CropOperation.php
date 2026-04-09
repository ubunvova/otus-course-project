<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing\Operation;

final class CropOperation implements OperationInterface
{
    public function __construct(
        public int $x,
        public int $y,
        public int $width,
        public int $height,
    ) {
    }
}
