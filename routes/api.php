<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [UserController::class, 'create']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/cars', [CarController::class, 'show']);
    Route::get('/branch', [BranchController::class, 'show']);
    Route::post('/booking', [BookingController::class, 'create']);
    Route::get('/profile', [UserController::class, 'show']);
    Route::get('/booking/history', [BookingController::class, 'historyShow']);
    Route::get('/booking/active', [BookingController::class, 'active']);
    Route::get('/booking/{code}', [BookingController::class, 'show']);
    Route::patch('/booking/{code}/close', [BookingController::class, 'close']);
});

