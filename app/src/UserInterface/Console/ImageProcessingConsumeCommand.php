<?php

declare(strict_types=1);

namespace App\UserInterface\Console;

use App\Infrastructure\Persistence\Rabbitmq\Consumer\ImageProcessingConsumer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:image-processing:consume',
    description: 'Consume image processing messages',
)]
class ImageProcessingConsumeCommand extends Command
{
    public function __construct(
        private ImageProcessingConsumer $consumer,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->consumer->consume();

        return Command::SUCCESS;
    }
}
