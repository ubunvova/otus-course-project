<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\CropOperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\Application\ImageProcessing\ImageProcessingOperationType;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\CropOperationRequest;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequest;

final class CropOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationRequest $request): bool
    {
        return $request instanceof CropOperationRequest;
    }

    /**
     * @param CropOperationRequest $request
     */
    public function map(OperationRequest $request): OperationCommand
    {
        return new CropOperationCommand(
            x: $request->x,
            y: $request->y,
            width: $request->width,
            height: $request->height,
            type: ImageProcessingOperationType::from($request->type),
        );
    }
}
