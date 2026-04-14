<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Rabbitmq\Producer;

use App\Application\ImageProcessing\CreateImageProcessing\Message\ImageProcessingMessage;
use App\Infrastructure\Persistence\Rabbitmq\AmqpConnectionFactory;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;

use function sprintf;

final class ImageProcessingProducer extends AbstractProducer
{
    private const string EXCHANGE_NAME = 'image_processing';
    private const string ROUTING_KEY = 'process';
    private const string QUEUE_NAME = 'image_processing.process';

    public function __construct(
        LoggerInterface $logger,
        protected SerializerInterface $serializer,
        private readonly AmqpConnectionFactory $factory,
    ) {
        parent::__construct($logger, $serializer);
    }

    public function produce(ImageProcessingMessage $data): void
    {
        $this->handle($data);
    }

    protected function publish(string $message): void
    {
        $connection = $this->factory->createConnection();
        $channel = $connection->channel();

        $channel->exchange_declare(
            exchange: self::EXCHANGE_NAME,
            type: 'direct',
            durable: true,
            auto_delete: false,
        );

        $channel->queue_declare(
            queue: self::QUEUE_NAME,
            durable: true,
            auto_delete: false,
        );

        $channel->queue_bind(
            queue: self::QUEUE_NAME,
            exchange: self::EXCHANGE_NAME,
            routing_key: self::ROUTING_KEY,
        );

        $amqpMessage = new AMQPMessage(
            $message,
            ['delivery_mode' => 2],
        );

        $channel->basic_publish(
            msg: $amqpMessage,
            exchange: self::EXCHANGE_NAME,
            routing_key: self::ROUTING_KEY,
        );

        $channel->close();
        $connection->close();

        $this->logger->info(sprintf(
            'Message sent to exchange "%s" with routing key "%s": %s',
            self::EXCHANGE_NAME,
            self::ROUTING_KEY,
            $message,
        ));
    }
}
