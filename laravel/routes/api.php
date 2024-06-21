<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;

Route::post('/register', [RegisteredUserController::class, 'store']);
// Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/loggedin', [LoginController::class, 'loggedin'])->name('loggedin');
// Route::controller(RegisterController::class)->group(function () {
//     Route::post('register', 'register');
//     Route::post('login', 'login');
// });

// Route::middleware('auth:sanctum')->group(function () {
//     Route::resource('products', ProductController::class);
// });

// Route::middleware(['auth:sanctum'])->get('/user', 'UserController@index');
