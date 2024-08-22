<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Console;

use DragonCode\Boosty\Api\Auth;
use DragonCode\Boosty\Services\Model;
use Illuminate\Console\Command;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\form;
use function Laravel\Prompts\warning;

class RegisterCommand extends Command
{
    protected $name = 'boosty:register';

    protected $description = 'Register a Boosty application credentials';

    public function handle(Model $model): void
    {
        $data = $this->form();

        if ($this->check($data['blog'], $data['access_token'])) {
            $model->store($data);

            return;
        }

        if (confirm('Do you want to enter the data again?')) {
            $this->handle($model);
        }
    }

    protected function form(): array
    {
        return form()
            ->text(
                label      : 'What is your blog name?',
                placeholder: 'E.g. dragon-code',
                required   : true,
                validate   : ['blog' => ['string', 'max:255', 'regex:/^[a-zA-Z0-9\-]+$/i']],
                name       : 'blog',
            )
            ->text(label: 'What is your client ID?', required: true, name: 'client_id')
            ->text(label: 'What is your token?', required: true, name: 'access_token')
            ->text(label: 'What is your refresh token?', required: true, name: 'refresh_token')
            ->submit();
    }

    protected function check(string $blog, string $token): bool
    {
        if ($this->auth($blog, $token)->isNotAuthenticated()) {
            warning('Failed to connect in using the specified credentials.');

            return false;
        }

        return true;
    }

    protected function auth(string $blog, string $token): Auth
    {
        return new Auth($blog, $token);
    }
}
