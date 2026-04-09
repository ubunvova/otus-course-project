<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing;

use App\Domain\ImageProcessing\Operation\Operation;
use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

final readonly class ImageProcessing
{
    private string $id;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    /**
     * @param list<Operation> $operations
     */
    private function __construct(
        private string $userId,
        private string $filePath,
        private array $operations,
        private string $status,
        private ?string $resultFilePath = null,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = $this->createdAt;
    }

    /**
     * @param list<Operation> $operations
     */
    public static function create(
        string $userId,
        string $filePath,
        array $operations,
    ): self {
        return new self(
            userId: $userId,
            filePath: $filePath,
            operations: $operations,
            status: ImageProcessingStatus::Created->value,
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getOperations(): array
    {
        return $this->operations;
    }
}
