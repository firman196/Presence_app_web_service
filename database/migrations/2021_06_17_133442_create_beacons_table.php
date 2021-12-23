<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeaconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beacons', function (Blueprint $table) {
            $table->string('kode_beacon',10)->primary();
            $table->string('kode_ruang',10);
            $table->string('uuid',255);
            $table->integer('major');
            $table->integer('minor');
            $table->timestamps();

            //relasi ke tabel ruangan
          /*  $table->foreign('kode_ruang')
                ->references('kode_ruang')
                ->on('ruangans')
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
        Schema::dropIfExists('beacons');
    }
}
