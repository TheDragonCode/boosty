<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Data\Content;

use Spatie\LaravelData\Data;

class ContentBlockData extends Data
{
    public string $content;

    public string $type;

    public string $modificator = '';

    public string $modKey = 'modificator';

    public function toArray(): array
    {
        return [
            'type'        => $this->type,
            'content'     => json_encode($this->content),
            $this->modKey => $this->modificator,
        ];
    }
}
