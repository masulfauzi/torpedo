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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('id_hari');
            $table->foreign('id_hari')->references('id')->on('hari')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_sekolah');
            $table->foreign('id_sekolah')->references('id')->on('sekolah')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_semester');
            $table->foreign('id_semester')->references('id')->on('semester')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_jam_mulai');
            $table->foreign('id_jam_mulai')->references('id')->on('jam_mengajar')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_jam_selesai');
            $table->foreign('id_jam_selesai')->references('id')->on('jam_mengajar')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_mapel');
            $table->foreign('id_mapel')->references('id')->on('mapel')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_guru');
            $table->foreign('id_guru')->references('id')->on('guru')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_ruang');
            $table->foreign('id_ruang')->references('id')->on('ruang')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_versi_jadwal');
            $table->foreign('id_versi_jadwal')->references('id')->on('versi_jadwal')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('jadwal');
    }
};
