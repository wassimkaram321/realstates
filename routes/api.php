<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\RealstateController;
use App\Http\Controllers\Admin\TagController;

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
//login

Route::post('login', [AuthController::class, 'login']);
// Route::middleware(['auth:sanctum', 'role'])->group(function () {
// Route::middleware(['auth:sanctum'])->group(function () {
    
    //logout
    Route::post('logout', [AuthController::class, 'logout']);
    
    //category
    Route::get('/category',        [CategoriesController::class, 'show'])->name('category');
    Route::get('/category_edit',   [CategoriesController::class, 'edit'])->name('category_edit');
    Route::post('/category_add',   [CategoriesController::class, 'store'])->name('category_add');
    Route::post('category_delete', [CategoriesController::class, 'destroy'])->name('category_delete');
    Route::post('category_update', [CategoriesController::class, 'update'])->name('category_update');

    //sub_category
    Route::post('/add_sub',   [SubCategoriesController::class, 'store'])->name('add_sub');
    Route::get('/get_sub',    [SubCategoriesController::class, 'show'])->name('get_sub');
    Route::get('/edit_sub',   [SubCategoriesController::class, 'edit'])->name('edit_sub');
    Route::post('delete_sub', [SubCategoriesController::class, 'destroy'])->name('delete_sub');
    Route::post('update_sub', [SubCategoriesController::class, 'update'])->name('update_sub');

    //child_category
    Route::post('/add_child',   [ChildcategoryController::class, 'store'])->name('add_child');
    Route::get('/edit_child',   [SubCategoriesController::class, 'edit'])->name('edit_child');
    Route::get('/get_child',    [ChildcategoryController::class, 'show'])->name('get_child');
    Route::post('delete_child', [ChildcategoryController::class, 'destroy'])->name('delete_child');
    Route::post('update_child', [ChildcategoryController::class, 'update'])->name('update_child');

    //state
    Route::post('/add_state',   [StateController::class, 'store'])->name('add_state');
    Route::get('/get_state',    [StateController::class, 'show'])->name('get_state');
    Route::post('delete_state', [StateController::class, 'destroy'])->name('delete_state');
    Route::post('update_state', [StateController::class, 'update'])->name('update_state');

    //city
    Route::post('/add_city',   [CityController::class, 'store'])->name('add_city');
    Route::get('/get_city',    [CityController::class, 'show'])->name('get_state');
    Route::post('delete_city', [CityController::class, 'destroy'])->name('delete_city');
    Route::post('update_city', [CityController::class, 'update'])->name('update_city');

    //users
    Route::resource('users', UserController::class);
    Route::post('update_user', [UserController::class, 'update']);
    Route::post('delete_user', [UserController::class, 'destroy']);
    Route::get('user', [UserController::class, 'show']);
    Route::get('user_permissions', [UserController::class, 'user_permission']);
    Route::post('user_status', [UserController::class, 'change_status']);

    //companies
    Route::resource('companies', CompanyController::class);
    Route::post('update_company', [CompanyController::class, 'update']);
    Route::post('delete_company', [CompanyController::class, 'destroy']);
    Route::get('company', [CompanyController::class, 'show']);
    Route::post('company_status', [CompanyController::class, 'change_status']);

    //roles
    Route::get('roles', [RolesController::class,'index']);
    Route::get('role', [RolesController::class,'show']);
    Route::post('add_permission_to_role', [RolesController::class,'add_permission_to_role']);
    Route::post('revoke_permission', [RolesController::class,'revoke_permission']);
    Route::post('remove_permission', [RolesController::class,'remove_permission']);

    //images
    Route::resource('images', ImageController::class);

    //attributes
    Route::resource('attributes', AttributeController::class);

    //tags
    Route::resource('tags', TagController::class);
    Route::post('delete_tag', [TagController::class,'destroy']);
    Route::post('update_tag', [TagController::class,'update']);
    Route::get('tag_real_states', [TagController::class,'tag_real_states']);
    Route::get('tag_details', [TagController::class,'show']);

    //realestates
    Route::resource('realstates', RealstateController::class);
    Route::post('delete_real_states', [RealstateController::class,'destroy']);
    Route::post('update_real_state', [RealstateController::class,'update']);
    Route::post('real_state_status', [RealstateController::class, 'change_status']);
    Route::get('real_state', [RealstateController::class, 'show']);
    Route::get('real_state_by_cat', [RealstateController::class, 'get_realstates_by_category']);
    Route::get('user_real_estates', [RealstateController::class, 'get_user_real_estates']);
    Route::get('city_real_estates', [RealstateController::class, 'get_real_estates_by_city']);
    Route::get('state_real_estates', [RealstateController::class, 'get_real_estates_by_state']);
    Route::get('nearby_real_estates', [RealstateController::class, 'nearby_real_estates']);



// });
