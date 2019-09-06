<?php

use App\Imports\RegenciesImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class RegenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new RegenciesImport, storage_path('seeds' . DIRECTORY_SEPARATOR . 'regencies.xlsx'));
    }
}
