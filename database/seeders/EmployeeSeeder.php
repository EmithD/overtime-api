<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Values
        $employees = [
            [
                'id' => Str::uuid(),
                'employee_id' => '1113',
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'id' => Str::uuid(),
                'employee_id' => '1114',
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
            [
                'id' => Str::uuid(),
                'employee_id' => '1115',
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ]
        ];

        DB::table('employees')->insert($employees);
    }
}
