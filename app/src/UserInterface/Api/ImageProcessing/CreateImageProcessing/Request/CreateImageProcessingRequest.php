<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request;

use App\UserInterface\Api\BodyRequestInterface;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\OperationRequest;
use Symfony\Component\Validator\Constraints as SymfonyAssert;

final readonly class CreateImageProcessingRequest implements BodyRequestInterface
{
    /**
     * @param list<OperationRequest> $operations
     */
    public function __construct(
        #[SymfonyAssert\Sequentially([
            new SymfonyAssert\NotNull(),
            new SymfonyAssert\Type('array'),
            new SymfonyAssert\Count(min: 1),
            new SymfonyAssert\All([
                new SymfonyAssert\NotNull(),
                new SymfonyAssert\Type(OperationRequest::class),
            ]),
        ])]
        public array $operations,
    ) {
    }
}
