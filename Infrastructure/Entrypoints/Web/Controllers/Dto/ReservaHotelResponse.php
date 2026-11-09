<?php

declare(strict_types=1);

final class ReservaHotelResponse
{
    private string $id;
    private string $fecha;
    private string $hotel;
    private string $huesped;
    private string $fechaInicio;
    private string $fechaFin;
    private float $valor;
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
        string $id,
        string $fecha,
        string $hotel,
        string $huesped,
        string $fechaInicio,
        string $fechaFin,
        float $valor,
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
        $this->id = $id;
        $this->fecha = $fecha;
        $this->hotel = $hotel;
        $this->huesped = $huesped;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->valor = $valor;
        $this->habitacion = $habitacion;
        $this->numAcompanantes = $numAcompanantes;
        $this->pais = $pais;
        $this->departamento = $departamento;
        $this->ciudad = $ciudad;
        $this->horaCheckin = $horaCheckin;
        $this->horaCheckout = $horaCheckout;
        $this->empleadoAtiende = $empleadoAtiende;
        $this->empleadoDespide = $empleadoDespide;
        $this->descripcion = $descripcion;
        $this->status = $status;
    }

    public function getId(): string { return $this->id; }
    public function getFecha(): string { return $this->fecha; }
    public function getHotel(): string { return $this->hotel; }
    public function getHuesped(): string { return $this->huesped; }
    public function getFechaInicio(): string { return $this->fechaInicio; }
    public function getFechaFin(): string { return $this->fechaFin; }
    public function getValor(): float { return $this->valor; }
    public function getValorFormatted(): string { return number_format($this->valor, 2, '.', ','); }
    public function getHabitacion(): string { return $this->habitacion; }
    public function getNumAcompanantes(): int { return $this->numAcompanantes; }
    public function getPais(): string { return $this->pais; }
    public function getDepartamento(): string { return $this->departamento; }
    public function getCiudad(): string { return $this->ciudad; }
    public function getHoraCheckin(): string { return $this->horaCheckin; }
    public function getHoraCheckout(): string { return $this->horaCheckout; }
    public function getEmpleadoAtiende(): string { return $this->empleadoAtiende; }
    public function getEmpleadoDespide(): string { return $this->empleadoDespide; }
    public function getDescripcion(): string { return $this->descripcion; }
    public function getStatus(): string { return $this->status; }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->id,
            'fecha' => $this->fecha,
            'hotel' => $this->hotel,
            'huesped' => $this->huesped,
            'fechaInicio' => $this->fechaInicio,
            'fechaFin' => $this->fechaFin,
            'valor' => $this->valor,
            'valorFormatted' => $this->getValorFormatted(),
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
