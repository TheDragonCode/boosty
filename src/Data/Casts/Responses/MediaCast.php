<?php

namespace DragonCode\Boosty\Data\Casts\Responses;

use DragonCode\Boosty\Data\Responses\Media\ImageData;
use DragonCode\Boosty\Data\Responses\Media\VideoData;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

class MediaCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return match ($value['type']) {
            'ok_video' => VideoData::from($value),
            default    => ImageData::from($value),
        };
    }
}
