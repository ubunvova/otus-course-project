<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Rabbitmq\Consumer;

use App\Application\ImageProcessing\ProcessImageProcessing\ProcessImageProcessingHandler;
use App\Application\ImageProcessing\ProcessImageProcessing\ProcessImageProcessingMessage;
use App\Infrastructure\Persistence\Rabbitmq\AmqpConnectionFactory;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Serializer\SerializerInterface;

use function count;

final class ImageProcessingConsumer
{
    private const string QUEUE_NAME = 'image_processing.process';

    public function __construct(
        private AmqpConnectionFactory $factory,
        private SerializerInterface $serializer,
        private ProcessImageProcessingHandler $handler,
    ) {
    }

    public function consume(): void
    {
        $connection = $this->factory->createConnection();
        $channel = $connection->channel();

        $channel->basic_consume(
            queue: self::QUEUE_NAME,
            callback: function (AMQPMessage $msg) use ($channel): void {
                $dto = $this->serializer->deserialize(
                    $msg->body,
                    ProcessImageProcessingMessage::class,
                    'json',
                );

                $this->handler->handle($dto);

                $channel->basic_ack($msg->delivery_info['delivery_tag']);
            },
        );

        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }
}
