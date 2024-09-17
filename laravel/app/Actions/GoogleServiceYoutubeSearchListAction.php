<?php

namespace App\Actions;

class GoogleServiceYoutubeSearchListAction
{
    private $youtubeService = null;

    public function __construct()
    {
        $googleClient = new \Google\Client();
        $googleClient->setDeveloperKey(env('YOUTUBE_API_KEY'));
        $this->youtubeService = new \Google\Service\YouTube($googleClient);
    }

    public function execute($query)
    {
        // YouTube Data API v3 で検索を実行
        $searchListResponse = $this->search($query);

        return $searchListResponse;
    }

    private function search(string $query)
    {
        // return $this->responseMock();
        return $this->youtubeService->search->listSearch('snippet', [
            'q' => $query,
            'maxResults' => 20,
            'type' => 'video',
        ]);
    }

    private function responseMock()
    {
        $json = <<<JSON
 {
  "kind": "youtube#searchListResponse",
  "etag": "pIQ736zcZE48vYzFWpoQIJv2WVY",
  "nextPageToken": "CAUQAA",
  "regionCode": "JP",
  "pageInfo": {
    "totalResults": 234,
    "resultsPerPage": 5
  },
  "items": [
    {
      "kind": "youtube#searchResult",
      "etag": "u2v65DuzC1wgsZt6MWifhs2YfWw",
      "id": {
        "kind": "youtube#video",
        "videoId": "Cri2DJpC9PQ"
      },
      "snippet": {
        "publishedAt": "2022-06-10T21:06:14Z",
        "channelId": "UCu0lW58jcjGRfkGTWt6GE1w",
        "title": "ナポリの男たちの「クロノ・トリガー」クリアまで配信【祝6周年】#1",
        "description": "ナポリの男たち結成6周年企画！「クロノ・トリガー」をクリアまで長時間配信します。 続き→https://youtu.be/uXpNXL_W-dI ...",
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
          }
        },
        "channelTitle": "ナポリの男たち",
        "liveBroadcastContent": "none",
        "publishTime": "2022-06-10T21:06:14Z"
      }
    },
    {
      "kind": "youtube#searchResult",
      "etag": "yf2LWgp4PQuZGv5CTmVW6sGnqFQ",
      "id": {
        "kind": "youtube#video",
        "videoId": "uXpNXL_W-dI"
      },
      "snippet": {
        "publishedAt": "2022-06-11T09:32:11Z",
        "channelId": "UCu0lW58jcjGRfkGTWt6GE1w",
        "title": "ナポリの男たちの「クロノ・トリガー」クリアまで配信【祝6周年】 #2",
        "description": "ナポリの男たち結成6周年企画！「クロノ・トリガー」をクリアまで長時間配信します。 続き→https://youtu.be/wK3ebMX2TZU ...",
        "thumbnails": {
          "default": {
            "url": "https://i.ytimg.com/vi/uXpNXL_W-dI/default.jpg",
            "width": 120,
            "height": 90
          },
          "medium": {
            "url": "https://i.ytimg.com/vi/uXpNXL_W-dI/mqdefault.jpg",
            "width": 320,
            "height": 180
          },
          "high": {
            "url": "https://i.ytimg.com/vi/uXpNXL_W-dI/hqdefault.jpg",
            "width": 480,
            "height": 360
          }
        },
        "channelTitle": "ナポリの男たち",
        "liveBroadcastContent": "none",
        "publishTime": "2022-06-11T09:32:11Z"
      }
    },
    {
      "kind": "youtube#searchResult",
      "etag": "140kQn7SrcLyeSt5vZc1dqLK79I",
      "id": {
        "kind": "youtube#video",
        "videoId": "wK3ebMX2TZU"
      },
      "snippet": {
        "publishedAt": "2022-06-11T10:32:06Z",
        "channelId": "UCu0lW58jcjGRfkGTWt6GE1w",
        "title": "ナポリの男たちの「クロノ・トリガー」クリアまで配信【祝6周年】#3",
        "description": "ナポリの男たち結成6周年企画！「クロノ・トリガー」をクリアまで長時間配信します。 part1→https://youtu.be/Cri2DJpC9PQ ...",
        "thumbnails": {
          "default": {
            "url": "https://i.ytimg.com/vi/wK3ebMX2TZU/default.jpg",
            "width": 120,
            "height": 90
          },
          "medium": {
            "url": "https://i.ytimg.com/vi/wK3ebMX2TZU/mqdefault.jpg",
            "width": 320,
            "height": 180
          },
          "high": {
            "url": "https://i.ytimg.com/vi/wK3ebMX2TZU/hqdefault.jpg",
            "width": 480,
            "height": 360
          }
        },
        "channelTitle": "ナポリの男たち",
        "liveBroadcastContent": "none",
        "publishTime": "2022-06-11T10:32:06Z"
      }
    }
  ]
}
JSON;
        // dump(json_decode($json));
        // return $json;
        return json_decode($json, true);
    }
}
