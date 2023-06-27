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
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\RealestatBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\NotificationController;

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

//Apis for website

//package
Route::get('packages', [PackageController::class, 'index']);
Route::get('package-by-id',  [PackageController::class, 'show']);

//ads
Route::get('Ads', [AdController::class, 'index']);
Route::get('Ad-show',  [AdController::class, 'show']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    //logout
    Route::post('logout', [AuthController::class, 'logout']);


    Route::get('/chat', [ChatsController::class, 'index']);
    Route::get('messages', [ChatsController::class, 'fetchMessages']);
    Route::post('messages',[ChatsController::class,'sendMessage']);

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
    Route::get('/edit_child',   [ChildcategoryController::class, 'edit'])->name('edit_child');
    Route::get('/get_child',    [ChildcategoryController::class, 'show'])->name('get_child');
    Route::post('delete_child', [ChildcategoryController::class, 'destroy'])->name('delete_child');
    Route::post('update_child', [ChildcategoryController::class, 'update'])->name('update_child');

    //state
    Route::post('/add_state',   [StateController::class, 'store'])->name('add_state');
    Route::get('/get_state',    [StateController::class, 'show'])->name('get_state');
    Route::get('/edit_state',   [StateController::class, 'edit'])->name('edit_state');
    Route::post('delete_state', [StateController::class, 'destroy'])->name('delete_state');
    Route::post('update_state', [StateController::class, 'update'])->name('update_state');

    //city
    Route::post('/add_city',   [CityController::class, 'store'])->name('add_city');
    Route::get('/get_city',    [CityController::class, 'show'])->name('get_state');
    Route::get('/edit_city',   [CityController::class, 'edit'])->name('edit_city');
    Route::post('delete_city', [CityController::class, 'destroy'])->name('delete_city');
    Route::post('update_city', [CityController::class, 'update'])->name('update_city');

    //users
    Route::resource('users', UserController::class);
    Route::post('update_user',     [UserController::class, 'update']);
    Route::post('delete_user',     [UserController::class, 'destroy']);
    Route::get('user',             [UserController::class, 'show']);
    Route::get('user_permissions', [UserController::class, 'user_permission']);
    Route::post('user_status',     [UserController::class, 'change_status']);

    //companies
    Route::resource('companies', CompanyController::class);
    Route::post('update_company', [CompanyController::class, 'update']);
    Route::post('delete_company', [CompanyController::class, 'destroy']);
    Route::get('company', [CompanyController::class, 'show']);
    Route::post('company_status', [CompanyController::class, 'change_status']);

    //roles
    Route::get('roles', [RolesController::class,'index']);
    Route::get('role', [RolesController::class,'show']);
    Route::post('add_permission_to_role', [RolesController::class,'create']);
    Route::post('revoke_permission', [RolesController::class,'revoke_permission']);
    Route::post('remove_permission', [RolesController::class,'remove_permission']);
    Route::get('permissions', [RolesController::class,'permissions']);

    //images
    Route::resource('images', ImageController::class);

    //attributes
    Route::get('attributes', [AttributeController::class,'index']);
    Route::get('attribute', [AttributeController::class,'show']);
    Route::post('attribute-add', [AttributeController::class,'store']);
    Route::post('attribute-update', [AttributeController::class,'update']);
    Route::post('attribute-delete', [AttributeController::class,'destroy']);

    //tags
    Route::resource('tags', TagController::class);
    Route::post('delete_tag', [TagController::class,'destroy']);
    Route::post('update_tag', [TagController::class,'update']);
    Route::get('tag_real_states', [TagController::class,'tag_real_states']);
    Route::get('tag_details', [TagController::class,'show'])->name('tag_details');

    //realestates
    Route::resource('realstates', RealstateController::class);
    Route::post('delete_real_states', [RealstateController::class,'destroy']);
    Route::post('update_real_state', [RealstateController::class,'update']);
    Route::post('real_state_status', [RealstateController::class, 'change_status']);
    Route::post('change_feature', [RealstateController::class, 'change_feature']);
    Route::get('get_feature', [RealstateController::class, 'get_feature']);
    Route::get('get_recommended', [RealstateController::class, 'get_recommended']);
    Route::post('change_recommended', [RealstateController::class, 'change_recommended']);
    Route::get('real_state', [RealstateController::class, 'show']);
    Route::get('real_state_by_cat', [RealstateController::class, 'get_realstates_by_category']);
    Route::get('user_real_estates', [RealstateController::class, 'get_user_real_estates']);
    Route::get('city_real_estates', [RealstateController::class, 'get_real_estates_by_city']);
    Route::get('state_real_estates', [RealstateController::class, 'get_real_estates_by_state']);
    Route::get('nearby_real_estates', [RealstateController::class, 'nearby_real_estates']);
    Route::post('real_estate_images', [RealstateController::class, 'create_image']);
    Route::post('update_estate_images', [RealstateController::class, 'update_image']);

    //favorites realestate
    Route::post('add-favorite-realestate',    [UserController::class, 'addRealEstateToFavorite']);
    Route::post('remove-favorite-realestate', [UserController::class, 'removeRealEstateToFavorite']);
    Route::get('get-favorite-realestates',    [UserController::class, 'getFavoriteRealEstate']);

    //reviews
    Route::post('make_review', [ReviewController::class,'makeRealestateReview']);
    Route::post('delete_review', [ReviewController::class,'deleteRealestateReview']);
    Route::get('realestate_reviews', [ReviewController::class,'RealestateReviews']);
    Route::post('review_change_status', [ReviewController::class,'statusChange']);
    //dashboard
    Route::get('dashboard',        [DashboardController::class,'index']);
    Route::get('weekly_booking',   [DashboardController::class,'weekly_booking']);
    Route::get('last_booking',     [DashboardController::class,'last_booking']);
    Route::get('RealEstatesByCity',[DashboardController::class,'countRealEstatesByCity']);
    Route::get('getTopBookedUsers',[DashboardController::class,'getTopBookedUsers']);

    //Request
    Route::post('add_request',           [RequestController::class,'create']);
    Route::post('delete_request ',       [RequestController::class,'destroy']);
    Route::post('update_request_status', [RequestController::class,'update']);
    Route::get('get_request',            [RequestController::class, 'index']);

    //Booking
    Route::get('get  ',                  [RealestatBookingController::class,'index']);
    Route::post('delete_request ',       [RealestatBookingController::class,'destroy']);
    Route::post('update_request_status', [RealestatBookingController::class,'update']);
    Route::get('get_request',            [RealestatBookingController::class, 'index']);
    Route::get('user_booking',           [RealestatBookingController::class, 'user_booking']);
    Route::get('user_bookedup',          [RealestatBookingController::class, 'user_bookedup']);

    //Ads
    Route::post('Ad-store',    [AdController::class, 'store']);
    Route::post('Ad-update',   [AdController::class, 'update']);
    Route::delete('Ad-delete', [AdController::class, 'destroy']);
    Route::post('update-status',   [AdController::class, 'updateStatus']);
    Route::post('ad-click', [AdController::class, 'AdClick']);

    //package
    Route::post('pacakge-store',    [PackageController::class, 'store']);
    Route::delete('package-delete', [PackaeController::class, 'destroy']);
    Route::post('package-update',   [PackageController::class, 'update']);

    //feature
    Route::get('get_feature', [FeatureController::class,'index']);

    //notifications
    Route::get('notifications',      [NotificationController::class, 'index']);
    Route::get('user-notifications', [NotificationController::class, 'userNotifications']);
    Route::post('notification-send', [NotificationController::class, 'store']);
    Route::post('notification-seeAll',      [NotificationController::class, 'seeAll']);
    Route::get('notification-unseen-count', [NotificationController::class, 'unseenCount']);
    Route::post('notification-enable',      [UserController::class, 'changeEnableNotification']);



    Route::post('Ad-update-status',   [AdController::class, 'updateStatus']);
    Route::post('Ad-click-increment', [AdController::class, 'clickIncrement']);

// });

});
