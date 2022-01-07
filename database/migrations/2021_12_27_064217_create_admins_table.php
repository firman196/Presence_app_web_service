<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->string('nik',25)->primary();
            $table->string('nip',25);
            $table->string('nama',50);
            $table->string('foto',255)->nullable();
            $table->string('email',50);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',255);
            $table->enum('status',[0,1])->default(0)->comment('0 : Nonaktif, 1 : Aktif');
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
        Schema::dropIfExists('admins');
    }
}
