<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing\Operation;

final class ResizeOperation implements OperationInterface
{
    public function __construct(
        public int $width,
        public int $height,
    ) {
    }
}
