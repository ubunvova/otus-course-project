<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommandInterface;
use App\Domain\ImageProcessing\Operation\OperationInterface;

interface OperationMapperStrategyInterface
{
    public function supports(OperationCommandInterface $request): bool;

    public function map(OperationCommandInterface $request): OperationInterface;
}
