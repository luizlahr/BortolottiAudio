<?php

namespace  Borto\Infrastructure\DB\Models;

use Borto\Domain\Equipment\Entities\MaintenanceItemEntity;
use Borto\Domain\Equipment\Entities\MaintenanceItemFactory;
use Borto\Domain\Equipment\Entities\SaleItemEntity;
use Borto\Domain\Equipment\Entities\SaleItemFactory;
use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends DBModel
{
    const TYPE_SALE = 'S';
    const TYPE_MAINTENANCE = 'M';

    protected $table = "order_items";

    protected $fillable = [
        'order_id', 'type', 'model_id', 'serial_number','type','notes','name','amount','measure', 'value'
    ];

    public function models(): HasMany
    {
        return $this->hasMany(Model::class);
    }

    /** @return MaintenanceItemEntity|SaleItemEntity */
    public function toEntity()
    {
        if ($this->type === self::TYPE_MAINTENANCE) {
            $factory = new MaintenanceItemFactory();
            return $factory->make(
                $this->id,
                $this->order_id,
                $this->model_id,
                $this->serial_number,
                $this->notes,
                $this->value
            );
        } else {
            $factory = new SaleItemFactory();
            return $factory->make(
                $this->id,
                $this->order_id,
                $this->name,
                $this->amount,
                $this->measure,
                $this->value
            );
        }
    }
}
