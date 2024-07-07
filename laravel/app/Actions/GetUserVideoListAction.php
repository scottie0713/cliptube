<?php

namespace App\Actions;

use Google_Client;
use Google_Service_YouTube;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * 
 */
class GetUserVideoListAction
{
    public function execute(int $userId)
    {
        $videos = $this->getVideoIds($userId);
        $responses = [];
        dump($videos);
        foreach ($videos as $video) {
            // if ($this->hasVideoCache($video->video_id)) {
            //     $responses[] = $this->getVideoByCache($video->video_id);
            //     continue;
            // }
            $responses[] = $this->getVideoByYoutubeAPI($video->video_id);
        }
        dump($responses);
        return $responses;
    }

    private function getVideoIds(int $userId)
    {
        return DB::table('user_clips')
            ->join('clips', 'user_clips.clip_id', '=', 'clips.id')
            ->select('clips.video_id')
            ->where('user_clips.user_id', $userId)
            ->where('user_clips.enabled', true)
            ->groupBy('clips.video_id')
            ->get();
    }

    private function hasVideoCache(string $videoId)
    {
        Cache::has('YoutubeVideoInfo-' . $videoId);
    }

    private function getVideoByCache(string $videoId)
    {
        Cache::get('YoutubeVideoInfo-' . $videoId);
    }

    private function putVideoCache(string $videoId, $response)
    {
        Cache::put('YoutubeVideoInfo-' . $videoId, $response, 60 * 60 * 24 * 3);
    }

    private function getVideoByYoutubeAPI(string $videoId)
    {
        // $client = new Google_Client();
        // $client->setDeveloperKey(env('YOUTUBE_API_KEY'));

        // $youtube = new Google_Service_YouTube($client);

        // $searchResponse = $youtube->videos->listVideos([
        //     'id' => $videoId,
        //     'part' => 'id,snippet',
        // ]);
        $searchResponse = $this->responseMock();
        dump($searchResponse);

        $this->putVideoCache($videoId, $searchResponse);

        return $searchResponse;
    }

    private function responseMock()
    {
        $json = <<<JSON
{
  "kind": "youtube#videoListResponse",
  "etag": "Gh9C5ncM769SGg7SY_vLNztZ5P4",
  "items": [
    {
      "kind": "youtube#video",
      "etag": "MyD55C4JbgqCQbJMjoP3m274Ijg",
      "id": "Cri2DJpC9PQ",
      "snippet": {
        "publishedAt": "2022-06-10T21:06:14Z",
        "channelId": "UCu0lW58jcjGRfkGTWt6GE1w",
        "title": "ナポリの男たちの「クロノ・トリガー」クリアまで配信【祝6周年】#1",
        "description": "ナポリの男たち結成6周年企画！「クロノ・トリガー」をクリアまで長時間配信します。\n続き→https://youtu.be/uXpNXL_W-dI\n\n【グループまとめ】\nYoutubeチャンネル → https://www.youtube.com/c/napolimens\nグループツイッター → https://twitter.com/napolimens\nniconicoチャンネル → http://ch.nicovideo.jp/naporich\n\n【ナポリの男たち】\n・ジャック・オ・蘭たん：https://www.youtube.com/channel/UCMzLWawc9x3rUsqYDEfgqzA\n・すぎる：https://www.youtube.com/channel/UCf8qSt6UzZ2tOtht5iyJlaA\n・hacchi：https://twitter.com/hacchi_nico/\n・shu3：https://www.youtube.com/channel/UCO-n0T-9rJ4f6smFPK3vFiQ",
        "thumbnails": {
          "default": {
            "url": "https://i.ytimg.com/vi/Cri2DJpC9PQ/default.jpg",
            "width": 120,
            "height": 90
          },
          "medium": {
            "url": "https://i.ytimg.com/vi/Cri2DJpC9PQ/mqdefault.jpg",
            "width": 320,
            "height": 180
          },
          "high": {
            "url": "https://i.ytimg.com/vi/Cri2DJpC9PQ/hqdefault.jpg",
            "width": 480,
            "height": 360
          },
          "standard": {
            "url": "https://i.ytimg.com/vi/Cri2DJpC9PQ/sddefault.jpg",
            "width": 640,
            "height": 480
          },
          "maxres": {
            "url": "https://i.ytimg.com/vi/Cri2DJpC9PQ/maxresdefault.jpg",
            "width": 1280,
            "height": 720
          }
        },
        "channelTitle": "ナポリの男たち",
        "tags": [
          "ゲーム",
          "ナポリの男たち",
          "蘭たん",
          "すぎる",
          "hacchi",
          "shu3"
        ],
        "categoryId": "20",
        "liveBroadcastContent": "none",
        "defaultLanguage": "ja",
        "localized": {
          "title": "ナポリの男たちの「クロノ・トリガー」クリアまで配信【祝6周年】#1",
          "description": "ナポリの男たち結成6周年企画！「クロノ・トリガー」をクリアまで長時間配信します。\n続き→https://youtu.be/uXpNXL_W-dI\n\n【グループまとめ】\nYoutubeチャンネル → https://www.youtube.com/c/napolimens\nグループツイッター → https://twitter.com/napolimens\nniconicoチャンネル → http://ch.nicovideo.jp/naporich\n\n【ナポリの男たち】\n・ジャック・オ・蘭たん：https://www.youtube.com/channel/UCMzLWawc9x3rUsqYDEfgqzA\n・すぎる：https://www.youtube.com/channel/UCf8qSt6UzZ2tOtht5iyJlaA\n・hacchi：https://twitter.com/hacchi_nico/\n・shu3：https://www.youtube.com/channel/UCO-n0T-9rJ4f6smFPK3vFiQ"
        },
        "defaultAudioLanguage": "ja"
      },
      "contentDetails": {
        "duration": "PT10H55M34S",
        "dimension": "2d",
        "definition": "hd",
        "caption": "false",
        "licensedContent": true,
        "contentRating": {},
        "projection": "rectangular"
      },
      "statistics": {
        "viewCount": "915719",
        "likeCount": "8291",
        "favoriteCount": "0",
        "commentCount": "161"
      }
    }
  ],
  "pageInfo": {
    "totalResults": 1,
    "resultsPerPage": 1
  }
}
JSON;
        return json_decode($json, true);
    }
}
