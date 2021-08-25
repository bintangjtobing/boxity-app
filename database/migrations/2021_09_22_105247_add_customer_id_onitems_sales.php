<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerIdOnitemsSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_sales', function (Blueprint $table) {
            $table->integer('customerId')->index('customerId')->nullable()->after('warehouseId');
        });
        Schema::table('items_purchases', function (Blueprint $table) {
            $table->integer('supplierId')->index('supplierId')->nullable()->after('item_code');
            $table->integer('warehouseId')->index('warehouseId')->nullable()->after('supplierId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_sales', function (Blueprint $table) {
            $table->dropColumn('customerId');
        });
        Schema::table('items_purchases', function (Blueprint $table) {
            $table->dropColumn('supplierId');
            $table->dropColumn('warehouseId');
        });
    }
}
