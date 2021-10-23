<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('pi_number');
            $table->integer('supplier')->nullable()->index('supplier');
            $table->string('invoice_date')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('drivers')->nullable()->index('drivers');
            $table->string('vehicle_no')->nullable()->index('vehicle_no');
            $table->string('deliver_to')->nullable()->index('deliver_to');
            // Status 0, un-active, 1-> approved, 2-> terminated
            $table->integer('status')->default('0');
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('purchase_invoices');
    }
}
