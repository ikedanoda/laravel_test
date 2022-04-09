<?php


use Illuminate\Support\Facades\Route;

// TODO : 別modelでログインさせる場合はauth:admin_users みたいにすればOKっぽい
#namespace('Admin')->
use App\Http\Controllers\Admin;
Route::middleware('auth:admin_user')->group(function () {
    Route::get('/',[Admin\DashboardController::class, 'show'])->name('dashboard');
    Route::resource('users', Admin\UsersController::class, ['only' => ['index', 'show', 'edit', 'update']]);
});

/* Route::namespace('Admin')->name('admin.')->middleware('auth:users')->group(function () {
    Route::get('/',[DashboardController::class, 'show'])->name('dashboard');
    Route::resource('users', UsersController::class, ['only' => ['index', 'show', 'edit', 'update']]);
}); */

require __DIR__.'/web_admin_auth.php';