<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_code');
            $table->string('employee_name');
            $table->string('employee_nickname');
            $table->boolean('employee_sex');
            $table->integer('employee_age')->nullable();
            $table->string('employee_pic')->nullable();
            $table->string('employee_working_duration')->nullable();

            // Details
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('date_join')->nullable();
            $table->string('nationality')->nullable();
            $table->bigInteger('identity_no')->nullable();
            $table->string('religion')->nullable();
            $table->string('event')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('blood_type')->nullable();

            // Miscellaneous
            $table->bigInteger('tax_id')->nullable();
            $table->bigInteger('bpjstk')->nullable();
            $table->bigInteger('bpjskes')->nullable();

            // contact us
            $table->string('email')->nullable();
            $table->bigInteger('phone')->nullable();

            // job
            $table->string('job_title')->nullable();
            $table->string('job_type')->nullable();
            $table->integer('departments')->nullable()->index('departments');
            $table->integer('sub_departments')->nullable()->index('sub_departments');

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
        Schema::dropIfExists('employees');
    }
}
