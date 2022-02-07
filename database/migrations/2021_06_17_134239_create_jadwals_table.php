<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->string('kode_jadwal',10)->primary();
            $table->integer('hari_id');
            $table->time('jam_mulai',$precision = 0);
            $table->time('jam_selesai',$precision = 0);
            $table->string('kode_matakuliah',15);
            $table->string('kode_ruang',10);
            $table->unsignedBigInteger('kelas_id');
            $table->string('dosen',25);
            $table->integer('pertemuan_ke')->default(1);
            $table->enum('status',['aktif','nonaktif'])->default('nonaktif');
            $table->timestamps();

        });


        //relasi ke tabel ruangans
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreign('kode_ruang')->references('kode_ruang')->on('ruangans')->onUpdate('cascade')->onDelete('cascade');
        });

        //relasi ke tabel kelas
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreign('kelas_id')->references('id')->on('kelas')->onUpdate('cascade')->onDelete('cascade');
        });

        //relasi ke tabel dosen
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreign('dosen')->references('nik')->on('dosens')->onUpdate('cascade')->onDelete('cascade');
        });

        //relasi ke tabel ruangans
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreign('kode_matakuliah')->references('kode_matakuliah')->on('matakuliah')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
}
