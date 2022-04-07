<?php


use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {
    
});

// TODO : 別modelでログインさせる場合はauth:admin_users みたいにすればOKっぽい
#namespace('Admin')->
use App\Http\Controllers\Admin;
Route::prefix('admin')->name('admin.')->middleware('auth:web')->group(function () {
    Route::get('/',[Admin\DashboardController::class, 'show'])->name('dashboard');
    Route::resource('users', Admin\UsersController::class, ['only' => ['index', 'show', 'edit', 'update']]);
});

/* Route::namespace('Admin')->name('admin.')->middleware('auth:users')->group(function () {
    Route::get('/',[DashboardController::class, 'show'])->name('dashboard');
    Route::resource('users', UsersController::class, ['only' => ['index', 'show', 'edit', 'update']]);
}); */