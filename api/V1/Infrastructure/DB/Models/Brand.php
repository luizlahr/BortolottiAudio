<?php

namespace  Borto\Infrastructure\DB\Models;

use Borto\Domain\Equipment\Entities\BrandEntity;
use Borto\Domain\Equipment\Entities\BrandFactory;
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

    public function toEntity(): BrandEntity
    {
        $factory = new BrandFactory();
        return $factory->make(
            $this->id,
            $this->name
        );
    }
}
