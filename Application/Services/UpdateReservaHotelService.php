<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateReservaHotelUseCase.php';
require_once __DIR__ . '/../Ports/Out/UpdateReservaHotelPort.php';
require_once __DIR__ . '/../Ports/Out/GetReservaHotelByIdPort.php';
require_once __DIR__ . '/Mappers/ReservaHotelApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/ReservaHotelNotFoundException.php';

final class UpdateReservaHotelService implements UpdateReservaHotelUseCase
{
    private UpdateReservaHotelPort $updateReservaHotelPort;
    private GetReservaHotelByIdPort $getReservaHotelByIdPort;

    public function __construct(
        UpdateReservaHotelPort $updateReservaHotelPort,
        GetReservaHotelByIdPort $getReservaHotelByIdPort
    ) {
        $this->updateReservaHotelPort = $updateReservaHotelPort;
        $this->getReservaHotelByIdPort = $getReservaHotelByIdPort;
    }

    public function execute(UpdateReservaHotelCommand $command): ReservaHotelModel
    {
        $id = new ReservaHotelId($command->getId());
        $current = $this->getReservaHotelByIdPort->getById($id);

        if ($current === null) {
            throw ReservaHotelNotFoundException::becauseIdWasNotFound($id->value());
        }

        $reservaToUpdate = ReservaHotelApplicationMapper::fromUpdateCommandToModel($command);
        return $this->updateReservaHotelPort->update($reservaToUpdate);
    }
}
