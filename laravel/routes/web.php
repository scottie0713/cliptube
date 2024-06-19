<?php

use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('login/twitter', [SocialiteController::class, 'redirectToTwitter'])->name('login.twitter');
Route::get('login/twitter/callback', [SocialiteController::class, 'handleTwitterCallback']);
Route::get('logout', [SocialiteController::class, 'logout']);

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*')->name('app');
