<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommandInterface;
use App\Application\ImageProcessing\CreateImageProcessing\Command\ResizeOperationCommand;
use App\Domain\ImageProcessing\Operation\OperationInterface;
use App\Domain\ImageProcessing\Operation\ResizeOperation;

final class ResizeOperationMapper implements OperationMapperStrategyInterface
{
    public function supports(OperationCommandInterface $request): bool
    {
        return $request instanceof ResizeOperationCommand;
    }

    /**
     * @param ResizeOperationCommand $request
     */
    public function map(OperationCommandInterface $request): OperationInterface
    {
        return new ResizeOperation(
            width: $request->width,
            height: $request->height,
        );
    }
}
