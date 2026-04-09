<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\ConvertOperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommandInterface;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\ConvertOperationRequest;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequestInterface;

final class ConvertOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationRequestInterface $request): bool
    {
        return $request instanceof ConvertOperationRequest;
    }

    /**
     * @param ConvertOperationRequest $request
     */
    public function map(OperationRequestInterface $request): OperationCommandInterface
    {
        return new ConvertOperationCommand(
            format: $request->format,
        );
    }
}
