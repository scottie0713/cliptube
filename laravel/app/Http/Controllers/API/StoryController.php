<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Story;
use App\Models\StoryClip;
use App\Models\UserStory;
use App\Http\Controllers\Controller;

class StoryController extends Controller
{
    public function list(Request $request, string $videoId): JsonResponse
    {
        // videoIdのバリデーション
        if (!preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoId)) {
            return response()->json([], 400);
        }

        $checkpoints = UserStory::select('id', 'sec')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json($checkpoints, 200);
    }

    public function add(Request $request): JsonResponse
    {
        $request->validate([
            'story_id' => 'required|integer',
        ]);

        // user_id, video_id, secの存在チェック
        if (UserStory::where('user_id', $request->user()->id)
            ->where('story_id', $request->input('story_id'))
            ->exists()
        ) {
            return response()->json([], 208);
        }

        $model = new UserStory();
        $model->user_id = $request->user()->id;
        $model->story_id = $request->input('video_id');
        $model->save();

        return response()->json([], 200);
    }

    public function delete(Request $request, $id): JsonResponse
    {
        UserStory::where('id', $id)->where('user_id', $request->user()->id)->delete();

        return response()->json([], 200);
    }
}
