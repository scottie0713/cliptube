<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\UserClip;
use App\Models\Clip;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ClipController extends Controller
{
    public function list(Request $request, $videoId): JsonResponse
    {
        // videoIdのバリデーション
        if (!preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoId)) {
            return response()->json([], 400);
        }

        $checkpoints = UserClip::with([
            'clip' => function ($query) use ($videoId) {
                $query->where('video_id', $videoId);
            }
        ])
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json($checkpoints, 200);
    }

    public function listAll(Request $request): JsonResponse
    {
        $checkpoints = UserClip::with(['clip'])->where('user_id', $request->user()->id)
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

        DB::beginTransaction();
        try {
            $clipId = DB::table('clips')->insertGetId([
                'video_id' => $request->input('video_id'),
                'start_sec' => $request->input('start_sec'),
                'end_sec' => $request->input('end_sec'),
                'title' => $request->input('title'),
            ]);

            DB::table('user_clips')->insert([
                'user_id' => $request->user()->id,
                'clip_id' => $clipId,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([], 500);
        }

        return response()->json([], 200);
    }

    public function delete(Request $request, $id): JsonResponse
    {
        UserClip::where('id', $id)->where('user_id', $request->user()->id)
            ->delete();

        return response()->json([], 200);
    }
}
