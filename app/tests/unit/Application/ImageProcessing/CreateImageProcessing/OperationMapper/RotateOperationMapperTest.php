<?php

declare(strict_types=1);

namespace App\Tests\unit\Application\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\RotateOperationCommand;
use App\Application\ImageProcessing\CreateImageProcessing\OperationMapper\RotateOperationMapper;
use App\Application\ImageProcessing\ImageProcessingOperationType;
use App\Domain\ImageProcessing\Operation\RotateOperation;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class RotateOperationMapperTest extends TestCase
{
    private RotateOperationMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new RotateOperationMapper();
    }

    public function testMapReturnsRotateOperation(): void
    {
        $command = new RotateOperationCommand(
            angle: 90,
            type: ImageProcessingOperationType::Rotate,
        );

        $result = $this->mapper->map($command);

        $this->assertInstanceOf(RotateOperation::class, $result);
        $this->assertEquals(90, $result->angle);
    }

    public function testSupportsReturnsTrueForRotateOperationCommand(): void
    {
        $command = new RotateOperationCommand(
            angle: 90,
            type: ImageProcessingOperationType::Rotate,
        );

        $result = $this->mapper->supports($command);

        $this->assertTrue($result);
    }
}
