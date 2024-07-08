<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\GetUserVideoListAction;
use App\Http\Requests\API\ClipListRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
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
