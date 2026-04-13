<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\GetImageProcessing;

use App\Application\Bus\Command\CommandInterface;

/**
 * @implements CommandInterface<GetImageProcessingOutput>
 */
final readonly class GetImageProcessingCommand implements CommandInterface
{
    public function __construct(
        public string $id,
        public string $userId,
    ) {
    }
}
