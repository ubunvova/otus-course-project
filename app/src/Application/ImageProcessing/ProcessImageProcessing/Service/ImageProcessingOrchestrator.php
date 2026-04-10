<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\ProcessImageProcessing\Service;

use App\Application\ImageProcessing\ProcessImageProcessing\OperationMapper\OperationDbMapper;
use App\Domain\ImageProcessing\ImageProcessing;
use App\Infrastructure\File\ImageLoader;
use App\Infrastructure\File\ImageSaver;

final readonly class ImageProcessingOrchestrator
{
    public function __construct(
        private OperationDbMapper $operationDbMapper,
        private ImageLoader $imageLoader,
        private ImageSaver $imageSaver,
    ) {
    }

    public function process(ImageProcessing $imageProcessing): void
    {
        $operations = $this->operationDbMapper->mapOperations($imageProcessing->getOperations());

        $image = $this->imageLoader->load($imageProcessing->getFilePath());

        foreach ($operations as $operation) {
            $image = $operation->apply($image);
        }

        $resultFilePath = $this->imageSaver->save($imageProcessing->getId(), $image);
        $imageProcessing->setResultFilePath($resultFilePath);
    }
}
