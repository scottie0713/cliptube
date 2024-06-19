<?php

namespace App\Http\Controllers\API;

// use Illuminate\Http\Request;
use App\Actions\GoogleServiceYoutubeSearchListAction;
use App\Actions\GoogleServiceYoutubeVideoListAction;
use App\DTOs\YouTubeSearchResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\YoutubeSearchRequest;
use App\Http\Requests\API\YoutubeVideoRequest;
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

    public function video(YoutubeVideoRequest $request, $videoIdStr): JsonResponse
    {
        $videoIds = explode('-', $videoIdStr);
        $action = new GoogleServiceYoutubeVideoListAction($videoIds);

        return response()->json($action->execute($request->input('query')), 200);
    }
}
