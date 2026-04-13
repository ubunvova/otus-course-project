<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\DBAL\Types;

use App\Domain\ImageProcessing\Operation\CropOperation;
use App\Domain\ImageProcessing\Operation\ImageProcessingOperationType as DomainImageProcessingOperationType;
use App\Domain\ImageProcessing\Operation\ResizeOperation;
use App\Domain\ImageProcessing\Operation\RotateOperation;
use DateMalformedStringException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Exception\InvalidType;
use Doctrine\DBAL\Types\Exception\SerializationFailed;
use Doctrine\DBAL\Types\JsonType;

use function is_array;

final class ImageProcessingOperationType extends JsonType
{
    /**
     * @throws SerializationFailed
     * @throws InvalidType
     * @throws ConversionException
     */
    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): string
    {
        if (!is_array($value)) {
            throw InvalidType::new($value, self::class, ['array']);
        }

        return parent::convertToDatabaseValue($value, $platform);
    }

    /**
     * @throws ConversionException
     * @throws DateMalformedStringException
     *
     * @return list<CropOperation|ResizeOperation|RotateOperation>
     */
    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): array
    {
        $operations = parent::convertToPHPValue($value, $platform);

        return array_map(
            fn (array $operation) => $this->hydrateOperation($operation),
            $operations,
        );
    }

    /**
     * @param array<string, mixed> $operation
     */
    private function hydrateOperation(array $operation): CropOperation|ResizeOperation|RotateOperation
    {
        $type = DomainImageProcessingOperationType::from($operation['type']);

        return match ($type) {
            DomainImageProcessingOperationType::Crop => new CropOperation(
                x: $operation['x'],
                y: $operation['y'],
                width: $operation['width'],
                height: $operation['height'],
                type: $type,
            ),
            DomainImageProcessingOperationType::Resize => new ResizeOperation(
                width: $operation['width'],
                height: $operation['height'],
                type: $type,
            ),
            DomainImageProcessingOperationType::Rotate => new RotateOperation(
                angle: $operation['angle'],
                type: $type,
            ),
        };
    }
}
