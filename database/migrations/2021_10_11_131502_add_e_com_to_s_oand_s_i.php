<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEComToSOandSI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This is for e-commerce checkout needs
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->string('ecom_order_note')->nullable()->after('remarks');
            $table->string('ecom_label_recipient')->nullable()->after('ecom_order_note');
            $table->string('ecom_recipient_name')->nullable()->after('ecom_label_recipient');
            $table->string('ecom_contact_num')->nullable()->after('ecom_recipient_name');
            $table->string('ecom_city')->nullable()->after('ecom_contact_num');
            $table->string('ecom_zipcode')->nullable()->after('ecom_city');
            $table->string('ecom_address')->nullable()->after('ecom_zipcode');
            $table->string('ecom_courier')->nullable()->after('ecom_address');
            $table->string('ecom_bank_id')->nullable()->index('ecom_bank_id')->after('ecom_courier');
        });
        Schema::table('sales_invoices', function (Blueprint $table) {
            $table->string('ecom_order_note')->nullable()->after('drivers');
            $table->string('ecom_label_recipient')->nullable()->after('ecom_order_note');
            $table->string('ecom_recipient_name')->nullable()->after('ecom_label_recipient');
            $table->string('ecom_contact_num')->nullable()->after('ecom_recipient_name');
            $table->string('ecom_city')->nullable()->after('ecom_contact_num');
            $table->string('ecom_zipcode')->nullable()->after('ecom_city');
            $table->string('ecom_address')->nullable()->after('ecom_zipcode');
            $table->string('ecom_courier')->nullable()->after('ecom_address');
            $table->string('ecom_bank_id')->nullable()->index('ecom_bank_id')->after('ecom_courier');
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
            'sales_invoices',
            function (Blueprint $table) {
                $table->dropColumn('ecom_order_note');
                $table->dropColumn('ecom_label_recipient');
                $table->dropColumn('ecom_recipient_name');
                $table->dropColumn('ecom_contact_num');
                $table->dropColumn('ecom_city');
                $table->dropColumn('ecom_zipcode');
                $table->dropColumn('ecom_address');
                $table->dropColumn('ecom_courier');
                $table->dropColumn('ecom_bank_id');
            }
        );
        Schema::table(
            'sales_orders',
            function (Blueprint $table) {
                $table->dropColumn('ecom_order_note');
                $table->dropColumn('ecom_label_recipient');
                $table->dropColumn('ecom_recipient_name');
                $table->dropColumn('ecom_contact_num');
                $table->dropColumn('ecom_city');
                $table->dropColumn('ecom_zipcode');
                $table->dropColumn('ecom_address');
                $table->dropColumn('ecom_courier');
                $table->dropColumn('ecom_bank_id');
            }
        );
    }
}
