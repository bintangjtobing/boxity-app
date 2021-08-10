<?php

use Illuminate\Http\Request;
use App\Http\Controllers\apiController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// LOGS VIEWER
Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Route::get('/check-company', 'purchasingController@getCompany');

Route::get('/test-pdf', function () {
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream();
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
Route::post('/users/check-users-data', 'apiController@checkUsersData');
Route::post('/users/check-user-data', 'apiController@checkUserData');

// get user list without user logged in
Route::get('/userGetWithOutLoggedIn', 'apiController@userGetWithOutLoggedIn');
Route::get('/assignees', 'apiController@getAssignee');

// Issue API
Route::post('/issue', 'apiController@addNewIssue');
Route::get('/issue', 'apiController@getIssues');
Route::get('/issue/created', 'apiController@getIssuesfromMe');
Route::get('/issue/closed', 'apiController@getIssuesClosed');
Route::get('/issue/c/closed', 'apiController@countIssuesClosed');
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
Route::post('/meta/company-details/{id}', 'apiController@saveMetaCompanyDetails');

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

// History Ittem
Route::get('/item-history/{id}', 'apiController@getHistoryItemById');
Route::get('/sum/in/item-history/{id}', 'apiController@sumQtyInHistoryItem');
Route::get('/sum/out/item-history/{id}', 'apiController@sumQtyOutHistoryItem');
Route::get('/report/item-history/{id}', 'apiController@reportItemHistory');

// Goods Item Transfer -> list item in one row goods transfer
Route::get('/goods-item-transfer', 'apiController@getGoodsItemTransfer');
Route::post('/goods-item-transfer', 'apiController@postGoodsItemTransfer');
Route::get('/goods-item-transfer/{id}', 'apiController@getGoodsItemTransferById');
Route::patch('/goods-item-transfer/{id}', 'apiController@postGoodsItemTransferById');
Route::delete('/goods-item-transfer/{id}', 'apiController@deleteGoodsItemTransferById');
Route::get('/count-goods-item-transfer', 'apiController@countGoodsItemTransfer');

///////////////// DOCUMENT DELIVERY ///////////////////////////////////
// Document Delivery
Route::get('/document/delivery', 'apiController@getDocumentsDelivery');
Route::post('/document/delivery', 'apiController@postDocumentsDelivery');
Route::get('/document/delivery/{ddr_number}', 'apiController@getDocumentsDeliveryByDdrNumber');
Route::patch('/document/delivery/{ddr_number}', 'apiController@postDocumentsDeliveryByDdrNumber');
Route::get('/taken/document/delivery/{ddr_number}', 'apiController@takenDocumentsDeliveryByDdrNumber');
Route::delete('/documents-delivery/{id}', 'apiController@deleteDocumentsDeliveryById');
Route::get('/count-document-delivery', 'apiController@countDocumentsDelivery');


// Item on  Document Delivery
Route::get('/ddr/item-document', 'itemOnSalesController@getItemDocumentDeliveryDDR');
Route::post('/ddr/item-document', 'itemOnSalesController@postItemDocumentDeliveryDDR');
Route::post('/ddr/item-document/{ddr_number}', 'itemOnSalesController@postItemDocumentDeliveryByDdrNumber');
Route::get('/ddr/item-documents/{id}', 'itemOnSalesController@getItemDocumentDeliveryDDRById');
Route::get('/ddr/item-document/{ddr_number}', 'itemOnSalesController@getItemDocumentDeliveryByDdrNumber');
Route::patch('/ddr/item-document/{id}', 'itemOnSalesController@postItemDocumentDeliveryDDRById');
Route::delete('/ddr/item-document/{id}', 'itemOnSalesController@deleteItemDocumentDeliveryDDRById');
Route::get('/ddr/count-item-document', 'itemOnSalesController@countItemDocumentDeliveryDDR');
///////////////// DOCUMENT DELIVERY END ///////////////////////////////////

///////////////// PURCHASE ORDER ///////////////////////////////////
// Purchase Order
Route::get('/purchase/order', 'purchasingController@getPurchaseOrder');
Route::post('/purchase/order', 'purchasingController@postPurchaseOrder');
Route::get('/purchase/order/{po_number}', 'purchasingController@getPurchaseOrderByPoNumber');
Route::patch('/purchase/order/{po_number}', 'purchasingController@postPurchaseOrderByPoNumber');
Route::delete('/purchases-order/{id}', 'purchasingController@deletePurchaseOrderById');
Route::get('/count-purchase-order', 'purchasingController@countPurchaseOrder');
Route::get('/approve/purchase/order/{po_number}', 'purchasingController@approvePurchaseOrderByPoNumber');


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
Route::get('/report/sales-order/{id}', 'salesController@reportSalesOrder');
Route::get('/count-sales-order', 'salesController@countSalesOrder');

///////////////// SALES INVOICE ///////////////////////////////////
// Sales Invoice
Route::get('/sales/invoices', 'salesController@getSalesInvoice');
Route::post('/sales/invoices', 'salesController@postSalesInvoice');
Route::get('/sales/invoices/{si_number}', 'salesController@getSalesInvoiceBySiNumber');
Route::patch('/sales/invoices/{si_number}', 'salesController@postSalesInvoiceBySiNumber');
Route::delete('/saless-invoices/{id}', 'salesController@deleteSalesInvoiceById');
Route::get('/count-sales-invoice', 'salesController@countSalesInvoice');

Route::get('/si/item-sales', 'itemOnSalesController@getItemSalesSI');
Route::post('/si/item-sales', 'itemOnSalesController@postItemSalesSI');
Route::post('/si/item-sales/{si_number}', 'itemOnSalesController@postItemSalesBySiNumber');
Route::get('/si/item-sales/{si_number}', 'itemOnSalesController@getItemSalesBySiNumber');
Route::get('/si/item-saless/{id}', 'itemOnSalesController@getItemSalesSIById');
Route::patch('/si/item-sales/{id}', 'itemOnSalesController@postItemSalesSIById');
Route::delete('/si/item-sales/{id}', 'itemOnSalesController@deleteItemSalesSIById');
Route::get('/si/count-item-sales', 'itemOnSalesController@countItemSalesSI');
///////////////// SALES INVOICE END ///////////////////////////////////

// Sales Return
Route::get('/sales/return', 'salesController@getSalesReturn');
Route::post('/sales/return', 'salesController@postSalesReturn');
Route::get('/sales/return/{id}', 'salesController@getSalesReturnById');
Route::patch('/sales/return/{id}', 'salesController@postSalesReturnById');
Route::delete('/sales/return/{id}', 'salesController@deleteSalesReturnById');
Route::get('/count-sales-return', 'salesController@countSalesReturn');

// Item Sales
Route::get('/item-sales', 'itemOnSalesController@getItemSales');
Route::post('/item-sales', 'itemOnSalesController@postItemSales');
Route::get('/item-sales/{id}', 'itemOnSalesController@getItemSalesById');
Route::get('/item-sales/so-number/{so_number}', 'itemOnSalesController@getItemSalesBySoNumber');
Route::patch('/item-sales/{id}', 'itemOnSalesController@postItemSalesById');
Route::delete('/item-sales/{id}', 'itemOnSalesController@deleteItemSalesById');
Route::get('/count-item-sales', 'itemOnSalesController@countItemSales');

///////////////// DELIVERY RECEIPT ///////////////////////////////////
// Delivery Receipt
Route::get('/delivery/receipt', 'salesController@getDeliveryReceipt');
Route::post('/delivery/receipt', 'salesController@postDeliveryReceipt');
Route::get('/delivery/receipt/{sdr_number}', 'salesController@getDeliveryReceiptBySdrNumber');
Route::patch('/delivery/receipt/{sdr_number}', 'salesController@postDeliveryReceiptBySdrNumber');
Route::delete('/delivery-receipt/{id}', 'salesController@deleteDeliveryReceiptById');
Route::get('/count-delivery-receipt', 'salesController@countDeliveryReceipt');

Route::get('/sdr/item-sales', 'itemOnSalesController@getItemSalesSdr');
Route::post('/sdr/item-sales', 'itemOnSalesController@postItemPurchaseSdr');
Route::post('/sdr/item-sales/sales-invoice', 'itemOnSalesController@postItemSalesInvoiceSdr');
Route::post('/sdr/item-sales/{sdr_number}', 'itemOnSalesController@postItemSalesBySdrNumber');
Route::get('/sdr/item-sales/{sdr_number}', 'itemOnSalesController@getItemSalesBySdrNumber');
Route::get('/sdr/item-saless/{id}', 'itemOnSalesController@getItemSalesSdrById');
Route::patch('/sdr/item-sales/{id}', 'itemOnSalesController@postItemSalesSdrById');
Route::delete('/sdr/item-sales/{id}', 'itemOnSalesController@deleteItemSalesSdrById');
Route::get('/sdr/count-item-purchase', 'itemOnSalesController@countItemSalesSdr');
///////////////// DELIVERY RECEIPT END ///////////////////////////////////

// Leave Request
Route::get('/generate-one-lr', 'apiController@plusOneEachTen');

// USER ACTIVITY LOGS
Route::get('/user-logs', 'apiController@getActivityLogs');
