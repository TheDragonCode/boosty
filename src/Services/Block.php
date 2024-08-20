<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Services;

use DragonCode\Boosty\Data\Content\ContentBlockData;

class Block
{
    public function __construct(
        protected Styler $styler
    ) {}

    public function text(string $content): ContentBlockData
    {
        return $this->block(
            $this->styler->fromHtml($content),
        );
    }

    public function url(string $url): ContentBlockData
    {
        return $this->block(
            content    : [PHP_EOL . $url, 'unstyled', []],
            type       : 'link',
            modificator: $url,
            modKey     : 'url'
        );
    }

    public function endBlock(): ContentBlockData
    {
        return $this->block(content: '', modificator: 'BLOCK_END');
    }

    protected function block(
        array|string $content,
        string $type = 'text',
        string $modificator = '',
        string $modKey = 'modificator'
    ): ContentBlockData {
        return ContentBlockData::from(
            compact('content', 'type', 'modificator', 'modKey')
        );
    }
}
