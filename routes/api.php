<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APICarController;
use App\Http\Controllers\APIRideController;
use App\Http\Controllers\APIClientController;
use App\Http\Controllers\APIEmployeeController;
use App\Http\Controllers\APICategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Car
Route::get("cars",          [APICarController::class, 'getAll']);
Route::get("cars/{id}",     [APICarController::class, 'show']);
Route::post("cars",         [APICarController::class, 'store']);
Route::put("cars/{id}",     [APICarController::class, 'update']);
Route::delete("cars/{id}",  [APICarController::class, 'destroy']);

//Rides
Route::get("rides",         [APIRideController::class, 'getAll']);
Route::get("rides/getLastRideOfUser/{id}",          [APIRideController::class, 'getLastRideOfUser']);
Route::get("rides/getAllByUserId/{id}",             [APIRideController::class, 'getAllByUserId']);
Route::get("rides/{id}",    [APIRideController::class, 'show']);
Route::post("rides",        [APIRideController::class, 'store']);
Route::put("rides/{id}",    [APIRideController::class, 'update']);
Route::delete("rides/{id}", [APIRideController::class, 'destroy']);

//Clients
Route::get("clients",         [APIClientController::class, 'getAll']);
Route::get("clients/{id}",    [APIClientController::class, 'show']);
Route::post("clients",        [APIClientController::class, 'store']);
Route::put("clients/{id}",    [APIClientController::class, 'update']);
Route::delete("clients/{id}", [APIClientController::class, 'destroy']);

//Employees
Route::get("employees",         [APIEmployeeController::class, 'getAll']);
Route::get("employees/{id}",    [APIEmployeeController::class, 'show']);
Route::post("employees",        [APIEmployeeController::class, 'store']);
Route::put("employees/{id}",    [APIEmployeeController::class, 'update']);
Route::delete("employees/{id}", [APIEmployeeController::class, 'destroy']);

//Categories
Route::get("categories",         [APICategoryController::class, 'getAll']);
Route::get("categories/{id}",    [APICategoryController::class, 'show']);
Route::post("categories",        [APICategoryController::class, 'store']);
Route::put("categories/{id}",    [APICategoryController::class, 'update']);
Route::delete("categories/{id}", [APICategoryController::class, 'destroy']);
