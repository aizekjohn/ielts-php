<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SpeakingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WritingController;
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

Route::middleware(['auth:user'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('me', [UserController::class, 'me'])->name('profile.me');
        Route::post('generate-ref-code', [UserController::class, 'generateRefCode'])->name('profile.generate-ref-code');
        Route::post('/', [UserController::class, 'editProfile'])->name('profile.edit');
        Route::delete('avatar', [UserController::class, 'removeAvatar'])->name('profile.remove-avatar');
    });

    Route::prefix('speaking')->group(function () {
        Route::get('categories', [SpeakingController::class, 'categories'])->name('speaking.categories');
        Route::get('categories/{speakingCategory}/questions', [SpeakingController::class, 'questions'])->name('speaking.questions');
        Route::get('questions/{speakingQuestion}', [SpeakingController::class, 'singleQuestion'])->name('speaking.single-question');
    });

    Route::prefix('writing')->group(function () {
        Route::get('categories', [WritingController::class, 'categories'])->name('writing.categories');
        Route::get('categories/{writingCategory}/questions', [WritingController::class, 'questions'])->name('writing.questions');
        Route::get('questions/{writingQuestion}', [WritingController::class, 'singleQuestion'])->name('writing.single-question');
    });

    Route::prefix('news')->group(function () {
       Route::get('', [NewsController::class, 'list'])->name('news.list');
        Route::get('{news}', [NewsController::class, 'single'])->name('news.single');
    });
});
