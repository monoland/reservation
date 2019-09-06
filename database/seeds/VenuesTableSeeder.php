<?php

use App\Imports\VenuesImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class VenuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new VenuesImport, storage_path('seeds' . DIRECTORY_SEPARATOR . 'venues.xlsx'));
    }
}
