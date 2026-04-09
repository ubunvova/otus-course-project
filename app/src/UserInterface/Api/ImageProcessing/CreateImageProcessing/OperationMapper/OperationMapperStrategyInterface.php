<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequest;

interface OperationMapperStrategyInterface
{
    public function supports(OperationRequest $request): bool;

    public function map(OperationRequest $request): OperationCommand;
}
