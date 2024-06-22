<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;

class YoutubeSearchController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, [
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');

        $client = new Google_Client();
        $client->setDeveloperKey(env('YOUTUBE_API_KEY'));

        $youtube = new Google_Service_YouTube($client);

        try {
            $searchResponse = $youtube->search->listSearch('id,snippet', [
                'q' => $query,
                'maxResults' => 10,
            ]);

            return response()->json($searchResponse);
        } catch (\Exception $e) {
            return response()->json(['error' => 'YouTube API error: ' . $e->getMessage()], 500);
        }
    }
}
