<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\Command;

final class ResizeOperationCommand implements OperationCommandInterface
{
    public function __construct(
        public int $width,
        public int $height,
    ) {
    }
}
