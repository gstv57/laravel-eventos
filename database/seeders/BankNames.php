<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class BankNames extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = 'banks.csv';

        $data = Excel::toArray([], $file);

        foreach ($data[0] as $row) {
            Bank::create([
                'id'   => $row[0],
                'code' => $row[1],
                'name' => $row[2],
            ]);
        }
    }
}
