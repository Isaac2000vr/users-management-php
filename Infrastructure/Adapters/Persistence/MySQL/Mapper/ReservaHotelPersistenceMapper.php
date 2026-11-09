<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/ReservaHotelPersistenceDto.php';
require_once __DIR__ . '/../Entity/ReservaHotelEntity.php';

require_once __DIR__ . '/../../../../../Domain/Models/ReservaHotelModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ReservaHotelId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ReservaHotelFecha.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ReservaHotelValor.php';
require_once __DIR__ . '/../../../../../Domain/Enums/ReservaHotelStatusEnum.php';

final class ReservaHotelPersistenceMapper
{
    public function fromModelToDto(ReservaHotelModel $model): ReservaHotelPersistenceDto
    {
        return new ReservaHotelPersistenceDto(
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

    public function fromDtoToEntity(ReservaHotelPersistenceDto $dto): ReservaHotelEntity
    {
        return new ReservaHotelEntity(
            $dto->id(),
            $dto->fecha(),
            $dto->hotel(),
            $dto->huesped(),
            $dto->fechaInicio(),
            $dto->fechaFin(),
            $dto->valor(),
            $dto->habitacion(),
            $dto->numAcompanantes(),
            $dto->pais(),
            $dto->departamento(),
            $dto->ciudad(),
            $dto->horaCheckin(),
            $dto->horaCheckout(),
            $dto->empleadoAtiende(),
            $dto->empleadoDespide(),
            $dto->descripcion(),
            $dto->status()
        );
    }

    /**
     * @param array<string, mixed> $row
     */
    public function fromRowToEntity(array $row): ReservaHotelEntity
    {
        return new ReservaHotelEntity(
            (string) $row['id'],
            (string) $row['fecha'],
            (string) $row['hotel'],
            (string) $row['huesped'],
            (string) $row['fecha_inicio'],
            (string) $row['fecha_fin'],
            (float) $row['valor'],
            (string) $row['habitacion'],
            (int) $row['num_acompanantes'],
            (string) $row['pais'],
            (string) $row['departamento'],
            (string) $row['ciudad'],
            (string) $row['hora_checkin'],
            (string) $row['hora_checkout'],
            (string) $row['empleado_atiende'],
            (string) $row['empleado_despide'],
            isset($row['descripcion']) ? (string) $row['descripcion'] : '',
            (string) $row['status'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(ReservaHotelEntity $entity): ReservaHotelModel
    {
        return new ReservaHotelModel(
            new ReservaHotelId($entity->id()),
            new ReservaHotelFecha($entity->fecha(), 'fecha'),
            $entity->hotel(),
            $entity->huesped(),
            new ReservaHotelFecha($entity->fechaInicio(), 'fechaInicio'),
            new ReservaHotelFecha($entity->fechaFin(), 'fechaFin'),
            new ReservaHotelValor($entity->valor()),
            $entity->habitacion(),
            $entity->numAcompanantes(),
            $entity->pais(),
            $entity->departamento(),
            $entity->ciudad(),
            $entity->horaCheckin(),
            $entity->horaCheckout(),
            $entity->empleadoAtiende(),
            $entity->empleadoDespide(),
            $entity->descripcion(),
            $entity->status()
        );
    }

    /**
     * @param array<string, mixed> $row
     */
    public function fromRowToModel(array $row): ReservaHotelModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return ReservaHotelModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = array();
        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }
        return $models;
    }
}
