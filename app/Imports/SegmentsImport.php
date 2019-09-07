<?php

namespace App\Imports;

use App\Models\Label;
use App\Models\Segment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SegmentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $labels = explode('/', $row['name']);

        foreach ($labels as $label) {
            Label::create([
                'name' => $label,
                'slug' => str_slug($label)
            ]);
        }

        return new Segment([
            'name' => $row['name'],
            'slug' => str_slug($row['name']),
            'mode' => $row['mode'],
        ]);
    }
}
