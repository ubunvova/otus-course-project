<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\CropOperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\Domain\ImageProcessing\Operation\CropOperation;
use App\Domain\ImageProcessing\Operation\Operation;

final class CropOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationCommand $request): bool
    {
        return $request instanceof CropOperationCommand;
    }

    /**
     * @param CropOperationCommand $request
     */
    public function map(OperationCommand $request): Operation
    {
        return new CropOperation(
            x: $request->x,
            y: $request->y,
            width: $request->width,
            height: $request->height,
            type: $request->type->toDomain(),
        );
    }
}
