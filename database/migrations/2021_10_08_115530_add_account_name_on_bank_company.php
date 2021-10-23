<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccountNameOnBankCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_companies', function (Blueprint $table) {
            $table->string('account_name')->nullable()->after('account_no');
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
            'bank_companies',
            function (Blueprint $table) {
                $table->dropColumn('account_name');
            }
        );
    }
}
