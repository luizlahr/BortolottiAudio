<?php

use Borto\Infrastructure\DB\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return factory(Brand::class, 10)->create();
    }
}
