<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerIdOnItemsPurchases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_purchases', function (Blueprint $table) {
            $table->integer('customerId')->index('customerId')->nullable()->after('supplierId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::table('items_purchases', function (Blueprint $table) {
    //         $table->dropColumn('customerId');
    //     });
    // }
}
