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
    return redirect('AdminLogin');
});

// prefix route for Admin

Route::group(['prefix' => 'AdminLogin'], function () {
    Route::get('/', 'AdminLoginController@showLoginForm')->name('show:login');
    Route::post('/login' ,'AdminLoginController@login')->name('admin.login');
    Route::any('/logout', 'AdminLoginController@logout')->name('admin.logout');
    
    //Authentication route 
    Route::group(['middleware' => 'admin.auth'], function () {
       //dashboard route
       Route::get('/dashboard', 'DashboardController@dashboard')->name('admin.dashboard');
       //Artist Route 
       Route::resource('artist', 'ArtistController');
    });
});


