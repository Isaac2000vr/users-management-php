<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateReservaHotelUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveReservaHotelPort.php';
require_once __DIR__ . '/Mappers/ReservaHotelApplicationMapper.php';

final class CreateReservaHotelService implements CreateReservaHotelUseCase
{
    private SaveReservaHotelPort $saveReservaHotelPort;

    public function __construct(SaveReservaHotelPort $saveReservaHotelPort)
    {
        $this->saveReservaHotelPort = $saveReservaHotelPort;
    }

    public function execute(CreateReservaHotelCommand $command): ReservaHotelModel
    {
        $reserva = ReservaHotelApplicationMapper::fromCreateCommandToModel($command);
        return $this->saveReservaHotelPort->save($reserva);
    }
}
