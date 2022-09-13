<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\StateController;
use App\Http\Controllers\admin\CityController;
use App\Http\Controllers\admin\StatController;
use App\Http\Controllers\admin\VideoController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\EnquiryController;
use App\Http\Controllers\admin\EmailController;
use App\Http\Controllers\admin\CoupanController;
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
Route::get('/',[Homecontroller::class,'index']);

Route::get('myorders/{id?}',[HomeController::class,'myorders']);
Route::post('myorders/orderstatus',[HomeController::class,'orderstatus']);

Route::get('aboutus',[HomeController::class,'aboutus']);

Route::get('collection',[HomeController::class,'collection']);

Route::get('product/{id?}',[HomeController::class,'product']);
Route::get('detail/{id?}',[HomeController::class,'product_detail']);

Route::get('terms',[HomeController::class,'terms']);

Route::get('privacypolicy',[HomeController::class,'privacypolicy']);

Route::get('order/{id?}/{customer?}',[HomeController::class,'placeorder']);
Route::post('saveorder',[HomeController::class,'saveorder']);


Route::get('contactus',[HomeController::class,'contactus']);
Route::post('contactus',[HomeController::class,'contactus']);


Route::post('statecity',[HomeController::class,'statecity']);


Route::post('applycoupan',[HomeController::class,'applycoupan']);


Route::get('login',[Logincontroller::class,'login']);
Route::post('login',[Logincontroller::class,'login'])->name('submit-login');
Route::get('logout',[loginController::class,'logout']);   


Route::get('signin',[Logincontroller::class,'signin']);
Route::post('signin',[Logincontroller::class,'signin']);
Route::get('signup',[Logincontroller::class,'signup']);
Route::post('signup',[Logincontroller::class,'signup']);
Route::get('profileupdate',[Logincontroller::class,'profileupdate']);
Route::post('profileupdate',[Logincontroller::class,'profileupdate']);
Route::get('signout',[loginController::class,'signout']);



// ---------------AFTER LOGIN AS ADMIN------------------
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard',[DashboardController::class,'index']);


    Route::get('profile',[UserController::class,'profile']);
    Route::post('updateprofile',[UserController::class,'updateprofile'])->name('update-profile');
    Route::get('password',[UserController::class,'password']);
    Route::post('password',[UserController::class,'password'])->name('password');
    

    Route::get('category',[CategoryController::class,'index']);
    Route::get('category/add',[CategoryController::class,'add']);
    Route::post('category/add',[CategoryController::class,'add'])->name('add_category');
    Route::get('category/edit/{id?}',[CategoryController::class,'edit']);
    Route::post('category/edit/{id?}',[CategoryController::class,'edit']); 
    Route::get('category/delete/{id?}',[CategoryController::class,'delete']);
    Route::get('category/status/{id?}/{status?}',[CategoryController::class,'status']);
    Route::get('category/trend/{id?}/{is_trending?}',[CategoryController::class,'trending']);


    Route::get('product',[ProductController::class,'index']);
    Route::get('product/add',[ProductController::class,'add']);
    Route::post('product/add',[ProductController::class,'add']);
    Route::get('product/edit/{id?}',[ProductController::class,'edit']);
    Route::post('product/edit/{id?}',[ProductController::class,'edit']);
    Route::get('product/delete/{id?}',[ProductController::class,'delete']);
    Route::post('product/delete_img',[ProductController::class,'delete_img']);
    Route::get('product/status/{id?}/{status?}',[ProductController::class,'status']);
    Route::post('product/search',[ProductController::class,'search']);
    

    Route::get('state',[StateController::class,'index']);
    Route::get('state/add',[StateController::class,'add']);
    Route::post('state/add',[StateController::class,'add'])->name('add_state');
    Route::get('state/edit/{id?}',[StateController::class,'edit']);
    Route::post('state/edit/{id?}',[StateController::class,'edit']); 
    Route::get('state/delete/{id?}',[StateController::class,'delete']);
    Route::get('state/status/{id?}/{status?}',[StateController::class,'status']);
    

    Route::get('city',[CityController::class,'index']);
    Route::get('city/add',[CityController::class,'add']);
    Route::post('city/add',[CityController::class,'add'])->name('add_city');
    Route::get('city/edit/{id?}',[CityController::class,'edit']);
    Route::post('city/edit/{id?}',[CityController::class,'edit']); 
    Route::get('city/delete/{id?}',[CityController::class,'delete']);
    Route::get('city/status/{id?}/{status?}',[CityController::class,'status']);


    Route::get('video',[VideoController::class,'index']);
    Route::get('video/add',[VideoController::class,'add']);
    Route::post('video/add',[VideoController::class,'add'])->name('add_video');
    Route::get('video/edit/{id?}',[VideoController::class,'edit']);
    Route::post('video/edit/{id?}',[VideoController::class,'edit']);
    Route::get('video/delete/{id?}',[VideoController::class,'delete']);
    Route::get('video/status/{id?}/{status?}',[VideoController::class,'status']);
    

    Route::get('slider',[SliderController::class,'index']);
    Route::get('slider/add',[SliderController::class,'add']);
    Route::post('slider/add',[SliderController::class,'add'])->name('add_slider');
    Route::get('slider/edit/{id?}',[SliderController::class,'edit']);
    Route::post('slider/edit/{id?}',[SliderController::class,'edit']); 
    Route::get('slider/delete/{id?}',[SliderController::class,'delete']);
    Route::get('slider/status/{id?}/{status?}',[SliderController::class,'status']);
    

    Route::get('stat',[StatController::class,'index']);
    Route::get('stat/add',[StatController::class,'add']);
    Route::post('stat/add',[StatController::class,'add'])->name('add_stat');
    Route::get('stat/edit/{id?}',[StatController::class,'edit']);
    Route::post('stat/edit/{id?}',[StatController::class,'edit']); 
    Route::get('stat/delete/{id?}',[StatController::class,'delete']);
    Route::get('stat/status/{id?}/{status?}',[StatController::class,'status']);


    
    Route::get('enquiry',[EnquiryController::class,'index']);
    Route::get('enquiry/delete/{id?}',[EnquiryController::class,'delete']);



    Route::get('order',[OrderController::class,'order']);
    Route::post('order/orderstatus',[OrderController::class,'orderstatus']);
    Route::post('order/search',[OrderController::class,'search']);
    Route::get('order/detailmodel/{id?}',[OrderController::class,'detailmodel']);



    Route::get('email',[EmailController::class,'index']);
    Route::get('email/delete/{id?}',[EmailController::class,'delete']);
    Route::get('email/status/{id?}/{status?}',[EmailController::class,'status']);



    Route::get('coupan',[CoupanController::class,'index']);
    Route::get('coupan/add',[CoupanController::class,'add']);
    Route::post('coupan/add',[CoupanController::class,'add']);
    Route::get('coupan/edit/{id?}',[CoupanController::class,'edit']);
    Route::post('coupan/edit/{id?}',[CoupanController::class,'edit']);
    Route::get('coupan/delete/{id?}',[CoupanController::class,'delete']);
    Route::get('coupan/status/{id?}/{status?}',[CoupanController::class,'status']);



});

