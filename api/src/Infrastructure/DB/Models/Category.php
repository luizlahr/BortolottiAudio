<?php

namespace  Borto\Infrastructure\DB\Models;

use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends DBModel
{
    protected $table = "categories";

    protected $fillable = [
        'name'
    ];

    public function models(): HasMany
    {
        return $this->hasMany(Model::class);
    }
}
