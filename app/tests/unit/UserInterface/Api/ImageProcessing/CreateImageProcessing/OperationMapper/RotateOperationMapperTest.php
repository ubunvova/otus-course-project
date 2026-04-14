<?php

declare(strict_types=1);

namespace App\Tests\unit\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\RotateOperationCommand;
use App\Application\ImageProcessing\ImageProcessingOperationType;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper\RotateOperationMapper;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\RotateOperationRequest;
use PHPUnit\Framework\TestCase;

class RotateOperationMapperTest extends TestCase
{
    private RotateOperationMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new RotateOperationMapper();
    }

    public function testMapReturnsRotateCommand(): void
    {
        $request = new RotateOperationRequest();
        $request->angle = 90;
        $request->type = ImageProcessingOperationType::Rotate->value;

        $result = $this->mapper->map($request);

        $this->assertInstanceOf(RotateOperationCommand::class, $result);
        $this->assertEquals(90, $result->angle);
        $this->assertEquals(ImageProcessingOperationType::Rotate, $result->type);
    }

    public function testSupportsReturnsTrueForRotateOperationRequest(): void
    {
        $request = new RotateOperationRequest();
        $request->angle = 90;
        $request->type = ImageProcessingOperationType::Rotate->value;

        $result = $this->mapper->supports($request);

        $this->assertTrue($result);
    }
}