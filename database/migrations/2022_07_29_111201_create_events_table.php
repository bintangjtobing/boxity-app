<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->text('event_name');
            $table->string('slug');
            $table->date('start_date');
            $table->date('end_date');
            $table->longText('event_content');
            $table->text('organized_by')->nullable();
            $table->integer('status');
            $table->string('type');
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
        Schema::dropIfExists('events');
    }
}
