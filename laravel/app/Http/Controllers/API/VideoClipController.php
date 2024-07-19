<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\GetUserVideoListAction;
use App\Http\Controllers\Controller;
use App\DTOs\UserGetResponse;

class VideoClipController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $response = UserGetResponse::create($request->user());
        return response()->json($response, 200);
    }

    public function list(Request $request): JsonResponse
    {
        $action = new GetUserVideoListAction();

        try {
            $responses = $action->execute($request->user()->id);
            return response()->json($responses, 200);
        } catch (\Exception $e) {
            dump($e->getMessage());
            return response()->json([$e->getMessage()], 500);
        }
    }

    public function videoList(Request $request): JsonResponse
    {
        $action = new GetUserVideoListAction();

        try {
            $responses = $action->execute($request->user()->id);
            return response()->json($responses, 200);
        } catch (\Exception $e) {
            dump($e->getMessage());
            return response()->json([$e->getMessage()], 500);
        }
    }
}
