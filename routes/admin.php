<?php


Route::get('/admin/home', 'DashboardController@dashboard')->name('admin.home');

///route dashboard
Route::get('/logout', 'DashboardController@logout')->name('admin.logout');

///Table manager user
Route::get('/user/list', 'DashboardController@UserList')->name('admin.userList');

///Block or Unlock User
Route::get('/user/block/{id}/{status}', 'DashboardController@updateStatus');

///Delete user
Route::get('/user/delete/{id}', 'DashboardController@removeUser')->name('remove_user');

///Update acc user
Route::get('/user/{id}', 'DashboardController@editUser')->name('user.edit');
Route::post('/user/update/{id}', 'DashboardController@updateUser')->name('user.update');


