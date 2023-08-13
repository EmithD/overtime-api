<?php

namespace App\Http\Middleware\specifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class GetOvertimeById
{
    use HasFactory;

    protected static function get_overtime_single_record(string $id)
    {
        $overtime = DB::table('overtimes')
            ->join('employees', 'overtimes.employee_id', '=', 'employees.id')
            ->where('overtimes.id', '=', $id)
            ->select('overtimes.*', 'employees.employee_id', 'employees.name')
            ->first();

        return $overtime;
    }
}
