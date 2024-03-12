<?php

use App\Http\Controllers\AuthController;
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

Route::prefix('auth')->group(function () {
    Route::post('google', [AuthController::class, 'google'])->name('auth.google');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
});

Route::prefix('profile')->middleware(['auth:user'])->group(function () {
    Route::get('me', [UserController::class, 'me'])->name('profile.name');
});
