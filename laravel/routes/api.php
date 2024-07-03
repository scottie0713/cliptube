<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\API\StoryController;
use App\Http\Controllers\API\ClipController;

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/youtube/search', [YoutubeController::class, 'search']);
    Route::get('/youtube/info', [YoutubeController::class, 'info']);
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    Route::get('/clip', [ClipController::class, 'listAll']);
    Route::get('/clip/{video_id}', [ClipController::class, 'list']);
    Route::get('/clip/{video_id}/trash', [ClipController::class, 'disableList']);
    Route::post('/clip', [ClipController::class, 'add']);
    Route::put('/user-clip/{id}', [ClipController::class, 'put']);
});

// auth.php取り込み
// require __DIR__ . '/auth.php';
