<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing\Operation;

use GdImage;
use RuntimeException;

final class RotateOperation extends Operation
{
    public function __construct(
        public int $angle,
        ImageProcessingOperationType $type,
    ) {
        parent::__construct(
            type: $type,
        );
    }

    public function apply(GdImage $image): GdImage
    {
        $rotated = imagerotate($image, $this->angle, 0);

        if ($rotated === false) {
            throw new RuntimeException('Rotate operation failed');
        }

        return $rotated;
    }
}
