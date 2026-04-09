<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing;

use App\Application\ImageProcessing\CreateImageProcessing\Message\ImageProcessingMessage;
use App\Application\ImageProcessing\CreateImageProcessing\OperationMapper\OperationMapper;
use App\Domain\ImageProcessing\ImageProcessing;
use App\Domain\ImageProcessing\ImageProcessingRepositoryInterface;
use App\Infrastructure\Persistence\Rabbitmq\Producer\ImageProcessingProducer;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

final readonly class CreateImageProcessingHandler
{
    public function __construct(
        private ImageProcessingRepositoryInterface $imageProcessingRepository,
        private ImageProcessingProducer $imageProcessingProducer,
        private OperationMapper $operationMapper,
    ) {
    }

    #[AsMessageHandler]
    public function __invoke(CreateImageProcessingCommand $command): void
    {
        $imageProcessing = ImageProcessing::create(
            userId: $command->userId,
            filePath: $command->filePath,
            operations: $this->operationMapper->mapOperations($command->operations),
        );

        $this->imageProcessingRepository->create($imageProcessing);

        $this->imageProcessingProducer->produce(
            new ImageProcessingMessage(
                id: $imageProcessing->getId(),
                userId: $command->userId,
                filePath: $command->filePath,
                operations: $command->operations,
            ),
        );
    }
}
