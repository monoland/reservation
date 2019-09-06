<?php

use Illuminate\Database\Seeder;
use App\Models\Authent;

class AuthentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Authent::create(['name' => 'administrator']);
        Authent::create(['name' => 'manager']);
        Authent::create(['name' => 'marketing']);
        Authent::create(['name' => 'office']);
        Authent::create(['name' => 'trainer']);
    }
}
