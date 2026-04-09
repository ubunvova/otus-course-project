<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\ConvertOperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\ImageProcessingOperationType;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\ConvertOperationRequest;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequest;

final class ConvertOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationRequest $request): bool
    {
        return $request instanceof ConvertOperationRequest;
    }

    /**
     * @param ConvertOperationRequest $request
     */
    public function map(OperationRequest $request): OperationCommand
    {
        return new ConvertOperationCommand(
            format: $request->format,
            type: ImageProcessingOperationType::from($request->type),
        );
    }
}
