<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Facades;

use DragonCode\Boosty\Services\Manager;
use Illuminate\Support\Facades\Facade;

class Boosty extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Manager::class;
    }
}
