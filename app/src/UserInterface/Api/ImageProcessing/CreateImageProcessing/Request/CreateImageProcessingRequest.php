<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request;

use App\UserInterface\Api\BodyRequestInterface;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequestInterface;
use Symfony\Component\Validator\Constraints as SymfonyAssert;

final readonly class CreateImageProcessingRequest implements BodyRequestInterface
{
    /**
     * @param list<OperationRequestInterface> $operations
     */
    public function __construct(
        #[SymfonyAssert\Sequentially([
            new SymfonyAssert\NotNull(),
            new SymfonyAssert\Type('array'),
            new SymfonyAssert\Count(min: 1),
            new SymfonyAssert\All([
                new SymfonyAssert\NotNull(),
                new SymfonyAssert\Type(OperationRequestInterface::class),
            ]),
        ])]
        public array $operations,
    ) {
    }
}
