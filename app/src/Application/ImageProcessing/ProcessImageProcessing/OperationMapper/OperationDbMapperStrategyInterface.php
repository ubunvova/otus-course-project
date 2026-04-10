<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\ProcessImageProcessing\OperationMapper;

use App\Domain\ImageProcessing\Operation\Operation;

interface OperationDbMapperStrategyInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function supports(array $data): bool;

    /**
     * @param array<string, mixed> $data
     */
    public function map(array $data): Operation;
}
