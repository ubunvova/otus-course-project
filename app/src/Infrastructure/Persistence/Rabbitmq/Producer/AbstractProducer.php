<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Rabbitmq\Producer;

use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

abstract class AbstractProducer
{
    public function __construct(
        protected readonly LoggerInterface $logger,
        protected SerializerInterface $serializer,
    ) {
    }

    protected function handle(object $dto): void
    {
        try {
            $json = $this->serializer->serialize($dto, 'json');
            $this->publish($json);
        } catch (Throwable $exception) {
            $this->logger->error('Producer error: ' . $exception->getMessage());
            throw $exception;
        }
    }

    abstract protected function publish(string $message): void;
}
