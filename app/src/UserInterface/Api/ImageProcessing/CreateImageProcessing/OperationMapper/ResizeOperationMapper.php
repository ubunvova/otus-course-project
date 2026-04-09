<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommandInterface;
use App\Application\ImageProcessing\CreateImageProcessing\Command\ResizeOperationCommand;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequestInterface;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\ResizeOperationRequest;

final class ResizeOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationRequestInterface $request): bool
    {
        return $request instanceof ResizeOperationRequest;
    }

    /**
     * @param ResizeOperationRequest $request
     */
    public function map(OperationRequestInterface $request): OperationCommandInterface
    {
        return new ResizeOperationCommand(
            width: $request->width,
            height: $request->height,
        );
    }
}
