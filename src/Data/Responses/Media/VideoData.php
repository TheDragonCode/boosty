<?php

namespace DragonCode\Boosty\Data\Responses\Media;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class VideoData extends Data
{
    public string $id;

    #[MapInputName('vid')]
    public string $videoId;

    public string $type;

    public string $title;

    public string $url;

    public int $duration;

    public int $timeCode;

    public int $viewCounter;

    public bool $showViewsCounter;

    public int $width;

    public int $height;

    public array $playerUrls;

    public string $failoverHost;

    #[MapInputName('uploadStatus')]
    public string $status;

    public bool $complete;
}
