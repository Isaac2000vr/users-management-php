<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeleteReservaHotelCommand.php';

interface DeleteReservaHotelUseCase
{
    public function execute(DeleteReservaHotelCommand $command): void;
}
