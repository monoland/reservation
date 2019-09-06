<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ManagersImport implements ToCollection, WithHeadingRow
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
            $employee = Employee::create([
                'name' => $row['name'],
                'slug' => str_slug($row['name']),
                'email' => $row['email'],
                'phone' => $row['phone'],
                'role' => 'manager'
            ]);
    
            $user = new User([
                'name' => $employee->name,
                'email' => $employee->email,
                'password' => Hash::make('12345678'),
                'authent_id' => 2,
            ]);
    
            $employee->user()->save($user);   
        }
    }
}
