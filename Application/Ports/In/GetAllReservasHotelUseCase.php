<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllReservasHotelQuery.php';
require_once __DIR__ . '/../../../Domain/Models/ReservaHotelModel.php';

interface GetAllReservasHotelUseCase
{
    /**
     * @return ReservaHotelModel[]
     */
    public function execute(GetAllReservasHotelQuery $query): array;
}
