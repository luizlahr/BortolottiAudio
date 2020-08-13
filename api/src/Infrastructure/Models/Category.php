<?php

namespace  Borto\Infrastructure\DB\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'name'
    ];
}
