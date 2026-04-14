<?php

declare(strict_types=1);

namespace App\Tests\unit\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\CropOperationCommand;
use App\Application\ImageProcessing\ImageProcessingOperationType;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper\CropOperationMapper;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\CropOperationRequest;
use PHPUnit\Framework\TestCase;

class CropOperationMapperTest extends TestCase
{
    private CropOperationMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new CropOperationMapper();
    }

    public function testMapReturnsCropCommand(): void
    {
        $request = new CropOperationRequest();
        $request->x = 10;
        $request->y = 20;
        $request->width = 100;
        $request->height = 150;
        $request->type = ImageProcessingOperationType::Crop->value;

        $result = $this->mapper->map($request);

        $this->assertInstanceOf(CropOperationCommand::class, $result);
        $this->assertEquals(10, $result->x);
        $this->assertEquals(20, $result->y);
        $this->assertEquals(100, $result->width);
        $this->assertEquals(150, $result->height);
        $this->assertEquals(ImageProcessingOperationType::Crop, $result->type);
    }

    public function testSupportsReturnsTrueForCropOperationRequest(): void
    {
        $request = new CropOperationRequest();
        $request->x = 10;
        $request->y = 20;
        $request->width = 100;
        $request->height = 150;
        $request->type = ImageProcessingOperationType::Crop->value;

        $result = $this->mapper->supports($request);

        $this->assertTrue($result);
    }
}