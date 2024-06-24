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
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validate([
            'account_id' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // 認証が成功した場合の処理
        if (Auth::attempt($credentials)) {
            // セッションIDの再生成
            $request->session()->regenerate();
            return response()->json(['message' => 'Login successful']);
        }
        return response()->json(['message' => 'Login failed'], 401);
    }

    public function logout(Request $request): JsonResponse
    {
        // ユーザーの現在のアクセストークンを無効にする
        // $request->user()->currentAccessToken()->delete();
        $request->session()->invalidate();

        return response()->json(['message' => 'Logout successful']);
    }
}
