<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (){
    return view('welcome');
});
Route::controller(SocialteController::class)->group(function(){
    Route::get('/auth/google',[SocialteController::class , 'googleLogin'])->name('auth.google');
    Route::get('/auth/google-callback', [SocialteController::class ,'googleAuthentication'])->name('auth.google-callback');
    

});
Route::get('/superadmin/dashboard', function () {
    return view('SuperAdmin.SuperAdmin');
})->name('superadmin.dashboard');
Route::get('/admin/dashboard', function () {
    return view('Admin.AdminDashboard');
})->name('admin.dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
