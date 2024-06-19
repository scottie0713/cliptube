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

    public function put(Request $request): JsonResponse
    {
        $playlistId = $request->input('playlist_id');
        // playlist_idがuser_playlistに存在して、それが自分でなければエラー
        $userPlaylist = $request->user()
            ->userPlaylists()
            ->where('playlist_id', $playlistId)->first();
        if (!$userPlaylist) {
            return response()->json([], 403);
        }

        try {
            $playlist = Playlist::where('id', $request->input('id'))->first();
            $playlist->title = $request->input('title');
            $playlist->description = $request->input('description');
            $playlist->save();
        } catch (\Exception $e) {
            return response()->json([], 500);
        }

        return response()->json([], 200);
    }

    public function delete(Request $request): JsonResponse
    {
        $playlistHash = $request->input('playlist_hash');
        
        if (!$request->user()->isMine($playlistHash)) {
            return response()->json([], 403);
        }
    
        // user_playlists.hash から、user_playlists.idを取得
        $userPlaylist = $request->user()
            ->userPlaylists()
            ->where('playlist_id', $request->input('id'))->first();

        try {
            $userPlaylist = $request->user()
                ->userPlaylists()
                ->where('playlist_id', $request->input('id'))->first();
            $userPlaylist->enabled = false;
            $userPlaylist->save();
        } catch (\Exception $e) {
            return response()->json([], 500);
        }

        return response()->json([], 200);
    }
}
