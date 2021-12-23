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
            $table->bigInteger('krs_id');
            $table->string('kode_status_presensi',5);
            $table->integer('pertemuan_ke');
            $table->date('tanggal_presensi');
            $table->time('jam_presensi_dibuka');
            $table->time('jam_presensi_ditutup');
            $table->time('toleransi');
            $table->string('kode_beacon',10);
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
