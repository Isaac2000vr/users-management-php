<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreateReservaHotelCommand.php';
require_once __DIR__ . '/../../../Domain/Models/ReservaHotelModel.php';

interface CreateReservaHotelUseCase
{
    public function execute(CreateReservaHotelCommand $command): ReservaHotelModel;
}
