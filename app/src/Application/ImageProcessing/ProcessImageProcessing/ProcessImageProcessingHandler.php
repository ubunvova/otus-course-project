<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\ProcessImageProcessing;

use App\Application\ImageProcessing\ProcessImageProcessing\Service\ImageProcessingOrchestrator;
use App\Domain\ImageProcessing\ImageProcessingRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

final class ProcessImageProcessingHandler
{
    public function __construct(
        private ImageProcessingRepositoryInterface $imageProcessingRepository,
        private ImageProcessingOrchestrator $imageProcessingOrchestrator,
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function handle(ProcessImageProcessingMessage $message): void
    {
        $imageProcessing = $this->imageProcessingRepository->getById($message->id);

        $imageProcessing->markProcessingStatus();
        $this->imageProcessingRepository->save($imageProcessing);

        try {
            $this->imageProcessingOrchestrator->process($imageProcessing);
            $imageProcessing->markCompletedStatus();
        } catch (Throwable) {
            $imageProcessing->markFailedStatus();
        }

        $this->imageProcessingRepository->update($imageProcessing);
        $this->entityManager->flush();
    }
}
