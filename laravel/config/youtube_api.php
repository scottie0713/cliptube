<?php

// YouTube APIの設定

return [
    'limit' => env('YOUTUBE_API_LIMIT', 2),  // periodの間に許可するリクエスト数
    'period' => env('YOUTUBE_API_PERIOD', 60 * 60), // リクエスト数を制限する期間（秒）
    'cache' => [
        'expired' => env('YOUTUBE_API_CACHE_EXPIRED', 60 * 10), // 結果をキャッシュする期間（秒）
    ],
];
