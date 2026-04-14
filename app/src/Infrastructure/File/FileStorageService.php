<?php

declare(strict_types=1);

namespace App\Infrastructure\File;

use finfo;
use RuntimeException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use const FILEINFO_MIME_TYPE;

final readonly class FileStorageService
{
    public function __construct(
        private string $storagePath,
    ) {
    }

    public function store(UploadedFile $file): string
    {
        if (!is_dir($this->storagePath)) {
            mkdir($this->storagePath, 0o755, true);
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file->getPathname());

        if (!SupportedImageFormats::isAllowed($mime)) {
            throw new RuntimeException('Invalid file type');
        }

        $extension = SupportedImageFormats::extensionFor($mime);

        $filename = uniqid('img_', true) . '.' . $extension;

        $file->move($this->storagePath, $filename);

        return $this->storagePath . '/' . $filename;
    }
}
