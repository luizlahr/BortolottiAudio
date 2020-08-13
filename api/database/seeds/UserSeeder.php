<?php

use Borto\Infrastructure\DB\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            "name"     => "Admin",
            "email"    => "luiz.lahr@hotmail.com",
            "password" => Hash::make("123123"),
            "active"   => true
        ]);

        return factory(User::class, 10)->create();
    }
}
