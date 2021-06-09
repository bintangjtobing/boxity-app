<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('refNumber')->unique();
            $table->string('mutation_date');
            $table->integer('from')->index('from');
            $table->integer('to')->index('to');
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
        Schema::dropIfExists('goods_transfers');
    }
}
