<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\CropOperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommandInterface;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\CropOperationRequest;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequestInterface;

final class CropOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationRequestInterface $request): bool
    {
        return $request instanceof CropOperationRequest;
    }

    /**
     * @param CropOperationRequest $request
     */
    public function map(OperationRequestInterface $request): OperationCommandInterface
    {
        return new CropOperationCommand(
            x: $request->x,
            y: $request->y,
            width: $request->width,
            height: $request->height,
        );
    }
}
