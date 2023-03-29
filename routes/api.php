<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;

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

//category
Route::get('/category', [CategoriesController::class, 'show'])->name('category');
Route::post('/category_add', [CategoriesController::class, 'store'])->name('category_add');
Route::post('category_delete', [CategoriesController::class, 'destroy'])->name('category_delete');
Route::post('category_update', [CategoriesController::class, 'update'])->name('category_update');

//sub_category
Route::post('/add_sub', [SubCategoriesController::class, 'store'])->name('add_sub');
Route::get('/get_sub', [SubCategoriesController::class, 'show'])->name('get_sub');
Route::post('delete_sub', [SubCategoriesController::class, 'destroy'])->name('delete_sub');
Route::post('update_sub', [SubCategoriesController::class, 'update'])->name('update_sub');

//child_category
Route::post('/add_child', [ChildcategoryController::class, 'store'])->name('add_child');
Route::get('/get_child', [ChildcategoryController::class, 'show'])->name('get_child');
Route::post('delete_child', [ChildcategoryController::class, 'destroy'])->name('delete_child');
Route::post('update_child', [ChildcategoryController::class, 'update'])->name('update_child');

//state
Route::post('/add_state', [StateController::class, 'store'])->name('add_state');
Route::get('/get_state', [StateController::class, 'show'])->name('get_state');
Route::post('delete_state', [StateController::class, 'destroy'])->name('delete_state');
Route::post('update_state', [StateController::class, 'update'])->name('update_state');

//city
Route::post('/add_city', [CityController::class, 'store'])->name('add_city');
Route::get('/get_city', [CityController::class, 'show'])->name('get_state');
Route::post('delete_city', [CityController::class, 'destroy'])->name('delete_city');
Route::post('update_city', [CityController::class, 'update'])->name('update_city');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

