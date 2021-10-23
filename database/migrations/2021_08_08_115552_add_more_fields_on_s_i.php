<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsOnSI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_invoices', function (Blueprint $table) {
            $table->string('reference_no')->nullable()->after('toGL');
            $table->string('drivers')->nullable()->index('drivers')->after('reference_no');
            $table->string('vehicle_no')->nullable()->index('vehicle_no')->after('drivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_invoices', function (Blueprint $table) {
            $table->dropColumn('reference_no');
            $table->dropColumn('drivers');
            $table->dropColumn('vehicle_no');
        });
    }
}
