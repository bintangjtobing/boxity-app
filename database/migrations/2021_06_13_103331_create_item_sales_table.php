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
        Schema::create('item_sales', function (Blueprint $table) {
            $table->id();
            $table->integer('item_code')->index('item_code');
            // For general
            $table->integer('qty')->nullable();
            $table->string('unit')->nullable();
            $table->string('price')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();

            // Is it for purchase order, purchase invoices, purchases request or purchases return
            $table->integer('so_status')->default('0');
            $table->integer('si_status')->default('0');
            $table->integer('sdeliveryreceipt_status')->default('0');
            $table->integer('sreturn_status')->default('0');
            $table->integer('salesId')->default('0')->index('salesId');
            $table->integer('created_by')->index('created_by');
            $table->integer('updated_by')->index('updated_by');
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
