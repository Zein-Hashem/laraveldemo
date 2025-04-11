<?php
namespace App\Services;

use App\Models\Mission;
use App\Models\Driver;
use App\Models\Vehicle;
use App\DTO\MissionDTO;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function getPaginatedMissions(int $perPage = 10, int $page = 1): array
    {
        // Get missions with their relationships
        $missions = Mission::with(['driver', 'vehicle'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);
        
        // Transform each mission to DTO
        $missionDTOs = $missions->map(function ($mission) {
            return (new MissionDTO($mission))->toArray();
        });
        
        // Return paginated data with DTOs
        return [
            'data' => $missionDTOs,
            'meta' => [
                'current_page' => $missions->currentPage(),
                'from' => $missions->firstItem(),
                'last_page' => $missions->lastPage(),
                'per_page' => $missions->perPage(),
                'to' => $missions->lastItem(),
                'total' => $missions->total(),
            ]
        ];
    }
}
