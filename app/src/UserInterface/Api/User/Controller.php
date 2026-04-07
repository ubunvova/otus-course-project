<?php

declare(strict_types=1);

namespace App\UserInterface\Api\User;

use App\Application\Bus\Command\CommandBusInterface;
use App\Application\User\CreateUserCommand;
use App\UserInterface\Api\Response\JsonResponder;
use App\UserInterface\Api\User\Request\CreateUserRequest;
use App\UserInterface\Api\User\Response\CreateUserResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final readonly class Controller
{
    public function __construct(
        private JsonResponder $responder,
    ) {
    }

    #[Route('/user/create', methods: [Request::METHOD_POST])]
    public function __invoke(
        CommandBusInterface $commandBus,
        CreateUserRequest $httpRequest,
    ): JsonResponse {
        $appResponse = $commandBus->dispatch(new CreateUserCommand($httpRequest->name));

        return $this->responder->respondWith(new CreateUserResponse($appResponse->apiKey));
    }
}
