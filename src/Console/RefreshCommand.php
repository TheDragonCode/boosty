<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Console;

use DragonCode\Boosty\Api\Auth;
use DragonCode\Boosty\Models\Boosty;
use DragonCode\Boosty\Repositories\Model;
use Illuminate\Console\Command;

class RefreshCommand extends Command
{
    public function handle(Model $model): void
    {
        $model->lazy(
            fn (Boosty $boosty) => $this->components->task($boosty->blog, fn () => $this->refresh($boosty))
        );
    }

    protected function refresh(Boosty $boosty): void
    {
        $token = $this->auth($boosty->blog, $boosty->token)->refresh($boosty->refresh);

        $boosty->update(['token' => $token]);
    }

    protected function auth(string $blog, string $token): Auth
    {
        return new Auth($blog, $token);
    }
}
