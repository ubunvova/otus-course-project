<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\GetImageProcessingHistory;

use App\Application\Bus\Command\CommandInterface;

/**
 * @implements CommandInterface<GetImageProcessingHistoryOutput>
 */
final readonly class GetImageProcessingHistoryCommand implements CommandInterface
{
    public function __construct(
        public string $userId,
    ) {
    }
}
