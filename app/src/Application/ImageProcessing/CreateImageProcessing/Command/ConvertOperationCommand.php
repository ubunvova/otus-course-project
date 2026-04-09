<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\Command;

final class ConvertOperationCommand implements OperationCommandInterface
{
    public function __construct(
        public string $format,
    ) {
    }
}
