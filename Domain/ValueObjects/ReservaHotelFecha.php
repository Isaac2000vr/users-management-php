<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidReservaHotelException.php';

final class ReservaHotelFecha
{
    private string $value;

    public function __construct(string $value, string $fieldName = 'fecha')
    {
        $normalized = trim($value);

        if ($normalized === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty($fieldName);
        }

        $date = DateTimeImmutable::createFromFormat('Y-m-d', $normalized);
        if ($date === false || $date->format('Y-m-d') !== $normalized) {
            throw InvalidReservaHotelException::becauseDateFormatIsInvalid($fieldName, $normalized);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ReservaHotelFecha $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
