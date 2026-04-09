<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommand;
use App\Domain\ImageProcessing\Operation\Operation;
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
     * @param list<OperationCommand> $requests
     *
     * @return list<Operation>
     */
    public function mapOperations(array $requests): array
    {
        $result = [];

        foreach ($requests as $request) {
            $result[] = $this->mapOperation($request);
        }

        return $result;
    }

    public function mapOperation(OperationCommand $request): Operation
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($request)) {
                return $strategy->map($request);
            }
        }

        throw new LogicException('No mapper found for ' . $request::class);
    }
}
