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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('users.logout');

Route::prefix('admin')->group(function() {
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');

    // Password reset route
    Route::post('/password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')
        ->name('admin.password.email');
    Route::get('/password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')
        ->name('admin.password.request');
    Route::post('/password/reset', 'AuthAdmin\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')
        ->name('admin.password.reset');

    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});

Route::prefix('owner')->group(function() {
    Route::get('/login', 'AuthOwner\LoginController@showLoginForm')->name('owner.login');
    Route::post('/login', 'AuthOwner\LoginController@login')->name('owner.login.submit');
    Route::get('/register', 'AuthOwner\RegisterController@showRegisterForm')->name('owner.register');
    Route::post('/register', 'AuthOwner\RegisterController@register')->name('owner.register.submit');
    Route::get('/logout', 'AuthOwner\LoginController@logout')->name('owner.logout');

    // Password reset route
    Route::post('/password/email', 'AuthOwner\ForgotPasswordController@sendResetLinkEmail')
        ->name('owner.password.email');
    Route::get('/password/reset', 'AuthOwner\ForgotPasswordController@showLinkRequestForm')
        ->name('owner.password.request');
    Route::post('/password/reset', 'AuthOwner\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'AuthOwner\ResetPasswordController@showResetForm')
        ->name('owner.password.reset');

    Route::get('/', 'OwnerController@index')->name('owner.dashboard');
});
