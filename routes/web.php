<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

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
    // $user = User::find(133);
    // $user->password = bcrypt('123');
    // $user->save();
    // return 'done';
});

Route::get('dashboard',function(){
	return view('dashboard');
});

// Route::get('form',function(){
//     return view('admin.products.form_create');
// });


Auth::routes();
	
Route::prefix('users')->group(function () {
	Route::get('/',				[UserController::class,'index']);
    Route::get('create',		[UserController::class,'create']);
    Route::post('create/submit',[UserController::class, 'create_submit']);
    Route::get('update/{id}',	[UserController::class, 'update']);
    Route::post('update/submit',[UserController::class, 'update_submit']);
    Route::get('delete/{id}',	[UserController::class, 'delete']);
    Route::get('detail/{id}',	[UserController::class, 'detail']);
});

Route::prefix('branches')->group(function () {
    Route::get('/',					[BranchController::class,'index']);
    Route::get('create',			[BranchController::class,'create']);
    Route::post('create/submit',	[BranchController::class, 'create_submit']);
    Route::get('update/{id}',	    [BranchController::class, 'update']);
    Route::post('update/submit',	[BranchController::class, 'update_submit']);
    Route::get('delete/{id}',	    [BranchController::class, 'delete']);
    // Route::get('detail/{id}',	[EmployeeController::class, 'detail']);

});


Route::prefix('categories')->group(function () {
    Route::get('/',				[CategoryController::class,'index']);
    Route::get('create',		[CategoryController::class,'create']);
    Route::post('create/submit',[CategoryController::class, 'create_submit']);
    Route::get('update/{id}',   [CategoryController::class, 'update']);
    Route::post('update/submit',[CategoryController::class, 'update_submit']);
    Route::get('delete/{id}',   [CategoryController::class, 'delete']);
    
});
    

Route::prefix('inventories')->group(function () {
    Route::get('',                  [InventoryController::class,'index']);
    Route::get('available',         [InventoryController::class,'available']);
    Route::get('create',            [InventoryController::class,'create']);
    Route::post('create/submit',    [InventoryController::class, 'create_submit']);
    Route::get('update/{id}',       [InventoryController::class, 'update']);
    Route::get('transfer/{id}',     [InventoryController::class, 'transfer']);
    Route::post('update/submit',    [InventoryController::class, 'update_submit']);
    Route::get('delete/{id}',       [InventoryController::class, 'delete']);
    Route::get('detail/{id}',       [InventoryController::class, 'detail']);
    Route::post('categories/change', [InventoryController::class, 'category_change'])->name('category_change.action');


    // Usages
    Route::get('transfer/create/{id}',              [UsageController::class,'create_usage']);
    Route::get('transfer/create/user_info/{id}',    [UsageController::class,'get_user_info'])->name('user_info.fetch');
    Route::post('/transfer/now',                    [UsageController::class,'transfer_now']);
    Route::post('transfer/print',                   [UsageController::class,'transfer_print']);
    Route::get('usages/update/{id}',                [UsageController::class,'update_usage']);
    Route::get('usages/detail/{id}',                [UsageController::class,'detail_usage']);
    Route::get('usages/return/{id}',                [UsageController::class,'return_usage']);
    Route::get('usage/delete/{id}', 				[UsageController::class,'delete']);
    Route::get('usages/return/{id}',                [UsageController::class,'return_usage']);
    Route::post('usages/return/submit',             [UsageController::class,'return_submit']);
    Route::get('usages/delete/{id}',                [UsageController::class,'delete_usage']);
    Route::get('usages',                            [UsageController::class,'usages']);
    Route::get('usages/report',                     [UsageController::class,'usages_report']);


    // Search
    Route::post('categories/live_search',[InventoryController::class,'live_search'])->name('categories_search.action');
});

Route::get('test/filter',[UserController::class,'filter'])->name('filter');
Route::get('back',function(){
    return redirect()->back();
})->name('redirect.back');

Route::post('users/live_search',[UserController::class,'live_search'])->name('user_search.action');
Route::post('users/branch_filter',[UserController::class,'branch_filter'])->name('branch_filter.action');
Route::post('users/division_filter',[UserController::class,'division_filter'])->name('division_filter.action');
Route::post('users/department_filter',[UserController::class,'department_filter'])->name('department_filter.action');
Route::post('users/position_filter',[UserController::class,'position_filter'])->name('position_filter.action');



Route::post('inventories/live_search',[InventoryController::class,'live_search'])->name('inventory_search.action');
Route::post('inventories/category_filter',[InventoryController::class,'category_filter'])->name('category_filter.action');
Route::post('inventories/model_filter',[InventoryController::class,'model_filter'])->name('model_filter.action');
Route::post('inventories/status_filter',[InventoryController::class,'status_filter'])->name('status_filter.action');
Route::post('inventories/vendor_filter',[InventoryController::class,'vendor_filter'])->name('vendor_filter.action');
Route::post('inventories/invoice_number_filter',[InventoryController::class,'invoice_filter'])->name('invoice_filter.action');
Route::post('inventories/target_number_filter',[InventoryController::class,'target_filter'])->name('target_filter.action');


Route::get('test',[UsageController::class,'transfer_print']);


// Dashboard
Route::get('asset/home',function(){
    return view('admin.moduls.asset');
});