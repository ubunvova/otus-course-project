<?php

declare(strict_types=1);

namespace App\Domain\User;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

class User
{
    private readonly string $id;
    private readonly string $apiKey;
    private readonly DateTimeImmutable $createdAt;

    private function __construct(
        private string $name,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->apiKey = bin2hex(random_bytes(32));
        $this->createdAt = new DateTimeImmutable();
    }

    public static function create(string $name): self
    {
        return new self($name);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
