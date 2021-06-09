<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsItemTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_item_transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('itemCode')->index('itemCode');
            $table->integer('qty');
            $table->string('unit');
            $table->longText('remarks')->nullable();
            $table->integer('tf_goods_id')->index('tf_goods_id');
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
        Schema::dropIfExists('goods_item_transfers');
    }
}
