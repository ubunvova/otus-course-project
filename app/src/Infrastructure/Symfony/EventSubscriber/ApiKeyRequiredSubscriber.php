<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\EventSubscriber;

use App\Application\User\UserExtractorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ApiKeyRequiredSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private UserExtractorInterface $userExtractor,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 10],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();

        if ($request->getMethod() === 'OPTIONS') {
            return;
        }

        if ($request->getPathInfo() === '/user/create') {
            return;
        }

        $this->userExtractor->getUser();
    }
}
