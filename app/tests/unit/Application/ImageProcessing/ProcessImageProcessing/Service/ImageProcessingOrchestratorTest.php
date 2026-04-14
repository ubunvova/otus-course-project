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
    private ImageProcessingOrchestrator $orchestrator;

    private string $tempImagePath;

    protected function setUp(): void
    {
        $this->tempImagePath = sys_get_temp_dir() . '/test_image_' . uniqid() . '.jpg';

        $image = imagecreatetruecolor(10, 10);
        imagejpeg($image, $this->tempImagePath);

        $this->imageLoader = new ImageLoader();

        $this->imageSaver = $this->createMock(ImageSaver::class);
        $this->imageSaver->method('save')->willReturn('/path/to/result');

        $this->orchestrator = new ImageProcessingOrchestrator(
            $this->imageLoader,
            $this->imageSaver,
        );
    }

    protected function tearDown(): void
    {
        if (file_exists($this->tempImagePath)) {
            unlink($this->tempImagePath);
        }
    }

    public function testProcess(): void
    {
        $imageProcessing = ImageProcessing::create(
            userId: '1',
            filePath: $this->tempImagePath,
            operations: [
                new RotateOperation(90, ImageProcessingOperationType::Rotate),
            ],
        );

        $this->orchestrator->process($imageProcessing);

        $this->assertSame('/path/to/result', $imageProcessing->getResultFilePath());
    }
}
