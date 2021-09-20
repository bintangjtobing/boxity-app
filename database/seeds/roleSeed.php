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
            'name' => 'Customers Management',
            'slug' => 'CustomersManagement'
        ]);
        DB::table('roles')->insert([
            'name' => 'Suppliers Management',
            'slug' => 'SuppliersManagement'
        ]);
        DB::table('roles')->insert([
            'name' => 'Users Management',
            'slug' => 'UsersManagement'
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
        DB::table('permissions')->insert([
            'name' => 'View ContactLists',
            'slug' => 'ViewContactLists'
        ]);
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
    }
}
