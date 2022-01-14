<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
         //   $table->bigInteger('krs_id');
            $table->string('kode_jadwal',10);
            $table->integer('pertemuan_ke')->default(1);
            $table->bigInteger('hari_id');
            $table->time('jam_presensi_dibuka')->nullable();
            $table->time('jam_presensi_ditutup')->nullable();
            $table->integer('toleransi_keterlambatan')->nullable();
            $table->enum('status',['aktif','nonaktif'])->default('nonaktif');
            $table->date('tanggal_pertemuan')->nullable();
            $table->integer('total_mahasiswa_hadir')->nullable();
            $table->integer('total_mahasiswa_alpha')->nullable();
            $table->integer('total_mahasiswa_izin')->nullable();
            $table->text('materi_perkuliahan')->nullable();
            $table->text('penugasan')->nullable();
            $table->string('media_perkuliahan')->nullable();
            $table->text('catatan_perkuliahan')->nullable();
           // $table->string('kode_status_presensi',5);
            //$table->date('tanggal_presensi');
            //$table->time('jam_presensi')->nullable();
          //  $table->string('kode_beacon',10);
            $table->timestamps();

           /* //relasi ke tabel status presensi
            $table->foreign('kode_status_presensi')
                ->references('kode')
                ->on('status_presensis')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            //relasi ke tabel krs
            $table->foreign('krs_id')
                ->references('id')
                ->on('krs')
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
        Schema::dropIfExists('presensis');
    }
}
