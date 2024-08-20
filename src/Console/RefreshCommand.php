<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Console;

use DragonCode\Boosty\Api\Auth;
use DragonCode\Boosty\Models\Boosty;
use DragonCode\Boosty\Services\Model;
use Illuminate\Console\Command;

class RefreshCommand extends Command
{
    protected $name = 'boosty:refresh';

    protected $description = 'Refresh a Boosty tokens';

    public function handle(Model $model): void
    {
        $model->each(
            fn (Boosty $boosty) => $this->components->task($boosty->blog, fn () => $this->refresh($boosty))
        );
    }

    protected function refresh(Boosty $boosty): void
    {
        $token = $this->auth($boosty->blog, $boosty->access_token)
            ->refresh($boosty->refresh_token, $boosty->client_id);

        $boosty->update($token->toArray());
    }

    protected function auth(string $blog, string $token): Auth
    {
        return new Auth($blog, $token);
    }
}
