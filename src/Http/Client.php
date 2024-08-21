<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Http;

use DragonCode\Boosty\Data\PostData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Client
{
    protected string $baseUrl = 'https://api.boosty.to/v1/';

    public function __construct(
        protected string $blog,
        protected string $token,
    ) {}

    public function send(string $uri, PostData $data): mixed
    {
        return $this->request()
            ->throw()
            ->post($this->url($uri), $data->toArray())
            ->throw()
            ->json();
    }

    public function media(string $content, string $mimeType): string
    {
        return $this->request()
            ->withBody($content, $mimeType)
            ->throw()
            ->post('https://uploadimg.boosty.to/v1/media_data/image/')
            ->throw()
            ->collect()
            ->filter()
            ->first();
    }

    public function request(): PendingRequest
    {
        return Http::acceptJson()->asForm()->withHeader(
            'Authorization',
            'Bearer ' . $this->token,
        )->baseUrl($this->baseUrl);
    }

    protected function url(string $template): string
    {
        return sprintf($template, $this->blog);
    }
}
