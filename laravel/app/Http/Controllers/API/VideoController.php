<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\API\VideoPostRequest;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\User;

class VideoController extends Controller
{
    public function list(Request $request, $userHash): JsonResponse
    {
        $userId = User::where('hash', $userHash)->first()->id;
        $response = Video::whereHas('clips', function ($clipQuery) use ($userId) {
            $clipQuery->whereHas('userClips', function ($userClipQuery) use ($userId) {
                $userClipQuery->where('user_id', $userId)
                    ->where('enabled', true);
            });
        })->get();

        return response()->json($response, 200);
    }

    public function myListAll(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $response = Video::whereHas('clips', function ($clipQuery) use ($userId) {
            $clipQuery->whereHas('userClips', function ($userClipQuery) use ($userId) {
                $userClipQuery->where('user_id', $userId)
                    ->where('enabled', true);
            });
        })->get();

        return response()->json($response, 200);
    }

    public function info(Request $request, string $videoId): JsonResponse
    {
        $response = Video::where('id', $videoId)->first();
        return response()->json($response, 200);
    }

    public function post(VideoPostRequest $request): JsonResponse
    {
        Video::updateOrCreate(
            [
                'id' => $request->input('id')
            ],
            [
                'title' => $request->input('title'),
                'thumbnail' => $request->input('thumbnail'),
            ]
        );

        return response()->json([], 201);
    }
}
