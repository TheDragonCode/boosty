<?php

declare(strict_types=1);

return [
    'default' => env('BOOSTY_BLOG'),

    'database' => [
        'connection' => env('BOOSTY_DB_CONNECTION', env('DB_CONNECTION')),
        'table'      => env('BOOSTY_DB_TABLE'),
    ],
];
