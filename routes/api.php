<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DivisionController;
use App\Http\Controllers\API\EmployeeController;

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('divisions', [DivisionController::class, 'index']);
    Route::get('employees', [EmployeeController::class, 'index']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::put('employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('employees/{id}', [EmployeeController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});

