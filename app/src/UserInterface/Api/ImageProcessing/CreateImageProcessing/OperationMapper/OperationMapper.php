<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequest;
use LogicException;

final readonly class OperationMapper
{
    /**
     * @param iterable<OperationMapperStrategyInterface> $strategies
     */
    public function __construct(
        private iterable $strategies,
    ) {
    }

    /**
     * @param list<OperationRequest> $requests
     *
     * @return list<OperationCommand>
     */
    public function mapOperations(array $requests): array
    {
        $result = [];

        foreach ($requests as $request) {
            $result[] = $this->mapOperation($request);
        }

        return $result;
    }

    public function mapOperation(OperationRequest $request): OperationCommand
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($request)) {
                return $strategy->map($request);
            }
        }

        throw new LogicException('No mapper found for ' . $request::class);
    }
}
