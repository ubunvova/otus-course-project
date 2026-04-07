<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Application\Bus\Command\CommandInterface;

/**
 * @implements CommandInterface<CreateOrderOutput>
 */
final readonly class CreateUserCommand implements CommandInterface
{
    public function __construct(
        public string $name,
    ) {
    }
}
