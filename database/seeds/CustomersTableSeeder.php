<?php

use App\Imports\CustomersImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new CustomersImport, storage_path('seeds' . DIRECTORY_SEPARATOR . 'customers.xlsx'));
    }
}
