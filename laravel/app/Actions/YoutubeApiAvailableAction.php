<?php

namespace App\Actions;

use App\Models\LogYoutubeApiEvent;
use Illuminate\Support\Facades\Cache;

class YoutubeApiAvailableAction
{
  const LIMIT_PER_HOUR = 100;

  public function execute($query)
  {
    $cacheKey = $this->getCacheKey();
    $client->setDeveloperKey(env('YOUTUBE_API_KEY'));


    try {
      $searchResponse = $youtube->search->list([
        'q' => $query,
        'maxResults' => 10,
        'part' => 'id,snippet',
        'type' => 'video',
      ]);

      // log_youtube_api_eventsに記録
      LogYoutubeApiEvent::create([
        'api' => 'search',
        'method' => 'list',
        'params' => json_encode(['q' => $query]),
      ]);

      return $searchResponse;
    } catch (\Exception $e) {
      return ['error' => 'YouTube API error: ' . $e->getMessage()];
    }
  }

  private static function getCacheKey(): string
  {
    $dtKey = Carbon::now()->format('YmdH');

    return "youtube-request-count.{$dtKey}";
  }
}
