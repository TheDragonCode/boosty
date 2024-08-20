<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('boosty', function (Blueprint $table) {
            $table->string('blog')->unique();

            $table->string('token');
            $table->string('refresh')->nullable();

            $table->timestamp('expires_at');
        });
    }
};
