<?php

declare(strict_types=1);

namespace App\Tests\unit\Application\ImageProcessing\ProcessImageProcessing\Service;

use App\Application\ImageProcessing\ProcessImageProcessing\Service\ImageProcessingOrchestrator;
use App\Domain\ImageProcessing\ImageProcessing;
use App\Domain\ImageProcessing\Operation\ImageProcessingOperationType;
use App\Domain\ImageProcessing\Operation\RotateOperation;
use App\Infrastructure\File\ImageLoader;
use App\Infrastructure\File\ImageSaver;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ImageProcessingOrchestratorTest extends TestCase
{
    private ImageLoader $imageLoader;
    private MockObject|ImageSaver $imageSaver;
    private ImageProcessingOrchestrator $imageProcessingOrchestrator;

    protected function setUp(): void
    {
        $this->imageLoader = new ImageLoader();
        $this->imageSaver = $this->createMock(ImageSaver::class);
        $this->imageSaver->method('save')->willReturn('/path/to/result');

        $this->imageProcessingOrchestrator = new ImageProcessingOrchestrator(
            $this->imageLoader,
            $this->imageSaver,
        );
    }

    public function testProcess(): void
    {
        $imageProcessing = ImageProcessing::create(
            userId: '1',
            filePath: '/var/www/html/app/tests/_data/test.jpg',
            operations: [
                new RotateOperation(90, ImageProcessingOperationType::Rotate),
            ],
        );

        $this->imageProcessingOrchestrator->process($imageProcessing);

        $this->assertEquals('/path/to/result', $imageProcessing->getResultFilePath());
    }
}
