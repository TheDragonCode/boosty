<?php

namespace DragonCode\Boosty\Data\Responses;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class PostData extends Data
{
    public string $id;

    public string $title;

    public int $subscriptionLevelId;

    #[DataCollectionOf(TeaserData::class)]
    public Collection $teaser;

    public int $price;

    public string $signedQuery;

    public bool $hasAccess;
}
