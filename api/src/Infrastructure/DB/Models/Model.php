<?php

namespace  Borto\Infrastructure\DB\Models;

use Borto\Domain\Equipment\Entities\ModelEntity;
use Borto\Domain\Equipment\Entities\ModelFactory;
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

    public function toEntity(): ModelEntity
    {
        $category = $this->category;
        $brand = $this->brand;

        $factory = new ModelFactory();
        return $factory->make(
            $this->id,
            $this->category_id,
            $this->brand_id,
            $this->name,
            $category->toEntity(),
            $brand->toEntity()
        );
    }
}
