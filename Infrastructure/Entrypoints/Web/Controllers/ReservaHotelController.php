<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/ReservaHotelWebMapper.php';
require_once __DIR__ . '/../../../../Application/Ports/In/CreateReservaHotelUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdateReservaHotelUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetReservaHotelByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllReservasHotelUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeleteReservaHotelUseCase.php';
require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetAllReservasHotelQuery.php';

final class ReservaHotelController
{
    private CreateReservaHotelUseCase $createUseCase;
    private UpdateReservaHotelUseCase $updateUseCase;
    private GetReservaHotelByIdUseCase $getByIdUseCase;
    private GetAllReservasHotelUseCase $getAllUseCase;
    private DeleteReservaHotelUseCase $deleteUseCase;
    private ReservaHotelWebMapper $mapper;

    public function __construct(
        CreateReservaHotelUseCase $createUseCase,
        UpdateReservaHotelUseCase $updateUseCase,
        GetReservaHotelByIdUseCase $getByIdUseCase,
        GetAllReservasHotelUseCase $getAllUseCase,
        DeleteReservaHotelUseCase $deleteUseCase,
        ReservaHotelWebMapper $mapper
    ) {
        $this->createUseCase = $createUseCase;
        $this->updateUseCase = $updateUseCase;
        $this->getByIdUseCase = $getByIdUseCase;
        $this->getAllUseCase = $getAllUseCase;
        $this->deleteUseCase = $deleteUseCase;
        $this->mapper = $mapper;
    }

    /**
     * @return ReservaHotelResponse[]
     */
    public function index(): array
    {
        $reservas = $this->getAllUseCase->execute(new GetAllReservasHotelQuery());
        return $this->mapper->fromModelsToResponses($reservas);
    }

    public function show(string $id): ReservaHotelResponse
    {
        $query = $this->mapper->fromIdToGetByIdQuery($id);
        $reserva = $this->getByIdUseCase->execute($query);
        return $this->mapper->fromModelToResponse($reserva);
    }

    public function store(CreateReservaHotelRequest $request): ReservaHotelResponse
    {
        $command = $this->mapper->fromCreateRequestToCommand($request);
        $reserva = $this->createUseCase->execute($command);
        return $this->mapper->fromModelToResponse($reserva);
    }

    public function update(UpdateReservaHotelRequest $request): ReservaHotelResponse
    {
        $command = $this->mapper->fromUpdateRequestToCommand($request);
        $reserva = $this->updateUseCase->execute($command);
        return $this->mapper->fromModelToResponse($reserva);
    }

    public function delete(string $id): void
    {
        $command = $this->mapper->fromIdToDeleteCommand($id);
        $this->deleteUseCase->execute($command);
    }
}
