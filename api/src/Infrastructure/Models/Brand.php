<?php

namespace  Borto\Infrastructure\DB\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";

    protected $fillable = [
        'name'
    ];
}
