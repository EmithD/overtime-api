<?php

namespace App\Http\Controllers;

use App\Http\Middleware\GetEmployeeByName;
use App\Models\Employee;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // View All Employees
        $body = [
            'message' => 'Success',
            'status_code' => 200,
            'body' => Employee::all()
        ];

        return $body;
    }

    /**
     * Paginated List
     */
    public function pagination(Request $request){
        $take = $request->query('take');
        $skip = $request->query('skip');

        return Employee::skip($skip)->take($take)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validation
        $request->validate([
            'employee_id' => 'required|unique:employees,employee_id',
            'name' => 'required',
            'email' => 'required|unique:employees,email'
        ]);

        $data = Employee::create($request->all());
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Query Parameters
        $record = Employee::find($id);
        return $record;
    }

    // Get Employee By Name

    public function show_employee(Request $request)
    {
        $name = $request->query('name');
        // $emp_Id = $request->query('employee_id');

        $body = [
            'message' => 'Success',
            'status_code' => 200,
            'data' => Employee::where('name', 'like', '%' . $name . '%')->get()
        ];

        return $body;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Get Id
        $record = Employee::find($id);
        // Update the Employee
        if (!is_null($record)) {

            $record->update($request->all());
            return [
                'message' => 'Success',
                'status_code' => 200,
                'data' => $record
            ];
        }

        return [
            'message' => 'Error',
            'status_code' => 400,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Get the record
        $record = Employee::find($id);

        if (!is_null($record)) {
            $record->delete();
            return [
                'message' => 'Success',
                'status_code' => 200,
                'data' => $record
            ];
        }

        return [
            'message' => 'Error: No records Found',
            'status_code' => 400,
            'data' => $record
        ];
    }
}
