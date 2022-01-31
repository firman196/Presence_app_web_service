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
            $table->integer('kelas_id');
            $table->string('dosen',25);
            $table->integer('pertemuan_ke')->default(1);
            $table->enum('status',['aktif','nonaktif'])->default('nonaktif');
            $table->timestamps();
           /// $table->date('tanggal_presensi_dibuka')->nullable();
        //  $table->time('jam_presensi_dibuka')->nullable();
          //  $table->time('jam_presensi_ditutup')->nullable();
         //   $table->integer('toleransi_keterlambatan')->nullable();
           /* //relasi ke tabel hari
            $table->foreign('hari_id')
                ->references('id')
                ->on('haris')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            //relasi ke tabel kelas
            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            //relasi ke tabel dosen
            $table->foreign('dosen')
                ->references('nik')
                ->on('dosen')
                ->onUpdate('cascade')
                ->onDelete('cascade');

              //relasi ke tabel dosen
            $table->foreign('kode_ruang')
                ->references('kode_ruang')
                ->on('ruangans')
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
        Schema::dropIfExists('jadwals');
    }
}
