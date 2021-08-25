<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDriverAndNopolOnItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_purchases', function (Blueprint $table) {
            $table->string('driver_name')->nullable()->after('qtyShipped');
            $table->string('driver_nopol')->nullable()->after('driver_name');
        });
        Schema::table('items_sales', function (Blueprint $table) {
            $table->string('driver_name')->nullable()->after('qtyShipped');
            $table->string('driver_nopol')->nullable()->after('driver_name');
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
            'items_purchases',
            function (Blueprint $table) {
                $table->dropColumn('driver_name');
                $table->dropColumn('driver_nopol');
            }
        );
        Schema::table(
            'items_sales',
            function (Blueprint $table) {
                $table->dropColumn('driver_name');
                $table->dropColumn('driver_nopol');
            }
        );
    }
}
