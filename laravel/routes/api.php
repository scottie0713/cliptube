<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\API\YoutubeController;
// use App\Http\Controllers\API\StoryController;
use App\Http\Controllers\API\ClipController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VideoController;
// use App\Http\Middleware\CacheResponse;

Route::get('/video/list', [VideoController::class, 'list']);
Route::get('/clip/{video_id}', [ClipController::class, 'list']);

Route::middleware('auth')->group(function () {
    // ユーザ情報
    Route::get('/user', [UserController::class, 'get']);
    Route::get('/user/video', [UserController::class, 'videoList']);
    // Route::middleware([
    //     CacheResponse::class,
    //     'throttle:' . Config::get('youtube_api.limit') . ',' . Config::get('youtube_api.period')
    // ])->get('/youtube/search', [YoutubeController::class, 'search']);
    Route::get('/youtube/search', [YoutubeController::class, 'search']);
    Route::get('/youtube/video', [YoutubeController::class, 'video']);
    // Route::post('/logout', [LoginController::class, 'logout'])
    //     ->name('logout');

    Route::get('/clip', [ClipController::class, 'listAll']);
    Route::get('/clip/{video_id}/my', [ClipController::class, 'myEnableList']);
    Route::get('/clip/{video_id}/my/trash', [ClipController::class, 'myDisableList']);
    Route::post('/clip', [ClipController::class, 'add']);
    Route::put('/user-clip/{id}', [ClipController::class, 'put']);

    Route::get('/video/list/my/{?query}', [VideoController::class, 'myList']);
    Route::post('/video', [VideoController::class, 'post']);
});

// auth.php取り込み
// require __DIR__ . '/auth.php';
