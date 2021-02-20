<?php

use Illuminate\Http\Request;
use App\Http\Controllers\apiController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Users API
Route::get('/users', 'apiController@getUsers');
Route::get('/user/{id}', 'apiController@getUserbyId');
Route::delete('/users/{id}', 'apiController@deleteUser');
Route::post('/users', 'apiController@addUser');
Route::get('/count-users', 'apiController@countUsers');
Route::patch('/users/{id}','apiController@updateUser');

// Check user data first
Route::post('/users/check-user-data', 'apiController@checkUserData');
