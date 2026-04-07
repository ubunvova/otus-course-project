<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Bus;

use App\Application\Bus\Command\CommandBusInterface;
use App\Application\Bus\Command\CommandInterface;
use App\Application\Bus\Command\ResultInterface;
use Override;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

readonly class MessengerCommandBus implements CommandBusInterface
{
    public function __construct(private MessageBusInterface $commandBus)
    {
    }

    #[Override]
    public function dispatch(CommandInterface $command): ?ResultInterface
    {
        try {
            return $this->commandBus
                ->dispatch($command)
                ->last(HandledStamp::class)
                ->getResult();
        } catch (HandlerFailedException $exception) {
            $exceptions = $exception->getWrappedExceptions();

            throw reset($exceptions) ?: $exception;
        }
    }
}
