<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\ProcessImageProcessing\Service;

use App\Domain\ImageProcessing\ImageProcessing;
use App\Infrastructure\File\ImageLoader;
use App\Infrastructure\File\ImageSaver;

final readonly class ImageProcessingOrchestrator
{
    public function __construct(
        private ImageLoader $imageLoader,
        private ImageSaver $imageSaver,
    ) {
    }

    public function process(ImageProcessing $imageProcessing): void
    {
        $image = $this->imageLoader->load($imageProcessing->getFilePath());

        foreach ($imageProcessing->getOperations() as $operation) {
            $image = $operation->apply($image);
        }

        $resultFilePath = $this->imageSaver->save($imageProcessing->getId(), $imageProcessing->getFilePath(), $image);
        $imageProcessing->setResultFilePath($resultFilePath);
    }
}
