<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation;

use Symfony\Component\Validator\Constraints as SymfonyAssert;

final class ConvertOperationRequest implements OperationRequestInterface
{
    public function __construct(
        #[SymfonyAssert\Sequentially([
            new SymfonyAssert\NotBlank(),
            new SymfonyAssert\Type('string'),
        ])]
        public string $format,
    ) {
    }
}
