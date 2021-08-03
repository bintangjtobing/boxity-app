<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_sales', function (Blueprint $table) {
            $table->id();
            $table->string('warehouseId')->default(0)->index('warehouseId');
            $table->string('item_code')->index('item_code');

            // For general
            $table->integer('qtyOrdered')->nullable();
            $table->integer('qtyShipped')->nullable();
            $table->integer('qtyReturns')->nullable();
            $table->string('unit')->nullable();
            $table->string('price')->nullable();
            $table->string('purpose')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('used_by')->nullable();
            $table->longText('remarks')->nullable();

            // Is it for purchase order, purchase invoices, purchases request or purchases return
            $table->string('so_status')->default('0')->index('so_status');
            $table->string('si_status')->default('0')->index('si_status');
            $table->string('sreturn_status')->default('0')->index('sreturn_status');
            $table->string('salesingId')->default('0')->index('salesingId');
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
        Schema::dropIfExists('item_sales');
    }
}
