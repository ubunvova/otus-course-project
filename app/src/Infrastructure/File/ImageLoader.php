<?php

declare(strict_types=1);

namespace App\Infrastructure\File;

use GdImage;
use RuntimeException;

readonly class ImageLoader
{
    public function load(string $path): GdImage
    {
        $info = getimagesize($path);

        if ($info === false) {
            throw new RuntimeException("Cannot read image info: {$path}");
        }

        return match ($info['mime']) {
            'image/jpeg' => imagecreatefromjpeg($path),
            'image/png'  => imagecreatefrompng($path),
            'image/gif'  => imagecreatefromgif($path),
            'image/webp' => imagecreatefromwebp($path),
            default      => throw new RuntimeException("Unsupported image type: {$info['mime']}"),
        };
    }
}
