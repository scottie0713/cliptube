<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\UserVideoCheckpoint;
use App\Http\Controllers\Controller;

class VideoCheckpointController extends Controller
{
    public function list(Request $request, string $videoId): JsonResponse
    {
        // videoIdのバリデーション
        if (!preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoId)) {
            return response()->json([], 400);
        }

        $checkpoints = UserVideoCheckpoint::select('id', 'sec')
            ->where('user_id', $request->user()->id)
            ->where('video_id', $videoId)
            ->get();

        return response()->json($checkpoints, 200);
    }

    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'video_id' => 'required|string|max:32',
            'sec' => 'required|integer',
        ]);

        // user_id, video_id, secの存在チェック
        if (UserVideoCheckpoint::where('user_id', $request->user()->id)
            ->where('video_id', $request->input('video_id'))
            ->where('sec', $request->input('sec'))
            ->exists()
        ) {
            return response()->json([], 208);
        }

        $model = new UserVideoCheckpoint();
        $model->user_id = $request->user()->id;
        $model->video_id = $request->input('video_id');
        $model->sec = $request->input('sec');
        $model->save();

        return response()->json([], 200);
    }

    public function delete(Request $request, $id): JsonResponse
    {
        UserVideoCheckpoint::where('id', $id)->where('user_id', $request->user()->id)->delete();

        return response()->json([], 200);
    }
}
