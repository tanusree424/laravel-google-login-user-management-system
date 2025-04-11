<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AuthController;
use App\http\Controllers\AdminDashboardController;
use App\http\Controllers\UserDashboardController;
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
Route::get('/register', [AuthController::class , "register"])->name('register');
Route::post('/register/post',[AuthController::class, "post_register"])->name('post_register');
Route::get('/login',[AuthController::class, "login"])->name('login');
Route::get('/auth/google',[AuthController::class , 'googleLogin'])->name('auth.google');
Route::get('/auth/google-callback', [AuthController::class ,'googleAuthentication'])->name('auth.google-callback');
    
Route::post('/login/post', [AuthController::class, "post_login"])->name('post_login');
Route::group(['middleware'=>'superadmin'], function(){
    Route::get('/superadmin/dashboard', [AdminDashboardController::class, "superadmin_dashboard"])->name("superadmin.dashboard");
    Route::post('/logout', [AuthController::class , "Adminlogout"])->name("Adminlogout");
});
Route::group(['middleware'=>'admin'], function(){
    
});
Route::group(['middleware'=>'user'], function(){
    Route::get('/user/dashboard', [UserDashboardController::class, "userdashboard"])->name("userdashboard");
});
