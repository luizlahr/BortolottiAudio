<?php

use Borto\Infrastructure\DB\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderItem::class, 2)->states('sale')->create();
        return factory(OrderItem::class, 2)->states('maintenance')->create();
    }
}
