<?php

use App\Imports\MarketingsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MarketingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new MarketingsImport, storage_path('seeds' . DIRECTORY_SEPARATOR . 'marketings.xlsx'));
    }
}
