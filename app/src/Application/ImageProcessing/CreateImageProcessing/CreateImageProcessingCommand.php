<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing;

use App\Application\Bus\Command\CommandInterface;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommandInterface;

/**
 * @implements CommandInterface<null>
 */
final readonly class CreateImageProcessingCommand implements CommandInterface
{
    /**
     * @param list<OperationCommandInterface> $operations
     */
    public function __construct(
        public string $userId,
        public string $filePath,
        public array $operations,
    ) {
    }
}
