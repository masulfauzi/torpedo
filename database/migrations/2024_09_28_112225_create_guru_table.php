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
        Schema::create('guru', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // your columns here
            $table->uuid('id_sekolah');
            $table->foreign('id_sekolah')->references('id')->on('sekolah')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama');
            $table->string('nip')->unique()->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->uuid('id_jenis_kelamin');
            $table->foreign('id_jenis_kelamin')->references('id')->on('jenis_kelamin')->onDelete('restrict')->onUpdate('cascade');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->string('nama_ibu_kandung')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('dusun')->nullable();
            $table->uuid('id_desa')->nullable();
            $table->foreign('id_desa')->references('id')->on('desa')->onDelete('restrict')->onUpdate('cascade');
            $table->string('kode_pos')->nullable();
            $table->string('lintang')->nullable();
            $table->string('bujur')->nullable();
            $table->string('no_kk')->nullable();
            $table->uuid('id_agama');
            $table->foreign('id_agama')->references('id')->on('agama')->onDelete('restrict')->onUpdate('cascade');
            $table->string('npwp')->unique()->nullable();
            $table->string('nik');
            $table->uuid('id_status_perkawinan')->nullable();
            $table->foreign('id_status_perkawinan')->references('id')->on('status_perkawinan')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_pasangan')->nullable();
            $table->uuid('id_pekerjaan_pasangan')->nullable();
            $table->foreign('id_pekerjaan_pasangan')->references('id')->on('pekerjaan')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_disabilitas')->nullable();
            $table->foreign('id_disabilitas')->references('id')->on('disabilitas')->onDelete('restrict')->onUpdate('cascade');
            $table->uuid('id_status_kepegawaian');
            $table->foreign('id_status_kepegawaian')->references('id')->on('status_kepegawaian')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nuptk')->unique();
            $table->string('sk_pengangkatan')->nullable();
            $table->date('tmt_pengangkatan')->nullable();
            $table->string('no_hp');
            $table->string('email');


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
        Schema::dropIfExists('guru');
    }
};
