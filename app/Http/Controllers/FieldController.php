<?php

namespace App\Http\Controllers;


use App\Models\Field;
use App\Models\Utilities\AppMessages;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            return response([
                'message' => AppMessages::$FETCH_ALL,
                'status_code' => Response::HTTP_OK,
                'data' => Field::all()
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**

     * Display the Fields on code
     */

    public function get_by_code(Request $request)
    {
        // Validate (Guard)
        $request->validate([
            'code' => 'string|required'
        ]);

        $code = $request->query('code');
        try {
            $record = Field::where('division_code', $code)->get();

            return response([
                'message' => AppMessages::$FETCHED,
                'status_code' => Response::HTTP_OK,
                'data' => $record
            ], 200);
        } catch (\Throwable $error) {

            return response([
                'message' => AppMessages::$NOT_FOUND,
                'status_code' => Response::HTTP_NOT_FOUND,
            ]);
        }
    }

    /**

     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
