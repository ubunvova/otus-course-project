<?php

declare(strict_types=1);

namespace App\Domain\User;

interface UserRepositoryInterface
{
    public function create(User $user): void;

    public function getUserByApiKey(string $apiKey): ?User;
}
