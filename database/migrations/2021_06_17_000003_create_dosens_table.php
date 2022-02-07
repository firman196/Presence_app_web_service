<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->string('nik',25)->primary();
            $table->string('nip',25);
            $table->string('nama',50);
            $table->string('kode_prodi',10);
            $table->string('jenjang_pendidikan',5);
            $table->string('gelar_depan',20)->nullable();
            $table->string('gelar_belakang',20)->nullable();
            $table->string('telp',20)->nullable();
            $table->string('email',50)->unique()->nullable();
            $table->string('foto',255)->nullable();
            $table->string('password',255);
            $table->enum('status',[0,1])->default(0)->comment('0 : Nonaktif, 1 : Aktif');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        //relasi ke tabel prodi
        Schema::table('dosens', function (Blueprint $table) {
            $table->foreign('kode_prodi')->references('kode_prodi')->on('prodis')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosens');
    }
}
