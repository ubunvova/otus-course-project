<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Response;

use App\UserInterface\Api\Response\ResponseInterface;

final readonly class CreateImageProcessingResponse implements ResponseInterface
{
    public function __construct(
        public string $id,
    ) {
    }

    /**
     * @return array{
     *     id: string,
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
