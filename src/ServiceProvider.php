<?php

declare(strict_types=1);

namespace DragonCode\Boosty;

use DragonCode\Boosty\Repositories\Model;
use DragonCode\Boosty\Services\Manager;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->registerManager();
    }

    public function boot(): void {}

    protected function registerManager(): void
    {
        $this->app->bind(Manager::class, function (Application $app) {
            $config = $app->make(Model::class)->find(
                name : $app['config']->get('boosty.default'),
                throw: false
            );

            return $this->app->make(Manager::class, [$config]);
        });
    }
}
