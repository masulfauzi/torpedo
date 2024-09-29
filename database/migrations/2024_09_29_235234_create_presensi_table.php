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
        Schema::create('presensi', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('id_anggota_kelas');
            $table->foreign('id_anggota_kelas')->references('id')->on('anggota_kelas')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_status_kehadiran');
            $table->foreign('id_status_kehadiran')->references('id')->on('status_kehadiran')->onDelete('restrict')->onUpdate('cascade');

            $table->string('keterangan');

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
        Schema::dropIfExists('presensi');
    }
};
