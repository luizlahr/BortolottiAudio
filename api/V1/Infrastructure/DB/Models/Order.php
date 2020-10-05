<?php

namespace  Borto\Infrastructure\DB\Models;

use Borto\Domain\Order\Entities\OrderEntity;
use Borto\Domain\Order\Entities\OrderFactory;
use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends DBModel
{
    protected $table = "orders";

    protected $fillable = [
        'id','status','sequencial','credit','customer_id',
        'due_to','quoted_at','approved_at','finished_at','delivered_at','customer'
    ];

    protected $casts = [
        'status'       => 'integer',
        'credit'       => 'float',
        'customer_id'  => 'integer',
        'created_at'   => 'string',
        'due_to'       => 'string',
        'quoted_at'    => 'string',
        'approved_at'  => 'string',
        'delivered_at' => 'string',
        'finished_at'  => 'string'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'customer_id');
    }

    public function informations(): HasMany
    {
        return $this->hasMany(Information::class);
    }

    public function toEntity(): OrderEntity
    {
        $customer = null;
        if ($this->customer) {
            $customer = $this->customer->toEntity();
        }

        $factory = new OrderFactory();
        return $factory->make(
            $this->id,
            $this->status,
            $this->credit,
            $this->customer_id,
            $this->created_at,
            $this->due_to ?? null,
            $this->quoted_at ?? null,
            $this->approved_at ?? null,
            $this->finished_at ?? null,
            $this->delivered_at ?? null,
            $customer
        );
    }
}
