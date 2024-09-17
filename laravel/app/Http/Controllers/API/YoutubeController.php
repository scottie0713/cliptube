<?php

namespace App\Http\Controllers\API;

use App\Actions\GoogleServiceYoutubeSearchListAction;
use App\DTOs\YouTubeSearchResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\YoutubeSearchRequest;
use Illuminate\Http\JsonResponse;


class YoutubeController extends Controller
{
    public function search(YoutubeSearchRequest $request): JsonResponse
    {
        $action = new GoogleServiceYoutubeSearchListAction();
        $actionResponse = $action->execute($request->input('query'));
        $response = YouTubeSearchResponse::create($actionResponse);
        return response()->json($response, 200);
    }
}
