<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Console;

use DragonCode\Boosty\Repositories\Model;
use Illuminate\Console\Command;

use function Laravel\Prompts\form;

class RegisterCommand extends Command
{
    public function handle(Model $model): void
    {
        $model->store(
            $this->askInformation()
        );
    }

    protected function askInformation(): array
    {
        return form()
            ->text(
                label      : 'What is blog name?',
                placeholder: 'E.g. dragon-code',
                required   : true,
                validate   : $this->validateName(),
                name       : 'blog',
            )
            ->text(label: 'What is your token?', required: true, name: 'token')
            ->text(label: 'What is your refresh token?', required: true, name: 'refresh')
            ->submit();
    }

    protected function validateName(): array
    {
        return [
            'blog' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\w\-]+$/i',
            ],
        ];
    }
}
