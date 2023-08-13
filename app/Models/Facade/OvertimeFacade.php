<?php

namespace App\Models\Facade;

use App\Http\Middleware\specifications\GetEmployeeById;
use App\Models\History;
use App\Models\Overtime;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OvertimeFacade extends GetEmployeeById 
{
    use HasFactory;


    static function save_facade_data(object $data)
    {
        $employeeCode = $data->employee_id;

        $response = Overtime::create($data->all());
        $overtimeId = $response->id;

        $facade = History::create(["overtime_id" => $overtimeId, "employee_id" => $employeeCode]);
        return [
            'overtimeId' => $overtimeId,
            'historyId' => $facade->id
        ];
        $facade = History::create(["overtime_id" => $overtimeId, "employee_id" => $employeeCode]);
        return $facade->id;
    }

    static function get_facade_employee($skip, $take)
    {
        $result = GetEmployeeById::get_employees_by_id($skip, $take);
        return $result;
    }
}
