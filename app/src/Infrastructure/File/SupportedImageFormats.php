<?php

declare(strict_types=1);

namespace App\Infrastructure\File;

use RuntimeException;

use function in_array;

final class SupportedImageFormats
{
    public const array ALLOWED_MIME = [
        'image/jpeg',
        'image/png',
        'image/webp',
    ];

    public const array EXTENSIONS = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
        'image/webp' => 'webp',
    ];

    public static function isAllowed(string $mime): bool
    {
        return in_array($mime, self::ALLOWED_MIME, true);
    }

    public static function extensionFor(string $mime): string
    {
        return self::EXTENSIONS[$mime]
            ?? throw new RuntimeException("Unsupported MIME: {$mime}");
    }
}
