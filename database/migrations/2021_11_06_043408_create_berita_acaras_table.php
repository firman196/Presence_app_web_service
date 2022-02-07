<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaAcarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_acaras', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jadwal',10);
            $table->text('materi_perkuliahan');
            $table->text('penugasan')->nullable();
            $table->date('tanggal_pertemuan');
            $table->integer('total_mahasiswa_hadir')->default(0);
            $table->integer('total_mahasiswa_alpha')->default(0);
            $table->integer('total_mahasiswa_izin')->default(0);
            $table->time('jam_presensi_dibuka')->default('00:00');
            $table->time('jam_presensi_ditutup')->default('00:00');
            $table->string('media_perkuliahan',100)->nullable();
            $table->text('catatan_perkuliahan')->nullable();
            $table->timestamps();
        });

        //relasi ke tabel jenis_izins
        Schema::table('berita_acaras', function (Blueprint $table) {
            $table->foreign('kode_jadwal')->references('kode_jadwal')->on('jadwals')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berita_acaras');
    }
}
