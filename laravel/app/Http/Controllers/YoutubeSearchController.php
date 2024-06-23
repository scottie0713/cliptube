<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;
use App\Actions\GoogleServiceYoutubeListSearchAction;

class YoutubeSearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $action = new GoogleServiceYoutubeListSearchAction();
        return $action->execute($request->input('query'));
    }
}
