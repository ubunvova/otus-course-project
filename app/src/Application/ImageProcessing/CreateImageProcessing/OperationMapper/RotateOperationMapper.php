<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\RotateOperationCommand;
use App\Domain\ImageProcessing\Operation\Operation;
use App\Domain\ImageProcessing\Operation\RotateOperation;

final class RotateOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationCommand $request): bool
    {
        return $request instanceof RotateOperationCommand;
    }

    /**
     * @param RotateOperationCommand $request
     */
    public function map(OperationCommand $request): Operation
    {
        return new RotateOperation(
            angle: $request->angle,
            type: $request->type->toDomain(),
        );
    }
}
