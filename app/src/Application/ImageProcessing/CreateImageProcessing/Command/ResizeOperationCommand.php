<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\Command;

use App\Application\ImageProcessing\ImageProcessingOperationType;

final class ResizeOperationCommand extends OperationCommand
{
    public function __construct(
        public int $width,
        public int $height,
        ImageProcessingOperationType $type,
    ) {
        parent::__construct(
            type: $type,
        );
    }
}
