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
            $table->integer('item_code')->index('item_code');

            // For general
            $table->integer('qty')->nullable();
            $table->string('unit')->nullable();
            $table->string('price')->nullable();
            $table->string('purpose')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('used_by')->nullable();
            $table->longText('remarks')->nullable();
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
