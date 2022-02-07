<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('prodis', function (Blueprint $table) {
            $table->string('kode_prodi',10)->primary();
            $table->string('nama_prodi',50);
            $table->string('jenjang',10);
            //$table->string('kaprodi',25)->nullable();
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
        Schema::dropIfExists('prodis');
    }
}
