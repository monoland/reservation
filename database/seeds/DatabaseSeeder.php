<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AuthentsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ProvincesTableSeeder::class);
        $this->call(RegenciesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(SegmentsTableSeeder::class);
        $this->call(MarketingsTableSeeder::class);
        $this->call(ManagersTableSeeder::class);
        $this->call(VenuesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
