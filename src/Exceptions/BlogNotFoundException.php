<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Exceptions;

use Exception;

class BlogNotFoundException extends Exception
{
    public function __construct(?string $blog)
    {
        parent::__construct("Blog not found: \"$blog\".");
    }
}
