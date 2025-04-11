<?php
namespace App\Services;

use App\Models\Driver;

class DriverService
{
    public function create(array $data): Driver
    {
        return Driver::create($data);
    }

    public function update(Driver $driver, array $data): Driver
    {
        $driver->update($data);
        return $driver;
    }

    public function delete(Driver $driver): void
    {
        $driver->delete();
    }
}
