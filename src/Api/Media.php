<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Api;

class Media extends Api
{
    public function list(): array
    {
        return $this->client->send();
    }
    
    public function upload(string $filename): string
    {
        return $this->client->media(
            $this->body($filename),
            $this->mimeType($filename)
        );
    }

    public function uploadMany(array $filenames): array
    {
        return array_map(fn (string $filename) => $this->upload($filename), $filenames);
    }

    protected function body(string $filename): string
    {
        return file_get_contents($filename);
    }

    protected function mimeType(string $filename): string
    {
        return mime_content_type($filename);
    }
}
