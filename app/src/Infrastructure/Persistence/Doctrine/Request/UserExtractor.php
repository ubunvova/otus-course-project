<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Request;

use App\Application\User\UserExtractorInterface;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\AuthComponent\AuthComponent;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

final readonly class UserExtractor implements UserExtractorInterface
{
    public function __construct(
        private AuthComponent $authComponent,
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function getUser(): User
    {
        $apiKey = $this->authComponent->getApiKey();

        $user = $this->userRepository->getUserByApiKey($apiKey);

        if (!$user) {
            throw throw new UnauthorizedHttpException('User not found');
        }

        return $user;
    }
}
