<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidReservaHotelException.php';

final class ReservaHotelValor
{
    private float $value;

    public function __construct(float|int|string $value)
    {
        if (!is_numeric($value)) {
            throw InvalidReservaHotelException::becauseValorIsInvalid((string) $value);
        }

        $numericValue = (float) $value;

        if ($numericValue < 0) {
            throw InvalidReservaHotelException::becauseValorIsInvalid((string) $value);
        }

        $this->value = $numericValue;
    }

    public function value(): float
    {
        return $this->value;
    }

    public function formatted(): string
    {
        return number_format($this->value, 2, '.', '');
    }

    public function equals(ReservaHotelValor $other): bool
    {
        return abs($this->value - $other->value()) < 0.00001;
    }

    public function __toString(): string
    {
        return $this->formatted();
    }
}
