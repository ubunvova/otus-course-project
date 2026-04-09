<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\Message;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;

final class ImageProcessingMessage
{
    /**
     * @param list<OperationCommand> $operations
     */
    public function __construct(
        public string $id,
        public string $userId,
        public string $filePath,
        public array $operations,
    ) {
    }
}
