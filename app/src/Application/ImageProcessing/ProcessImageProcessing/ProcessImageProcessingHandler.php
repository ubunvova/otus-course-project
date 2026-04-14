<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\ProcessImageProcessing;

use App\Application\Common\FlusherInterface;
use App\Application\ImageProcessing\ProcessImageProcessing\Service\ImageProcessingOrchestrator;
use App\Domain\ImageProcessing\ImageProcessingRepositoryInterface;
use LogicException;
use Throwable;

final class ProcessImageProcessingHandler
{
    public function __construct(
        private ImageProcessingRepositoryInterface $imageProcessingRepository,
        private ImageProcessingOrchestrator $imageProcessingOrchestrator,
        private FlusherInterface $flusher,
    ) {
    }

    public function handle(ProcessImageProcessingMessage $message): void
    {
        $imageProcessing = $this->imageProcessingRepository->getById($message->id);

        if (!$imageProcessing) {
            throw new LogicException('No image processing found');
        }

        $imageProcessing->markProcessingStatus();
        $this->imageProcessingRepository->save($imageProcessing);

        try {
            $this->imageProcessingOrchestrator->process($imageProcessing);
            $imageProcessing->markCompletedStatus();
        } catch (Throwable) {
            $imageProcessing->markFailedStatus();
        }

        $this->imageProcessingRepository->save($imageProcessing);
        $this->flusher->flush();
    }
}
