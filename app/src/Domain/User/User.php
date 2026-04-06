<?php

declare(strict_types=1);

namespace App\Domain\User;

use DateTimeImmutable;

class User
{
    private readonly DateTimeImmutable $createdAt;

    private function __construct(
        private string $id,
        private string $name,
        private string $apiKey,
    ) {
        $this->createdAt = new DateTimeImmutable();
    }

    public static function create(string $id, string $name, string $apiKey): self
    {
        return new self($id, $name, $apiKey);
    }
}
