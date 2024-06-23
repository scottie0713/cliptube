<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\GoogleServiceYoutubeListSearchAction;
use Illuminate\Http\JsonResponse;

class YoutubeController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $action = new GoogleServiceYoutubeListSearchAction();
        // return $action->execute($request->input('query'));
        return response()->json($action->execute($request->input('query')), 200);
    }
}
