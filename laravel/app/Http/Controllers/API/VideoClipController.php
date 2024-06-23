<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\UserVideoClip;
use App\Http\Controllers\Controller;

class VideoClipController extends Controller
{
    public function list(Request $request, $videoId): JsonResponse
    {
        // videoIdのバリデーション
        if (!preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoId)) {
            return response()->json([], 400);
        }

        $checkpoints = UserVideoClip::select('title', 'description', 'start', 'end')->where('user_id', $request->user()->id)
            ->where('video_id', $videoId)
            ->get();

        return response()->json($checkpoints, 200);
    }

    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'video_id' => 'required|string|max:32',
            'start' => 'required|integer',
            'end' => 'required|integer',
        ]);

        $userVideoClip = new UserVideoClip();
        $userVideoClip->user_id = $request->user()->id;
        $userVideoClip->video_id = $request->input('video_id');
        $userVideoClip->start = $request->input('sec');
        $userVideoClip->end = $request->input('sec');
        $userVideoClip->save();

        return response()->json([], 200);
    }

    public function delete(Request $request, $id): JsonResponse
    {
        UserVideoClip::where('id', $id)->where('user_id', $request->user()->Id)
            ->delete();

        return response()->json([], 200);
    }
}
