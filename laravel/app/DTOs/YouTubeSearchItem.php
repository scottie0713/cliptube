<?php

namespace App\DTOs;

class YouTubeSearchItem
{
    public string $id;

    public string $title;

    public string $thumbnail;

    public string $publishedAt;

    public function __construct(array $data)
    {
        $this->id = $data['id']['videoId'];
        $this->title = $data['snippet']['title'];
        $this->thumbnail = $data['snippet']['thumbnails']['default']['url'];
        $this->publishedAt = $data['snippet']['publishedAt'];
    }
}
