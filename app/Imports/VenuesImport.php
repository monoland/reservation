<?php

namespace App\Imports;

use App\Models\Venue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VenuesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Venue([
            'name' => $row['name'],
            'slug' => str_slug($row['name']),
            'address' => $row['address'],
        ]);
    }
}
