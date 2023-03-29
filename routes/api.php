<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//login
Route::post('login', [AuthController::class,'login']);

//users
Route::resource('users', UserController::class);
Route::post('update_user', [UserController::class,'update']);
Route::post('delete_user', [UserController::class,'destroy']);
Route::get('user', [UserController::class,'show']);
Route::post('user_status', [UserController::class,'change_status']);
//companies
Route::resource('companies', CompanyController::class);
Route::post('update_company', [CompanyController::class,'update']);
Route::post('delete_company', [CompanyController::class,'destroy']);
Route::get('company', [CompanyController::class,'show']);
Route::post('company_status', [CompanyController::class,'change_status']);



