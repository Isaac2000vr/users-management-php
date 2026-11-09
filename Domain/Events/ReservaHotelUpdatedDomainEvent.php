<?php

declare(strict_types=1);

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../Models/ReservaHotelModel.php';

final class ReservaHotelUpdatedDomainEvent extends DomainEvent
{
    private ReservaHotelModel $reserva;

    public function __construct(ReservaHotelModel $reserva)
    {
        parent::__construct('reserva_hotel.updated');
        $this->reserva = $reserva;
    }

    public function reserva(): ReservaHotelModel
    {
        return $this->reserva;
    }

    public function payload(): array
    {
        return $this->reserva->toArray();
    }
}
