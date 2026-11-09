<?php

declare(strict_types=1);

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../ValueObjects/ReservaHotelId.php';

final class ReservaHotelDeletedDomainEvent extends DomainEvent
{
    private ReservaHotelId $id;

    public function __construct(ReservaHotelId $id)
    {
        parent::__construct('reserva_hotel.deleted');
        $this->id = $id;
    }

    public function id(): ReservaHotelId
    {
        return $this->id;
    }

    public function payload(): array
    {
        return array(
            'id' => $this->id->value(),
        );
    }
}
