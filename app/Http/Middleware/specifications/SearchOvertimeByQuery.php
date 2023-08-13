<?php

namespace App\Http\Middleware\specifications;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

trait SearchOvertimeByQuery
{
    use HasFactory;

    protected static function search_overtime_record($data, int $skip, int $take)
    {
        // Employee
        $query = DB::table('employees')
            ->join('overtimes', 'employees.id', '=', 'overtimes.employee_id')
            ->where('name', 'like', '%' . $data . '%')
            ->select('overtimes.*', 'employees.employee_id', 'employees.name')
            ->skip($skip)->take($take)->get();

        // Category
        if ($query->isEmpty()) {
            $query = DB::table('overtimes')
                ->join('employees', 'overtimes.employee_id', '=', 'employees.id')
                ->where('category', 'like', '%' . $data . '%')
                ->select('overtimes.*', 'employees.employee_id', 'employees.name')
                ->skip($skip)->take($take)->get();
        }

        // Job
        if ($query->isEmpty()) {
            $query = DB::table('overtimes')
                ->join('employees', 'overtimes.employee_id', '=', 'employees.id')
                ->where('job', 'like', '%' . $data . '%')
                ->select('overtimes.*', 'employees.employee_id', 'employees.name')
                ->skip($skip)->take($take)->get();
        }

        if ($query->isEmpty()) {
            $query = DB::table('overtimes')
                ->join('employees', 'overtimes.employee_id', '=', 'employees.id')
                ->where('division_name', 'like', '%' . $data . '%')
                ->select('overtimes.*', 'employees.employee_id', 'employees.name')
                ->skip($skip)->take($take)->get();
        }

        return $query;
    }
}
