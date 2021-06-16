<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_code');
            $table->string('item_name');
            // Type: 1. Stock, 2. Non Stock, 3. Assembly, 4. Bundle, 5. Service
            $table->integer('type')->nullable();
            $table->string('brand')->nullable();
            $table->string('price')->default('0')->nullable();
            $table->integer('item_group')->index('item_group');
            $table->string('width')->nullable();
            $table->string('length')->nullable();
            $table->string('thickness')->nullable();
            $table->string('nt_weight')->nullable();
            $table->string('gr_weight')->nullable();
            $table->string('volume')->nullable();
            $table->string('unit')->nullable();
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
        Schema::dropIfExists('inventory_items');
    }
}
