<?php

namespace App\Http\Controllers;

use App\Http\Middleware\specifications\SearchOvertimeByQuery;
use App\Models\Facade\OvertimeFacade;
use App\Models\Overtime;
use App\Models\Utilities\AppMessages;
use App\Providers\Services\OvertimeEmployeeService as ServicesOvertimeEmployeeService;
use App\Providers\Services\OvertimeServices;
use Illuminate\Http\Request;
use OvertimeEmployeeService;
use Symfony\Component\HttpFoundation\Response;

class OvertimeController extends Controller
{
    use SearchOvertimeByQuery;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all

        try {

            return response([
                'message' => AppMessages::$FETCH_ALL,
                'status_code' => Response::HTTP_OK,
                'data' => Overtime::all()
            ], 200);
        } catch (\Throwable $error) {

            return response([
                'message' => AppMessages::$NOT_FOUND,
                'status_code' => Response::HTTP_BAD_REQUEST,
                'data' => $error
            ], 200);
        }
    }

    /**
     * List - Pagination
     */

    public function pagination(Request $request)
    {
        $take = $request->query('take');
        $skip = $request->query('skip');

        $overtime_all = OvertimeFacade::get_facade_employee($skip, $take);

        try {
            return response([
                'message' => AppMessages::$FETCH_ALL,
                'status_code' => Response::HTTP_OK,
                'data' => $overtime_all
            ], 200);
        } catch (\Throwable $error) {
            return response([
                'message' => AppMessages::$NOT_FOUND,
                'status_code' => Response::HTTP_BAD_REQUEST,
                'data' => $error
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Save Overtime
        $request->validate([
            "employee_id" => "string|required",
            "job" => "string|required",
            "worked_at" => "date|required",
            "hours_in_mins" => "integer|required",
            "rate" => "decimal:2|required",
            "total" => "decimal:2|required",
            "division_name" => "string|required",
            "field_name" => "string|required",
            "category" => "string|required",
            "work_type" => "string|required",
        ]);

        try {
            $overtime = OvertimeFacade::save_facade_data($request);
            return response([
                'message' => AppMessages::$CREATED,
                'status_code' => Response::HTTP_OK,
                'data' => $overtime
            ], 200);
        } catch (\Throwable $error) {
            return response([
                'message' => AppMessages::$ERROR,
                'status_code' => Response::HTTP_BAD_REQUEST,
                'data' => $error
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //is this a good practice ?
        $overtime = new ServicesOvertimeEmployeeService();
        try {
            return response([
                'message' => AppMessages::$FETCHED,
                'status_code' => Response::HTTP_OK,
                'data' => $overtime->overtime_spec_execute($id)
            ]);
        } catch (\Throwable $error) {
            return response([
                'message' => AppMessages::$ERROR,
                'status_code' => Response::HTTP_OK,
                'error' => $error->msg
            ]);
        }
    }

    /**
     * Search by keyword 
     */
    public function search_overtime(Request $request)
    {
        //
        $take = $request->query('take');
        $skip = $request->query('skip');
        $search = $request->query('search');

        $search_data = SearchOvertimeByQuery::search_overtime_record($search, $skip, $take);
        return response([
            'message' => AppMessages::$CREATED,
            'status_code' => Response::HTTP_OK,
            'data' => $search_data
        ], 200);
    }

    /**
     * Filters
     */
    // Filter by category
    public function filter_category(Request $request)
    {
        // Validation rules
        $request->validate([
            "category" => "string|required"
        ]);
        $category = $request->query('category');

        try {
            $list = new OvertimeServices();

            return response([
                'message' => AppMessages::$FETCH_ALL,
                'status_code' => Response::HTTP_OK,
                'data' => $list->overtime_categories($category),
            ], 200);
        } catch (\Throwable $error) {
            return $error;
        }
    }
    // Filter by date range

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $record = Overtime::find($id);
        if (!is_null($record)) {

            $record->update($request->all());
            return response([
                'message' => AppMessages::$UPDATED,
                'status_code' => Response::HTTP_OK,
                'data' => $record->id
            ], 200);
        }

        return response([
            'message' => AppMessages::$ERROR,
            'status_code' => Response::HTTP_OK,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
