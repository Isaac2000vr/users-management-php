<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidReservaHotelException.php';

final class ReservaHotelStatusEnum
{
    public const PENDING = 'PENDING';
    public const CONFIRMED = 'CONFIRMED';
    public const CANCELLED = 'CANCELLED';
    public const COMPLETED = 'COMPLETED';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return array(
            self::PENDING,
            self::CONFIRMED,
            self::CANCELLED,
            self::COMPLETED,
        );
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values(), true);
    }

    public static function ensureIsValid(string $value): void
    {
        if (!self::isValid($value)) {
            throw InvalidReservaHotelException::becauseStatusIsInvalid($value);
        }
    }
}
