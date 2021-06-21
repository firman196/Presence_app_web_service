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
        Schema::create('dosen', function (Blueprint $table) {
            $table->string('nik',25);
            $table->string('nip',25);
            $table->string('nama',50);
            $table->text('alamat')->nullable();
            $table->string('kode_pos',10)->nullable();
            $table->string('kode_prodi',10);
            $table->smallInteger('jenjang_pendidikan_id',6);
            $table->string('gelar_depan',20)->nullable();
            $table->string('gelar_belakang',20)->nullable();
            $table->string('agama',50);
            $table->string('telp',50)->nullable();
            $table->string('email',25)->nullable();
            $table->string('foto',100)->nullable();
            $table->enum('status',[0,1])->default(0);
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
        Schema::dropIfExists('dosen');
    }
}
