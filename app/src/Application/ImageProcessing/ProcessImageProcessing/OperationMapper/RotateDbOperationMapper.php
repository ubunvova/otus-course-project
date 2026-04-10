<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\ProcessImageProcessing\OperationMapper;

use App\Domain\ImageProcessing\Operation\ImageProcessingOperationType;
use App\Domain\ImageProcessing\Operation\Operation;
use App\Domain\ImageProcessing\Operation\RotateOperation;

final class RotateDbOperationMapper implements OperationDbMapperStrategyInterface
{
    /**
     * @param array{
     *     type: string,
     *     angle: int
     * } $data
     */
    public function supports(array $data): bool
    {
        return $data['type'] === ImageProcessingOperationType::Rotate->value;
    }

    /**
     * @param array{
     *     type: string,
     *     angle: int
     * } $data
     */
    public function map(array $data): Operation
    {
        return new RotateOperation(
            angle: $data['angle'],
            type: ImageProcessingOperationType::from($data['type']),
        );
    }
}
