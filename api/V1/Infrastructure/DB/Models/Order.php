<?php

namespace  Borto\Infrastructure\DB\Models;

use Borto\Domain\Equipment\Entities\OrderFactory;
use Faker\Provider\da_DK\Person;
use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use V1\Domain\Order\Entities\OrderEntity;

class Order extends DBModel
{
    protected $table = "orders";

    protected $fillable = [
        'id','status','sequencial','credit','customer_id',
        'due_to','quoted_at','approved_at','finished_at','delivered_at','customer'
    ];

    protected $casts = [
        'status'      => 'integer',
        'credit'      => 'float',
        'customer_id' => 'integer',
    ];

    protected $dates = [
        'created_at', 'due_to', 'quoted_at', 'approved_at', 'delivered_at', 'finished_at'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function toEntity(): OrderEntity
    {
        $factory = new OrderFactory();
        return $factory->make(
            $this->id,
            $this->status,
            $this->sequencial,
            $this->credit,
            $this->customer_id,
            $this->created_at,
            $this->dueTo,
            $this->quoted_at,
            $this->approved_at,
            $this->finished_at,
            $this->delivered_at,
            $this->customer
        );
    }
}
