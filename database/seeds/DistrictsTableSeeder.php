<?php

use App\Imports\DistrictsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new DistrictsImport, storage_path('seeds' . DIRECTORY_SEPARATOR . 'districts.xlsx'));
    }
}
