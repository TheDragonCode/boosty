<?php

namespace DragonCode\Boosty\Data\Responses\Media;

use Spatie\LaravelData\Data;

class ImageData extends Data
{
    public string $id;

    public string $type;

    public string $url;

    public int $height;

    public int $width;

    public int $size;

    public string $rendition;
}
