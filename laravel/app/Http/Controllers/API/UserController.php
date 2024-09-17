<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\DTOs\UserGetResponse;

class UserController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $response = UserGetResponse::create($request->user());
        return response()->json($response, 200);
    }
}
