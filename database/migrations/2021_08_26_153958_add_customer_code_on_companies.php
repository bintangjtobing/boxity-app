<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerCodeOnCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('company_code')->nullable();
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('supplier_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('company_code');
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('supplier_code');
        });
    }
}
