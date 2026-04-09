<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing;

use App\Application\Bus\Command\CommandBusInterface;
use App\Application\ImageProcessing\CreateImageProcessing\CreateImageProcessingCommand;
use App\Infrastructure\File\FileStorageService;
use App\Infrastructure\Persistence\Doctrine\Request\UserExtractor;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper\OperationMapper;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\CreateImageProcessingRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        $this->commandBus->dispatch(
            new CreateImageProcessingCommand(
                userId: $user->getId(),
                filePath: $saveFilePath,
                operations: $this->operationMapper->mapOperations($httpRequest->operations),
            ),
        );

        return new JsonResponse(Response::HTTP_NO_CONTENT);
    }
}
