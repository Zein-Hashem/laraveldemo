<?php
namespace App\DTO;

use App\Models\Vehicle;

class VehicleDTO
{
    public int $id;
    public string $name;

    public function __construct(Vehicle $vehicle)
    {
        $this->id = $vehicle->id;
        $this->name = $vehicle->name;
    }

    public static function fromModel(Vehicle $vehicle): self
    {
        return new self($vehicle);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
