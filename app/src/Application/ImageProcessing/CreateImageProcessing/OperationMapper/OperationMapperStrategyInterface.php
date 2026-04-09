<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\Domain\ImageProcessing\Operation\Operation;

interface OperationMapperStrategyInterface
{
    public function supports(OperationCommand $request): bool;

    public function map(OperationCommand $request): Operation;
}
