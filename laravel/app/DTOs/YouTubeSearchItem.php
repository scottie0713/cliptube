<?php

namespace App\DTOs;

use Google\Service\YouTube\SearchResult;

class YouTubeSearchItem
{
    public string $id;

    public string $title;

    public string $channelTitle;

    public string $thumbnail;

    public string $publishedAt;

    public function __construct(SearchResult $searchResult)
    {
        $this->id = $searchResult->id->videoId;
        $this->title = $searchResult->snippet->title;
        $this->channelTitle = $searchResult->snippet->channelTitle;
        $this->thumbnail = $searchResult->snippet->thumbnails->default->url;
        $this->publishedAt = $searchResult->snippet->publishedAt;
    }
}
