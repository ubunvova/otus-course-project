<?php

declare(strict_types=1);

namespace App\Infrastructure\File;

use finfo;
use GdImage;
use RuntimeException;

use const FILEINFO_MIME_TYPE;

readonly class ImageSaver
{
    public function __construct(
        private string $storagePath,
    ) {
    }

    public function save(string $id, string $filePath, GdImage $image): string
    {
        if (!is_dir($this->storagePath)) {
            mkdir($this->storagePath, 0o755, true);
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($filePath);

        if (!SupportedImageFormats::isAllowed($mime)) {
            throw new RuntimeException('Invalid file type');
        }

        $extension = SupportedImageFormats::extensionFor($mime);

        $path = $this->storagePath . '/' . $id . '.' . $extension;

        $saveFn = match ($mime) {
            'image/jpeg' => static fn () => imagejpeg($image, $path, 90),
            'image/png'  => static fn () => imagepng($image, $path),
            'image/webp' => static fn () => imagewebp($image, $path, 90),
            default      => throw new RuntimeException("Unsupported MIME: {$mime}"),
        };

        $saveFn();

        return $path;
    }
}
