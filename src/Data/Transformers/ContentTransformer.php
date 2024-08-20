<?php

namespace DragonCode\Boosty\Data\Transformers;

use DragonCode\Boosty\Data\Content\ContentBlockData;
use DragonCode\Boosty\Services\Block;
use Illuminate\Support\Str;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class ContentTransformer implements Transformer
{
    public function __construct(
        protected Block $block
    ) {}

    public function transform(
        DataProperty $property,
        mixed $value,
        TransformationContext $context
    ): array|ContentBlockData {
        if ($value instanceof ContentBlockData) {
            return $value;
        }

        if (is_string($value)) {
            return Str::isUrl($value)
                ? $this->block->url($value)
                : $this->block->text($value);
        }

        return collect($value)
            ->map(fn (mixed $item) => [
                $this->transform($property, $item, $context),
                $this->block->endBlock(),
            ])
            ->collapse()
            ->all();
    }
}
