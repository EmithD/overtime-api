<?php

namespace App\Http\Middleware\specifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class GetEmployeeById
{
    use HasFactory;

    protected static function get_employees_by_id(int $skip, int $take)
    {
        $overtime = DB::table('overtimes')
            ->join('employees', 'overtimes.employee_id', '=', 'employees.id')
            ->select('overtimes.*', 'employees.employee_id', 'employees.name')
            ->skip($skip)->take($take)->get();

        return $overtime;
    }
}
