<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/ReservaHotelId.php';
require_once __DIR__ . '/../ValueObjects/ReservaHotelFecha.php';
require_once __DIR__ . '/../ValueObjects/ReservaHotelValor.php';
require_once __DIR__ . '/../Enums/ReservaHotelStatusEnum.php';
require_once __DIR__ . '/../Exceptions/InvalidReservaHotelException.php';

final class ReservaHotelModel
{
    private ReservaHotelId $id;
    private ReservaHotelFecha $fecha;
    private string $hotel;
    private string $huesped;
    private ReservaHotelFecha $fechaInicio;
    private ReservaHotelFecha $fechaFin;
    private ReservaHotelValor $valor;
    private string $habitacion;
    private int $numAcompanantes;
    private string $pais;
    private string $departamento;
    private string $ciudad;
    private string $horaCheckin;
    private string $horaCheckout;
    private string $empleadoAtiende;
    private string $empleadoDespide;
    private string $descripcion;
    private string $status;

    public function __construct(
        ReservaHotelId $id,
        ReservaHotelFecha $fecha,
        string $hotel,
        string $huesped,
        ReservaHotelFecha $fechaInicio,
        ReservaHotelFecha $fechaFin,
        ReservaHotelValor $valor,
        string $habitacion,
        int $numAcompanantes,
        string $pais,
        string $departamento,
        string $ciudad,
        string $horaCheckin,
        string $horaCheckout,
        string $empleadoAtiende,
        string $empleadoDespide,
        string $descripcion,
        string $status
    ) {
        $hotelNorm = trim($hotel);
        if ($hotelNorm === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('hotel');
        }

        $huespedNorm = trim($huesped);
        if ($huespedNorm === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('huesped');
        }

        $habitacionNorm = trim($habitacion);
        if ($habitacionNorm === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('habitacion');
        }

        if ($numAcompanantes < 0) {
            throw InvalidReservaHotelException::becauseAcompanantesIsInvalid($numAcompanantes);
        }

        $paisNorm = trim($pais);
        if ($paisNorm === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('pais');
        }

        $depNorm = trim($departamento);
        if ($depNorm === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('departamento');
        }

        $ciudadNorm = trim($ciudad);
        if ($ciudadNorm === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('ciudad');
        }

        $horaCheckinNorm = trim($horaCheckin);
        if ($horaCheckinNorm === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('horaCheckin');
        }

        $horaCheckoutNorm = trim($horaCheckout);
        if ($horaCheckoutNorm === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('horaCheckout');
        }

        $empleadoAtiendeNorm = trim($empleadoAtiende);
        if ($empleadoAtiendeNorm === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('empleadoAtiende');
        }

        $empleadoDespideNorm = trim($empleadoDespide);
        if ($empleadoDespideNorm === '') {
            throw InvalidReservaHotelException::becauseValueIsEmpty('empleadoDespide');
        }

        if ($fechaFin->value() < $fechaInicio->value()) {
            throw InvalidReservaHotelException::becauseFechaFinIsBeforeFechaInicio(
                $fechaInicio->value(),
                $fechaFin->value()
            );
        }

        ReservaHotelStatusEnum::ensureIsValid($status);

        $this->id = $id;
        $this->fecha = $fecha;
        $this->hotel = $hotelNorm;
        $this->huesped = $huespedNorm;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->valor = $valor;
        $this->habitacion = $habitacionNorm;
        $this->numAcompanantes = $numAcompanantes;
        $this->pais = $paisNorm;
        $this->departamento = $depNorm;
        $this->ciudad = $ciudadNorm;
        $this->horaCheckin = $horaCheckinNorm;
        $this->horaCheckout = $horaCheckoutNorm;
        $this->empleadoAtiende = $empleadoAtiendeNorm;
        $this->empleadoDespide = $empleadoDespideNorm;
        $this->descripcion = trim($descripcion);
        $this->status = $status;
    }

    public static function create(
        ReservaHotelId $id,
        ReservaHotelFecha $fecha,
        string $hotel,
        string $huesped,
        ReservaHotelFecha $fechaInicio,
        ReservaHotelFecha $fechaFin,
        ReservaHotelValor $valor,
        string $habitacion,
        int $numAcompanantes,
        string $pais,
        string $departamento,
        string $ciudad,
        string $horaCheckin,
        string $horaCheckout,
        string $empleadoAtiende,
        string $empleadoDespide,
        string $descripcion,
        string $status = ReservaHotelStatusEnum::PENDING
    ): self {
        return new self(
            $id,
            $fecha,
            $hotel,
            $huesped,
            $fechaInicio,
            $fechaFin,
            $valor,
            $habitacion,
            $numAcompanantes,
            $pais,
            $departamento,
            $ciudad,
            $horaCheckin,
            $horaCheckout,
            $empleadoAtiende,
            $empleadoDespide,
            $descripcion,
            $status
        );
    }

    public function id(): ReservaHotelId
    {
        return $this->id;
    }

    public function fecha(): ReservaHotelFecha
    {
        return $this->fecha;
    }

    public function hotel(): string
    {
        return $this->hotel;
    }

    public function huesped(): string
    {
        return $this->huesped;
    }

    public function fechaInicio(): ReservaHotelFecha
    {
        return $this->fechaInicio;
    }

    public function fechaFin(): ReservaHotelFecha
    {
        return $this->fechaFin;
    }

    public function valor(): ReservaHotelValor
    {
        return $this->valor;
    }

    public function habitacion(): string
    {
        return $this->habitacion;
    }

    public function numAcompanantes(): int
    {
        return $this->numAcompanantes;
    }

    public function pais(): string
    {
        return $this->pais;
    }

    public function departamento(): string
    {
        return $this->departamento;
    }

    public function ciudad(): string
    {
        return $this->ciudad;
    }

    public function horaCheckin(): string
    {
        return $this->horaCheckin;
    }

    public function horaCheckout(): string
    {
        return $this->horaCheckout;
    }

    public function empleadoAtiende(): string
    {
        return $this->empleadoAtiende;
    }

    public function empleadoDespide(): string
    {
        return $this->empleadoDespide;
    }

    public function descripcion(): string
    {
        return $this->descripcion;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function confirm(): self
    {
        $clone = clone $this;
        $clone->status = ReservaHotelStatusEnum::CONFIRMED;
        return $clone;
    }

    public function cancel(): self
    {
        $clone = clone $this;
        $clone->status = ReservaHotelStatusEnum::CANCELLED;
        return $clone;
    }

    public function complete(): self
    {
        $clone = clone $this;
        $clone->status = ReservaHotelStatusEnum::COMPLETED;
        return $clone;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->id->value(),
            'fecha' => $this->fecha->value(),
            'hotel' => $this->hotel,
            'huesped' => $this->huesped,
            'fechaInicio' => $this->fechaInicio->value(),
            'fechaFin' => $this->fechaFin->value(),
            'valor' => $this->valor->value(),
            'valorFormatted' => $this->valor->formatted(),
            'habitacion' => $this->habitacion,
            'numAcompanantes' => $this->numAcompanantes,
            'pais' => $this->pais,
            'departamento' => $this->departamento,
            'ciudad' => $this->ciudad,
            'horaCheckin' => $this->horaCheckin,
            'horaCheckout' => $this->horaCheckout,
            'empleadoAtiende' => $this->empleadoAtiende,
            'empleadoDespide' => $this->empleadoDespide,
            'descripcion' => $this->descripcion,
            'status' => $this->status,
        );
    }
}
