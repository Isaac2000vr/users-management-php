<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetReservaHotelByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetReservaHotelByIdPort.php';
require_once __DIR__ . '/Mappers/ReservaHotelApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/ReservaHotelNotFoundException.php';

final class GetReservaHotelByIdService implements GetReservaHotelByIdUseCase
{
    private GetReservaHotelByIdPort $getReservaHotelByIdPort;

    public function __construct(GetReservaHotelByIdPort $getReservaHotelByIdPort)
    {
        $this->getReservaHotelByIdPort = $getReservaHotelByIdPort;
    }

    public function execute(GetReservaHotelByIdQuery $query): ReservaHotelModel
    {
        $id = ReservaHotelApplicationMapper::fromGetByIdQueryToId($query);
        $reserva = $this->getReservaHotelByIdPort->getById($id);

        if ($reserva === null) {
            throw ReservaHotelNotFoundException::becauseIdWasNotFound($id->value());
        }

        return $reserva;
    }
}
