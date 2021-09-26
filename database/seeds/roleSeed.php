<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        DB::table('roles')->insert([
            'name' => 'Issue Center Management',
            'slug' => 'IssueCenterManagement'
        ]);
        DB::table('roles')->insert([
            'name' => 'Contact Lists',
            'slug' => 'ContactLists'
        ]);
        DB::table('roles')->insert([
            'name' => 'Notepad',
            'slug' => 'Notepad'
        ]);
        DB::table('roles')->insert([
            'name' => 'Quote Report',
            'slug' => 'QuoteReport'
        ]);
        DB::table('roles')->insert([
            'name' => 'Track Delivery',
            'slug' => 'TrackDelivery'
        ]);
        DB::table('roles')->insert([
            'name' => 'Customers Management',
            'slug' => 'CustomersManagement'
        ]);
        DB::table('roles')->insert([
            'name' => 'Suppliers Management',
            'slug' => 'SuppliersManagement'
        ]);
        DB::table('roles')->insert([
            'name' => 'Sales Person',
            'slug' => 'SalesPerson'
        ]);
        DB::table('roles')->insert([
            'name' => 'Users Management',
            'slug' => 'UsersManagement'
        ]);
        DB::table('roles')->insert([
            'name' => 'Employee',
            'slug' => 'Employee'
        ]);
        DB::table('roles')->insert([
            'name' => 'Job Vacancy',
            'slug' => 'JobVacancy'
        ]);
        DB::table('roles')->insert([
            'name' => 'Candidate',
            'slug' => 'Candidate'
        ]);
        DB::table('roles')->insert([
            'name' => 'Leave Request',
            'slug' => 'LeaveRequest'
        ]);
        DB::table('roles')->insert([
            'name' => 'Loan',
            'slug' => 'Loan'
        ]);
        DB::table('roles')->insert([
            'name' => 'Warehouse Management',
            'slug' => 'WarehouseManagement'
        ]);
        DB::table('roles')->insert([
            'name' => 'Stock Group',
            'slug' => 'StockGroup'
        ]);
        DB::table('roles')->insert([
            'name' => 'Item Group',
            'slug' => 'ItemGroup'
        ]);
        DB::table('roles')->insert([
            'name' => 'Inventory Item',
            'slug' => 'InventoryItem'
        ]);
        DB::table('roles')->insert([
            'name' => 'Purchase Order',
            'slug' => 'PurchaseOrder'
        ]);
        DB::table('roles')->insert([
            'name' => 'Purchase Invoice',
            'slug' => 'PurchaseInvoice'
        ]);
        DB::table('roles')->insert([
            'name' => 'Purchase Return',
            'slug' => 'PurchaseReturn'
        ]);
        DB::table('roles')->insert([
            'name' => 'Purchase Request',
            'slug' => 'PurchaseRequest'
        ]);
        DB::table('roles')->insert([
            'name' => 'Documents Receipt',
            'slug' => 'Documents Receipt'
        ]);
        DB::table('roles')->insert([
            'name' => 'Sales Order',
            'slug' => 'SalesOrder'
        ]);
        DB::table('roles')->insert([
            'name' => 'Sales Invoice',
            'slug' => 'SalesInvoice'
        ]);
        DB::table('roles')->insert([
            'name' => 'Sales Return',
            'slug' => 'SalesReturn'
        ]);
        DB::table('roles')->insert([
            'name' => 'Delivery Receipt',
            'slug' => 'DeliveryReceipt'
        ]);
        DB::table('roles')->insert([
            'name' => 'Documents Delivery',
            'slug' => 'DocumentsDelivery'
        ]);
        DB::table('roles')->insert([
            'name' => 'Permissions And Roles',
            'slug' => 'PermissionsRole'
        ]);
        DB::table('roles')->insert([
            'name' => 'Gallery',
            'slug' => 'Gallery'
        ]);
        DB::table('roles')->insert([
            'name' => 'Blog',
            'slug' => 'Blog'
        ]);
        DB::table('roles')->insert([
            'name' => 'Popup Window',
            'slug' => 'PopupWindow'
        ]);


        // Create Permissions
        // Issue
        DB::table('permissions')->insert([
            'name' => 'Create Issue',
            'slug' => 'CreateIssue'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Issue',
            'slug' => 'ViewIssue'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Approve Issue',
            'slug' => 'ApproveIssue'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Close Issue',
            'slug' => 'CloseIssue'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Comment Issue',
            'slug' => 'CommentIssue'
        ]);

        // Contact List
        DB::table('permissions')->insert([
            'name' => 'View ContactLists',
            'slug' => 'ViewContactLists'
        ]);

        // Notepad
        DB::table('permissions')->insert([
            'name' => 'View Notepad',
            'slug' => 'ViewNotepad'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Notepad',
            'slug' => 'CreateNotepad'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Notepad',
            'slug' => 'DeleteNotepad'
        ]);

        // Quote Report
        DB::table('permissions')->insert([
            'name' => 'View Quote Report',
            'slug' => 'ViewQuoteReport'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Quote Report',
            'slug' => 'CreateQuoteReport'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Quote Report',
            'slug' => 'DeleteQuoteReport'
        ]);

        // Track Delivery
        DB::table('permissions')->insert([
            'name' => 'Create Track Delivery',
            'slug' => 'CreateTrackDeliery'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Track Delivery',
            'slug' => 'ViewTrackDeliery'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Update Track Delivery',
            'slug' => 'UpdateTrackDelivery'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Track Delivery',
            'slug' => 'DeleteTrackDeliery'
        ]);

        // Customers
        DB::table('permissions')->insert([
            'name' => 'Create Customers',
            'slug' => 'CreateCustomers'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Customers',
            'slug' => 'ViewCustomers'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Customers',
            'slug' => 'EditCustomers'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Add PIC Customers',
            'slug' => 'AddPICCustomers'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete PIC Customers',
            'slug' => 'DeletePICCustomers'
        ]);

        // Suppliers
        DB::table('permissions')->insert([
            'name' => 'Create Suppliers',
            'slug' => 'CreateSuppliers'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Suppliers',
            'slug' => 'ViewSuppliers'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Suppliers',
            'slug' => 'EditSuppliers'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Suppliers',
            'slug' => 'DeleteSuppliers'
        ]);

        // Sales Person
        DB::table('permissions')->insert([
            'name' => 'Create Sales Person',
            'slug' => 'CreateSalesPerson'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Sales Person',
            'slug' => 'ViewSalesPerson'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Update Sales Person',
            'slug' => 'UpdateSalesPerson'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Sales Person',
            'slug' => 'DeleteSalesPerson'
        ]);

        // User management
        DB::table('permissions')->insert([
            'name' => 'Create Users',
            'slug' => 'CreateUsers'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Users',
            'slug' => 'EditUsers'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Users',
            'slug' => 'ViewUsers'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Terminate Users',
            'slug' => 'TerminateUsers'
        ]);

        // Employee
        DB::table('permissions')->insert([
            'name' => 'View Employee',
            'slug' => 'ViewEmployee'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Employee',
            'slug' => 'CreateEmployee'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Employee',
            'slug' => 'EditEmployee'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Employee',
            'slug' => 'DeleteEmployee'
        ]);
        // Job Vacancy
        DB::table('permissions')->insert([
            'name' => 'View Job Vacancy',
            'slug' => 'ViewJobVacancy'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Job Vacancy',
            'slug' => 'CreateJobVacancy'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Job Vacancy',
            'slug' => 'EditJobVacancy'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Job Vacancy',
            'slug' => 'DeleteJobVacancy'
        ]);
        // Candidate
        DB::table('permissions')->insert([
            'name' => 'View Candidate',
            'slug' => 'ViewCandidate'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Candidate',
            'slug' => 'CreateCandidate'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Candidate',
            'slug' => 'EditCandidate'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Candidate',
            'slug' => 'DeleteCandidate'
        ]);
        // Leave Request
        DB::table('permissions')->insert([
            'name' => 'View Leave Request',
            'slug' => 'ViewLeaveRequest'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Leave Request',
            'slug' => 'CreateLeaveRequest'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Leave Request',
            'slug' => 'EditLeaveRequest'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Leave Request',
            'slug' => 'DeleteLeaveRequest'
        ]);
        // Loan
        DB::table('permissions')->insert([
            'name' => 'View Loan',
            'slug' => 'ViewLoan'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Loan',
            'slug' => 'CreateLoan'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Loan',
            'slug' => 'EditLoan'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Loan',
            'slug' => 'DeleteLoan'
        ]);

        // Warehouse
        DB::table('permissions')->insert([
            'name' => 'View Warehouse',
            'slug' => 'ViewWarehouse'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Warehouse',
            'slug' => 'CreateWarehouse'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Warehouse',
            'slug' => 'DeleteWarehouse'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Warehouse',
            'slug' => 'EditWarehouse'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Add PIC Customers On Warehouse',
            'slug' => 'AddPICCustomersOnWarehouse'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete PIC Customers On Warehouse',
            'slug' => 'DeletePICCustomersOnWarehouse'
        ]);

        // Stock Group
        DB::table('permissions')->insert([
            'name' => 'View Stock Group',
            'slug' => 'ViewStockGroup'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Stock Group',
            'slug' => 'CreateStockGroup'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Stock Group',
            'slug' => 'EditStockGroup'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Stock Group',
            'slug' => 'DeleteStockGroup'
        ]);

        // Item Group
        DB::table('permissions')->insert([
            'name' => 'View Item Group',
            'slug' => 'ViewItemGroup'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Item Group',
            'slug' => 'CreateItemGroup'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Item Group',
            'slug' => 'EditItemGroup'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Item Group',
            'slug' => 'DeleteItemGroup'
        ]);

        // Inventory Item
        DB::table('permissions')->insert([
            'name' => 'Create Inventory Item',
            'slug' => 'CreateInventoryItem'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Inventory Item',
            'slug' => 'EditInventoryItem'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Inventory Item',
            'slug' => 'ViewInventoryItem'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Inventory Item',
            'slug' => 'DeleteInventoryItem'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Activities Inventory Item',
            'slug' => 'ViewActivitiesInventoryItem'
        ]);

        // Purchase Order
        DB::table('permissions')->insert([
            'name' => 'Create Purchase Order',
            'slug' => 'CreatePurchaseOrder'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Purchase Order',
            'slug' => 'ViewPurchaseOrder'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Purchase Order',
            'slug' => 'DeletePurchaseOrder'
        ]);
        // Purchase Invoice
        DB::table('permissions')->insert([
            'name' => 'Create Purchase Invoice',
            'slug' => 'CreatePurchaseInvoice'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Purchase Invoice',
            'slug' => 'ViewPurchaseInvoice'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Purchase Invoice',
            'slug' => 'EditPurchaseInvoice'
        ]);
        // Purchase Return
        DB::table('permissions')->insert([
            'name' => 'Create Purchase Return',
            'slug' => 'CreatePurchaseReturn'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Purchase Return',
            'slug' => 'ViewPurchaseReturn'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Purchase Return',
            'slug' => 'EditPurchaseReturn'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Purchase Return',
            'slug' => 'DeletePurchaseReturn'
        ]);
        // Purchase Request
        DB::table('permissions')->insert([
            'name' => 'Create Purchase Request',
            'slug' => 'CreatePurchaseRequest'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Purchase Request',
            'slug' => 'ViewPurchaseRequest'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Purchase Request',
            'slug' => 'EditPurchaseRequest'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Purchase Request',
            'slug' => 'DeletePurchaseRequest'
        ]);
        // Documents Receipt
        DB::table('permissions')->insert([
            'name' => 'Create Documents Receipt',
            'slug' => 'CreateDocumentsReceipt'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Documents Receipt',
            'slug' => 'ViewDocumentsReceipt'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Documents Receipt',
            'slug' => 'EditDocumentsReceipt'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Documents Receipt',
            'slug' => 'DeleteDocumentsReceipt'
        ]);
        // Sales Order
        DB::table('permissions')->insert([
            'name' => 'Create Sales Order',
            'slug' => 'CreateSalesOrder'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Sales Order',
            'slug' => 'ViewSalesOrder'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Sales Order',
            'slug' => 'DeleteSalesOrder'
        ]);
        // Sales Invoice
        DB::table('permissions')->insert([
            'name' => 'Create Sales Invoice',
            'slug' => 'CreateSalesInvoice'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Sales Invoice',
            'slug' => 'ViewSalesInvoice'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Sales Invoice',
            'slug' => 'EditSalesInvoice'
        ]);
        // Sales Return
        DB::table('permissions')->insert([
            'name' => 'Create Sales Return',
            'slug' => 'CreateSalesReturn'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Sales Return',
            'slug' => 'ViewSalesReturn'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Sales Return',
            'slug' => 'EditSalesReturn'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Sales Return',
            'slug' => 'DeleteSalesReturn'
        ]);
        // Delivery Receipt
        DB::table('permissions')->insert([
            'name' => 'Create Delivery Receipt',
            'slug' => 'CreateDeliveryReceipt'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Delivery Receipt',
            'slug' => 'ViewDeliveryReceipt'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Delivery Receipt',
            'slug' => 'EditDeliveryReceipt'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Delivery Receipt',
            'slug' => 'DeleteDeliveryReceipt'
        ]);
        // Document Delivery
        DB::table('permissions')->insert([
            'name' => 'Create Document Delivery',
            'slug' => 'CreateDocumentDelivery'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Document Delivery',
            'slug' => 'ViewDocumentDelivery'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Document Delivery',
            'slug' => 'EditDocumentDelivery'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Document Delivery',
            'slug' => 'DeleteDocumentDelivery'
        ]);
        // Permission and Role
        DB::table('permissions')->insert([
            'name' => 'Create Permission Role',
            'slug' => 'CreatePermissionRole'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Permission Role',
            'slug' => 'ViewPermissionRole'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Permission Role',
            'slug' => 'EditPermissionRole'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Permission Role',
            'slug' => 'DeletePermissionRole'
        ]);
        // Gallery
        DB::table('permissions')->insert([
            'name' => 'Create Gallery',
            'slug' => 'CreateGallery'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Gallery',
            'slug' => 'ViewGallery'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Gallery',
            'slug' => 'EditGallery'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Gallery',
            'slug' => 'DeleteGallery'
        ]);
        // Blog
        DB::table('permissions')->insert([
            'name' => 'Create Blog',
            'slug' => 'CreateBlog'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Blog',
            'slug' => 'ViewBlog'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Blog',
            'slug' => 'EditBlog'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete Blog',
            'slug' => 'DeleteBlog'
        ]);
        // PopupWindow
        DB::table('permissions')->insert([
            'name' => 'Create PopupWindow',
            'slug' => 'CreatePopupWindow'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View PopupWindow',
            'slug' => 'ViewPopupWindow'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit PopupWindow',
            'slug' => 'EditPopupWindow'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Delete PopupWindow',
            'slug' => 'DeletePopupWindow'
        ]);
    }
}
