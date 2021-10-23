<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('ddr_number');
            $table->integer('senderName')->index('senderName');
            $table->string('courier')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('documents_deliveries');
    }
}
