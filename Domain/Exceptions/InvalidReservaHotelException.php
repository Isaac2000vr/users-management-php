<?php

declare(strict_types=1);

class InvalidReservaHotelException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(string $fieldName): self
    {
        return new self(sprintf('El campo %s de la reserva no puede estar vacío.', $fieldName));
    }

    public static function becauseDateFormatIsInvalid(string $fieldName, string $value): self
    {
        return new self(sprintf('El campo %s tiene un formato de fecha inválido: %s. Formato esperado: YYYY-MM-DD.', $fieldName, $value));
    }

    public static function becauseValorIsInvalid(string $value): self
    {
        return new self(sprintf('El valor de la reserva debe ser un número positivo mayor o igual a cero. Valor recibido: %s.', $value));
    }

    public static function becauseAcompanantesIsInvalid(int $value): self
    {
        return new self(sprintf('El número de acompañantes no puede ser negativo. Valor recibido: %d.', $value));
    }

    public static function becauseStatusIsInvalid(string $status): self
    {
        return new self(sprintf('El estado de la reserva es inválido: %s.', $status));
    }

    public static function becauseFechaFinIsBeforeFechaInicio(string $inicio, string $fin): self
    {
        return new self(sprintf('La fecha de fin (%s) no puede ser anterior a la fecha de inicio (%s).', $fin, $inicio));
    }
}
