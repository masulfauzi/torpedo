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
        Schema::create('anggota_kelas', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('id_siswa');
            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_kelas');
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('restrict')->onUpdate('cascade');

            $table->uuid('id_semester');
            $table->foreign('id_semester')->references('id')->on('semester')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('anggota_kelas');
    }
};
