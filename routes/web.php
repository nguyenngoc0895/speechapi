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

///All router here for User side
Auth::routes(['verify' => true]);

///route home
Route::group(['middleware'=>['is-Blocked', 'verified']], function(){

    ///Route home user
    Route::get('/home', 'UserController@home')->name('home');
    
    //Route profile user
    Route::get('/profile/{id}', 'UserController@show_profile')->name('user.profile');
    Route::get('/profile/{id}/edit', 'UserController@profile_edit')->name('profile.edit');
    Route::post('/profile/{id}', 'UserController@profile_update')->name('profile.update');
    
    //Route update password
    Route::get('/changePassword', 'UserController@password_edit')->name('password.edit');
    Route::post('/changePassword','UserController@changePassword')->name('changePassword');
});

//login with facebook
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');



