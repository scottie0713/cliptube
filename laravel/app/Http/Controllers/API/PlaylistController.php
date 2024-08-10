<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\API\VideoPostRequest;
use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\User;

class PlaylistController extends Controller
{
    public function list(Request $request, $userHash): JsonResponse
    {
        $userId = User::where('hash', $userHash)->first()->id;
        $response = Playlist::whereHas('userPlaylists', function ($clipQuery) use ($userId) {
            $clipQuery->where('user_id', $userId)
                ->where('enabled', true);
        })->get();

        return response()->json($response, 200);
    }

    public function info(Request $request, string $playlistId): JsonResponse
    {
        $response = Playlist::where('id', $playlistId)->first();
        return response()->json($response, 200);
    }

    public function post(VideoPostRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $playlist = new Playlist();
            $playlist->title = $request->input('title');
            $playlist->description = $request->input('description');
            $playlist->hash = Str::random(6);
            $playlist->save();
            $playlist->userPlaylists()->create([
                'user_id' => $request->user()->id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dump($e->getMessage());
            return response()->json([], 500);
        }

        return response()->json([], 201);
    }
}
