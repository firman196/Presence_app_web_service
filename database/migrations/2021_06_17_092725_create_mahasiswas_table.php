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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('nim',15)->unique();
            $table->string('nik',25);
            $table->string('nama',50);
            $table->char('angkatan',4);
            $table->string('kode_prodi',10);
            $table->smallInteger('kelas_id',6);
            $table->text('alamat')->nullable();
            $table->string('kode_pos',10)->nullable();
            $table->string('agama',50);
            $table->char('jenis_kelamin',4);
            $table->integer('semester')->default('0');
            $table->string('telp',50)->nullable();
            $table->string('email',25)->nullable();
            $table->string('dosen',25);
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
        Schema::dropIfExists('mahasiswa');
    }
}
