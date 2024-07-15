<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\GetUserVideoListAction;
use App\Http\Requests\API\ClipListRequest;
use App\Http\Controllers\Controller;
use App\DTOs\UserGetResponse;
use App\Models\Video;

class VideoController extends Controller
{
    public function list(Request $request): JsonResponse
    {
        $response = Video::withClips();
        if ($request->query('query')) {
            $response = $response->where('title', 'like', '%' . $request->query('query') . '%');
        }
        return response()->json($response, 200);
    }

    public function myList(Request $request): JsonResponse
    {
        $response = Video::withClips()->where('user_id', $request->user()->id);
        return response()->json($response, 200);
    }

}
