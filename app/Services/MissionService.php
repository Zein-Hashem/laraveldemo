<?php
namespace App\Services;

use App\Models\Mission;

class MissionService
{
    public function create(array $data): Mission
    {
        return Mission::create($data);
    }

    public function update(Mission $mission, array $data): Mission
    {
        $mission->update($data);
        return $mission;
    }

    public function delete(Mission $mission): void
    {
        $mission->delete();
    }
}
