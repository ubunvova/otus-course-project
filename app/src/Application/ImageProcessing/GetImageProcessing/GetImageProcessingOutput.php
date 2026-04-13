<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\GetImageProcessing;

use App\Application\Bus\Command\ResultInterface;

final readonly class GetImageProcessingOutput implements ResultInterface
{
    public function __construct(
        public string $resultFilePath,
    ) {
    }
}
