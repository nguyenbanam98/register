<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dang-ky', [AuthController::class, 'register']);
Route::post('/dang-ky', [AuthController::class, 'store']);
Route::get('districts/{province}', [AuthController::class, 'getDistrictFromProvinces'])->name('get.district');

Route::get('/wards/{district}', [AuthController::class, 'getWardFromDistrict']);
