<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\YoutubeController;
use App\Http\Controllers\API\VideoCheckpointController;
use App\Http\Controllers\API\VideoClipController;

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/youtube/search', [YoutubeController::class, 'search']);
    Route::get('/youtube/info', [YoutubeController::class, 'info']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/checkpoint/{video_id}', [VideoCheckpointController::class, 'list']);
    Route::post('/checkpoint', [VideoCheckpointController::class, 'add']);
    Route::delete('/checkpoint/{id}', [VideoCheckpointController::class, 'delete']);

    Route::get('/clip/{video_id}', [VideoClipController::class, 'list']);
    Route::post('/clip', [VideoClipController::class, 'add']);
    Route::delete('/clip/{id}', [VideoClipController::class, 'delete']);
});

// auth.php取り込み
// require __DIR__ . '/auth.php';
