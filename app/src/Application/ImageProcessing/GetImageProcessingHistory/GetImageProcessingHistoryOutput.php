<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\GetImageProcessingHistory;

use App\Application\Bus\Command\ResultInterface;
use App\Application\ImageProcessing\GetImageProcessingHistory\Output\ImageProcessingOutput;

final readonly class GetImageProcessingHistoryOutput implements ResultInterface
{
    /**
     * @param list<ImageProcessingOutput> $imageProcessing
     */
    public function __construct(
        public array $imageProcessing,
    ) {
    }
}
