<?php

namespace App\DTOs;

use App\DTOs\YouTubeSearchItem;

class YouTubeSearchResponse
{
    /**
     * @var array<YouTubeSearchItem>
     */
    public array $items;

    public static function create(array $data): YouTubeSearchResponse
    {
        $instance = new self();
        foreach ($data['items'] as $item) {
            $instance->items[] = new YouTubeSearchItem($item);
        }

        return $instance;
    }
}
