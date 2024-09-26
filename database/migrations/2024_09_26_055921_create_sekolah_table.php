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
        Schema::create('sekolah', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // your columns here
            $table->uuid('id_jenis_sekolah');
            $table->foreign('id_jenis_sekolah')->references('id')->on('jenis_sekolah')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_status_sekolah');
            $table->foreign('id_status_sekolah')->references('id')->on('status_sekolah')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_sekolah');
            $table->string('npsn')->unique();
            $table->text('alamat');
            $table->uuid('id_desa');
            $table->foreign('id_desa')->references('id')->on('desa')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('sekolah');
    }
};
