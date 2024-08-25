<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\API\YoutubeController;
use App\Http\Controllers\API\ClipController;
use App\Http\Controllers\API\PlaylistController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VideoController;
// use App\Http\Middleware\CacheResponse;

Route::get('/video/list', [VideoController::class, 'list']);
Route::get('/clip/{video_id}', [ClipController::class, 'list']);

Route::middleware('auth')->group(function () {
    // ユーザ情報
    Route::get('/user', [UserController::class, 'get']);
    Route::get('/user/video', [UserController::class, 'videoList']);
    Route::get('/youtube/search', [YoutubeController::class, 'search']);
    Route::get('/youtube/video', [YoutubeController::class, 'video']);

    Route::get('/clip/{video_id}', [ClipController::class, 'enableList']);
    Route::get('/clip/{video_id}/my', [ClipController::class, 'myEnableList']);
    Route::get('/clip/{video_id}/my/trash', [ClipController::class, 'myDisableList']);
    Route::get('/clip/{video_id}/others', [ClipController::class, 'othersEnableList']);
    Route::post('/clip', [ClipController::class, 'add']);
    Route::put('/user-clip/{id}', [ClipController::class, 'put']);

    Route::get('/playlist/user/{user_hash}', [PlaylistController::class, 'list']);
    Route::post('/playlist', [PlaylistController::class, 'post']);
    Route::put('/playlist', [PlaylistController::class, 'put']);
    Route::delete('/playlist', [PlaylistController::class, 'delete']);

    Route::get('/video/list/{user_hash}', [VideoController::class, 'list']);
    Route::get('/video/list/my/all', [VideoController::class, 'myListAll']);
    Route::get('/video/{video_id}', [VideoController::class, 'info']);
    Route::post('/video', [VideoController::class, 'post']);
});

// auth.php取り込み
// require __DIR__ . '/auth.php';
