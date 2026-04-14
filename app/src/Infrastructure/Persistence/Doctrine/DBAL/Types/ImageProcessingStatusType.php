<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\DBAL\Types;

use App\Domain\ImageProcessing\ImageProcessingStatus;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Exception\InvalidType;
use Doctrine\DBAL\Types\Type;

final class ImageProcessingStatusType extends Type
{
    private const string SQL_DECLARATION = 'VARCHAR';

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if (!$value instanceof ImageProcessingStatus) {
            throw InvalidType::new($value, self::class, [ImageProcessingStatus::class]);
        }

        return $value->value;
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?ImageProcessingStatus
    {
        return $value !== null ? ImageProcessingStatus::from($value) : null;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return self::SQL_DECLARATION;
    }
}
