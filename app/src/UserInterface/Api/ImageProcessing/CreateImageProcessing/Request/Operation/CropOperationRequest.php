<?php

declare(strict_types=1);

namespace App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation;

use Symfony\Component\Validator\Constraints as SymfonyAssert;

final class CropOperationRequest extends OperationRequest
{
    #[SymfonyAssert\Sequentially([
        new SymfonyAssert\NotBlank(),
        new SymfonyAssert\Type('int'),
    ])]
    public int $x;
    #[SymfonyAssert\Sequentially([
        new SymfonyAssert\NotBlank(),
        new SymfonyAssert\Type('int'),
    ])]
    public int $y;
    #[SymfonyAssert\Sequentially([
        new SymfonyAssert\NotBlank(),
        new SymfonyAssert\Type('int'),
    ])]
    public int $width;
    #[SymfonyAssert\Sequentially([
        new SymfonyAssert\NotBlank(),
        new SymfonyAssert\Type('int'),
    ])]
    public int $height;
}
