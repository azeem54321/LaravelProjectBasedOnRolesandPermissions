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
    return view('welcome');
});

Route::group(['prefix' => 'admin','namespace' => 'Admin\Auth','middleware' => 'admin_guest'], function () {
    Route::get('login', 'LoginController@showLoginForm');
    Route::post('login', 'LoginController@login')->name('admin.login');
    Route::get('register', 'RegisterController@showRegistrationForm');
    Route::post('register', 'RegisterController@register')->name('admin.register');
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('admin.password.update');
});
Route::group(['prefix' => 'admin','namespace' => 'Admin\Auth','middleware' => 'admin_auth'], function () {
    Route::get('/logout', 'LoginController@logout')->name('admin.logout');
});

Route::group(['prefix' => 'admin','namespace' => 'Admin\Auth','middleware' => ['admin_auth','emailNot_verified']], function () {
    Route::get('email/verify', 'VerificationController@show')->name('admin.verification.notice');
    Route::get('email/verify/{id}', 'VerificationController@verify')->name('admin.verification.verify');
    Route::get('email/resend', 'VerificationController@resend')->name('admin.verification.resend');
});

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['admin_auth','email_verified']], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/profile', 'HomeController@profile');
    Route::post('/profile', 'HomeController@saveprofile');
    Route::resource('/users', 'UserController');
    Route::resource('/roles', 'RoleController');
    Route::resource('posts', 'PostsController');
});





