<?php

declare(strict_types=1);

return [
    'default' => env('BOOSTY_BLOG'),

    'model' => [
        'connection' => env('QUEUE_CONNECTION'),
        'table'      => env('BOOSTY_TABLE', 'boosty'),
    ],
];
