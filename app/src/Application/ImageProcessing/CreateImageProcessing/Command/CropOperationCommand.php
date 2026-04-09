<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\Command;

final class CropOperationCommand extends OperationCommand
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
