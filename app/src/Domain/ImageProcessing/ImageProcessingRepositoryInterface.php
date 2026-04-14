<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing;

interface ImageProcessingRepositoryInterface
{
    public function create(ImageProcessing $imageProcessing): void;

    public function delete(ImageProcessing $imageProcessing): void;

    public function getById(string $id): ?ImageProcessing;

    public function getByIdAndUserId(string $id, string $userId): ?ImageProcessing;

    /**
     * @return list<ImageProcessing>
     */
    public function getByUserId(string $userId): array;

    public function save(ImageProcessing $imageProcessing): void;
}
