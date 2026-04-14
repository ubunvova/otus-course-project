<?php

declare(strict_types=1);

namespace App\UserInterface\Api\Response;

use DomainException;
use LogicException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

final class ErrorResponse extends JsonResponse
{
    public function __construct(Throwable $exception, string $data)
    {
        parent::__construct($data, $this->detectStatusCode($exception), json: true);
    }

    private function detectStatusCode(Throwable $exception): int
    {
        return match (true) {
            $exception instanceof DomainException => Response::HTTP_BAD_REQUEST,
            $exception instanceof HttpException => $exception->getStatusCode(),
            $exception instanceof LogicException => Response::HTTP_NOT_FOUND,
            default => Response::HTTP_INTERNAL_SERVER_ERROR,
        };
    }
}
