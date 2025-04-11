<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use App\Services\DriverService;

class DriverController extends Controller
{
    public function __construct(private DriverService $driverService) {}

    public function store(Request $request)
    {
        $driver = $this->driverService->create($request->only('name'));
        return response()->json($driver);
    }

    public function update(Request $request, Driver $driver)
    {
        $driver = $this->driverService->update($driver, $request->only('name'));
        return response()->json($driver);
    }

    public function destroy(Driver $driver)
    {
        $this->driverService->delete($driver);
        return response()->json(['message' => 'Driver deleted']);
    }
}
