<?php

declare(strict_types=1);

namespace DragonCode\Boosty;

use DragonCode\Boosty\Console\DeleteCommand;
use DragonCode\Boosty\Console\RefreshCommand;
use DragonCode\Boosty\Console\RegisterCommand;
use DragonCode\Boosty\Services\Manager;
use DragonCode\Boosty\Services\Model;
use Illuminate\Foundation\Application;
use Illuminate\Http\Client\Response;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Spatie\LaravelData\Data;

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();
        $this->registerManager();
    }

    public function boot(): void
    {
        $this->bootConfig();
        $this->bootMigrations();
        $this->bootCommands();
        $this->bootHttpMacros();
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/boosty.php', 'boosty');
    }

    protected function registerManager(): void
    {
        $this->app->bind(Manager::class, function (Application $app) {
            $config = $app->make(Model::class)->find(
                $app['config']->get('boosty.default')
            );

            return $this->app->make(Manager::class, [$config]);
        });
    }

    protected function bootConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/boosty.php' => $this->app->configPath('boosty.php'),
        ]);
    }

    protected function bootMigrations(): void
    {
        $this->publishesMigrations([
            __DIR__ . '/../database/migrations' => $this->app->databasePath('migrations'),
        ]);
    }

    protected function bootCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            RefreshCommand::class,
            RegisterCommand::class,
            DeleteCommand::class,
        ]);
    }

    protected function bootHttpMacros(): void
    {
        Response::macro('toInstance', function (Data|string $class) {
            return $class::from($this->json());
        });
    }
}
