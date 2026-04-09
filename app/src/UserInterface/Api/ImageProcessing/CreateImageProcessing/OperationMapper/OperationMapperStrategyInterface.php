<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommandInterface;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequestInterface;

interface OperationMapperStrategyInterface
{
    public function supports(OperationRequestInterface $request): bool;

    public function map(OperationRequestInterface $request): OperationCommandInterface;
}
