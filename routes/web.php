<?php

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
    return redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
		Route::get('logout', function() {
				\Auth::logout();
				return redirect('/login');
		});

    Route::prefix('admin')->namespace('Admin')->group(function() {
        Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
        Route::get('users', 'UsersController@index')->middleware('ability:users.view')->name('admin.users');
        Route::get('roles', 'RolesController@index')->middleware('ability:roles.view')->name('admin.roles');
    });

});
