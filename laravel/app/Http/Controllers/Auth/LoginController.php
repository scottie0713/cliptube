<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $user->tokens()->delete();
            $token = $user->createToken("login:user{$user->id}")->plainTextToken;

            return response()->json([
                'result' => true,
                'token' => $token
            ], Response::HTTP_OK);
        }
        return response()->json([
            'result' => false,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function loggedin()
    {
        return response()->json('', 200);
    }
}
