<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\GetImageProcessingHistory\Response;

use App\Application\ImageProcessing\GetImageProcessingHistory\Output\ImageProcessingOutput;
use App\UserInterface\Api\Response\ResponseInterface;

final readonly class GetImageProcessingHistoryResponse implements ResponseInterface
{
    /**
     * @param list<ImageProcessingOutput> $imageProcessingHistory
     */
    public function __construct(
        public array $imageProcessingHistory,
    ) {
    }

    /**
     * @return array{
     *     items: list<ImageProcessingOutput>
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'items' => $this->imageProcessingHistory,
        ];
    }
}
