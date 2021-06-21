<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatakuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->string('kode_matakuliah',15);
            $table->string('nama_matakuliah',50);
            $table->char('sifat_matakuliah',1)->comment('W: wajib , P: pilihan');
            $table->char('jenis_matakuliah',1)->comment('T: teori, P: praktikum');
            $table->tinyInteger('sks')->length(4)->default(0);
            $table->string('kode_prodi',10);
            $table->tinyInteger('semester',4);
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
        Schema::dropIfExists('matakuliah');
    }
}
