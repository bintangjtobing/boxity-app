<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerFieldToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('customerCode')->nullable()->after('createdBy');
            $table->string('customerName')->nullable()->after('customerCode');
            $table->string('customerAddress')->nullable()->after('customerName');
            $table->string('customerCity')->nullable()->after('customerAddress');
            $table->string('customerPhone')->nullable()->after('customerCity');
            $table->string('customerEmail')->nullable()->after('customerPhone');
            $table->string('customerWebsite')->nullable()->after('customerEmail');
            $table->string('customerNPWP')->nullable()->after('customerWebsite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('customerCode');
            $table->dropColumn('customerName');
            $table->dropColumn('customerAddress');
            $table->dropColumn('customerCity');
            $table->dropColumn('CustomerPhone');
            $table->dropColumn('customerEmail');
            $table->dropColumn('customerWebsite');
            $table->dropColumn('customerNPWP');
        });
    }
}
