<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\Command;

abstract class OperationCommand
{
    public function __construct(
        public ImageProcessingOperationType $type,
    ) {
    }
}
