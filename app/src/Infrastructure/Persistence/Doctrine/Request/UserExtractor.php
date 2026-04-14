<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Request;

use App\Application\User\UserExtractorInterface;
use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\AuthComponent\AuthComponent;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

final class UserExtractor implements UserExtractorInterface
{
    private ?User $user = null;

    public function __construct(
        private AuthComponent $authComponent,
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function getUser(): User
    {
        if ($this->user instanceof User) {
            return $this->user;
        }

        $providedKey = $this->authComponent->getApiKey();

        if (!$providedKey) {
            throw new UnauthorizedHttpException('Missing API key');
        }

        $apiKeyHash = bin2hex(sodium_crypto_generichash($providedKey));

        $user = $this->userRepository->getUserByApiKey($apiKeyHash);

        if (!$user) {
            throw new UnauthorizedHttpException('Invalid API key');
        }

        $this->user = $user;

        return $this->user;
    }
}
