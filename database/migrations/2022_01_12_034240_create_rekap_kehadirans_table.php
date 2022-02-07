<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapKehadiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_kehadirans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('presensi_id')->unsigned();
            $table->string('kode_status_presensi',5)->nullable();
            $table->time('jam_presensi')->nullable();
            $table->date('tanggal_presensi')->nullable();
            $table->string('kode_jadwal',10);
            $table->string('nim',15);
            $table->enum('status',['default','success','expired']);
           // $table->string('imei',255)->nullable();
            $table->timestamps();
        });

        //relasi ke tabel presensi
        Schema::table('rekap_kehadirans', function (Blueprint $table) {
            $table->foreign('presensi_id')->references('id')->on('presensis')->onUpdate('cascade')->onDelete('cascade');
        });

        //relasi ke tabel status_presensis
        Schema::table('rekap_kehadirans', function (Blueprint $table) {
            $table->foreign('kode_status_presensi')->references('kode')->on('status_presensis')->onUpdate('cascade')->onDelete('cascade');
        });

        //relasi ke tabel jadwals
        Schema::table('rekap_kehadirans', function (Blueprint $table) {
            $table->foreign('kode_jadwal')->references('kode_jadwal')->on('jadwals')->onUpdate('cascade')->onDelete('cascade');
        });


        //relasi ke tabel kode_jadwal
        Schema::table('rekap_kehadirans', function (Blueprint $table) {
            $table->foreign('nim')->references('nim')->on('mahasiswas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekap_kehadirans');
    }
}
