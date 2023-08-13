<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Utilities\AppMessages;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //list All
        return response([
            'message' => AppMessages::$FETCH_ALL,
            'status' => Response::HTTP_OK,
            'data' => Division::all()
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the request
        // $request->validate([
        //     'code' => 'required|string|unique:divisions,code',
        //     'name' => 'required|string',
        //     'season' => 'number'
        // ]);

        // try {

        //     $new_division = Division::create($request->all());
        //     return response([
        //         'message' => AppMessages::$CREATED,
        //         'status' => Response::HTTP_OK,
        //         'data' => $new_division
        //     ], 200);
        // } catch (\Throwable $error) {

        //     return response([
        //         'message' => $error,
        //         'status' => Response::HTTP_BAD_REQUEST
        //     ], 400);
        // }

        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get record
        $record = Division::find($id);
        try {

            return response([
                'message' => AppMessages::$FETCHED,
                'status' => Response::HTTP_OK,
                'data' => $record
            ], 200);
        } catch (\Throwable $error) {

            return response([
                'message' => $error,
                'status' => Response::HTTP_BAD_REQUEST
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //get record
        $record = Division::find($id);
        if (!is_null($record)) {
            $record->update($request->all());
            return response([
                'message' => AppMessages::$SUCCESS,
                'status' => Response::HTTP_OK,
                'data' => $record
            ], 200);
        }

        return response([
            'message' => AppMessages::$NOT_FOUND,
            'status' => Response::HTTP_BAD_REQUEST
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete record
        $record = Division::find($id);

        if (!is_null($record)) {
            $record->delete();
            return [
                'message' => AppMessages::$SUCCESS,
                'status_code' => Response::HTTP_OK,
                'data' => $record
            ];
        }

        return [
            'message' => AppMessages::$NOT_FOUND,
            'status_code' => Response::HTTP_BAD_REQUEST,
            'data' => $record
        ];

    }
}
