<?php

namespace DragonCode\Boosty\Data\Responses;

use DragonCode\Boosty\Data\Responses\Media\ImageData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class MediaPostData extends Data
{
    #[MapInputName('media.0')]
    public ImageData $media;

    public PostData $post;
}
