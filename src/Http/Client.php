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

    public function send(PostData $data): mixed
    {
        return $this->request()
            ->post($this->url('blog/%s/post'), $data->toArray())
            ->throw()
            ->json();
    }

    public function uploadImage(ImageData $data): string
    {
        return $this->request()
            ->withBody('image body content', 'image/png')
            ->post('https://uploadimg.boosty.to/v1/media_data/image/')
            ->throw()
            ->collect()
            ->filter()
            ->first();
    }

    public function uploadImages(array $images): array
    {
        return collect($images)
            ->map(fn (string $image) => $this->uploadImage($image))
            ->all();
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
