<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetReservaHotelByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/ReservaHotelModel.php';

interface GetReservaHotelByIdUseCase
{
    public function execute(GetReservaHotelByIdQuery $query): ReservaHotelModel;
}
