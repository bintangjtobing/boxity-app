<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDeliveryReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_delivery_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('sdr_number');
            $table->integer('customer')->nullable()->index('customer');
            $table->string('sdr_date')->nullable();
            $table->integer('toGL')->default('0');
            // Status 0, un-active, 1-> approved, 2-> terminated
            $table->integer('status')->default('0');
            $table->integer('created_by')->index('created_by');
            $table->integer('updated_by')->index('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_delivery_receipts');
    }
}
