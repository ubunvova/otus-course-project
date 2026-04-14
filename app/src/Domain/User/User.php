<?php

declare(strict_types=1);

namespace App\Domain\User;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

class User
{
    private readonly string $id;
    private readonly DateTimeImmutable $createdAt;

    private function __construct(
        private string $name,
        private string $apiKey,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->createdAt = new DateTimeImmutable();
    }

    public static function create(string $name, string $apiKey): self
    {
        return new self($name, $apiKey);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
