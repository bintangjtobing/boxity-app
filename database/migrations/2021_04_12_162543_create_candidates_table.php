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
            $table->string('posisi');
            $table->string('sumber_informasi');
            $table->string('nama_lengkap');
            $table->bigInteger('noktp')->nullable();
            $table->bigInteger('nonpwp')->nullable();
            $table->bigInteger('nobpjs')->nullable();
            $table->integer('anak_ke');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->bigInteger('provinsi');
            $table->bigInteger('domisili');
            $table->bigInteger('kecamatan');
            $table->bigInteger('kelurahan');
            $table->string('jenis_kelamin');
            $table->integer('agama');
            $table->integer('suku');
            $table->longText('alamat_domisili');
            $table->string('email')->unique();
            $table->string('nohp');
            $table->string('status_perkawinan');
            $table->string('pendidikan_akhir');
            $table->longText('about');
            $table->string('supported_file');
            $table->string('expected_sallary');
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
