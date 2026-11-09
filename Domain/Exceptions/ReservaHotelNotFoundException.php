<?php

declare(strict_types=1);

class ReservaHotelNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound(string $id): self
    {
        return new self(sprintf('No se encontró la reserva de hotel con el identificador: %s.', $id));
    }
}
