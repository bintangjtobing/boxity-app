<?php

use Illuminate\Http\Request;
use App\Http\Controllers\apiController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// LOGS VIEWER
Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('/check-company', 'purchasingController@getCompany');

// Users API
Route::get('/users', 'apiController@getUsers');
Route::get('/users/{id}', 'apiController@getUserbyId');
Route::delete('/users/{id}', 'apiController@deleteUser');
Route::post('/users', 'apiController@addUser');
Route::get('/count-users', 'apiController@countUsers');
Route::patch('/users/{id}', 'apiController@updateUser');
Route::get('/u/{username}', 'apiController@getUsernameData');

// Check user data first
Route::post('/users/check-users-data', 'apiController@checkUsersData');
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
Route::delete('/issue/delete-comment/{id}', 'apiController@deleteComment');
Route::get('/issue/comment/{id}', 'apiController@getCommentbyId');
Route::patch('/issue/approved/{id}', 'apiController@approveIssue');
Route::patch('/issue/closed/{id}', 'apiController@closedIssue');
Route::get('/count-comment/{id}', 'apiController@countCommentDB');
Route::get('/count-solved-issue', 'apiController@countIssueSolvedById');
Route::get('/count-pending-issue', 'apiController@countIssuePendingById');
Route::get('/count-issue', 'apiController@getIssuesCount');

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
Route::post('/profile/{id}', 'apiController@updateProfile');
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
Route::get('/count-goods', 'apiController@countGoods');

// Document gallery
Route::post('/documents', 'apiController@fileStore')->name('dropzone');
Route::get('/documents/{id}', 'apiController@getDocument');
Route::post('/album', 'apiController@addGallery');
Route::get('/album', 'apiController@getAlbum');

// Version control api
Route::get('/version-control', 'apiController@getVersionControl');
Route::post('/version-control', 'apiController@newVersion');
Route::get('/version-control/{version}', 'apiController@getVersionData');

// Popup Window api
Route::get('/popup-management', 'apiController@getPopup');
Route::post('/popup-management', 'apiController@postPopup');

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
// Get Warehouse based on customer's warehouse
Route::get('/warehouse', 'apiController@getWarehouse');
Route::post('/warehouse', 'apiController@postWarehouse');
Route::get('/warehouse/{id}', 'apiController@getWarehouseById');
Route::delete('/warehouse/{id}', 'apiController@deleteWarehouseById');
Route::patch('/warehouse/{id}', 'apiController@postWarehouseById');

// Warehouse Customer
Route::get('/warehouse-customer/{id}', 'apiController@getWarehouseCustomer');
Route::post('/warehouse-customer/{id}', 'apiController@postWarehouseCustomer');
// Route::get('/warehouse-customer/{id}', 'apiController@getWarehouseCustomerById');
Route::delete('/warehouse-customer/{id}', 'apiController@deleteWarehouseCustomerById');
Route::patch('/warehouse-customer/{id}', 'apiController@postWarehouseCustomerById');

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

// Goods Item Transfer -> list item in one row goods transfer
Route::get('/goods-item-transfer', 'apiController@getGoodsItemTransfer');
Route::post('/goods-item-transfer', 'apiController@postGoodsItemTransfer');
Route::get('/goods-item-transfer/{id}', 'apiController@getGoodsItemTransferById');
Route::patch('/goods-item-transfer/{id}', 'apiController@postGoodsItemTransferById');
Route::delete('/goods-item-transfer/{id}', 'apiController@deleteGoodsItemTransferById');
Route::get('/count-goods-item-transfer', 'apiController@countGoodsItemTransfer');

// ///////////////// CONFIRMATION SECTION START ///////////////////////////////////
// Receiving Confirmation
Route::get('/receiving-confirmation', 'receivingController@getReceivingConfirmation');
Route::post('/receiving-confirmation', 'receivingController@postReceivingConfirmation');
Route::get('/receiving-confirmation/{receiving_number}', 'receivingController@getReceivingConfirmationByReceivingNumber');
Route::patch('/receiving-confirmation/{receiving_number}', 'receivingController@postReceivingConfirmationByReceivingNumber');
Route::delete('/receivings-confirmation/{id}', 'receivingController@deleteReceivingConfirmationById');
Route::get('/count-receiving-confirmation', 'receivingController@countReceivingConfirmation');

// Item Receiving
Route::get('/item-receiving', 'receivingController@getItemReceiving');
Route::post('/item-receiving', 'receivingController@postItemReceiving');
Route::post('/item-receiving/{receiving_number}', 'receivingController@postItemReceivingByReceivingNumber');
Route::get('/item-receiving/{receiving_number}', 'receivingController@getItemReceivingByReceivingNumber');
Route::get('/item-receivings/{id}', 'receivingController@getItemReceivingById');
Route::patch('/item-receiving/{id}', 'receivingController@postItemReceivingById');
Route::delete('/item-receiving/{id}', 'receivingController@deleteItemReceivingById');
Route::get('/count-item-receiving', 'receivingController@countItemReceiving');

// ///////////////// CONFIRMATION SECTION END ///////////////////////////////////

///////////////// PURCHASE ORDER ///////////////////////////////////
// Purchase Order
Route::get('/purchase/order', 'purchasingController@getPurchaseOrder');
Route::post('/purchase/order', 'purchasingController@postPurchaseOrder');
Route::get('/purchase/order/{po_number}', 'purchasingController@getPurchaseOrderByPoNumber');
Route::patch('/purchase/order/{po_number}', 'purchasingController@postPurchaseOrderByPoNumber');
Route::delete('/purchases-order/{id}', 'purchasingController@deletePurchaseOrderById');
Route::get('/count-purchase-order', 'purchasingController@countPurchaseOrder');

// Item on Purchases Order
Route::get('/po/item-purchase', 'itemOnPurchasingController@getItemPurchasePO');
Route::post('/po/item-purchase', 'itemOnPurchasingController@postItemPurchasePO');
Route::post('/po/item-purchase/{po_number}', 'itemOnPurchasingController@postItemPurchaseByPoNumber');
Route::get('/po/item-purchase/{po_number}', 'itemOnPurchasingController@getItemPurchaseByPoNumber');
Route::get('/po/item-purchases/{id}', 'itemOnPurchasingController@getItemPurchasePOById');
Route::patch('/po/item-purchase/{id}', 'itemOnPurchasingController@postItemPurchasePOById');
Route::delete('/po/item-purchase/{id}', 'itemOnPurchasingController@deleteItemPurchasePOById');
Route::get('/po/count-item-purchase', 'itemOnPurchasingController@countItemPurchasePO');
///////////////// PURCHASE ORDER END ///////////////////////////////////

///////////////// PURCHASE INVOICE ///////////////////////////////////
// Purchase Invoice
Route::get('/purchase/invoices', 'purchasingController@getPurchaseInvoice');
Route::post('/purchase/invoices', 'purchasingController@postPurchaseInvoice');
Route::get('/purchase/invoices/{pi_number}', 'purchasingController@getPurchaseInvoiceByPiNumber');
Route::patch('/purchase/invoices/{pi_number}', 'purchasingController@postPurchaseInvoiceByPiNumber');
Route::delete('/purchases-invoices/{id}', 'purchasingController@deletePurchaseInvoiceById');
Route::get('/count-purchase-invoice', 'purchasingController@countPurchaseInvoice');

Route::get('/pi/item-purchase', 'itemOnPurchasingController@getItemPurchasePI');
Route::post('/pi/item-purchase', 'itemOnPurchasingController@postItemPurchasePI');
Route::post('/pi/item-purchase/{pi_number}', 'itemOnPurchasingController@postItemPurchaseByPiNumber');
Route::get('/pi/item-purchase/{pi_number}', 'itemOnPurchasingController@getItemPurchaseByPiNumber');
Route::get('/pi/item-purchases/{id}', 'itemOnPurchasingController@getItemPurchasePIById');
Route::patch('/pi/item-purchase/{id}', 'itemOnPurchasingController@postItemPurchasePIById');
Route::delete('/pi/item-purchase/{id}', 'itemOnPurchasingController@deleteItemPurchasePIById');
Route::get('/pi/count-item-purchase', 'itemOnPurchasingController@countItemPurchasePI');
///////////////// PURCHASE INVOICE END ///////////////////////////////////

///////////////// PURCHASE RETURN ///////////////////////////////////
// Purchase RETURN
Route::get('/purchase/return', 'purchasingController@getPurchaseReturn');
Route::post('/purchase/return', 'purchasingController@postPurchaseReturn');
Route::get('/purchase/return/{pr_number}', 'purchasingController@getPurchaseReturnByPrNumber');
Route::patch('/purchase/return/{pr_number}', 'purchasingController@postPurchaseReturnByPrNumber');
Route::delete('/purchases-return/{id}', 'purchasingController@deletePurchaseReturnById');
Route::get('/count-purchase-return', 'purchasingController@countPurchaseReturn');

Route::get('/pr/item-purchase', 'itemOnPurchasingController@getItemPurchasePR');
Route::post('/pr/item-purchase', 'itemOnPurchasingController@postItemPurchasePR');
Route::post('/pr/item-purchase/{pr_number}', 'itemOnPurchasingController@postItemPurchaseByPrNumber');
Route::get('/pr/item-purchase/{pr_number}', 'itemOnPurchasingController@getItemPurchaseByPrNumber');
Route::get('/pr/item-purchases/{id}', 'itemOnPurchasingController@getItemPurchasePRById');
Route::patch('/pr/item-purchase/{id}', 'itemOnPurchasingController@postItemPurchasePRById');
Route::delete('/pr/item-purchase/{id}', 'itemOnPurchasingController@deleteItemPurchasePRById');
Route::get('/pr/count-item-purchase', 'itemOnPurchasingController@countItemPurchasePR');
///////////////// PURCHASE RETURN END ///////////////////////////////////

///////////////////// PURCHASE REQUEST /////////////////////////////
// Purchase Request
Route::get('/purchase/request', 'purchasingController@getPurchaseRequest');
Route::post('/purchase/request', 'purchasingController@postPurchaseRequest');
Route::get('/purchase/request/{pre_number}', 'purchasingController@getPurchaseRequestByPreNumber');
Route::get('/copy/purchase/request/{pre_number}', 'purchasingController@getPurchaseRequestMakePOByPreNumber');
Route::get('/approve/purchase/request/{pre_number}', 'purchasingController@approvePurchaseRequestByPreNumber');
Route::patch('/purchase/request/{pre_number}', 'purchasingController@postPurchaseRequestByPreNumber');
Route::delete('/purchases/request/{id}', 'purchasingController@deletePurchaseRequestById');
Route::get('/count-purchase-request', 'purchasingController@countPurchaseRequest');

Route::get('/pre/item-purchase', 'itemOnPurchasingController@getItemPurchasePRE');
Route::post('/pre/item-purchase', 'itemOnPurchasingController@postItemPurchasePRE');
Route::post('/pre/item-purchase/{pre_number}', 'itemOnPurchasingController@postItemPurchaseByPreNumber');
Route::get('/pre/item-purchase/{pre_number}', 'itemOnPurchasingController@getItemPurchaseByPreNumber');
Route::get('/pre/item-purchases/{id}', 'itemOnPurchasingController@getItemPurchasePREById');
Route::patch('/pre/item-purchase/{id}', 'itemOnPurchasingController@postItemPurchasePREById');
Route::delete('/pre/item-purchase/{id}', 'itemOnPurchasingController@deleteItemPurchasePREById');
Route::get('/pre/count-item-purchase', 'itemOnPurchasingController@countItemPurchasePRE');
///////////////////// PURCHASE REQUEST END /////////////////////////////

// Sales Order
Route::get('/sales/order', 'salesController@getSalesOrder');
Route::post('/sales/order', 'salesController@postSalesOrder');
Route::get('/sales/order/{id}', 'salesController@getSalesOrderById');
Route::patch('/sales/order/{id}', 'salesController@postSalesOrderById');
Route::delete('/sales/order/{id}', 'salesController@deleteSalesOrderById');
Route::get('/count-sales-order', 'salesController@countSalesOrder');

// Sales Invoice
Route::get('/sales/invoice', 'salesController@getSalesInvoice');
Route::post('/sales/invoice', 'salesController@postSalesInvoice');
Route::get('/sales/invoice/{id}', 'salesController@getSalesInvoiceById');
Route::patch('/sales/invoice/{id}', 'salesController@postSalesInvoiceById');
Route::delete('/sales/invoice/{id}', 'salesController@deleteSalesInvoiceById');
Route::get('/count-sales-invoice', 'salesController@countSalesInvoice');

// Sales Return
Route::get('/sales/return', 'salesController@getSalesReturn');
Route::post('/sales/return', 'salesController@postSalesReturn');
Route::get('/sales/return/{id}', 'salesController@getSalesReturnById');
Route::patch('/sales/return/{id}', 'salesController@postSalesReturnById');
Route::delete('/sales/return/{id}', 'salesController@deleteSalesReturnById');
Route::get('/count-sales-return', 'salesController@countSalesReturn');

// Sales Delivery Receipt
Route::get('/sales/delivery-receipt', 'salesController@getSalesDeliveryReceipt');
Route::post('/sales/delivery-receipt', 'salesController@postSalesDeliveryReceipt');
Route::get('/sales/delivery-receipt/{id}', 'salesController@getSalesDeliveryReceiptById');
Route::patch('/sales/delivery-receipt/{id}', 'salesController@postSalesDeliveryReceiptById');
Route::delete('/sales/delivery-receipt/{id}', 'salesController@deleteSalesDeliveryReceiptById');
Route::get('/count-sales-delivery-receipt', 'salesController@countSalesDeliveryReceipt');

// Item Sales
Route::get('/item-sales', 'purchasingController@getItemSales');
Route::post('/item-sales', 'purchasingController@postItemSales');
Route::get('/item-sales/{id}', 'purchasingController@getItemSalesById');
Route::patch('/item-sales/{id}', 'purchasingController@postItemSalesById');
Route::delete('/item-sales/{id}', 'purchasingController@deleteItemSalesById');
Route::get('/count-item-sales', 'purchasingController@countItemSales');

// Leave Request
Route::get('/generate-one-lr', 'apiController@plusOneEachTen');

// USER ACTIVITY LOGS
Route::get('/user-logs', 'apiController@getActivityLogs');
