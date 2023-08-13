<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CropTypeController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\OvertimeController;
use Illuminate\Support\Facades\Route;

/**
 * Authentication Routes
 */
// Register
Route::post('/user/register', [AuthController::class, 'register']);

// Login
Route::post('/user/login', [AuthController::class, 'authentication']);

// Logout
Route::middleware('auth:sanctum')->post('/user/logout', [AuthController::class, 'logout']);

// Remove user
Route::middleware('auth:sanctum')->post('/user/destroy', [AuthController::class, 'removeUser']);

// Employee
/**
 * Routes are public
 */
Route::get('/employee/list', [EmployeeController::class, 'pagination']);
Route::get('/employee/search', [EmployeeController::class, 'show_employee']);
Route::get('/employee', [EmployeeController::class, 'index']);


/**
 * Routes are protected
 */
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/employee', [EmployeeController::class, 'store']);
    Route::get('/employee/{id}', [EmployeeController::class, 'show']);
    Route::put('/employee/update/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employee/remove/{id}', [EmployeeController::class, 'destroy']);
});

// Crop Type 
/**
 * CREATE & READ
 */
Route::middleware('auth:sanctum')->get('/croptype/{id}', [CropTypeController::class, 'show']);
Route::get('/croptype/list', [CropTypeController::class, 'index']);

// Category
/**
 * READ & READ ALL
 */
Route::get('/category/list', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);

/**
 * Routes are protected
 */

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/division/list', [DivisionController::class, 'index']);
    Route::get('/division/{id}', [DivisionController::class, 'show']);
    Route::post('/division', [DivisionController::class, 'store']);
    Route::put('/division/update/{id}', [DivisionController::class, 'update']);
    Route::delete('/division/remove/{id}', [DivisionController::class, 'destroy']);

    Route::get('/fields/list', [FieldController::class, 'get_by_code']);
    Route::get('/field/list/all', [FieldController::class, 'index']);

    Route::get('/overtime/list/all', [OvertimeController::class, 'index']);
    Route::get('/overtime/list', [OvertimeController::class, 'pagination']);
    Route::get('/overtime/{id}', [OvertimeController::class, 'show']);
    Route::post('/overtime', [OvertimeController::class, 'store']);
    Route::put('/overtime/update/{id}', [OvertimeController::class, 'update']);
    Route::get('/overtime/list/search', [OvertimeController::class, 'search_overtime']);

    Route::get('/overtime/category/filter', [OvertimeController::class, 'filter_category']);
});

/**
 * Additional Api
 */
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/category/rate', [CategoryController::class, 'show_category_rate']);
});
