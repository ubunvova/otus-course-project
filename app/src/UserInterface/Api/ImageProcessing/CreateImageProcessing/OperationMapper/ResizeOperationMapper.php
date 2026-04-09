<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\ImageProcessingOperationType;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\ResizeOperationCommand;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequest;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\ResizeOperationRequest;

final class ResizeOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationRequest $request): bool
    {
        return $request instanceof ResizeOperationRequest;
    }

    /**
     * @param ResizeOperationRequest $request
     */
    public function map(OperationRequest $request): OperationCommand
    {
        return new ResizeOperationCommand(
            width: $request->width,
            height: $request->height,
            type: ImageProcessingOperationType::from($request->type),
        );
    }
}
