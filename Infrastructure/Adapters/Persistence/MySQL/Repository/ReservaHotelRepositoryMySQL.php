<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveReservaHotelPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateReservaHotelPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetReservaHotelByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllReservasHotelPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteReservaHotelPort.php';

require_once __DIR__ . '/../Mapper/ReservaHotelPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/ReservaHotelModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ReservaHotelId.php';

final class ReservaHotelRepositoryMySQL implements
    SaveReservaHotelPort,
    UpdateReservaHotelPort,
    GetReservaHotelByIdPort,
    GetAllReservasHotelPort,
    DeleteReservaHotelPort
{
    private PDO $pdo;
    private ReservaHotelPersistenceMapper $mapper;

    public function __construct(PDO $pdo, ReservaHotelPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(ReservaHotelModel $reserva): ReservaHotelModel
    {
        $dto = $this->mapper->fromModelToDto($reserva);

        $sql = '
            INSERT INTO reservas_hotel (
                id,
                fecha,
                hotel,
                huesped,
                fecha_inicio,
                fecha_fin,
                valor,
                habitacion,
                num_acompanantes,
                pais,
                departamento,
                ciudad,
                hora_checkin,
                hora_checkout,
                empleado_atiende,
                empleado_despide,
                descripcion,
                status,
                created_at,
                updated_at
            ) VALUES (
                :id,
                :fecha,
                :hotel,
                :huesped,
                :fecha_inicio,
                :fecha_fin,
                :valor,
                :habitacion,
                :num_acompanantes,
                :pais,
                :departamento,
                :ciudad,
                :hora_checkin,
                :hora_checkout,
                :empleado_atiende,
                :empleado_despide,
                :descripcion,
                :status,
                NOW(),
                NOW()
            )
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $dto->id(),
            ':fecha' => $dto->fecha(),
            ':hotel' => $dto->hotel(),
            ':huesped' => $dto->huesped(),
            ':fecha_inicio' => $dto->fechaInicio(),
            ':fecha_fin' => $dto->fechaFin(),
            ':valor' => $dto->valor(),
            ':habitacion' => $dto->habitacion(),
            ':num_acompanantes' => $dto->numAcompanantes(),
            ':pais' => $dto->pais(),
            ':departamento' => $dto->departamento(),
            ':ciudad' => $dto->ciudad(),
            ':hora_checkin' => $dto->horaCheckin(),
            ':hora_checkout' => $dto->horaCheckout(),
            ':empleado_atiende' => $dto->empleadoAtiende(),
            ':empleado_despide' => $dto->empleadoDespide(),
            ':descripcion' => $dto->descripcion(),
            ':status' => $dto->status(),
        ));

        $saved = $this->getById(new ReservaHotelId($dto->id()));
        if ($saved === null) {
            throw new RuntimeException('No se pudo recuperar la reserva después de guardarla.');
        }

        return $saved;
    }

    public function update(ReservaHotelModel $reserva): ReservaHotelModel
    {
        $dto = $this->mapper->fromModelToDto($reserva);

        $sql = '
            UPDATE reservas_hotel
               SET fecha = :fecha,
                   hotel = :hotel,
                   huesped = :huesped,
                   fecha_inicio = :fecha_inicio,
                   fecha_fin = :fecha_fin,
                   valor = :valor,
                   habitacion = :habitacion,
                   num_acompanantes = :num_acompanantes,
                   pais = :pais,
                   departamento = :departamento,
                   ciudad = :ciudad,
                   hora_checkin = :hora_checkin,
                   hora_checkout = :hora_checkout,
                   empleado_atiende = :empleado_atiende,
                   empleado_despide = :empleado_despide,
                   descripcion = :descripcion,
                   status = :status,
                   updated_at = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $dto->id(),
            ':fecha' => $dto->fecha(),
            ':hotel' => $dto->hotel(),
            ':huesped' => $dto->huesped(),
            ':fecha_inicio' => $dto->fechaInicio(),
            ':fecha_fin' => $dto->fechaFin(),
            ':valor' => $dto->valor(),
            ':habitacion' => $dto->habitacion(),
            ':num_acompanantes' => $dto->numAcompanantes(),
            ':pais' => $dto->pais(),
            ':departamento' => $dto->departamento(),
            ':ciudad' => $dto->ciudad(),
            ':hora_checkin' => $dto->horaCheckin(),
            ':hora_checkout' => $dto->horaCheckout(),
            ':empleado_atiende' => $dto->empleadoAtiende(),
            ':empleado_despide' => $dto->empleadoDespide(),
            ':descripcion' => $dto->descripcion(),
            ':status' => $dto->status(),
        ));

        $updated = $this->getById(new ReservaHotelId($dto->id()));
        if ($updated === null) {
            throw new RuntimeException('No se pudo recuperar la reserva después de actualizarla.');
        }

        return $updated;
    }

    public function getById(ReservaHotelId $id): ?ReservaHotelModel
    {
        $sql = '
            SELECT
                id,
                fecha,
                hotel,
                huesped,
                fecha_inicio,
                fecha_fin,
                valor,
                habitacion,
                num_acompanantes,
                pais,
                departamento,
                ciudad,
                hora_checkin,
                hora_checkout,
                empleado_atiende,
                empleado_despide,
                descripcion,
                status,
                created_at,
                updated_at
            FROM reservas_hotel
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $id->value(),
        ));

        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    /**
     * @return ReservaHotelModel[]
     */
    public function getAll(): array
    {
        $sql = '
            SELECT
                id,
                fecha,
                hotel,
                huesped,
                fecha_inicio,
                fecha_fin,
                valor,
                habitacion,
                num_acompanantes,
                pais,
                departamento,
                ciudad,
                hora_checkin,
                hora_checkout,
                empleado_atiende,
                empleado_despide,
                descripcion,
                status,
                created_at,
                updated_at
            FROM reservas_hotel
            ORDER BY fecha_inicio DESC, id DESC
        ';

        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    public function delete(ReservaHotelId $id): void
    {
        $sql = 'DELETE FROM reservas_hotel WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $id->value(),
        ));
    }
}
