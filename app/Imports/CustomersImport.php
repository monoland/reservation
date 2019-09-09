<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'name' => $row['name'],
            'slug' => str_slug($row['name']),
            'address' => $row['address'],
            'phone' => $row['phone'],
            'contact_name' => $row['contact_name'],
            'contact_phone' => $row['contact_phone'],
            'email' => $row['email'],
            'segment_id' => $row['segment_id'],
            'marketing_id' => $row['marketing_id'],
            'province_id' => $row['province_id'],
            'regency_id' => $row['regency_id'],
            'district_id' => $row['district_id'],
            'label_id' => $row['label_id'],
        ]);
    }
}
