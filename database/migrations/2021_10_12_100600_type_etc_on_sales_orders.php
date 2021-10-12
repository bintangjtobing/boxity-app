<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeEtcOnSalesOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->integer('type')->default(0)->after('ecom_bank_id');
            $table->boolean('ecom_payment_status')->default(false)->after('ecom_courier');
            $table->string('ecom_upload_payment')->nullable()->after('ecom_payment_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'sales_orders',
            function (Blueprint $table) {
                $table->dropColumn('type');
                $table->dropColumn('ecom_payment_status');
                $table->dropColumn('ecom_upload_payment');
            }
        );
    }
}
