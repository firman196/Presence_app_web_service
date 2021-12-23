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
            $table->string('kode_matakuliah',15)->primary();
            $table->string('nama_matakuliah',50);
            $table->enum('sifat_matakuliah',['W','P'])->default('W')->comment('W: wajib , P: pilihan');
            $table->enum('jenis_matakuliah',['T','P'])->default('T')->comment('T: teori, P: praktikum');
            $table->integer('sks')->default(0);
            $table->string('kode_prodi',10);
            $table->integer('semester')->default(0);
            $table->timestamps();

            //relasi ke tabel prodi
            $table->foreign('kode_prodi')
                ->references('kode_prodi')
                ->on('prodis')
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
        Schema::dropIfExists('matakuliah');
    }
}
