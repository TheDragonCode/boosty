<?php

declare(strict_types=1);

namespace DragonCode\Boosty\Models;

use Illuminate\Database\Eloquent\Model;

class Boosty extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'blog',
        'token',
        'refresh',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('boosty.model.connection'));
        $this->setTable(config('boosty.model.table'));

        parent::__construct($attributes);
    }
}
