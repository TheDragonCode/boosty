<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Api;

use DragonCode\Boosty\Data\Responses\MediaPostData;
use DragonCode\Boosty\Enums\MediaTypeEnum;
use Illuminate\Support\Collection;

class Media extends Api
{
    /**
     * @param  int  $limit
     * @param  MediaTypeEnum  $type
     *
     * @return Collection<MediaPostData>
     */
    public function list(int $limit = 15, MediaTypeEnum $type = MediaTypeEnum::All): Collection
    {
        return $this->client->get('blog/{blog}/media_album/', [
            'type'     => $type->value,
            'limit'    => $limit,
            'limit_by' => 'media',
        ])->toCollection(MediaPostData::class, 'data.mediaPosts');
    }

    public function upload(string $filename): MediaPostData
    {
        return $this->client->media(
            $this->body($filename),
            $this->mimeType($filename)
        );
    }

    /**
     * @param  array  $filenames
     *
     * @return Collection<MediaPostData>
     */
    public function uploadMany(array $filenames): Collection
    {
        return collect($filenames)->map(
            fn (string $filename) => $this->upload($filename)
        );
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
