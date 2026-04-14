<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Operation;

use App\Domain\ImageProcessing\Operation\ImageProcessingOperationType;
use App\Domain\ImageProcessing\Operation\RotateOperation;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class RotateOperationTest extends TestCase
{
    public function testRotateOperationSuccess(): void
    {
        $image = imagecreatetruecolor(20, 10);
        imagefill($image, 0, 0, imagecolorallocate($image, 255, 0, 0));

        $operation = new RotateOperation(
            angle: 90,
            type: ImageProcessingOperationType::Rotate,
        );

        $result = $operation->apply($image);

        $this->assertSame(10, imagesx($result));
        $this->assertSame(20, imagesy($result));
    }
}
