<?php

namespace  Borto\Infrastructure\DB\Models;

use Borto\Domain\Equipment\Entities\CategoryEntity;
use Borto\Domain\Equipment\Entities\CategoryFactory;
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

    public function toEntity(): CategoryEntity
    {
        $factory = new CategoryFactory();
        return $factory->make(
            $this->id,
            $this->name
        );
    }
}
