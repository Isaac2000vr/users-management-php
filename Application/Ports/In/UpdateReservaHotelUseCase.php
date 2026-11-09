<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdateReservaHotelCommand.php';
require_once __DIR__ . '/../../../Domain/Models/ReservaHotelModel.php';

interface UpdateReservaHotelUseCase
{
    public function execute(UpdateReservaHotelCommand $command): ReservaHotelModel;
}
