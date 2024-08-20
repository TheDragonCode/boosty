<?php

declare(strict_types=1);

use DragonCode\Boosty\Models\Boosty;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $this->schema()->create($this->table(), function (Blueprint $table) {
            $table->string('blog')->unique();

            $table->string('token');
            $table->string('refresh')->nullable();
        });
    }

    public function down(): void
    {
        $this->schema()->dropIfExists(
            $this->table()
        );
    }

    protected function schema(): Builder
    {
        return Schema::connection($this->connection());
    }

    protected function connection(): ?string
    {
        return $this->model()->getConnectionName();
    }

    protected function table(): string
    {
        return $this->model()->getTable();
    }

    protected function model(): Boosty
    {
        return new Boosty();
    }
};
