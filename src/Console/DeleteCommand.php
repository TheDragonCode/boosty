<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Console;

use DragonCode\Boosty\Services\Model;
use Illuminate\Console\Command;

use function Laravel\Prompts\search;

class DeleteCommand extends Command
{
    protected $name = 'boosty:delete';

    protected $description = 'Delete a Boosty model';

    public function handle(Model $model): void
    {
        $model->delete(
            $this->searchInformation($model)
        );
    }

    protected function searchInformation(Model $model): string
    {
        return search(
            label      : 'Search for the blog that should be deleted',
            options    : fn (string $value) => $this->search($model, $value),
            placeholder: 'E.g. dragon-code',
            scroll     : 10
        );
    }

    protected function search(Model $model, string $value): array
    {
        if (blank($value)) {
            return [];
        }

        return $model->like($value, 10)->all();
    }
}
