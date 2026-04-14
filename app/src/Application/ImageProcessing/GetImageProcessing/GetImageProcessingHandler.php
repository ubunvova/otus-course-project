<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\GetImageProcessing;

use App\Domain\ImageProcessing\ImageProcessingRepositoryInterface;
use LogicException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

final class GetImageProcessingHandler
{
    public function __construct(
        private ImageProcessingRepositoryInterface $imageProcessingRepository,
    ) {
    }

    #[AsMessageHandler]
    public function __invoke(GetImageProcessingCommand $command): GetImageProcessingOutput
    {
        $imageProcessing = $this->imageProcessingRepository->getByIdAndUserId($command->id, $command->userId);

        if (!$imageProcessing) {
            throw new LogicException('No image processing found');
        }

        if (!$imageProcessing->getResultFilePath()) {
            throw new LogicException('No image processing result file found');
        }

        return new GetImageProcessingOutput($imageProcessing->getResultFilePath());
    }
}
