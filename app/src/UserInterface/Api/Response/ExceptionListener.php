<?php

declare(strict_types=1);

namespace App\UserInterface\Api\Response;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final readonly class ExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $response = new ErrorResponse(
            exception: $exception,
            data: json_encode([
                'error' => $exception->getMessage(),
            ]),
        );

        $event->setResponse($response);
    }
}
