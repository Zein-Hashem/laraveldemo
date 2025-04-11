<?php
namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use App\Services\MissionService;
use App\Http\Requests\StoreMissionRequest;
use App\Http\Requests\UpdateMissionRequest;
use Illuminate\Http\JsonResponse;

class MissionController extends Controller
{   
    public function __construct(private MissionService $missionService) {}

    public function store(StoreMissionRequest $request)
    {
        $mission = $this->missionService->create($request->validated());
        return response()->json($mission, 201);
    }
    
    public function update(UpdateMissionRequest $request, Mission $mission)
    {
        $mission = $this->missionService->update($mission, $request->validated());
        return response()->json($mission);
    }
    public function destroy(Mission $mission)
    {
        $this->missionService->delete($mission);
        return response()->json(['message' => 'Mission deleted']);
    }
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        
        $missions = $this->missionService->getPaginatedMissions($perPage, $page);
        
        return response()->json($missions);
    }
}
