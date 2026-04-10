<?php

declare(strict_types=1);

namespace App\Domain\ImageProcessing\Operation;

use GdImage;
use RuntimeException;

final class CropOperation extends Operation
{
    public function __construct(
        public int $x,
        public int $y,
        public int $width,
        public int $height,
        ImageProcessingOperationType $type,
    ) {
        parent::__construct(
            type: $type,
        );
    }

    public function apply(GdImage $image): GdImage
    {
        $cropped = imagecrop($image, [
            'x' => $this->x,
            'y' => $this->y,
            'width' => $this->width,
            'height' => $this->height,
        ]);

        if ($cropped === false) {
            throw new RuntimeException('Crop operation failed');
        }

        return $cropped;
    }
}
