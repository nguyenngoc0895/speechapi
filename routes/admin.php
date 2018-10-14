<?php


Route::get('/', 'DashboardController@dashboard')->name('admin.home');

///route dashboard
Route::get('/logout', 'DashboardController@logout')->name('admin.logout');
