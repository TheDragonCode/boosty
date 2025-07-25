<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Services;

use Closure;
use DragonCode\Boosty\Exceptions\BlogNotFoundException;
use DragonCode\Boosty\Models\Boosty;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Model
{
    public function store(array $data): void
    {
        Boosty::query()->when(
            isset($data['blog']),
            fn (Builder $builder) => $builder->updateOrCreate(['blog' => $data['blog']], $data),
            fn (Builder $builder) => $builder->create($data)
        );
    }

    public function delete(string $blog): void
    {
        Boosty::query()
            ->where(compact('blog'))
            ->delete();
    }

    public function find(?string $name): Boosty
    {
        return Boosty::query()
            ->when($name, fn (Builder $builder) => $builder->where('blog', $name))
            ->firstOr(callback: fn () => throw new BlogNotFoundException($name));
    }

    public function each(Closure $callback): void
    {
        Boosty::query()
            ->orderBy('blog')
            ->lazy()
            ->each($callback);
    }

    public function like(string $value, int $take): Collection
    {
        return Boosty::query()
            ->whereLike('blog', "%$value%")
            ->take($take)
            ->pluck('blog', 'blog');
    }
}
