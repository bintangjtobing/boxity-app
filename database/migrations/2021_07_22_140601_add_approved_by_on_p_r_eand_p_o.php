<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovedByOnPREandPO extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->integer('approvedBy')->nullable()->after('updated_by')->index('approvedBy');
        });
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->integer('approvedBy')->nullable()->after('updated_by')->index('approvedBy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_requests', function (Blueprint $table) {
            $table->dropColumn('approvedBy');
        });
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropColumn('approvedBy');
        });
    }
}
