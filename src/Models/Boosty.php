<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Models;

use Illuminate\Database\Eloquent\Model;

class Boosty extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $table = 'boosty';

    protected $fillable = [
        'blog',
        'token',
        'refresh',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
