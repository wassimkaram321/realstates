<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;

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
Route::get('/category', [CategoriesController::class, 'show'])->name('category');
Route::get('/category_create', [CategoriesController::class, 'create'])->name('category_create');
Route::post('/category_add', [CategoriesController::class, 'store'])->name('category_add');
Route::post('/category_delete/{id}', [CategoriesController::class, 'destroy'])->name('category_delete');
