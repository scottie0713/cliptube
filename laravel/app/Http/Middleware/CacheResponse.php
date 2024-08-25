<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class CacheResponse
{
    public function handle($request, Closure $next)
    {
        $cacheKey = 'youtube_api_' . md5($request->fullUrl());

        // キャッシュがある場合はキャッシュを返す
        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }

        Log::info('CacheResponse handle 1');

        // キャッシュがない場合はリクエストを進める
        $response = $next($request);

        Log::info('CacheResponse handle 2');

        // キャッシュを保存する（1時間のキャッシュ）
        Cache::put($cacheKey, json_decode($response->getContent(), true), Config::get('youtube_api.cache.expired'));

        return $response;
    }
}
