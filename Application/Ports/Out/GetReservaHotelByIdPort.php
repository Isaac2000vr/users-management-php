<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/ReservaHotelModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ReservaHotelId.php';

interface GetReservaHotelByIdPort
{
    public function getById(ReservaHotelId $id): ?ReservaHotelModel;
}
