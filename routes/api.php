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
Route::get('/u/{username}', 'apiController@getUsernameData');

// Check user data first
Route::post('/users/check-user-data', 'apiController@checkUserData');

// get user list without user logged in
Route::get('/userGetWithOutLoggedIn', 'apiController@userGetWithOutLoggedIn');
Route::get('/assignees', 'apiController@getAssignee');

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
Route::get('/count-solved-issue', 'apiController@countIssueSolvedById');
Route::get('/count-pending-issue', 'apiController@countIssuePendingById');

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
Route::get('/u/{username}', 'apiController@getProfile');
Route::patch('/profile/{id}', 'apiController@updateProfile');
Route::patch('/profile/password-update/{id}', 'apiController@updatePassword');

// Contact API
Route::get('/contacts', 'apiController@getContact');
Route::get('/contact-list', 'apiController@getContactList');

// Quote API
Route::get('/quote/get', 'apiController@getQuoteAll');
Route::get('/quote/{id}', 'apiController@getQuotebyId');
Route::post('/quote', 'apiController@addQuote');
Route::delete('/quote/{id}', 'apiController@deleteQuote');
Route::patch('/quote/{id}', 'apiController@updateQuote');
Route::patch('/quote/approved/{id}', 'apiController@approvedQuote');

// Order track delivery API
Route::get('/track-delivery/get', 'apiController@getTrack');
Route::post('/track-delivery', 'apiController@newOrderTrack');
Route::get('/track-delivery/{id}', 'apiController@getTrackById');
Route::post('/track-delivery/{id}', 'apiController@postTrackById');
Route::patch('/track-delivery/{id}', 'apiController@patchTrackById');
Route::patch('/track-deliverys/{id}', 'apiController@terminateTrack');

// notepad API
Route::get('/notepad', 'apiController@getNotes');
Route::post('/notepad', 'apiController@postNotes');
Route::delete('/notepad/{id}', 'apiController@deleteNote');
Route::patch('/notepad/favorite/{id}', 'apiController@favoriteNote');
Route::patch('/notepad/unfavorite/{id}', 'apiController@unfavoriteNote');
Route::get('/notepad/favorite', 'apiController@favoriteDataNotepad');
Route::get('/notepad/personal', 'apiController@personalDataNotepad');
Route::get('/notepad/work', 'apiController@workDataNotepad');
Route::get('/notepad/social', 'apiController@socialDataNotepad');
Route::get('/notepad/important', 'apiController@importantDataNotepad');

// goods receipt API
Route::get('/goods-receipt', 'apiController@getGoods');
Route::post('/goods-receipt', 'apiController@postGoods');
Route::patch('/goods-receipt/{id}', 'apiController@getGoodsById');

// Document gallery
Route::post('/documents', 'apiController@fileStore')->name('dropzone');
Route::get('/documents/{id}', 'apiController@getDocument');
Route::post('/album', 'apiController@addGallery');
Route::get('/album', 'apiController@getAlbum');

// Version control api
Route::get('/version-control', 'apiController@getVersionControl');
Route::post('/version-control', 'apiController@newVersion');
Route::get('/version-control/{version}', 'apiController@getVersionData');

// User Guide API
Route::get('/user-guide', 'apiController@userGuideGet');
Route::post('/user-guide', 'apiController@newGuide');

// Candidate API
Route::get('/candidates', 'apiController@getCandidate');
Route::get('/candidates/{id}', 'apiController@getCandidateById');
Route::delete('/candidates/{id}', 'apiController@deleteCandidate');

// CHAT API
Route::get('/chat/{id}', 'apiController@getChatFor');
Route::get('/list-contact', 'apiController@getListContact');
Route::get('/list-contact/{id}', 'apiController@getListContactById');
Route::post('/chat/send', 'apiController@sendChat');

// Company Details
Route::get('/company-details', 'apiController@getCompanyDetails');
Route::post('/company-details', 'apiController@saveCompanyDetails');

// Customers API
Route::get('/customers', 'apiController@getCustomers');
Route::get('/customers/{id}', 'apiController@getCustomerbyId');
Route::delete('/customers/{id}', 'apiController@deleteCustomer');
Route::post('/customers', 'apiController@addCustomer');
Route::get('/count-customers', 'apiController@countCustomers');
Route::patch('/customers/{id}', 'apiController@updateCustomer');

// Suppliers API
Route::get('/suppliers', 'apiController@getSuppliers');
Route::get('/suppliers/{id}', 'apiController@getSuppliersbyId');
Route::delete('/suppliers/{id}', 'apiController@deleteCustomer');
Route::post('/suppliers', 'apiController@addSuppliers');
Route::get('/count-suppliers', 'apiController@countSuppliers');
Route::patch('/suppliers/{id}', 'apiController@updateSuppliers');

// Warehouse
Route::get('/warehouse', 'apiController@getWarehouse');
Route::post('/warehouse', 'apiController@postWarehouse');
Route::get('/warehouse/{id}', 'apiController@getWarehouseById');
Route::delete('/warehouse/{id}', 'apiController@deleteWarehouseById');
Route::patch('/warehouse/{id}', 'apiController@postWarehouseById');

// Stock Group
Route::get('/stock-group', 'apiController@getStockGroup');
Route::post('/stock-group', 'apiController@postStockGroup');
Route::get('/stock-group/{id}', 'apiController@getStockGroupById');
Route::get('/count-stock-group', 'apiController@countStockGroup');
Route::patch('/stock-group/{id}', 'apiController@postStockGroupById');
Route::delete('/stock-group/{id}', 'apiController@deleteStockGroupById');

// Item Group
Route::get('/item-group', 'apiController@getItemGroup');
Route::post('/item-group', 'apiController@postItemGroup');
Route::get('/item-group/{id}', 'apiController@getItemGroupById');
Route::patch('/item-group/{id}', 'apiController@postItemGroupById');
Route::get('/count-item-group', 'apiController@countItemGroup');
Route::delete('/item-group/{id}', 'apiController@deleteItemGroupById');

// Inventory Item
Route::get('/inventory-item', 'apiController@getInventoryItem');
Route::post('/inventory-item', 'apiController@postInventoryItem');
Route::get('/inventory-item/{id}', 'apiController@getInventoryItemById');
Route::patch('/inventory-item/{id}', 'apiController@postInventoryItemById');
Route::get('/count-inventory-item', 'apiController@countInventoryItem');
Route::delete('/inventory-item/{id}', 'apiController@deleteInventoryItemById');

// Goods Transfer
Route::get('/goods-transfer', 'apiController@getGoodsTransfer');
Route::post('/goods-transfer', 'apiController@postGoodsTransfer');
Route::get('/goods-transfer/{id}', 'apiController@getGoodsTransferById');
Route::patch('/goods-transfer/{id}', 'apiController@postGoodsTransferById');
Route::delete('/goods-transfer/{id}', 'apiController@deleteGoodsTransferById');
Route::get('/count-goods-transfer', 'apiController@countGoodsTransfer');

// Goods Item Transfer
Route::get('/goods-item-transfer', 'apiController@getGoodsItemTransfer');
Route::post('/goods-item-transfer', 'apiController@postGoodsItemTransfer');
Route::get('/goods-item-transfer/{id}', 'apiController@getGoodsItemTransferById');
Route::patch('/goods-item-transfer/{id}', 'apiController@postGoodsItemTransferById');
Route::delete('/goods-item-transfer/{id}', 'apiController@deleteGoodsItemTransferById');
Route::get('/count-goods-item-transfer', 'apiController@countGoodsItemTransfer');

// Leave Request
Route::get('/generate-one-lr', 'apiController@plusOneEachTen');
