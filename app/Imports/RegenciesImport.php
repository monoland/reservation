<?php

namespace App\Imports;

use App\Models\Regency;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegenciesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Regency([
            'id' => $row['id'],
            'name' => $row['name'],
            'slug' => str_slug($row['name']),
            'province_id' => $row['province_id'],
        ]);
    }
}
