<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing\Operation;

use GdImage;

abstract class Operation
{
    public function __construct(
        public ImageProcessingOperationType $type,
    ) {
    }

    abstract public function apply(GdImage $image): GdImage;
}
