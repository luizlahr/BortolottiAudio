<?php

namespace  Borto\Infrastructure\DB\Models;

use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends DBModel
{
    protected $table = "brands";

    protected $fillable = [
        'name'
    ];

    public function models(): HasMany
    {
        return $this->hasMany(Model::class);
    }
}
