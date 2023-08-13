<?php

namespace App\Http\Middleware;

use App\Models\Employee;

use function PHPUnit\Framework\isNull;

class GetEmployeeByName{
    
    public static function search($name){
        if (!isNull($name)) {
            $response = Employee::where('name', 'like', '%'.$name.'%')->get();
            return $response;
        }

    }
}

?>