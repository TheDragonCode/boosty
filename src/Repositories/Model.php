<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Repositories;

use Closure;
use DragonCode\Boosty\Models\Boosty;
use Illuminate\Database\Eloquent\Builder;

class Model
{
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

    public function lazy(Closure $callback): void
    {
        Boosty::query()
            ->orderBy('blog')
            ->lazy()
            ->each($callback);
    }
}
