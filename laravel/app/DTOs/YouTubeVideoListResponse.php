<?php

namespace App\DTOs;

class YouTubeVideoListResponse
{
    public string $id;

    public string $title;

    public string $thumbnail;

    public static function create(array $data)
    {
        $item = $data['items'][0];

        $instance = new self();
        $instance->id = $item['id'];
        $instance->title = $item['snippet']['localized']['title'];
        $instance->thumbnail = $item['snippet']['thumbnails']['default']['url'];

        return $instance;
    }
}
