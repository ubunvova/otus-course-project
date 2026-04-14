<?php

declare(strict_types=1);

namespace App\Tests\unit\Domain\Operation;

use App\Domain\ImageProcessing\Operation\ImageProcessingOperationType;
use App\Domain\ImageProcessing\Operation\ResizeOperation;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ResizeOperationTest extends TestCase
{
    public function testResizeOperationSuccess(): void
    {
        $image = imagecreatetruecolor(10, 10);
        imagefill($image, 0, 0, imagecolorallocate($image, 255, 0, 0));

        $operation = new ResizeOperation(
            width: 5,
            height: 5,
            type: ImageProcessingOperationType::Resize,
        );

        $result = $operation->apply($image);

        $this->assertSame(5, imagesx($result));
        $this->assertSame(5, imagesy($result));
    }
}
