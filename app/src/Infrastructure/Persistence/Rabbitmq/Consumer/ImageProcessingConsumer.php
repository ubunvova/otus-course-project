<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Rabbitmq\Consumer;

use App\Application\ImageProcessing\ProcessImageProcessing\ProcessImageProcessingHandler;
use App\Application\ImageProcessing\ProcessImageProcessing\ProcessImageProcessingMessage;
use App\Infrastructure\Persistence\Rabbitmq\AmqpConnectionFactory;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

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
        while (true) {
            try {
                $this->runConsumer();
            } catch (Throwable) {
                sleep(1);
            }
        }
    }

    private function runConsumer(): void
    {
        $connection = $this->factory->createConnection();
        $channel = $connection->channel();

        $channel->queue_declare(
            queue: self::QUEUE_NAME,
            durable: true,
            auto_delete: false,
        );

        $channel->basic_consume(
            queue: self::QUEUE_NAME,
            callback: function (AMQPMessage $msg) use ($channel): void {
                try {
                    $dto = $this->serializer->deserialize(
                        $msg->body,
                        ProcessImageProcessingMessage::class,
                        'json',
                    );

                    $this->handler->handle($dto);

                    $channel->basic_ack($msg->delivery_info['delivery_tag']);
                } catch (Throwable) {
                    $channel->basic_reject($msg->delivery_info['delivery_tag'], false);
                }
            },
        );

        while (true) {
            try {
                $channel->wait();
            } catch (Throwable) {
                break;
            }
        }

        $channel->close();
        $connection->close();
    }
}
