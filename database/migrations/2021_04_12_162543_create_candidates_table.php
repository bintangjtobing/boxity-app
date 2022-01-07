<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('posisi')->default(0);
            $table->string('picture')->nullable();
            $table->string('sumber_informasi')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('noktp')->nullable();
            $table->string('nonpwp')->nullable();
            $table->string('nobpjs')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->bigInteger('provinsi')->default(0);
            $table->bigInteger('domisili')->default(0);
            $table->bigInteger('kecamatan')->default(0);
            $table->bigInteger('kelurahan')->default(0);
            $table->string('jenis_kelamin')->nullable();
            $table->integer('agama')->default(0);
            $table->integer('suku')->default(0);
            $table->longText('alamat_domisili')->nullable();
            $table->string('email')->unique();
            $table->string('nohp')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('pendidikan_akhir')->nullable();
            $table->longText('about')->nullable();
            $table->string('supported_file')->nullable();
            $table->string('expected_sallary')->nullable();
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
        Schema::dropIfExists('candidates');
    }
}
