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
            $table->bigInteger('presensi_id');
            $table->string('kode_status_presensi',5)->nullable();
            $table->time('jam_presensi')->nullable();
            $table->date('tanggal_presensi')->nullable();
            $table->string('nim',15);
            $table->enum('status',['default','success','expired']);
           // $table->string('imei',255)->nullable();
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
        Schema::dropIfExists('rekap_kehadirans');
    }
}
