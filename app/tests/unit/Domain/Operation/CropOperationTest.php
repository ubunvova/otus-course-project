<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Operation;

use App\Domain\ImageProcessing\Operation\CropOperation;
use App\Domain\ImageProcessing\Operation\ImageProcessingOperationType;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class CropOperationTest extends TestCase
{
    public function testCropOperationSuccess(): void
    {
        $image = imagecreatetruecolor(10, 10);
        imagefill($image, 0, 0, imagecolorallocate($image, 255, 0, 0));

        $operation = new CropOperation(
            x: 0,
            y: 0,
            width: 5,
            height: 5,
            type: ImageProcessingOperationType::Crop,
        );

        $result = $operation->apply($image);

        $this->assertSame(5, imagesx($result));
        $this->assertSame(5, imagesy($result));
    }
}
