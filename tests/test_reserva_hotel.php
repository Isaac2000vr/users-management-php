<?php

declare(strict_types=1);

require_once __DIR__ . '/../Common/ClassLoader.php';
require_once __DIR__ . '/../Common/DependencyInjection.php';

DependencyInjection::boot();

echo "========================================\n";
echo "EJECUTANDO PRUEBAS DE RESERVA HOTEL (DDD / CQRS)\n";
echo "========================================\n\n";

$testsPassed = 0;
$testsTotal = 0;

function assertCondition(bool $condition, string $message): void
{
    global $testsPassed, $testsTotal;
    $testsTotal++;
    if ($condition) {
        $testsPassed++;
        echo " [PASS] $message\n";
    } else {
        echo " [FAIL] $message\n";
        exit(1);
    }
}

// -----------------------------------------------------------------
// 1. Value Objects & Exceptions
// -----------------------------------------------------------------
echo "--- 1. Pruebas de Value Objects y Validaciones del Dominio ---\n";

$id = new ReservaHotelId('res-101');
assertCondition($id->value() === 'res-101', 'ReservaHotelId almacena valor correctamente');

$fecha = new ReservaHotelFecha('2026-11-09');
assertCondition($fecha->value() === '2026-11-09', 'ReservaHotelFecha valida y almacena fecha YYYY-MM-DD');

$valor = new ReservaHotelValor(350000.50);
assertCondition($valor->value() === 350000.50, 'ReservaHotelValor almacena valor numérico');
assertCondition($valor->formatted() === '350000.50', 'ReservaHotelValor formatea a dos decimales');

// Test fail-fast validation: invalid date
$caught = false;
try {
    new ReservaHotelFecha('09/11/2026');
} catch (InvalidReservaHotelException $e) {
    $caught = true;
}
assertCondition($caught, 'ReservaHotelFecha rechaza formatos distintos a YYYY-MM-DD');

// Test fail-fast validation: negative value
$caught = false;
try {
    new ReservaHotelValor(-50);
} catch (InvalidReservaHotelException $e) {
    $caught = true;
}
assertCondition($caught, 'ReservaHotelValor rechaza valores negativos');

// -----------------------------------------------------------------
// 2. Enum & Model
// -----------------------------------------------------------------
echo "\n--- 2. Pruebas de Modelo de Dominio y Transiciones de Estado ---\n";

assertCondition(ReservaHotelStatusEnum::isValid('PENDING'), 'Status PENDING es válido');
assertCondition(ReservaHotelStatusEnum::isValid('CONFIRMED'), 'Status CONFIRMED es válido');
assertCondition(!ReservaHotelStatusEnum::isValid('INVALID_STATUS'), 'Status inventado es inválido');

$reserva = ReservaHotelModel::create(
    new ReservaHotelId('res-001'),
    new ReservaHotelFecha('2026-11-09'),
    'Hotel Decameron Baru',
    'Isaac David Vasquez Ramos',
    new ReservaHotelFecha('2026-12-10'),
    new ReservaHotelFecha('2026-12-15'),
    new ReservaHotelValor(1250000.00),
    'Cabana 12',
    3,
    'Colombia',
    'Bolívar',
    'Cartagena',
    '15:00',
    '12:00',
    'Andres Castro',
    'Patricia Morales',
    'Paquete todo incluido con vista al mar'
);

assertCondition($reserva->status() === ReservaHotelStatusEnum::PENDING, 'Reserva creada inicia con status PENDING');
assertCondition($reserva->hotel() === 'Hotel Decameron Baru', 'Nombre del hotel coincide');
assertCondition($reserva->huesped() === 'Isaac David Vasquez Ramos', 'Nombre del huésped coincide');
assertCondition($reserva->numAcompanantes() === 3, 'Número de acompañantes coincide');

$confirmed = $reserva->confirm();
assertCondition($confirmed->status() === ReservaHotelStatusEnum::CONFIRMED, 'Transición a CONFIRMED exitosa');

$cancelled = $reserva->cancel();
assertCondition($cancelled->status() === ReservaHotelStatusEnum::CANCELLED, 'Transición a CANCELLED exitosa');

$completed = $reserva->complete();
assertCondition($completed->status() === ReservaHotelStatusEnum::COMPLETED, 'Transición a COMPLETED exitosa');

// Test validation fechaFin < fechaInicio
$caught = false;
try {
    ReservaHotelModel::create(
        new ReservaHotelId('res-002'),
        new ReservaHotelFecha('2026-11-09'),
        'Hotel Caribe',
        'Juan Perez',
        new ReservaHotelFecha('2026-12-20'),
        new ReservaHotelFecha('2026-12-10'), // fin antes de inicio
        new ReservaHotelValor(500000),
        'Hab 101',
        1,
        'Colombia',
        'Bolivar',
        'Cartagena',
        '14:00',
        '11:00',
        'Emp 1',
        'Emp 2',
        'Desc'
    );
} catch (InvalidReservaHotelException $e) {
    $caught = true;
}
assertCondition($caught, 'Modelo rechaza fechaFin anterior a fechaInicio');

// -----------------------------------------------------------------
// 3. Domain Events
// -----------------------------------------------------------------
echo "\n--- 3. Pruebas de Eventos de Dominio ---\n";

$createdEvent = new ReservaHotelCreatedDomainEvent($reserva);
assertCondition($createdEvent->eventName() === 'reserva_hotel.created', 'Evento created tiene nombre correcto');
$payload = $createdEvent->payload();
assertCondition($payload['hotel'] === 'Hotel Decameron Baru', 'Payload del evento contiene datos correctos');

$deletedEvent = new ReservaHotelDeletedDomainEvent($reserva->id());
assertCondition($deletedEvent->eventName() === 'reserva_hotel.deleted', 'Evento deleted tiene nombre correcto');

// -----------------------------------------------------------------
// 4. CQRS Commands, Queries & Application Mappers
// -----------------------------------------------------------------
echo "\n--- 4. Pruebas de DTOs, Mappers y CQRS ---\n";

$createCmd = new CreateReservaHotelCommand(
    'res-003',
    '2026-11-09',
    'Hotel Las Americas',
    'Maria Lopez',
    '2026-11-20',
    '2026-11-25',
    800000.00,
    'Suite Presidencial',
    2,
    'Colombia',
    'Bolivar',
    'Cartagena',
    '15:00',
    '12:00',
    'Julian Romero',
    'Sofia Gomez',
    'Luna de miel',
    'CONFIRMED'
);

$reservaFromCmd = ReservaHotelApplicationMapper::fromCreateCommandToModel($createCmd);
assertCondition($reservaFromCmd->id()->value() === 'res-003', 'Mapper transforma Command a Model id');
assertCondition($reservaFromCmd->hotel() === 'Hotel Las Americas', 'Mapper transforma Command a Model hotel');
assertCondition($reservaFromCmd->valor()->value() === 800000.00, 'Mapper transforma Command a Model valor');

$updateCmd = new UpdateReservaHotelCommand(
    'res-003',
    '2026-11-09',
    'Hotel Las Americas Torre del Mar',
    'Maria Lopez',
    '2026-11-20',
    '2026-11-26',
    950000.00,
    'Suite Presidencial',
    3,
    'Colombia',
    'Bolivar',
    'Cartagena',
    '15:00',
    '12:00',
    'Julian Romero',
    'Sofia Gomez',
    'Luna de miel extendida',
    'CONFIRMED'
);

$reservaUpdated = ReservaHotelApplicationMapper::fromUpdateCommandToModel($updateCmd);
assertCondition($reservaUpdated->hotel() === 'Hotel Las Americas Torre del Mar', 'Mapper de Update actualiza hotel');
assertCondition($reservaUpdated->numAcompanantes() === 3, 'Mapper de Update actualiza acompanantes');

// -----------------------------------------------------------------
// 5. Application Services (Use Cases) con Repositorio en Memoria
// -----------------------------------------------------------------
echo "\n--- 5. Pruebas de Casos de Uso (Application Services) ---\n";

class InMemoryReservaHotelRepository implements
    SaveReservaHotelPort,
    UpdateReservaHotelPort,
    GetReservaHotelByIdPort,
    GetAllReservasHotelPort,
    DeleteReservaHotelPort
{
    /** @var array<string, ReservaHotelModel> */
    private array $storage = array();

    public function save(ReservaHotelModel $reserva): ReservaHotelModel
    {
        $this->storage[$reserva->id()->value()] = $reserva;
        return $reserva;
    }

    public function update(ReservaHotelModel $reserva): ReservaHotelModel
    {
        $this->storage[$reserva->id()->value()] = $reserva;
        return $reserva;
    }

    public function getById(ReservaHotelId $id): ?ReservaHotelModel
    {
        return $this->storage[$id->value()] ?? null;
    }

    public function getAll(): array
    {
        return array_values($this->storage);
    }

    public function delete(ReservaHotelId $id): void
    {
        unset($this->storage[$id->value()]);
    }
}

$fakeRepo = new InMemoryReservaHotelRepository();

$createService = new CreateReservaHotelService($fakeRepo);
$getByIdService = new GetReservaHotelByIdService($fakeRepo);
$getAllService = new GetAllReservasHotelService($fakeRepo);
$updateService = new UpdateReservaHotelService($fakeRepo, $fakeRepo);
$deleteService = new DeleteReservaHotelService($fakeRepo, $fakeRepo);

// Execute Create
$createdModel = $createService->execute($createCmd);
assertCondition($createdModel->id()->value() === 'res-003', 'CreateReservaHotelService guarda la reserva');

// Execute GetById
$foundModel = $getByIdService->execute(new GetReservaHotelByIdQuery('res-003'));
assertCondition($foundModel->huesped() === 'Maria Lopez', 'GetReservaHotelByIdService recupera la reserva');

// Execute GetAll
$allReservas = $getAllService->execute(new GetAllReservasHotelQuery());
assertCondition(count($allReservas) === 1, 'GetAllReservasHotelService retorna 1 reserva');

// Execute Update
$updatedModel = $updateService->execute($updateCmd);
assertCondition($updatedModel->valor()->value() === 950000.00, 'UpdateReservaHotelService actualiza el valor');

// Execute Delete
$deleteService->execute(new DeleteReservaHotelCommand('res-003'));
$afterDelete = $getAllService->execute(new GetAllReservasHotelQuery());
assertCondition(count($afterDelete) === 0, 'DeleteReservaHotelService elimina la reserva');

// -----------------------------------------------------------------
// 6. Web Entrypoints & Mappers
// -----------------------------------------------------------------
echo "\n--- 6. Pruebas de Entrypoints Web y Presentación ---\n";

$webMapper = new ReservaHotelWebMapper();
$responseDto = $webMapper->fromModelToResponse($reserva);
assertCondition($responseDto->getId() === 'res-001', 'ReservaHotelResponse expone ID');
assertCondition($responseDto->getHotel() === 'Hotel Decameron Baru', 'ReservaHotelResponse expone Hotel');
assertCondition($responseDto->getHuesped() === 'Isaac David Vasquez Ramos', 'ReservaHotelResponse expone Huesped');

echo "\n========================================\n";
echo "RESULTADO: $testsPassed / $testsTotal PRUEBAS SUPERADAS EXITOSAMENTE (100%)\n";
echo "========================================\n";
