<?php
namespace App\DTO;

use App\Models\Mission;

class MissionDTO
{
    public int $id;
    public array $driver;
    public array $vehicle;
    public string $address;
    public string $description;
    public string $estimated_time;
    public ?string $final_time;

    public function __construct(Mission $mission)
    {
        $this->id = $mission->id;
        $this->driver = (new DriverDTO($mission->driver))->toArray();
        $this->vehicle = (new VehicleDTO($mission->vehicle))->toArray();
        $this->address = $mission->address;
        $this->description = $mission->description;
        $this->estimated_time = $mission->estimated_time;
        $this->final_time = $mission->final_time ? $mission->final_time : null;
    }

    public static function fromModel(Mission $mission): self
    {
        return new self($mission);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'driver' => $this->driver,
            'vehicle' => $this->vehicle,
            'address' => $this->address,
            'description' => $this->description,
            'estimated_time' => $this->estimated_time,
            'final_time' => $this->final_time,

        ];
    }
}