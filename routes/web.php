<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RideController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/rides/createHome',         [RideController::class, 'createHome']);
Route::get('/rides/createLastRoute',    [RideController::class, 'createLastRoute']);

Route::resources([
    'cars'      => CarController::class,
    'users'     => UserController::class,
    'clients'   => ClientController::class,
    'employees' => EmployeeController::class,
    'rides'     => RideController::class,
]);


Auth::routes();

Route::get('/',         [HomeController::class, 'index']);
Route::get('/home',     [HomeController::class, 'index'])->name('home');
Route::get('/cars',     [CarController::class, 'index'])->name('cars');
Route::get('/clients',  [ClientController::class, 'index'])->name('clients');
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
Route::get('/privacy',  [HomeController::class, 'privacy'])->name('privacy');
Route::get('/rides',    [RideController::class, 'index'])->name('rides');

