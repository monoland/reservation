<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\ClientRepository;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'development',
            'email' => 'dev@citraalam.id',
            'password' => Hash::make('rahasia'),
            'authent_id' => 1
        ]);

        dd(((new ClientRepository)->createPasswordGrantClient(null, 'development', null))->secret);
    }
}
