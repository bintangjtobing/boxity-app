<?php

use Illuminate\Http\Request;
use App\Http\Controllers\apiController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Users API
Route::get('/users', 'apiController@getUsers');
Route::get('/users/{id}', 'apiController@getUserbyId');
Route::delete('/users/{id}', 'apiController@deleteUser');
Route::post('/users', 'apiController@addUser');
Route::get('/count-users', 'apiController@countUsers');
Route::patch('/users/{id}', 'apiController@updateUser');

// Documents
Route::post('/documents', 'DocumentController@fileStore')->name('dropzone');
Route::get('/documents/{id}', 'DocumentController@getDocument');

// Check user data first
Route::post('/users/check-user-data', 'apiController@checkUserData');

// Issue API
Route::post('/issue', 'apiController@addNewIssue');
Route::get('/issue', 'apiController@getIssues');
Route::get('/issue/created', 'apiController@getIssuesfromMe');
Route::get('/issue-with-comment', 'apiController@getIssuewithComment');
Route::get('/issue/{id}', 'apiController@getIssueById');
// Get the assignee name & approver to issue
Route::get('/issue/assignee/{id}', 'apiController@getAssigneebyId');
Route::get('/issue/approver/{id}', 'apiController@getApprovedbyId');
// Post comment on issue id
Route::post('/issue/add-comment', 'apiController@postComment');
Route::get('/issue/comment/{id}', 'apiController@getCommentbyId');
Route::patch('/issue/approved/{id}', 'apiController@approveIssue');
Route::patch('/issue/closed/{id}', 'apiController@closedIssue');
Route::get('/count-comment/{id}', 'apiController@countCommentDB');

// Career API
Route::get('/career/{id}', 'apiController@getJobbyId');
Route::post('/career', 'apiController@addJob');
Route::get('/career', 'apiController@getJob');
Route::delete('/career/{id}', 'apiController@deleteJob');
Route::patch('/career/{id}', 'apiController@updateJob');

// Blog API
Route::get('/blogs', 'apiController@getBlog');
Route::get('/blogs/{id}', 'apiController@getBlogById');
Route::patch('/blogs/{id}', 'apiController@patchBlogById');
Route::delete('/blogs/{id}', 'apiController@deleteBlogById');
Route::post('/blogs', 'apiController@addNewBlog');

// User Profile API
Route::get('/{username}', 'apiController@getProfile');
Route::patch('/profile/{id}', 'apiController@updateProfile');

// Contact API
Route::get('/contacts', 'apiController@getContact');
