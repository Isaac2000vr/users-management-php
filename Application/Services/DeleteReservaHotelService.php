<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteReservaHotelUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeleteReservaHotelPort.php';
require_once __DIR__ . '/../Ports/Out/GetReservaHotelByIdPort.php';
require_once __DIR__ . '/Mappers/ReservaHotelApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/ReservaHotelNotFoundException.php';

final class DeleteReservaHotelService implements DeleteReservaHotelUseCase
{
    private DeleteReservaHotelPort $deleteReservaHotelPort;
    private GetReservaHotelByIdPort $getReservaHotelByIdPort;

    public function __construct(
        DeleteReservaHotelPort $deleteReservaHotelPort,
        GetReservaHotelByIdPort $getReservaHotelByIdPort
    ) {
        $this->deleteReservaHotelPort = $deleteReservaHotelPort;
        $this->getReservaHotelByIdPort = $getReservaHotelByIdPort;
    }

    public function execute(DeleteReservaHotelCommand $command): void
    {
        $id = ReservaHotelApplicationMapper::fromDeleteCommandToId($command);
        $current = $this->getReservaHotelByIdPort->getById($id);

        if ($current === null) {
            throw ReservaHotelNotFoundException::becauseIdWasNotFound($id->value());
        }

        $this->deleteReservaHotelPort->delete($id);
    }
}
