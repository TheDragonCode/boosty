<?php

namespace DragonCode\Boosty\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AccessTokenData extends Data
{
    public string $accessToken;

    public string $refreshToken;
}
