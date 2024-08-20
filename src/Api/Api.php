<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Api;

abstract class Api
{
    abstract public function change();

    abstract public function list();

    abstract public function publish();

    abstract public function unpublish();

    public function __construct(
        protected string $blog,
        protected string $token
    ) {}
}
