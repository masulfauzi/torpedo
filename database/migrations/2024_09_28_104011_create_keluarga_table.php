<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluarga', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // your columns here
            $table->uuid('id_siswa');
            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_hub_keluarga');
            $table->foreign('id_hub_keluarga')->references('id')->on('hub_keluarga')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama');
            $table->string('nik');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->uuid('id_pendidikan');
            $table->foreign('id_pendidikan')->references('id')->on('pendidikan')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_pekerjaan');
            $table->foreign('id_pekerjaan')->references('id')->on('pekerjaan')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_penghasilan');
            $table->foreign('id_penghasilan')->references('id')->on('penghasilan')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_disabilitas');
            $table->foreign('id_disabilitas')->references('id')->on('disabilitas')->onDelete('restrict')->onUpdate('cascade');


            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keluarga');
    }
};
