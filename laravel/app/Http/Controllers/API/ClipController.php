<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Clip;
use App\Models\UserClip;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClipController extends Controller
{
    public function enableList(Request $request, $videoId): JsonResponse
    {
        $response = Clip::whereHas('userClips', function ($query) {
            $query->where('enabled', true);
        })
            ->where('video_id', $videoId)
            ->orderBy('start_sec', 'asc')
            ->get();

        return response()->json($response, 200);
    }

    public function myEnableList(Request $request, $videoId): JsonResponse
    {
        $userId = $request->user()->id;
        $response = Clip::whereHas('userClips', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('enabled', true);
        })
            ->where('video_id', $videoId)
            ->orderBy('start_sec', 'asc')
            ->get();

        return response()->json($response, 200);
    }

    public function othersEnableList(Request $request, $videoId): JsonResponse
    {
        $userId = $request->user()->id;
        $response = Clip::whereHas('userClips', function ($query) use ($userId) {
            $query->where('user_id', '!=', $userId)
                ->where('enabled', true);
        })
            ->where('video_id', $videoId)
            ->orderBy('start_sec', 'asc')
            ->get();

        return response()->json($response, 200);
    }

    public function myDisableList(Request $request, $videoId): JsonResponse
    {
        $userId = $request->user()->id;
        $clips = Clip::whereHas('userClips', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('enabled', false);
        })
            ->where('video_id', $videoId)
            ->orderBy('start_sec', 'asc')
            ->get();

        return response()->json($clips, 200);
    }

    public function listAll(Request $request): JsonResponse
    {
        $userClips = UserClip::with(['clip'])->where('user_id', $request->user()->id)
            ->get();

        return response()->json($userClips, 200);
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
                'hash' => Str::random(6),
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
            dump($e->getMessage());
            return response()->json([], 500);
        }

        return response()->json([], 200);
    }

    public function put(Request $request, $id): JsonResponse
    {
        $request->validate([
            'enabled' => 'required|boolean',
        ]);

        UserClip::where('id', $id)->where('user_id', $request->user()->id)
            ->update([
                'enabled' => $request->input('enabled'),
            ]);

        return response()->json([], 200);
    }

    public function delete(Request $request, $id): JsonResponse
    {
        UserClip::where('id', $id)->where('user_id', $request->user()->id)
            ->delete();

        return response()->json([], 200);
    }
}
