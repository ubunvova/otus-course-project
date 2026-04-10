<?php

declare(strict_types=1);

namespace App\Application\ImageProcessing\ProcessImageProcessing\OperationMapper;

use App\Domain\ImageProcessing\Operation\Operation;
use LogicException;

final readonly class OperationDbMapper
{
    /**
     * @param iterable<OperationDbMapperStrategyInterface> $strategies
     */
    public function __construct(
        private iterable $strategies,
    ) {
    }

    /**
     * @param array<int, array<string, mixed>> $dataOperations
     *
     * @return list<Operation>
     */
    public function mapOperations(array $dataOperations): array
    {
        $result = [];

        foreach ($dataOperations as $dataOperation) {
            $result[] = $this->mapOperation($dataOperation);
        }

        return $result;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function mapOperation(array $data): Operation
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($data)) {
                return $strategy->map($data);
            }
        }

        throw new LogicException('Unknown operation type: ' . $data['type']);
    }
}
