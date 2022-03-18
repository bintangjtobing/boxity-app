<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldOnGoodsReceipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_receipts', function (Blueprint $table) {
            $table->string('companies_receiver')->nullable()->after('receiverid');
            $table->string('type')->nullable()->after('userid');
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
            'goods_receipts',
            function (Blueprint $table) {
                $table->dropColumn('companies_receiver');
                $table->dropColumn('receipt_no');
                $table->dropColumn('type');
            }
        );
    }
}
