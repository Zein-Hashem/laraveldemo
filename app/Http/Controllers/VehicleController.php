<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Services\VehicleService;

class VehicleController extends Controller
{
    public function __construct(private VehicleService $vehicleService) {}

    public function store(Request $request)
    {
        $vehicle = $this->vehicleService->create($request->only('name'));
        return response()->json($vehicle);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicle = $this->vehicleService->update($vehicle, $request->only('name'));
        return response()->json($vehicle);
    }

    public function destroy(Vehicle $vehicle)
    {
        $this->vehicleService->delete($vehicle);
        return response()->json(['message' => 'Vehicle deleted']);
    }
}
    
