<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\MissionController;


Route::post("/loginpost",[App\Http\Controllers\AuthController::class,"loginPost"])
    ->name("login.post");
Route::post("/registerpost",[App\Http\Controllers\AuthController::class,"registerPost"])
    ->name("registerpost");
Route::middleware('jwt.auth')->group(function () {
 Route::get('/me', [App\Http\Controllers\AuthController::class, 'me']);
});
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/teacher/{teacherId}', [StudentController::class, 'getByTeacher']);

Route::prefix('drivers')->group(function () {
    Route::post('/', [DriverController::class, 'store']);
    Route::put('{driver}', [DriverController::class, 'update']);
    Route::delete('{driver}', [DriverController::class, 'destroy']);
});

Route::prefix('vehicles')->group(function () {
    Route::post('/', [VehicleController::class, 'store']);
    Route::put('{vehicle}', [VehicleController::class, 'update']);
    Route::delete('{vehicle}', [VehicleController::class, 'destroy']);
});

Route::prefix('missions')->group(function () {
    Route::post('/', [MissionController::class, 'store']);
    Route::patch('{mission}', [MissionController::class, 'update']);
    Route::delete('{mission}', [MissionController::class, 'destroy']);
    Route::get('/', [MissionController::class, 'index']);
});

