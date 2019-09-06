<?php

use App\Imports\ProvincesImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ProvincesImport, storage_path('seeds' . DIRECTORY_SEPARATOR . 'provinces.xlsx'));
    }
}
