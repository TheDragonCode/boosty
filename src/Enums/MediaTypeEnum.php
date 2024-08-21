<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Enums;

enum MediaTypeEnum: string
{
    case All   = 'all';
    case Image = 'image';
    case Video = 'video';
}
