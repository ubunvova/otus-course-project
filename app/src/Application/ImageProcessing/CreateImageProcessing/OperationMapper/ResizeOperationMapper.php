<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\ResizeOperationCommand;
use App\Domain\ImageProcessing\Operation\Operation;
use App\Domain\ImageProcessing\Operation\ResizeOperation;

final class ResizeOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationCommand $request): bool
    {
        return $request instanceof ResizeOperationCommand;
    }

    /**
     * @param ResizeOperationCommand $request
     */
    public function map(OperationCommand $request): Operation
    {
        return new ResizeOperation(
            width: $request->width,
            height: $request->height,
            type: $request->type->toDomain(),
        );
    }
}
