<?php

declare(strict_types=1);

namespace App\UserInterface\Api\User\Response;

use App\UserInterface\Api\Response\ResponseInterface;

final readonly class CreateUserResponse implements ResponseInterface
{
    public function __construct(
        public string $apiKey,
    ) {
    }

    /**
     * @return list<string>
     */
    public function jsonSerialize(): array
    {
        return [
            'apiKey' => $this->apiKey,
        ];
    }
}
