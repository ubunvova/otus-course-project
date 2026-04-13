<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\GetImageProcessingHistory\Response;

use App\Application\ImageProcessing\ImageProcessingStatus;
use App\UserInterface\Api\Response\ResponseInterface;
use DateTimeImmutable;

use const DATE_ATOM;

final readonly class ImageProcessingResponse implements ResponseInterface
{
    public function __construct(
        public string $id,
        public ImageProcessingStatus $status,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt,
    ) {
    }

    /**
     * @return array{
     *     id: string,
     *     status: string,
     *     createdAt: string,
     *     updatedAt: string
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->value,
            'createdAt' => $this->createdAt->format(DATE_ATOM),
            'updatedAt' => $this->updatedAt->format(DATE_ATOM),
        ];
    }

}
