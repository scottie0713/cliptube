<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('welcome');
});

//Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth'])->get('/member', [MemberController::class, 'index']);
