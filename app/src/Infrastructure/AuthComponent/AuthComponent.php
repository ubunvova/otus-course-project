<?php

declare(strict_types=1);

namespace App\Infrastructure\AuthComponent;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthComponent
{
    public function __construct(
        private readonly RequestStack $requestStack,
    ) {
    }

    public function getApiKey(): string
    {
        $request = $this->requestStack->getCurrentRequest();

        $header = $request?->headers->get('Authorization');

        if (!$header || !str_starts_with($header, 'Bearer ')) {
            throw new UnauthorizedHttpException('Bearer token required');
        }

        return mb_substr($header, 7);
    }
}
