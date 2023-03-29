<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Admin\ChildcategoryController;

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

Auth::routes();

//category
Route::get('/category', [CategoriesController::class, 'show'])->name('category');
Route::get('/category_create', [CategoriesController::class, 'create'])->name('category_create');
Route::post('/category_add', [CategoriesController::class, 'store'])->name('category_add');
Route::get('category_edit/{id}', [CategoriesController::class, 'edit'])->name('category_edit');
Route::post('category_delete', [CategoriesController::class, 'destroy'])->name('category_delete');
Route::post('category_update', [CategoriesController::class, 'update'])->name('category_update');

//sub_category
Route::post('/add_sub', [SubCategoriesController::class, 'store'])->name('add_sub');
Route::get('/get_sub', [SubCategoriesController::class, 'show'])->name('get_sub');
Route::get('/create_sub', [SubCategoriesController::class, 'create'])->name('create_sub');
Route::post('edit_sub/{id}', [SubCategoriesController::class, 'edit'])->name('edit_sub');
Route::post('delete_sub', [SubCategoriesController::class, 'destroy'])->name('delete_sub');
Route::post('update_sub', [SubCategoriesController::class, 'update'])->name('update_sub');

//child_category
Route::post('/add_child', [ChildcategoryController::class, 'store'])->name('add_child');
Route::get('/get_child', [ChildcategoryController::class, 'show'])->name('get_child');
Route::get('/create_child', [ChildcategoryController::class, 'create'])->name('create_child');
Route::post('edit_child/{id}', [ChildcategoryController::class, 'edit'])->name('edit_child');
Route::post('delete_child', [ChildcategoryController::class, 'destroy'])->name('delete_child');
Route::post('update_child', [ChildcategoryController::class, 'update'])->name('update_child');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
