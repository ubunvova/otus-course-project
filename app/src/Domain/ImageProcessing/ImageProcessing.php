<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing;

use App\Domain\ImageProcessing\Operation\Operation;
use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

final class ImageProcessing
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
        private ImageProcessingStatus $status,
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
            status: ImageProcessingStatus::Created,
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

    /**
     * @return list<Operation>
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    public function getStatus(): ImageProcessingStatus
    {
        return $this->status;
    }

    public function getResultFilePath(): ?string
    {
        return $this->resultFilePath;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function markProcessingStatus(): void
    {
        $this->status = ImageProcessingStatus::Processing;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function markFailedStatus(): void
    {
        $this->status = ImageProcessingStatus::Failed;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function markCompletedStatus(): void
    {
        $this->status = ImageProcessingStatus::Completed;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function setResultFilePath(string $resultFilePath): void
    {
        $this->resultFilePath = $resultFilePath;
        $this->updatedAt = new DateTimeImmutable();
    }
}
