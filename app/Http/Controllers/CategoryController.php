<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facade\CategoryFacade;
use App\Models\Utilities\AppMessages;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    // Get all categories
    public function index()
    {
        try {

            return response([
                'message' => AppMessages::$FETCH_ALL,
                'status_code' => Response::HTTP_OK,
                'data' => Category::all()
            ], 200);
        } catch (\Throwable $error) {

            return response([
                'message' => AppMessages::$NOT_FOUND,
                'status_code' => Response::HTTP_BAD_REQUEST,
                'data' => $error
            ], 200);
        }
    }

    public function show(string $id)
    {
        if (is_string($id)) {
            try {
                $response = Category::find($id);
                return response([
                    'message' => AppMessages::$FETCHED,
                    'status_code' => Response::HTTP_OK,
                    'data' => $response
                ], 200);
            } catch (\Throwable $error) {
                return response([
                    'message' => AppMessages::$NOT_FOUND,
                    'status_code' => Response::HTTP_BAD_REQUEST,
                    'rate_per_hour' => $error
                ], 400);
            }
        }
    }

    public function show_category_rate(Request $request)
    {

        $category = $request->query('category');

        if (is_string($category)) {
            try {
                $response = CategoryFacade::get_hourly_rate_facade($category);
                return response([
                    'message' => AppMessages::$FETCHED,
                    'status_code' => Response::HTTP_OK,
                    'data' => $response
                ]);
            } catch (\Throwable $error) {
                return "Error Occurred: $error";
            }
        }
    }
}
