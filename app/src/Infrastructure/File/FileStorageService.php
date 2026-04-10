<?php

declare(strict_types=1);

namespace App\Infrastructure\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

final readonly class FileStorageService
{
    public function __construct(
        private string $storagePath,
    ) {
    }

    public function store(UploadedFile $file): string
    {
        if (!is_dir($this->storagePath)) {
            mkdir($this->storagePath, 0o777, true);
        }

        $filename = uniqid('img_', true) . '.' . $file->guessExtension();

        $file->move($this->storagePath, $filename);

        return $this->storagePath . '/' . $filename;
    }
}
