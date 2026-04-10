<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\ProcessImageProcessing\OperationMapper;

use App\Domain\ImageProcessing\Operation\ImageProcessingOperationType;
use App\Domain\ImageProcessing\Operation\Operation;
use App\Domain\ImageProcessing\Operation\ResizeOperation;

final class ResizeDbOperationMapper implements OperationDbMapperStrategyInterface
{
    /**
     * @param array{
     *     type: string,
     *     width: int,
     *     height: int
     * } $data
     */
    public function supports(array $data): bool
    {
        return $data['type'] === ImageProcessingOperationType::Resize->value;
    }

    /**
     * @param array{
     *     type: string,
     *     width: int,
     *     height: int
     * } $data
     */
    public function map(array $data): Operation
    {
        return new ResizeOperation(
            width: $data['width'],
            height: $data['height'],
            type: ImageProcessingOperationType::from($data['type']),
        );
    }
}
