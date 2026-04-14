<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing;

use App\Application\Bus\Command\CommandInterface;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;

/**
 * @implements CommandInterface<CreateImageProcessingOutput>
 */
final readonly class CreateImageProcessingCommand implements CommandInterface
{
    /**
     * @param list<OperationCommand> $operations
     */
    public function __construct(
        public string $userId,
        public string $filePath,
        public array $operations,
    ) {
    }
}
