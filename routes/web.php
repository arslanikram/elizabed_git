<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FabricController; 
use App\Http\Controllers\Admin\FabricColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ArchiveController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ColorController;


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

Route::get('admin/login',[LoginController::class, 'index']);
Route::post('admin/login',[LoginController::class, 'login']);
Route::get('admin/logout',[LoginController::class, 'logout']);

Route::group(['middleware'=>'admin','prefix'=>'admin'], function(){


	Route::get('/', [DashboardController::class, 'index']);
	Route::get('/dashboard', [DashboardController::class, 'index']);
	Route::get('/categories/status-active/{id}', [CategoryController::class, 'status_active'])->name('Active');
	Route::get('/categories/status-inactive/{id}', [CategoryController::class, 'status_inactive']);
	Route::resource('/categories', CategoryController::class);

	/* Sub-categories routes */
	Route::get('/sub-categories/status-active/{id}', [SubCategoryController::class, 'status_active']);
	Route::get('/sub-categories/status-inactive/{id}', [SubCategoryController::class, 'status_inactive']);
	Route::resource('/sub-categories', SubCategoryController::class);

	/* Fabric*/
	Route::get('fabric/status-active/{id}',[FabricController::class, 'status_active']);
	Route::get('fabric/status-inactive/{id}',[FabricController::class,'status_inactive']);
	Route::resource('/fabric', FabricController::class); 

	/* Fabric colors*/
	Route::get('fabric-color/status-active/{id}',[FabricColorController::class, 'status_active']);
	Route::get('fabric-color/status-inactive/{id}',[FabricColorController::class,'status_inactive']);
	Route::resource('/fabric-color', FabricColorController::class); 

	/* Products*/
	Route::post('product/get_subCategory',[ProductController::class, 'get_subCategory']);
	Route::post('product/get_fabric_color',[ProductController::class, 'get_fabric_color']);
	Route::get('product/status-active/{id}',[ProductController::class, 'status_active']);
	Route::get('product/status-inactive/{id}',[ProductController::class,'status_inactive']);
	Route::resource('/product', ProductController::class); 

	
	/* Archive */
	Route::get('/archive/category', [ArchiveController::class, 'category']);
	Route::get('/archive/subCategory', [ArchiveController::class, 'subCategory']);
	Route::get('/archive/fabric', [ArchiveController::class, 'fabric']);
	Route::get('/archive/fabricColor', [ArchiveController::class, 'fabricColor']);

	/* Archive */

	Route::resource('/banner', BannerController::class);

	/* Colors */
    Route::get('colors/status-active/{id}',[ColorController::class, 'status_active']);
    Route::get('colors/status-inactive/{id}',[ColorController::class,'status_inactive']);
    Route::resource('/colors', ColorController::class);

	/** Order  */
	Route::get('/order/ongoingOrder', [OrderController::class, 'ongoing_order']);
	Route::get('/order/completedOrder', [OrderController::class, 'completed_order']);
	Route::get('/order/cancelledOrder', [OrderController::class, 'cancelled_order']);
	Route::resource('/order', OrderController::class);

	/** Vendors */
	Route::resource('/vendor', VendorController::class);

});

