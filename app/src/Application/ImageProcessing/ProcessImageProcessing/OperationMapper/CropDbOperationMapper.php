<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\ProcessImageProcessing\OperationMapper;

use App\Domain\ImageProcessing\Operation\CropOperation;
use App\Domain\ImageProcessing\Operation\ImageProcessingOperationType;
use App\Domain\ImageProcessing\Operation\Operation;

final class CropDbOperationMapper implements OperationDbMapperStrategyInterface
{
    /**
     * @param array{
     *     type: string,
     *     x: int,
     *     y: int,
     *     width: int,
     *     height: int
     * } $data
     */
    public function supports(array $data): bool
    {
        return $data['type'] === ImageProcessingOperationType::Crop->value;
    }

    /**
     * @param array{
     *     type: string,
     *     x: int,
     *     y: int,
     *     width: int,
     *     height: int
     * } $data
     */
    public function map(array $data): Operation
    {
        return new CropOperation(
            x: $data['x'],
            y: $data['y'],
            width: $data['width'],
            height: $data['height'],
            type: ImageProcessingOperationType::from($data['type']),
        );
    }
}
