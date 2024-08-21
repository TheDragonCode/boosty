<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Http;

use DragonCode\Boosty\Data\PostData;
use DragonCode\Boosty\Data\Responses\MediaPostData;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\Data;

class Client
{
    protected string $baseUrl = 'https://api.boosty.to/v1/';

    public function __construct(
        protected string $blog,
        protected string $token,
    ) {}

    public function post(string $uri, PostData $data): Response
    {
        return $this->request()
            ->post($this->url($uri), $data->toArray())
            ->throw();
    }

    public function get(string $uri, ?array $query = null): Response
    {
        return $this->request()
            ->get($this->url($uri), $query)
            ->throw();
    }

    public function media(string $content, string $mimeType): MediaPostData|Data
    {
        return $this->request()
            ->withBody($content, $mimeType)
            ->post('https://uploadimg.boosty.to/v1/media_data/image/')
            ->throw()
            ->toInstance(MediaPostData::class);
    }

    public function request(): PendingRequest
    {
        return Http::acceptJson()->asForm()->withHeader(
            'Authorization',
            'Bearer ' . $this->token,
        )->baseUrl($this->baseUrl)->throw();
    }

    protected function url(string $template): string
    {
        return str_replace('{blog}', $this->blog, $template);
    }
}
