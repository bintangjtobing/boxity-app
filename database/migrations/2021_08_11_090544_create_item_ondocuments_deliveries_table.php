<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemOndocumentsDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_documents_deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('receiptNumber')->nullable();
            $table->string('destination')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('ddrId')->default('0')->index('ddrId');
            $table->integer('status')->default(0);
            $table->integer('created_by')->index('created_by');
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
        Schema::dropIfExists('item_ondocuments_deliveries');
    }
}
