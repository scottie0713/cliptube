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

        $checkpoints = UserVideoClip::select('id', 'title', 'description', 'start_sec', 'end_sec')
            ->where('user_id', $request->user()->id)
            ->where('video_id', $videoId)
            ->get();

        return response()->json($checkpoints, 200);
    }

    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'video_id' => 'required|string|max:32',
            'start_sec' => 'required|integer',
            'end_sec' => 'integer',
            'title' => 'string|max:255',
        ]);

        $model = new UserVideoClip();
        $model->user_id = $request->user()->id;
        $model->video_id = $request->input('video_id');
        $model->start_sec = $request->input('start_sec');
        $model->end_sec = $request->input('end_sec');
        $model->title = $request->input('title');
        $model->save();

        return response()->json([], 200);
    }

    public function delete(Request $request, $id): JsonResponse
    {
        UserVideoClip::where('id', $id)->where('user_id', $request->user()->id)
            ->delete();

        return response()->json([], 200);
    }
}
