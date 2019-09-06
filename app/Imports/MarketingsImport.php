<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Marketing;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MarketingsImport implements ToCollection, WithHeadingRow
{
    /**
     * Undocumented function
     *
     * @param Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $marketing = Marketing::create([
                'name' => $row['name'],
                'slug' => str_slug($row['name']),
                'email' => $row['email'],
                'phone' => $row['phone'],
                'describe' => $row['describe'],
                'employee_id' => $row['manager'],
            ]);

            $user = new User([
                'name' => $marketing->name,
                'email' => $marketing->email,
                'password' => Hash::make('12345678'),
                'authent_id' => 3,
            ]);

            $marketing->user()->save($user);
        }
    }
}
