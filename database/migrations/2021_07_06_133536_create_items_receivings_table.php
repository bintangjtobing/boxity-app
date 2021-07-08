<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsReceivingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_receivings', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->index('item_code');

            // For general
            $table->integer('qtyOrdered')->nullable();
            $table->integer('qtyShipped')->nullable();
            $table->string('unit')->nullable();
            $table->longText('remarks')->nullable();

            // Is it for purchase order, purchase invoices, purchases request or purchases return
            $table->string('receiving_status')->default('0');
            $table->string('receivingId')->default('0')->index('receivingId');
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
        Schema::dropIfExists('items_receivings');
    }
}
