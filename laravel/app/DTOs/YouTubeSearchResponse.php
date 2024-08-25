<?php

namespace App\DTOs;

use App\DTOs\YouTubeSearchItem;
use Google\Service\YouTube\SearchListResponse;

class YouTubeSearchResponse
{
    /**
     * @var array<YouTubeSearchItem>
     */
    public array $items;

    public static function create(SearchListResponse $data): YouTubeSearchResponse
    {
        $instance = new self();
        foreach ($data['items'] as $item) {
            $instance->items[] = new YouTubeSearchItem($item);
        }

        return $instance;
    }
}
