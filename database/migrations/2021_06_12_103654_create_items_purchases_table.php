<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->index('item_code');

            // For general
            $table->integer('qtyOrdered')->default(0)->nullable();
            $table->integer('qtyShipped')->default(0)->nullable();
            $table->integer('qtyRequested')->default(0)->nullable();
            $table->integer('qtyReturns')->default(0)->nullable();
            $table->string('unit')->nullable();
            $table->string('price')->nullable();
            $table->string('purpose')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('used_by')->nullable();
            $table->longText('remarks')->nullable();

            // Is it for purchase order, purchase invoices, purchases request or purchases return
            $table->string('po_status')->default('0')->index('po_status');
            $table->string('pi_status')->default('0')->index('pi_status');
            $table->string('prequest_status')->default('0')->index('prequest_status');
            $table->string('preturn_status')->default('0')->index('preturn_status');
            $table->string('purchasingId')->default('0')->index('purchasingId');
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
        Schema::dropIfExists('items_purchases');
    }
}
