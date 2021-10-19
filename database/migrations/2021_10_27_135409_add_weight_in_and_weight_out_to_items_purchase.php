<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightInAndWeightOutToItemsPurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_purchases', function (Blueprint $table) {
            $table->integer('status')->default(0)->after('unit');
            $table->string('purchase_related')->nullable()->after('purchasingId');
            $table->integer('weightIn')->nullable()->after('qtyReturns');
            $table->integer('weightOut')->nullable()->after('weightIn');
        });
        Schema::table('items_sales', function (Blueprint $table) {
            $table->integer('status')->default(0)->after('unit');
            $table->string('sales_related')->nullable()->after('salesingId');
            $table->integer('weightIn')->nullable()->after('qtyReturns');
            $table->integer('weightOut')->nullable()->after('weightIn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_purchases', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('purchase_related');
            $table->dropColumn('weightIn');
            $table->dropColumn('weightOut');
        });
        Schema::table('items_sales', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('sales_related');
            $table->dropColumn('weightIn');
            $table->dropColumn('weightOut');
        });
    }
}
