<?php

declare(strict_types=1);

return [
    'default' => env('BOOSTY_CONNECTION', 'default'),

    'connections' => [
        'default' => [
            'token'   => env('BOOSTY_TOKEN'),
            'refresh' => env('BOOSTY_REFRESH_TOKEN'),
            'blog'    => env('BOOSTY_BLOG'),
        ],
    ],
];
