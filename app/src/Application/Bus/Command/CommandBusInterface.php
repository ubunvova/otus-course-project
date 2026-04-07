<?php

declare(strict_types=1);

namespace App\Application\Bus\Command;

interface CommandBusInterface
{
    /**
     * @template TResult of ?ResultInterface
     *
     * @param CommandInterface<TResult> $command
     *
     * @return (TResult&ResultInterface)|null
     */
    public function dispatch(CommandInterface $command): ?ResultInterface;
}
