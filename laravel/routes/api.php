<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('accountId', 'password');
    //userテーブルにインサート
    $user = App\Models\User::create([
        'accountId' => $credentials['accountId'],
        'password' => Hash::make($credentials['password']),
    ]);
    // 200 OK
    return response()->json([
        'user' => $user,
        'token' => $user->createToken('token-name')->plainTextToken,
    ]);
})->middleware('auth:sanctum');
