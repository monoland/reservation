<?php

use App\Imports\ManagersImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ManagersImport, storage_path('seeds' . DIRECTORY_SEPARATOR . 'managers.xlsx'));
    }
}
