<?php

namespace  Borto\Infrastructure\DB\Models;

use Borto\Domain\Order\Entities\InformationEntity;
use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Information extends DBModel
{
    protected $table = "order_informations";

    protected $fillable = [
        'id', 'order_id', 'type', 'text', 'user_id'
    ];

    protected $casts = [
        'order_id' => 'integer',
        'user_id'  => 'integer'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function toEntity(): InformationEntity
    {
        return new InformationEntity(
            $this->id,
            $this->order_id,
            $this->type,
            $this->text,
            $this->created_at
        );
    }
}
