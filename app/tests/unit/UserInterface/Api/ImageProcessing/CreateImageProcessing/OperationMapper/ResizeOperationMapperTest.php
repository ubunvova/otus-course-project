<?php

declare(strict_types=1);

namespace App\Tests\unit\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper;

use App\Application\ImageProcessing\CreateImageProcessing\Command\ResizeOperationCommand;
use App\Application\ImageProcessing\ImageProcessingOperationType;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\OperationMapper\ResizeOperationMapper;
use App\UserInterface\Api\ImageProcessing\CreateImageProcessing\Request\Operation\ResizeOperationRequest;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ResizeOperationMapperTest extends TestCase
{
    private ResizeOperationMapper $mapper;

    protected function setUp(): void
    {
        $this->mapper = new ResizeOperationMapper();
    }

    public function testMapReturnsResizeCommand(): void
    {
        $request = new ResizeOperationRequest();
        $request->width = 100;
        $request->height = 200;
        $request->type = ImageProcessingOperationType::Resize->value;

        $result = $this->mapper->map($request);

        $this->assertInstanceOf(ResizeOperationCommand::class, $result);
        $this->assertEquals(100, $result->width);
        $this->assertEquals(200, $result->height);
        $this->assertEquals(ImageProcessingOperationType::Resize, $result->type);
    }

    public function testSupportsReturnsTrueForResizeOperationRequest(): void
    {
        $request = new ResizeOperationRequest();
        $request->width = 100;
        $request->height = 200;
        $request->type = ImageProcessingOperationType::Resize->value;

        $result = $this->mapper->supports($request);

        $this->assertTrue($result);
    }
}
