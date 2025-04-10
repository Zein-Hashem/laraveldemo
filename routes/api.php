<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;


Route::post("/loginpost",[App\Http\Controllers\AuthController::class,"loginPost"])
    ->name("login.post");
Route::post("/registerpost",[App\Http\Controllers\AuthController::class,"registerPost"])
    ->name("registerpost");
Route::middleware('jwt.auth')->group(function () {
 Route::get('/me', [App\Http\Controllers\AuthController::class, 'me']);
});
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/teacher/{teacherId}', [StudentController::class, 'getByTeacher']);
