<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing\Operation;

final class ConvertOperation extends Operation
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
