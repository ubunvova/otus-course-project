<?php

declare(strict_types=1);

namespace App\Tests\unit\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\CropOperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\OperationMapper\CropOperationMapper;
use App\Application\ImageProcessing\ImageProcessingOperationType;
use App\Domain\ImageProcessing\Operation\CropOperation;
use PHPUnit\Framework\TestCase;

class CropOperationMapperTest extends TestCase
{
    private CropOperationMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new CropOperationMapper();
    }

    public function testMapReturnsCropOperation(): void
    {
        $command = new CropOperationCommand(
            x: 10,
            y: 20,
            width: 100,
            height: 150,
            type: ImageProcessingOperationType::Crop
        );

        $result = $this->mapper->map($command);

        $this->assertInstanceOf(CropOperation::class, $result);
        $this->assertEquals(10, $result->x);
        $this->assertEquals(20, $result->y);
        $this->assertEquals(100, $result->width);
        $this->assertEquals(150, $result->height);
    }

    public function testSupportsReturnsTrueForCropOperationCommand(): void
    {
        $command = new CropOperationCommand(
            x: 10,
            y: 20,
            width: 100,
            height: 150,
            type: ImageProcessingOperationType::Crop
        );

        $result = $this->mapper->supports($command);

        $this->assertTrue($result);
    }
}