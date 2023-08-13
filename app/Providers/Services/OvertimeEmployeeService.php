<?php

namespace App\Providers\Services;

use App\Http\Middleware\specifications\GetOvertimeById;
use App\Providers\Interfaces\IOvertimeSpec;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OvertimeEmployeeService extends GetOvertimeById implements IOvertimeSpec
{
    use HasFactory;

    public function overtime_spec_execute(mixed $data)
    {
        return GetOvertimeById::get_overtime_single_record($data);
    }
}
