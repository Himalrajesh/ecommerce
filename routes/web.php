<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\User\PageController;

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
Route::get('/', function () {
    return view('welcome');
})->name('landing');


Route::get('logout', [CommonController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'user', 'as' => 'user.'],function () {
    Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserLoginController::class, 'login'])->name('attempt-login');

    Route::middleware('auth:user')->group(function(){
        Route::get('home', [PageController::class, 'home'])->name('home');
        Route::get('logout', [UserLoginController::class, 'logout'])->name('logout');
    });
});


Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'attemptLogin'])->name('attempt-login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        });
    });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
