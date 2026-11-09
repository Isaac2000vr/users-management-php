<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreateReservaHotelCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateReservaHotelCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeleteReservaHotelCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetReservaHotelByIdQuery.php';

require_once __DIR__ . '/../../../Domain/Models/ReservaHotelModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ReservaHotelId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ReservaHotelFecha.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ReservaHotelValor.php';
require_once __DIR__ . '/../../../Domain/Enums/ReservaHotelStatusEnum.php';

final class ReservaHotelApplicationMapper
{
    public static function fromCreateCommandToModel(CreateReservaHotelCommand $command): ReservaHotelModel
    {
        return new ReservaHotelModel(
            new ReservaHotelId($command->getId()),
            new ReservaHotelFecha($command->getFecha(), 'fecha'),
            $command->getHotel(),
            $command->getHuesped(),
            new ReservaHotelFecha($command->getFechaInicio(), 'fechaInicio'),
            new ReservaHotelFecha($command->getFechaFin(), 'fechaFin'),
            new ReservaHotelValor($command->getValor()),
            $command->getHabitacion(),
            $command->getNumAcompanantes(),
            $command->getPais(),
            $command->getDepartamento(),
            $command->getCiudad(),
            $command->getHoraCheckin(),
            $command->getHoraCheckout(),
            $command->getEmpleadoAtiende(),
            $command->getEmpleadoDespide(),
            $command->getDescripcion(),
            $command->getStatus() !== '' ? $command->getStatus() : ReservaHotelStatusEnum::PENDING
        );
    }

    public static function fromUpdateCommandToModel(UpdateReservaHotelCommand $command): ReservaHotelModel
    {
        return new ReservaHotelModel(
            new ReservaHotelId($command->getId()),
            new ReservaHotelFecha($command->getFecha(), 'fecha'),
            $command->getHotel(),
            $command->getHuesped(),
            new ReservaHotelFecha($command->getFechaInicio(), 'fechaInicio'),
            new ReservaHotelFecha($command->getFechaFin(), 'fechaFin'),
            new ReservaHotelValor($command->getValor()),
            $command->getHabitacion(),
            $command->getNumAcompanantes(),
            $command->getPais(),
            $command->getDepartamento(),
            $command->getCiudad(),
            $command->getHoraCheckin(),
            $command->getHoraCheckout(),
            $command->getEmpleadoAtiende(),
            $command->getEmpleadoDespide(),
            $command->getDescripcion(),
            $command->getStatus()
        );
    }

    public static function fromGetByIdQueryToId(GetReservaHotelByIdQuery $query): ReservaHotelId
    {
        return new ReservaHotelId($query->getId());
    }

    public static function fromDeleteCommandToId(DeleteReservaHotelCommand $command): ReservaHotelId
    {
        return new ReservaHotelId($command->getId());
    }

    /**
     * @return array<string, mixed>
     */
    public static function fromModelToArray(ReservaHotelModel $reserva): array
    {
        return $reserva->toArray();
    }

    /**
     * @param ReservaHotelModel[] $reservas
     * @return array<int, array<string, mixed>>
     */
    public static function fromModelsToArray(array $reservas): array
    {
        $result = array();
        foreach ($reservas as $reserva) {
            $result[] = self::fromModelToArray($reserva);
        }
        return $result;
    }
}
