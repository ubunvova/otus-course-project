<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\ImageProcessingOperationType;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\RotateOperationCommand;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequest;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\RotateOperationRequest;

final class RotateOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationRequest $request): bool
    {
        return $request instanceof RotateOperationRequest;
    }

    /**
     * @param RotateOperationRequest $request
     */
    public function map(OperationRequest $request): OperationCommand
    {
        return new RotateOperationCommand(
            angle: $request->angle,
            type: ImageProcessingOperationType::from($request->type),
        );
    }
}
