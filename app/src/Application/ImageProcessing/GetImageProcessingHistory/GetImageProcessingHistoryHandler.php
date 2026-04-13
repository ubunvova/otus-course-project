<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\GetImageProcessingHistory;

use App\Application\ImageProcessing\GetImageProcessingHistory\Output\ImageProcessingOutput;
use App\Application\ImageProcessing\ImageProcessingStatus;
use App\Domain\ImageProcessing\ImageProcessingRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

final class GetImageProcessingHistoryHandler
{
    public function __construct(
        private ImageProcessingRepositoryInterface $imageProcessingRepository,
    ) {
    }

    #[AsMessageHandler]
    public function __invoke(GetImageProcessingHistoryCommand $command): GetImageProcessingHistoryOutput
    {
        $imageProcessings = $this->imageProcessingRepository->getByUserId($command->userId);

        $imageProcessingOutput = array_map(
            static fn ($imageProcessing) => new ImageProcessingOutput(
                id: $imageProcessing->getId(),
                status: ImageProcessingStatus::from($imageProcessing->getStatus()),
                createdAt: $imageProcessing->getCreatedAt(),
                updatedAt: $imageProcessing->getUpdatedAt(),
            ),
            $imageProcessings,
        );

        return new GetImageProcessingHistoryOutput($imageProcessingOutput);
    }
}
