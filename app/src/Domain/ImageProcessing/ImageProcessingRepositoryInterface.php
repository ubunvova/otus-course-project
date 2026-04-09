<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing;

interface ImageProcessingRepositoryInterface
{
    public function create(ImageProcessing $imageProcessing): void;
}
