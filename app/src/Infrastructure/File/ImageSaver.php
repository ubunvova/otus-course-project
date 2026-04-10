<?php

declare(strict_types=1);

namespace App\Infrastructure\File;

use GdImage;

final readonly class ImageSaver
{
    public function __construct(
        private string $storagePath,
    ) {
    }

    public function save(string $id, GdImage $image, string $format = 'jpeg'): string
    {
        if (!is_dir($this->storagePath)) {
            mkdir($this->storagePath, 0o777, true);
        }

        $path = $this->storagePath . '/' . $id . '.' . $format;

        imagejpeg($image, $path, 90);

        return $path;
    }
}
