<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing;

interface ImageProcessingRepositoryInterface
{
    public function create(ImageProcessing $imageProcessing): void;

    public function update(ImageProcessing $imageProcessing): void;

    public function getById(string $id): ?ImageProcessing;

    public function save(ImageProcessing $imageProcessing): void;
}
