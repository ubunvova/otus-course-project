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
        $apiKey = bin2hex(random_bytes(32));
        $apiKeyHash = bin2hex(sodium_crypto_generichash($apiKey));

        $user = User::create($command->name, $apiKeyHash);

        $this->userRepository->create($user);

        return new CreateOrderOutput($apiKey);
    }
}
