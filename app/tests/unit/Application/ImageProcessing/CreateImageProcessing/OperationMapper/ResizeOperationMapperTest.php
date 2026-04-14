<?php

declare(strict_types=1);

namespace App\Tests\unit\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\ResizeOperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\OperationMapper\ResizeOperationMapper;
use App\Application\ImageProcessing\ImageProcessingOperationType;
use App\Domain\ImageProcessing\Operation\ResizeOperation;
use PHPUnit\Framework\TestCase;

class ResizeOperationMapperTest extends TestCase
{
    private ResizeOperationMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new ResizeOperationMapper();
    }

    public function testMapReturnsResizeOperation(): void
    {
        $command = new ResizeOperationCommand(
            width: 100,
            height: 200,
            type: ImageProcessingOperationType::Resize
        );

        $result = $this->mapper->map($command);

        $this->assertInstanceOf(ResizeOperation::class, $result);
        $this->assertEquals(100, $result->width);
        $this->assertEquals(200, $result->height);
    }

    public function testSupportsReturnsTrueForResizeOperationCommand(): void
    {
        $command = new ResizeOperationCommand(
            width: 100,
            height: 200,
            type: ImageProcessingOperationType::Resize
        );

        $result = $this->mapper->supports($command);

        $this->assertTrue($result);
    }
}