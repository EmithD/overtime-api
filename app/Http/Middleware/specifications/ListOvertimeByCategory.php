<?php

namespace App\Http\Middleware\specifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class ListOvertimeByCategory
{
    use HasFactory;
    protected static function filter_category_list(string $category): mixed
    {
        $category_list =  DB::table('overtimes')
            ->join('employees', 'overtimes.employee_id', '=', 'employees.id')
            ->where('category', $category)
            ->select('overtimes.*', 'employees.employee_id', 'employees.name')
            ->get();
        return $category_list;
    }
}
