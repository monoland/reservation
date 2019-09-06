<?php

use App\Imports\SegmentsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class SegmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new SegmentsImport, storage_path('seeds' . DIRECTORY_SEPARATOR . 'segments.xlsx'));
    }
}
