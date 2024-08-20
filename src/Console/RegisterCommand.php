<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Console;

use DragonCode\Boosty\Services\Model;
use Illuminate\Console\Command;

use function Laravel\Prompts\form;

class RegisterCommand extends Command
{
    protected $name = 'boosty:register';

    protected $description = 'Register a Boosty application';

    public function handle(Model $model): void
    {
        $model->store($this->form());
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
}
