<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Api;

use DragonCode\Boosty\Http\Client;

abstract class Api
{
    protected Client $client;

    public function __construct(
        protected string $blog,
        protected string $token
    ) {
        $this->client = new Client($this->blog, $this->token);
    }
}
