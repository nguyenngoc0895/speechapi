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


Auth::routes();

///User router 
Route::get('/home', 'HomeController@index')->name('home');

///login admin
Route::match(['get', 'post'], 'admin/login', 'AdminController@login')->name('admin.login');

///route dashboard
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');


Route::group(['middleware' => ['auth']], function(){

    ///route home
    Route::get('admin/home', 'AdminController@dashboard')->name('admin.home');
});

