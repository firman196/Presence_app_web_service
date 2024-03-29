<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->string('kode_ruang',10)->primary();
            $table->string('nama_ruang',25);
            $table->smallInteger('kapasitas_ruang_kuliah')->length(6)->default(0);
            $table->smallInteger('kapasitas_ruang_ujian')->length(6)->default(0);
            $table->string('kode_prodi',10);
            $table->string('nama_gedung',25)->nullable();
            $table->timestamps();
        });

        //relasi ke tabel prodi
        Schema::table('ruangans', function (Blueprint $table) {
            $table->foreign('kode_prodi')->references('kode_prodi')->on('prodis')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruangans');
    }
}
