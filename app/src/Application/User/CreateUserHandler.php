<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

final readonly class CreateUserHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    ) {
    }

    #[AsMessageHandler]
    public function __invoke(CreateUserCommand $command): CreateOrderOutput
    {
        $user = User::create($command->name);

        $this->userRepository->create($user);

        return new CreateOrderOutput($user->getApiKey());
    }
}
