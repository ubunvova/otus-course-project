<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\Bus\Command\ResultInterface;

final readonly class CreateOrderOutput implements ResultInterface
{
    public function __construct(
        public string $apiKey,
    ) {
    }
}
