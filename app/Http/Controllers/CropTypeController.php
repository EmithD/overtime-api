<?php

namespace App\Http\Controllers;

use App\Models\Croptype;
use App\Models\Utilities\AppMessages;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CropTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all crops
        $crops = Croptype::all();
        return response([
            "message" => AppMessages::$FETCH_ALL,
            "status" => Response::HTTP_OK,
            "data" => $crops,
        ], 200);
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
        //Get By Id
        $crop = Croptype::find($id);

        if (!is_null($crop)) {
            return response([
                "message" => AppMessages::$FETCHED,
                "status" => Response::HTTP_OK,
                "data" => $crop
            ], 200);
        }

        return response([
            "message" => AppMessages::$NOT_FOUND,
            "status" => Response::HTTP_NOT_FOUND,
        ], 200);
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
