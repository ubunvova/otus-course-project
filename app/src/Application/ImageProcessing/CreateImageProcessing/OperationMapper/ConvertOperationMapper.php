<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\ConvertOperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\Domain\ImageProcessing\Operation\ConvertOperation;
use App\Domain\ImageProcessing\Operation\Operation;

final class ConvertOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationCommand $request): bool
    {
        return $request instanceof ConvertOperationCommand;
    }

    /**
     * @param ConvertOperationCommand $request
     */
    public function map(OperationCommand $request): Operation
    {
        return new ConvertOperation(
            format: $request->format,
            type: $request->type->toDomain(),
        );
    }
}
