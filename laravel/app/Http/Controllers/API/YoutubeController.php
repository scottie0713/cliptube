<?php

namespace App\Http\Controllers\API;

// use Illuminate\Http\Request;
use App\Actions\GoogleServiceYoutubeSearchListAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\YoutubeSearchRequest;
use Illuminate\Http\JsonResponse;


class YoutubeController extends Controller
{
    public function search(YoutubeSearchRequest $request): JsonResponse
    {
        $action = new GoogleServiceYoutubeSearchListAction();

        return response()->json($action->execute($request->input('query')), 200);
    }
}
