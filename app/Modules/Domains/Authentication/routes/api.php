<?php


use App\Modules\Domains\Authentication\src\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:api')->get('user', [AuthController::class, 'user']);
