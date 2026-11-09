<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllReservasHotelUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllReservasHotelPort.php';

final class GetAllReservasHotelService implements GetAllReservasHotelUseCase
{
    private GetAllReservasHotelPort $getAllReservasHotelPort;

    public function __construct(GetAllReservasHotelPort $getAllReservasHotelPort)
    {
        $this->getAllReservasHotelPort = $getAllReservasHotelPort;
    }

    /**
     * @return ReservaHotelModel[]
     */
    public function execute(GetAllReservasHotelQuery $query): array
    {
        return $this->getAllReservasHotelPort->getAll();
    }
}
