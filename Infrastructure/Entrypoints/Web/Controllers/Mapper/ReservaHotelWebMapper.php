<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/ReservaHotelResponse.php';
require_once __DIR__ . '/../Dto/CreateReservaHotelRequest.php';
require_once __DIR__ . '/../Dto/UpdateReservaHotelRequest.php';

require_once __DIR__ . '/../../../../Application/Services/Dto/Commands/CreateReservaHotelCommand.php';
require_once __DIR__ . '/../../../../Application/Services/Dto/Commands/UpdateReservaHotelCommand.php';
require_once __DIR__ . '/../../../../Application/Services/Dto/Commands/DeleteReservaHotelCommand.php';
require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetReservaHotelByIdQuery.php';

require_once __DIR__ . '/../../../../Domain/Models/ReservaHotelModel.php';

final class ReservaHotelWebMapper
{
    public function fromCreateRequestToCommand(CreateReservaHotelRequest $request): CreateReservaHotelCommand
    {
        return new CreateReservaHotelCommand(
            $request->getId(),
            $request->getFecha(),
            $request->getHotel(),
            $request->getHuesped(),
            $request->getFechaInicio(),
            $request->getFechaFin(),
            $request->getValor(),
            $request->getHabitacion(),
            $request->getNumAcompanantes(),
            $request->getPais(),
            $request->getDepartamento(),
            $request->getCiudad(),
            $request->getHoraCheckin(),
            $request->getHoraCheckout(),
            $request->getEmpleadoAtiende(),
            $request->getEmpleadoDespide(),
            $request->getDescripcion(),
            $request->getStatus()
        );
    }

    public function fromUpdateRequestToCommand(UpdateReservaHotelRequest $request): UpdateReservaHotelCommand
    {
        return new UpdateReservaHotelCommand(
            $request->getId(),
            $request->getFecha(),
            $request->getHotel(),
            $request->getHuesped(),
            $request->getFechaInicio(),
            $request->getFechaFin(),
            $request->getValor(),
            $request->getHabitacion(),
            $request->getNumAcompanantes(),
            $request->getPais(),
            $request->getDepartamento(),
            $request->getCiudad(),
            $request->getHoraCheckin(),
            $request->getHoraCheckout(),
            $request->getEmpleadoAtiende(),
            $request->getEmpleadoDespide(),
            $request->getDescripcion(),
            $request->getStatus()
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetReservaHotelByIdQuery
    {
        return new GetReservaHotelByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeleteReservaHotelCommand
    {
        return new DeleteReservaHotelCommand($id);
    }

    public function fromModelToResponse(ReservaHotelModel $model): ReservaHotelResponse
    {
        return new ReservaHotelResponse(
            $model->id()->value(),
            $model->fecha()->value(),
            $model->hotel(),
            $model->huesped(),
            $model->fechaInicio()->value(),
            $model->fechaFin()->value(),
            $model->valor()->value(),
            $model->habitacion(),
            $model->numAcompanantes(),
            $model->pais(),
            $model->departamento(),
            $model->ciudad(),
            $model->horaCheckin(),
            $model->horaCheckout(),
            $model->empleadoAtiende(),
            $model->empleadoDespide(),
            $model->descripcion(),
            $model->status()
        );
    }

    /**
     * @param ReservaHotelModel[] $models
     * @return ReservaHotelResponse[]
     */
    public function fromModelsToResponses(array $models): array
    {
        $responses = array();
        foreach ($models as $model) {
            $responses[] = $this->fromModelToResponse($model);
        }
        return $responses;
    }
}
