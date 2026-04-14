<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing;

use App\Application\Bus\Command\CommandBusInterface;
use App\Application\ImageProcessing\CreateImageProcessing\CreateImageProcessingCommand;
use App\Application\ImageProcessing\GetImageProcessing\GetImageProcessingCommand;
use App\Application\ImageProcessing\GetImageProcessingHistory\GetImageProcessingHistoryCommand;
use App\Infrastructure\File\FileStorageService;
use App\Infrastructure\Persistence\Doctrine\Request\UserExtractor;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper\OperationMapper;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\CreateImageProcessingRequest;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Response\CreateImageProcessingResponse;
use App\UserInterface\Api\ImageProcessing\GetImageProcessingHistory\Response\GetImageProcessingHistoryResponse;
use App\UserInterface\Api\Response\JsonResponder;
use LogicException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final readonly class Controller
{
    public function __construct(
        private FileStorageService $fileStorageService,
        private OperationMapper $operationMapper,
        private UserExtractor $userExtractor,
        private CommandBusInterface $commandBus,
        private JsonResponder $responder,
    ) {
    }

    #[Route('/image_processing/create', methods: [Request::METHOD_POST])]
    public function create(
        Request $request,
        CreateImageProcessingRequest $httpRequest,
    ): JsonResponse {
        $user = $this->userExtractor->getUser();

        $image = $request->files->get('image');

        if (!$image) {
            throw new BadRequestHttpException('Image file is required');
        }

        $saveFilePath = $this->fileStorageService->store($image);

        $imageProcessing = $this->commandBus->dispatch(
            new CreateImageProcessingCommand(
                userId: $user->getId(),
                filePath: $saveFilePath,
                operations: $this->operationMapper->mapOperations($httpRequest->operations),
            ),
        );

        return $this->responder->respondWith(new CreateImageProcessingResponse($imageProcessing->id));
    }

    #[Route('/image_processing/history', methods: [Request::METHOD_GET])]
    public function getHistory(): JsonResponse
    {
        $user = $this->userExtractor->getUser();

        $imageProcessingHistory = $this->commandBus->dispatch(
            new GetImageProcessingHistoryCommand(
                userId: $user->getId(),
            ),
        );

        return $this->responder->respondWith(new GetImageProcessingHistoryResponse($imageProcessingHistory->imageProcessing));
    }

    #[Route('/image_processing/{id}', methods: [Request::METHOD_GET])]
    public function get(string $id): BinaryFileResponse
    {
        $user = $this->userExtractor->getUser();

        $imageProcessingHistory = $this->commandBus->dispatch(
            new GetImageProcessingCommand(
                id: $id,
                userId: $user->getId(),
            ),
        );

        $resultFilePath = $imageProcessingHistory->resultFilePath;

        if (!is_file($resultFilePath)) {
            throw new LogicException('Result file not found', 404);
        }

        return new BinaryFileResponse($resultFilePath);
    }
}
