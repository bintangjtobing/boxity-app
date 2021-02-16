<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddAditionalFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('department')->default('staff')->after('role');
            $table->string('divisi')->after('department');
            $table->string('logip')->after('updated_at');
            $table->string('lastLogin')->after('logip');
            $table->string('username')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('department');
            $table->dropColumn('divisi');
            $table->dropColumn('logip');
            $table->dropColumn('lastLogin');
            $table->dropColumn('username');
            $table->dropColumn('organisation');
        });
    }
}
