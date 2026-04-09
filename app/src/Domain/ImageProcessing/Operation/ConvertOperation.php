<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing\Operation;

final class ConvertOperation implements OperationInterface
{
    public function __construct(
        public string $format,
    ) {
    }
}
