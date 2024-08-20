<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Repositories;

use Closure;
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

    public function find(?string $name, bool $throw = true): Boosty
    {
        return Boosty::query()
            ->when($name, fn (Builder $builder) => $builder->where('blog', $name))
            ->when(
                $throw,
                fn (Builder $builder) => $builder->firstOrFail(),
                fn (Builder $builder) => $builder->first()
            );
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
