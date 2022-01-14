<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('nim',15)->primary();
            $table->string('nama',50);
            $table->string('kode_prodi',10);
            $table->bigInteger('kelas_id');
            $table->string('dosen',25);
            $table->string('foto',255)->nullable();
            $table->string('password',255);
            $table->string('email',50)->nullable();
            $table->integer('semester')->default('0');
            $table->enum('status',[0,1])->default(0)->comment('0 : Nonaktif, 1 : Aktif');
            $table->string('telp',20)->nullable();
            $table->integer('persen_hadir')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
          
         /*   //relasi ke tabel kelas
            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onUpdate('cascade');

            //relasi ke tabel dosen
            $table->foreign('dosen')
                ->references('nik')
                ->on('dosens')
                ->onUpdate('cascade');

            //relasi ke tabel prodi
            $table->foreign('kode_prodi')
                ->references('kode_prodi')
                ->on('prodis')
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
        Schema::dropIfExists('mahasiswas');
    }
}
