<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Rabbitmq;

use PhpAmqpLib\Connection\AMQPStreamConnection;

readonly class AmqpConnectionFactory
{
    public function __construct(
        private string $host,
        private string $port,
        private string $user,
        private string $password,
        private string $vhost = '/',
    ) {
    }

    public function createConnection(): AMQPStreamConnection
    {
        return new AMQPStreamConnection(
            host: $this->host,
            port: (int) $this->port,
            user: $this->user,
            password: $this->password,
            vhost: $this->vhost,
        );
    }
}
