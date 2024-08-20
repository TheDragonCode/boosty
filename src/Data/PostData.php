<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Data;

use DragonCode\Boosty\Data\Transformers\ContentTransformer;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;

class PostData extends Data
{
    public string $title;

    #[WithTransformer(ContentTransformer::class)]
    public Collection $data;

    public int $price;

    public array $teaserData;

    public array $tags;

    public bool $hasChat;

    public string $advertiserInfo;
}
