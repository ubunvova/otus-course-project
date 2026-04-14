<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing;

use App\Application\Bus\Command\ResultInterface;

final class CreateImageProcessingOutput implements ResultInterface
{
    public function __construct(
        public string $id,
    ) {
    }
}
