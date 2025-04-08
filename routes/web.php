<?php

use App\Http\Controllers\AuthController;
Route::middleware("auth")->group(function(){
    Route::view("/","welcome")
    ->name('home');
});
Route::get("/login",[AuthController::class,"login"])
->name("login");
Route::get("/register",[AuthController::class,"register"])
->name('register');

