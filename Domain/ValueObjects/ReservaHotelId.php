<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidReservaHotelException.php';

final class ReservaHotelId
{
    private string $value;

    public function __construct(string $value)
    {
        $normalized = trim($value);

        if ($normalized === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('id');
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ReservaHotelId $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
