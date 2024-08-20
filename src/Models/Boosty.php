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
        'client_id',
        'access_token',
        'refresh_token',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('boosty.database.connection'));
        $this->setTable(config('boosty.database.table'));

        parent::__construct($attributes);
    }
}
