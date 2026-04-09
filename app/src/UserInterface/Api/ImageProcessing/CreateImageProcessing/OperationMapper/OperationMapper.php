<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\OperationCommandInterface;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequestInterface;
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
     * @param list<OperationRequestInterface> $requests
     *
     * @return list<OperationCommandInterface>
     */
    public function mapOperations(array $requests): array
    {
        $result = [];

        foreach ($requests as $request) {
            $result[] = $this->mapOperation($request);
        }

        return $result;
    }

    public function mapOperation(OperationRequestInterface $request): OperationCommandInterface
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($request)) {
                return $strategy->map($request);
            }
        }

        throw new LogicException('No mapper found for ' . $request::class);
    }
}
