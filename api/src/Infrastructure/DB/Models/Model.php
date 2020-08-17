<?php

namespace  Borto\Infrastructure\DB\Models;

use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Model extends DBModel
{
    protected $table = "models";

    protected $fillable = [
        'name', 'category_id', 'brand_id'
    ];

    protected $casts = [
        'category_id' => 'integer',
        'brand_id'    => 'integer'
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
