<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
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


Route::post('login', [AuthController::class, 'login']);
Route::post('new_register', [AuthController::class, 'register']);

//reset password
Route::post('forgotpassword', [AuthController::class, 'forgotpassword']);
Route::post('verifiy_password_otp', [AuthController::class, 'verification_password_otp']);
Route::post('reset_password', [AuthController::class, 'reset_password']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('userprofile', [UserController::class, 'UserProfile']);
    Route::post('updateprofile', [UserController::class, 'update']);
    
    //category
    Route::get('/category',        [CategoriesController::class, 'show'])->name('category');
});
