<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratIzinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_izins', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jenis_izin',5);
            $table->string('nim',15);
            $table->bigInteger('presensi_id');
            $table->string('judul_surat_izin',255);
            $table->text('keterangan_mahasiswa');
            $table->text('keterangan_dosen');
            $table->string('foto_surat_izin',255);
            $table->enum('status',[1,2,3,4])->default(1)->comment('1: diajukan, 2: disetujui, 3:ditolak, 4: berhasil diproses');
            $table->timestamps();

        /*    //relasi ke tabel jenis_izins
            $table->foreign('kode_jenis_izins')
                ->references('kode')
                ->on('jenis_izins')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            //relasi ke tabel mahasiswas
            $table->foreign('nim')
                ->references('nim')
                ->on('mahasiswas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            //relasi ke tabel presensis
            $table->foreign('presensi_id')
                ->references('id')
                ->on('presensis')
                ->onUpdate('cascade')
                ->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_izins');
    }
}
