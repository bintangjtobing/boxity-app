<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSdrStatusOnItemsSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_sales', function (Blueprint $table) {
            $table->integer('sdr_status')->default(0)->after('sreturn_status');
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
            $table->dropColumn('sdr_status');
        });
    }
}
