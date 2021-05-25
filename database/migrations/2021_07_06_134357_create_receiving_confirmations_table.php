<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivingConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiving_confirmations', function (Blueprint $table) {
            $table->id();
            $table->string('receiving_number');
            $table->integer('customer')->nullable()->index('customer');
            $table->string('receiving_date')->nullable();
            $table->string('receiving_warehouse')->nullable()->index('receiving_warehouse');
            $table->string('drivers')->nullable()->index('drivers');
            $table->string('vehicle_no')->nullable()->index('vehicle_no');

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
        Schema::dropIfExists('receiving_confirmations');
    }
}
