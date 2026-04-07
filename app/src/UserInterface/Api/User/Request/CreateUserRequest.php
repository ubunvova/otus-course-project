<?php

declare(strict_types=1);

namespace App\UserInterface\Api\User\Request;

use App\UserInterface\Api\BodyRequestInterface;
use Symfony\Component\Validator\Constraints as SymfonyAssert;

final readonly class CreateUserRequest implements BodyRequestInterface
{
    public function __construct(
        #[SymfonyAssert\Sequentially([
            new SymfonyAssert\NotBlank(),
            new SymfonyAssert\Type('string'),
            new SymfonyAssert\Length(min: 3, max: 255),
        ])]
        public string $name,
    ) {
    }
}
