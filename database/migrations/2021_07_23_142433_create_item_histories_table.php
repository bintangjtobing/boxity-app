<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_item_histories', function (Blueprint $table) {
            $table->id();
            $table->string('itemId')->nullable()->index('itemId');
            $table->string('itemOutId')->nullable()->index('itemOutId');
            $table->string('itemInId')->nullable()->index('itemInId');
            $table->integer('type');
            $table->date('date');
            $table->integer('qtyIn')->default(0);
            $table->integer('qtyOut')->default(0);
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
        Schema::dropIfExists('item_histories');
    }
}
