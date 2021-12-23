<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jadwal',10);
            $table->string('nim',15);
            $table->date('tanggal_krs');
            $table->timestamps();

            //relasi ke tabel jadwal
            $table->foreign('kode_jadwal')
                ->references('kode_jadwal')
                ->on('jadwals')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            //relasi ke tabel jadwal
            $table->foreign('nim')
                ->references('nim')
                ->on('mahasiswas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('krs');
    }
}
