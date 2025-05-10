<?php

// File: app/DTO/DriverDTO.php
namespace App\DTO;

use App\Models\Driver;

class DriverDTO
{
    public int $id;
    public string $name;

    public function __construct(Driver $driver)
    {
        $this->id = $driver->id;
        $this->name = $driver->name;
    }

    public static function fromModel(Driver $driver): self
    {
        return new self($driver);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}