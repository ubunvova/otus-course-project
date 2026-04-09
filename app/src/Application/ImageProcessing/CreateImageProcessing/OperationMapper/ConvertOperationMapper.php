<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\ConvertOperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommandInterface;
use App\Domain\ImageProcessing\Operation\ConvertOperation;
use App\Domain\ImageProcessing\Operation\OperationInterface;

final class ConvertOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationCommandInterface $request): bool
    {
        return $request instanceof ConvertOperationCommand;
    }

    /**
     * @param ConvertOperationCommand $request
     */
    public function map(OperationCommandInterface $request): OperationInterface
    {
        return new ConvertOperation(
            format: $request->format,
        );
    }
}
