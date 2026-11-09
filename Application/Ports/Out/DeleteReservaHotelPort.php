<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/ReservaHotelId.php';

interface DeleteReservaHotelPort
{
    public function delete(ReservaHotelId $id): void;
}
