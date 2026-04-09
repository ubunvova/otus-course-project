<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\Command;

final class ConvertOperationCommand extends OperationCommand
{
    public function __construct(
        public string $format,
        ImageProcessingOperationType $type,
    ) {
        parent::__construct(
            type: $type,
        );
    }
}
